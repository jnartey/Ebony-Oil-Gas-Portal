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
$this->assign('title', 'User');
?>
<div class="off-canvas-content" data-off-canvas-content>
	<!-- Your page content lives here -->
	<div id="mains" class="medium-12 columns admin-content">
		<?= $this->element('admin'.DS.'topbar') ?>
		<div class="medium-12 large-8 columns main-admin-content float-left">
			<div class="large-12 columns panel-wrap action-bar">
				<?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class'=>'button', 'escape'=>false]) ?>
			</div>
			<div class="large-12 columns panel-wrap">
				<div class="large-12 columns users">
			    	<?= $this->Form->create($user, ['type' => 'file']) ?>
						<div class="medium-12 columns pad-col">
				        	<h5><?= __('Add User') ?></h5>
						</div>
				        <?php
							echo '<div class="medium-6 columns pad-col-x">';
				            echo $this->Form->control('first_name');
							echo '</div>';
							echo '<div class="medium-6 columns pad-col-x">';
				            echo $this->Form->control('last_name');
							echo '</div>';
							echo '<div class="medium-6 columns pad-col-x">';
				            echo $this->Form->control('username');
							echo '</div>';
							echo '<div class="medium-6 columns pad-col-x">';
				            echo $this->Form->control('email');
							echo '</div>';
							echo '<div class="medium-6 columns pad-col-x">';
				            echo $this->Form->control('employee_id', ['type'=>'text', 'label'=>'Employee ID']);
							echo '</div>';
							echo '<div class="large-12 columns"><div class="medium-6 columns pad-col-x">';
				            echo $this->Form->control('password');
							echo '</div>';
							echo '<div class="medium-6 columns pad-col-x">';
							echo $this->Form->control('confirm_password', ['type' => 'password']);
							echo '</div></div>';
							echo '<div class="medium-6 columns pad-col-x">';
				            echo $this->Form->control('phone_number');
							echo '</div>';
							echo '<div class="medium-6 columns pad-col-x">';
				            echo $this->Form->control('photo', ['type' => 'file']);
							echo '</div>';
							echo '<div class="medium-6 columns pad-col-x">';
				            echo $this->Form->control('role_id', ['options' => $roles]);
							echo '</div>';
							echo '<div class="medium-6 columns pad-col-x">';
				            echo $this->Form->control('position');
							echo '</div>';
				            //echo $this->Form->control('im_status');
				            //echo $this->Form->control('active');
				            //echo $this->Form->control('is_blocked');
				        ?>
						<?php 
						echo '<div class="medium-12 columns pad-col-x">';
						echo $this->Html->link(__('Cancel'), ['controller' => 'Users', 'action' => 'index'], ['class' => 'button secondary', 'escape'=>false]);
						echo $this->Form->button(__('Add User'), ['class'=>'button']);
						echo '</div>';
					?>
				    <?= $this->Form->end() ?>
				</div>
			</div>
		</div>
	</div>
</div>
