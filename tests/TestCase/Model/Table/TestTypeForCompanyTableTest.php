<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TestTypeForCompanyTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TestTypeForCompanyTable Test Case
 */
class TestTypeForCompanyTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TestTypeForCompanyTable
     */
    public $TestTypeForCompany;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.TestTypeForCompany',
        'app.Company',
        'app.TestType'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TestTypeForCompany') ? [] : ['className' => TestTypeForCompanyTable::class];
        $this->TestTypeForCompany = TableRegistry::getTableLocator()->get('TestTypeForCompany', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TestTypeForCompany);

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
