<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * LeaveDay Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $annual_leave_days
 * @property int $study_leave_days
 * @property int $maternity_leave_days
 * @property int $paternity_leave_days
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 */
class LeaveDay extends Entity
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
