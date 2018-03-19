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
		<div class="medium-12 large-6 columns main-admin-content float-left">
			<div class="large-12 columns panel-wrap action-bar">
				<?= $this->Html->link(__('<span class="fa fa-list-ol"></span> List Events'), ['controller'=>'Events', 'action' => 'index'], ['class'=>'button active', 'escape'=>false]) ?>
			    <?= $this->Html->link(__('<span class="fa fa-plus"></span> Add Event'), ['controller'=>'Events', 'action' => 'add'], ['class'=>'button', 'escape'=>false]) ?>
			</div>
			<div class="large-12 columns panel-wrap">
				<h3><?= __('Add Event') ?></h3>
				<div class="large-12 columns users">
				    <?= $this->Form->create($event) ?>
			        <?php
						echo '<div class="medium-6 columns pad-col-x">';
		            	echo $this->Form->control('from_date', ['type' => 'text', 'id'=>'from']);
						echo '</div>';
						echo '<div class="medium-6 columns pad-col-x">';
						echo $this->Form->control('to_date', ['type' => 'text', 'id'=>'to']);
						echo '</div>';
						echo '<div class="medium-12 columns pad-col-x">';
			            echo $this->Form->control('name');
						echo '</div>';
						echo '<div class="medium-12 columns pad-col-x">';
			            echo $this->Form->control('description', ['class'=>'editor']);
						echo '</div>';
						echo '<div class="medium-12 columns pad-col-x">';
			            echo $this->Form->control('location');
						echo '</div>';
			        ?>
					<div class="medium-12 columns pad-col-x">
					<?= $this->Form->button(__('Add Event'), ['class'=>'button']) ?>
				    <?= $this->Form->end() ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>