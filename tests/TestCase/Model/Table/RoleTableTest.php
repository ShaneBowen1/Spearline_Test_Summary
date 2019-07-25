<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RoleTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RoleTable Test Case
 */
class RoleTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RoleTable
     */
    public $Role;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Role',
        'app.Company',
        'app.RoleWithRight',
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
        $config = TableRegistry::getTableLocator()->exists('Role') ? [] : ['className' => RoleTable::class];
        $this->Role = TableRegistry::getTableLocator()->get('Role', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Role);

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
