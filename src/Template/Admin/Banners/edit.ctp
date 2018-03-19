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
$this->assign('title', 'Banners');
?>
<div class="off-canvas-content" data-off-canvas-content>
	<!-- Your page content lives here -->
	<div id="mains" class="medium-12 columns admin-content">
		<?= $this->element('admin'.DS.'topbar') ?>
		<div class="medium-12 large-6 columns main-admin-content float-left">
			<div class="large-12 columns panel-wrap action-bar">
				<?= $this->Html->link(__('<span class="fa fa-list-ol"></span> List Banners'), ['controller'=>'Banners', 'action' => 'index'], ['class'=>'button active', 'escape'=>false]) ?>
				<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $banner->id], ['confirm' => __('Are you sure you want to delete # {0}?', $banner->title), 'class'=>'button alert']) ?>
			</div>
			<div class="large-12 columns panel-wrap">
				<h3><?= __('Add Banner') ?></h3>
				<div class="large-12 columns users">
					<div id="file-reponse"></div>
				    <?= $this->Form->create($banner, ['type' => 'file']) ?>
				    <fieldset>
				        <legend><?= __('Add Banner') ?></legend>
				        <?php
				            echo $this->Form->control('title');
				            echo $this->Form->control('description');
							echo $this->Form->input('banner_image', ['type' => 'file']);
				        ?>
				    </fieldset>
						<div class="progress">
					        <div class="bar"></div>
					        <div class="percent">0%</div>
					    </div>
						<?php 
						echo '<div class="medium-12">';
						echo $this->Form->button(__('Edit Banner'), ['class'=>'button']);
						echo '</div>';
					?>
				    <?= $this->Form->end() ?>
				</div>
			</div>
		</div>
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
