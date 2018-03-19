<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Department Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $logo
 * @property string $description
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\DepartmentsForum[] $departments_forums
 * @property \App\Model\Entity\DepartmentsMember[] $departments_members
 * @property \App\Model\Entity\Document[] $documents
 * @property \App\Model\Entity\Media[] $media
 * @property \App\Model\Entity\Thread[] $threads
 * @property \App\Model\Entity\Wiki[] $wiki
 */
class Department extends Entity
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
