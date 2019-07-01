<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SummaryHourly Model
 *
 * @property \App\Model\Table\CompanyTable|\Cake\ORM\Association\BelongsTo $Company
 *
 * @method \App\Model\Entity\SummaryHourly get($primaryKey, $options = [])
 * @method \App\Model\Entity\SummaryHourly newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SummaryHourly[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SummaryHourly|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SummaryHourly saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SummaryHourly patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SummaryHourly[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SummaryHourly findOrCreate($search, callable $callback = null, $options = [])
 */
class SummaryHourlyTable extends Table
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

        $this->setTable('summary_hourly');
        $this->setPrimaryKey('hour_timestamp, company_id');

        $this->belongsTo('Company', [
            'foreignKey' => 'company_id',
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
            ->dateTime('hour_timestamp')
            ->requirePresence('hour_timestamp', 'create')
            ->notEmptyDateTime('hour_timestamp');

        $validator
            ->requirePresence('total_pstn_calls', 'create')
            ->notEmptyString('total_pstn_calls');

        $validator
            ->requirePresence('total_gsm_calls', 'create')
            ->notEmptyString('total_gsm_calls');

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
}
