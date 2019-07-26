<?php
namespace App\Controller\Api;

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
class UserController extends \App\Controller\UserController
{
    public function add($company_id = null)
    {
        $this->viewBuilder()->layout('only_content');
        $comp_array = [];
        if (!$this->user_data->is_spearline) {
            $comp_array = ['company_id' => $this->user_data->company_id];
            // $user = $this->User->patchEntity($user, );
        } else {
            /*If spearline user and selecting company while adding new user then use that company id or use from its session(own company id)*/
            if(array_key_exists('company_id', $this->request->data) && !empty($this->request->data['company_id'])){
                $comp_array = ['company_id' => $this->request->data['company_id']];
            }else{
                $comp_array = ['company_id' => $this->user_data->company_id];
            }
        }

        $comp_array['created_by'] = $this->Auth->user('id');
        $comp_array['edited_on'] = date('Y-m-d H:i:s');
        $comp_array['created_on'] = date('Y-m-d H:i:s');
        $user = $this->User->newEntity();
        if ($this->request->is('post')) {
            $name = isset($this->request->data['name']) ? $this->request->data['name'] : '';
            $comp_array['login_name'] = Inflector::camelize($name);
            /*Unset company id from request data and use company id which is made in comp_array*/
            if(array_key_exists('company_id', $this->request->data)){
                unset($this->request->data['company_id']);
            }

            /* flag for partial updation */
            $partialUpdate = false;
            $email = isset($this->request->data['email']) ? $this->request->data['email'] : '';

            if($this->request->api){
                /* If api request then check if new entities company is same as logged in user and status is disabled */
                $user = $this->User
                        ->find('all')
                        ->contain(['CountryCode', 'Timezone', 'Role'])
                        ->where(['User.company_id' => $this->user_data->company_id, 'User.email'=> $email, 'User.status' => 2])
                        ->first();
            }else{
                /* If not api request then dont check compnay, only check about email id and status is disabled */
                $user = $this->User
                        ->find('all')
                        ->contain(['CountryCode', 'Timezone', 'Role'])
                        ->where(['User.email'=> $email, 'User.status' => 2])
                        ->first();
            }

            if(!empty($user)) {
                $partialUpdate = true;
            }

            /* If partial update is not true then its new entity adding case, 
            else same entity details are used for add, then just update status to 1 */
            if(empty($partialUpdate)) {
                $user = $this->User->newEntity();
                if($this->request->api){
                    $fieldList = ['fieldList' => ['name', 'company_id', 'country_code_id', 'email', 'sms', 'timezone_id', 'role_id', 'login_name', 'created_by', 'created_on', 'edited_on', 'status']];
                }else{
                    $fieldList = ['fieldList' => ['name', 'company_id', 'country_code_id', 'email', 'sms', 'timezone_id', 'role_id', 'login_name', 'created_by', 'created_on', 'edited_on', 'status', 'api_access']];
                }
                $user = $this->User->patchEntity($user, array_merge($this->request->data, $comp_array), array_merge($fieldList,['validate' => 'api']));
                $status = isset($this->request->data['status']) ? $this->request->data['status'] : '1';
                $user->status = $status; // if status is not available in request then set it to 1 by default (important in case of api)
            }else{
                $user->status = 1;
            }

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
                /* If not api request then only redirect to index action */
                if(!$this->request->api){
            if( $this->after_save_action == 'edit' )
                    return $this->redirect(['action' => 'edit', $user->id]);
                else
                    return $this->redirect(['action' => 'add']);
                }
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }

        $company = $this->User->Company->find('list');
        $countryCode = $this->User->CountryCode->find('list');
        $timezone = $this->User->Timezone->find('list')->where(['status =' => 1]);
        $companyDepartment = $this->User->CompanyDepartment->find('list', ['conditions' => $comp_array]);
        if($this->user_data->is_spearline){
            $role = $this->User->Role->find('list');
        }
        else{
            $role = $this->User->Role->find('list')->where(['company_id' => $this->user_data->company_id])->orWhere(['company_id IS NULL']);
        }
        $this->set(compact('user','company_id', 'company', 'countryCode', 'role', 'timezone', 'companyDepartment'));
        $this->set('_serialize', ['user', 'countryCode', 'role', 'timezone']);
        $this->set('statusArray', [0 => __('Inactive') , 1 => __('Active') ]);
        $this->set('apiAccessArray', [0 => __('No') , 1 => __('Yes') ]);

        /* If api request */
        if($this->request->api){
            if(!empty($user->errors())){
                /* Format error list */
                $finalErrorArray = $this->GlobalFunctions->formatErrors($user->errors());
                $success = false;
                $this->set(['errors' => $finalErrorArray]);
            }else{
                $this->User->loadInto($user, ['CountryCode', 'Timezone', 'Role']);
                $success = true;
            }
            $user = $this->prepareEntityForApi($user);
            $this->set(['success' => $success]);
            $this->set('_serialize', ['success', 'data' => 'user', 'errors']);
        }
    }
    
