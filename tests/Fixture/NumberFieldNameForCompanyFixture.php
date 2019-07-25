<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * NumberFieldNameForCompanyFixture
 */
class NumberFieldNameForCompanyFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'number_field_name_for_company';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'company_id' => ['type' => 'smallinteger', 'length' => 5, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'application_id' => ['type' => 'tinyinteger', 'length' => 3, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'test_type_id' => ['type' => 'smallinteger', 'length' => 5, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => 'Use test_type_id 1 for the moment for all the entries', 'precision' => null],
        'field1_name' => ['type' => 'string', 'length' => 80, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'field2_name' => ['type' => 'string', 'length' => 80, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'field3_name' => ['type' => 'string', 'length' => 80, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'phonegroup_name' => ['type' => 'string', 'length' => 80, 'null' => false, 'default' => 'Phonegroup', 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'admin_passcode_name' => ['type' => 'string', 'length' => 80, 'null' => false, 'default' => 'Moderator Passcode', 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'user_passcode_name' => ['type' => 'string', 'length' => 80, 'null' => false, 'default' => 'Participant Passcode', 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        '_indexes' => [
            'test_type_id' => ['type' => 'index', 'columns' => ['test_type_id'], 'length' => []],
            'application_id' => ['type' => 'index', 'columns' => ['application_id'], 'length' => []],
        ],
        '_constraints' => [
            'company_id' => ['type' => 'unique', 'columns' => ['company_id', 'application_id'], 'length' => []],
            'number_field_name_for_company_ibfk_1' => ['type' => 'foreign', 'columns' => ['company_id'], 'references' => ['company', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'number_field_name_for_company_ibfk_2' => ['type' => 'foreign', 'columns' => ['test_type_id'], 'references' => ['test_type', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'number_field_name_for_company_ibfk_3' => ['type' => 'foreign', 'columns' => ['application_id'], 'references' => ['spearline_application', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
                'test_type_id' => 1,
                'field1_name' => 'Lorem ipsum dolor sit amet',
                'field2_name' => 'Lorem ipsum dolor sit amet',
                'field3_name' => 'Lorem ipsum dolor sit amet',
                'phonegroup_name' => 'Lorem ipsum dolor sit amet',
                'admin_passcode_name' => 'Lorem ipsum dolor sit amet',
                'user_passcode_name' => 'Lorem ipsum dolor sit amet'
            ],
        ];
        parent::init();
    }
}
