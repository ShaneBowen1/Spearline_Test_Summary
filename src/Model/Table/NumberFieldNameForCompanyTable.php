<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * NumberFieldNameForCompany Model
 *
 * @property \App\Model\Table\CompanyTable|\Cake\ORM\Association\BelongsTo $Company
 * @property \App\Model\Table\SpearlineApplicationTable|\Cake\ORM\Association\BelongsTo $SpearlineApplication
 * @property \App\Model\Table\TestTypeTable|\Cake\ORM\Association\BelongsTo $TestType
 *
 * @method \App\Model\Entity\NumberFieldNameForCompany get($primaryKey, $options = [])
 * @method \App\Model\Entity\NumberFieldNameForCompany newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\NumberFieldNameForCompany[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\NumberFieldNameForCompany|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\NumberFieldNameForCompany saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\NumberFieldNameForCompany patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\NumberFieldNameForCompany[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\NumberFieldNameForCompany findOrCreate($search, callable $callback = null, $options = [])
 */
class NumberFieldNameForCompanyTable extends Table
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

        $this->setTable('number_field_name_for_company');

        $this->belongsTo('Company', [
            'foreignKey' => 'company_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('SpearlineApplication', [
            'foreignKey' => 'application_id'
        ]);
        $this->belongsTo('TestType', [
            'foreignKey' => 'test_type_id'
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
            ->scalar('field1_name')
            ->maxLength('field1_name', 80)
            ->requirePresence('field1_name', 'create')
            ->allowEmptyString('field1_name', false);

        $validator
            ->scalar('field2_name')
            ->maxLength('field2_name', 80)
            ->requirePresence('field2_name', 'create')
            ->allowEmptyString('field2_name', false);

        $validator
            ->scalar('field3_name')
            ->maxLength('field3_name', 80)
            ->requirePresence('field3_name', 'create')
            ->allowEmptyString('field3_name', false);

        $validator
            ->scalar('phonegroup_name')
            ->maxLength('phonegroup_name', 80)
            ->allowEmptyString('phonegroup_name', false);

        $validator
            ->scalar('admin_passcode_name')
            ->maxLength('admin_passcode_name', 80)
            ->allowEmptyString('admin_passcode_name', false);

        $validator
            ->scalar('user_passcode_name')
            ->maxLength('user_passcode_name', 80)
            ->allowEmptyString('user_passcode_name', false);

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
        $rules->add($rules->existsIn(['application_id'], 'SpearlineApplication'));
        $rules->add($rules->existsIn(['test_type_id'], 'TestType'));

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
