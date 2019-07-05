<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TestTypeFixture
 */
class TestTypeFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'test_type';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'smallinteger', 'length' => 5, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'application_id' => ['type' => 'tinyinteger', 'length' => 3, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'test_type' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'description' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => '', 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'status' => ['type' => 'tinyinteger', 'length' => 3, 'unsigned' => true, 'null' => false, 'default' => '1', 'comment' => '0-inactive,1-active,2-deleted', 'precision' => null],
        'job_processing_table' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'job_processing_rerun_table' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => '', 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'score_type' => ['type' => 'tinyinteger', 'length' => 3, 'unsigned' => true, 'null' => false, 'default' => '1', 'comment' => '0-No quality test,1-PESQ,2-POLQA,3-Both...', 'precision' => null],
        'pesq_table' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => '', 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'pesq_rerun_table' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => '', 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'polqa_table' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => '', 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'polqa_rerun_table' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => '', 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'reference_file' => ['type' => 'string', 'length' => 100, 'null' => false, 'default' => '', 'collate' => 'latin1_swedish_ci', 'comment' => 'Reference file for pesq/polqa', 'precision' => null, 'fixed' => null],
        'ref_file_length' => ['type' => 'float', 'length' => 6, 'precision' => 3, 'unsigned' => false, 'null' => false, 'default' => '0.000', 'comment' => 'Reference file length in seconds'],
        'checkin_timeout' => ['type' => 'smallinteger', 'length' => 5, 'unsigned' => true, 'null' => false, 'default' => '180', 'comment' => '', 'precision' => null],
        'no_of_prompts' => ['type' => 'tinyinteger', 'length' => 3, 'unsigned' => true, 'null' => false, 'default' => '1', 'comment' => '', 'precision' => null],
        'upload_full_recording' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        'campaign_style' => ['type' => 'tinyinteger', 'length' => 3, 'unsigned' => true, 'null' => false, 'default' => '1', 'comment' => '1-Campaign,2-Rolling Campaign,3-Both', 'precision' => null],
        'has_alert' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        'has_offset' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        'has_gsm' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => '0', 'comment' => '', 'precision' => null],
        '_indexes' => [
            'application_id' => ['type' => 'index', 'columns' => ['application_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'test_type' => ['type' => 'unique', 'columns' => ['test_type'], 'length' => []],
            'test_type_ibfk_1' => ['type' => 'foreign', 'columns' => ['application_id'], 'references' => ['spearline_application', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
                'application_id' => 1,
                'test_type' => 'Lorem ipsum dolor sit amet',
                'description' => 'Lorem ipsum dolor sit amet',
                'status' => 1,
                'job_processing_table' => 'Lorem ipsum dolor sit amet',
                'job_processing_rerun_table' => 'Lorem ipsum dolor sit amet',
                'score_type' => 1,
                'pesq_table' => 'Lorem ipsum dolor sit amet',
                'pesq_rerun_table' => 'Lorem ipsum dolor sit amet',
                'polqa_table' => 'Lorem ipsum dolor sit amet',
                'polqa_rerun_table' => 'Lorem ipsum dolor sit amet',
                'reference_file' => 'Lorem ipsum dolor sit amet',
                'ref_file_length' => 1,
                'checkin_timeout' => 1,
                'no_of_prompts' => 1,
                'upload_full_recording' => 1,
                'campaign_style' => 1,
                'has_alert' => 1,
                'has_offset' => 1,
                'has_gsm' => 1
            ],
        ];
        parent::init();
    }
}
