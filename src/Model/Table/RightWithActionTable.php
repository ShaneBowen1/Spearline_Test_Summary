<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RightWithAction Model
 *
 * @property \App\Model\Table\RightTable|\Cake\ORM\Association\BelongsTo $Right
 * @property \App\Model\Table\PlatformActionTable|\Cake\ORM\Association\BelongsTo $PlatformAction
 *
 * @method \App\Model\Entity\RightWithAction get($primaryKey, $options = [])
 * @method \App\Model\Entity\RightWithAction newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\RightWithAction[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RightWithAction|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RightWithAction saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RightWithAction patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RightWithAction[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\RightWithAction findOrCreate($search, callable $callback = null, $options = [])
 */
class RightWithActionTable extends Table
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

        $this->setTable('right_with_action');
        $this->setDisplayField('right_id');
        $this->setPrimaryKey(['right_id', 'platform_action_id']);

        $this->belongsTo('Right', [
            'foreignKey' => 'right_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('PlatformAction', [
            'foreignKey' => 'platform_action_id',
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
        $rules->add($rules->existsIn(['right_id'], 'Right'));
        $rules->add($rules->existsIn(['platform_action_id'], 'PlatformAction'));

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
