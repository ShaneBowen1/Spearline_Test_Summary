<?php
namespace App\Test\TestCase\Controller;

use App\Controller\TestTypeController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\TestTypeController Test Case
 */
class TestTypeControllerTest extends TestCase
{
    use IntegrationTestTrait;

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
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
