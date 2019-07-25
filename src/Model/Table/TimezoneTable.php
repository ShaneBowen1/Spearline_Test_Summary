<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Timezone Model
 *
 * @property \App\Model\Table\CampaignTable|\Cake\ORM\Association\HasMany $Campaign
 * @property \App\Model\Table\CompanyWithUdialTable|\Cake\ORM\Association\HasMany $CompanyWithUdial
 * @property \App\Model\Table\EtoCountryDefaultSettingTable|\Cake\ORM\Association\HasMany $EtoCountryDefaultSetting
 * @property \App\Model\Table\EtoUserTable|\Cake\ORM\Association\HasMany $EtoUser
 * @property \App\Model\Table\MrepReportScheduleTable|\Cake\ORM\Association\HasMany $MrepReportSchedule
 * @property \App\Model\Table\MrepReportScheduleHistoryTable|\Cake\ORM\Association\HasMany $MrepReportScheduleHistory
 * @property \App\Model\Table\NumberForIvrTable|\Cake\ORM\Association\HasMany $NumberForIvr
 * @property \App\Model\Table\NumberForIvrTypeTable|\Cake\ORM\Association\HasMany $NumberForIvrType
 * @property \App\Model\Table\NumberTimeGroupTable|\Cake\ORM\Association\HasMany $NumberTimeGroup
 * @property \App\Model\Table\ReportScheduleTable|\Cake\ORM\Association\HasMany $ReportSchedule
 * @property \App\Model\Table\TempUsersTable|\Cake\ORM\Association\HasMany $TempUsers
 * @property \App\Model\Table\TimezoneOffsetTable|\Cake\ORM\Association\HasMany $TimezoneOffset
 * @property \App\Model\Table\UserTable|\Cake\ORM\Association\HasMany $User
 * @property \App\Model\Table\UserForUdialTable|\Cake\ORM\Association\HasMany $UserForUdial
 *
 * @method \App\Model\Entity\Timezone get($primaryKey, $options = [])
 * @method \App\Model\Entity\Timezone newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Timezone[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Timezone|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Timezone saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Timezone patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Timezone[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Timezone findOrCreate($search, callable $callback = null, $options = [])
 */
class TimezoneTable extends Table
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

        $this->setTable('timezone');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Campaign', [
            'foreignKey' => 'timezone_id'
        ]);
        $this->hasMany('CompanyWithUdial', [
            'foreignKey' => 'timezone_id'
        ]);
        $this->hasMany('EtoCountryDefaultSetting', [
            'foreignKey' => 'timezone_id'
        ]);
        $this->hasMany('EtoUser', [
            'foreignKey' => 'timezone_id'
        ]);
        $this->hasMany('MrepReportSchedule', [
            'foreignKey' => 'timezone_id'
        ]);
        $this->hasMany('MrepReportScheduleHistory', [
            'foreignKey' => 'timezone_id'
        ]);
        $this->hasMany('NumberForIvr', [
            'foreignKey' => 'timezone_id'
        ]);
        $this->hasMany('NumberForIvrType', [
            'foreignKey' => 'timezone_id'
        ]);
        $this->hasMany('NumberTimeGroup', [
            'foreignKey' => 'timezone_id'
        ]);
        $this->hasMany('ReportSchedule', [
            'foreignKey' => 'timezone_id'
        ]);
        $this->hasMany('TempUsers', [
            'foreignKey' => 'timezone_id'
        ]);
        $this->hasMany('TimezoneOffset', [
            'foreignKey' => 'timezone_id'
        ]);
        $this->hasMany('User', [
            'foreignKey' => 'timezone_id'
        ]);
        $this->hasMany('UserForUdial', [
            'foreignKey' => 'timezone_id'
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
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('ui_name')
            ->maxLength('ui_name', 255)
            ->requirePresence('ui_name', 'create')
            ->allowEmptyString('ui_name', false);

        $validator
            ->scalar('timezone')
            ->maxLength('timezone', 255)
            ->requirePresence('timezone', 'create')
            ->allowEmptyString('timezone', false);

        $validator
            ->scalar('description')
            ->maxLength('description', 1024)
            ->allowEmptyString('description', false);

        $validator
            ->allowEmptyString('status', false);

        return $validator;
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
