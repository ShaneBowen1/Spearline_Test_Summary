<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RightWithAction Entity
 *
 * @property int $right_id
 * @property int $platform_action_id
 * @property bool $status
 *
 * @property \App\Model\Entity\Right $right
 * @property \App\Model\Entity\PlatformAction $platform_action
 */
class RightWithAction extends Entity
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
        'right' => true,
        'platform_action' => true
    ];
}
