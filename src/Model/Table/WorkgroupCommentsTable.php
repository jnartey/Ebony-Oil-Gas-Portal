<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * WorkgroupComments Model
 *
 * @property \App\Model\Table\SourcesTable|\Cake\ORM\Association\BelongsTo $Sources
 * @property \App\Model\Table\ProjectsTable|\Cake\ORM\Association\BelongsTo $Projects
 * @property \App\Model\Table\ForumsTable|\Cake\ORM\Association\BelongsTo $Forums
 * @property \App\Model\Table\WorkgroupCommentsTable|\Cake\ORM\Association\BelongsTo $ParentWorkgroupComments
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\WorkgroupCommentsTable|\Cake\ORM\Association\HasMany $ChildWorkgroupComments
 *
 * @method \App\Model\Entity\WorkgroupComment get($primaryKey, $options = [])
 * @method \App\Model\Entity\WorkgroupComment newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\WorkgroupComment[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\WorkgroupComment|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\WorkgroupComment patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\WorkgroupComment[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\WorkgroupComment findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 * @mixin \Cake\ORM\Behavior\TreeBehavior
 */
class WorkgroupCommentsTable extends Table
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

        $this->setTable('workgroup_comments');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Tree');

        $this->belongsTo('WorkgroupProjects', [
            'foreignKey' => 'project_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('WorkgroupForums', [
            'foreignKey' => 'forum_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ParentWorkgroupComments', [
            'className' => 'WorkgroupComments',
            'foreignKey' => 'parent_id'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('ChildWorkgroupComments', [
            'className' => 'WorkgroupComments',
            'foreignKey' => 'parent_id'
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
            ->integer('comment_src')
            ->requirePresence('comment_src', 'create')
            ->notEmpty('comment_src');

        $validator
            ->requirePresence('comment', 'create')
            ->notEmpty('comment');

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
        $rules->add($rules->existsIn(['project_id'], 'WorkgroupProjects'));
        $rules->add($rules->existsIn(['forum_id'], 'WorkgroupForums'));
        $rules->add($rules->existsIn(['parent_id'], 'ParentWorkgroupComments'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
