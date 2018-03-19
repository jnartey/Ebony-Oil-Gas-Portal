<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * WorkOutsideSchedules Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\WorkOutsideSchedule get($primaryKey, $options = [])
 * @method \App\Model\Entity\WorkOutsideSchedule newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\WorkOutsideSchedule[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\WorkOutsideSchedule|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\WorkOutsideSchedule patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\WorkOutsideSchedule[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\WorkOutsideSchedule findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class WorkOutsideSchedulesTable extends Table
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

        $this->setTable('work_outside_schedules');
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
            ->requirePresence('location', 'create')
            ->notEmpty('location');

        $validator
			->requirePresence('stand_by', 'create')
            ->allowEmpty('stand_by');

        $validator
			->requirePresence('stand_in', 'create')
            ->allowEmpty('stand_in');

        $validator
            ->integer('number_of_days')
			->requirePresence('number_of_days', 'create')
            ->allowEmpty('number_of_days');

        $validator
			->requirePresence('justification', 'create')
            ->allowEmpty('justification');

        $validator
            ->integer('department_head')
			->requirePresence('department_head', 'create')
            ->allowEmpty('department_head');

        $validator
            ->datetime('department_head_approval_date')
			->requirePresence('department_head_approval_date', 'create')
            ->allowEmpty('department_head_approval_date');

        $validator
            ->integer('checked_by')
			->requirePresence('checked_by', 'create')
            ->allowEmpty('checked_by');

        $validator
            ->datetime('checked_date')
			->requirePresence('checked_date', 'create')
            ->allowEmpty('checked_date');

        $validator
            ->integer('approved_by')
			->requirePresence('approved_by', 'create')
            ->allowEmpty('approved_by');

        $validator
            ->datetime('approval_date')
			->requirePresence('approval_date', 'create')
            ->allowEmpty('approval_date');

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

        return $rules;
    }
}
