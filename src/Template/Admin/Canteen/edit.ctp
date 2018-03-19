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
				<?php
					if($day){
						echo $this->Html->link(__('Back'), ['controller'=>'Canteen', 'action' => 'view', $canteen->menu], ['class'=>'button active', 'escape'=>false]);
					}else{
						echo $this->Html->link(__('Back'), ['controller'=>'Canteen', 'action' => 'index'], ['class'=>'button active', 'escape'=>false]);
					}
				?>
				<?php 
					if($day){
						echo $this->Form->postLink(
					                __('Delete'),
					                ['action' => 'delete', $canteen->id],
					                ['confirm' => __('Are you sure you want to delete Menu Day # {0}?', $canteen->day), 'class'=>'button alert']
					            );
					}else{
						echo $this->Form->postLink(
					                __('Delete'),
					                ['action' => 'delete', $canteen->id],
					                ['confirm' => __('Are you sure you want to delete week # {0}?', $canteen->menu), 'class'=>'button alert']
					            );
					}
					
				 ?>
			</div>
			<div class="large-12 columns panel-wrap">
				<h3><?php
					if($day){
						echo __('Edit Day '.$canteen->day);
					}else{
						echo __('Edit Week '.$canteen->week);
					}
						
					?></h3>
				<div class="large-12 columns users">
				    <?= $this->Form->create($canteen) ?>
			        <?php
						if($day){
							echo '<div class="medium-4 columns pad-col-x">';
							echo $this->Form->control('morning_meal');
							echo $this->Form->control('morning_meal_description');
							echo '</div>';
							echo '<div class="medium-4 columns pad-col-x">';
							echo $this->Form->control('afternoon_meal');
							echo $this->Form->control('afternoon_meal_description');
							echo '</div>';
							echo '<div class="medium-4 columns pad-col-x">';
							echo $this->Form->control('evening_meal');
							echo $this->Form->control('evening_meal_description');
							echo '</div>';
						}else{
							echo '<div class="medium-5 columns pad-col-x">';
							echo $this->Form->control('menu');
							echo '</div>';
						}
			        ?>
					<div class="medium-12 columns pad-col-x">
					<?= $this->Form->button(__('Update'), ['class'=>'button']) ?>
				    <?= $this->Form->end() ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>