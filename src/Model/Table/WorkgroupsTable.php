<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Workgroups Model
 *
 * @property \Cake\ORM\Association\HasMany $WorkgroupsMembers
 *
 * @method \App\Model\Entity\Workgroup get($primaryKey, $options = [])
 * @method \App\Model\Entity\Workgroup newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Workgroup[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Workgroup|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Workgroup patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Workgroup[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Workgroup findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class WorkgroupsTable extends Table
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

        $this->setTable('workgroups');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('WorkgroupsMembers', [
            'foreignKey' => 'workgroup_id'
        ]);
			
	        $this->belongsTo('Users', [
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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('description', 'create')
            ->notEmpty('description');

        $validator
            ->integer('user_id')
            ->requirePresence('user_id', 'create')
            ->notEmpty('user_id');

        $validator
            ->requirePresence('approve_members', 'create')
            ->notEmpty('approve_members');

        $validator
            ->requirePresence('content_access', 'create')
            ->notEmpty('content_access');

        return $validator;
    }
}
