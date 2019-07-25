<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * NumberFieldNameForCompany Entity
 *
 * @property int $company_id
 * @property int|null $application_id
 * @property int|null $test_type_id
 * @property string $field1_name
 * @property string $field2_name
 * @property string $field3_name
 * @property string $phonegroup_name
 * @property string $admin_passcode_name
 * @property string $user_passcode_name
 *
 * @property \App\Model\Entity\Company $company
 * @property \App\Model\Entity\SpearlineApplication $spearline_application
 * @property \App\Model\Entity\TestType $test_type
 */
class NumberFieldNameForCompany extends Entity
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
        'company_id' => true,
        'application_id' => true,
        'test_type_id' => true,
        'field1_name' => true,
        'field2_name' => true,
        'field3_name' => true,
        'phonegroup_name' => true,
        'admin_passcode_name' => true,
        'user_passcode_name' => true,
        'company' => true,
        'spearline_application' => true,
        'test_type' => true
    ];
}
