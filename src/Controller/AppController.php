<?php
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\I18n\Time;
use App\Form\ContactForm;
use Cake\Routing\Router;
use Cake\Utility\Inflector as Inflector;
use Cake\Http\ServerRequest;

class AppController extends Controller
{

    public function initialize()
    {
        parent::initialize();
        $this->request->trustProxy = true;
        $this->loadComponent('Cookie');
        $session_conf = Configure::read('Session.ini', array('session.cookie_path' => '/', 'session.cookie_domain' => ''));
        $this->Cookie->config('path', $session_conf['session.cookie_path']);
        $this->Cookie->config('domain', $session_conf['session.cookie_domain']);
        $this->Cookie->config([
            'expires' => '+10 days',
            'httpOnly' => false
        ]);

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');

        /* Auth component for login */
        if(strpos($this->request->prefix, 'api') !== false)
            $this->request->api = true;

        if($this->request->api){
            $this->loadComponent('ApiPagination',[
            'visible' => [
                'page',
                'current',
                'count',
                'perPage',
                'prevPage',
                'nextPage',
                'pageCount',
                'sort',
                'direction',
                'limit'
            ]
        ]);
            $this->loadComponent('GlobalFunctions');
            $this->loadComponent('Auth', [
                'storage' => 'Memory',
                'authenticate' => [
                    'Form' => [
                        'fields' => [
                            'username' => 'email',
                            'password' => 'password'
                        ],
                        'userModel'=>'user',
                        'finder' => ['auth' => ['is_api' => 1]],
                        'passwordHasher' => [
                            'className' => 'Fallback',
                            'hashers' => ['Default','Spearlinepsswd']
                        ],
                        'scope' => ['user.status' => 1, 'user.api_access' => 1]
                    ],
                    'ADmad/JwtAuth.Jwt' => [
                        'parameter' => 'token',
                        'userModel' => 'user',
                        'scope' => ['user.status' => 1, 'user.api_access' => 1],
                        'fields' => [
                            'username' => 'id'
                        ],
                        'queryDatasource' => true
                    ]
                ],
                'unauthorizedRedirect' => false
            ]);
        }
        else{
        $this->loadComponent('Auth', [
            'authorize'=> 'Controller',
            'flash' => ['element' => 'authError'],
            'authenticate' => [
                'Form' => [
                    'fields' => [
                        'username' => 'email',
                        'password' => 'password'
                    ],
                    'userModel'=>'user',
                        'finder' => ['auth' => ['is_api' => 0]],
                        'scope' => ['user.status' => 1],
                    'passwordHasher' => [
                        'className' => 'Fallback',
                        'hashers' => ['Default','Spearlinepsswd']
                    ]
                ],
            ],
            'loginAction' => [
                'controller' => 'User',
                'action' => 'login'
            ],
            'unauthorizedRedirect' => $this->referer()
        ]);
        }
        
        if($this->request->api){
			$user = $this->Auth->identify();
			if ($user){
				$this->Auth->setUser($user);
			}
		}
        
        //$this->Auth->allow([]);

        $this->request->trustProxy = true;

        $this->spearlineID = intval(Configure::read('Application.company.spearlineID'));
        $this->loadModel('User');

        if($this->Auth->user('id')) {
            $this->user_data = $this->User->get(
                $this->Auth->user('id'),
                [
                    'contain' =>
                    [
                        'Company'=>
                        [
                            'ApplicationForCompany'=>[
                                'SpearlineApplication'
                            ],
                            'TestTypeForCompany',
                            'CompanyExtension'
                        ],
                        'Timezone',
                        'Role' => [
                            'Right' => ['PlatformAction' =>'PlatformController']
                        ]
                    ]
                ]
            );
            $this->user_data->user_access = [];
            if($this->user_data->has('role')) {
                foreach($this->user_data->role->right as $right) {
                    foreach($right->platform_action as $action_) {
                        $controller_ = $action_->platform_controller;
                        $this->user_data->user_access[$controller_->name][] = $action_->name;
                    }
                }
                //clear some memory for user data
                unset($this->user_data->role);
            }

            if($this->user_data->company_id == $this->spearlineID){
                $this->user_data->is_spearline = true;
            } else {
                $this->user_data->is_spearline = false;
            }
            if( $this->user_data->backendadmin ) {
                $this->user_data->is_admin = true;
            } else {
                $this->user_data->is_admin = false;
            }

            $session = $this->request->session();
            if($session->read('simulateSLDemo')) {
                $session->delete('simulateSLDemo');
                $session->write('company_id', $this->user_data->company_id);
            }

            $company_selector_status = Configure::read('Application.company_selector');

            //change company for a Spearline User
            if($company_selector_status and $this->user_data->is_spearline == true) {
                $this->loadModel('Company');
                $companies = $this->Company->listActiveCompanies();
                $scpid = $session->read('simulateCompanyID');

                if($scpid) {
                    $this->user_data->company_id = $scpid;
                    $this->user_data->company = $this->Company->get($scpid, ['contain' =>['ApplicationForCompany'=>['SpearlineApplication'], 'TestTypeForCompany', 'CompanyExtension']]);
                    $this->user_data->is_spearline = false;
                    $this->user_data->was_spearline = true;
                }
                $this->set('companiesList', $companies);
            }

            $this->set('company_selector_status', $company_selector_status);

            //get the extra fields
            $this->loadModel('NumberFieldNameForCompany');
            $this->user_data->extraFields = $this->NumberFieldNameForCompany->find('all')->where(['company_id =' => $this->user_data->company_id])->first();
            //calculate if the user company have automated testing or not
            $this->user_data->have_automated_testing = $this->User->Company->isAutomated($this->user_data->company_id);
            $this->user_data->have_manual_testing = $this->User->Company->isManualAllowed($this->user_data->company_id);

            //log the user activity
            $this->logUserAction();

            //redirect to Manual testing for manual only companies
            if(! $this->user_data->have_automated_testing and $this->name == 'User' and $this->request->getParam('action') == 'dashboard') {
                $this->redirect(['controller' => 'ManualTesting', 'action' => 'index']);
            }
         
            $this->set('logged_user', $this->user_data);
            Configure::write('user_data.company_id', $this->user_data->company_id);
            Configure::write('user_data.id', $this->user_data->id);
            if($session->read('has_gsm')) {
            $this->set('rolling_type', [0 => __('PSTN'), 1 => __('GSM')]);
            }
            else{
                $this->set('rolling_type', [0 => __('PSTN')]);
            }
        } else {

        }

        $this->set('boolean', [0 => __('False'), 1 => __('True')]);
        $this->set('reportType', [1 => __('PDF'), 2 => __('CSV')]);
        $this->set('statusArray', [0 => __('Inactive'), 1 => __('Active'), 2 => __('Deleted')]);
        $this->set('campaignStatusArray', [0 => __('Deleted'), 1 => __('Running'), 2 => __('Stopped'), 3 => __('Draft'), 4 => __('Paused')]);
        $this->set('companyStatus', [0 => __('Inactive'), 1 => __('Active'), 2 => __('Deleted'), 3 => __('POC')]);
        $this->set('running', [1 => __('Running'), 2 => __('Stopped'), 3 => __('Draft')]);
        $this->set('intervalArray', [1 => __('Day'), 2 => __('Month'), 3 => __('Year')]);
        $this->set('backendadmin', [0 => __('No'), 1 => __('Yes')]);
        $this->set('followupStatus', [1 => __('Did not send report'), 2 => __('Sent report')]);
        $this->applicationDefaultTimeZone = Configure::read('Application.defaultTimezone');
        $this->set('applicationDefaultTimeZone', $this->applicationDefaultTimeZone);

        //for the moment without minutely interval
        //$this->scheduleTypeArray = ['now' => 'Now','once' => 'Once', 'minutely' => 'Every Minute', 'hourly' => 'Hourly', 'daily' => 'Daily', 'monthly' => 'Monthly', 'yearly' => 'Yearly'];
        $this->scheduleTypeArray = ['now' => 'Now','once' => 'Once', 'hourly' => 'Hourly', 'daily' => 'Daily', 'weekly' => 'Weekly', 'monthly' => 'Monthly', 'yearly' => 'Yearly'];
        $this->reportTypeArray = ['1' => 'PDF','2' => 'CSV'];

        if($this->Auth->user('id')) {
            $left_menu = $this->getMenu();
            $adminz_menu = $this->getAdminzMenu();
            $top_menu = $this->getTopMenu();
            $this->set('left_menu', $left_menu);
            $this->set('adminz_menu', $adminz_menu);
            $this->set('top_menu', $top_menu);
        }

        // $this->loadModel('SpearlineNotification');
        // $top_bar_notifications_no = intval(Configure::read('Application.user.top_bar_notifications_no'));
        // $ids = $this->Cookie->read('Notifications.read');
        // $notifications = $this->SpearlineNotification->getUserUnreadNotifications($ids, $top_bar_notifications_no);
        // $this->set('notifications', $notifications);

        // $contact = new ContactForm();
        // $this->set('contact', $contact);
        // if($this->user_data)
        //     Configure::write('user_data.company_id', $this->user_data->company_id);

        // after save action
        if($this->request->is('post')) {
          $this->Cookie->write('after_save_action', $this->request->getData('after_save_action') == 'edit' ? 'edit' : 'new_element');
        }
        $this->after_save_action = $this->Cookie->read('after_save_action') == 'edit' ? 'edit' : 'new_element';
        $this->set('after_save_action', $this->after_save_action);
    }

