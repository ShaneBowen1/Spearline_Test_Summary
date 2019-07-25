<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PlatformAction Model
 *
 * @property \App\Model\Table\PlatformControllerTable|\Cake\ORM\Association\BelongsTo $PlatformController
 * @property \App\Model\Table\RightWithActionTable|\Cake\ORM\Association\HasMany $RightWithAction
 *
 * @method \App\Model\Entity\PlatformAction get($primaryKey, $options = [])
 * @method \App\Model\Entity\PlatformAction newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PlatformAction[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PlatformAction|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PlatformAction saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PlatformAction patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PlatformAction[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PlatformAction findOrCreate($search, callable $callback = null, $options = [])
 */
class PlatformActionTable extends Table
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

        $this->setTable('platform_action');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('PlatformController', [
            'foreignKey' => 'platform_controller_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('RightWithAction', [
            'foreignKey' => 'platform_action_id'
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
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->allowEmptyString('name', false);

        $validator
            ->scalar('description')
            ->maxLength('description', 255)
            ->allowEmptyString('description', false);

        $validator
            ->allowEmptyString('status', false);

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
        $rules->add($rules->existsIn(['platform_controller_id'], 'PlatformController'));

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
