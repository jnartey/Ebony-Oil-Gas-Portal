<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Canteen Entity
 *
 * @property int $id
 * @property string $menu
 * @property bool $week
 * @property bool $day
 * @property string $morning_meal
 * @property string $morning_meal_description
 * @property string $afternoon_meal
 * @property string $afternoon_meal_description
 * @property string $evening_meal
 * @property string $evening_meal_description
 * @property bool $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class Canteen extends Entity
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
