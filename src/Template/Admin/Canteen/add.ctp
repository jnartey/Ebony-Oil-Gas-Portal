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
		<div class="medium-12 large-12 columns main-admin-content float-left">
			<div class="large-12 columns panel-wrap action-bar">
				<?= $this->Html->link(__('<span class="fa fa-list-ol"></span> List Menu'), ['controller'=>'Canteen', 'action' => 'index'], ['class'=>'button active', 'escape'=>false]) ?>
			    <?= $this->Html->link(__('<span class="fa fa-plus"></span> Add Menu'), ['controller'=>'Canteen', 'action' => 'add'], ['class'=>'button', 'escape'=>false]) ?>
			</div>
			<div class="large-12 columns panel-wrap">
				<h3><?= __('Add Menu') ?></h3>
				<div class="large-12 columns users">
				    <?= $this->Form->create($canteen) ?>
			        <?php
						echo '<div class="medium-5 columns pad-col-x">';
		            	echo $this->Form->control('menu');
						echo '</div>';
						echo '<div class="medium-12 columns">';
						echo '<div class="medium-12 columns pad-col-x">';
						echo '<h5>'.__('Monday').'</h5>';
						echo '</div>';
						echo $this->Form->hidden('1.day', ['value' => '1']);
						echo '<div class="medium-4 columns pad-col-x">';
						echo $this->Form->control('1.morning_meal');
						echo $this->Form->control('1.morning_meal_description');
						echo '</div>';
						echo '<div class="medium-4 columns pad-col-x">';
						echo $this->Form->control('1.afternoon_meal');
						echo $this->Form->control('1.afternoon_meal_description');
						echo '</div>';
						echo '<div class="medium-4 columns pad-col-x">';
						echo $this->Form->control('1.evening_meal');
						echo $this->Form->control('1.evening_meal_description');
						echo '</div>';
						echo '</div>';
						echo '<div class="medium-12 columns">';
						echo '<div class="medium-12 columns pad-col-x">';
						echo '<h5>'.__('Tuesday').'</h5>';
						echo '</div>';
						echo $this->Form->hidden('2.day', ['value' => '2']);
						echo '<div class="medium-4 columns pad-col-x">';
						echo $this->Form->control('2.morning_meal');
						echo $this->Form->control('2.morning_meal_description');
						echo '</div>';
						echo '<div class="medium-4 columns pad-col-x">';
						echo $this->Form->control('2.afternoon_meal');
						echo $this->Form->control('2.afternoon_meal_description');
						echo '</div>';
						echo '<div class="medium-4 columns pad-col-x">';
						echo $this->Form->control('2.evening_meal');
						echo $this->Form->control('2.evening_meal_description');
						echo '</div>';
						echo '</div>';
						echo '<div class="medium-12 columns">';
						echo '<div class="medium-12 columns pad-col-x">';
						echo '<h5>'.__('Wednesday').'</h5>';
						echo '</div>';
						echo $this->Form->hidden('3.day', ['value' => '3']);
						echo '<div class="medium-4 columns pad-col-x">';
						echo $this->Form->control('3.morning_meal');
						echo $this->Form->control('3.morning_meal_description');
						echo '</div>';
						echo '<div class="medium-4 columns pad-col-x">';
						echo $this->Form->control('3.afternoon_meal');
						echo $this->Form->control('3.afternoon_meal_description');
						echo '</div>';
						echo '<div class="medium-4 columns pad-col-x">';
						echo $this->Form->control('3.evening_meal');
						echo $this->Form->control('3.evening_meal_description');
						echo '</div>';
						echo '</div>';
						echo '<div class="medium-12 columns">';
						echo '<div class="medium-12 columns pad-col-x">';
						echo '<h5>'.__('Thursday').'</h5>';
						echo '</div>';
						echo $this->Form->hidden('4.day', ['value' => '4']);
						echo '<div class="medium-4 columns pad-col-x">';
						echo $this->Form->control('4.morning_meal');
						echo $this->Form->control('4.morning_meal_description');
						echo '</div>';
						echo '<div class="medium-4 columns pad-col-x">';
						echo $this->Form->control('4.afternoon_meal');
						echo $this->Form->control('4.afternoon_meal_description');
						echo '</div>';
						echo '<div class="medium-4 columns pad-col-x">';
						echo $this->Form->control('4.evening_meal');
						echo $this->Form->control('4.evening_meal_description');
						echo '</div>';
						echo '</div>';
						echo '<div class="medium-12 columns">';
						echo '<div class="medium-12 columns pad-col-x">';
						echo '<h5>'.__('Friday').'</h5>';
						echo '</div>';
						echo $this->Form->hidden('5.day', ['value' => '5']);
						echo '<div class="medium-4 columns pad-col-x">';
						echo $this->Form->control('5.morning_meal');
						echo $this->Form->control('5.morning_meal_description');
						echo '</div>';
						echo '<div class="medium-4 columns pad-col-x">';
						echo $this->Form->control('5.afternoon_meal');
						echo $this->Form->control('5.afternoon_meal_description');
						echo '</div>';
						echo '<div class="medium-4 columns pad-col-x">';
						echo $this->Form->control('5.evening_meal');
						echo $this->Form->control('5.evening_meal_description');
						echo '</div>';
						echo '</div>';
			        ?>
					<div class="medium-12 columns pad-col-x">
					<?= $this->Form->button(__('Add Menu'), ['class'=>'button']) ?>
				    <?= $this->Form->end() ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>