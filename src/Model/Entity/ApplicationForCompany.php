<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ApplicationForCompany Entity
 *
 * @property int $company_id
 * @property int $application_id
 * @property int $status
 *
 * @property \App\Model\Entity\Company $company
 * @property \App\Model\Entity\SpearlineApplication $spearline_application
 */
class ApplicationForCompany extends Entity
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
        'status' => true,
        'company' => true,
        'spearline_application' => true
    ];
}
