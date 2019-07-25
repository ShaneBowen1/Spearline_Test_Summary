<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserSessionHistoryTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserSessionHistoryTable Test Case
 */
class UserSessionHistoryTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UserSessionHistoryTable
     */
    public $UserSessionHistory;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.UserSessionHistory',
        'app.User'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('UserSessionHistory') ? [] : ['className' => UserSessionHistoryTable::class];
        $this->UserSessionHistory = TableRegistry::getTableLocator()->get('UserSessionHistory', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UserSessionHistory);

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