    public function isAuthorized($user)
    {
        if(!isset($this->user_data)) {
            return true;
        }
;
        //let developers to do everything
        if(in_array($this->user_data->id, Configure::read('Application.developers'))) {
          return true;
        }

        $action_name = $this->request->getParam('action');
        $controller_name = $this->request->getParam('controller');

        if($controller_name == "ManualTesting" and !$this->user_data->have_manual_testing) {
            return false;
        }

        $manual_only_maximum_access_controller = [
            'User',
            'ManualTesting',
            'IvrTraversal',
            'ProviderCliRange',
            'Tutorials',
            'Contact'
        ];

        if(!$this->user_data->have_automated_testing and !in_array( $controller_name, $manual_only_maximum_access_controller )) {
            return false;
        }

        $only_staff = [
            'Controllers' => [
                    'Company','Alerts', 'PlatformController', 'PlatformAction',
                ],
            'Actions' => [
                'Company' => '*',
                'Alerts' => '*',
                'PlatformController' => '*',
                'PlatformAction' => '*',
            ]
        ];
        if( in_array( $controller_name, $only_staff['Controllers'] ) and ( $only_staff['Actions'][$controller_name] === '*' or in_array( $action_name, $only_staff['Actions'][$controller_name] )) and ( ! $this->user_data->is_spearline or ! $this->user_data->is_admin ) ) {
            //die('nu trebuie');
            return false;
        }

        if(!isset($this->user_data->user_access) or !is_array($this->user_data->user_access) or empty($this->user_data->user_access or !count($this->user_data->user_access))) {
            die('Contact an administrator, is something wrong with your user role!');
        }


        if(array_key_exists($controller_name, $this->user_data->user_access)) {
            if( in_array($action_name, $this->user_data->user_access[$controller_name]) ) {
                // die('merge');
                return true;
            } else {

                if( strpos( $this->referer(), 'login' )) {
                    reset( $this->user_data->user_access );
                    $c = key( $this->user_data->user_access );
                    $a = $this->user_data->user_access[$c][0];
                    $this->redirect(['controller' => $c, 'action' => $a]);
                }

                $this->request->session()->write('unauthorized', 1);
                return false;
            }
        } else {

            //if($controller_name == 'User' and $action_name == 'dashboard' and strpos( $this->referer(), 'login' )) {
            if( strpos( $this->referer(), 'login' )) {
                reset( $this->user_data->user_access );
                $c = key( $this->user_data->user_access );
                $a = $this->user_data->user_access[$c][0];
                $this->redirect(['controller' => $c, 'action' => $a]);
            }
           
            $this->request->session()->write('unauthorized', 1);
            return false;
        }


        return true;
    }

