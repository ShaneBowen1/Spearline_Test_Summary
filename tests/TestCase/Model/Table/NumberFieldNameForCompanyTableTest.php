<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\NumberFieldNameForCompanyTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\NumberFieldNameForCompanyTable Test Case
 */
class NumberFieldNameForCompanyTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\NumberFieldNameForCompanyTable
     */
    public $NumberFieldNameForCompany;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.NumberFieldNameForCompany',
        'app.Company',
        'app.SpearlineApplication',
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
        $config = TableRegistry::getTableLocator()->exists('NumberFieldNameForCompany') ? [] : ['className' => NumberFieldNameForCompanyTable::class];
        $this->NumberFieldNameForCompany = TableRegistry::getTableLocator()->get('NumberFieldNameForCompany', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->NumberFieldNameForCompany);

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
