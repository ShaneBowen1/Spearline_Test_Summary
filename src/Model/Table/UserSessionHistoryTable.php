<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserSessionHistory Model
 *
 * @property \Cake\ORM\Association\BelongsTo $User
 *
 * @method \App\Model\Entity\UserSessionHistory get($primaryKey, $options = [])
 * @method \App\Model\Entity\UserSessionHistory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UserSessionHistory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UserSessionHistory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserSessionHistory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UserSessionHistory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UserSessionHistory findOrCreate($search, callable $callback = null, $options = [])
 */
class UserSessionHistoryTable extends Table
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

        $this->table('user_session_history');
        $this->displayField('user_id');
        $this->primaryKey(['user_id', 'login_time']);

        $this->belongsTo('User', [
            'foreignKey' => 'user_id',
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
            ->dateTime('login_time')
            ->allowEmpty('login_time', 'create');

        $validator
            ->dateTime('logout_time');
            //->requirePresence('logout_time', 'create')
            //->notEmpty('logout_time');

        $validator
            ->requirePresence('browser', 'create')
            ->notEmpty('browser');

        $validator
            ->requirePresence('platform', 'create')
            ->notEmpty('platform');

        $validator
            ->requirePresence('user_agent', 'create')
            ->notEmpty('user_agent');

        $validator
            ->integer('public_ip')
            ->requirePresence('public_ip', 'create')
            ->notEmpty('public_ip');

        $validator
            ->boolean('is_forced_logout')
            ->requirePresence('is_forced_logout', 'create')
            ->notEmpty('is_forced_logout');

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
