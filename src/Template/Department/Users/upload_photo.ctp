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

$this->layout = 'default';
$this->assign('title', 'User');
?>
<!-- Your page content lives here -->
<div class="large-12 panel-wrap">
	<div class="large-12 users">
    	<?= $this->Form->create($user, ['type' => 'file']) ?>
			<div class="medium-12">
	        	<h5><?= __('Upload Photo') ?></h5>
			</div>
	        <?php
				echo '<div class="medium-12 pad-col-x">';
	            echo $this->Form->input('photo', ['type' => 'file']);
		        echo $this->Form->hidden('username');
		        echo $this->Form->hidden('first_name');
		        echo $this->Form->hidden('last_name');
		        echo $this->Form->hidden('email');
				echo '</div>';
	        ?>
			<?php 
			echo '<div class="medium-12 pad-col-x">';
			echo $this->Html->link(__('Cancel'), ['controller' => 'Users', 'action' => 'index'], ['class' => 'button secondary', 'escape'=>false]);
			echo '&nbsp;';
			echo $this->Form->button(__('Upload Photo'), ['class'=>'button']);
			echo '</div>';
		?>
	    <?= $this->Form->end() ?>
	</div>
</div>
