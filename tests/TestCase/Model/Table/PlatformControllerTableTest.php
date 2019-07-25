<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PlatformControllerTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PlatformControllerTable Test Case
 */
class PlatformControllerTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PlatformControllerTable
     */
    public $PlatformController;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.PlatformController',
        'app.PlatformAction'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('PlatformController') ? [] : ['className' => PlatformControllerTable::class];
        $this->PlatformController = TableRegistry::getTableLocator()->get('PlatformController', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PlatformController);

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
