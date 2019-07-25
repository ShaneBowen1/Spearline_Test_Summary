<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PlatformActionFixture
 */
class PlatformActionFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'platform_action';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'smallinteger', 'length' => 5, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'platform_controller_id' => ['type' => 'smallinteger', 'length' => 5, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'name' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'description' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => '', 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'status' => ['type' => 'tinyinteger', 'length' => 3, 'unsigned' => true, 'null' => false, 'default' => '1', 'comment' => '0-inactive,1-active,2-deleted', 'precision' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'platform_controller_id' => ['type' => 'unique', 'columns' => ['platform_controller_id', 'name'], 'length' => []],
            'platform_action_ibfk_1' => ['type' => 'foreign', 'columns' => ['platform_controller_id'], 'references' => ['platform_controller', 'id'], 'update' => 'restrict', 'delete' => 'cascade', 'length' => []],
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
                'platform_controller_id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'description' => 'Lorem ipsum dolor sit amet',
                'status' => 1
            ],
        ];
        parent::init();
    }
}
