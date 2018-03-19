<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * DepartmentMedia Entity
 *
 * @property int $id
 * @property int $source_id
 * @property int $parent_id
 * @property int $lft
 * @property int $rght
 * @property string $folder_name
 * @property string $file_name
 * @property int $size
 * @property int $uploaded_by
 * @property int $department_id
 * @property int $media_access
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Source $source
 * @property \App\Model\Entity\ParentDepartmentMedia $parent_department_media
 * @property \App\Model\Entity\Department $department
 * @property \App\Model\Entity\ChildDepartmentMedia[] $child_department_media
 */
class DepartmentMedia extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
