<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SpearlineApplicationTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SpearlineApplicationTable Test Case
 */
class SpearlineApplicationTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SpearlineApplicationTable
     */
    public $SpearlineApplication;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.SpearlineApplication'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('SpearlineApplication') ? [] : ['className' => SpearlineApplicationTable::class];
        $this->SpearlineApplication = TableRegistry::getTableLocator()->get('SpearlineApplication', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SpearlineApplication);

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
