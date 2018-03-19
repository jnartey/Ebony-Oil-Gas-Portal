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
				<?= $this->Html->link(__('<span class="fa fa-list-ol"></span> List Departments'), ['action' => 'index'], ['class'=>'button', 'escape'=>false]) ?>
				<?= $this->Html->link(__('<span class="fa fa-list-ol"></span> Department Staff'), ['controller' => 'DepartmentsMembers', 'action' => 'index'], ['class'=>'button', 'escape'=>false]) ?>
				<?= $this->Html->link(__('<span class="fa fa-plus"></span> Add Staff'), ['controller' => 'DepartmentsMembers', 'action' => 'add', $department->id], ['class'=>'button', 'escape'=>false]) ?>
			    <?= $this->Html->link(__('<span class="fa fa-plus"></span> New Department'), ['action' => 'add'], ['class'=>'button', 'escape'=>false]) ?>
				<?= $this->Form->postLink(
				                __('Delete'),
				                ['action' => 'delete', $department->id],
				                ['confirm' => __('Are you sure you want to delete # {0}?', $department->name), 'class'=>'button alert']
				            )
				?>
			</div>
			<div class="large-12 columns">
				<div class="large-12 columns panel-wrap">
					<h3><?= h($department->name) ?></h3>
				</div>
				<div class="large-7 columns panel-wrap">
					<div class="large-12 columns panel sp">
						<div class="large-12 columns content">
							<div class="small-7 columns">
								<h5>Staff</h5>
								<span class="sub-title">Total number of employees/staff</span>
							</div>
							<div class="small-5 columns text-right">
								<h5>0</h5>
							</div>
							<div class="large-12 columns">
								<?= $this->Text->autoParagraph($department->description); ?>
							</div>
						</div>
					</div>
				</div>
				<div class="large-12 columns panel-wrap">
		        <h4><?= __('Departments Members') ?></h4>
		        <?php if (!empty($members)): ?>
		        <table id="general-table" class="display" width="100%" cellpadding="0" cellspacing="0">
					<thead>
			            <tr>
			                <th><?= __('#') ?></th>
			                <th><?= __('User') ?></th>
			                <th><?= __('Created') ?></th>
			                <th><?= __('Modified') ?></th>
			                <th class="actions"><?= __('Actions') ?></th>
			            </tr>
					</thead>
					<tbody>
			            <?php foreach ($members as $departmentsMembers): ?>
			            <tr>
			                <td><?= h($departmentsMembers->id) ?></td>
			                <td><?= $departmentsMembers->has('user') ? $this->Html->link($departmentsMembers->user->name, ['controller' => 'Users', 'action' => 'view', $departmentsMembers->user->id]) : '' ?></td>
			                <td><?= h($departmentsMembers->created) ?></td>
			                <td><?= h($departmentsMembers->modified) ?></td>
			                <td class="actions">
			                    <?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $departmentsMembers->user_id], ['class'=>'button small']) ?>
			                    <?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'view', $departmentsMembers->user_id], ['class'=>'button small']) ?>
			                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'DepartmentsMembers', 'action' => 'delete', $departmentsMembers->id], ['confirm' => __('Are you sure you want to delete # {0}?', $departmentsMembers->user->name), 'class'=>'button small alert']) ?>
								<?php
									if($departmentsMembers->department_role == 1){
										echo '<span class="button small primary">Department Staff</span>';
									}else{
										echo $this->Form->postLink(__('Department Staff'), ['controller' => 'DepartmentsMembers', 'action' => 'set_role', $departmentsMembers->id, 1, $department->id], ['confirm' => __('Are you sure you want to ', $departmentsMembers->user->name.' department staff?'), 'class'=>'button small secondary']);
									}
									
									if($departmentsMembers->department_role == 2){
										echo '<span class="button small primary">Supervisor</span>';
									}else{
										echo $this->Form->postLink(__('Supervisor'), ['controller' => 'DepartmentsMembers', 'action' => 'set_role', $departmentsMembers->id, 2, $department->id], ['confirm' => __('Are you sure you want to ', $departmentsMembers->user->name.' supervisor?'), 'class'=>'button small secondary']);
									}
									
									if($departmentsMembers->department_role == 3){
										echo '<span class="button small primary">Department Head</span>';
									}else{
										echo $this->Form->postLink(__('Department Head'), ['controller' => 'DepartmentsMembers', 'action' => 'set_role', $departmentsMembers->id, 3, $department->id], ['confirm' => __('Are you sure you want to make ', $departmentsMembers->user->name.' department head?'), 'class'=>'button small secondary']);
									}
								?>
			                </td>
			            </tr>
			            <?php endforeach; ?>
					</tbody>
		        </table>
		        <?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>