    public function edit($id = null)
    {
        $this->viewBuilder()->layout('only_content');
        //$user = $this->User->get($id, ['contain' => ['Role']]);

        if($this->request->api){
            $user = $this->User->get($id, [
                    'contain' => ['CountryCode', 'Timezone', 'Role'],
                    /* Check if user is active */
                    'conditions'=>['User.company_id' => $this->user_data->company_id, 'User.status' => 1]
                   ]);
        }else{
            $user = $this->User->get($id);
        }

        if ($this->request->is(['patch', 'post', 'put']) && !empty($this->request->data)) {
            $comp_array = [];
            if (!$this->user_data->is_spearline) {
                $comp_array = ['company_id' => $this->user_data->company_id];
                // $user = $this->User->patchEntity($user, );
            } else {
                /*If spearline user and selecting company while adding new user then use that company id and use from its session(own company id)*/
                if(array_key_exists('company_id', $this->request->data) && !empty($this->request->data['company_id'])){
                    $comp_array = ['company_id' => $this->request->data['company_id']];
                }else{
                    $comp_array = ['company_id' => $this->user_data->company_id];
                }
            }
            $name = isset($this->request->data['name']) ? $this->request->data['name'] : $user->name;
            $comp_array['created_by'] = $this->Auth->user('id');
            $comp_array['edited_on'] = date('Y-m-d H:i:s');
            $comp_array['login_name'] = Inflector::camelize($name);

            /*Unset company id from request data and use company id which is made in comp_array*/
            if(array_key_exists('company_id', $this->request->data)){
                unset($this->request->data['company_id']);
            }

            /*Api access will be in field list only if its not api request*/
            if($this->request->api){
                $fieldList = ['fieldList' => ['name', 'company_id', 'country_code_id', 'email', 'sms', 'timezone_id', 'role_id', 'login_name']];
            }else{
                $fieldList = ['fieldList' => ['name', 'company_id', 'country_code_id', 'email', 'sms', 'timezone_id', 'role_id', 'login_name', 'api_access']];
            }

            $user = $this->User->patchEntity($user, array_merge($this->request->data, $comp_array), array_merge($fieldList,['validate' => 'api']));
            // the following line will be used when we have a login page
            if ($this->User->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                if (isset($_SESSION['user_id']) && $user->id == $_SESSION['user_id']) {
                    $session = $this->request->session();
                    $timezone = $this->User->Timezone->get($this->request->data['timezone_id']);
                    $session->write('timezone', $timezone->timezone);
                }
                /* If not api request then only redirect to index action */
                if(!$this->request->api){
                    return $this->redirect(['action' => 'edit', $user->id]);
                }
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }

        $company = $this->User->Company->find('list');
        $countryCode = $this->User->CountryCode->find('list');
        $timezone = $this->User->Timezone->find('list')->where(['status =' => 1]);
        $companyDepartment = $this->User->CompanyDepartment->find('list');
        $role = $this->User->Role->find('list')->where(['company_id' => $user->company_id])->orWhere(['company_id IS NULL']);
        $this->set(compact('user', 'company', 'countryCode', 'timezone', 'companyDepartment', 'role'));
        $this->set('_serialize', ['user', 'countryCode', 'timezone', 'role']);
        $this->set('statusArray', [0 => __('Inactive') , 1 => __('Active') ]);
        $this->set('apiAccessArray', [0 => __('No') , 1 => __('Yes') ]);

        /* If api request */
        if($this->request->api){
            if(!empty($this->request->data)) {
                if(!empty($user->errors())){
                    /* Format error list */
                    $finalErrorArray = $this->GlobalFunctions->formatErrors($user->errors());
                    $success = false;
                    $this->set(['errors' => $finalErrorArray]);
                }else{
                    $this->User->loadInto($user, ['CountryCode', 'Timezone', 'Role']);
                    $success = true;
                }
            } else {
                /* Format error list */
                $finalErrorArray = $this->GlobalFunctions->formatErrors(array('noData' => 'No Data Found'));
                $success = false;
                $this->set(['errors' => $finalErrorArray]);
            }
            $user = $this->prepareEntityForApi($user);
            $this->set(['success' => $success]);
            $this->set('_serialize', ['success', 'data' => 'user', 'errors']);
        }
    }
}
