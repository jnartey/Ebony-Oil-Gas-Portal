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
$this->assign('title', 'Vehicles');
?>

<div class="off-canvas-content" data-off-canvas-content>
	<!-- Your page content lives here -->
	<div id="mains" class="medium-12 columns admin-content">
		<?= $this->element('admin'.DS.'topbar') ?>
		<div class="large-12 columns main-admin-content">
			<div class="large-12 columns panel-wrap action-bar">
			    <?= $this->Html->link(__('<span class="fa fa-plus"></span> New Vehicle'), ['action' => 'add'], ['class'=>'button', 'escape'=>false]) ?>
			</div>
			<div class="large-8 columns panel-wrap float-left">
			    <table id="general-table" class="display" width="100%" cellpadding="0" cellspacing="0">
			        <thead>
			            <tr>
			                <th><?= __('#') ?></th>
			                <th><?= __('Resgisteration Number') ?></th>
			                <th><?= __('Model') ?></th>
			                <th class="actions"><?= __('Actions') ?></th>
			            </tr>
			        </thead>
			        <tbody id="live-data">
			            <?php foreach ($vehicles as $vehicle): ?>
			            <tr>
			                <td><?= $this->Number->format($vehicle->id) ?></td>
			                <td><?= h($vehicle->registeration_number) ?></td>
			                <td><?= h($vehicle->model) ?></td>
			                <td class="actions">
			                    <?= $this->Html->link(__('View'), ['action' => 'view', $vehicle->id]) ?>
			                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $vehicle->id]) ?>
			                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $vehicle->id], ['confirm' => __('Are you sure you want to delete # {0}?', $vehicle->id)]) ?>
			                </td>
			            </tr>
			            <?php endforeach; ?>
			        </tbody>
			    </table>
			</div>
		</div>
	</div>
</div>

