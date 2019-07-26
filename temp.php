<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Mailer\Email;
use Cake\Core\Configure;
use Cake\Utility\Inflector;
use Cake\ORM\TableRegistry;
use Search\Manager;
/**
 * User Controller
 *
 * @property \App\Model\Table\UserTable $User
 */
class UserController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['login', 'logout', 'forgotPassword', 'changeUserPassword','resetUserPassword']);
        $this->loadComponent('StringsFunctions');
        $this->loadModel('PasswordResetToken');
        $this->loadModel('RemembermeToken');

        $this->token_length = intval(Configure::read('Application.user.token_length'));
        $this->token_validity = Configure::read('Application.user.passwordTokenValidity');
        $this->rememberme_token_length = intval(Configure::read('Application.user.token_length'));
        $this->rememberme_token_validity = Configure::read('Application.user.remembermeTokenValidity');
        $this->activation_token_validity = Configure::read('Application.user.accountActivationTokenValidity');

        $this->loadComponent('Search.Prg', [
            'actions' => ['index']
        ]);
    }

    public function export()
    {
        $data = [];
        $status = ["1" => "active", "0" => "inactive"];

        $this->response->download('export.csv');
        $query = $this->User
        ->find('search', ['search' => $this->request->query])
        ->contain(['Company', 'CountryCode', 'Timezone'])
        ->where(['User.company_id =' => $this->user_data->company_id])
        ->where(['User.status !=' => 2]);


        foreach ($query as $row) {
            $data_row = [
                $row->name,
                $row->email,
                $row->country_code->country_name,
                ($row->has('timezone') ? $row->timezone->ui_name : ""),
                $row->created_by,
                $row->created_on,
                $row->edited_on,
                $row->status
            ];
            array_push($data, $data_row);
        };


        $_serialize = 'data';
        $_header = ['Name', 'Email', 'Country', 'Timezone', 'Created By', 'Created On', 'Edited On', 'Status'];
        $this->set(compact('data', '_serialize', '_header'));

        $this->viewBuilder()->className('CsvView.Csv');

        return;
    }


    public function logout()
    {
        $session = $this->request->session();
        //update the session history with logout data
        if($session->read('login_time'))
        $session_history_row = $this->User->UserSessionHistory->get([$session->read('user_id'), $session->read('login_time')]);
        if($session_history_row) {
            $session_history_data = ['logout_time' => $this->User->getMysqlTimestamp()];
            $session_history_row = $this->User->UserSessionHistory->patchEntity($session_history_row, $session_history_data);
            $this->User->UserSessionHistory->save($session_history_row);
        }

        $session->write('user_id', false);
        $session->write('logged_in', false);
        $session->delete('backendadmin');
        $session->delete('timezone');
        $session->delete('name');
        $session->delete('email');
        $session->delete('company_id');
        $this->Flash->set(__('You are now logged out.'), ['element' => 'login_success']);
        $rememberme = $this->Cookie->delete('rememberme');
        return $this->redirect($this->Auth->logout());
    }

    public function login()
    {
        $session = $this->request->session();
        $user_id = $session->read('user_id');
        if(!is_null($user_id) and is_numeric($user_id) and $user_id > 0) {
            $user =  $this->User->find()->where(['User.id'=> $user_id])->leftJoinWith('Company');
            if ($user) {
				$this->Auth->setUser($user->toArray());
                return $this->redirect($this->Auth->redirectUrl());
            }
        }

        $rememberme = $this->Cookie->read('rememberme');
        if($rememberme) {
            $token = $this->RemembermeToken->getTokenData(substr($rememberme, 0, $this->rememberme_token_length));
            $user_id = substr($rememberme, $this->rememberme_token_length);
            if(!is_null($user_id) and is_numeric($user_id) and $user_id > 0 and $token) {
                $user =  $this->User->get($user_id);
                if ($user and  $this->RemembermeToken->validateToken($token, $user_id)) {
                    $this->Auth->setUser($user->toArray());
                    $timezone = TableRegistry::get('Timezone')->get($user['timezone_id']);
					$company = $this->User->Company->get($user['company_id'], ['contain' => ['ApplicationForCompany' => ['SpearlineApplication']]]);
                    $session->write('has_ivr', $company->has_ivr);
                    $session->write('user_id', $user['id']);
                    $session->write('backendadmin', $user['backendadmin'] ? 1 : 0);
                    $session->write('logged_in', 1);
                    $session->write('company_id', $user['company_id']);
                    $session->write('name', $user['name']);
                    $session->write('email', $user['email']);
                    $session->write('show_benchmarks', isset($company['show_benchmarks']) ? $company['show_benchmarks'] : null);
					$session->write('timezone', $timezone['timezone']);
                    return $this->redirect($this->Auth->redirectUrl());
                } else {
                    $rememberme = $this->Cookie->delete('rememberme');
                }
            }
        }

        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user){
                //save the loging history
                $this->User->saveLoginHistory($user, $this->request);
                $timezone = TableRegistry::get('Timezone')->get($user['timezone_id']);
                $company = $this->User->Company->get($user['company_id'], ['contain' => ['ApplicationForCompany' => ['SpearlineApplication']]]);
                $session->write('has_ivr', $company->has_ivr);
                $session->write('user_id', $user['id']);
                $session->write('backendadmin', $user['backendadmin'] ? 1 : 0);
                $session->write('logged_in', 1);
                $session->write('company_id', $user['company_id']);
                $session->write('name', $user['name']);
                $session->write('email', $user['email']);
                $session->write('show_benchmarks', isset($company['show_benchmarks']) ? $company['show_benchmarks'] : null);
                $session->write('timezone', $timezone['timezone']);
                $this->Auth->setUser($user);
                if ($this->Auth->authenticationProvider()->needsPasswordRehash()) {
                    $user = $this->User->get($this->Auth->user('id'));
                    $user->password = $this->request->data('password');
                    $this->User->save($user);
                }

                if( $this->request->data['rememberme'] ) {
                    $random_string = $this->StringsFunctions->generateRandomString($this->rememberme_token_length);
                    $token = $this->RemembermeToken->newEntity();
                    $token = $this->RemembermeToken->patchEntity($token, ['token' => $random_string, 'user_id' => $user['id'], 'expires_on' => date('Y-m-d H:i:s', strtotime( $this->rememberme_token_validity )), 'ip' => env('REMOTE_ADDR'), 'browser' => env('HTTP_USER_AGENT')]);
                    if($this->RemembermeToken->save($token)) {
                        $this->Cookie->write('rememberme', $random_string . $user['id']);
                    }
                }

                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->set(__('Your username or password is incorrect.'), ['element' => 'login_error']);
        }
        //loaded the the layout like in reportScheduler, replaced the one made by Alex
        $this->viewBuilder()->layout('login');
    }

    public function changePassword($id = null)
    {
        $this->viewBuilder()->layout('only_content');
        if($id != $this->Auth->user('id')) {
            $this->Flash->error('You don\'t have the right to change another user\'s password.');
            return $this->redirect(['action' => 'index']);
        }

        $user = $this->User->get($id);
        if ($this->request->is('post') && !empty($this->request->data)) {
            $user = $this->User->patchEntity($user, [
                    'old_password'  => $this->request->data['old_password'],
                    'password'      => $this->request->data['new_password'],
                    'new_password'     => $this->request->data['new_password'],
                    'confirm_password'     => $this->request->data['confirm_password']
                ],
                ['validate' => 'passwordChanging']
            );
            if ($this->User->save($user)) {
                $this->Flash->set('The password has been successfully changed', ['element' => 'login_success']);
                //$this->redirect(['action' => 'index']);
            } else {
                $errors_string = "";
                if($user->errors() ){
                    foreach ($user->errors() as $k => $err_string) {
                        $errors_string .= " " . Inflector::humanize($k) . " error: ";
                        if(is_array($err_string)){
                            foreach ($err_string as $key => $e_string){
                                $errors_string .= $e_string;
                            }
                        } else {
                            $errors_string .= $err_string;
                        }
                    }
                }
                $this->Flash->error($errors_string);
            }
        }

        $this->set('user',$user);
    }

    public function index()
    {
        $this->paginate = [ "limit" => 12 ];
        if(!$this->user_data->is_spearline)  {
            $comp_array = ['User.company_id' => $this->user_data->company_id];
        } else {
            $comp_array = [];
        }

        $query = $this->User
            ->find('search', ['search' => $this->request->query])
            ->contain(['Company', 'CountryCode', 'Timezone', 'CompanyDepartment', 'CompanyRole', 'UserSession'])
            ->leftJoinWith('CompanyRole')
            ->andWhere($comp_array)
            ->andWhere(['User.status !=' => 2])
            ->group(['User.id'])
            ->order(['User.name' => 'asc']);
        $this->set('user', $this->paginate($query));

        $roles = $this->User->CompanyRole->find('list');
        $this->set('roles', $roles);
        $company = $this->User->Company->find('list');
        $countryCode = $this->User->CountryCode->find('list');
        $timezone = $this->User->Timezone->find('list')->where(['status =' => 1]);
        $companyDepartment = $this->User->CompanyDepartment->find('list', ['conditions' => $comp_array]);
        $this->set(compact('countryCode','company', 'timezone', 'companyDepartment'));
        $this->set('_serialize', ['user']);
    }

    public function changeUserPassword($token = null)
	{
		if (strlen($token) != $this->token_length or !$this->PasswordResetToken->isTokenValid($token)) {
			$this->Flash->error('Invalid token');
			return $this->redirect(['action' => 'index']);
		}

		$token_data = $this->PasswordResetToken->get($token);
		if (!$token_data) {
			$this->Flash->error('Invalid token');
			return $this->redirect(['action' => 'index']);
		}
		else {
		}

		$user_id = $token_data->user_id;
		$user = $this->User->get($user_id);

		// var_dump($user); //var_dump($token_data); die();

		if ($this->request->is('post') && !empty($this->request->data)) {
			$user = $this->User->patchEntity($user, ['password' => $this->request->data['new_password'], 'new_password' => $this->request->data['new_password'], 'confirm_password' => $this->request->data['confirm_password']], ['validate' => 'userPasswordChanging']);
			if ($this->User->save($user)) {

				// invalidate the user tokens

				$this->PasswordResetToken->markTokenAsUsed($token);
				$this->Flash->set('Your password has been reset successfully', ['element' => 'login_success']);
				$this->redirect(['action' => 'login']);
			}
			else {
				$errors_string = "";
				if ($user->errors()) {
					foreach($user->errors() as $k => $err_string) {
						$errors_string.= " <strong>" . Inflector::humanize($k) . " error: </strong>";
						if (is_array($err_string)) {
							foreach($err_string as $key => $e_string) {
								$errors_string.= ' ' . $e_string;
							}
						}
						else {
							$errors_string.= ' ' . $err_string;
						}

						$errors_string.= '<br />';
					}
				}

				$this->Flash->set($errors_string, ['element' => 'login_error']);
			}
		}

		$this->set('user', $user);
		$this->viewBuilder()->layout('change_user_password');
	}

	public function resetUserPassword($userid)
	{
		if (!is_numeric($userid) or $userid <= 0) {
			$this->Flash->error('You don\'t have the right to reset this user\'s password.');
			return $this->redirect(['action' => 'index']);
		}

		$user = $this->User->get($userid);
		if (!$user or !$this->user_data->is_spearline) {
			$this->Flash->error('You don\'t have the right to reset this user\'s password.');
			return $this->redirect(['action' => 'index']);
		}

        $random_string = $this->StringsFunctions->generateRandomString($this->token_length);
		$token = $this->PasswordResetToken->newEntity();
		$token = $this->PasswordResetToken->patchEntity($token, ['token' => $random_string, 'user_id' => $userid, 'expires_on' => date('Y-m-d H:i:s', strtotime($this->token_validity)) , 'added_on' => date('Y-m-d H:i:s') , 'status' => 1, 'added_by' => $this->Auth->user('id') ]);
		if ($this->PasswordResetToken->save($token)) {
			$email = new Email();
			$email->transport('mailgun_smtp');
			$email_settigns = Configure::read('Application.email');
			$email->viewVars(['random_string' => $random_string]);
			$email->viewVars(['user' => $user]);
			try {
				$res = $email->template('admin_password_reset', 'admin_password_reset')->emailFormat('both')->from([$email_settigns['from'] => $email_settigns['from_name']])->to([$user->email => $user->name])->subject('Spearline - Account password reset')->send();
				$this->Flash->success(__('An email with instructions has been sent to the user'));
			} catch(Exception $e) {
				$this->Flash->error(__($e->getMessage()));
			}
		}
		else {
			$this->Flash->error(__('Something went wrong!'));
		}

		return $this->redirect(['action' => 'index']);
		// loaded the default without the nav bar (Alex)
		$this->viewBuilder()->layout('default_alex');
    }

    public function dashboard()
    {
        $this->set('title', 'Dashboard');
    }

    public function forgotPassword()
	{
		if ($this->request->is('post')) {
			$user = $this->User->getUserByEmail($this->request->data['email']);
			if (!$user) {
				$this->Flash->error('You don\'t have the right to reset this user\'s password.');
				return $this->redirect(['action' => 'login']);
			}

			$random_string = $this->StringsFunctions->generateRandomString($this->token_length);
			$token = $this->PasswordResetToken->newEntity();
			$token = $this->PasswordResetToken->patchEntity($token, ['token' => $random_string, 'user_id' => $user->id, 'expires_on' => date('Y-m-d H:i:s', strtotime($this->token_validity)) , 'added_on' => date('Y-m-d H:i:s') , 'status' => 1, 'added_by' => $user->id]);
			if ($this->PasswordResetToken->save($token)) {
				$email_settigns = Configure::read('Application.email');
				$email = new Email();
				$email->transport('mailgun_smtp');
				$email->viewVars(['random_string' => $random_string]);
				$email->viewVars(['user' => $user]);
				try {
					$res = $email->template('forgot_password', 'forgot_password')->emailFormat('html')->from([$email_settigns['from'] => $email_settigns['from_name']])->to([$user->email => $user->name])->subject('Spearline - Account password reset');
					$email->send();

					$this->Flash->set(__('An email with instructions has been sent to your email address') , ['element' => 'login_success']);
				}

				catch(Exception $e) {
					// echo 'Exception : ',  $e->getMessage(), "\n";
					$this->Flash->set(__($e->getMessage()) , ['element' => 'login_error']);
				}
			} else {
				$this->Flash->set(__('Something went wrong!') , ['element' => 'login_error']);
			}
		}

		return $this->redirect(['action' => 'login']);
		// loaded the default without the nav bar (Alex)
		$this->viewBuilder()->layout('default_alex');
	}

    public function view($id = null)
	{
		$user = $this->User->get($id, ['contain' => ['Company', 'CountryCode', 'Timezone', 'CompanyDepartment', 'ParentUser', 'ChildUsers']]);
		if (!$this->user_data->is_spearline && $this->user_data->company_id != $user->company_id) {
			$this->Flash->error('You don\'t have the right to access this data.');
			return $this->redirect(['action' => 'index']);
		}

		$this->set('user', $user);
		$this->set('_serialize', ['user']);
	}

    public function add()
	{
		$this->viewBuilder()->layout('only_content');
		if (!$this->user_data->is_spearline) {
			$comp_array = ['company_id' => $this->user_data->company_id];
			// $user = $this->User->patchEntity($user, );
		} else {
			$comp_array = [];
		}

		$comp_array['created_by'] = $this->Auth->user('id');
		$comp_array['edited_on'] = date('Y-m-d H:i:s');
		$comp_array['created_on'] = date('Y-m-d H:i:s');
		$user = $this->User->newEntity();
		if ($this->request->is('post')) {
			$comp_array['login_name'] = Inflector::camelize($this->request->data['name']);
			$user = $this->User->patchEntity($user, array_merge($this->request->data, $comp_array));
			if ($this->User->save($user)) {
				$random_string = $this->StringsFunctions->generateRandomString($this->token_length);
				$token = $this->PasswordResetToken->newEntity();
				if ($user->timezone_id) {
					$timezone = $this->User->Timezone->get($user->timezone_id);
					$valid_token_text = $this->sameDateDiferentTimeZone(date('Y-m-d H:i:s', strtotime($this->activation_token_validity)) , 'UTC', $timezone->timezone);
					$valid_token_text.= '( ' . $timezone->timezone . ' time )';
				} else {
					$valid_token_text = $this->sameDateDiferentTimeZone(date('Y-m-d H:i:s', strtotime($this->activation_token_validity)) , 'UTC', $timezone->timezone);
					$valid_token_text.= '( UTC time )';
				}

				$token = $this->PasswordResetToken->patchEntity($token, ['token' => $random_string, 'user_id' => $user->id, 'expires_on' => date('Y-m-d H:i:s', strtotime($this->activation_token_validity)) , 'added_on' => date('Y-m-d H:i:s') , 'status' => 1, 'added_by' => ($this->Auth->user('id') ? $this->Auth->user('id') : $user->id) ]);
				if ($this->PasswordResetToken->save($token)) {
					$email = new Email();
					$email->transport('mailgun_smtp');
					$email_settigns = Configure::read('Application.email');
					$email->viewVars(['random_string' => $random_string, 'user' => $user, 'valid_token_text' => $valid_token_text]);
					try {
						$res = $email->template('activate_user_email', 'activate_user_email')->emailFormat('both')->from([$email_settigns['from'] => $email_settigns['from_name']])->to([$user->email => $user->name])->subject(__('Your Spearline account activation'))->send();
					} catch(Exception $e) {
						// echo 'Exception : ',  $e->getMessage(), "\n";
						$this->Flash->error(__($e->getMessage()));
					}
				}
				$this->Flash->success(__('The user has been saved.'));
				return $this->redirect(['action' => 'edit', $user->id]);
			} else {
				$this->Flash->error(__('The user could not be saved. Please, try again.'));
			}
		}

		$company = $this->User->Company->find('list');
		$countryCode = $this->User->CountryCode->find('list');
		$timezone = $this->User->Timezone->find('list')->where(['status =' => 1]);
		$companyDepartment = $this->User->CompanyDepartment->find('list', ['conditions' => $comp_array]);
		$this->set(compact('user', 'company', 'countryCode', 'timezone', 'companyDepartment'));
		$this->set('_serialize', ['user']);
		$this->set('statusArray', [0 => __('Inactive') , 1 => __('Active') ]);
	}

    public function edit($id = null)
	{
		$this->viewBuilder()->layout('only_content');
		$user = $this->User->get($id, ['contain' => []]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			if (!$this->user_data->is_spearline) {
				$comp_array = ['company_id' => $this->user_data->company_id];
				// $user = $this->User->patchEntity($user, );
			} else {
				$comp_array = [];
			}

			$comp_array['created_by'] = $this->Auth->user('id');
			$comp_array['edited_on'] = date('Y-m-d H:i:s');
			$comp_array['login_name'] = Inflector::camelize($this->request->data['name']);
			$user = $this->User->patchEntity($user, array_merge($this->request->data, $comp_array));
			// the following line will be used when we have a login page
			if ($this->User->save($user)) {
				$this->Flash->success(__('The user has been saved.'));
				if ($user->id == $_SESSION['user_id']) {
					$session = $this->request->session();
					$timezone = $this->User->Timezone->get($this->request->data['timezone_id']);
					$session->write('timezone', $timezone->timezone);
				}
				return $this->redirect(['action' => 'edit', $user->id]);
			} else {
				$this->Flash->error(__('The user could not be saved. Please, try again.'));
			}
		}

		$company = $this->User->Company->find('list');
		$countryCode = $this->User->CountryCode->find('list');
		$timezone = $this->User->Timezone->find('list')->where(['status =' => 1]);
		$companyDepartment = $this->User->CompanyDepartment->find('list');
		$this->set(compact('user', 'company', 'countryCode', 'timezone', 'companyDepartment'));
		$this->set('_serialize', ['user']);
		$this->set('statusArray', [0 => __('Inactive') , 1 => __('Active') ]);
	}

    public function delete($id = null)
	{
		$this->request->allowMethod(['post', 'delete']);
		$user = $this->User->get($id);
		$user->status = 2; //updated by Brian so that instead of deleting the row from the database it just sets company status to 2
		if ($this->User->save($user)) {
			$this->Flash->success(__('The user has been deleted.'));
		} else {
			$this->Flash->error(__('The user could not be deleted. Please, try again.'));
		}

		return $this->redirect(['action' => 'index']);
	}

    public function setUserInactive($id = null)
    {
        return $this->changeUserStatus($id, 0);
    }

    public function setUserActive($id = null)
    {
        return $this->changeUserStatus($id, 1);
    }

    protected function changeUserStatus($id = null, $status = 1)
    {
        $this->request->allowMethod(['ajax','get', 'post', 'delete']);
        $user = $this->User->get($id);
        $user->status = $status;  #updated by Brian so that instead of deleting the row from the database it just sets company status to 2
        if ($this->User->save($user)) {
            $this->Flash->success(__('The user status has been changed.'));
        } else {
            $this->Flash->error(__('We cannot do the status change'));
        }
        return $this->redirect($this->referer());
    }

    public function resetSpearlineUserCompany()
	{
		$company = $this->User->Company->get($this->spearlineID, ['contain' => ['ApplicationForCompany' => ['SpearlineApplication']]]);
		$this->request->session()->delete('simulateCompanyID');
		$this->request->session()->delete('was_spearline');
		$this->request->session()->write('show_benchmarks', 0);
		$this->request->session()->write('company_id', $this->spearlineID);
		$this->request->session()->write('has_ivr', $company->has_ivr);
		$this->redirect($this->referer(null, true));
	}

    public function changeSpearlineUserCompany($id = null)
	{
		if (is_numeric($id) && ($this->user_data->is_spearline or $this->user_data->was_spearline) && $this->user_data->is_admin) {
			$company = $this->User->Company->get($id, ['contain' => ['ApplicationForCompany' => ['SpearlineApplication']]]);
			if ($company) {
				$this->request->session()->write('simulateCompanyID', $id);
				$this->request->session()->write('company_id', $id);
				$this->request->session()->write('has_ivr', $company->has_ivr);
				$this->request->session()->write('show_benchmarks', isset($company['show_benchmarks']) ? $company['show_benchmarks'] : null);
				$this->request->session()->write('was_spearline', true);
			}
		}

        $this->redirect($this->referer(null, true));
    }

    function assignRoleToUser($id = null)
	{
		$user = $this->User->get($id, ['contain' => ["Company", "CompanyRole"]]);
		if ($this->user_data->company_id == $user->company_id || $this->user_data->is_spearline) {
			$this->comp_array = ['company_id' => $user->company_id];
		}
		else {
			$this->Flash->error('You don\'t have the right to access this data.');
			return $this->redirect(['action' => 'index']);
		}

		if ($this->request->is(['patch', 'post', 'put'])) {
			$user = $this->User->patchEntity($user, $this->request->data);
			if ($this->User->save($user)) {
				$this->Flash->success(__('Success'));
				return $this->redirect(['action' => 'assignRoleToUser', $id]);
			}
			else {

				// debug($companyRole->errors());

				$this->Flash->error(__('Error'));
			}
		}

		$roles = $this->User->CompanyRole->find('list', ['conditions' => $this->comp_array]);
		$this->set('id', $id);
		$this->set('roles', $roles);
		$this->set('user', $user);
		$this->set('_serialize', ['$user']);
    }
}