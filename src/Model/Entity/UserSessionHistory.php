<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserSessionHistory Entity
 *
 * @property int $user_id
 * @property \Cake\I18n\Time $login_time
 * @property \Cake\I18n\Time $logout_time
 * @property string $browser
 * @property string $platform
 * @property string $user_agent
 * @property int $public_ip
 * @property bool $is_forced_logout
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\SpearlineApplication $spearline_application
 */
class UserSessionHistory extends Entity
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
        '*' => true,
    ];
}
