<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UserFixture
 */
class UserFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'user';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'company_id' => ['type' => 'smallinteger', 'length' => 5, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'name' => ['type' => 'string', 'length' => 100, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'email' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'sms' => ['type' => 'string', 'length' => 20, 'null' => false, 'default' => '', 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'country_code_id' => ['type' => 'smallinteger', 'length' => 5, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'timezone_id' => ['type' => 'smallinteger', 'length' => 5, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'department_id' => ['type' => 'integer', 'length' => 8, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'login_name' => ['type' => 'string', 'length' => 60, 'null' => false, 'default' => '', 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'password' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'created_by' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created_on' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'edited_on' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'show' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        'status' => ['type' => 'tinyinteger', 'length' => 3, 'unsigned' => true, 'null' => false, 'default' => '1', 'comment' => '0-inactive,1-active,2-deleted', 'precision' => null],
        'backendadmin' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => 'Remove this field once roles and rights are implemented', 'precision' => null],
        'old_id' => ['type' => 'smallinteger', 'length' => 5, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'role_id' => ['type' => 'integer', 'length' => 8, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'api_access' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        'login_token' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => '', 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        '_indexes' => [
            'company_id' => ['type' => 'index', 'columns' => ['company_id'], 'length' => []],
            'country_code_id' => ['type' => 'index', 'columns' => ['country_code_id'], 'length' => []],
            'timezone_id' => ['type' => 'index', 'columns' => ['timezone_id'], 'length' => []],
            'created_by' => ['type' => 'index', 'columns' => ['created_by'], 'length' => []],
            'department_id' => ['type' => 'index', 'columns' => ['department_id'], 'length' => []],
            'role_id' => ['type' => 'index', 'columns' => ['role_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'email' => ['type' => 'unique', 'columns' => ['email'], 'length' => []],
            'user_ibfk_1' => ['type' => 'foreign', 'columns' => ['company_id'], 'references' => ['company', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'user_ibfk_2' => ['type' => 'foreign', 'columns' => ['country_code_id'], 'references' => ['country_code', 'id'], 'update' => 'restrict', 'delete' => 'setNull', 'length' => []],
            'user_ibfk_3' => ['type' => 'foreign', 'columns' => ['timezone_id'], 'references' => ['timezone', 'id'], 'update' => 'restrict', 'delete' => 'setNull', 'length' => []],
            'user_ibfk_4' => ['type' => 'foreign', 'columns' => ['created_by'], 'references' => ['user', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'user_ibfk_5' => ['type' => 'foreign', 'columns' => ['department_id'], 'references' => ['company_department', 'id'], 'update' => 'restrict', 'delete' => 'setNull', 'length' => []],
            'user_ibfk_6' => ['type' => 'foreign', 'columns' => ['role_id'], 'references' => ['role', 'id'], 'update' => 'restrict', 'delete' => 'setNull', 'length' => []],
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
                'id' => 1,
                'company_id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'email' => 'Lorem ipsum dolor sit amet',
                'sms' => 'Lorem ipsum dolor ',
                'country_code_id' => 1,
                'timezone_id' => 1,
                'department_id' => 1,
                'login_name' => 'Lorem ipsum dolor sit amet',
                'password' => 'Lorem ipsum dolor sit amet',
                'created_by' => 1,
                'created_on' => '2019-07-25 08:14:21',
                'edited_on' => '2019-07-25 08:14:21',
                'show' => 1,
                'status' => 1,
                'backendadmin' => 1,
                'old_id' => 1,
                'role_id' => 1,
                'api_access' => 1,
                'login_token' => 'Lorem ipsum dolor sit amet'
            ],
        ];
        parent::init();
    }
}
