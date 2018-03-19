<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * DepartmentTask Entity
 *
 * @property int $id
 * @property string $user_id
 * @property int $department_id
 * @property string $project_id
 * @property string $name
 * @property string $description
 * @property int $progress
 * @property \Cake\I18n\FrozenTime $deadline
 * @property int $status
 * @property string $notes
 * @property string $attended_by
 * @property string $reviewed_by
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Department $department
 * @property \App\Model\Entity\Project $project
 */
class DepartmentTask extends Entity
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
