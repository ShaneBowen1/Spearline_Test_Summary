<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ApplicationForCompanyFixture
 */
class ApplicationForCompanyFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'application_for_company';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'company_id' => ['type' => 'smallinteger', 'length' => 5, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'application_id' => ['type' => 'tinyinteger', 'length' => 3, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'status' => ['type' => 'tinyinteger', 'length' => 3, 'unsigned' => true, 'null' => false, 'default' => '1', 'comment' => '0-inactive,1-active', 'precision' => null],
        '_indexes' => [
            'application_id' => ['type' => 'index', 'columns' => ['application_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['company_id', 'application_id'], 'length' => []],
            'application_for_company_ibfk_1' => ['type' => 'foreign', 'columns' => ['company_id'], 'references' => ['company', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'application_for_company_ibfk_2' => ['type' => 'foreign', 'columns' => ['application_id'], 'references' => ['spearline_application', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
                'application_id' => 1,
                'status' => 1
            ],
        ];
        parent::init();
    }
}
