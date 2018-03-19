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
$this->assign('title', 'Canteen');
?>

<div class="off-canvas-content" data-off-canvas-content>
	<!-- Your page content lives here -->
	<div id="mains" class="medium-12 columns admin-content">
		<?= $this->element('admin'.DS.'topbar') ?>
		<div class="large-12 columns main-admin-content">
			<div class="large-12 columns panel-wrap action-bar">
				<?= $this->Html->link(__('<span class="fa fa-list-ol"></span> List Menu'), ['action' => 'index'], ['class'=>'button', 'escape'=>false]) ?>
				<?= $this->Form->postLink(
				                __('Delete'),
				                ['action' => 'delete', $canteen->id],
				                ['confirm' => __('Are you sure you want to delete # {0}?', $canteen->menu), 'class'=>'button alert']
				            )
				?>
			</div>
			<div class="large-12 columns">
				<div class="large-12 columns panel-wrap">
					<h3><?= h($canteen->menu) ?></h3>
				</div>
				
				<div class="large-12 columns panel-wrap">
		        <h4><?= __('Menu') ?></h4>
		        <?php if (!empty($canteen_results)): ?>
		        <table id="general-table" class="display" width="100%" cellpadding="0" cellspacing="0">
					<thead>
			            <tr>
			                <!-- <th><?= __('#') ?></th> -->
			                <th><?= __('Day') ?></th>
			                <th><?= __('Morning Meal') ?></th>
			                <th><?= __('Morning Meal Description') ?></th>
			                <th><?= __('Morning Meal') ?></th>
			                <th><?= __('Morning Meal Description') ?></th>
			                <th><?= __('Morning Meal') ?></th>
			                <th><?= __('Morning Meal Description') ?></th>
			                <th class="actions"><?= __('Actions') ?></th>
			            </tr>
					</thead>
					<tbody>
			            <?php foreach ($canteen_results as $data): ?>
			            <tr>
			                <!-- <td><?= h($departmentsMembers->id) ?></td> -->
			                <td><?= h($data->day) ?></td>
			                <td><?= h($data->morning_meal) ?></td>
							<td><?= h($data->morning_meal_description) ?></td>
			                <td><?= h($data->afternoon_meal) ?></td>
							<td><?= h($data->afternoon_meal_description) ?></td>
			                <td><?= h($data->evening_meal) ?></td>
							<td><?= h($data->evening_meal_description) ?></td>
			                <td class="actions">
			                    <!-- <?= $this->Html->link(__('View'), ['controller' => 'canteen', 'action' => 'view', $data->id], ['class'=>'button small']) ?> -->
			                    <?= $this->Html->link(__('Edit'), ['controller' => 'canteen', 'action' => 'edit', $data->id, $data->day], ['class'=>'button small']) ?>
			                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'canteen', 'action' => 'delete', $data->id], ['confirm' => __('Are you sure you want to delete Menu Day # {0}?', $data->day), 'class'=>'button small alert']) ?>
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