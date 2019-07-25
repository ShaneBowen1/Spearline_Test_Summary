<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RoleWithRight Model
 *
 * @property \App\Model\Table\RoleTable|\Cake\ORM\Association\BelongsTo $Role
 * @property \App\Model\Table\RightTable|\Cake\ORM\Association\BelongsTo $Right
 *
 * @method \App\Model\Entity\RoleWithRight get($primaryKey, $options = [])
 * @method \App\Model\Entity\RoleWithRight newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\RoleWithRight[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RoleWithRight|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RoleWithRight saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RoleWithRight patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RoleWithRight[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\RoleWithRight findOrCreate($search, callable $callback = null, $options = [])
 */
class RoleWithRightTable extends Table
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

        $this->setTable('role_with_right');
        $this->setDisplayField('role_id');
        $this->setPrimaryKey(['role_id', 'right_id']);

        $this->belongsTo('Role', [
            'foreignKey' => 'role_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Right', [
            'foreignKey' => 'right_id',
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
            ->boolean('status')
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
        $rules->add($rules->existsIn(['role_id'], 'Role'));
        $rules->add($rules->existsIn(['right_id'], 'Right'));

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
