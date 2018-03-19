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
		<div class="medium-12 large-6 columns main-admin-content float-left">
			<div class="large-12 columns panel-wrap action-bar">
				<?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class'=>'button', 'escape'=>false]) ?>
			</div>
			<div class="large-12 columns panel-wrap">
				<div class="large-12 columns users">
				    <?= $this->Form->create($requestHandler) ?>
					<div class="medium-12 columns pad-col">
			        	<h5><?= __('Add Request Administrator') ?></h5>
					</div>
			        <?php
						echo '<div class="medium-12 columns pad-col-x">';
			            echo $this->Form->control('request_forms_id', ['options' => $requestForms]);
			            echo $this->Form->control('department_id', ['options' => $departments]);
			            echo $this->Form->control('user_id', ['empty'=>[null => 'None']]);
						echo $this->Form->button(__('Add'), ['class'=>'button']);
			        ?>
				    <?= $this->Form->end() ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
