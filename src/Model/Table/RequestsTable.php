<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * LeaveRequests Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\DepartmentsTable|\Cake\ORM\Association\BelongsTo $Departments
 *
 * @method \App\Model\Entity\LeaveRequest get($primaryKey, $options = [])
 * @method \App\Model\Entity\LeaveRequest newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\LeaveRequest[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\LeaveRequest|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LeaveRequest patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\LeaveRequest[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\LeaveRequest findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RequestsTable extends Table
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

        $this->setTable('leave_requests');
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
            ->allowEmpty('request_type');

        $validator
            ->allowEmpty('start_date');

        $validator
            ->allowEmpty('end_date');

        $validator
            ->integer('number_of_days_requested')
            ->allowEmpty('number_of_days_requested');

        $validator
            ->allowEmpty('comments');
		
        $validator
            ->allowEmpty('address');
		
        $validator
            ->allowEmpty('tel');
		
        $validator
            ->allowEmpty('email');

        $validator
            ->allowEmpty('guarantor_remarks');

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
            ->integer('recommended_by')
            ->allowEmpty('recommended_by');
		
        $validator
            ->integer('approved_by')
            ->allowEmpty('approved_by');
		
        $validator
            ->integer('approved_by_management')
            ->allowEmpty('approved_by_management');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['department_id'], 'Departments'));

        return $rules;
    }
}
