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

if($workOutsideSchedule->stand_by){
	$standby_string = "'" . str_replace(",", "','", $workOutsideSchedule->stand_by) . "'";
}else{
	$standby_string = null;
}

if($workOutsideSchedule->stand_in){
	$standin_string = "'" . str_replace(",", "','", $workOutsideSchedule->stand_in) . "'";
}else{
	$standin_string = null;
}
?>
<main id="mains" class="large-12 columns main-content">
	<div class="row">
	    <div class="column small-12 large-9">
	        <section class="large-12 columns event-section">
	            <div class="large-12 columns event-heading">
	                <h1 class="column medium-8">Working Outside Work Schedules Request</h1>
		            <div class="column medium-4 text-right">
						<?php
							echo $this->Html->link(__('Cancel'), ['controller' => 'WorkOutsideSchedules', 'action' => 'index'], ['class'=>'button', 'escape'=>false]);
						?>
					</div>
	            </div>
				<div class="large-12 columns event-content">
					<nav aria-label="You are here:" role="navigation">
					  <ul class="breadcrumbs">
					    <li><?= $this->Html->link(__('Working Outside Work Schedule'), ['controller' => 'WorkOutsideSchedules', 'action' => 'index'], ['escape'=>false]); ?></li>
					    <li><?= __("Working Outside Work Schedule"); ?></li>
					  </ul>
					</nav>
					<div class="large-12 columns">
						<div class="large-12 columns portal-sp">
							<div class="tasks form large-12 medium-12 columns content">
							    <div class="columns large-12">
							        <?php
										echo '<div class="medium-12 columns pad-col-x">';
										echo '<legend><h5>'.__('Employee Details').'</h5></legend>';
										echo '</div>';
										echo '<div class="medium-4 columns pad-col-x">';
							            echo '<strong>Full Name</strong> <span class="label secondary">'.$workOutsideSchedule->user->name.'</span>';
										echo '</div>';
										echo '<div class="medium-4 columns pad-col-x">';
							            echo '<strong>Employee ID:</strong> <span class="label secondary">'.$workOutsideSchedule->user->employee_id.'</span>';
										echo '</div>';
										echo '<div class="medium-4 columns pad-col-x">';
							            echo '<strong>Grade:</strong> <span class="label secondary">'.$workOutsideSchedule->user->grade.'</span>';
										echo '</div>';
										echo '<div class="medium-4 columns pad-col-x">';
							            echo '<strong>Department:</strong> <span class="label secondary">'.$department_details->department->name.'</span>';
										echo '</div>';
										echo '<div class="medium-4 columns pad-col-x">';
							            echo '<strong>Location:</strong> <span class="label secondary">'.$workOutsideSchedule->location.'</span>';
										echo '</div>';
										echo '<div class="medium-12 columns pad-col-x">';
										echo '<legend><h5>'.__('Period').'</h5></legend>';
										echo '</div>';
										echo '<div class="medium-4 columns pad-col-x">';
							            echo '<strong>From:</strong> <span class="label secondary">'.$workOutsideSchedule->start_date.'</span>';
										echo '</div>';
										echo '<div class="medium-4 columns pad-col-x">';
							            echo '<strong>To:</strong> <span class="label secondary">'.$workOutsideSchedule->end_date.'</span>';
										echo '</div>';
										echo '<div class="medium-4 columns pad-col-x">';
							            echo '<strong>Number of days:</strong> <span class="label secondary">'.$workOutsideSchedule->number_of_days.'</span>';
										echo '</div>';
										echo '<div class="medium-6 columns pad-col-x">';
										echo '<div class="medium-12 columns">';
										echo '<legend><h5>'.__('Stand By / On-Call').'</h5></legend>';
										echo '<p>(Prior arrangement made with an employee to be available to respond to company assignments outside normal scheduled work hours or notified to continue to be available/on duty after work for up to 12hrs max.)</p>';
										echo '<p>Rate:<strong> GHS 150</strong></p>';
										echo '</div>';
										echo '</div>';
										echo '<div class="medium-6 columns pad-col-x">';
										echo '<div class="medium-12 columns">';
										echo '<legend><h5>'.__('Stand-In').'</h5></legend>';
										echo '<p>(An arrangement with an employee who is made responsible for all department/unit related issues on week-ends and holidays until the normal shift begins. He/She is required to be physically present at the duty )</p>';
										echo '<p>Rate:<strong> GHS 150</strong></p>';
										echo '</div>';
										echo '</div>';
										echo '<div class="medium-6 columns pad-col-x">';
										echo '<div id="stand-by-cal"></div>';
										echo '</div>';
										echo '<div class="medium-6 columns pad-col-x">';
										echo '<div class="medium-12 columns">';
										echo '<div id="stand-in-cal"></div>';
										echo '</div>';
										echo '</div>';
										echo '<div class="medium-4 columns">';
										echo '<br /><strong>GHS: </strong><span class="label secondary">'.$workOutsideSchedule->total.'</span>';
										echo '</div>';
										echo '<div class="medium-12 columns pad-col-x">';
							            echo '<legend><h5>'.__('Justification').'</h5></legend>';
										echo '</div>';
										echo '<div class="medium-12 columns">';
										echo '<div class="callout">'.$workOutsideSchedule->justification.'</div>';
										echo '</div>';
							        ?>
							    </div>
								<div class="columns medium-8">
									<?php
										if(isset($recommended->name){
											echo 'Approved by department head or supervisor: <span class="label secondary">'.$recommended->name.'</span>';
											echo '<br />';
										}
									?>
								</div>
								<div class="columns medium-4">
									<?php
										if(isset($recommended->name)){
											echo 'Date: <span class="label secondary">'.$workOutsideSchedule->department_head_approval_date.'</span>';
											echo '<br />';
										}
									?>
								</div>
								<div class="columns medium-8">
									<?php
										if(isset($approve->name)){
											echo 'Approved by HR department: <span class="label secondary">'.$approve->name.'</span>';
											echo '<br />';
										}
									?>
								</div>
								<div class="columns medium-4">
									<?php
										if(isset($approve->name)){
											echo 'Date: <span class="label secondary">'.$workOutsideSchedule->approval_date.'</span>';
											echo '<br />';
										}
									?>
								</div>
							</div>
							
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
	$(function() {
		$('#stand-by-cal').multiDatesPicker({
			onSelect: function(dateStr) {
				var standbyDates = $(this).multiDatesPicker('getDates');
				$('#stand-by').val(standbyDates.toString());
	        	//var selected_dates = standbyDates;
				var temp = new Array();
				temp = standbyDates.toString().split(',');
				$('#start-date').val(temp[0]);
				$('#end-date').val(temp[temp.length-1]);
				$('#number-of-days').val(temp.length);
	    	},
			<?php if($workOutsideSchedule->stand_by){ ?>
				addDates: [<?= $standby_string ?>]
			<?php } ?>
		});
	
		$('#stand-in-cal').multiDatesPicker({
			onSelect: function(dateStr) {
				var standinDates = $(this).multiDatesPicker('getDates');
				$('#stand-in').val(standinDates.toString());
	        	//var selected_dates = standbyDates;
				var temp = new Array();
				temp = standinDates.toString().split(',');
				$('#start-date').val(temp[0]);
				$('#end-date').val(temp[temp.length-1]);
				$('#number-of-days').val(temp.length);
	    	},
			<?php if($workOutsideSchedule->stand_in){ ?>
				addDates: [<?= $standin_string ?>]
			<?php } ?>
		});
		//$('#stand-in').prop('readonly', true);
		<?php if($workOutsideSchedule->stand_by){ ?>
			$('#stand-in-cal').prop('disabled', true).datepicker("option", "disabled", true);
			//$('#stand-by-cal').multiDatesPicker('addDates', <?= $workOutsideSchedule->stand_by ?>);
		<?php }else{ ?>
			$('#stand-by-cal').prop('disabled', true).datepicker("option", "disabled", true);
			//$('#stand-in-cal').multiDatesPicker('addDates', <?= $workOutsideSchedule->stand_in ?>);
		<?php } ?>
	
		$('#stand-option-1').change(function() {
		  //$('#stand-in').prop('readonly', true);
		  //$('#stand-by').prop('readonly', false);
		  $('#stand-in-cal').prop('disabled', true).datepicker("option", "disabled", true);
		  $('#stand-by-cal').prop('disabled', false).datepicker("option", "disabled", false);
		  $('#stand-in-cal').multiDatesPicker('resetDates');
		  $('#start-date').val("");
		  $('#end-date').val("");
		  $('#number-of-days').val("");
		  $('#stand-in').val("");
		});
		
		$('#stand-option-2').change(function() {
	  	  //$('#stand-in').prop('readonly', false);
	  	  //$('#stand-by').prop('readonly', true);
		  $('#stand-by-cal').prop('disabled', true).datepicker("option", "disabled", true);
		  $('#stand-in-cal').prop('disabled', false).datepicker("option", "disabled", false);
		  $('#stand-by-cal').multiDatesPicker('resetDates');
		  $('#start-date').val("");
		  $('#end-date').val("");
		  $('#number-of-days').val("");
		  $('#stand-by').val("");
		});
	});
</script>
