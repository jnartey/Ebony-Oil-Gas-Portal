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
$this->assign('title', 'Events');
?>

<div class="off-canvas-content" data-off-canvas-content>
	<!-- Your page content lives here -->
	<div id="mains" class="medium-12 columns admin-content">
		<?= $this->element('admin'.DS.'topbar') ?>
		<div class="large-12 columns main-admin-content">
			<div class="large-12 columns panel-wrap action-bar">
				<?= $this->Html->link(__('Edit Event'), ['action' => 'edit', $event->id], ['class'=>'button', 'escape'=>false]) ?>
				<?= $this->Html->link(__('<span class="fa fa-list-ol"></span> List Events'), ['controller'=>'Events', 'action' => 'index'], ['class'=>'button', 'escape'=>false]) ?>
			    <?= $this->Html->link(__('<span class="fa fa-plus"></span> Add Event'), ['controller'=>'Events', 'action' => 'add'], ['class'=>'button', 'escape'=>false]) ?>
				<?= $this->Form->postLink(
				                __('Delete'),
				                ['action' => 'delete', $event->id],
				                ['confirm' => __('Are you sure you want to delete # {0}?', $event->name), 'class'=>'button alert']
				            )
				        ?>
				
			</div>
			<div class="large-12 columns">
				<div class="large-12 columns panel-wrap">
					<h3><?= h($event->name) ?></h3>
				</div>
				<div class="large-7 columns panel-wrap float-left">
					<div class="large-12 columns panel sp">
						<div class="large-12 columns content">
							<h6><?= __('From Date') ?></h6>
							<?= $event->from_date; ?><br /><br />
							<h6><?= __('To Date') ?></h6>
							<?= $event->to_date; ?><br /><br />
							<h6><?= __('Name') ?></h6>
							<?= $event->name; ?><br /><br />
							<h6><?= __('Description') ?></h6>
							<?= $this->Text->autoParagraph($event->description); ?>
							<h6><?= __('Location') ?></h6>
							<?= $event->location; ?>
						</div>
					</div>
				</div>
				<!-- <div class="large-12 columns panel-wrap">
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
			                    <?= $this->Html->link(__('View'), ['controller' => 'DepartmentsMembers', 'action' => 'view', $departmentsMembers->department_id], ['class'=>'button small']) ?>
			                    <?= $this->Html->link(__('Edit'), ['controller' => 'DepartmentsMembers', 'action' => 'edit', $departmentsMembers->department_id], ['class'=>'button small']) ?>
			                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'DepartmentsMembers', 'action' => 'delete', $departmentsMembers->department_id], ['confirm' => __('Are you sure you want to delete # {0}?', $departmentsMembers->department_id), 'class'=>'button small alert']) ?>
			                </td>
			            </tr>
			            <?php endforeach; ?>
					</tbody>
		        </table>
		        <?php endif; ?>
				</div> -->
			</div>
		</div>
	</div>
</div>