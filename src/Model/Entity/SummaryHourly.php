<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SummaryHourly Entity
 *
 * @property \Cake\I18n\FrozenTime $hour_timestamp
 * @property int $company_id
 * @property int $test_type_id
 * @property int $total_pstn_calls
 * @property int $total_gsm_calls
 * @property bool $updated
 *
 * @property \App\Model\Entity\Company $company
 */
class SummaryHourly extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'hour_timestamp' => true,
        'company_id' => true,
        'test_type_id' => true,
        'total_pstn_calls' => true,
        'total_gsm_calls' => true,
        'updated' => true,
        'company' => true
    ];
}
