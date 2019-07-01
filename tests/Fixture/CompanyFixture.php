<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CompanyFixture
 */
class CompanyFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'company';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'smallinteger', 'length' => 5, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'name' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'address' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'city' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => '', 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'country_code_id' => ['type' => 'smallinteger', 'length' => 5, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'phone' => ['type' => 'string', 'length' => 30, 'null' => false, 'default' => '', 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'email' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => '', 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'logo' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => '', 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'report_logo' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => '', 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'parent_company_id' => ['type' => 'smallinteger', 'length' => 5, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'style_id' => ['type' => 'tinyinteger', 'length' => 3, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'url' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => '', 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'currency_code_id' => ['type' => 'smallinteger', 'length' => 5, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'no_of_users_allowed' => ['type' => 'smallinteger', 'length' => 5, 'unsigned' => true, 'null' => false, 'default' => '10', 'comment' => '0-unlimited', 'precision' => null],
        'campaign_style' => ['type' => 'tinyinteger', 'length' => 3, 'unsigned' => true, 'null' => false, 'default' => '1', 'comment' => '1-Campaign,2-Rolling Campaign,3-Both', 'precision' => null],
        'api_key' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => '', 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'show_benchmarks' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        'ivr_traversal_id' => ['type' => 'integer', 'length' => 8, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => 'Default IVR traversal for Company', 'precision' => null, 'autoIncrement' => null],
        'has_campaign_report' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '1', 'comment' => '', 'precision' => null],
        'status' => ['type' => 'tinyinteger', 'length' => 3, 'unsigned' => true, 'null' => false, 'default' => '1', 'comment' => '0-inactive,1-active,2-deleted,3-Trial', 'precision' => null],
        'expire_on' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => '0000-00-00 00:00:00', 'comment' => '', 'precision' => null],
        'created_by' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created_on' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'old_id' => ['type' => 'smallinteger', 'length' => 5, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'country_code_id' => ['type' => 'index', 'columns' => ['country_code_id'], 'length' => []],
            'parent_company_id' => ['type' => 'index', 'columns' => ['parent_company_id'], 'length' => []],
            'currency_code_id' => ['type' => 'index', 'columns' => ['currency_code_id'], 'length' => []],
            'style_id' => ['type' => 'index', 'columns' => ['style_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'company_ibfk_1' => ['type' => 'foreign', 'columns' => ['country_code_id'], 'references' => ['country_code', 'id'], 'update' => 'restrict', 'delete' => 'setNull', 'length' => []],
            'company_ibfk_2' => ['type' => 'foreign', 'columns' => ['parent_company_id'], 'references' => ['company', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'company_ibfk_3' => ['type' => 'foreign', 'columns' => ['currency_code_id'], 'references' => ['currency_code', 'id'], 'update' => 'restrict', 'delete' => 'setNull', 'length' => []],
            'company_ibfk_4' => ['type' => 'foreign', 'columns' => ['style_id'], 'references' => ['company_style', 'id'], 'update' => 'restrict', 'delete' => 'setNull', 'length' => []],
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
                'name' => 'Lorem ipsum dolor sit amet',
                'address' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'country_code_id' => 1,
                'phone' => 'Lorem ipsum dolor sit amet',
                'email' => 'Lorem ipsum dolor sit amet',
                'logo' => 'Lorem ipsum dolor sit amet',
                'report_logo' => 'Lorem ipsum dolor sit amet',
                'parent_company_id' => 1,
                'style_id' => 1,
                'url' => 'Lorem ipsum dolor sit amet',
                'currency_code_id' => 1,
                'no_of_users_allowed' => 1,
                'campaign_style' => 1,
                'api_key' => 'Lorem ipsum dolor sit amet',
                'show_benchmarks' => 1,
                'ivr_traversal_id' => 1,
                'has_campaign_report' => 1,
                'status' => 1,
                'expire_on' => '2019-07-01 10:01:42',
                'created_by' => 1,
                'created_on' => '2019-07-01 10:01:42',
                'old_id' => 1
            ],
        ];
        parent::init();
    }
}
