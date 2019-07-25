<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TestTypeForCompanyFixture
 */
class TestTypeForCompanyFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'test_type_for_company';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'company_id' => ['type' => 'smallinteger', 'length' => 5, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'test_type_id' => ['type' => 'smallinteger', 'length' => 5, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'status' => ['type' => 'tinyinteger', 'length' => 3, 'unsigned' => true, 'null' => false, 'default' => '1', 'comment' => '0-inactive,1-active', 'precision' => null],
        '_indexes' => [
            'test_type_id' => ['type' => 'index', 'columns' => ['test_type_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['company_id', 'test_type_id'], 'length' => []],
            'test_type_for_company_ibfk_1' => ['type' => 'foreign', 'columns' => ['company_id'], 'references' => ['company', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'test_type_for_company_ibfk_2' => ['type' => 'foreign', 'columns' => ['test_type_id'], 'references' => ['test_type', 'id'], 'update' => 'restrict', 'delete' => 'cascade', 'length' => []],
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
                'company_id' => 1,
                'test_type_id' => 1,
                'status' => 1
            ],
        ];
        parent::init();
    }
}
