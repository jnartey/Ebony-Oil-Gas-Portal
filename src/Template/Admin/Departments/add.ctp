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
				<?= $this->Html->link(__('<span class="fa fa-list-ol"></span> List Departments'), ['action' => 'index'], ['class'=>'button', 'escape'=>false]) ?>
			</div>
			<div class="large-12 columns panel-wrap">
				<div class="large-12 columns users">
				    <?= $this->Form->create($department) ?>
						<div class="medium-6 columns pad-col-x">
					        <h5><?= __('Add Department') ?></h5>
						</div>
				        <?php
				            echo $this->Form->hidden('user_id', ['value' => $activeUser['id']]);
							echo '<div class="medium-qw columns"><div class="medium-4 columns pad-col-x">';
							$options = array(1=>'Department', 3=>'Department with access to Requests');
				            echo $this->Form->control('department_type',['options'=>$options]);
							echo '</div></div>';
							echo '<div class="medium-12 columns pad-col-x">';
				            echo $this->Form->control('name');
							echo '</div>';
							// echo '<div class="medium-12 columns pad-col-x">';
// 				            echo $this->Form->control('logo');
// 							echo '</div>';
							echo '<div class="medium-12 columns pad-col-x">';
				            echo $this->Form->control('description', ['class'=>'editor']);
							echo '</div>';
				        ?>
						<div class="medium-12 columns pad-col-x">
						<?= $this->Form->button(__('Add Department'), ['class'=>'button']) ?>
						</div>
				    <?= $this->Form->end() ?>
				</div>
			</div>
		</div>
	</div>
</div>
