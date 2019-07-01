<?php
namespace App\Test\TestCase\Controller;

use App\Controller\CompanyController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\CompanyController Test Case
 */
class CompanyControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Company',
        'app.CountryCode',
        'app.CompanyStyle',
        'app.CurrencyCode',
        'app.IvrTraversals',
        'app.Olds',
        'app.AgentConfirmationPrompt',
        'app.AlertContactForCompany',
        'app.AlertLevelForCompany',
        'app.AlertMediumForCompany',
        'app.AlertPolicyForDidHealth',
        'app.AlertPolicyForExternalCall',
        'app.AlertPolicyForFailCall',
        'app.AlertPolicyForFollowupTest',
        'app.AlertPolicyForFollowupTestOld',
        'app.AlertPolicyForQuality',
        'app.AlertPolicyForScoreDrop',
        'app.ApiLogs',
        'app.ApplicationForCompany',
        'app.AutoRerunExcludeCountry',
        'app.AutostopCondition',
        'app.BillingCompanyRelation',
        'app.BillingHistory',
        'app.BillingSummaryDaily',
        'app.BillingSummaryMonthly',
        'app.Bridge',
        'app.CallDescriptionGroupForCompany',
        'app.Campaign',
        'app.CampaignArchive',
        'app.CampaignForIvr',
        'app.CampaignTimeGroup',
        'app.CliForTestTypeForCompany',
        'app.ClicktodialPrompt',
        'app.CompanyAutoRerunCondition',
        'app.CompanyAutoRerunScoreThreshold',
        'app.CompanyBilling',
        'app.CompanyBillingWithCallBundle',
        'app.CompanyBillingWithCountryBand',
        'app.CompanyBillingWithTestType',
        'app.CompanyCarrier',
        'app.CompanyDepartment',
        'app.CompanyExtension',
        'app.CompanyExtraField',
        'app.CompanyFollowupTest',
        'app.CompanyJobtesterStyle',
        'app.CompanyNumberCustomer',
        'app.CompanyNumberDepartment',
        'app.CompanyNumberLocation',
        'app.CompanyOutageNotification',
        'app.CompanyOwnedRoute',
        'app.CompanyPrepayBilling',
        'app.CompanyRegion',
        'app.CompanyRerunTestLimit',
        'app.CompanyWithUdial',
        'app.ConferencePromptForCompany',
        'app.CountryForCompany',
        'app.CustomCompanyBenchmark',
        'app.Dashboard',
        'app.DidForCompany',
        'app.EtoUser',
        'app.FailedCallDescriptionForCompany',
        'app.FilterDropdownForCompany',
        'app.FullRecordingForCompany',
        'app.HourlyTestReport',
        'app.InternationalRouteForCompany',
        'app.IvrTagForCompany',
        'app.IvrTraversal',
        'app.IvrTraversalActionForCompany',
        'app.IvrTraversalPromptForCompany',
        'app.IvrTypeAgentPrompt',
        'app.Job',
        'app.JobCreationForCompany',
        'app.JobForIvr',
        'app.JobProcessingExternal',
        'app.JobProcessingOutboundEcho',
        'app.MrepReportSchedule',
        'app.Number',
        'app.NumberExtraFieldForCompany',
        'app.NumberFieldNameForCompany',
        'app.NumberTag',
        'app.NumberTimeGroup',
        'app.OutageSuperTicket',
        'app.PatrickConnectionCompany',
        'app.PatrickConnectionCountry',
        'app.PesqFieldsForCompany',
        'app.Phonegroup',
        'app.PolqaFieldsForCompany',
        'app.PopulationRequestHistory',
        'app.ProdialNumberSchema',
        'app.ProviderPortForCompany',
        'app.Role',
        'app.ScoreCondition',
        'app.SpearlineUserWithCompany',
        'app.SupportAssignGroupForCompany',
        'app.SupportDeskCompany',
        'app.TempInfo',
        'app.TempUsers',
        'app.TestTypeCallForwarding',
        'app.TestTypeForCompany',
        'app.ToneAudioForCompany',
        'app.UdialGroup',
        'app.UnableToTestJob',
        'app.User',
        'app.UserInPhonegroup',
        'app.RouteForTestType',
        'app.CompanyRole',
        'app.CompanyRouteForTestType'
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