    /**
    * Before render callback.
    *
    * @param \Cake\Event\Event $event The beforeRender event.
    * @return void
    */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) && in_array($this->response->type(), ['application/json', 'application/xml'])) {
            $this->set('_serialize', true);
        }
        $this->set('Inflector', new Inflector);
    }


    public function beforeFilter(Event $event)
    {
        if (!$this->Auth->user()) {
            $this->Auth->config('authError', false);
        }
    }

    public function afterFilter(Event $event)
    {
        //change http status code for a json api response that contains errors
        if($this->request->api && $this->response->type() == 'application/json'){
            $body = json_decode($this->response->body());
            if (isset($body->success) && isset($body->errors)) {
                if (!$body->success && $body->errors && $this->response->getStatusCode() == 200 ){
                    $this->response = $this->response->withStatus(400);
                }
            }
        }

        if($this->request->api){
            $this->log(['request'=>$this->request, 'response'=>$this->response, 'user'=>$this->user_data], 'debug', ['scope'=>['api']]);
        }
    }
    //Date and Time functions

    public function sameDateDiferentTimeZone($date, $inTimeZone, $outTimeZone, $format = 'yyyy-MM-dd HH:mm:ss')
    {
        $dateObj = new Time($date, $inTimeZone);
        return $dateObj->i18nFormat($format, $outTimeZone);
    }

    public function applicationDate($date)
    {
        if(is_null($date)) {
            return false;
        } elseif (substr($date, 0, 10) == '0000-00-00') {
            return '0000-00-00 00:00:00';
        }
        return $this->sameDateDiferentTimeZone($date, $this->user_data->timezone_string, $this->applicationDefaultTimeZone, 'yyyy-MM-dd HH:mm:ss');
    }

    public function userDate($date)
    {
        if(is_null($date))
        {
            return false;
        }
        return $this->sameDateDiferentTimeZone($date, $this->applicationDefaultTimeZone, $this->user_data->timezone_string, 'yyyy-MM-dd HH:mm:ss');
    }

    public function applicationTime($time)
    {
        $date = date('Y-m-d') . ' ' . $time;
        $newDate = $this->applicationDate($date);

        return substr($newDate, -8);
    }

    public function userTime($time)
    {
        $date = date('Y-m-d') . ' ' . $time;
        $newDate = $this->userDate($date);

        return substr($newDate, -8);
    }

    private function getMenu()
    {
        $action_name = $this->request->getParam('action');
        $controller_name = $this->request->getParam('controller');

        $left_menu_controllers = [
            'Campaign' => [
                'Campaign', 'CampaignTimeGroup', 'CampaignForIvr'
            ],
            'Number' => [
                'Number', 'IvrTraversal', 'BridgeDdi', 'Passcode', 'NumberTimeGroup', 'OutboundBridgeDdi'
            ],
            'ReportSchedule' => [
                'ReportSchedule', 'Dashboard'
            ],
            'User' => [
                'User'
            ],
            'ProviderCliRange' => [
                'ProviderCliRange', 'Tutorials'
            ],
            'ManualTesting' => [
                'ManualTesting'
            ],
            'Idial' => [
                'Idial'
            ],
        ];

        $left_menu = [
                        'Automated' => [
                            'submenu' => [
                                ['controller' => 'User', 'action' => 'dashboard', 'icon' => '<i class="fa fa-dashboard"></i>', 'title' => 'Dashboard', 'actions' => ['dashboard']],
                                ['controller' => 'Number', 'action' => 'index', 'icon' => '<i class="fa fa-phone"></i>', 'title' => 'Numbers'],
                                ['controller' => 'Campaign', 'action' => 'index', 'icon' => '<i class="fa fa-calendar-check-o"></i>', 'title' => 'Campaigns'],
                                ['controller' => 'ReportSchedule', 'action' => 'index', 'icon' => '<i class="fa fa-bar-chart"></i>', 'title' => 'Reporting'],
                            ],
                            'image' => 'automated_icon',
                            'image_extension' => 'png',
                            'title' => 'Automated',
                            'controller' => 'User',
                            'action' => 'dashboard',
                            'selected' => false,
                            'id' => 'automatedBtn'
                        ],
                        ['controller' => 'ManualTesting', 'action' => 'index', 'image' => 'manual_icon', 'image_extension' => 'png', 'title' => 'Manual']
                    ];
        if($this->user_data->is_spearline){
            $left_menu[] = ['controller' => 'Idial', 'action' => 'index', 'image' => 'manual_icon', 'image_extension' => 'png', 'title' => 'iDial'];
        }
        $left_menu[] = ['controller' => 'User', 'action' => 'index', 'icon' => '<i class="fa fa-wrench"></i>', 'title' => 'Admin'];
        $left_menu[] = ['controller' => 'ProviderCliRange', 'action' => 'index', 'icon' => '<i class="fa fa-info-circle"></i>', 'title' => 'Resources'];

        foreach($left_menu as $lmkey => $lmitem) {
            if(is_numeric($lmkey)) {
                if( !array_key_exists($lmitem['controller'], $this->user_data->user_access) or ! in_array($lmitem['action'], $this->user_data->user_access[$lmitem['controller']]) ) {
                    unset($left_menu[$lmkey]);
                }
            } else {
                if($lmkey == 'Automated' and !$this->user_data->have_automated_testing) {
                    unset($left_menu[$lmkey]);
                    $left_menu[] = [
                        'image' => 'automated_icon',
                        'image_extension' => 'png',
                        'controller' => 'ManualTesting',
                        'action' => 'upgrade',
                        'actions' => ['upgrade'],
                        'title' => 'Automated</div><div style="color: #03A9F4;">UPGRADE'
                    ];
                } else {
                    foreach($lmitem['submenu'] as $lmSkey => $lmSitem) {
                        if(is_numeric($lmSkey)) {
                            if( !array_key_exists($lmSitem['controller'], $this->user_data->user_access) or
                            ! in_array($lmSitem['action'], $this->user_data->user_access[$lmSitem['controller']]) ) {
                                unset($left_menu[$lmkey]['submenu'][$lmSkey]);
                            }
                        }
                    }
                }

            }
        }
        foreach($left_menu_controllers as $l_controller => $l_controllers){
            $selected = false;
            if(in_array($controller_name, $l_controllers)) {
                foreach($left_menu as $key => $item) {
                    if(is_numeric($key)) {
                        if($l_controller == $item['controller']) {
                            if( isset($item['actions']) && $action_name ){
                                if(in_array($action_name, $item['actions'])){
                                    //remove other selections
                                     foreach($left_menu as $k => $i){
                                        if(isset($i['selected']))
                                        unset($left_menu[$k]['selected']);
                                    }
                                    $left_menu[$key]['selected'] = 1;
                                    $selected = true;
                                }
                            }
                            elseif(!$selected)
                            $left_menu[$key]['selected'] = 1;
                        }
                    } else {
                        foreach($item['submenu'] as $lmSkey => $lmSitem) {
                            if($l_controller == $lmSitem['controller']) {
                                if( isset($lmSitem['actions']) && $action_name ){
                                    if( in_array($action_name, $lmSitem['actions']) ){
                                        foreach($left_menu as $k => $i){
                                           if(isset($i['selected']))
                                           unset($left_menu[$k]['selected']);
                                       }
                                        $left_menu[$key]['selected'] = 1;
                                        $left_menu[$key]['submenu'][$lmSkey]['selected'] = 1;
                                        $selected = true;
                                    }
                                } elseif(!$selected) {
                                    $left_menu[$key]['selected'] = 1;
                                    $left_menu[$key]['submenu'][$lmSkey]['selected'] = 1;
                                }
                            }
                        }
                    }
                }
            }
        }
     
        return $left_menu;
    }

    private function getAdminzMenu()
    {
        $adminz_menu_controllers = [
            'Company' => [
                'Company', 'Right', 'Role'
            ],
            'AlertPolicyForFailCall' => [
                'Alerts', 'AlertPolicyForFailCall', 'AlertPolicyForQuality', 'AlertPolicyForFollowupTest'
            ],
            'SpearlineNotification' => [
                'SpearlineNotification'
            ],
            'ManagementReportSchedule' => [
                'ManagementReportSchedule'
            ],
            'ProviderInfo' => [
                'ProviderInfo'
            ]
        ];

        $adminz_menu = [
                        ['controller' => 'Company', 'action' => 'index', 'icon' => '<i class="fa fa-university"></i>', 'title' => 'Company'],
                        ['controller' => 'AlertPolicyForFailCall', 'action' => 'index', 'icon' => '<i class="fa fa-phone"></i>', 'title' => 'Alerts'],
                        ['controller' => 'SpearlineNotification', 'action' => 'listNotifications', 'icon' => '<i class="fa fa-exclamation-triangle"></i>', 'title' => 'Notifications'],
                        ['controller' => 'MrepReportSchedule', 'action' => 'index', 'icon' => '<i class="fa fa-envelope"></i>', 'title' => 'Management Reports'],
                        ['controller' => 'ProviderInfo', 'action' => 'index', 'icon' => '<i class="fa fa-user-circle-o"></i>', 'title' => 'Support'],
                    ];

        foreach($adminz_menu_controllers as $controller => $controllers){
            $selected = false;
            if(in_array($this->name, $controllers)) {
                foreach($adminz_menu as $key => $item){
                    if($controller == $item['controller']){
                        if(isset($item['actions']) && isset($this->request) && isset($this->request->params) && isset($this->request->params['action'])){
                            if(in_array($this->request->params['action'], $item['actions'])){
                                //remove other selections
                                foreach($adminz_menu as $k => $i){
                                    if(isset($i['selected'])) {
                                        unset($adminz_menu[$k]['selected']);
                                    }
                                }
                                $adminz_menu[$key]['selected'] = 1;
                                $selected = true;
                            }
                        } elseif(!$selected) {
                            $adminz_menu[$key]['selected'] = 1;
                        }
                    }
                }
            }
        }
        return $adminz_menu;
    }

    private function getTopMenu()
    {
        //TOP MENU Config
       $numbers_top_menu = [
           0 => [
               'controller' => 'Number',
               'action' => 'index',
                'param' => '',
               '?' => ['is_gsm' => 0 ],
               'text' => 'Numbers',
               'data-intro' => 'Click Here to view all Numbers',
               'data-position' => 'left'
           ]
       ];

        if(isset($this->user_data) && $this->user_data->company->has_conference){
            $numbers_top_menu[] = [
                'controller' => 'Passcode',
                'action' => '',
                'param' => '',
                'text' => 'Passcodes',
                'data-intro' => 'Click Here to view all Passcodes',
                'data-position' => 'bottom'
            ];
            $numbers_top_menu[] = [
                'controller' => 'BridgeDdi',
                'action' => '',
                'param' => '',
                'text' => 'DDI',
                'data-intro' => 'Click Here to view all DDI\'s',
                'data-position' => 'bottom'
            ];
        }
        if(isset($this->user_data) && $this->user_data->company->has_outbound){
            $numbers_top_menu[] = [
                'controller' => 'OutboundBridgeDdi',
                'action' => '',
                'param' => '',
                'text' => 'Outbound Bridge',
                'data-intro' => 'Click Here to view Outbound Bridges',
                'data-position' => 'bottom'
            ];
        }
        $numbers_top_menu[] = [
            'controller' => 'IvrTraversal',
            'action' => '',
            'param' => '',
            'text' => 'IVR Traversal',
            'data-intro' => 'Click Here to view IVR Traversal\'s',
            'data-position' => 'bottom'
        ];


        if(isset($this->user_data) && $this->user_data->company->has_ivr){
            $numbers_top_menu[] = [
                'controller' => 'NumberTimeGroup',
                'action' => '',
                'param' => '',
                'text' => 'Time Groups',
                'data-intro' => 'Click Here to view Time Groups',
                'data-position' => 'bottom'
            ];
        }

        /* Show IHG Number Option link only if application is ivr and application id is 14 */
        if($this->request->params['controller']=="Number"){
            if(!(isset($this->request->query['application']))){
                $application = $this->Number->Company->SpearlineApplication->find('all')->innerJoinWith('ApplicationForCompany')->where(['company_id =' => $this->user_data->company_id])->first();
            }else{
                $application = $this->Number->Company->SpearlineApplication->get($this->request->query['application']);
            }
            if($application->id == 14){
                $numbers_top_menu[] = [
                    'controller' => 'IhgBrandingNumberOption',
                    'action' => '',
                    'param' => '',
                    'text' => 'IHG Number Options',
                    'data-intro' => 'Click Here to view IVR Number Options',
                    'data-position' => 'bottom'
                ];
            }
        }

        $reports_top_menu = [
            0 => [
                'controller' => 'ReportSchedule',
                'action' => 'index',
                'param' => '',
                'text' => 'All',
                'data-intro' => 'Click Here to show all your scheduled/unscheduled Reports',
                'data-position' => 'left'
            ],
            1 => [
                'controller' => 'Dashboard',
                'action' => 'scheduleReport',
                'param' => '',
                'text' => 'Schedule',
                'data-intro' => 'Click Here to schedule a Report',
                'data-position' => 'right'
            ],
        ];

        $info_top_menu =[
                0 => [
                    'controller' => 'ProviderCliRange',
                    'action' => 'index',
                    'param' => '',
                    'text' => 'Certified Countries',
                    'attr' => ['class' => 'test'],
                    'data-intro' => 'Click Here to view CLI information',
                    'data-position' => 'left'
                ],
                1 => [
                    'controller' => 'Tutorials',
                    'action' => 'index',
                    'param' => '',
                    'text' => 'Video Tutorials',
                    'data-intro' => 'Click Here to view our video tutorials',
                    'data-position' => 'bottom'
                ],
                2 => [
                    'controller' => 'Tutorials',
                    'action' => 'manuals',
                    'param' => '',
                    'text' => 'User guides',
                    'data-intro' => 'Click Here to view our User Manuals',
                    'data-position' => 'bottom'
                ],
                3 => [
                    'controller' => 'Tutorials',
                    'action' => 'testTypes',
                    'param' => '',
                    'text' => 'Spearline tests explained',
                    'data-intro' => 'Click Here to view the Spearline tests explained',
                    'data-position' => 'bottom'
                ]

        ];

        if(isset($this->user_data) && isset($this->user_data->company->company_extension->api_doc_access) && $this->user_data->company->company_extension->api_doc_access){
            $info_top_menu[] = [
                'controller' => 'Tutorials',
                'action' => 'api',
                'param' => '',
                'text' => 'Spearline API',
                'attr' => ['target' => '_blank'],
                'data-intro' => 'Click Here to view our API documentation',
                'data-position' => 'bottom'
            ];
        }
        $info_top_menu[] = [
            'controller' => 'CallDescriptionGroupForCompany',
            'action' => '',
            'param' => '',
            'text' => 'Fail Reasons',
            'attr' => ['target' => '_blank'],
            'data-intro' => 'Click Here to view all Fail descriptions and reasons',
            'data-position' => 'bottom'
        ];
        $info_top_menu[] = [
            'controller' => 'Contact',
            'action' => '',
            'param' => '',
            'text' => 'Contact Us',
            'attr' => ['data-featherlight' => 'iframe', 'data-featherlight-iframe-height' => '20em'],
            'data-intro' => 'Click Here to open our contact form where you can send an email to our 24/7 Support Team.',
            'data-position' => 'right'
        ];

        $company_menu = [
            0 => [
                'controller' => 'Company',
                'action' => 'index',
                'param' => '',
                'text' => 'Company Listing',
                'data-intro' => 'Click Here to view all companies',
                'data-position' => 'left'
            ],
            1 => [
                'controller' => 'Right',
                'action' => 'index',
                'param' => '',
                'text' => 'User Rights',
                'data-intro' => 'Click Here to view all rights',
                'data-position' => 'bottom'
            ],
            2 => [
                'controller' => 'Role',
                'action' => 'index',
                'param' => '',
                'text' => 'User Roles',
                'data-intro' => 'Click Here to view all Roles',
                'data-position' => 'right'
            ],
        ];
        $alertMenu = [
            0 => [
                'controller' => 'AlertPolicyForFailCall',
                'action' => 'index',
                'param' => ( is_array($this->request->params['pass']) and count( $this->request->params['pass'] ) ) ? $this->request->params['pass'][0] : 0,
                'text' => 'Fail Alert Policy',
                'data-intro' => 'Click Here to view all Fail Policies',
                'data-position' => 'bttom'
            ],
            1 => [
                'controller' => 'AlertPolicyForQuality',
                'action' => 'index',
                'param' => ( is_array($this->request->params['pass']) and count( $this->request->params['pass'] ) ) ? $this->request->params['pass'][0] : 0,
                'text' => 'Quality Alert Policy',
                'data-intro' => 'Click Here to view all Quality Policies',
                'data-position' => 'bttom'
            ],
            2 => [
                'controller' => 'AlertPolicyForFollowupTest',
                'action' => 'index',
                'param' => ( is_array($this->request->params['pass']) and count( $this->request->params['pass'] ) ) ? $this->request->params['pass'][0] : 0,
                'text' => 'Followup Alert Policy',
                'data-intro' => 'Click Here to view all Followup Policies',
                'data-position' => 'bttom'
            ],
            3 => [
                'controller' => 'Alerts',
                'action' => 'alertTemplateList',
                'param' => ( is_array($this->request->params['pass']) and count( $this->request->params['pass'] ) ) ? $this->request->params['pass'][0] : 0,
                'text' => 'Alert Template',
                'data-intro' => 'Click Here to view all Alert Templates',
                'data-position' => 'bottom'
            ],
            4 => [
                'controller' => 'Alerts',
                'action' => 'alertContactList',
                'param' => ( is_array($this->request->params['pass']) and count( $this->request->params['pass'] ) ) ? $this->request->params['pass'][0] : 0,
                'text' => 'Alert Contact',
                'data-intro' => 'Click Here to view all Alert Contacts',
                'data-position' => 'bottom'
            ],
            5 => [
                'controller' => 'Alerts',
                'action' => 'listPesqDropAlerts',
                'param' => '',
                'text' => 'PESQ Drop',
                'data-intro' => 'Click Here to set custom county benchmarks for all companies',
                'data-position' => 'bottom'
            ]
        ];

        $support_top_menu[] = [
            'controller' => 'ProviderInfo',
            'action' => '',
            'param' => '',
            'text' => 'Provider',
            'data-intro' => 'Click Here to view all Provider\'s',
            'data-position' => 'bottom'
        ];
        
        $top_menu = [
            'Number' => [
                'actions' => ['index', 'import'],
                'menu' => $numbers_top_menu,
            ],
            'CampaignTimeGroup' => [
                
                'actions' => ['index'],
                'menu' => $numbers_top_menu,
            ],
            'Passcode' => [
                'actions' => ['index'],
                'menu' => $numbers_top_menu,
            ],
            'BridgeDdi' => [
                'actions' => ['index'],
                'menu' => $numbers_top_menu,
            ],
            'OutboundBridgeDdi' => [
                'actions' => ['index'],
                'menu' => $numbers_top_menu,
            ],
            'IvrTraversal' => [
                'actions' => ['index'],
                'menu' => $numbers_top_menu,
            ],
            'NumberTimeGroup' => [
                'actions' => ['index'],
                'menu' => $numbers_top_menu,
            ],
            'Campaign' => [
                'actions' => ['index', 'edit', 'numbers', 'add', 'scheduleCampaign', 'countries', 'did', 'bridge'],
                'menu' => [
                    0 => [
                        'controller' => 'Campaign',
                        'action' => 'index',
                        'param' => '',
                        'text' => 'All',
                        'data-intro' => 'Click Here to view all Campaigns',
                        'data-position' => 'left'
                    ],
                    1 => [
                        'controller' => 'Campaign',
                        'action' => 'add',
                        'param' => '',
                        'text' => 'New Campaign',
                        'data-intro' => 'Click Here to add a new Campaign',
                        'data-position' => 'bottom'
                    ],
                    2 => [
                        'controller' => 'CampaignTimeGroup',
                        'action' => 'index',
                        'param' => '',
                        'text' => 'Time Groups',
                        'data-intro' => 'Click Here to view all Campaign Time Groups',
                        'data-position' => 'right'
                    ],
                ],
                'edit_menu' => [
                    0 => [
                        'controller' => 'Campaign',
                        'action' => 'index',
                        'param' => '',
                        'text' => 'All',
                        'data-intro' => 'Click Here to view all Campaigns',
                        'data-position' => 'left'
                    ],
                    1 => [
                        'controller' => 'Campaign',
                        'action' => 'edit',
                        'param' => ( is_array($this->request->params['pass']) and count( $this->request->params['pass'] ) ) ? $this->request->params['pass'][0] : 0,
                        'text' => 'Edit Campaign',
                        'data-intro' => 'Click Here to Edit current Campaign',
                        'data-position' => 'bottom'
                    ],
                    2 => [
                        'controller' => 'CampaignTimeGroup',
                        'action' => 'index',
                        'param' => '',
                        'text' => 'Time Groups',
                        'data-intro' => 'Click Here to view all Campaign Time Groups',
                        'data-position' => 'right'
                    ],
                ],
                'add_menu' => [
                    0 => [
                        'controller' => 'Campaign',
                        'action' => 'index',
                        'param' => '',
                        'text' => 'All',
                        'data-intro' => 'Click Here to view all Campaigns',
                        'data-position' => 'left'
                    ],
                    1 => [
                        'controller' => 'Campaign',
                        'action' => 'add',
                        'param' => '',
                        'text' => 'Add Campaign',
                        'data-intro' => 'Click Here to Add a Campaign',
                        'data-position' => 'bottom'
                    ],
                    2 => [
                        'controller' => 'CampaignTimeGroup',
                        'action' => 'index',
                        'param' => '',
                        'text' => 'Time Groups',
                        'data-intro' => 'Click Here to view all Campaigns',
                        'data-position' => 'right'
                    ],
                ],
                'numbers_menu' => [
                    0 => [
                        'controller' => 'Campaign',
                        'action' => 'index',
                        'param' => '',
                        'text' => 'All',
                        'data-intro' => 'Click Here to view all Campaigns',
                        'data-position' => 'left'
                    ],
                    1 => [
                        'controller' => 'Campaign',
                        'action' => 'numbers',
                        'param' => ( is_array($this->request->params['pass']) and count( $this->request->params['pass'] ) ) ? $this->request->params['pass'][0] : 0,
                        'text' => 'Add Numbers',
                        'data-intro' => 'Click Here to add Numbers to Campaign',
                        'data-position' => 'bottom'
                    ],
                    2 => [
                        'controller' => 'CampaignTimeGroup',
                        'action' => 'index',
                        'param' => '',
                        'text' => 'Time groups',
                        'data-intro' => 'Click Here to view all Campaign Time Groups',
                        'data-position' => 'right'
                    ],
                ],
                'countries_menu' => [
                    0 => [
                        'controller' => 'Campaign',
                        'action' => 'index',
                        'param' => '',
                        'text' => 'All',
                        'data-intro' => 'Click Here to view all Campaigns',
                        'data-position' => 'left'
                    ],
                    1 => [
                        'controller' => 'Campaign',
                        'action' => 'countries',
                        'param' => ( is_array($this->request->params['pass']) and count( $this->request->params['pass'] ) ) ? $this->request->params['pass'][0] : 0,
                        'text' => 'Add Countries',
                        'data-intro' => 'Click Here to Add Countries to Campaign',
                        'data-position' => 'bottom'
                    ],
                    2 => [
                        'controller' => 'CampaignTimeGroup',
                        'action' => 'index',
                        'param' => '',
                        'text' => 'Time groups',
                        'data-intro' => 'Click Here to view all Campaign Time Groups',
                        'data-position' => 'right'
                    ],
                ],
                'did_menu' => [
                    0 => [
                        'controller' => 'Campaign',
                        'action' => 'index',
                        'param' => '',
                        'text' => 'All',
                        'data-intro' => 'Click Here to view all Campaigns',
                        'data-position' => 'left'
                    ],
                    1 => [
                        'controller' => 'Campaign',
                        'action' => 'did',
                        'param' => ( is_array($this->request->params['pass']) and count( $this->request->params['pass'] ) ) ? $this->request->params['pass'][0] : 0,
                        'text' => 'Add Numbers',
                        'data-intro' => 'Click Here to view add DDI Number',
                        'data-position' => 'bottom'
                    ],
                    2 => [
                        'controller' => 'CampaignTimeGroup',
                        'action' => 'index',
                        'param' => '',
                        'text' => 'Time groups',
                        'data-intro' => 'Click Here to view all Campaign Time Groups',
                        'data-position' => 'right'
                    ],
                ],
                'bridge_menu' => [
                    0 => [
                        'controller' => 'Campaign',
                        'action' => 'index',
                        'param' => '',
                        'text' => 'All',
                        'data-intro' => 'Click Here to view all Campaigns',
                        'data-position' => 'left'
                    ],
                    1 => [
                        'controller' => 'Campaign',
                        'action' => 'bridge',
                        'param' => ( is_array($this->request->params['pass']) and count( $this->request->params['pass'] ) ) ? $this->request->params['pass'][0] : 0,
                        'text' => 'Add Bridge',
                        'data-intro' => 'Click Here to add New Bridge to Campaign',
                        'data-position' => 'bottom'
                    ],
                    2 => [
                        'controller' => 'CampaignTimeGroup',
                        'action' => 'index',
                        'param' => '',
                        'text' => 'Time groups',
                        'data-intro' => 'Click Here to view all Campaign Time Groups',
                        'data-position' => 'right'
                    ],
                ],
                'scheduleCampaign_menu' => [
                    0 => [
                        'controller' => 'Campaign',
                        'action' => 'index',
                        'param' => '',
                        'text' => 'All',
                        'data-intro' => 'Click Here to view all Campaigns',
                        'data-position' => 'left'
                    ],
                    1 => [
                        'controller' => 'Campaign',
                        'action' => 'scheduleCampaign',
                        'param' => ( is_array($this->request->params['pass']) and count( $this->request->params['pass'] ) ) ? $this->request->params['pass'][0] : 0,
                        'text' => 'Schedule Campaign',
                        'data-intro' => 'Click Here to schedule a New Campaign',
                        'data-position' => 'bottom'
                    ],
                    2 => [
                        'controller' => 'CampaignTimeGroup',
                        'action' => 'index',
                        'param' => '',
                        'text' => 'Time groups',
                        'data-intro' => 'Click Here to view all Campaign Time Groups',
                        'data-position' => 'right'
                    ],
                ]
            ],
            'CampaignForIvr' => [
                'actions' => ['index', 'edit', 'numbers', 'add', 'scheduleCampaign'],
                'menu' => [
                    0 => [
                        'controller' => 'CampaignForIvr',
                        'action' => 'index',
                        'param' => '',
                        'text' => 'All',
                        'data-intro' => 'Click Here to view all Campaigns',
                        'data-position' => 'left'
                    ],
                    1 => [
                        'controller' => 'CampaignForIvr',
                        'action' => 'add',
                        'param' => '',
                        'text' => 'New Campaign',
                        'data-intro' => 'Click Here to create a New Campaign',
                        'data-position' => 'right'
                    ],
                ],
                'edit_menu' => [
                    0 => [
                        'controller' => 'CampaignForIvr',
                        'action' => 'index',
                        'param' => '',
                        'text' => 'All',
                        'data-intro' => 'Click Here to view all Campaigns',
                        'data-position' => 'left'
                    ],
                    1 => [
                        'controller' => 'CampaignForIvr',
                        'action' => 'edit',
                        'param' => '',
                        'text' => 'Edit Campaign',
                        'data-intro' => 'Click Here Edit a Campaign',
                        'data-position' => 'right'
                    ],
                ],
                'numbers_menu' => [
                    0 => [
                        'controller' => 'CampaignForIvr',
                        'action' => 'index',
                        'param' => '',
                        'text' => 'All',
                        'data-intro' => 'Click Here to view all Campaigns',
                        'data-position' => 'left'
                    ],
                    1 => [
                        'controller' => 'CampaignForIvr',
                        'action' => 'numbers',
                        'param' => '',
                        'text' => 'Add numbers',
                        'data-intro' => 'Click Here to create a New Campaign',
                        'data-position' => 'right'
                    ],
                ],
                'scheduleCampaign_menu' => [
                    0 => [
                        'controller' => 'CampaignForIvr',
                        'action' => 'index',
                        'param' => '',
                        'text' => 'All',
                        'data-intro' => 'Click Here to view all Campaigns',
                        'data-position' => 'left'
                    ],
                    1 => [
                        'controller' => 'CampaignForIvr',
                        'action' => 'scheduleCampaign',
                        'param' => '',
                        'text' => 'Schedule Campaign',
                        'data-intro' => 'Click Here to create a New Campaign',
                        'data-position' => 'right'
                    ],
                ],
            ],
            'CampaignTimeGroup' => [
                'actions' => ['index'],
                'menu' => [
                    0 => [
                        'controller' => 'Campaign',
                        'action' => 'index',
                        'param' => '',
                        'text' => 'All',
                        'data-intro' => 'Click Here to view all Campaigns',
                        'data-position' => 'left'
                    ],
                    1 => [
                        'controller' => 'Campaign',
                        'action' => 'add',
                        'param' => '',
                        'text' => 'New Campaign',
                        'data-intro' => 'Click Here to Add a New Campaign',
                        'data-position' => 'bottom'
                    ],
                    2 => [
                        'controller' => 'CampaignTimeGroup',
                        'action' => 'index',
                        'param' => '',
                        'text' => 'Time Groups',
                        'data-intro' => 'Click Here to view all Campaign Time Groups',
                        'data-position' => 'right'
                    ],
                ],
            ],
            'ReportSchedule' => [
                'actions' => ['index'],
                'menu' => $reports_top_menu
            ],
            'Dashboard' => [
                'actions' => ['scheduleReport', 'viewScheduleReport', 'editReportSchedule', 'index'],
                'menu' => $reports_top_menu,
                'editReportSchedule_menu' => [
                    0 => [
                        'controller' => 'ReportSchedule',
                        'action' => 'index',
                        'param' => '',
                        'text' => 'All',
                        'data-intro' => 'Click Here to view all Scheduled/Unscheduled Reports',
                        'data-position' => 'left'
                    ],
                    1 => [
                        'controller' => 'Dashboard',
                        'action' => 'editReportSchedule',
                        'param' =>  ( is_array($this->request->params['pass']) and count( $this->request->params['pass'] ) ) ? $this->request->params['pass'][0] : 0,
                        'text' => 'Schedule',
                        'data-intro' => 'Click Here to edit a Report',
                        'data-position' => 'right'
                    ],
                ]
            ],
            'User' => [
                'actions' => ['index'],
                'menu' => [
                    0 => [
                        'controller' => 'User',
                        'action' => 'index',
                        'param' => '',
                        'text' => 'Users',
                        'data-intro' => 'Click Here to view all Users',
                        'data-position' => 'left'
                    ],
                ]
            ],
            'ProviderCliRange' => [
                'actions' => ['index'],
                'menu' => $info_top_menu
            ],
            'Tutorials' => [
                'actions' => ['index', 'manuals', 'testTypes'],
                'menu' => $info_top_menu
            ],
            'SpearlineAPI' => [
                'actions' => ['index', 'api'],
                'menu' => $info_top_menu
            ],
            'CallDescriptionGroupForCompany' => [
                'actions' => ['index'],
                'menu' => $info_top_menu
            ],
            'Company' => [
                'actions' => ['index'],
                'menu' => $company_menu
            ],
            'Right' => [
                'actions' => ['index', 'add', 'edit'],
                'menu' => $company_menu
            ],
            'Role' => [
                'actions' => ['index', 'add', 'edit'],
                'menu' => $company_menu
            ],
            'Alerts' => [
                'actions' => ['index','alertTemplateList','alertContactList','editAlertTemplate','editAlertContact','addAlertTemplate', 'listPesqDropAlerts', 'pesqDropsAlertCustomBenchmark', 'pesqDropsAlertsCompaniesList', 'addPesqDropAlert', 'editPesqDropAlert'],
                'menu' => $alertMenu,
            ],
            'AlertPolicyForFailCall' => [
                'actions' => ['index','add', 'edit', 'assignNumbers'],
                'menu' => $alertMenu,
            ],
            'AlertPolicyForFailCallHistory' => [
                'actions' => ['index'],
                'menu' => $alertMenu,
            ],
            'AlertPolicyForQuality' => [
                'actions' => ['index','add', 'edit', 'assignNumbers'],
                'menu' => $alertMenu,
            ],
            'AlertPolicyForQualityHistory' => [
                'actions' => ['index'],
                'menu' => $alertMenu,
            ],
            'AlertPolicyForFollowupTest' => [
                'actions' => ['index','add', 'edit', 'assignNumbers'],
                'menu' => $alertMenu,
            ],
            'AlertPolicyForFollowupTestHistory' => [
                'actions' => ['index'],
                'menu' => $alertMenu,
            ],
            'ProviderInfo' => [
                'actions' => ['index'],
                'menu' => $support_top_menu,
            ]
        ];

        return $top_menu;
    }

    private function logUserAction() {
        $logs_file = 'all.log';

        if(file_exists(LOGS . DS . $logs_file)) {

        }

        $handle = fopen(LOGS . DS . $logs_file, 'a+');
        $user_id = $this->Auth->user('id');
        $data = [
            "User:",
            $user_id,
            $this->user_data->company_id,
            date('Y-m-d H:i:s'),
            Router::url(null, true),
            $this->request->params['controller'],
            $this->request->params['action'],
            json_encode($this->request->query),
            json_encode($this->request->data),
        ];
        fputcsv($handle, $data);
        fclose($handle);
    }
    
    /**
    * startup Callback
    *
    * for a xml api request removes the first key in the kquest so that resulting request can be processed with
    * no changes in controller
    */
    public function startupProcess()
    {
        $response = parent::startupProcess();
        if($this->request->is('xml') && ($this->request->is('put') || $this->request->is('post')) && isset($this->request->data['data'])){
            $this->request->data = $this->request->data['data'];
        }
        
        return $response;
    }
    
    protected function prepareEntityForApi($entity)
    {
        if(is_subclass_of($entity, 'Cake\ORM\Entity')){
            foreach($entity->visibleProperties() as $field){
                if($entity->apiFields && !in_array($field, $entity->apiFields)){
                    unset($entity->{$field});
                }
            }
            foreach($entity->visibleProperties() as $field){
                if(is_object($entity->{$field}))
                {
                    if(get_class($entity->{$field}) == 'Cake\I18n\FrozenTime'){
                        $entity->{$field} = $entity->{$field}->i18nFormat('yyyy-MM-dd HH:mm:ss');
                    }
                    else{
                        $this->prepareEntityForApi($entity->{$field});
                    }
                }
            }
        }
        
        return $entity;
    }
}
