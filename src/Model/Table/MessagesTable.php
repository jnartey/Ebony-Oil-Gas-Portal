<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ImMessages Model
 *
 * @method \App\Model\Entity\ImMessage get($primaryKey, $options = [])
 * @method \App\Model\Entity\ImMessage newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ImMessage[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ImMessage|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ImMessage patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ImMessage[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ImMessage findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MessagesTable extends Table
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

        $this->setTable('messages');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('message', 'create')
            ->notEmpty('message');

        $validator
            ->integer('chat_from')
            ->requirePresence('chat_from', 'create')
            ->notEmpty('chat_from');

        $validator
            ->integer('chat_to')
            ->requirePresence('chat_to', 'create')
            ->notEmpty('chat_to');

        return $validator;
    }
}
