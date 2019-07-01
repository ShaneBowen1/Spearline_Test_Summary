<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SummaryHourlyTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SummaryHourlyTable Test Case
 */
class SummaryHourlyTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SummaryHourlyTable
     */
    public $SummaryHourly;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.SummaryHourly',
        'app.Companies'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('SummaryHourly') ? [] : ['className' => SummaryHourlyTable::class];
        $this->SummaryHourly = TableRegistry::getTableLocator()->get('SummaryHourly', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SummaryHourly);

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
}
