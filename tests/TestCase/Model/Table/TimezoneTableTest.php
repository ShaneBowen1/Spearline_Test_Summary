<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TimezoneTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TimezoneTable Test Case
 */
class TimezoneTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TimezoneTable
     */
    public $Timezone;

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
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Timezone') ? [] : ['className' => TimezoneTable::class];
        $this->Timezone = TableRegistry::getTableLocator()->get('Timezone', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Timezone);

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
     * Test defaultConnectionName method
     *
     * @return void
     */
    public function testDefaultConnectionName()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
