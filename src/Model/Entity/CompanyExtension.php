<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CompanyExtension Entity
 *
 * @property int $company_id
 * @property int|null $company_type_id
 * @property int|null $account_manager_id
 * @property int $manual_test_timeout
 * @property bool $gsm_on_manual_test
 * @property bool $api_doc_access
 * @property bool $management_report_access
 * @property bool $has_gsm
 * @property bool $view_passcode_tag
 *
 * @property \App\Model\Entity\CompanyType $company_type
 * @property \App\Model\Entity\User $user
 */
class CompanyExtension extends Entity
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
        'company_type_id' => true,
        'account_manager_id' => true,
        'manual_test_timeout' => true,
        'gsm_on_manual_test' => true,
        'api_doc_access' => true,
        'management_report_access' => true,
        'has_gsm' => true,
        'view_passcode_tag' => true,
        'company_type' => true,
        'user' => true
    ];
}
