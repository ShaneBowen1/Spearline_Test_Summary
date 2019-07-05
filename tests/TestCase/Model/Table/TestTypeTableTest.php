<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TestTypeTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TestTypeTable Test Case
 */
class TestTypeTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TestTypeTable
     */
    public $TestType;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.TestType',
        'app.SpearlineApplication',
        'app.AlertCall',
        'app.AlertCallNoPort',
        'app.AlertIgnore',
        'app.AlertPolicyForExternalCallHistory',
        'app.AlertPolicyForFailCallHistory',
        'app.AlertPolicyForFollowupTestHistory',
        'app.AlertPolicyForQualityHistory',
        'app.AutoRerunTest',
        'app.BelowThresholdScore',
        'app.BillingSummaryDaily',
        'app.BillingSummaryMonthly',
        'app.CallDescriptionGroupForTestType',
        'app.CallDescriptionHistory',
        'app.Campaign',
        'app.CampaignForIvr',
        'app.CliForTestType',
        'app.CliForTestTypeForCompany',
        'app.CompanyBillingIncludedTestType',
        'app.CompanyFollowupTest',
        'app.CompanyJobtesterStyle',
        'app.CompanyOutageNotificationHistory',
        'app.CompanyOutageRestoreHistory',
        'app.CompanyOwnedRoute',
        'app.CompanyRerunTestLimit',
        'app.CompanyRouteForTestType',
        'app.DeferredEmail',
        'app.DidForCompany',
        'app.EtoJobProcessing',
        'app.FailedPesqPolqa',
        'app.FailedTestReview',
        'app.FollowupTestHistory',
        'app.FullRecordingForCompany',
        'app.InvalidTestRecording',
        'app.IvrNextTestForOption',
        'app.IvrTranscriptionHistory',
        'app.IvrTypeTagHistory',
        'app.Job',
        'app.JobForIvr',
        'app.JobProcessing',
        'app.JobProcessing2way',
        'app.JobProcessing2wayRerun',
        'app.JobProcessingAgentConnection',
        'app.JobProcessingAgentConnectionRerun',
        'app.JobProcessingAudioLatency',
        'app.JobProcessingAudioLatencyRerun',
        'app.JobProcessingConf',
        'app.JobProcessingConfDynamicPrompt',
        'app.JobProcessingConfDynamicPromptRerun',
        'app.JobProcessingConfInternational',
        'app.JobProcessingConfInternationalRerun',
        'app.JobProcessingConfLongCall',
        'app.JobProcessingConfLongCallRerun',
        'app.JobProcessingConfRerun',
        'app.JobProcessingConfSingleCall',
        'app.JobProcessingConfSingleCallRerun',
        'app.JobProcessingConfSip',
        'app.JobProcessingConfSipRerun',
        'app.JobProcessingConfWithTone',
        'app.JobProcessingConfWithToneRerun',
        'app.JobProcessingConnection',
        'app.JobProcessingConnectionRerun',
        'app.JobProcessingDtmf',
        'app.JobProcessingDtmfRerun',
        'app.JobProcessingEcho',
        'app.JobProcessingEchoRerun',
        'app.JobProcessingEmail',
        'app.JobProcessingEmailRerun',
        'app.JobProcessingExternal',
        'app.JobProcessingFailover',
        'app.JobProcessingFailoverRerun',
        'app.JobProcessingFax',
        'app.JobProcessingFaxRerun',
        'app.JobProcessingGoogleAgent',
        'app.JobProcessingGoogleLoadBalance',
        'app.JobProcessingIdial',
        'app.JobProcessingInboundEcho',
        'app.JobProcessingInboundEchoRerun',
        'app.JobProcessingInternational',
        'app.JobProcessingInternationalRerun',
        'app.JobProcessingIvr',
        'app.JobProcessingIvrMap',
        'app.JobProcessingIvrMapRerun',
        'app.JobProcessingIvrRerun',
        'app.JobProcessingIvrType',
        'app.JobProcessingIvrTypePhase2',
        'app.JobProcessingIvrTypePhase2Rerun',
        'app.JobProcessingIvrTypeRerun',
        'app.JobProcessingIvrTypeT',
        'app.JobProcessingLatency',
        'app.JobProcessingLatencyRerun',
        'app.JobProcessingLink',
        'app.JobProcessingLinkRerun',
        'app.JobProcessingManual',
        'app.JobProcessingMultiPrompt',
        'app.JobProcessingMultiPromptRerun',
        'app.JobProcessingOutboundConf',
        'app.JobProcessingOutboundConfRerun',
        'app.JobProcessingOutboundEcho',
        'app.JobProcessingPatrickConnection',
        'app.JobProcessingPatrickConnectionRerun',
        'app.JobProcessingRecordingOnly',
        'app.JobProcessingRerun',
        'app.JobProcessingSip',
        'app.JobProcessingSipRerun',
        'app.JobProcessingSkype',
        'app.JobProcessingSkypeRerun',
        'app.JobProcessingUserInput',
        'app.JobProcessingUserInputRerun',
        'app.LatestJpId',
        'app.NumberFieldNameForCompany',
        'app.NumberWithOverrideRoute',
        'app.PatrickConnectionJob',
        'app.PopulationRequestHistory',
        'app.PossibleAlert',
        'app.RerunHistory',
        'app.RouteForTestType',
        'app.ScoreCondition',
        'app.SipTest',
        'app.SnmpTrapHistory',
        'app.TempAlertPolicyForFailCallHistory',
        'app.TempAlertPolicyForQualityHistory',
        'app.TempDidForCompany',
        'app.TempInfo',
        'app.TempJobProcessingGoogleAgent',
        'app.TestApprovalHistory',
        'app.TestPosting',
        'app.TestTypeCallForwarding',
        'app.TestTypeExtra',
        'app.TestTypeForCompany'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TestType') ? [] : ['className' => TestTypeTable::class];
        $this->TestType = TableRegistry::getTableLocator()->get('TestType', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TestType);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test defaultConnectionName method
     *
     * @return void
     */
    public function testDefaultConnectionName()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
