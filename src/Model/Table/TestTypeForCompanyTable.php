<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TestTypeForCompany Model
 *
 * @property \App\Model\Table\CompanyTable|\Cake\ORM\Association\BelongsTo $Company
 * @property \App\Model\Table\TestTypeTable|\Cake\ORM\Association\BelongsTo $TestType
 *
 * @method \App\Model\Entity\TestTypeForCompany get($primaryKey, $options = [])
 * @method \App\Model\Entity\TestTypeForCompany newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TestTypeForCompany[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TestTypeForCompany|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TestTypeForCompany saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TestTypeForCompany patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TestTypeForCompany[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TestTypeForCompany findOrCreate($search, callable $callback = null, $options = [])
 */
class TestTypeForCompanyTable extends Table
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

        $this->setTable('test_type_for_company');
        $this->setDisplayField('company_id');
        $this->setPrimaryKey(['company_id', 'test_type_id']);

        $this->belongsTo('Company', [
            'foreignKey' => 'company_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('TestType', [
            'foreignKey' => 'test_type_id',
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
        $rules->add($rules->existsIn(['company_id'], 'Company'));
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
