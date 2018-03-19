<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Comment Entity
 *
 * @property int $id
 * @property int $comment_src
 * @property int $project_id
 * @property int $workgroup_id
 * @property int $forum_id
 * @property int $parent_id
 * @property int $user_id
 * @property string $comment
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $lft
 * @property int $rght
 *
 * @property \App\Model\Entity\Project $project
 * @property \App\Model\Entity\Workgroup $workgroup
 * @property \App\Model\Entity\Forum $forum
 * @property \App\Model\Entity\User $user
 */
class Comment extends Entity
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
