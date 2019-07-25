<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CompanyExtensionTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CompanyExtensionTable Test Case
 */
class CompanyExtensionTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CompanyExtensionTable
     */
    public $CompanyExtension;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.CompanyExtension',
        'app.CompanyTypes',
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
        $config = TableRegistry::getTableLocator()->exists('CompanyExtension') ? [] : ['className' => CompanyExtensionTable::class];
        $this->CompanyExtension = TableRegistry::getTableLocator()->get('CompanyExtension', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CompanyExtension);

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
