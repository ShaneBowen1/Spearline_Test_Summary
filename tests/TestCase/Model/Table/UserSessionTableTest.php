<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserSessionTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserSessionTable Test Case
 */
class UserSessionTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UserSessionTable
     */
    public $UserSession;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.UserSession'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('UserSession') ? [] : ['className' => UserSessionTable::class];
        $this->UserSession = TableRegistry::getTableLocator()->get('UserSession', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UserSession);

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
     * Test defaultConnectionName method
     *
     * @return void
     */
    public function testDefaultConnectionName()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
