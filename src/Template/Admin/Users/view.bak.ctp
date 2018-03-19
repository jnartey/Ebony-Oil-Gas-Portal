<?php
/**
  * @var \App\View\AppView $this
  */
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;

$this->layout = 'default';
$this->assign('title', 'User');
echo $this->element('head');
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Roles'), ['controller' => 'Roles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Role'), ['controller' => 'Roles', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Departments Members'), ['controller' => 'DepartmentsMembers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Departments Member'), ['controller' => 'DepartmentsMembers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Library Permissions'), ['controller' => 'LibraryPermissions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Library Permission'), ['controller' => 'LibraryPermissions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Projects Members'), ['controller' => 'ProjectsMembers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Projects Member'), ['controller' => 'ProjectsMembers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Workgroups Members'), ['controller' => 'WorkgroupsMembers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Workgroups Member'), ['controller' => 'WorkgroupsMembers', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Username') ?></th>
            <td><?= h($user->username) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('First Name') ?></th>
            <td><?= h($user->first_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Name') ?></th>
            <td><?= h($user->last_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Password') ?></th>
            <td><?= h($user->password) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Skype Name') ?></th>
            <td><?= h($user->skype_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Phone Number') ?></th>
            <td><?= h($user->phone_number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Im Account Name') ?></th>
            <td><?= h($user->im_account_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Avatar') ?></th>
            <td><?= h($user->avatar) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Role') ?></th>
            <td><?= $user->has('role') ? $this->Html->link($user->role->name, ['controller' => 'Roles', 'action' => 'view', $user->role->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Im Status') ?></th>
            <td><?= h($user->im_status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($user->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($user->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Active') ?></th>
            <td><?= $user->active ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Blocked') ?></th>
            <td><?= $user->is_blocked ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Departments Members') ?></h4>
        <?php if (!empty($user->departments_members)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Department Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Position') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->departments_members as $departmentsMembers): ?>
            <tr>
                <td><?= h($departmentsMembers->department_id) ?></td>
                <td><?= h($departmentsMembers->user_id) ?></td>
                <td><?= h($departmentsMembers->position) ?></td>
                <td><?= h($departmentsMembers->created) ?></td>
                <td><?= h($departmentsMembers->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'DepartmentsMembers', 'action' => 'view', $departmentsMembers->department_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'DepartmentsMembers', 'action' => 'edit', $departmentsMembers->department_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'DepartmentsMembers', 'action' => 'delete', $departmentsMembers->department_id], ['confirm' => __('Are you sure you want to delete # {0}?', $departmentsMembers->department_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Library Permissions') ?></h4>
        <?php if (!empty($user->library_permissions)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Can Read') ?></th>
                <th scope="col"><?= __('Can Write') ?></th>
                <th scope="col"><?= __('Can Delete') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->library_permissions as $libraryPermissions): ?>
            <tr>
                <td><?= h($libraryPermissions->user_id) ?></td>
                <td><?= h($libraryPermissions->can_read) ?></td>
                <td><?= h($libraryPermissions->can_write) ?></td>
                <td><?= h($libraryPermissions->can_delete) ?></td>
                <td><?= h($libraryPermissions->created) ?></td>
                <td><?= h($libraryPermissions->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'LibraryPermissions', 'action' => 'view', $libraryPermissions->user_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'LibraryPermissions', 'action' => 'edit', $libraryPermissions->user_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'LibraryPermissions', 'action' => 'delete', $libraryPermissions->user_id], ['confirm' => __('Are you sure you want to delete # {0}?', $libraryPermissions->user_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Projects Members') ?></h4>
        <?php if (!empty($user->projects_members)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Project Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->projects_members as $projectsMembers): ?>
            <tr>
                <td><?= h($projectsMembers->project_id) ?></td>
                <td><?= h($projectsMembers->user_id) ?></td>
                <td><?= h($projectsMembers->created) ?></td>
                <td><?= h($projectsMembers->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ProjectsMembers', 'action' => 'view', $projectsMembers->project_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ProjectsMembers', 'action' => 'edit', $projectsMembers->project_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ProjectsMembers', 'action' => 'delete', $projectsMembers->project_id], ['confirm' => __('Are you sure you want to delete # {0}?', $projectsMembers->project_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Workgroups Members') ?></h4>
        <?php if (!empty($user->workgroups_members)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Workgroup Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->workgroups_members as $workgroupsMembers): ?>
            <tr>
                <td><?= h($workgroupsMembers->workgroup_id) ?></td>
                <td><?= h($workgroupsMembers->user_id) ?></td>
                <td><?= h($workgroupsMembers->created) ?></td>
                <td><?= h($workgroupsMembers->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'WorkgroupsMembers', 'action' => 'view', $workgroupsMembers->workgroup_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'WorkgroupsMembers', 'action' => 'edit', $workgroupsMembers->workgroup_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'WorkgroupsMembers', 'action' => 'delete', $workgroupsMembers->workgroup_id], ['confirm' => __('Are you sure you want to delete # {0}?', $workgroupsMembers->workgroup_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
<?= $this->element('footer'); ?>