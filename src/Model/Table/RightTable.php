<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Right Model
 *
 * @property \App\Model\Table\RightWithActionTable|\Cake\ORM\Association\HasMany $RightWithAction
 * @property \App\Model\Table\RoleWithRightTable|\Cake\ORM\Association\HasMany $RoleWithRight
 *
 * @method \App\Model\Entity\Right get($primaryKey, $options = [])
 * @method \App\Model\Entity\Right newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Right[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Right|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Right patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Right[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Right findOrCreate($search, callable $callback = null, $options = [])
 */
class RightTable extends Table
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

        $this->setTable('right');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        /*$this->hasMany('RoleWithRight')
             ->setForeignKey('right_id')
             ->setJoinType('INNER');*/

        $this->hasMany('RoleWithRight', [
            'foreignKey' => 'right_id'
        ]);
        $this->hasMany('RightWithAction', [
            'foreignKey' => 'right_id'
        ]);
        $this->belongsToMany('PlatformAction', [
            'joinTable' => 'right_with_action',
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
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('name')
            ->requirePresence('name', 'create')
            ->notEmpty('name')
            ->add('name', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmpty('description');


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
        $rules->add($rules->isUnique(['name']));

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
