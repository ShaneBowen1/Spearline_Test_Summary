<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CompanyExtension Model
 *
 * @property \App\Model\Table\CompanyTypesTable|\Cake\ORM\Association\BelongsTo $CompanyTypes
 * @property \App\Model\Table\UserTable|\Cake\ORM\Association\BelongsTo $User
 *
 * @method \App\Model\Entity\CompanyExtension get($primaryKey, $options = [])
 * @method \App\Model\Entity\CompanyExtension newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CompanyExtension[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CompanyExtension|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CompanyExtension saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CompanyExtension patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CompanyExtension[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CompanyExtension findOrCreate($search, callable $callback = null, $options = [])
 */
class CompanyExtensionTable extends Table
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

        $this->setTable('company_extension');
        $this->setDisplayField('company_id');
        $this->setPrimaryKey('company_id');

        $this->belongsTo('CompanyTypes', [
            'foreignKey' => 'company_type_id'
        ]);
        $this->belongsTo('User', [
            'foreignKey' => 'account_manager_id'
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
            ->allowEmptyString('company_id', 'create');

        $validator
            ->allowEmptyString('manual_test_timeout', false);

        $validator
            ->boolean('gsm_on_manual_test')
            ->allowEmptyString('gsm_on_manual_test', false);

        $validator
            ->boolean('api_doc_access')
            ->allowEmptyString('api_doc_access', false);

        $validator
            ->boolean('management_report_access')
            ->allowEmptyString('management_report_access', false);

        $validator
            ->boolean('has_gsm')
            ->allowEmptyString('has_gsm', false);

        $validator
            ->boolean('view_passcode_tag')
            ->allowEmptyString('view_passcode_tag', false);

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
        $rules->add($rules->existsIn(['company_type_id'], 'CompanyTypes'));
        $rules->add($rules->existsIn(['account_manager_id'], 'User'));

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
