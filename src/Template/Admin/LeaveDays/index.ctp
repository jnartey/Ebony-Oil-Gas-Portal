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
$this->assign('title', 'Leave Days');
?>

<div class="off-canvas-content" data-off-canvas-content>
	<!-- Your page content lives here -->
	<div id="mains" class="medium-12 columns admin-content">
		<?= $this->element('admin'.DS.'topbar') ?>
		<div class="large-12 columns main-admin-content">
			<div class="large-12 columns panel-wrap action-bar">
			    <?= $this->Html->link(__('<span class="fa fa-plus"></span> New User'), ['action' => 'add'], ['class'=>'button', 'escape'=>false]) ?>
			</div>
			<div class="large-10 columns panel-wrap float-left">
			    <table id="general-table" class="display" width="100%" cellpadding="0" cellspacing="0">
			        <thead>
			            <tr>
			                <th><?= __('#') ?></th>
			                <th><?= __('User') ?></th>
			                <th><?= __('Annual') ?></th>
							<th><?= __('Study') ?></th>
							<th><?= __('Maternity') ?></th>
							<th><?= __('Paternity') ?></th>
			                <th class="actions"><?= __('Actions') ?></th>
			            </tr>
			        </thead>
			        <tbody id="live-data">
			            <?php foreach ($leaveDays as $leaveDay): ?>
			            <tr>
			                <td><?= $this->Number->format($leaveDay->id) ?></td>
			                <td><?= $leaveDay->has('user') ? $this->Html->link($leaveDay->user->name, ['controller' => 'Users', 'action' => 'view', $leaveDay->user->id]) : '' ?></td>
			                <td><?= $this->Number->format($leaveDay->annual_leave_days) ?></td>
							<td><?= $this->Number->format($leaveDay->study_leave_days) ?></td>
							<td><?= $this->Number->format($leaveDay->maternity_leave_days) ?></td>
							<td><?= $this->Number->format($leaveDay->paternity_leave_days) ?></td>
			                <td class="actions">
			                    <?= $this->Html->link(__('View'), ['action' => 'view', $leaveDay->id]) ?>
			                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $leaveDay->id]) ?>
			                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $leaveDay->id], ['confirm' => __('Are you sure you want to delete # {0}?', $leaveDay->id)]) ?>
			                </td>
			            </tr>
			            <?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>