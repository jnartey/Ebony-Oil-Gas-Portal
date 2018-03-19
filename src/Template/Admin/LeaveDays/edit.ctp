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
		<div class="medium-12 large-6 columns main-admin-content float-left">
			<div class="large-12 columns panel-wrap action-bar">
				<?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class'=>'button', 'escape'=>false]) ?>
				<?= $this->Form->postLink(
		                __('Delete'),
		                ['action' => 'delete', $leaveDay->id],
		                ['confirm' => __('Are you sure you want to delete # {0}?', $leaveDay->id), 'class'=>'button alert']
		            )
		        ?>
			</div>
			<div class="large-12 columns panel-wrap">
				<div class="large-12 columns users">
				    <?= $this->Form->create($leaveDay) ?>
			        <h5><?= __('Edit Leave Days') ?></h5>
			        <?php
			            echo $this->Form->control('user_id', ['options' => $users]);
			            echo $this->Form->control('annual_leave_days');
						echo $this->Form->control('study_leave_days');
						echo $this->Form->control('maternity_leave_days');
						echo $this->Form->control('paternity_leave_days');
			        ?>
					<?= $this->Form->button(__('Update'), ['class'=>'button']) ?>
				    <?= $this->Form->end() ?>
				</div>
			</div>
		</div>
	</div>
</div>