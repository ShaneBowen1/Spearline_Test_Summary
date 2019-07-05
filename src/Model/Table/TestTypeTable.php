<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TestType Model
 *
 * @property \App\Model\Table\SpearlineApplicationTable|\Cake\ORM\Association\BelongsTo $SpearlineApplication
 * @property \App\Model\Table\AlertCallTable|\Cake\ORM\Association\HasMany $AlertCall
 * @property \App\Model\Table\AlertCallNoPortTable|\Cake\ORM\Association\HasMany $AlertCallNoPort
 * @property \App\Model\Table\AlertIgnoreTable|\Cake\ORM\Association\HasMany $AlertIgnore
 * @property \App\Model\Table\AlertPolicyForExternalCallHistoryTable|\Cake\ORM\Association\HasMany $AlertPolicyForExternalCallHistory
 * @property \App\Model\Table\AlertPolicyForFailCallHistoryTable|\Cake\ORM\Association\HasMany $AlertPolicyForFailCallHistory
 * @property \App\Model\Table\AlertPolicyForFollowupTestHistoryTable|\Cake\ORM\Association\HasMany $AlertPolicyForFollowupTestHistory
 * @property \App\Model\Table\AlertPolicyForQualityHistoryTable|\Cake\ORM\Association\HasMany $AlertPolicyForQualityHistory
 * @property \App\Model\Table\AutoRerunTestTable|\Cake\ORM\Association\HasMany $AutoRerunTest
 * @property \App\Model\Table\BelowThresholdScoreTable|\Cake\ORM\Association\HasMany $BelowThresholdScore
 * @property \App\Model\Table\BillingSummaryDailyTable|\Cake\ORM\Association\HasMany $BillingSummaryDaily
 * @property \App\Model\Table\BillingSummaryMonthlyTable|\Cake\ORM\Association\HasMany $BillingSummaryMonthly
 * @property \App\Model\Table\CallDescriptionGroupForTestTypeTable|\Cake\ORM\Association\HasMany $CallDescriptionGroupForTestType
 * @property \App\Model\Table\CallDescriptionHistoryTable|\Cake\ORM\Association\HasMany $CallDescriptionHistory
 * @property \App\Model\Table\CampaignTable|\Cake\ORM\Association\HasMany $Campaign
 * @property \App\Model\Table\CampaignForIvrTable|\Cake\ORM\Association\HasMany $CampaignForIvr
 * @property \App\Model\Table\CliForTestTypeTable|\Cake\ORM\Association\HasMany $CliForTestType
 * @property \App\Model\Table\CliForTestTypeForCompanyTable|\Cake\ORM\Association\HasMany $CliForTestTypeForCompany
 * @property \App\Model\Table\CompanyBillingIncludedTestTypeTable|\Cake\ORM\Association\HasMany $CompanyBillingIncludedTestType
 * @property \App\Model\Table\CompanyFollowupTestTable|\Cake\ORM\Association\HasMany $CompanyFollowupTest
 * @property \App\Model\Table\CompanyJobtesterStyleTable|\Cake\ORM\Association\HasMany $CompanyJobtesterStyle
 * @property \App\Model\Table\CompanyOutageNotificationHistoryTable|\Cake\ORM\Association\HasMany $CompanyOutageNotificationHistory
 * @property \App\Model\Table\CompanyOutageRestoreHistoryTable|\Cake\ORM\Association\HasMany $CompanyOutageRestoreHistory
 * @property \App\Model\Table\CompanyOwnedRouteTable|\Cake\ORM\Association\HasMany $CompanyOwnedRoute
 * @property \App\Model\Table\CompanyRerunTestLimitTable|\Cake\ORM\Association\HasMany $CompanyRerunTestLimit
 * @property \App\Model\Table\CompanyRouteForTestTypeTable|\Cake\ORM\Association\HasMany $CompanyRouteForTestType
 * @property \App\Model\Table\DeferredEmailTable|\Cake\ORM\Association\HasMany $DeferredEmail
 * @property \App\Model\Table\DidForCompanyTable|\Cake\ORM\Association\HasMany $DidForCompany
 * @property \App\Model\Table\EtoJobProcessingTable|\Cake\ORM\Association\HasMany $EtoJobProcessing
 * @property \App\Model\Table\FailedPesqPolqaTable|\Cake\ORM\Association\HasMany $FailedPesqPolqa
 * @property \App\Model\Table\FailedTestReviewTable|\Cake\ORM\Association\HasMany $FailedTestReview
 * @property \App\Model\Table\FollowupTestHistoryTable|\Cake\ORM\Association\HasMany $FollowupTestHistory
 * @property \App\Model\Table\FullRecordingForCompanyTable|\Cake\ORM\Association\HasMany $FullRecordingForCompany
 * @property \App\Model\Table\InvalidTestRecordingTable|\Cake\ORM\Association\HasMany $InvalidTestRecording
 * @property \App\Model\Table\IvrNextTestForOptionTable|\Cake\ORM\Association\HasMany $IvrNextTestForOption
 * @property \App\Model\Table\IvrTranscriptionHistoryTable|\Cake\ORM\Association\HasMany $IvrTranscriptionHistory
 * @property \App\Model\Table\IvrTypeTagHistoryTable|\Cake\ORM\Association\HasMany $IvrTypeTagHistory
 * @property \App\Model\Table\JobTable|\Cake\ORM\Association\HasMany $Job
 * @property \App\Model\Table\JobForIvrTable|\Cake\ORM\Association\HasMany $JobForIvr
 * @property \App\Model\Table\JobProcessingTable|\Cake\ORM\Association\HasMany $JobProcessing
 * @property \App\Model\Table\JobProcessing2wayTable|\Cake\ORM\Association\HasMany $JobProcessing2way
 * @property \App\Model\Table\JobProcessing2wayRerunTable|\Cake\ORM\Association\HasMany $JobProcessing2wayRerun
 * @property \App\Model\Table\JobProcessingAgentConnectionTable|\Cake\ORM\Association\HasMany $JobProcessingAgentConnection
 * @property \App\Model\Table\JobProcessingAgentConnectionRerunTable|\Cake\ORM\Association\HasMany $JobProcessingAgentConnectionRerun
 * @property \App\Model\Table\JobProcessingAudioLatencyTable|\Cake\ORM\Association\HasMany $JobProcessingAudioLatency
 * @property \App\Model\Table\JobProcessingAudioLatencyRerunTable|\Cake\ORM\Association\HasMany $JobProcessingAudioLatencyRerun
 * @property \App\Model\Table\JobProcessingConfTable|\Cake\ORM\Association\HasMany $JobProcessingConf
 * @property \App\Model\Table\JobProcessingConfDynamicPromptTable|\Cake\ORM\Association\HasMany $JobProcessingConfDynamicPrompt
 * @property \App\Model\Table\JobProcessingConfDynamicPromptRerunTable|\Cake\ORM\Association\HasMany $JobProcessingConfDynamicPromptRerun
 * @property \App\Model\Table\JobProcessingConfInternationalTable|\Cake\ORM\Association\HasMany $JobProcessingConfInternational
 * @property \App\Model\Table\JobProcessingConfInternationalRerunTable|\Cake\ORM\Association\HasMany $JobProcessingConfInternationalRerun
 * @property \App\Model\Table\JobProcessingConfLongCallTable|\Cake\ORM\Association\HasMany $JobProcessingConfLongCall
 * @property \App\Model\Table\JobProcessingConfLongCallRerunTable|\Cake\ORM\Association\HasMany $JobProcessingConfLongCallRerun
 * @property \App\Model\Table\JobProcessingConfRerunTable|\Cake\ORM\Association\HasMany $JobProcessingConfRerun
 * @property \App\Model\Table\JobProcessingConfSingleCallTable|\Cake\ORM\Association\HasMany $JobProcessingConfSingleCall
 * @property \App\Model\Table\JobProcessingConfSingleCallRerunTable|\Cake\ORM\Association\HasMany $JobProcessingConfSingleCallRerun
 * @property \App\Model\Table\JobProcessingConfSipTable|\Cake\ORM\Association\HasMany $JobProcessingConfSip
 * @property \App\Model\Table\JobProcessingConfSipRerunTable|\Cake\ORM\Association\HasMany $JobProcessingConfSipRerun
 * @property \App\Model\Table\JobProcessingConfWithToneTable|\Cake\ORM\Association\HasMany $JobProcessingConfWithTone
 * @property \App\Model\Table\JobProcessingConfWithToneRerunTable|\Cake\ORM\Association\HasMany $JobProcessingConfWithToneRerun
 * @property \App\Model\Table\JobProcessingConnectionTable|\Cake\ORM\Association\HasMany $JobProcessingConnection
 * @property \App\Model\Table\JobProcessingConnectionRerunTable|\Cake\ORM\Association\HasMany $JobProcessingConnectionRerun
 * @property \App\Model\Table\JobProcessingDtmfTable|\Cake\ORM\Association\HasMany $JobProcessingDtmf
 * @property \App\Model\Table\JobProcessingDtmfRerunTable|\Cake\ORM\Association\HasMany $JobProcessingDtmfRerun
 * @property \App\Model\Table\JobProcessingEchoTable|\Cake\ORM\Association\HasMany $JobProcessingEcho
 * @property \App\Model\Table\JobProcessingEchoRerunTable|\Cake\ORM\Association\HasMany $JobProcessingEchoRerun
 * @property \App\Model\Table\JobProcessingEmailTable|\Cake\ORM\Association\HasMany $JobProcessingEmail
 * @property \App\Model\Table\JobProcessingEmailRerunTable|\Cake\ORM\Association\HasMany $JobProcessingEmailRerun
 * @property \App\Model\Table\JobProcessingExternalTable|\Cake\ORM\Association\HasMany $JobProcessingExternal
 * @property \App\Model\Table\JobProcessingFailoverTable|\Cake\ORM\Association\HasMany $JobProcessingFailover
 * @property \App\Model\Table\JobProcessingFailoverRerunTable|\Cake\ORM\Association\HasMany $JobProcessingFailoverRerun
 * @property \App\Model\Table\JobProcessingFaxTable|\Cake\ORM\Association\HasMany $JobProcessingFax
 * @property \App\Model\Table\JobProcessingFaxRerunTable|\Cake\ORM\Association\HasMany $JobProcessingFaxRerun
 * @property \App\Model\Table\JobProcessingGoogleAgentTable|\Cake\ORM\Association\HasMany $JobProcessingGoogleAgent
 * @property \App\Model\Table\JobProcessingGoogleLoadBalanceTable|\Cake\ORM\Association\HasMany $JobProcessingGoogleLoadBalance
 * @property \App\Model\Table\JobProcessingIdialTable|\Cake\ORM\Association\HasMany $JobProcessingIdial
 * @property \App\Model\Table\JobProcessingInboundEchoTable|\Cake\ORM\Association\HasMany $JobProcessingInboundEcho
 * @property \App\Model\Table\JobProcessingInboundEchoRerunTable|\Cake\ORM\Association\HasMany $JobProcessingInboundEchoRerun
 * @property \App\Model\Table\JobProcessingInternationalTable|\Cake\ORM\Association\HasMany $JobProcessingInternational
 * @property \App\Model\Table\JobProcessingInternationalRerunTable|\Cake\ORM\Association\HasMany $JobProcessingInternationalRerun
 * @property \App\Model\Table\JobProcessingIvrTable|\Cake\ORM\Association\HasMany $JobProcessingIvr
 * @property \App\Model\Table\JobProcessingIvrMapTable|\Cake\ORM\Association\HasMany $JobProcessingIvrMap
 * @property \App\Model\Table\JobProcessingIvrMapRerunTable|\Cake\ORM\Association\HasMany $JobProcessingIvrMapRerun
 * @property \App\Model\Table\JobProcessingIvrRerunTable|\Cake\ORM\Association\HasMany $JobProcessingIvrRerun
 * @property \App\Model\Table\JobProcessingIvrTypeTable|\Cake\ORM\Association\HasMany $JobProcessingIvrType
 * @property \App\Model\Table\JobProcessingIvrTypePhase2Table|\Cake\ORM\Association\HasMany $JobProcessingIvrTypePhase2
 * @property \App\Model\Table\JobProcessingIvrTypePhase2RerunTable|\Cake\ORM\Association\HasMany $JobProcessingIvrTypePhase2Rerun
 * @property \App\Model\Table\JobProcessingIvrTypeRerunTable|\Cake\ORM\Association\HasMany $JobProcessingIvrTypeRerun
 * @property \App\Model\Table\JobProcessingIvrTypeTTable|\Cake\ORM\Association\HasMany $JobProcessingIvrTypeT
 * @property \App\Model\Table\JobProcessingLatencyTable|\Cake\ORM\Association\HasMany $JobProcessingLatency
 * @property \App\Model\Table\JobProcessingLatencyRerunTable|\Cake\ORM\Association\HasMany $JobProcessingLatencyRerun
 * @property \App\Model\Table\JobProcessingLinkTable|\Cake\ORM\Association\HasMany $JobProcessingLink
 * @property \App\Model\Table\JobProcessingLinkRerunTable|\Cake\ORM\Association\HasMany $JobProcessingLinkRerun
 * @property \App\Model\Table\JobProcessingManualTable|\Cake\ORM\Association\HasMany $JobProcessingManual
 * @property \App\Model\Table\JobProcessingMultiPromptTable|\Cake\ORM\Association\HasMany $JobProcessingMultiPrompt
 * @property \App\Model\Table\JobProcessingMultiPromptRerunTable|\Cake\ORM\Association\HasMany $JobProcessingMultiPromptRerun
 * @property \App\Model\Table\JobProcessingOutboundConfTable|\Cake\ORM\Association\HasMany $JobProcessingOutboundConf
 * @property \App\Model\Table\JobProcessingOutboundConfRerunTable|\Cake\ORM\Association\HasMany $JobProcessingOutboundConfRerun
 * @property \App\Model\Table\JobProcessingOutboundEchoTable|\Cake\ORM\Association\HasMany $JobProcessingOutboundEcho
 * @property \App\Model\Table\JobProcessingPatrickConnectionTable|\Cake\ORM\Association\HasMany $JobProcessingPatrickConnection
 * @property \App\Model\Table\JobProcessingPatrickConnectionRerunTable|\Cake\ORM\Association\HasMany $JobProcessingPatrickConnectionRerun
 * @property \App\Model\Table\JobProcessingRecordingOnlyTable|\Cake\ORM\Association\HasMany $JobProcessingRecordingOnly
 * @property \App\Model\Table\JobProcessingRerunTable|\Cake\ORM\Association\HasMany $JobProcessingRerun
 * @property \App\Model\Table\JobProcessingSipTable|\Cake\ORM\Association\HasMany $JobProcessingSip
 * @property \App\Model\Table\JobProcessingSipRerunTable|\Cake\ORM\Association\HasMany $JobProcessingSipRerun
 * @property \App\Model\Table\JobProcessingSkypeTable|\Cake\ORM\Association\HasMany $JobProcessingSkype
 * @property \App\Model\Table\JobProcessingSkypeRerunTable|\Cake\ORM\Association\HasMany $JobProcessingSkypeRerun
 * @property \App\Model\Table\JobProcessingUserInputTable|\Cake\ORM\Association\HasMany $JobProcessingUserInput
 * @property \App\Model\Table\JobProcessingUserInputRerunTable|\Cake\ORM\Association\HasMany $JobProcessingUserInputRerun
 * @property \App\Model\Table\LatestJpIdTable|\Cake\ORM\Association\HasMany $LatestJpId
 * @property \App\Model\Table\NumberFieldNameForCompanyTable|\Cake\ORM\Association\HasMany $NumberFieldNameForCompany
 * @property \App\Model\Table\NumberWithOverrideRouteTable|\Cake\ORM\Association\HasMany $NumberWithOverrideRoute
 * @property \App\Model\Table\PatrickConnectionJobTable|\Cake\ORM\Association\HasMany $PatrickConnectionJob
 * @property \App\Model\Table\PopulationRequestHistoryTable|\Cake\ORM\Association\HasMany $PopulationRequestHistory
 * @property \App\Model\Table\PossibleAlertTable|\Cake\ORM\Association\HasMany $PossibleAlert
 * @property \App\Model\Table\RerunHistoryTable|\Cake\ORM\Association\HasMany $RerunHistory
 * @property \App\Model\Table\RouteForTestTypeTable|\Cake\ORM\Association\HasMany $RouteForTestType
 * @property \App\Model\Table\ScoreConditionTable|\Cake\ORM\Association\HasMany $ScoreCondition
 * @property \App\Model\Table\SipTestTable|\Cake\ORM\Association\HasMany $SipTest
 * @property \App\Model\Table\SnmpTrapHistoryTable|\Cake\ORM\Association\HasMany $SnmpTrapHistory
 * @property \App\Model\Table\TempAlertPolicyForFailCallHistoryTable|\Cake\ORM\Association\HasMany $TempAlertPolicyForFailCallHistory
 * @property \App\Model\Table\TempAlertPolicyForQualityHistoryTable|\Cake\ORM\Association\HasMany $TempAlertPolicyForQualityHistory
 * @property \App\Model\Table\TempDidForCompanyTable|\Cake\ORM\Association\HasMany $TempDidForCompany
 * @property \App\Model\Table\TempInfoTable|\Cake\ORM\Association\HasMany $TempInfo
 * @property \App\Model\Table\TempJobProcessingGoogleAgentTable|\Cake\ORM\Association\HasMany $TempJobProcessingGoogleAgent
 * @property \App\Model\Table\TestApprovalHistoryTable|\Cake\ORM\Association\HasMany $TestApprovalHistory
 * @property \App\Model\Table\TestPostingTable|\Cake\ORM\Association\HasMany $TestPosting
 * @property \App\Model\Table\TestTypeCallForwardingTable|\Cake\ORM\Association\HasMany $TestTypeCallForwarding
 * @property \App\Model\Table\TestTypeExtraTable|\Cake\ORM\Association\HasMany $TestTypeExtra
 * @property \App\Model\Table\TestTypeForCompanyTable|\Cake\ORM\Association\HasMany $TestTypeForCompany
 *
 * @method \App\Model\Entity\TestType get($primaryKey, $options = [])
 * @method \App\Model\Entity\TestType newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TestType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TestType|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TestType saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TestType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TestType[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TestType findOrCreate($search, callable $callback = null, $options = [])
 */
class TestTypeTable extends Table
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

        $this->setTable('test_type');
        $this->setDisplayField('test_type');
        $this->setPrimaryKey('id');

        $this->belongsTo('SpearlineApplication', [
            'foreignKey' => 'application_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('AlertCall', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('AlertCallNoPort', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('AlertIgnore', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('AlertPolicyForExternalCallHistory', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('AlertPolicyForFailCallHistory', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('AlertPolicyForFollowupTestHistory', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('AlertPolicyForQualityHistory', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('AutoRerunTest', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('BelowThresholdScore', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('BillingSummaryDaily', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('BillingSummaryMonthly', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('CallDescriptionGroupForTestType', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('CallDescriptionHistory', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('Campaign', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('CampaignForIvr', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('CliForTestType', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('CliForTestTypeForCompany', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('CompanyBillingIncludedTestType', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('CompanyFollowupTest', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('CompanyJobtesterStyle', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('CompanyOutageNotificationHistory', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('CompanyOutageRestoreHistory', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('CompanyOwnedRoute', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('CompanyRerunTestLimit', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('CompanyRouteForTestType', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('DeferredEmail', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('DidForCompany', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('EtoJobProcessing', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('FailedPesqPolqa', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('FailedTestReview', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('FollowupTestHistory', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('FullRecordingForCompany', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('InvalidTestRecording', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('IvrNextTestForOption', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('IvrTranscriptionHistory', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('IvrTypeTagHistory', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('Job', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobForIvr', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessing', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessing2way', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessing2wayRerun', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingAgentConnection', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingAgentConnectionRerun', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingAudioLatency', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingAudioLatencyRerun', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingConf', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingConfDynamicPrompt', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingConfDynamicPromptRerun', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingConfInternational', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingConfInternationalRerun', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingConfLongCall', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingConfLongCallRerun', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingConfRerun', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingConfSingleCall', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingConfSingleCallRerun', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingConfSip', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingConfSipRerun', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingConfWithTone', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingConfWithToneRerun', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingConnection', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingConnectionRerun', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingDtmf', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingDtmfRerun', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingEcho', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingEchoRerun', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingEmail', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingEmailRerun', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingExternal', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingFailover', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingFailoverRerun', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingFax', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingFaxRerun', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingGoogleAgent', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingGoogleLoadBalance', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingIdial', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingInboundEcho', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingInboundEchoRerun', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingInternational', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingInternationalRerun', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingIvr', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingIvrMap', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingIvrMapRerun', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingIvrRerun', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingIvrType', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingIvrTypePhase2', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingIvrTypePhase2Rerun', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingIvrTypeRerun', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingIvrTypeT', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingLatency', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingLatencyRerun', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingLink', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingLinkRerun', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingManual', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingMultiPrompt', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingMultiPromptRerun', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingOutboundConf', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingOutboundConfRerun', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingOutboundEcho', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingPatrickConnection', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingPatrickConnectionRerun', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingRecordingOnly', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingRerun', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingSip', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingSipRerun', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingSkype', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingSkypeRerun', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingUserInput', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('JobProcessingUserInputRerun', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('LatestJpId', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('NumberFieldNameForCompany', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('NumberWithOverrideRoute', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('PatrickConnectionJob', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('PopulationRequestHistory', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('PossibleAlert', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('RerunHistory', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('RouteForTestType', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('ScoreCondition', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('SipTest', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('SnmpTrapHistory', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('TempAlertPolicyForFailCallHistory', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('TempAlertPolicyForQualityHistory', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('TempDidForCompany', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('TempInfo', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('TempJobProcessingGoogleAgent', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('TestApprovalHistory', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('TestPosting', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('TestTypeCallForwarding', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('TestTypeExtra', [
            'foreignKey' => 'test_type_id'
        ]);
        $this->hasMany('TestTypeForCompany', [
            'foreignKey' => 'test_type_id'
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
            ->scalar('test_type')
            ->maxLength('test_type', 255)
            ->requirePresence('test_type', 'create')
            ->allowEmptyString('test_type', false)
            ->add('test_type', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('description')
            ->maxLength('description', 255)
            ->allowEmptyString('description', false);

        $validator
            ->allowEmptyString('status', false);

        $validator
            ->scalar('job_processing_table')
            ->maxLength('job_processing_table', 255)
            ->requirePresence('job_processing_table', 'create')
            ->allowEmptyString('job_processing_table', false);

        $validator
            ->scalar('job_processing_rerun_table')
            ->maxLength('job_processing_rerun_table', 255)
            ->allowEmptyString('job_processing_rerun_table', false);

        $validator
            ->allowEmptyString('score_type', false);

        $validator
            ->scalar('pesq_table')
            ->maxLength('pesq_table', 255)
            ->allowEmptyString('pesq_table', false);

        $validator
            ->scalar('pesq_rerun_table')
            ->maxLength('pesq_rerun_table', 255)
            ->allowEmptyString('pesq_rerun_table', false);

        $validator
            ->scalar('polqa_table')
            ->maxLength('polqa_table', 255)
            ->allowEmptyString('polqa_table', false);

        $validator
            ->scalar('polqa_rerun_table')
            ->maxLength('polqa_rerun_table', 255)
            ->allowEmptyString('polqa_rerun_table', false);

        $validator
            ->scalar('reference_file')
            ->maxLength('reference_file', 100)
            ->allowEmptyFile('reference_file', false);

        $validator
            ->numeric('ref_file_length')
            ->allowEmptyFile('ref_file_length', false);

        $validator
            ->allowEmptyString('checkin_timeout', false);

        $validator
            ->allowEmptyString('no_of_prompts', false);

        $validator
            ->boolean('upload_full_recording')
            ->allowEmptyString('upload_full_recording', false);

        $validator
            ->allowEmptyString('campaign_style', false);

        $validator
            ->boolean('has_alert')
            ->allowEmptyString('has_alert', false);

        $validator
            ->boolean('has_offset')
            ->allowEmptyString('has_offset', false);

        $validator
            ->boolean('has_gsm')
            ->allowEmptyString('has_gsm');

        return $validator;
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
        $rules->add($rules->isUnique(['test_type']));
        $rules->add($rules->existsIn(['application_id'], 'SpearlineApplication'));

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
