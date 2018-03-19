<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * DepartmentProject Entity
 *
 * @property int $id
 * @property int $department_id
 * @property string $name
 * @property string $description
 * @property int $created_by
 * @property \Cake\I18n\FrozenTime $start_date
 * @property \Cake\I18n\FrozenTime $end_date
 * @property string $status
 * @property int $progress
 * @property int $monitor_timeline
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Department $department
 */
class DepartmentProject extends Entity
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
