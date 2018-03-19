<?php
namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $username
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $password
 * @property string $skype_name
 * @property string $phone_number
 * @property string $im_account_name
 * @property string $photo
 * @property string $photo_dir
 * @property string $photo_size
 * @property string $photo_type
 * @property int $role_id
 * @property string $im_status
 * @property bool $active
 * @property bool $is_blocked
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Role $role
 * @property \App\Model\Entity\DepartmentsMember[] $departments_members
 * @property \App\Model\Entity\LibraryPermission[] $library_permissions
 * @property \App\Model\Entity\ProjectsMember[] $projects_members
 * @property \App\Model\Entity\WorkgroupsMember[] $workgroups_members
 */
class User extends Entity
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
        '*' => false,
        'id' => true,
		'username' => true,
		'first_name' => true,
		'last_name' => true,
		'email' => true,
		'employee_id' => true,
		'date_of_birth' => true,
		'phone_number' => true,
		'im_account_name' => true,
		'photo' => true,
		'photo_dir' => true,
		'photo_size' => true,
		'photo_type' => true,
		'role_id' => true,
		'im_status' => true,
		'active' => true,
		'is_blocked' => true,
		'employee_of_the_year' => true,
		'password' => true,
		'position' => true,
		'created' => true,
		'modified' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
	
	protected function _setPassword($password)
    {
        return (new DefaultPasswordHasher)->hash($password);
    }
	
	protected function _getName()
	{
	    return $this->_properties['first_name'] . ' ' . $this->_properties['last_name'];
	}

}
