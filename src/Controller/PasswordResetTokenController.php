<?php
namespace App\Model\Table;

use App\Model\Entity\PasswordResetToken;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PasswordResetToken Model
 *
 * @property \Cake\ORM\Association\BelongsTo $User
 */
class PasswordResetTokenTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('password_reset_token');
        $this->displayField('token');
        $this->primaryKey('token');

        $this->belongsTo('User', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('User', [
            'foreignKey' => 'added_by',
            'joinType' => 'INNER'
        ]);
    }

    public function markTokenAsUsed($token)
    {
        $token_data = $this->get($token);
        if($token_data)
        {
            $res = $this->query()
                        ->update()
                        ->set(['status' => 2])
                        ->where(['token' => $token])
                        ->execute();
            $affectedRows = $res->rowCount();
            if($affectedRows == 1){
                return $this->markUserTokensAsInvalid($token_data->user_id);
            } else {
                return false;
            }
        } else {
            return false;
        }

    }

    public function markUserTokensAsInvalid($user_id)
    {
        $user_tokens = $this->find('all')
            ->where(['user_id' => $user_id, 'status' => 1])
            ->toArray();
        if(count($user_tokens))
        {
            $res = $this->query()
                        ->update()
                        ->set(['status' => 0])
                        ->where(['user_id' => $user_id, 'status' => 1])
                        ->execute();
            $affectedRows = $res->rowCount();
            if($affectedRows >= 1){
                return true;
            } else {
                return false;
            }
        }

        return true;
    }

    public function isTokenValid($token)
    {
        $token_data = $this->get($token);
        if(!$token_data)
        {
            return false;
        }

        if($token_data->expires_on->i18nFormat('yyyy-MM-dd HH:mm:ss') < date('Y-m-d H:i:s') || $token_data->status != 1)
        {
            return false;
        }

        return true;
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->notEmpty('token');

        $validator
            ->dateTime('expires_on')
            ->requirePresence('expires_on', 'create')
            ->notEmpty('expires_on');

        $validator
            ->dateTime('added_on')
            ->requirePresence('added_on', 'create')
            ->notEmpty('added_on');

        $validator
            ->integer('added_by')
            ->requirePresence('added_by', 'create')
            ->notEmpty('added_by');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['user_id'], 'User'));
        $rules->add($rules->existsIn(['added_by'], 'User'));
        return $rules;
    }
}
