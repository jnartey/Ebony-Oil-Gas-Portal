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
$this->assign('title', 'Request Administrators');
?>

<div class="off-canvas-content" data-off-canvas-content>
	<!-- Your page content lives here -->
	<div id="mains" class="medium-12 columns admin-content">
		<?= $this->element('admin'.DS.'topbar') ?>
		<div class="large-12 columns main-admin-content">
			<div class="large-12 columns panel-wrap action-bar">
			    <?= $this->Html->link(__('<span class="fa fa-plus"></span> New Request Administration'), ['action' => 'add'], ['class'=>'button', 'escape'=>false]) ?>
			</div>
			<div class="large-12 columns panel-wrap">
			    <table id="general-table" class="display" width="100%" cellpadding="0" cellspacing="0">
			        <thead>
			            <tr>
			                <th><?= __('#') ?></th>
			                <th><?= __('Request Form') ?></th>
			                <th><?= __('Department') ?></th>
			                <th><?= __('User') ?></th>
			                <th class="actions"><?= __('Actions') ?></th>
			            </tr>
			        </thead>
			        <tbody id="live-data">
			            <?php foreach ($requestHandlers as $requestHandler): ?>
			            <tr>
			                <td><?= $this->Number->format($requestHandler->id) ?></td>
			                <td><?= $requestHandler->has('request_form') ? $this->Html->link($requestHandler->request_form->name, ['controller' => 'RequestForms', 'action' => 'view', $requestHandler->request_form->id]) : '' ?></td>
			                <td><?= $requestHandler->has('department') ? $this->Html->link($requestHandler->department->name, ['controller' => 'Departments', 'action' => 'view', $requestHandler->department->id]) : '' ?></td>
			                <td><?= $this->Number->format($requestHandler->user_id) ?></td>
			                <td class="actions">
			                    <?= $this->Html->link(__('View'), ['action' => 'view', $requestHandler->id]) ?>
			                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $requestHandler->id]) ?>
			                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $requestHandler->id], ['confirm' => __('Are you sure you want to delete # {0}?', $requestHandler->id)]) ?>
			                </td>
			            </tr>
			            <?php endforeach; ?>
			        </tbody>
			    </table>
			</div>
		</div>
	</div>
</div>
