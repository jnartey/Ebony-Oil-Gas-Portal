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
$this->assign('title', 'News');
?>
<div class="off-canvas-content" data-off-canvas-content>
	<!-- Your page content lives here -->
	<div id="mains" class="medium-12 columns admin-content">
		<?= $this->element('admin'.DS.'topbar') ?>
		<div class="medium-12 large-6 columns main-admin-content float-left">
			<div class="large-12 columns panel-wrap action-bar">
				<?= $this->Html->link(__('<span class="fa fa-list-ol"></span> List News'), ['action' => 'index'], ['class'=>'button', 'escape'=>false]) ?>
			    <?= $this->Html->link(__('<span class="fa fa-plus"></span> Add News'), ['action' => 'add'], ['class'=>'button', 'escape'=>false]) ?>
				<?= $this->Html->link(__('<span class="fa fa-list-ol"></span> List Categories'), ['controller'=>'Categories', 'action' => 'index'], ['class'=>'button', 'escape'=>false]) ?>
			    <?= $this->Html->link(__('<span class="fa fa-plus"></span> Add Categories'), ['controller'=>'Categories', 'action' => 'add'], ['class'=>'button', 'escape'=>false]) ?>
				<?= $this->Form->postLink(
		                __('Delete'),
		                ['action' => 'delete', $category->id],
		                ['confirm' => __('Are you sure you want to delete # {0}?', $category->name), 'class'=>'button alert']
		            )
		        ?>
			</div>
			<div class="large-12 columns panel-wrap">
				<h3><?= __('Edit | '.$category->name) ?></h3>
				<div class="large-12 columns users">
				    <?= $this->Form->create($category) ?>
					<div class="medium-12 columns pad-col-x">
				        <?php
				            echo $this->Form->control('name');
				        ?>
				    </div>
					<div class="medium-12 columns pad-col-x">
				    <?= $this->Form->button(__('Update'), ['class'=>'button']) ?>
					</div>
				    <?= $this->Form->end() ?>
				</div>
			</div>
		</div>
	</div>
</div>
