<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Company Model
 *
 * @property \App\Model\Table\CountryCodeTable|\Cake\ORM\Association\BelongsTo $CountryCode
 * @property \App\Model\Table\CompanyTable|\Cake\ORM\Association\BelongsTo $Company
 * @property \App\Model\Table\CompanyStyleTable|\Cake\ORM\Association\BelongsTo $CompanyStyle
 * @property \App\Model\Table\CurrencyCodeTable|\Cake\ORM\Association\BelongsTo $CurrencyCode
 * @property \App\Model\Table\IvrTraversalsTable|\Cake\ORM\Association\BelongsTo $IvrTraversals
 * @property \App\Model\Table\OldsTable|\Cake\ORM\Association\BelongsTo $Olds
 * @property \App\Model\Table\AgentConfirmationPromptTable|\Cake\ORM\Association\HasMany $AgentConfirmationPrompt
 * @property \App\Model\Table\AlertContactForCompanyTable|\Cake\ORM\Association\HasMany $AlertContactForCompany
 * @property \App\Model\Table\AlertLevelForCompanyTable|\Cake\ORM\Association\HasMany $AlertLevelForCompany
 * @property \App\Model\Table\AlertMediumForCompanyTable|\Cake\ORM\Association\HasMany $AlertMediumForCompany
 * @property \App\Model\Table\AlertPolicyForDidHealthTable|\Cake\ORM\Association\HasMany $AlertPolicyForDidHealth
 * @property \App\Model\Table\AlertPolicyForExternalCallTable|\Cake\ORM\Association\HasMany $AlertPolicyForExternalCall
 * @property \App\Model\Table\AlertPolicyForFailCallTable|\Cake\ORM\Association\HasMany $AlertPolicyForFailCall
 * @property \App\Model\Table\AlertPolicyForFollowupTestTable|\Cake\ORM\Association\HasMany $AlertPolicyForFollowupTest
 * @property \App\Model\Table\AlertPolicyForFollowupTestOldTable|\Cake\ORM\Association\HasMany $AlertPolicyForFollowupTestOld
 * @property \App\Model\Table\AlertPolicyForQualityTable|\Cake\ORM\Association\HasMany $AlertPolicyForQuality
 * @property \App\Model\Table\AlertPolicyForScoreDropTable|\Cake\ORM\Association\HasMany $AlertPolicyForScoreDrop
 * @property \App\Model\Table\ApiLogsTable|\Cake\ORM\Association\HasMany $ApiLogs
 * @property \App\Model\Table\ApplicationForCompanyTable|\Cake\ORM\Association\HasMany $ApplicationForCompany
 * @property \App\Model\Table\AutoRerunExcludeCountryTable|\Cake\ORM\Association\HasMany $AutoRerunExcludeCountry
 * @property \App\Model\Table\AutostopConditionTable|\Cake\ORM\Association\HasMany $AutostopCondition
 * @property \App\Model\Table\BillingCompanyRelationTable|\Cake\ORM\Association\HasMany $BillingCompanyRelation
 * @property \App\Model\Table\BillingHistoryTable|\Cake\ORM\Association\HasMany $BillingHistory
 * @property \App\Model\Table\BillingSummaryDailyTable|\Cake\ORM\Association\HasMany $BillingSummaryDaily
 * @property \App\Model\Table\BillingSummaryMonthlyTable|\Cake\ORM\Association\HasMany $BillingSummaryMonthly
 * @property \App\Model\Table\BridgeTable|\Cake\ORM\Association\HasMany $Bridge
 * @property \App\Model\Table\CallDescriptionGroupForCompanyTable|\Cake\ORM\Association\HasMany $CallDescriptionGroupForCompany
 * @property \App\Model\Table\CampaignTable|\Cake\ORM\Association\HasMany $Campaign
 * @property \App\Model\Table\CampaignArchiveTable|\Cake\ORM\Association\HasMany $CampaignArchive
 * @property \App\Model\Table\CampaignForIvrTable|\Cake\ORM\Association\HasMany $CampaignForIvr
 * @property \App\Model\Table\CampaignTimeGroupTable|\Cake\ORM\Association\HasMany $CampaignTimeGroup
 * @property \App\Model\Table\CliForTestTypeForCompanyTable|\Cake\ORM\Association\HasMany $CliForTestTypeForCompany
 * @property \App\Model\Table\ClicktodialPromptTable|\Cake\ORM\Association\HasMany $ClicktodialPrompt
 * @property \App\Model\Table\CompanyAutoRerunConditionTable|\Cake\ORM\Association\HasMany $CompanyAutoRerunCondition
 * @property \App\Model\Table\CompanyAutoRerunScoreThresholdTable|\Cake\ORM\Association\HasMany $CompanyAutoRerunScoreThreshold
 * @property \App\Model\Table\CompanyBillingTable|\Cake\ORM\Association\HasMany $CompanyBilling
 * @property \App\Model\Table\CompanyBillingWithCallBundleTable|\Cake\ORM\Association\HasMany $CompanyBillingWithCallBundle
 * @property \App\Model\Table\CompanyBillingWithCountryBandTable|\Cake\ORM\Association\HasMany $CompanyBillingWithCountryBand
 * @property \App\Model\Table\CompanyBillingWithTestTypeTable|\Cake\ORM\Association\HasMany $CompanyBillingWithTestType
 * @property \App\Model\Table\CompanyCarrierTable|\Cake\ORM\Association\HasMany $CompanyCarrier
 * @property \App\Model\Table\CompanyDepartmentTable|\Cake\ORM\Association\HasMany $CompanyDepartment
 * @property \App\Model\Table\CompanyExtensionTable|\Cake\ORM\Association\HasMany $CompanyExtension
 * @property \App\Model\Table\CompanyExtraFieldTable|\Cake\ORM\Association\HasMany $CompanyExtraField
 * @property \App\Model\Table\CompanyFollowupTestTable|\Cake\ORM\Association\HasMany $CompanyFollowupTest
 * @property \App\Model\Table\CompanyJobtesterStyleTable|\Cake\ORM\Association\HasMany $CompanyJobtesterStyle
 * @property \App\Model\Table\CompanyNumberCustomerTable|\Cake\ORM\Association\HasMany $CompanyNumberCustomer
 * @property \App\Model\Table\CompanyNumberDepartmentTable|\Cake\ORM\Association\HasMany $CompanyNumberDepartment
 * @property \App\Model\Table\CompanyNumberLocationTable|\Cake\ORM\Association\HasMany $CompanyNumberLocation
 * @property \App\Model\Table\CompanyOutageNotificationTable|\Cake\ORM\Association\HasMany $CompanyOutageNotification
 * @property \App\Model\Table\CompanyOwnedRouteTable|\Cake\ORM\Association\HasMany $CompanyOwnedRoute
 * @property \App\Model\Table\CompanyPrepayBillingTable|\Cake\ORM\Association\HasMany $CompanyPrepayBilling
 * @property \App\Model\Table\CompanyRegionTable|\Cake\ORM\Association\HasMany $CompanyRegion
 * @property \App\Model\Table\CompanyRerunTestLimitTable|\Cake\ORM\Association\HasMany $CompanyRerunTestLimit
 * @property \App\Model\Table\CompanyWithUdialTable|\Cake\ORM\Association\HasMany $CompanyWithUdial
 * @property \App\Model\Table\ConferencePromptForCompanyTable|\Cake\ORM\Association\HasMany $ConferencePromptForCompany
 * @property \App\Model\Table\CountryForCompanyTable|\Cake\ORM\Association\HasMany $CountryForCompany
 * @property \App\Model\Table\CustomCompanyBenchmarkTable|\Cake\ORM\Association\HasMany $CustomCompanyBenchmark
 * @property \App\Model\Table\DashboardTable|\Cake\ORM\Association\HasMany $Dashboard
 * @property \App\Model\Table\DidForCompanyTable|\Cake\ORM\Association\HasMany $DidForCompany
 * @property \App\Model\Table\EtoUserTable|\Cake\ORM\Association\HasMany $EtoUser
 * @property \App\Model\Table\FailedCallDescriptionForCompanyTable|\Cake\ORM\Association\HasMany $FailedCallDescriptionForCompany
 * @property \App\Model\Table\FilterDropdownForCompanyTable|\Cake\ORM\Association\HasMany $FilterDropdownForCompany
 * @property \App\Model\Table\FullRecordingForCompanyTable|\Cake\ORM\Association\HasMany $FullRecordingForCompany
 * @property \App\Model\Table\HourlyTestReportTable|\Cake\ORM\Association\HasMany $HourlyTestReport
 * @property \App\Model\Table\InternationalRouteForCompanyTable|\Cake\ORM\Association\HasMany $InternationalRouteForCompany
 * @property \App\Model\Table\IvrTagForCompanyTable|\Cake\ORM\Association\HasMany $IvrTagForCompany
 * @property \App\Model\Table\IvrTraversalTable|\Cake\ORM\Association\HasMany $IvrTraversal
 * @property \App\Model\Table\IvrTraversalActionForCompanyTable|\Cake\ORM\Association\HasMany $IvrTraversalActionForCompany
 * @property \App\Model\Table\IvrTraversalPromptForCompanyTable|\Cake\ORM\Association\HasMany $IvrTraversalPromptForCompany
 * @property \App\Model\Table\IvrTypeAgentPromptTable|\Cake\ORM\Association\HasMany $IvrTypeAgentPrompt
 * @property \App\Model\Table\JobTable|\Cake\ORM\Association\HasMany $Job
 * @property \App\Model\Table\JobCreationForCompanyTable|\Cake\ORM\Association\HasMany $JobCreationForCompany
 * @property \App\Model\Table\JobForIvrTable|\Cake\ORM\Association\HasMany $JobForIvr
 * @property \App\Model\Table\JobProcessingExternalTable|\Cake\ORM\Association\HasMany $JobProcessingExternal
 * @property \App\Model\Table\JobProcessingOutboundEchoTable|\Cake\ORM\Association\HasMany $JobProcessingOutboundEcho
 * @property \App\Model\Table\MrepReportScheduleTable|\Cake\ORM\Association\HasMany $MrepReportSchedule
 * @property \App\Model\Table\NumberTable|\Cake\ORM\Association\HasMany $Number
 * @property \App\Model\Table\NumberExtraFieldForCompanyTable|\Cake\ORM\Association\HasMany $NumberExtraFieldForCompany
 * @property \App\Model\Table\NumberFieldNameForCompanyTable|\Cake\ORM\Association\HasMany $NumberFieldNameForCompany
 * @property \App\Model\Table\NumberTagTable|\Cake\ORM\Association\HasMany $NumberTag
 * @property \App\Model\Table\NumberTimeGroupTable|\Cake\ORM\Association\HasMany $NumberTimeGroup
 * @property \App\Model\Table\OutageSuperTicketTable|\Cake\ORM\Association\HasMany $OutageSuperTicket
 * @property \App\Model\Table\PatrickConnectionCompanyTable|\Cake\ORM\Association\HasMany $PatrickConnectionCompany
 * @property \App\Model\Table\PatrickConnectionCountryTable|\Cake\ORM\Association\HasMany $PatrickConnectionCountry
 * @property \App\Model\Table\PesqFieldsForCompanyTable|\Cake\ORM\Association\HasMany $PesqFieldsForCompany
 * @property \App\Model\Table\PhonegroupTable|\Cake\ORM\Association\HasMany $Phonegroup
 * @property \App\Model\Table\PolqaFieldsForCompanyTable|\Cake\ORM\Association\HasMany $PolqaFieldsForCompany
 * @property \App\Model\Table\PopulationRequestHistoryTable|\Cake\ORM\Association\HasMany $PopulationRequestHistory
 * @property \App\Model\Table\ProdialNumberSchemaTable|\Cake\ORM\Association\HasMany $ProdialNumberSchema
 * @property \App\Model\Table\ProviderPortForCompanyTable|\Cake\ORM\Association\HasMany $ProviderPortForCompany
 * @property \App\Model\Table\RoleTable|\Cake\ORM\Association\HasMany $Role
 * @property \App\Model\Table\ScoreConditionTable|\Cake\ORM\Association\HasMany $ScoreCondition
 * @property \App\Model\Table\SpearlineUserWithCompanyTable|\Cake\ORM\Association\HasMany $SpearlineUserWithCompany
 * @property \App\Model\Table\SupportAssignGroupForCompanyTable|\Cake\ORM\Association\HasMany $SupportAssignGroupForCompany
 * @property \App\Model\Table\SupportDeskCompanyTable|\Cake\ORM\Association\HasMany $SupportDeskCompany
 * @property \App\Model\Table\TempInfoTable|\Cake\ORM\Association\HasMany $TempInfo
 * @property \App\Model\Table\TempUsersTable|\Cake\ORM\Association\HasMany $TempUsers
 * @property \App\Model\Table\TestTypeCallForwardingTable|\Cake\ORM\Association\HasMany $TestTypeCallForwarding
 * @property \App\Model\Table\TestTypeForCompanyTable|\Cake\ORM\Association\HasMany $TestTypeForCompany
 * @property \App\Model\Table\ToneAudioForCompanyTable|\Cake\ORM\Association\HasMany $ToneAudioForCompany
 * @property \App\Model\Table\UdialGroupTable|\Cake\ORM\Association\HasMany $UdialGroup
 * @property \App\Model\Table\UnableToTestJobTable|\Cake\ORM\Association\HasMany $UnableToTestJob
 * @property \App\Model\Table\UserTable|\Cake\ORM\Association\HasMany $User
 * @property \App\Model\Table\UserInPhonegroupTable|\Cake\ORM\Association\HasMany $UserInPhonegroup
 * @property \App\Model\Table\RoleTable|\Cake\ORM\Association\BelongsToMany $Role
 * @property \App\Model\Table\RouteForTestTypeTable|\Cake\ORM\Association\BelongsToMany $RouteForTestType
 *
 * @method \App\Model\Entity\Company get($primaryKey, $options = [])
 * @method \App\Model\Entity\Company newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Company[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Company|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Company saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Company patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Company[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Company findOrCreate($search, callable $callback = null, $options = [])
 */
class CompanyTable extends Table
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

        $this->setTable('company');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('CountryCode', [
            'foreignKey' => 'country_code_id'
        ]);
        $this->belongsTo('Company', [
            'foreignKey' => 'parent_company_id'
        ]);
        $this->belongsTo('CompanyStyle', [
            'foreignKey' => 'style_id'
        ]);
        $this->belongsTo('CurrencyCode', [
            'foreignKey' => 'currency_code_id'
        ]);
        $this->belongsTo('IvrTraversals', [
            'foreignKey' => 'ivr_traversal_id'
        ]);
        $this->belongsTo('Olds', [
            'foreignKey' => 'old_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('AgentConfirmationPrompt', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('AlertContactForCompany', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('AlertLevelForCompany', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('AlertMediumForCompany', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('AlertPolicyForDidHealth', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('AlertPolicyForExternalCall', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('AlertPolicyForFailCall', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('AlertPolicyForFollowupTest', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('AlertPolicyForFollowupTestOld', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('AlertPolicyForQuality', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('AlertPolicyForScoreDrop', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('ApiLogs', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('ApplicationForCompany', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('AutoRerunExcludeCountry', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('AutostopCondition', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('BillingCompanyRelation', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('BillingHistory', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('BillingSummaryDaily', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('BillingSummaryMonthly', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('Bridge', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('CallDescriptionGroupForCompany', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('Campaign', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('CampaignArchive', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('CampaignForIvr', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('CampaignTimeGroup', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('CliForTestTypeForCompany', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('ClicktodialPrompt', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('CompanyAutoRerunCondition', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('CompanyAutoRerunScoreThreshold', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('CompanyBilling', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('CompanyBillingWithCallBundle', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('CompanyBillingWithCountryBand', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('CompanyBillingWithTestType', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('CompanyCarrier', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('CompanyDepartment', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('CompanyExtension', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('CompanyExtraField', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('CompanyFollowupTest', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('CompanyJobtesterStyle', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('CompanyNumberCustomer', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('CompanyNumberDepartment', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('CompanyNumberLocation', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('CompanyOutageNotification', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('CompanyOwnedRoute', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('CompanyPrepayBilling', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('CompanyRegion', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('CompanyRerunTestLimit', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('CompanyWithUdial', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('ConferencePromptForCompany', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('CountryForCompany', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('CustomCompanyBenchmark', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('Dashboard', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('DidForCompany', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('EtoUser', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('FailedCallDescriptionForCompany', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('FilterDropdownForCompany', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('FullRecordingForCompany', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('HourlyTestReport', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('InternationalRouteForCompany', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('IvrTagForCompany', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('IvrTraversal', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('IvrTraversalActionForCompany', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('IvrTraversalPromptForCompany', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('IvrTypeAgentPrompt', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('Job', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('JobCreationForCompany', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('JobForIvr', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('JobProcessingExternal', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('JobProcessingOutboundEcho', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('MrepReportSchedule', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('Number', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('NumberExtraFieldForCompany', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('NumberFieldNameForCompany', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('NumberTag', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('NumberTimeGroup', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('OutageSuperTicket', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('PatrickConnectionCompany', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('PatrickConnectionCountry', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('PesqFieldsForCompany', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('Phonegroup', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('PolqaFieldsForCompany', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('PopulationRequestHistory', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('ProdialNumberSchema', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('ProviderPortForCompany', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('Role', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('ScoreCondition', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('SpearlineUserWithCompany', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('SupportAssignGroupForCompany', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('SupportDeskCompany', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('TempInfo', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('TempUsers', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('TestTypeCallForwarding', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('TestTypeForCompany', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('ToneAudioForCompany', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('UdialGroup', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('UnableToTestJob', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('User', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('UserInPhonegroup', [
            'foreignKey' => 'company_id'
        ]);
        $this->belongsToMany('Role', [
            'foreignKey' => 'company_id',
            'targetForeignKey' => 'role_id',
            'joinTable' => 'company_role'
        ]);
        $this->belongsToMany('RouteForTestType', [
            'foreignKey' => 'company_id',
            'targetForeignKey' => 'route_for_test_type_id',
            'joinTable' => 'company_route_for_test_type'
        ]);
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
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('address')
            ->maxLength('address', 255)
            ->requirePresence('address', 'create')
            ->notEmptyString('address');

        $validator
            ->scalar('city')
            ->maxLength('city', 255)
            ->notEmptyString('city');

        $validator
            ->scalar('phone')
            ->maxLength('phone', 30)
            ->notEmptyString('phone');

        $validator
            ->email('email')
            ->notEmptyString('email');

        $validator
            ->scalar('logo')
            ->maxLength('logo', 255)
            ->notEmptyString('logo');

        $validator
            ->scalar('report_logo')
            ->maxLength('report_logo', 255)
            ->notEmptyString('report_logo');

        $validator
            ->scalar('url')
            ->maxLength('url', 255)
            ->notEmptyString('url');

        $validator
            ->notEmptyString('no_of_users_allowed');

        $validator
            ->notEmptyString('campaign_style');

        $validator
            ->scalar('api_key')
            ->maxLength('api_key', 255)
            ->notEmptyString('api_key');

        $validator
            ->boolean('show_benchmarks')
            ->notEmptyString('show_benchmarks');

        $validator
            ->boolean('has_campaign_report')
            ->notEmptyString('has_campaign_report');

        $validator
            ->notEmptyString('status');

        $validator
            ->dateTime('expire_on')
            ->notEmptyDateTime('expire_on');

        $validator
            ->nonNegativeInteger('created_by')
            ->allowEmptyString('created_by');

        $validator
            ->dateTime('created_on')
            ->requirePresence('created_on', 'create')
            ->notEmptyDateTime('created_on');

        return $validator;
    }

    public function isAutomated($company_id)
    {
        $query = $this->ApplicationForCompany->find('all');
        $query->select(['count' => $query->func()->count('*')]);
        $query->where(['company_id' => $company_id, 'status' => 1, 'application_id !=' => 3]);
        $count =  $query->first();

        return ($count['count'] > 0);
    }

    public function isManualAllowed($company_id)
    {
        $query = $this->ApplicationForCompany->find('all');
        $query->where(['company_id' => $company_id, 'status' => 1, 'application_id =' => 3]);
        $m =  $query->first();

        return $m ? true : false;
    }

    public function getFiltersRerun($company_id) {
        $filters = array_keys($this->searchManager()->getFilters());
        $result = [];

        $this->CountryCode = TableRegistry::get('CountryCode');
        $countries = $this->CountryCode->find('list')
            ->where(['status =' => 1])
            ->order(['country_name' => 'ASC']);
        $result['country'] = ['options' => $countries, 'label' => false, 'empty' => 'Country'];

        $this->Number = TableRegistry::get('Number');
        $number = $this->Number->find('list', ['keyField' => 'id', 'valueField' => 'number'])
            ->where(['status =' => 1, 'company_id' => $company_id]);
        $result['number'] = ['options' => $number, 'label' => false, 'empty' => 'Number'];

        $this->NumberType = TableRegistry::get('NumberType');
        $number_type = $this->NumberType->find('list', ['keyField' => 'number_type', 'valueField' => 'number_type'])
            ->where(['status =' => 1]);
        $result['number_type'] = ['options' => $number_type, 'label' => false, 'empty' => 'Number Type'];

        return $result;

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
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['country_code_id'], 'CountryCode'));
        $rules->add($rules->existsIn(['parent_company_id'], 'Company'));
        $rules->add($rules->existsIn(['style_id'], 'CompanyStyle'));
        $rules->add($rules->existsIn(['currency_code_id'], 'CurrencyCode'));
        $rules->add($rules->existsIn(['ivr_traversal_id'], 'IvrTraversals'));
        $rules->add($rules->existsIn(['old_id'], 'Olds'));

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
}
