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
				<?= $this->Html->link(__('<span class="fa fa-list-ol"></span> List Departments'), ['action' => 'index'], ['class'=>'button active', 'escape'=>false]) ?>
			    <?= $this->Html->link(__('<span class="fa fa-plus"></span> New Department'), ['action' => 'add'], ['class'=>'button', 'escape'=>false]) ?>
				<?= $this->Html->link(__('<span class="fa fa-list-ol"></span> Department Staff'), ['controller' => 'DepartmentsMembers', 'action' => 'index'], ['class'=>'button', 'escape'=>false]) ?>
			</div>
			<div class="large-12 columns panel-wrap">
			    <table id="general-table" class="display" width="100%" cellpadding="0" cellspacing="0">
			        <thead>
			            <tr>
			                <th><?= __('#') ?></th>
			                <th><?= __('Name') ?></th>
			                <!-- <th><?= __('Logo') ?></th>
							<th><?= __('Staff') ?></th> -->
							<th><?= __('Department Moderators') ?></th>
			                <th><?= __('Created By') ?></th>
			                <th class="actions"><?= __('Actions') ?></th>
			            </tr>
			        </thead>
			        <tbody>
			            <?php foreach ($departments as $department): ?>
			            <tr>
			                <td><?= $this->Number->format($department->id) ?></td>
			                <td><?= $this->Html->link(__(h($department->name)), ['action' => 'view', $department->id], ['escape'=>false]) ?></td>
			                <!-- <td><?= h($department->logo) ?></td>
							<td></td> -->
							<td></td>
			                <td><?= $department->has('user') ? $this->Html->link($department->user->name, ['controller' => 'Users', 'action' => 'view', $department->user->id]) : '' ?></td>
			                <td class="actions">
			                    <?= $this->Html->link(__('View'), ['action' => 'view', $department->id], ['class'=>'button small']) ?>
			                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $department->id], ['class'=>'button small']) ?>
			                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $department->id], ['confirm' => __('Are you sure you want to delete # {0}?', $department->name), 'class'=>'button small alert']) ?>
			                </td>
			            </tr>
			            <?php endforeach; ?>
			        </tbody>
			    </table>
			</div>
		</div>
	</div>
</div>