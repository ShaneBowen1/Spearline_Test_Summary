<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserEmailAccount Entity
 *
 * @property int $user_id
 * @property int $email_server_type_id
 * @property string $host
 * @property int|null $port
 * @property string $password
 * @property string $account
 * @property bool|null $status
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\EmailServerType $email_server_type
 */
class UserEmailAccount extends Entity
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
        'user_id' => true,
        'email_server_type_id' => true,
        'host' => true,
        'port' => true,
        'password' => true,
        'account' => true,
        'status' => true,
        'user' => true,
        'email_server_type' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
}
