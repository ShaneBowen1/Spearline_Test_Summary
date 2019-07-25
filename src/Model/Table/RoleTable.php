<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Role Model
 *
 * @property \App\Model\Table\CompanyTable|\Cake\ORM\Association\BelongsTo $Company
 * @property \App\Model\Table\RoleWithRightTable|\Cake\ORM\Association\HasMany $RoleWithRight
 * @property \App\Model\Table\UserWithRoleTable|\Cake\ORM\Association\HasMany $UserWithRole
 * @property \App\Model\Table\CompanyTable|\Cake\ORM\Association\BelongsToMany $Company
 *
 * @method \App\Model\Entity\Role get($primaryKey, $options = [])
 * @method \App\Model\Entity\Role newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Role[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Role|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Role patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Role[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Role findOrCreate($search, callable $callback = null, $options = [])
 */
class RoleTable extends Table
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

        $this->setTable('role');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Company', [
            'foreignKey' => 'company_id',
            'joinType' => 'LEFT'
        ]);
        $this->belongsTo('Creator', [
            'foreignKey' => 'created_by',
            'joinType' => 'INNER',
            'className' => 'User'
        ]);
        $this->hasMany('RoleWithRight', [
            'foreignKey' => 'role_id'
        ]);
        $this->hasMany('user', [
            'foreignKey' => 'role_id'
        ]);
        $this->belongsToMany('Right', [
            'joinTable' => 'role_with_right'
        ]);
        // $this->hasMany('UserWithRole', [
        //     'foreignKey' => 'role_id'
        // ]);
        // $this->belongsToMany('Company', [
        //     'foreignKey' => 'role_id',
        //     'targetForeignKey' => 'company_id',
        //     'joinTable' => 'company_role'
        // ]);
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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('name')
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmpty('description');

        $validator
            ->integer('created_by')
            ->allowEmpty('created_by');

        $validator
            ->dateTime('created_on')
            ->requirePresence('created_on', 'create')
            ->notEmpty('created_on');

        $validator
            ->requirePresence('status', 'create')
            ->notEmpty('status');

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
        $rules->add($rules->existsIn(['company_id'], 'Company'));

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
