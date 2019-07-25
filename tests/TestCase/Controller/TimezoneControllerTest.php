<?php
namespace App\Test\TestCase\Controller;

use App\Controller\TimezoneController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\TimezoneController Test Case
 */
class TimezoneControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Timezone',
        'app.Campaign',
        'app.CompanyWithUdial',
        'app.EtoCountryDefaultSetting',
        'app.EtoUser',
        'app.MrepReportSchedule',
        'app.MrepReportScheduleHistory',
        'app.NumberForIvr',
        'app.NumberForIvrType',
        'app.NumberTimeGroup',
        'app.ReportSchedule',
        'app.TempUsers',
        'app.TimezoneOffset',
        'app.User',
        'app.UserForUdial'
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
