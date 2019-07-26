<?php
namespace App\Model\Table;

use App\Model\Entity\User;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Mailer\Email;
use Search\Manager;

/**
 * User Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Company
 * @property \Cake\ORM\Association\BelongsTo $CountryCode
 * @property \Cake\ORM\Association\BelongsTo $Timezone
 * @property \Cake\ORM\Association\BelongsTo $CompanyDepartment
 * @property \Cake\ORM\Association\HasMany $CampaignApprovalHistory
 * @property \Cake\ORM\Association\HasMany $EditLog
 * @property \Cake\ORM\Association\HasMany $IdialHistory
 * @property \Cake\ORM\Association\HasMany $NumberExtension
 * @property \Cake\ORM\Association\HasMany $NumberFailHandler
 * @property \Cake\ORM\Association\HasMany $NumberFailHandlerHistory
 * @property \Cake\ORM\Association\HasMany $SpearlineIdialUser
 * @property \Cake\ORM\Association\HasMany $SpearlineUserWithCompany
 * @property \Cake\ORM\Association\HasMany $StickyJob
 * @property \Cake\ORM\Association\HasMany $UdialCallHistory
 * @property \Cake\ORM\Association\HasMany $UdialGroupForUser
 * @property \Cake\ORM\Association\HasMany $UserForUdial
 * @property \Cake\ORM\Association\HasMany $UserInPhonegroup
 * @property \Cake\ORM\Association\HasMany $UserSession
 * @property \Cake\ORM\Association\HasMany $UserSessionHistory
 */
class UserTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */

    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('user');
        $this->displayField('name');
        $this->primaryKey('id');

         // Add the behaviour to your table
        $this->addBehavior('Search.Search');

        // Setup search filter using search manager
        $this->searchManager()
            ->add('search_term', 'Search.Like', [
                'before' => true,
                'after' => true,
                'mode' => 'or',
                'comparison' => 'LIKE',
                'field' => ['User.name', 'User.email', 'Company.name']
            ]);

        $this->belongsTo('Company', [
            'foreignKey' => 'company_id'
        ]);
        $this->belongsTo('Role', [
            'foreignKey' => 'role_id'
        ]);
        $this->belongsTo('CountryCode', [
            'foreignKey' => 'country_code_id'
        ]);
        $this->belongsTo('Timezone', [
            'foreignKey' => 'timezone_id'
        ]);
        $this->belongsTo('CompanyDepartment', [
            'foreignKey' => 'department_id'
        ]);
        $this->hasMany('CampaignApprovalHistory', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('EditLog', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('IdialHistory', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('NumberExtension', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('NumberFailHandler', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('NumberFailHandlerHistory', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('SpearlineIdialUser', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('SpearlineUserWithCompany', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('StickyJob', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('UdialCallHistory', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('UdialGroupForUser', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('UserForUdial', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('UserInPhonegroup', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasOne('UserSession', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('UserSessionHistory', [
            'foreignKey' => 'user_id'
        ]);
        $this->belongsTo('ManagementReportSchedule', [
            'foreignKey' => 'created_by'
        ]);
        $this->belongsTo('ParentUser', [
            'className' => 'User',
            'foreignKey' => 'created_by'
        ]);
        $this->hasMany('ChildUsers', [
            'className' => 'User',
            'foreignKey' => 'created_by'
        ]);

        $this->hasMany('PasswordResetToken', [
            'className' => 'PasswordResetToken',
            'foreignKey' => 'user_id',
            'dependent' => true
        ]);

        $this->hasMany('PasswordResetTokenRequest', [
            'className' => 'PasswordResetToken',
            'foreignKey' => 'added_on',
            'dependent' => true
        ]);

        $this->hasMany('CampaignCreatedBy', [
            'className' => 'Campaign',
            'foreignKey' => ['created_by'],
            'joinType' => 'INNER'
        ]);
    }

    public function findAuth(\Cake\ORM\Query $query, array $options)
    {
        /*Api request will be valid if user status flag and api access flag are 1*/
        if(!empty($options['is_api'])){
            $query->where(['user.status' => 1, 'user.api_access' => 1]);
        }else{
            $query->where(['user.status' => 1]);
        }

        return $query;
    }

    public function getUserByEmail($email)
    {
        $query = $this->findByEmailAndStatus($email, 1);
        $row = $query->first();

        return $row ? $row : false;
    }

    public function getBrowserName($user_agent)
    {
        if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) return 'Opera';
        elseif (strpos($user_agent, 'Edge')) return 'Edge';
        elseif (strpos($user_agent, 'Chrome')) return 'Chrome';
        elseif (strpos($user_agent, 'Safari')) return 'Safari';
        elseif (strpos($user_agent, 'Firefox')) return 'Firefox';
        elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7')) return 'Internet Explorer';

        return 'Other';
    }

    public function getOSName($user_agent)
    {
        $os_platform    =   "Unknown OS Platform";
        $os_array       =   [
                            '/windows nt 10/i'     =>  'Windows 10',
                            '/windows nt 6.3/i'     =>  'Windows 8.1',
                            '/windows nt 6.2/i'     =>  'Windows 8',
                            '/windows nt 6.1/i'     =>  'Windows 7',
                            '/windows nt 6.0/i'     =>  'Windows Vista',
                            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                            '/windows nt 5.1/i'     =>  'Windows XP',
                            '/windows xp/i'         =>  'Windows XP',
                            '/windows nt 5.0/i'     =>  'Windows 2000',
                            '/windows me/i'         =>  'Windows ME',
                            '/win98/i'              =>  'Windows 98',
                            '/win95/i'              =>  'Windows 95',
                            '/win16/i'              =>  'Windows 3.11',
                            '/macintosh|mac os x/i' =>  'Mac OS X',
                            '/mac_powerpc/i'        =>  'Mac OS 9',
                            '/linux/i'              =>  'Linux',
                            '/ubuntu/i'             =>  'Ubuntu',
                            '/iphone/i'             =>  'iPhone',
                            '/ipod/i'               =>  'iPod',
                            '/ipad/i'               =>  'iPad',
                            '/android/i'            =>  'Android',
                            '/blackberry/i'         =>  'BlackBerry',
                            '/webos/i'              =>  'Mobile'
                        ];

        foreach ($os_array as $regex => $value) {
            if (preg_match($regex, $user_agent)) {
                $os_platform    =   $value;
            }
        }

        return $os_platform;
    }

    public function getMysqlTimestamp(){
        $query = $this->find();
        $mysql_now = $query->select(['now' => $query->func()->now()])->first();
        $mysql_now = $mysql_now['now']->i18nFormat('yyyy-MM-dd HH:mm:ss');

        return $mysql_now;
    }

    public function saveLoginHistory($user, $request) {
        $return = false;

        //works with array or object
        $user_id = (is_array($user) and array_key_exists('id', $user)) ? $user['id'] : ((is_object($user) and property_exists('id', $user)) ? $user->id : false);
        if($user_id) {
            $user_agent = env('HTTP_USER_AGENT');
            $browser = $this->getBrowserName($user_agent);
            $ip = $request->clientIp();
            $ip2long = ip2long($ip);
            $platform = $this->getOSName($user_agent);
            //find the old session if that exists and replace it with the current one
            $cur_session = $this->UserSession->find('all')->where(['user_id' => $user_id])->first();
            if(!$cur_session) {
                $cur_session = $this->UserSession->newEntity();
            }

            //get the current timpstamp from the database server
            $mysql_now = $this->getMysqlTimestamp();

            $session_data = [
                'user_id' => $user_id,
                'login_time' => $mysql_now,
                'browser' => $browser,
                'platform' => $platform,
                'user_agent' => $user_agent,
                'public_ip' => $ip2long ? $ip2long : 0,
            ];

            $cur_session = $this->UserSession->patchEntity($cur_session, $session_data);
            if($this->UserSession->save($cur_session)){
                $return = true;
            } else {
                $return = false;
            }

            $session_history = $this->UserSessionHistory->newEntity();
            $session_history_data = $session_data;
            $session_history_data['is_forced_logout'] = 0;

            $session_history = $this->UserSessionHistory->patchEntity($session_history, $session_history_data);
            if($this->UserSessionHistory->save($session_history)){
                $session = $request->session();
                $session->write('login_time', $mysql_now);
                $return = true;
            } else {
                $return = false;
            }
        }
        return $return;
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email');
            //->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table', 'message' => __('An account with this email already exists.')]);

        $validator
            ->requirePresence('timezone_id', 'create')
            ->notEmpty('timezone_id');

        $validator
            ->requirePresence('role_id', 'create')
            ->notEmpty('role_id');

        // $validator
        //     ->requirePresence('sms', 'create')
        //     ->notEmpty('sms');

        /*
        $validator
            ->requirePresence('login_name', 'create')
            ->notEmpty('login_name');
        */

        $validator
            ->integer('created_by')
            ->allowEmpty('created_by');

        $validator
            ->dateTime('created_on')
            ->requirePresence('created_on', 'create')
            ->notEmpty('created_on');

        $validator
            ->dateTime('edited_on')
            ->requirePresence('edited_on', 'create')
            ->notEmpty('edited_on');

        $validator
            ->boolean('show')
            ->allowEmpty('show');

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        return $validator;
    }
    
    public function validationApi(Validator $validator)
    {
        $validator = $this->validationDefault($validator);

        $validator
            ->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table', 'message' => __('An account with this email already exists.')]);
        
        return $validator;
    }

    public function validationPasswordChanging(Validator $validator )
    {

        $validator
            ->add('old_password','custom',[
                'rule'=>  function($value, $context){
                    $user = $this->get($context['data']['id']);
                    if ($user) {
                        if ((new DefaultPasswordHasher)->check($value, $user->password)) {
                            return true;
                        }
                    }
                    return false;
                },
                'message'=>'The old password do not match the current password!',
            ])
            ->notEmpty('old_password');

        $validator
            ->notEmpty('new_password')
            ->add('new_password','strong',[
                'rule'=>  function($value, $context){
                    if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[\!\£\@\#\$\%\^\&\*\+\_\-])(?=.{8,})/", $value))
                        return 'The password must be at least 8 characters long and contain at least one number, one capital letter and one special character(!,£,@,#,$,%,^,&,*,+,_,-)';
                    return true;
                }
            ]);
        $validator
            ->add('confirm_password',[
                'match'=>[
                    'rule'=> ['compareWith','new_password'],
                    'message'=>'The passwords do not match!',
                ]
            ])
            ->notEmpty('confirm_password');

        return $validator;
    }

    public function validationUserPasswordChanging(Validator $validator )
    {
        $validator
            ->add('new_password','strong',[
                'rule'=>  function($value, $context){
                    if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[\!\£\@\#\$\%\^\&\*\+\_\-])(?=.{8,})/", $value))
                        return 'The password must be at least 8 characters long and contain at least one number, one capital letter and one special character(!,£,@,#,$,%,^,&,*,+,_,-)';
                    return true;
                }
            ])
            ->notEmpty('new_password');
        $validator
            ->add('confirm_password',[
                'match'=>[
                    'rule'=> ['compareWith','new_password'],
                    'message'=>'The passwords do not match!',
                ]
            ])
            ->notEmpty('confirm_password');

        return $validator;
    }

    public function findTheOldUser(Query $query, array $options)
    {
        $user = $this->newEntity($options);
        return  $query->where(['email' => $user->email, 'company_id' => $options['company_id']])->first();
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        #$rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['company_id'], 'Company'));
        $rules->add($rules->existsIn(['country_code_id'], 'CountryCode'));
        $rules->add($rules->existsIn(['timezone_id'], 'Timezone'));
        $rules->add($rules->existsIn(['department_id'], 'CompanyDepartment'));
        $rules->add($rules->existsIn(['role_id'], 'Role'));
        return $rules;
    }

    /**
     * Returns the database connection name to use by default.
     *
     * @return string
     */
    public static function defaultConnectionName()
    {
        return 'spearlinedb';
    }

    public function getUserFilterForManualTesting($company_id)
    {
        return $this
        ->find('list')
        ->join([
            'table' => 'job_processing_manual',
            'alias' => 'JobProcessingManual',
            'type' => 'INNER',
            'conditions' => 'User.id = JobProcessingManual.user_id ',
        ])
        ->join([
            'table' => 'company',
            'alias' => 'Company',
            'type' => 'INNER',
            'conditions' => 'User.company_id = Company.id ',
        ])
        ->where(['Company.id' => $company_id])
        ->toArray();
    }
    
    public function getUserFilterForIdial($company_id)
    {
        return $this
        ->find('list')
        ->join([
            'table' => 'job_processing_idial',
            'alias' => 'JobProcessingIdial',
            'type' => 'INNER',
            'conditions' => 'User.id = JobProcessingIdial.user_id ',
        ])
        ->join([
            'table' => 'company',
            'alias' => 'Company',
            'type' => 'INNER',
            'conditions' => 'User.company_id = Company.id ',
        ])
        ->where(['Company.id' => $company_id])
        ->toArray();
    }
}
