<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DepartmentMedia Model
 *
 * @property \App\Model\Table\SourcesTable|\Cake\ORM\Association\BelongsTo $Sources
 * @property \App\Model\Table\DepartmentMediaTable|\Cake\ORM\Association\BelongsTo $ParentDepartmentMedia
 * @property \App\Model\Table\DepartmentsTable|\Cake\ORM\Association\BelongsTo $Departments
 * @property \App\Model\Table\DepartmentMediaTable|\Cake\ORM\Association\HasMany $ChildDepartmentMedia
 *
 * @method \App\Model\Entity\DepartmentMedia get($primaryKey, $options = [])
 * @method \App\Model\Entity\DepartmentMedia newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\DepartmentMedia[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DepartmentMedia|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DepartmentMedia patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DepartmentMedia[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\DepartmentMedia findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 * @mixin \Cake\ORM\Behavior\TreeBehavior
 */
class DepartmentMediaTable extends Table
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

        $this->setTable('department_media');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
		$this->addBehavior('Tree');
		
		$this->addBehavior('Josegonzalez/Upload.Upload', [
            'file_name' => [
				'path' => 'webroot{DS}{field-value:media_dir}',
                'fields' => [
                    'dir' => 'media_dir',
                    'size' => 'size',
                    'type' => 'media_type'
                ],
                'nameCallback' => function ($data, $settings) {
					//pr($data);
                    return strtolower($data['name']);
                },
                // 'transformer' =>  function ($table, $entity, $data, $field, $settings) {
//
// 					//$finfo = finfo_open(FILEINFO_MIME_TYPE); // return mime type
// 					//foreach (glob("*") as $filename) {
// 						//pr($settings);
// 						$finfo = finfo_open(FILEINFO_MIME_TYPE);
// 						$mime = finfo_file($finfo, $data['name']);
//
// 					    if($mime == 'image/jpeg' || $mime == 'image/png' || $mime == 'image/gif'){
// 		                    $extension = pathinfo($data['name'], PATHINFO_EXTENSION);
//
// 		                    // Store the thumbnail in a temporary file
// 		                    $tmp = tempnam(sys_get_temp_dir(), 'upload') . '.' . $extension;
// 							$tmp2 = tempnam(sys_get_temp_dir(), 'upload') . '.' . $extension;
//
// 		                    // Use the Imagine library to DO THE THING
// 		                    $size = new \Imagine\Image\Box(160, 160);
// 							$size2 = new \Imagine\Image\Box(350, 350);
// 		                    $mode = \Imagine\Image\ImageInterface::THUMBNAIL_INSET;
// 		                    $imagine = new \Imagine\Gd\Imagine();
//
// 							$option = array(
// 								'jpeg_quality' => 100,
// 								'png_compression_level' => 0
// 							);
//
// 		                    // Save that modified file to our temp file
// 		                    $imagine->open($data['tmp_name'])
// 		                        ->thumbnail($size, $mode)
// 		                        ->save($tmp, $option);
//
// 		                    $imagine->open($data['tmp_name'])
// 		                        ->thumbnail($size2, $mode)
// 		                        ->save($tmp2, $option);
//
// 		                    // Now return the original *and* the thumbnail
// 		                    return [
// 		                        $data['tmp_name'] => $data['name'],
// 		                        $tmp => 'small-' . $data['name'],
// 								$tmp2 => 'medium-' . $data['name'],
// 		                    ];
// 						}
// 						//}
// 					//finfo_close($finfo);
//                 },
                'deleteCallback' => function ($path, $entity, $field, $settings) {
                    // When deleting the entity, both the original and the thumbnail will be removed
                    // when keepFilesOnDelete is set to false
                    return [
                        $path . $entity->{$field},
                        //$path . 'thumbnail-' . $entity->{$field}
                    ];
                },
                'keepFilesOnDelete' => false
            ]
        ]);

        $this->belongsTo('ParentDepartmentMedia', [
            'className' => 'DepartmentMedia',
            'foreignKey' => 'parent_id'
        ]);
        $this->belongsTo('Departments', [
            'foreignKey' => 'department_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('ChildDepartmentMedia', [
            'className' => 'DepartmentMedia',
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
			->allowEmpty('folder_name', 'create');

        $validator
			->allowEmpty('file_name', 'create');

        $validator
            ->integer('size')
			->allowEmpty('size', 'create');

        $validator
            ->integer('uploaded_by')
            ->requirePresence('uploaded_by', 'create')
            ->notEmpty('uploaded_by');

        $validator
            ->integer('media_access')
			->allowEmpty('media_access', 'create');

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
        $rules->add($rules->existsIn(['department_id'], 'Departments'));

        return $rules;
    }
}
