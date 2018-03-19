<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * WorkgroupProjects Model
 *
 * @property \App\Model\Table\WorkgroupsTable|\Cake\ORM\Association\BelongsTo $Workgroups
 *
 * @method \App\Model\Entity\WorkgroupProject get($primaryKey, $options = [])
 * @method \App\Model\Entity\WorkgroupProject newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\WorkgroupProject[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\WorkgroupProject|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\WorkgroupProject patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\WorkgroupProject[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\WorkgroupProject findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class WorkgroupProjectsTable extends Table
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

        $this->setTable('workgroup_projects');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Workgroups', [
            'foreignKey' => 'workgroup_id',
            'joinType' => 'INNER'
        ]);
			
        $this->hasMany('WorkgroupProjectMembers', [
            'foreignKey' => 'project_id'
        ]);
		
        $this->hasMany('WorkgroupTasks', [
            'foreignKey' => 'project_id'
        ]);
		
        $this->hasMany('WorkgroupComments', [
            'foreignKey' => 'project_id'
        ]);
		
        $this->belongsTo('Users', [
            'foreignKey' => 'created_by',
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->requirePresence('description', 'create')
            ->notEmpty('description');

        $validator
            ->integer('created_by')
            ->requirePresence('created_by', 'create')
            ->notEmpty('created_by');

        $validator
            ->dateTime('start_date')
            ->requirePresence('start_date', 'create')
            ->notEmpty('start_date');

        $validator
            ->dateTime('end_date')
            ->requirePresence('end_date', 'create')
            ->notEmpty('end_date');

        $validator
            ->allowEmpty('status', 'create');

        $validator
            ->integer('progress')
            ->allowEmpty('progress', 'create');

        $validator
            ->integer('monitor_timeline')
            ->allowEmpty('monitor_timeline', 'create');

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
        $rules->add($rules->existsIn(['workgroup_id'], 'Workgroups'));

        return $rules;
    }
}
