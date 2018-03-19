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
$this->assign('title', 'Departments');
?>

<div class="off-canvas-content" data-off-canvas-content>
	<!-- Your page content lives here -->
	<div id="mains" class="medium-12 columns admin-content">
		<?= $this->element('admin'.DS.'topbar') ?>
		<div class="medium-12 large-6 columns main-admin-content float-left">
			<div class="large-12 columns panel-wrap action-bar">
				<?= $this->Html->link(__('<span class="fa fa-list-ol"></span> List Departments'), ['controller'=>'Departments', 'action' => 'index'], ['class'=>'button', 'escape'=>false]) ?>
			    <?= $this->Html->link(__('<span class="fa fa-plus"></span> New Department'), ['controller'=>'Departments', 'action' => 'add'], ['class'=>'button', 'escape'=>false]) ?>
				<?= $this->Html->link(__('<span class="fa fa-list-ol"></span> Department Staff'), ['controller' => 'DepartmentsMembers', 'action' => 'index'], ['class'=>'button active', 'escape'=>false]) ?>
			</div>
			<div class="large-12 columns panel-wrap">
			    <h3><?= __('Add Departments Staff') ?></h3>
				<div class="large-12 columns users">
				    <?= $this->Form->create($departmentsMember) ?>
			        <?php
						echo '<div class="medium-12 columns pad-col-x">';
			            echo $this->Form->control('user_id', ['options' => $users]);
						echo '</div>';
						echo '<div class="medium-12 columns pad-col-x">';
						echo $this->Form->control('department_id', ['options' => $departments, 'default'=>$department_id]);
						echo '</div>';
			        ?>
					<div class="medium-12 columns pad-col-x">
					<?= $this->Form->button(__('Submit'), ['class'=>'button']) ?>
					</div>
				    <?= $this->Form->end() ?>
				</div>
			</div>
		</div>
	</div>
</div>
