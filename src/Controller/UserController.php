<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Mailer\Email;
use Cake\Core\Configure;
use Cake\Utility\Inflector;
use Cake\ORM\TableRegistry;
use Search\Manager;
use Cake\Network\Exception\UnauthorizedException;
use Firebase\JWT\JWT;
use Cake\Utility\Security;
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
        $this->Auth->allow(['login', 'logout', 'forgotPassword', 'changeUserPassword','resetUserPassword', 'token']);
        $this->loadComponent('StringsFunctions');
        $this->loadModel('PasswordResetTokens');
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

    public function index($company_id=null)
    {
        $this->paginate = [ "limit" => 12,'contain' => ['Company','UserSession'],'sortWhitelist'=>['User.name','User.email','User.backendadmin','User.role_id','User.status','Company.name','UserSession.login_time','CompanyDepartment.department'] ];
        $companyFilter = [];
        if(!$this->user_data->is_spearline)  {
            $comp_array = ['User.company_id' => $this->user_data->company_id];
        }
        else {
            $comp_array = [];
        }

        if($company_id){
            $companyFilter = ['User.company_id' => $company_id];
        }

        if(empty($this->request->query['sort'])){
            $this->request->query['sort'] = 'User.name';
            $this->request->query['direction'] = 'asc';
        }


        $query = $this->User
            ->find('search', ['search' => $this->request->query])
            ->contain(['Company', 'CountryCode', 'Timezone', 'CompanyDepartment', 'Role', 'UserSession'])
            ->andWhere($comp_array)
            ->andWhere($companyFilter)
            ->andWhere(['User.status !=' => 2])
            ->group(['User.id']);
        $this->set('user', $this->paginate($query));
        $user = $this->paginate($query);
        $company = $this->User->Company->find('list');
        $countryCode = $this->User->CountryCode->find('list');
        $timezone = $this->User->Timezone->find('list')->where(['status =' => 1]);
        $companyDepartment = $this->User->Company->CompanyDepartment->find('list')->where(['company_id' => $this->user_data->company_id, 'department IS NOT' => '']);
        $this->set(compact('user', 'countryCode','company_id','company', 'timezone', 'companyDepartment'));
        $this->set('_serialize', ['user']);

        /* If api request */
        if($this->request->api){
            /* Traverse on result set for each entity and prepare each entity for api 
            (for getting required fields only through apiFields - defined in Model/Entity) 
            */
            foreach ($user as $entity) {
                $user = $this->prepareEntityForApi($entity);
            }
            $this->set(['success' => true]);
            $this->set('_serialize', ['success', 'data' => 'user']);
        }
    }

    public function export()
    {
        $data = [];
        $status = ["1" => "active", "0" => "inactive"];

        $this->response->download('export.csv');
        $query = $this->User
        ->find('search', ['search' => $this->request->query])
        ->contain(['Company', 'CountryCode', 'Timezone','CompanyDepartment'])
        ->where(['User.company_id =' => $this->user_data->company_id])
        ->where(['User.status !=' => 2]);

        foreach ($query as $row) {
            $data_row = [
                $row->name,
                $row->email,
                ($row->has('company_department') ? $row->company_department->department : ""),
                $row->country_code->country_name,
                ($row->has('timezone') ? $row->timezone->ui_name : ""),
                $row->created_on,
                $row->edited_on,
                ($row->status == 1 ? "Active": "Inactive"),
            ];
            array_push($data, $data_row);
        };
        $_serialize = 'data';
        $_header = ['Name', 'Email', 'Department','Country', 'Timezone', 'Created On', 'Edited On', 'Status'];
        $this->set(compact('data', '_serialize', '_header'));

        $this->viewBuilder()->className('CsvView.Csv');

        return;
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    { 
        $user = $this->User->get($id, [
            'contain' => ['CountryCode', 'Timezone', 'Role'],
            'conditions' => ['User.company_id = ' => $this->user_data->company_id, 'User.status != ' => 2] /* filter by region company and subregion status */
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);

        /* If api request */
        if($this->request->api){
            $user = $this->prepareEntityForApi($user);
            $this->set('user', $user);
            $this->set(['success' => true]);
            $this->set('_serialize', ['success', 'data' => 'user']);
        }
    }

    public function add($company_id = null)
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

            $old_user = $this->User->find('TheOldUser', array_merge($this->request->data, ['company_id' => isset($this->request->data['company_id'])?$this->request->data['company_id']:$this->user_data->company_id]));
            
            if($old_user) {
                if($old_user->status == 2) {

                    $success_message =  __('This user was previously deleted and will receive an email to reactivate their account.');
                    $random_string = $this->StringsFunctions->generateRandomString($this->token_length);
                    $token = $this->PasswordResetTokens->newEntity();
                    if ($old_user->timezone_id) {
                        $timezone = $this->User->Timezone->get($old_user->timezone_id);
                        $valid_token_text = $this->sameDateDiferentTimeZone(date('Y-m-d H:i:s', strtotime($this->activation_token_validity)) , 'UTC', $timezone->timezone);
                        $valid_token_text.= '( ' . $timezone->timezone . ' time )';
                    } else {
                        $valid_token_text = $this->sameDateDiferentTimeZone(date('Y-m-d H:i:s', strtotime($this->activation_token_validity)) , 'UTC', $timezone->timezone);
                        $valid_token_text.= '( UTC time )';
                    }

                    $token = $this->PasswordResetTokens->patchEntity($token, ['token' => $random_string, 'user_id' => $old_user->id, 'expires_on' => date('Y-m-d H:i:s', strtotime($this->activation_token_validity)) , 'added_on' => date('Y-m-d H:i:s') , 'status' => 1, 'added_by' => ($this->Auth->user('id') ? $this->Auth->user('id') : $old_user->id) ]);
                    if ($this->PasswordResetTokens->save($token)) {
                        $email = new Email();
                        $email->transport('mailgun_smtp');
                        $email_settigns = Configure::read('Application.email');
                        $email->viewVars(['random_string' => $random_string, 'user' => $old_user, 'valid_token_text' => $valid_token_text]);
                        try {
                            $res = $email->template('activate_user_email', 'activate_user_email')->emailFormat('both')->from([$email_settigns['from'] => $email_settigns['from_name']])->to([$old_user->email => $old_user->name])->subject(__('Your Spearline account activation'))->send();
                        } catch(Exception $e) {
                            // echo 'Exception : ',  $e->getMessage(), "\n";
                            $this->Flash->error(__($e->getMessage()));
                        }
                    }

                    //after trying to add the same user again, change the status to 1 = active
                    $old_user->status = 1;
                    if ($this->User->save($old_user)) {
                        $this->Flash->success(__('This user was previously deleted and will receive an email to reactivate their account.'));
                    } else {
                        $this->Flash->error(__('This user was previously deleted and the user could not be reactivated. Please, try again.'));
                    }
                    return $this->redirect(['action' => 'edit', $old_user->id ]);

                } else {
                    $this->Flash->error(__('The user already exist!'));
                    return $this->redirect(['action' => 'edit', $old_user->id ]);
                }
            }

			$comp_array['login_name'] = Inflector::camelize($this->request->data['name']);
            #check if department exists

            if ($this->request->data['department']) {
                $this->loadModel('CompanyDepartment');
                $department = $this->CompanyDepartment->find('list')->where(['company_id =' => $this->user_data->company_id, 'status'=> 1,'department LIKE' => trim($this->request->data['department'])])->first();
    
                if (!$department) {
                    $departmentTable = TableRegistry::get('CompanyDepartment');
                    $newDepartment = $departmentTable->newEntity();
                    $newDepartment->department = strtolower(trim($this->request->data['department']));
                    $newDepartment->company_id = $this->user_data->company_id;
                    $newDepartment->status = 1;
                    if ($departmentTable->save($newDepartment)) {
                        $department_id = $newDepartment->id;
                    }
                }
                $user->department_id = isset($department->id)?$department->id:$department_id;
            }

			$user = $this->User->patchEntity($user, array_merge($this->request->data, $comp_array));
			if ($this->User->save($user)) {
				$random_string = $this->StringsFunctions->generateRandomString($this->token_length);
				$token = $this->PasswordResetTokens->newEntity();
				if ($user->timezone_id) {
					$timezone = $this->User->Timezone->get($user->timezone_id);
					$valid_token_text = $this->sameDateDiferentTimeZone(date('Y-m-d H:i:s', strtotime($this->activation_token_validity)) , 'UTC', $timezone->timezone);
					$valid_token_text.= '( ' . $timezone->timezone . ' time )';
				} else {
					$valid_token_text = $this->sameDateDiferentTimeZone(date('Y-m-d H:i:s', strtotime($this->activation_token_validity)) , 'UTC', $timezone->timezone);
					$valid_token_text.= '( UTC time )';
				}

				$token = $this->PasswordResetTokens->patchEntity($token, ['token' => $random_string, 'user_id' => $user->id, 'expires_on' => date('Y-m-d H:i:s', strtotime($this->activation_token_validity)) , 'added_on' => date('Y-m-d H:i:s') , 'status' => 1, 'added_by' => ($this->Auth->user('id') ? $this->Auth->user('id') : $user->id) ]);
				if ($this->PasswordResetTokens->save($token)) {
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
				//return $this->redirect(['action' => 'edit', $user->id]);
        if( $this->after_save_action == 'edit' )
          return $this->redirect(['action' => 'edit', $user->id]);
        else
          return $this->redirect(['action' => 'add']);
			} else {
				$this->Flash->error(__('The user could not be saved. Please, try again.'));
			}
		}

		$company = $this->User->Company->find('list')->order(['name'=>'ASC']);
		$countryCode = $this->User->CountryCode->find('list');
		$timezone = $this->User->Timezone->find('list')->where(['status =' => 1]);
		$companyDepartment = $this->User->Company->CompanyDepartment->find('list')->where(['company_id' => $this->user_data->company_id, 'department IS NOT' => '', 'status'=>1]);
        if($this->user_data->is_spearline){
            $role = $this->User->Role->find('list');
        }
        else{
            $role = $this->User->Role->find('list')->where(['company_id' => $this->user_data->company_id])->orWhere(['company_id IS NULL']);
        }

        $this->set(compact('user','company_id', 'company', 'countryCode', 'role', 'timezone', 'companyDepartment'));
        $this->set('_serialize', ['user']);
        $this->set('statusArray', [0 => __('Inactive') , 1 => __('Active') ]);
        $this->set('apiAccessArray', [0 => __('No') , 1 => __('Yes') ]);
    }

    public function edit($id = null)
    {
        $this->viewBuilder()->layout('only_content');
        if ($this->user_data->company_id == 8) { #check if spearline user so that they can edit any users info
            $user = $this->User->get($id, [
                'contain' => ['Role']
            ]);
        }
        else{
            $user = $this->User->get($id, [
                'conditions' => ['User.company_id' => $this->user_data->company_id],
                'contain' => ['Role']
            ]);
        }
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

            #check if department exists

            if ($this->request->data['department']) {
                $this->loadModel('CompanyDepartment');
                $department = $this->CompanyDepartment->find('all')->where(['company_id =' => $this->user_data->company_id, 'status'=> 1,'department LIKE' => trim($this->request->data['department'])])->first();

    
                if (!$department) {
                    $departmentTable = TableRegistry::get('CompanyDepartment');
                    $newDepartment = $departmentTable->newEntity();
                    $newDepartment->department = strtolower(trim($this->request->data['department']));
                    $newDepartment->company_id = $this->user_data->company_id;
                    $newDepartment->status = 1;
                    if ($departmentTable->save($newDepartment)) {
                        $department_id = $newDepartment->id;
                    }
                }
                $user->department_id = isset($department->id)?$department->id:$department_id;
            }

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

		$company = $this->User->Company->find('list')->order('name');
		$countryCode = $this->User->CountryCode->find('list');
		$timezone = $this->User->Timezone->find('list')->where(['status =' => 1]);
		$companyDepartment = $this->User->Company->CompanyDepartment->find('list')->where(['company_id' => $user->company_id, 'department IS NOT' => '','status'=>1]);
		$role = $this->User->Role->find('list')->where(['company_id' => $user->company_id])->orWhere(['company_id IS NULL'])->order('name');
		$this->set(compact('user', 'company', 'countryCode', 'timezone', 'companyDepartment', 'role'));
		$this->set('_serialize', ['user']);
		$this->set('statusArray', [0 => __('Inactive') , 1 => __('Active') ]);
        $this->set('apiAccessArray', [0 => __('No') , 1 => __('Yes') ]);
	}

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        if($this->request->api){
            $user = $this->User->get($id, [
                    /* Check if user is active */
                    'conditions'=>['company_id' => $this->user_data->company_id, 'status' => 1]
                   ]);
        }else{
            $user = $this->User->get($id);
        }
        
        $user->status = 2; //updated by Brian so that instead of deleting the row from the database it just sets company status to 2
        if ($this->User->save($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        /* If not api request then only redirect to index action */
        if(!$this->request->api){
            return $this->redirect(['action' => 'index']);
        } else {
            if(!empty($user->errors())) {
                /* Format error list */
                $finalErrorArray = $this->GlobalFunctions->formatErrors($user->errors());
                $success = false;
                $this->set(['errors' => $finalErrorArray]);
            } else{
                $success = true;
            }
            $user = $this->prepareEntityForApi($user);
            $this->set(['success' => $success, 'user'=>$user]);
            $this->set('_serialize', ['success', 'data' => 'user', 'errors']);
        }
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

        // Removes the directories/templates created for the user when navigating the management reports admin section (if any).

        $session->write('user_id', false);
        $session->write('logged_in', false);
        $session->delete('backendadmin');
        $session->delete('timezone');
        $session->delete('name');
        $session->delete('email');
        $session->delete('company_id');
        $session->delete('_ViewedTemplates');
        $session->delete('_indexConditions');
        $this->Flash->set(__('You are now logged out.'), ['element' => 'login_success']);
        $rememberme = $this->Cookie->delete('rememberme');
        return $this->redirect($this->Auth->logout());
    }

    public function login()
    {
        $session = $this->request->session();
        // $user_id = $session->read('user_id');
        // if(!is_null($user_id) and is_numeric($user_id) and $user_id > 0) {
        //     $user =  $this->User->find()->where(['User.id'=> $user_id])->leftJoinWith('Company');
        //     if ($user) {
        //         $this->Auth->setUser($user->toArray());
        //         return $this->redirect($this->Auth->redirectUrl());
        //     }
        // }

        $rememberme = $this->Cookie->read('rememberme');
        if($rememberme) {
            $token = $this->RemembermeToken->getTokenData(substr($rememberme, 0, $this->rememberme_token_length));
            $user_id = substr($rememberme, $this->rememberme_token_length);
            if(!is_null($user_id) and is_numeric($user_id) and $user_id > 0 and $token) {
                $user =  $this->User->get($user_id);
                if ($user and  $this->RemembermeToken->validateToken($token, $user_id)) {
                    $this->Auth->setUser($user->toArray());
                    $timezone = TableRegistry::get('Timezone')->get($user['timezone_id']);
                    $company = $this->User->Company->get($user['company_id'], ['contain' => ['CompanyExtension','ApplicationForCompany' => ['SpearlineApplication']]]);
                    $session->write('has_ivr', $company->has_ivr);
                    $session->write('has_gsm', $company->company_extension->has_gsm);
                    $session->write('management_report_access', $company->company_extension->management_report_access);
                    $session->write('user_id', $user['id']);
                    $session->write('backendadmin', $user['backendadmin'] ? 1 : 0);
                    $session->write('logged_in', 1);
                    $session->write('company_id', $user['company_id']);
                    $session->write('company_name', $company['name']);
                    $session->write('name', $user['name']);
                    $session->write('email', $user['email']);
                    $session->write('show_benchmarks', isset($company['show_benchmarks']) ? $company['show_benchmarks'] : null);
                    $session->write('timezone', $timezone['timezone']);
                    $session->write('timezone_ui_name', $timezone['ui_name']);
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
                $company = $this->User->Company->get($user['company_id'], ['contain' => ['CompanyExtension','ApplicationForCompany' => ['SpearlineApplication']]]);
                $session->write('has_ivr', $company->has_ivr);
                // $session->write('has_gsm', isset($company['company_extension'])?$company->company_extension->has_gsm:null);
		        // $session->write('management_report_access', isset($company['company_extension'])?$company->company_extension->management_report_access : null);
                $session->write('user_id', $user['id']);
                $session->write('backendadmin', $user['backendadmin'] ? 1 : 0);
                $session->write('logged_in', 1);
                $session->write('company_id', $user['company_id']);
                $session->write('company_name', $company['name']);
                $session->write('name', $user['name']);
                $session->write('email', $user['email']);
                $session->write('show_benchmarks', isset($company['show_benchmarks']) ? $company['show_benchmarks'] : null);
                $session->write('timezone', $timezone['timezone']);
                $session->write('timezone_ui_name', $timezone['ui_name']);
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

    public function changeUserPassword($token = null)
    {
        if (strlen($token) != $this->token_length or !$this->PasswordResetTokens->isTokenValid($token)) {
            $this->Flash->error('Invalid token');
            return $this->redirect(['action' => 'index']);
        }

        $token_data = $this->PasswordResetTokens->get($token);
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

                $this->PasswordResetTokens->markTokenAsUsed($token);
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
        $token = $this->PasswordResetTokens->newEntity();
        $token = $this->PasswordResetTokens->patchEntity($token, ['token' => $random_string, 'user_id' => $userid, 'expires_on' => date('Y-m-d H:i:s', strtotime($this->token_validity)) , 'added_on' => date('Y-m-d H:i:s') , 'status' => 1, 'added_by' => $this->Auth->user('id') ]);
        if ($this->PasswordResetTokens->save($token)) {
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

    public function dashboard($dashboard_app = null)
    {
        $apps = ['dashboard', 'ivrtreeview', 'map'];
        if(!$dashboard_app or !in_array($dashboard_app, $apps)) {
        $dashboard_app = 'dashboard';
        }

        $this->set('app', $dashboard_app);
        $this->set('title', 'Dashboard');
    }

    public function managementReports()
    {
        $this->loadModel('MrepReport');
        $this->loadModel('MrepFilter');
        $reports = [];
        $filterNames = [];
        $mrep_developers = Configure::read('Application.mrep_developers');
        if( is_array($mrep_developers) and in_array($this->user_data->id, $mrep_developers )) {
            $cond  = ['status >=' => 1];
        } else {
            $cond = ['status' => 1];
        }
        $mrepReports = $this->MrepReport->find('all', ['fields' => ['tag', 'report'], 'conditions' => $cond])->toArray();
        foreach ($mrepReports as $mrepReport) {
            $reports[$mrepReport['tag']] = $mrepReport['report'];
        }

        $filterString = "";
        $period = "";
        $report_selected = $this->request->getCookie('selectedMrep');
        if(!$report_selected) $report_selected = 'country-benchmark/index';

        $mrepFilters = $this->MrepFilter->find('all', ['fields' => ['MrepFilter.filter']])->join(array('table' => 'mrep_report', 'alias' => 'MrepReport', 'type' => 'LEFT', 'conditions' => 'MrepFilter.report_id = MrepReport.id'))->where(['MrepReport.tag' => $report_selected]);
        foreach ($mrepFilters as $mrepFilter) {
            if (!in_array($mrepFilter['filter'], $filterNames)) {
                array_push($filterNames, $mrepFilter['filter']);
            }
        }

        //Gets any parameters from the main URL and adds them to filter string
        foreach ($filterNames as $filter) {
            if ($this->request->query($filter)) {
                if ($filter == "period") {
                    $period = $this->request->query($filter);
                }
                $filterString .= $filter . "=" . $this->request->query($filter) . "&";
            }
        }

        if ($this->request->query("report")) {
            $report_selected = $this->request->query("report");
        }
        //If it is a spearline user and they came from the email, temporarily change the company ID
        if ($this->user_data->is_spearline) {
            $url = $_SERVER["REQUEST_URI"];
            $encryptedString=substr($url, strrpos($url, '&') + 1);
            $decryptedString=openssl_decrypt(rawurldecode($encryptedString),"AES-128-ECB","MREncryptionParam");
            $decryptedStringSplit = explode("=", $decryptedString);
            if ($decryptedStringSplit[0] == "company_id") {
                $this->request->session()->write('simulateCompanyID', $decryptedStringSplit[1]);
                $this->request->session()->write('company_id', $decryptedStringSplit[1]);
                $this->request->session()->write('was_spearline', true);
            }
        }

        //Constructs the url to be used for the iframe
        $iframeURL = "/ManagementReports/" . $report_selected . "/" . $period . "/?" . $filterString;

        // $iframeURL = 'https://mrep-dev.spearline.com/ManagementReports/' . $report_selected . '/' . $period . "/?" . $filterString;

        $iframebase = "/ManagementReports/";
        // $iframebase = 'https://mrep-dev.spearline.com/ManagementReports/';
        $ifame_middle = '/index/';
        $iframfefilter = $period . '/?' . $filterString;

        $this->set('reports', $reports);
        $this->set('iframeURL', $iframeURL);
        $this->set('iframebase', $iframebase);
        $this->set('ifame_middle', $ifame_middle);
        $this->set('iframfefilter', $iframfefilter);
        $this->set('title', 'Management Reports');
        $this->set('contact_form', false);
        $this->set('has_ivr', $this->request->session()->read('has_ivr'));
        $this->set('report_selected', $report_selected);
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
            $token = $this->PasswordResetTokens->newEntity();
            $token = $this->PasswordResetTokens->patchEntity($token, ['token' => $random_string, 'user_id' => $user->id, 'expires_on' => date('Y-m-d H:i:s', strtotime($this->token_validity)) , 'added_on' => date('Y-m-d H:i:s') , 'status' => 1, 'added_by' => $user->id]);
            if ($this->PasswordResetTokens->save($token)) {
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
        $company = $this->User->Company->get($this->spearlineID, ['contain' => ['CompanyExtension','ApplicationForCompany' => ['SpearlineApplication']]]);
        $this->request->session()->delete('simulateCompanyID');
        $this->request->session()->delete('was_spearline');
        $this->request->session()->write('show_benchmarks', 0);
        $this->request->session()->write('company_id', $this->spearlineID);
        $this->request->session()->write('company_name', $company['name']);
        $this->request->session()->write('has_ivr', $company->has_ivr);
        $this->request->session()->write('has_gsm', $company->company_extension->has_gsm);
	    $this->request->session()->write('management_report_access',  $company->has('company_extension') && $company->company_extension->management_report_access);
        $this->redirect($this->referer(null, true));
    }

    public function changeSpearlineUserCompany($id = null)
    {
        if (is_numeric($id) && ($this->user_data->is_spearline or $this->user_data->was_spearline) && $this->user_data->is_admin) {
            $company = $this->User->Company->get($id, ['contain' => ['CompanyExtension','ApplicationForCompany' => ['SpearlineApplication']]]);
            $spearline = $this->User->Company->get($this->spearlineID, ['contain' => ['CompanyExtension','ApplicationForCompany' => ['SpearlineApplication']]]);
            if ($company) {
                $this->request->session()->write('simulateCompanyID', $id);
                $this->request->session()->write('company_id', $id);
                $this->request->session()->write('company_name', $company['name']);
		        $this->request->session()->write('has_ivr', $company->has_ivr);
                $this->request->session()->write('has_gsm', $company->has('company_extension') && $company->company_extension->has_gsm);
                $this->request->session()->write('management_report_access', $spearline->company_extension->management_report_access);
                $this->request->session()->write('show_benchmarks', isset($company['show_benchmarks']) ? $company['show_benchmarks'] : null);
                $this->request->session()->write('was_spearline', true);
            }
        }

        $this->redirect($this->referer(null, true));
    }

    /**
     * Token method
     *
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When user not found.
     * Displays a token if the user is identified. User can use this token to access the api.
     */
    public function token()
    {
        $user = $this->Auth->identify();

        if (!$user) {
            throw new UnauthorizedException('Invalid username or password');
        }

        $this->set([
            'success' => true,
            'data' => [
                'token' => JWT::encode([
                    'sub' => $user['id'],
                    'exp' =>  time() + 604800
                ],
                Security::salt())
            ],
            '_serialize' => ['success', 'data']
        ]);
    }
}
