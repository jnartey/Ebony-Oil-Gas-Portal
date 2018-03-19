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
$this->assign('title', 'Forum');
?>

<div class="off-canvas-content" data-off-canvas-content>
	<!-- Your page content lives here -->
	<div id="mains" class="medium-12 columns admin-content">
		<?= $this->element('admin'.DS.'topbar') ?>
		<div class="large-12 columns main-admin-content">
			<div class="large-12 columns panel-wrap action-bar">
				<?= $this->Html->link(__('<span class="fa fa-list-ol"></span> List Forum'), ['controller'=>'Forum', 'action' => 'index'], ['class'=>'button active', 'escape'=>false]) ?>
			    <?= $this->Html->link(__('<span class="fa fa-plus"></span> Add Forum'), ['controller'=>'Forum', 'action' => 'add'], ['class'=>'button', 'escape'=>false]) ?>
			</div>
			<div class="large-12 columns panel-wrap">
				<h3><?= __('Forum') ?></h3>
			    <table id="general-table" class="display" width="100%" cellpadding="0" cellspacing="0">
			        <thead>
			            <tr>
			                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
			                <th scope="col"><?= $this->Paginator->sort('department_id') ?></th>
			                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
			                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
			                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
			                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
			                <th scope="col" class="actions"><?= __('Actions') ?></th>
			            </tr>
			        </thead>
			        <tbody>
			            <?php foreach ($departmentsForums as $departmentsForum): ?>
			            <tr>
			                <td><?= $this->Number->format($departmentsForum->id) ?></td>
			                <td><?= $departmentsForum->has('department') ? $this->Html->link($departmentsForum->department->name, ['controller' => 'Departments', 'action' => 'view', $departmentsForum->department->id]) : '' ?></td>
			                <td><?= $departmentsForum->has('user') ? $this->Html->link($departmentsForum->user->id, ['controller' => 'Users', 'action' => 'view', $departmentsForum->user->id]) : '' ?></td>
			                <td><?= h($departmentsForum->title) ?></td>
			                <td><?= h($departmentsForum->created) ?></td>
			                <td><?= h($departmentsForum->modified) ?></td>
			                <td class="actions">
			                    <?= $this->Html->link(__('View'), ['action' => 'view', $departmentsForum->id]) ?>
			                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $departmentsForum->id]) ?>
			                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $departmentsForum->id], ['confirm' => __('Are you sure you want to delete # {0}?', $departmentsForum->name)]) ?>
			                </td>
			            </tr>
			            <?php endforeach; ?>
			        </tbody>
			    </table>
			</div>
		</div>
	</div>
</div>
