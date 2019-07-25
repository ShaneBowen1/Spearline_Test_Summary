<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Role Entity
 *
 * @property int $id
 * @property int|null $company_id
 * @property string $name
 * @property string $description
 * @property int|null $created_by
 * @property \Cake\I18n\FrozenTime $created_on
 * @property int $status
 *
 * @property \App\Model\Entity\Company[] $company
 * @property \App\Model\Entity\RoleWithRight[] $role_with_right
 * @property \App\Model\Entity\User[] $user
 */
class Role extends Entity
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
        'name' => true,
        'description' => true,
        'created_by' => true,
        'created_on' => true,
        'status' => true,
        'company' => true,
        'role_with_right' => true,
        'user' => true
    ];
}
