<?php
/**
  * @var \App\View\AppView $this
  */
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;
use Cake\Routing\Router;

$this->layout = 'default';
$this->assign('title', 'Media');
?>
<div class="media form large-12 columns">
	<div id="file-reponse"></div>
    <?= $this->Form->create($media, ['type' => 'file', 'id' => 'upload-form']) ?>
    <fieldset>
        <legend><?= __('Upload Media') ?></legend>
        <?php
			echo $this->Form->input('file_name', ['type' => 'file']);
			echo $this->Form->hidden('parent_id', ['value' => $parent_id]);
        ?>
		<div class="progress">
	        <div class="bar"></div>
	        <div class="percent">0%</div>
	    </div>
    </fieldset>
    <?= $this->Form->button(__('Upload'), ['class'=>'button']) ?>
    <?= $this->Form->end() ?>
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
				<?php
					if($parent_id){
				?>
					$("#media-container").load("<?php echo $this->Url->build(DS.'department'.DS.'department-media'.DS.'mediaContent'.DS.$parent_id, true); ?>");
				<?php
					}else{
				?>
					$("#media-container").load("<?php echo $this->Url->build(DS.'department'.DS.'department-media'.DS.'mediaContent', true); ?>");
				<?php } ?>
			}
		}); 

	})();       
</script>