<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserTable Test Case
 */
class UserTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UserTable
     */
    public $User;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.User',
        'app.Company',
        'app.CountryCode',
        'app.Timezone',
        'app.CompanyDepartment',
        'app.Olds',
        'app.Role',
        'app.ApiLogs',
        'app.AuditLog',
        'app.CampaignApprovalHistory',
        'app.CompanyJobtesterStyle',
        'app.EditLog',
        'app.EtoPasswordResetToken',
        'app.GoogleAgent',
        'app.GoogleAgentLocation',
        'app.GoogleAgentNoPort',
        'app.IdialHistory',
        'app.JobNote',
        'app.JobProcessingGoogleAgent',
        'app.JobProcessingIdial',
        'app.JobProcessingManual',
        'app.NumberExtension',
        'app.NumberFailHandler',
        'app.NumberFailHandlerHistory',
        'app.PasswordResetToken',
        'app.RemembermeToken',
        'app.ReportSchedule',
        'app.RoleForUser',
        'app.SpearlineIdialUser',
        'app.SpearlineNotification',
        'app.SpearlineUserWithCompany',
        'app.StickyJob',
        'app.SupportAssignGroupForUser',
        'app.SupportDeskCompany',
        'app.SupportDeskUser',
        'app.SupportTagForNumber',
        'app.SupportUser',
        'app.TempJobProcessingGoogleAgent',
        'app.UdialCallHistory',
        'app.UdialGroupForUser',
        'app.UserEmailAccount',
        'app.UserForUdial',
        'app.UserInPhonegroup',
        'app.UserSession',
        'app.UserSessionHistory'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('User') ? [] : ['className' => UserTable::class];
        $this->User = TableRegistry::getTableLocator()->get('User', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->User);

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
