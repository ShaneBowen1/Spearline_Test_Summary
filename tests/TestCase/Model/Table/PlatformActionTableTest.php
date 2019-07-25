<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PlatformActionTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PlatformActionTable Test Case
 */
class PlatformActionTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PlatformActionTable
     */
    public $PlatformAction;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.PlatformAction',
        'app.PlatformController',
        'app.RightWithAction'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('PlatformAction') ? [] : ['className' => PlatformActionTable::class];
        $this->PlatformAction = TableRegistry::getTableLocator()->get('PlatformAction', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PlatformAction);

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
