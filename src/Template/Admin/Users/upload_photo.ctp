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
<!-- Your page content lives here -->
<div class="large-12 panel-wrap">
	<div class="large-12 users">
		<div id="file-reponse"></div>
    	<?= $this->Form->create($user, ['type' => 'file']) ?>
			<div class="medium-12 pad-col">
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
			<div class="progress">
		        <div class="bar"></div>
		        <div class="percent">0%</div>
		    </div>
			<?php 
			echo '<div class="medium-12 pad-col-x">';
			echo $this->Html->link(__('Cancel'), ['controller' => 'Users', 'action' => 'index'], ['class' => 'button secondary', 'escape'=>false]);
			echo $this->Form->button(__('Upload Photo'), ['class'=>'button']);
			echo '</div>';
		?>
	    <?= $this->Form->end() ?>
	</div>
</div>
<script>
	(function() {
    
		var bar = $('.bar');
		var percent = $('.percent');
		var status = $('#file-reponse');
   
		$('form').ajaxForm({
		    beforeSend: function() {
		        status.empty();
		        var percentVal = '0%';
		        bar.width(percentVal)
		        percent.html(percentVal);
		    },
		    uploadProgress: function(event, position, total, percentComplete) {
		        var percentVal = percentComplete + '%';
		        bar.width(percentVal)
		        percent.html(percentVal);
		    },
		    success: function() {
		        var percentVal = '100%';
		        bar.width(percentVal)
		        percent.html(percentVal);
		    },
			complete: function(xhr) {
				var parsedData = JSON.parse(xhr.responseText);
				status.fadeIn();
				status.html(parsedData['result']);
				$('form')[0].reset();
				location.reload();
			}
		}); 

	})();       
</script>
