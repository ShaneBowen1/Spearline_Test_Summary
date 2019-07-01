<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CompanyTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CompanyTable Test Case
 */
class CompanyTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CompanyTable
     */
    public $Company;

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
        'app.RouteForTestType'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Company') ? [] : ['className' => CompanyTable::class];
        $this->Company = TableRegistry::getTableLocator()->get('Company', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Company);

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
