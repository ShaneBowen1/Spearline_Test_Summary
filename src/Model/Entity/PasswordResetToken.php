<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PasswordResetToken Entity.
 *
 * @property string $token
 * @property int $user_id
 * @property \App\Model\Entity\User $user
 * @property \Cake\I18n\Time $expires_on
 * @property \Cake\I18n\Time $added_on
 * @property int $added_by
 */
class PasswordResetToken extends Entity
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
        'token' => true,
    ];

    /**
     * Fields that are excluded from JSON an array versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
    
    ];
}
