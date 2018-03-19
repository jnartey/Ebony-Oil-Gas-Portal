<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DepartmentComments Model
 *
 * @property \App\Model\Table\SourcesTable|\Cake\ORM\Association\BelongsTo $Sources
 * @property \App\Model\Table\ProjectsTable|\Cake\ORM\Association\BelongsTo $Projects
 * @property \App\Model\Table\ForumsTable|\Cake\ORM\Association\BelongsTo $Forums
 * @property \App\Model\Table\DepartmentCommentsTable|\Cake\ORM\Association\BelongsTo $ParentDepartmentComments
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\DepartmentCommentsTable|\Cake\ORM\Association\HasMany $ChildDepartmentComments
 *
 * @method \App\Model\Entity\DepartmentComment get($primaryKey, $options = [])
 * @method \App\Model\Entity\DepartmentComment newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\DepartmentComment[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DepartmentComment|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DepartmentComment patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DepartmentComment[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\DepartmentComment findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 * @mixin \Cake\ORM\Behavior\TreeBehavior
 */
class DepartmentCommentsTable extends Table
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

        $this->setTable('department_comments');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Tree');

        $this->belongsTo('DepartmentProjects', [
            'foreignKey' => 'project_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('DepartmentForums', [
            'foreignKey' => 'forum_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ParentDepartmentComments', [
            'className' => 'DepartmentComments',
            'foreignKey' => 'parent_id'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('ChildDepartmentComments', [
            'className' => 'DepartmentComments',
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
        $rules->add($rules->existsIn(['project_id'], 'DepartmentProjects'));
        $rules->add($rules->existsIn(['forum_id'], 'DepartmentForums'));
        $rules->add($rules->existsIn(['parent_id'], 'ParentDepartmentComments'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
