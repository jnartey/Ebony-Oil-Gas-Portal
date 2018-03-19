<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * WorkgroupEvent Entity
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $location
 * @property \Cake\I18n\FrozenTime $from_date
 * @property \Cake\I18n\FrozenTime $to_date
 * @property \Cake\I18n\FrozenTime $registration_deadline
 * @property string $image
 * @property int $user_id
 * @property int $workgroup_id
 * @property bool $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Workgroup $workgroup
 */
class WorkgroupEvent extends Entity
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
