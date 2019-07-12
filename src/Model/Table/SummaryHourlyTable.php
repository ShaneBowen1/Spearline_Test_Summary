<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SummaryHourly Model
 *
 * @property |\Cake\ORM\Association\BelongsTo $Companies
 * @property |\Cake\ORM\Association\BelongsTo $TestTypes
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
        $this->setDisplayField('hour_timestamp, company_id');
        $this->setPrimaryKey('hour_timestamp, company_id');

        $this->belongsTo('Company', [
            'foreignKey' => 'company_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('TestType', [
            'foreignKey' => 'test_type_id',
            'joinType' => 'INNER'
        ]);

         // Add the behaviour to your table
         $this->addBehavior('Search.Search');
         
         // Setup search filter using search manager
         $this->searchManager()
            ->add('test_type', 'Search.Callback', [
                'callback' => function ($query, $args, $filter) {
                    if($args['test_type'] === 'NULL') {
                        $query->where(['SummaryHourly.test_type_id IS ' => null]);
                    }
                    else {
                        $query->where(['SummaryHourly.test_type_id IN' => $args['test_type']]);
                    }
                }
            ])
            ->add('company', 'Search.Callback', [
                'callback' => function ($query, $args, $filter) {
                    if($args['company'] === 'NULL') {
                        $query->where(['SummaryHourly.company_id IS ' => null]);
                    }
                    else {
                        $query->where(['SummaryHourly.company_id IN' => $args['company']]);
                    }
                }
            ])
             ->add('date', 'Search.Callback', [
                 'callback' => function ($query, $args, $filter) {
                     if($args['date'] === 'NULL') {
                         $query->where(['SummaryHourly.hour_timestamp IS ' => null, 'SummaryHourly.hour_timestamp IS ' => null]);
                     } else {
                         $dates = json_decode($args['date']);
                         if (!empty($dates)) {
                             $query->where(['SummaryHourly.hour_timestamp >=' => $dates->start . ' 00:00:00', 'SummaryHourly.hour_timestamp < ' => $dates->end . ' 23:59:59']);
                         }
                         else{
                             $query->where(['SummaryHourly.hour_timestamp >=' => date('Y-m-d 00:00:00', strtotime("-6 days")), 'SummaryHourly.hour_timestamp < ' => date('Y-m-d 23:59:59')]);
                         }
                     }
                 }
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
            ->allowEmptyDateTime('hour_timestamp', 'create');

        $validator
            ->requirePresence('total_pstn_calls', 'create')
            ->allowEmptyString('total_pstn_calls', false);

        $validator
            ->requirePresence('total_gsm_calls', 'create')
            ->allowEmptyString('total_gsm_calls', false);

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

    public function getFilters()
    {
        // debug($_GET["test_type"]);
        $testType = $this->TestType->find('list')->order(['test_type'=>'ASC']);
        $result['testTypeSearch'] = ['name' => 'Test Type', 'id' => 'test_type', 'class' => 'dropdown-search', 'type' => 'search', 'multiple' => true, 'label' => false, 'value' => false, 'autocomplete' => 'off', 'autocorrect' => 'off', 'spellcheck' => 'false'];

        $company = $this->Company->find('list')->order(['name'=>'ASC']);
        $result['companySearch'] = ['name' => 'Company', 'id' => 'company', 'class' => 'dropdown-search', 'type' => 'search', 'multiple' => true, 'label' => false, 'value' => false, 'autocomplete' => 'off', 'autocorrect' => 'off', 'spellcheck' => 'false'];
    
        return $result;
    }
}