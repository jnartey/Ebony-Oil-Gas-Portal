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

$this->layout = 'default';
$this->assign('title', 'Requests');
echo $this->element('department/head');
?>
<main id="mains" class="large-12 columns main-content">
	<div class="row">
	    <div class="column small-12 large-9">
	        <section class="large-12 columns event-section">
	            <div class="large-12 columns event-heading">
	                <h1 class="column medium-4">Leave Request</h1>
		            <div class="column medium-8 text-right">
						<?php
							echo $this->Html->link(__('Cancel'), ['controller' => 'Requests', 'action' => 'index'], ['class'=>'button', 'escape'=>false]);
						?>
					</div>
	            </div>
				<div class="large-12 columns event-content">
					<nav aria-label="You are here:" role="navigation">
					  <ul class="breadcrumbs">
					    <li><?= $this->Html->link(__('Leave Request'), ['controller' => 'Requests', 'action' => 'index'], ['escape'=>false]); ?></li>
					    <li><?= __("Request Leave"); ?></li>
					  </ul>
					</nav>
					<div class="large-12 columns">
						<div class="large-12 columns portal-sp">
							<?php
								if(!$check_request){
							?>
							<div class="tasks form large-9 medium-8 columns content">
							    <?= $this->Form->create($leaveRequest) ?>
							    <fieldset>
						        <?php
									echo '<div class="large-12 columns">';
									echo '<div class="medium-6 columns pad-col-x">';
									$options = array('Annual'=>'Annual', 'Sick'=>'Sick', 'Study'=>'Study', 'Casual'=>'Casual', 'Bereavement'=>'Bereavement', 'Maternity'=>'Maternity', 'Paternity'=>'Paternity');
						            echo $this->Form->control('leave_type',['options'=>$options]);
									echo '</div>';
									echo '<div class="medium-6 columns pad-col-x">';
									echo '<label>&nbsp;</label>';
									echo '<span class="days-remaining"></span>';
									echo '</div>';
									echo '</div>';
									echo '<div class="medium-3 columns pad-col-x">';
						            echo $this->Form->control('start_date', ['type' => 'text', 'id'=>'from', 'readonly' => 'readonly']);
									echo '</div>';
									echo '<div class="medium-3 columns pad-col-x">';
						            echo $this->Form->control('end_date', ['type' => 'text', 'id'=>'to', 'readonly' => 'readonly']);
									echo '</div>';
									echo '<div class="medium-3 columns pad-col-x">';
						            echo $this->Form->control('resumption_date', ['type' => 'text', 'id'=>'r-date', 'readonly' => 'readonly']);
									echo '</div>';
									echo '<div class="medium-3 columns pad-col-x">';
						            echo $this->Form->control('number_of_days_requested', ['label'=>'Number of days', 'id'=>'num-days', 'readonly' => 'readonly']);
									echo '</div>';
									echo '<div class="medium-12 columns pad-col-x">';
						            echo $this->Form->control('comments');
									echo '</div>';
									echo '<div class="medium-12 columns pad-col-x">';
									echo '<legend><h5>'.__('Leave Contact Details').'</h5></legend>';
									echo '</div>';
									echo '<div class="medium-6 columns pad-col-x">';
						            echo $this->Form->control('Tel');
									echo '</div>';
									echo '<div class="medium-6 columns pad-col-x">';
						            echo $this->Form->control('email');
									echo '</div>';
									echo '<div class="medium-12 columns pad-col-x">';
						            echo $this->Form->control('address');
									echo '</div>';
									echo '<div class="medium-4 columns pad-col-x">';
						            echo $this->Form->control('relieved_by', ['options'=>$relieve_staff, 'empty'=>true]);
									echo '</div>';
						            echo $this->Form->hidden('status', ['value' => 1]);
						            echo $this->Form->hidden('user_id', ['value' => $activeUser['id']]);
						            echo $this->Form->hidden('department_id', ['value' => $department_member->department_id]);
						        ?>
							    </fieldset>
								<div class="medium-12 columns pad-col-x">
							    <?= $this->Form->button(__('Submit'), ['class'=>'button']) ?>
								</div>
							    <?= $this->Form->end() ?>
							</div>
							<?php
								}else{
									echo '<div class="callout secondary">You cannot edit this request</div>';
								}
							?>
						</div>
					</div>
				</div>
	        </section>
	    </div>

	    <aside class="column small-12 large-3 pad-aside">
	        <?php echo $this->element('dpt_aside'); ?>
	    </aside>
	</div>
