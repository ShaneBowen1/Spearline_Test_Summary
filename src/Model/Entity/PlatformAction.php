<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PlatformAction Entity
 *
 * @property int $id
 * @property int $platform_controller_id
 * @property string $name
 * @property string $description
 * @property int $status
 *
 * @property \App\Model\Entity\PlatformController $platform_controller
 * @property \App\Model\Entity\RightWithAction[] $right_with_action
 */
class PlatformAction extends Entity
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
        'platform_controller_id' => true,
        'name' => true,
        'description' => true,
        'status' => true,
        'platform_controller' => true,
        'right_with_action' => true
    ];
}
