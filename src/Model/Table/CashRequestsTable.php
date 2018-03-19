<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CashRequests Model
 *
 * @method \App\Model\Entity\CashRequest get($primaryKey, $options = [])
 * @method \App\Model\Entity\CashRequest newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CashRequest[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CashRequest|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CashRequest patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CashRequest[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CashRequest findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CashRequestsTable extends Table
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

        $this->setTable('cash_requests');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
		
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
				
        $this->belongsTo('Departments', [
            'foreignKey' => 'department_id',
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
            ->integer('id')
            ->allowEmpty('id', 'create');
		
        $validator
            ->requirePresence('r_type', 'create')
            ->notEmpty('r_type');

        $validator
            ->requirePresence('subject', 'create')
            ->notEmpty('subject');

        $validator
            ->integer('amount')
            ->requirePresence('amount', 'create')
            ->notEmpty('amount');

        $validator
            ->integer('user_id')
            ->allowEmpty('user_id');

        $validator
            ->integer('approved_by')
            ->allowEmpty('approved_by');
		
        $validator
            //->requirePresence('approval_date', 'create')
            ->allowEmpty('approval_date');

        $validator
            ->integer('paid_by')
            ->allowEmpty('paid_by');

        return $validator;
    }
}
