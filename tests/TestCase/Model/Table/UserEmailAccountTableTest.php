<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserEmailAccountTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserEmailAccountTable Test Case
 */
class UserEmailAccountTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UserEmailAccountTable
     */
    public $UserEmailAccount;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.UserEmailAccount',
        'app.User',
        'app.EmailServerType'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('UserEmailAccount') ? [] : ['className' => UserEmailAccountTable::class];
        $this->UserEmailAccount = TableRegistry::getTableLocator()->get('UserEmailAccount', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UserEmailAccount);

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
