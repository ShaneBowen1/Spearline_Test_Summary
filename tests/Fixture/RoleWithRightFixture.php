<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RoleWithRightFixture
 */
class RoleWithRightFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'role_with_right';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'role_id' => ['type' => 'integer', 'length' => 8, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'right_id' => ['type' => 'smallinteger', 'length' => 5, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'status' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '1', 'comment' => '0-inactive,1-active', 'precision' => null],
        '_indexes' => [
            'right_id' => ['type' => 'index', 'columns' => ['right_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['role_id', 'right_id'], 'length' => []],
            'role_with_right_ibfk_1' => ['type' => 'foreign', 'columns' => ['role_id'], 'references' => ['role', 'id'], 'update' => 'restrict', 'delete' => 'cascade', 'length' => []],
            'role_with_right_ibfk_2' => ['type' => 'foreign', 'columns' => ['right_id'], 'references' => ['right', 'id'], 'update' => 'restrict', 'delete' => 'cascade', 'length' => []],
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
                'role_id' => 1,
                'right_id' => 1,
                'status' => 1
            ],
        ];
        parent::init();
    }
}
