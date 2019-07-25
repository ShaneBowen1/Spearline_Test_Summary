<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RightWithActionFixture
 */
class RightWithActionFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'right_with_action';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'right_id' => ['type' => 'smallinteger', 'length' => 5, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'platform_action_id' => ['type' => 'smallinteger', 'length' => 5, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'status' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '1', 'comment' => '0-inactive,1-active', 'precision' => null],
        '_indexes' => [
            'platform_action_id' => ['type' => 'index', 'columns' => ['platform_action_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['right_id', 'platform_action_id'], 'length' => []],
            'right_with_action_ibfk_1' => ['type' => 'foreign', 'columns' => ['right_id'], 'references' => ['right', 'id'], 'update' => 'restrict', 'delete' => 'cascade', 'length' => []],
            'right_with_action_ibfk_2' => ['type' => 'foreign', 'columns' => ['platform_action_id'], 'references' => ['platform_action', 'id'], 'update' => 'restrict', 'delete' => 'cascade', 'length' => []],
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
                'right_id' => 1,
                'platform_action_id' => 1,
                'status' => 1
            ],
        ];
        parent::init();
    }
}
