<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * VehicleServicing Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $department_id
 * @property int $vehicle_id
 * @property string $mileage
 * @property int $general_servicing
 * @property string $other
 * @property \Cake\I18n\FrozenDate $service_date
 * @property \Cake\I18n\FrozenDate $next_service_date
 * @property int $approved_by
 * @property \Cake\I18n\FrozenDate $approval_date
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Department $department
 * @property \App\Model\Entity\Vehicle $vehicle
 */
class VehicleServicing extends Entity
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
