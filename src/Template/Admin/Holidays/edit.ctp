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
$this->assign('title', 'Holidays');
?>
<div class="off-canvas-content" data-off-canvas-content>
	<!-- Your page content lives here -->
	<div id="mains" class="medium-12 columns admin-content">
		<?= $this->element('admin'.DS.'topbar') ?>
		<div class="medium-12 large-6 columns main-admin-content float-left">
			<div class="large-12 columns panel-wrap action-bar">
				<?= $this->Html->link(__('<span class="fa fa-list-ol"></span> Cancel'), ['controller'=>'Holidays', 'action' => 'index'], ['class'=>'button active', 'escape'=>false]) ?>
			</div>
			<div class="large-12 columns panel-wrap">
				<h3><?= __('Add Holiday') ?></h3>
				<div class="large-12 columns users">
				    <?= $this->Form->create($holiday) ?>
			        <?php
						echo '<div class="medium-6 columns pad-col-x">';
		            	echo $this->Form->control('holiday', ['type' => 'text']);
						echo '</div>';
						echo '<div class="medium-6 columns pad-col-x">';
						echo $this->Form->control('holiday_date', ['type' => 'text', 'id'=>'pick-date']);
						echo '</div>';
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
<script>
	$(function() {
	    var HOLIDAYS = [/*new Date(2015,1-1,1).getTime(), new Date(2015,1-1,26).getTime(),
	                    new Date(2015,4-1,3).getTime(), new Date(2015,4-1,6).getTime(),
	                    new Date(2015,4-1,25).getTime(), new Date(2015,12-1,25).getTime(),
	                    new Date(2015,12-1,26).getTime()*/];
	    $.datepicker.setDefaults({beforeShowDay: function(date) {
	        if ($.inArray(date.getTime(), HOLIDAYS) > -1) {
	            return [false, 'holiday'];
	        }
	        return $.datepicker.noWeekends(date);
	    }});
	    $('#pick-date').datepicker({
			dateFormat: "yy-mm-dd",
			onSelect: function(dateStr) {
	        	$('#pick-date').datepicker('option', {minDate: $(this).datepicker('getDate')});
	    	}
		});
	});
</script>
