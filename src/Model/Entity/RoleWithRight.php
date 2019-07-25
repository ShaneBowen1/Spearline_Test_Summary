<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RoleWithRight Entity
 *
 * @property int $role_id
 * @property int $right_id
 * @property bool $status
 *
 * @property \App\Model\Entity\Role $role
 * @property \App\Model\Entity\Right $right
 */
class RoleWithRight extends Entity
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
        'role' => true,
        'right' => true
    ];
}
