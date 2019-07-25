<?php
namespace App\Test\TestCase\Controller;

use App\Controller\UserController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\UserController Test Case
 */
class UserControllerTest extends TestCase
{
    use IntegrationTestTrait;

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
