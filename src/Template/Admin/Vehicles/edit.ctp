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
		<div class="medium-12 large-6 columns main-admin-content float-left">
			<div class="large-12 columns panel-wrap action-bar">
				<?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class'=>'button', 'escape'=>false]) ?>
				<?= $this->Form->postLink(
				                __('Delete'),
				                ['action' => 'delete', $vehicle->id],
				                ['confirm' => __('Are you sure you want to delete # {0}?', $vehicle->registeration_number), 'class'=>'button alert']
				            )
				        ?>
			</div>
			<div class="large-12 columns panel-wrap">
				<div class="large-12 columns users">
				    <?= $this->Form->create($vehicle) ?>
				    <fieldset>
				        <legend><?= __('Edit Vehicle') ?></legend>
				        <?php
				            echo $this->Form->control('registeration_number');
				            echo $this->Form->control('model');
				        ?>
				    </fieldset>
				    <?= $this->Form->button(__('Update'), ['class'=>'button']) ?>
				    <?= $this->Form->end() ?>
				</div>
			</div>
		</div>
	</div>
</div>
