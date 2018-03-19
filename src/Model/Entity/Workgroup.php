<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Workgroup Entity
 *
 * @property int $id
 * @property string $description
 * @property int $created_by
 * @property \Cake\I18n\Time $created_on
 * @property string $approve_members
 * @property string $content_access
 * @property bool $is_approved
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\WorkgroupsMember[] $workgroups_members
 */
class Workgroup extends Entity
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
