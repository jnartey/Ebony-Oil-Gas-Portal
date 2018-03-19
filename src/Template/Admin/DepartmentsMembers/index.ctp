<?php
/**
  * @var \App\View\AppView $this
  */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;

$this->layout = 'admin';
$this->assign('title', 'Departments');
?>

<div class="off-canvas-content" data-off-canvas-content>
	<!-- Your page content lives here -->
	<div id="mains" class="medium-12 columns admin-content">
		<?= $this->element('admin'.DS.'topbar') ?>
		<div class="large-12 columns main-admin-content">
			<div class="large-12 columns panel-wrap action-bar">
				<?= $this->Html->link(__('<span class="fa fa-list-ol"></span> List Departments'), ['controller'=>'Departments', 'action' => 'index'], ['class'=>'button', 'escape'=>false]) ?>
			    <?= $this->Html->link(__('<span class="fa fa-plus"></span> New Department'), ['controller'=>'Departments', 'action' => 'add'], ['class'=>'button', 'escape'=>false]) ?>
				<?= $this->Html->link(__('<span class="fa fa-list-ol"></span> Department Staff'), ['controller' => 'DepartmentsMembers', 'action' => 'index'], ['class'=>'button active', 'escape'=>false]) ?>
				<?= $this->Html->link(__('<span class="fa fa-plus"></span> Add Staff'), ['controller' => 'DepartmentsMembers', 'action' => 'add'], ['class'=>'button', 'escape'=>false]) ?>
			</div>
			<div class="large-12 columns panel-wrap">
			    <h3><?= __('Departments Staff') ?></h3>
				<table id="general-table" class="display" width="100%" cellpadding="0" cellspacing="0">
			        <thead>
			            <tr>
			                <th><?= __('#') ?></th>
			                <th><?= __('Department') ?></th>
			                <th><?= __('Staff') ?></th>
			                <th><?= __('created') ?></th>
			                <th><?= __('modified') ?></th>
			                <th class="actions"><?= __('Actions') ?></th>
			            </tr>
			        </thead>
			        <tbody>
			            <?php foreach ($departmentsMembers as $departmentsMember): ?>
			            <tr>
			                <td><?= $this->Number->format($departmentsMember->id) ?></td>
			                <td><?= $departmentsMember->has('department') ? $this->Html->link($departmentsMember->department->name, ['controller' => 'Departments', 'action' => 'view', $departmentsMember->department->id]) : '' ?></td>
			                <td><?= $departmentsMember->has('user') ? $this->Html->link($departmentsMember->user->name, ['controller' => 'Users', 'action' => 'view', $departmentsMember->user->id]) : '' ?></td>
			                <td><?= h($departmentsMember->created) ?></td>
			                <td><?= h($departmentsMember->modified) ?></td>
			                <td class="actions">
			                    <?= $this->Html->link(__('View'), ['action' => 'view', $departmentsMember->id], ['class'=>'button small']) ?>
			                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $departmentsMember->id], ['class'=>'button small']) ?>
			                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $departmentsMember->id], ['confirm' => __('Are you sure you want to delete # {0}?', $departmentsMember->user->name), 'class'=>'button small alert']) ?>
								<?php
									if($departmentsMember->department_role == 1){
										echo '<span class="button small secondary">Department Staff</span>';
									}else{
										echo $this->Form->postLink(__('Department Staff'), ['action' => 'set_role', $departmentsMember->id, 1], ['confirm' => __('Are you sure you want to ', $departmentsMember->user->name.' department staff?'), 'class'=>'button small primary']);
									}
									
									if($departmentsMember->department_role == 2){
										echo '<span class="button small secondary">Supervisor</span>';
									}else{
										echo $this->Form->postLink(__('Supervisor'), ['action' => 'set_role', $departmentsMember->id, 2], ['confirm' => __('Are you sure you want to ', $departmentsMember->user->name.' supervisor?'), 'class'=>'button small primary']);
									}
									
									if($departmentsMember->department_role == 3){
										echo '<span class="button small secondary">Department Head</span>';
									}else{
										echo $this->Form->postLink(__('Department Head'), ['action' => 'set_role', $departmentsMember->id, 3], ['confirm' => __('Are you sure you want to make ', $departmentsMember->user->name.' department head?'), 'class'=>'button small primary']);
									}
								?>
			                </td>
			            </tr>
			            <?php endforeach; ?>
			        </tbody>
			    </table>
			</div>
		</div>
	</div>
</div>