</main>
<?php echo $this->element('footer'); ?>
<script>
	function addWeekdays(date, days) {
	    date.setDate(date.getDate());
	    var counter = 0;
	        if(days > 0 ){
	            while (counter < days) {
	                date.setDate(date.getDate() + 1 ); // Add a day to get the date tomorrow
	                var check = date.getDay(); // turns the date into a number (0 to 6)
	                    if (check == 0 || check == 6) {
	                        // Do nothing it's the weekend (0=Sun & 6=Sat)
	                    }
	                    else{
	                        counter++;  // It's a weekday so increase the counter
	                    }
	            }
	        }
	    return date;
	}
	
	$(function() {
	    var MS_PER_DAY = 24 * 60 * 60 * 1000;
	    var HOLIDAYS = [<?php
							foreach($all_holidays as $holiday):
								$time = strtotime($holiday->holiday_date);
								echo 'new Date('.date('Y', $time).','.(date('m', $time) - 1).','.date('d', $time).').getTime(),';
							endforeach;
	    				?>];
					
	    $.datepicker.setDefaults({beforeShowDay: function(date) {
	        if ($.inArray(date.getTime(), HOLIDAYS) > -1) {
	            return [false, 'holiday'];
	        }
	        return $.datepicker.noWeekends(date);
	    }});
		
		 $('.days-remaining').html("Days remaining: " + <?php echo $leave_d->annual_leave_days; ?>);
		 var selected_value = $('#leave-type').val();
		 var max_days = '';
	
		 if(selected_value == 'Annual'){
			 max_days = <?php echo $leave_d->annual_leave_days; ?>;
			 $('.days-remaining').html("Days remaining: " + <?php echo $leave_d->annual_leave_days; ?>);
		 }

		 if(selected_value == 'Study'){
			 max_days = <?php echo $leave_d->study_leave_days; ?>;
			 $('.days-remaining').html("Days remaining: " + <?php echo $leave_d->study_leave_days; ?>);
		 }

		 if(selected_value == 'Sick'){
			 max_days = 365;
			 $('.days-remaining').html('');
		 }
	 
		 if(selected_value == 'Maternity'){
			 max_days = <?php echo $leave_d->maternity_leave_days; ?>;
			 $('.days-remaining').html("Days remaining: " + <?php echo $leave_d->maternity_leave_days; ?>);
		 }
	 
		 if(selected_value == 'Paternity'){
			 max_days = <?php echo $leave_d->paternity_leave_days; ?>;
			 $('.days-remaining').html("Days remaining: " + <?php echo $leave_d->paternity_leave_days; ?>);
		 }

		 $('#leave-type').on('change', function() {
			 var selected_value = $(this).val();
 
			 if(selected_value == 'Annual'){
				 max_days = <?php echo $leave_d->annual_leave_days; ?>;
				 $('.days-remaining').html("Days remaining: " + <?php echo $leave_d->annual_leave_days; ?>);
			 }

			 if(selected_value == 'Study'){
				 max_days = <?php echo $leave_d->study_leave_days; ?>;
				 $('.days-remaining').html("Days remaining: " + <?php echo $leave_d->study_leave_days; ?>);
			 }
 
			 if(selected_value == 'Sick'){
				 max_days = 365;
				 $('.days-remaining').html('');
			 }
		 
			 if(selected_value == 'Maternity'){
				 max_days = <?php echo $leave_d->maternity_leave_days; ?>;
				 $('.days-remaining').html("Days remaining: " + <?php echo $leave_d->maternity_leave_days; ?>);
			 }
		 
			 if(selected_value == 'Paternity'){
				 max_days = <?php echo $leave_d->paternity_leave_days; ?>;
				 $('.days-remaining').html("Days remaining: " + <?php echo $leave_d->paternity_leave_days; ?>);
			 }
		 });
		
 	    $('#from').datepicker({
 			dateFormat: "yy-mm-dd",
 			onSelect: function(dateStr) {
 	        	$('#to').datepicker('option', {minDate: $(this).datepicker('getDate')});
 	    	}
 		});
		
 	    $('#to').datepicker({
 			dateFormat: "yy-mm-dd",
			beforeShow: function(dateStr){
				var toDate = $('#from').datepicker('getDate');
				var mDate = addWeekdays(toDate, max_days);
				$('#to').datepicker('option', {maxDate: mDate});
			},
 			onSelect: function(dateStr) {
 		        $('#from').datepicker('option', {maxDate: $(this).datepicker('getDate')});
			
 		        var d1 = $('#from').datepicker('getDate');
 		        var d2 = $('#to').datepicker('getDate');
 		        var diff = Math.floor((d2 - d1) / MS_PER_DAY);
 		        var work = diff;
 		        var d = d1;
 		        while (d <= d2) {
 		            if ((d.getDay() || 7) > 5) { // Sat/Sun
 		                work--;
 		            }
 		            else if ($.inArray(d.getTime(), HOLIDAYS) > -1) {
 		                work--;
 		            }
 		            d.setDate(d.getDate() + 1);
 		        }
				
				var rsDate = $('#to').datepicker('getDate');
				var rDate = addWeekdays(rsDate, 1);
			
 				$('#num-days').val(work);
 				$('#r-date').val(rDate.getFullYear() + '-' + (rDate.getMonth() + 1) + '-' + (rDate.getDate()));
 		        // alert('Total days diff: ' + diff + '\n' +
 	// 	              'Working days diff: ' + work);
 	    }});
		
	    $('button').click(function() {
	        
	    });
	});
</script>