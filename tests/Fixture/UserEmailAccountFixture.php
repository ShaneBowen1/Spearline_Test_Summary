<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UserEmailAccountFixture
 */
class UserEmailAccountFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'user_email_account';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'user_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'email_server_type_id' => ['type' => 'integer', 'length' => 5, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'host' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'port' => ['type' => 'integer', 'length' => 5, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'password' => ['type' => 'string', 'length' => 100, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'account' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'status' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => '1', 'comment' => '0-deleted,1-Active,2-Inactive', 'precision' => null],
        '_indexes' => [
            'user_id' => ['type' => 'index', 'columns' => ['user_id'], 'length' => []],
            'user_email_account_fk_2' => ['type' => 'index', 'columns' => ['email_server_type_id'], 'length' => []],
        ],
        '_constraints' => [
            'user_email_account_uk1' => ['type' => 'unique', 'columns' => ['user_id'], 'length' => []],
            'user_email_account_fk_2' => ['type' => 'foreign', 'columns' => ['email_server_type_id'], 'references' => ['email_server_type', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'user_email_account_ibfk_1' => ['type' => 'foreign', 'columns' => ['user_id'], 'references' => ['user', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'latin1_swedish_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd
    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'user_id' => 1,
                'email_server_type_id' => 1,
                'host' => 'Lorem ipsum dolor sit amet',
                'port' => 1,
                'password' => 'Lorem ipsum dolor sit amet',
                'account' => 'Lorem ipsum dolor sit amet',
                'status' => 1
            ],
        ];
        parent::init();
    }
}
