<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Auth\DefaultPasswordHasher;

/**
 * Users Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Roles
 * @property \Cake\ORM\Association\HasMany $DepartmentsMembers
 * @property \Cake\ORM\Association\HasMany $LibraryPermissions
 * @property \Cake\ORM\Association\HasMany $ProjectsMembers
 * @property \Cake\ORM\Association\HasMany $WorkgroupsMembers
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
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

        $this->setTable('users');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
		
		$this->addBehavior('Josegonzalez/Upload.Upload', [
            'photo' => [
                'fields' => [
                    'dir' => 'photo_dir',
                    'size' => 'photo_size',
                    'type' => 'photo_type'
                ],
                'nameCallback' => function ($data, $settings) {
                    return strtolower($data['name']);
                },
                'transformer' =>  function ($table, $entity, $data, $field, $settings) {
                    $extension = pathinfo($data['name'], PATHINFO_EXTENSION);

                    // Store the thumbnail in a temporary file
                    $tmp = tempnam(sys_get_temp_dir(), 'upload') . '.' . $extension;
					$tmp2 = tempnam(sys_get_temp_dir(), 'upload') . '.' . $extension;

                    // Use the Imagine library to DO THE THING
                    $size = new \Imagine\Image\Box(160, 160);
					$size2 = new \Imagine\Image\Box(350, 350);
                    $mode = \Imagine\Image\ImageInterface::THUMBNAIL_INSET;
                    $imagine = new \Imagine\Gd\Imagine();
					
					$option = array(
						'jpeg_quality' => 100,
						'png_compression_level' => 0
					);

                    // Save that modified file to our temp file
                    $imagine->open($data['tmp_name'])
                        ->thumbnail($size, $mode)
                        ->save($tmp, $option);
					
                    $imagine->open($data['tmp_name'])
                        ->thumbnail($size2, $mode)
                        ->save($tmp2, $option);

                    // Now return the original *and* the thumbnail
                    return [
                        $data['tmp_name'] => $data['name'],
                        $tmp => 'small-' . $data['name'],
						$tmp2 => 'medium-' . $data['name'],
                    ];
                },
                'deleteCallback' => function ($path, $entity, $field, $settings) {
                    // When deleting the entity, both the original and the thumbnail will be removed
                    // when keepFilesOnDelete is set to false
                    return [
                        $path . $entity->{$field},
                        $path . 'thumbnail-' . $entity->{$field}
                    ];
                },
                'keepFilesOnDelete' => false
            ]
        ]);

        $this->belongsTo('Roles', [
            'foreignKey' => 'role_id',
            'joinType' => 'INNER'
        ]);
			
        $this->belongsTo('DepartmentsMembers', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
		
        $this->hasMany('Departments', [
            'foreignKey' => 'user_id'
        ]);
			
        $this->hasMany('DepartmentsMembers', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('DepartmentForums', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Projects', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('ProjectsMembers', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Workgroups', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('WorkgroupsMembers', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Events', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('UsersLog', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('News', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('RequestHandlers', [
            'foreignKey' => 'user_id'
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
            ->requirePresence('username', 'create')
            ->notEmpty('username')
            ->add('username', 'unique', ['rule' => 'validateUnique', 'provider' => 'table'])
			->notEmpty('username');

        $validator
            ->requirePresence('first_name', 'create')
            ->notEmpty('first_name');

        $validator
            ->requirePresence('last_name', 'create')
            ->notEmpty('last_name');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email');

		$validator
        ->add('password', [
            'length' => [
                'rule' => ['minLength', 6],
                'message' => 'The password have to be at least 6 characters!',
            ]
        ])
        ->add('password',[
            'match'=>[
                'rule'=> ['compareWith','confirm_password'],
                'message'=>'The passwords does not match!',
            ]
        ])
        ->notEmpty('password');

    	$validator
        ->add('confirm_password', [
            'length' => [
                'rule' => ['minLength', 6],
                'message' => 'The password have to be at least 6 characters!',
            ]
        ])
        ->add('confirm_password',[
            'match'=>[
                'rule'=> ['compareWith','password'],
                'message'=>'The passwords does not match!',
            ]
        ])
        ->notEmpty('confirm_password');

        $validator
            ->allowEmpty('date_of_birth');
		
        $validator
            ->allowEmpty('employee_id');

        $validator
            ->allowEmpty('phone_number');

        $validator
            ->allowEmpty('im_account_name');

        $validator
            ->allowEmpty('photo');

        $validator
            ->allowEmpty('im_status');

        $validator
            //->boolean('active')
            //->requirePresence('active', 'create')
            ->allowEmpty('active');

        $validator
            //->boolean('is_blocked')
            //->requirePresence('is_blocked', 'create')
            ->allowEmpty('is_blocked');
		
		$validator
	        ->notEmpty('username', 'A username is required')
	        ->notEmpty('password', 'A password is required')
	        ->notEmpty('role', 'A role is required')
	        ->add('role_id', 'inList', [
	            'rule' => ['inList', ['1', '2', '3']],
	            'message' => 'Please enter a valid role'
        ]);

        return $validator;
    }
	
	public function validationPassword(Validator $validator )
	{ 
		$validator 
		->add('old_password','custom',[ 
			'rule'=> function($value, $context){ 
				$user = $this->get($context['data']['id']); 
				if ($user) { 
					if ((new DefaultPasswordHasher)->check($value, $user->password)) { 
						return true; 
					} 
				} 
				return false; 
			}, 
			'message'=>'The old password does not match the current password!', 
		]) 
		->notEmpty('old_password'); 
			
		$validator 
		->add('password1', [ 
		'length' => [ 
			'rule' => ['minLength', 6], 
			'message' => 'The password have to be at least 6 characters!', ] 
		]) 
		->add('password1',[ 
			'match'=>[ 
				'rule'=> ['compareWith','password2'], 
				'message'=>'The passwords does not match!', 
				] 
		]) 
		->notEmpty('password1'); 
				
		$validator 
			->add('password2', [ 
				'length' => [ 
					'rule' => ['minLength', 6], 
					'message' => 'The password have to be at least 6 characters!', 
				] 
			])
					
			->add('password2',[ 
				'match'=>[ 
					'rule'=> ['compareWith','password1'], 
					'message'=>'The passwords does not match!', 
					] 
			]) ->notEmpty('password2'); 
					
		$validator->provider('upload', \Josegonzalez\Upload\Validation\UploadValidation::class);
			
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
        $rules->add($rules->isUnique(['username']));
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['role_id'], 'Roles'));

        return $rules;
    }
}
