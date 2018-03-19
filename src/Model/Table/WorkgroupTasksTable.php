<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * WorkgroupTasks Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\WorkgroupsTable|\Cake\ORM\Association\BelongsTo $Workgroups
 * @property \App\Model\Table\ProjectsTable|\Cake\ORM\Association\BelongsTo $Projects
 *
 * @method \App\Model\Entity\WorkgroupTask get($primaryKey, $options = [])
 * @method \App\Model\Entity\WorkgroupTask newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\WorkgroupTask[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\WorkgroupTask|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\WorkgroupTask patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\WorkgroupTask[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\WorkgroupTask findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class WorkgroupTasksTable extends Table
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

        $this->setTable('workgroup_tasks');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Workgroups', [
            'foreignKey' => 'workgroup_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('WorkgroupProjects', [
            'foreignKey' => 'project_id',
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
            ->allowEmpty('description', 'create');

        $validator
            ->integer('progress')
            ->allowEmpty('progress', 'create');
        $validator
            ->integer('status')
            ->allowEmpty('status', 'create');

        $validator
            ->allowEmpty('notes', 'create');

        $validator
            ->allowEmpty('attended_by', 'create');

        $validator
            ->allowEmpty('reviewed_by', 'create');

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
        $rules->add($rules->existsIn(['workgroup_id'], 'Workgroups'));
        $rules->add($rules->existsIn(['project_id'], 'WorkgroupProjects'));

        return $rules;
    }
}
