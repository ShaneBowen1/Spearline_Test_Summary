<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RoleWithRightTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RoleWithRightTable Test Case
 */
class RoleWithRightTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RoleWithRightTable
     */
    public $RoleWithRight;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.RoleWithRight',
        'app.Role',
        'app.Right'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('RoleWithRight') ? [] : ['className' => RoleWithRightTable::class];
        $this->RoleWithRight = TableRegistry::getTableLocator()->get('RoleWithRight', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RoleWithRight);

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
