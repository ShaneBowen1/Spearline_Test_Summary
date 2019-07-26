<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;
use ArrayObject;

/**
 * RemembermeToken Model
 *
 * @property \Cake\ORM\Association\BelongsTo $User
 *
 * @method \App\Model\Entity\RemembermeToken get($primaryKey, $options = [])
 * @method \App\Model\Entity\RemembermeToken newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\RemembermeToken[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RemembermeToken|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RemembermeToken patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RemembermeToken[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\RemembermeToken findOrCreate($search, callable $callback = null)
 */
class RemembermeTokenTable extends Table
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

        $this->table('rememberme_token');
        $this->displayField('token');
        $this->primaryKey(['user_id', 'ip', 'browser']);

        $this->belongsTo('User', [
            'foreignKey' => 'user_id',
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
            ->requirePresence('token', 'create')
            ->notEmpty('token');

        $validator
            ->requirePresence('ip', 'create')
            ->notEmpty('ip');

        $validator
            ->requirePresence('browser', 'create')
            ->notEmpty('browser');

        $validator
            ->dateTime('expires_on')
            ->requirePresence('expires_on', 'create')
            ->notEmpty('expires_on');

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
        $rules->add($rules->existsIn(['user_id'], 'User'));

        return $rules;
    }

    public function getTokenData($token) {
        $data = $this->find('all')->where(['token' => $token])->first();

        return $data;
    }

    public function validateToken($token, $user_id) {
        if(intval($token->user_id) !== intval($user_id)) {
            return false;
        }

        if($token->browser !== env('HTTP_USER_AGENT')) {
            return false;
        }

        if(long2ip($token->ip) !== env('REMOTE_ADDR') and env('REMOTE_ADDR') !== '::1') {
            return false;
        }

        if($token->expires_on->format('Y-m-d H:i:s') <= date('Y-m-d H:i:s')) {
            return false;
        }

        return true;
    }

    public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options)
    {

        //hack for localhost ipv6 address

        if(strpos($data['ip'], ':') !== false) {
            $data['ip'] = '127.0.0.1';
        }

        if(strpos($data['ip'], '.')) {
            $data['ip'] = ip2long($data['ip']);
        }

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
