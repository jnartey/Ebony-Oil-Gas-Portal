<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RequestHandler Entity
 *
 * @property int $id
 * @property int $request_forms_id
 * @property int $department_id
 * @property int $user_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\RequestForm $request_form
 * @property \App\Model\Entity\Department $department
 */
class RequestHandler extends Entity
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
