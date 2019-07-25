<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ApplicationForCompany Model
 *
 * @property \App\Model\Table\CompanyTable|\Cake\ORM\Association\BelongsTo $Company
 * @property \App\Model\Table\SpearlineApplicationTable|\Cake\ORM\Association\BelongsTo $SpearlineApplication
 *
 * @method \App\Model\Entity\ApplicationForCompany get($primaryKey, $options = [])
 * @method \App\Model\Entity\ApplicationForCompany newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ApplicationForCompany[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ApplicationForCompany|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ApplicationForCompany saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ApplicationForCompany patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ApplicationForCompany[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ApplicationForCompany findOrCreate($search, callable $callback = null, $options = [])
 */
class ApplicationForCompanyTable extends Table
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

        $this->setTable('application_for_company');
        $this->setDisplayField('company_id');
        $this->setPrimaryKey(['company_id', 'application_id']);

        $this->belongsTo('Company', [
            'foreignKey' => 'company_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('SpearlineApplication', [
            'foreignKey' => 'application_id',
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
        $rules->add($rules->existsIn(['application_id'], 'SpearlineApplication'));

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
