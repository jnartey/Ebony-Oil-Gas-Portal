<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * WorkOutsideSchedule Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $location
 * @property string $stand_by
 * @property string $stand_in
 * @property int $number_of_days
 * @property string $justification
 * @property int $department_head
 * @property \Cake\I18n\FrozenDate $department_head_approval_date
 * @property int $checked_by
 * @property \Cake\I18n\FrozenDate $checked_date
 * @property int $approved_by
 * @property \Cake\I18n\FrozenDate $approval_date
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 */
class WorkOutsideSchedule extends Entity
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
