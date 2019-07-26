<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserEmailAccount Model
 *
 * @property \App\Model\Table\UserTable|\Cake\ORM\Association\BelongsTo $User
 * @property \App\Model\Table\EmailServerTypeTable|\Cake\ORM\Association\BelongsTo $EmailServerType
 *
 * @method \App\Model\Entity\UserEmailAccount get($primaryKey, $options = [])
 * @method \App\Model\Entity\UserEmailAccount newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UserEmailAccount[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UserEmailAccount|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserEmailAccount saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserEmailAccount patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UserEmailAccount[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UserEmailAccount findOrCreate($search, callable $callback = null, $options = [])
 */
class UserEmailAccountTable extends Table
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

        $this->setTable('user_email_account');

        $this->belongsTo('User', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('EmailServerType', [
            'foreignKey' => 'email_server_type_id',
            'joinType' => 'INNER'
        ]);
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
            ->scalar('host')
            ->maxLength('host', 255)
            ->requirePresence('host', 'create')
            ->allowEmptyString('host', false);

        $validator
            ->nonNegativeInteger('port')
            ->allowEmptyString('port');

        $validator
            ->scalar('password')
            ->maxLength('password', 100)
            ->requirePresence('password', 'create')
            ->allowEmptyString('password', false);

        $validator
            ->scalar('account')
            ->maxLength('account', 255)
            ->requirePresence('account', 'create')
            ->allowEmptyString('account', false);

        $validator
            ->boolean('status')
            ->allowEmptyString('status');

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
        $rules->add($rules->existsIn(['email_server_type_id'], 'EmailServerType'));

        return $rules;
    }

    /**
     * Returns the database connection name to use by default.
     *
     * @return string
     */
    public static function defaultConnectionName()
    {
        return 'spearlinedb';
    }
}
