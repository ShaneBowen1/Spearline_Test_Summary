<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RemembermeTokenTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RemembermeTokenTable Test Case
 */
class RemembermeTokenTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RemembermeTokenTable
     */
    public $RemembermeToken;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.RemembermeToken',
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
        $config = TableRegistry::getTableLocator()->exists('RemembermeToken') ? [] : ['className' => RemembermeTokenTable::class];
        $this->RemembermeToken = TableRegistry::getTableLocator()->get('RemembermeToken', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RemembermeToken);

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
