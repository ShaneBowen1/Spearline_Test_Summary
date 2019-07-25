<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CompanyExtensionFixture
 */
class CompanyExtensionFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'company_extension';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'company_id' => ['type' => 'smallinteger', 'length' => 5, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'company_type_id' => ['type' => 'tinyinteger', 'length' => 3, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'account_manager_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'manual_test_timeout' => ['type' => 'smallinteger', 'length' => 5, 'unsigned' => true, 'null' => false, 'default' => '300', 'comment' => 'In seconds', 'precision' => null],
        'gsm_on_manual_test' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        'api_doc_access' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        'management_report_access' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        'has_gsm' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        'view_passcode_tag' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        '_indexes' => [
            'account_manager_id' => ['type' => 'index', 'columns' => ['account_manager_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['company_id'], 'length' => []],
            'company_extension_ibfk_1' => ['type' => 'foreign', 'columns' => ['account_manager_id'], 'references' => ['user', 'id'], 'update' => 'restrict', 'delete' => 'setNull', 'length' => []],
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
                'company_type_id' => 1,
                'account_manager_id' => 1,
                'manual_test_timeout' => 1,
                'gsm_on_manual_test' => 1,
                'api_doc_access' => 1,
                'management_report_access' => 1,
                'has_gsm' => 1,
                'view_passcode_tag' => 1
            ],
        ];
        parent::init();
    }
}
