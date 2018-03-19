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
	                <h1 class="column medium-6">Working Outside Work Schedules Request</h1>
		            <div class="column medium-6 text-right">
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
							<?php
								if(!$check_request){
							?>
							<div class="tasks form large-12 medium-12 columns content">
							    <?= $this->Form->create($workOutsideSchedule) ?>
							    <fieldset>
							        <?php
										echo '<div class="medium-12 columns pad-col-x">';
										echo '<legend><h5>'.__('Employee Details').'</h5></legend>';
										echo '</div>';
										echo '<div class="medium-4 columns pad-col-x">';
										$options = array('Head Office, One Airport Square'=>'Head Office, One Airport Square', 'TOR'=>'TOR', 'TTF'=>'TTF', 'Kumasi'=>'Kumasi', 'Buipe'=>'Buipe');
							            echo $this->Form->control('location',['options'=>$options, 'id'=>'location']);
										echo '</div>';
										echo '<div class="medium-12 columns pad-col-x">';
										echo '<legend><h5>'.__('Period').'</h5></legend>';
										echo '</div>';
										echo '<div class="medium-4 columns pad-col-x">';
							            echo $this->Form->control('start_date', ['type' => 'text', 'label'=>'From', 'readonly']);
										echo '</div>';
										echo '<div class="medium-4 columns pad-col-x">';
							            echo $this->Form->control('end_date', ['type' => 'text', 'label'=>'To', 'readonly']);
										echo '</div>';
										echo '<div class="medium-4 columns pad-col-x">';
							            echo $this->Form->control('number_of_days', ['type' => 'text', 'readonly']);
										echo '</div>';
										echo '<div class="medium-12 columns pad-col-x">';
										echo '<div class="medium-12 columns">';
							            echo '<legend><h5 class="stand-sel"><span>'.$this->Form->radio('stand_option', ['2'=>''], ['label'=>false, 'default'=>true, 'value'=>2]).'</span><span><label for="stand-option-2">'.__('Stand-In').'</label></span></h5></legend>';
										echo '<p>(An arrangement with an employee who is made responsible for all department/unit related issues on week-ends and holidays until the normal shift begins. He/She is required to be physically present at the duty )</p>';
										echo '<p>Rate:<strong> GHS 150</strong></p>';
										echo '</div>';
										echo '</div>';
										echo '<div class="medium-12 columns pad-col-x">';
										echo '<div class="medium-12 columns">';
										echo '<div class="medium-12 columns">';
										echo '<div id="stand-in-cal"></div>';
										echo '<br />';
										echo '</div>';
										echo '<div class="medium-6 columns float-left">';
										echo $this->Form->control('stand_in', ['type' => 'text', 'readonly']);
										echo '</div>';
										echo '</div>';
										echo '</div>';
										echo '<div class="medium-4 columns pad-col-x">';
										echo '<span class="columns"><strong>GHS: </strong></span><span class="columns">'.$this->Form->control('total', ['type' => 'text', 'readonly', 'label'=>false]).'</span>';
										echo '</div>';
										echo '<div class="medium-12 columns pad-col-x">';
							            echo '<legend><h5>'.__('Justification').'</h5></legend>';
										echo '</div>';
										echo '<div class="medium-12 columns">';
										echo $this->Form->control('justification', ['label' => false]);
										echo '</div>';
							            echo $this->Form->hidden('status', ['value' => 2]);
										echo $this->Form->hidden('request_type', ['value' => 2]);
							            echo $this->Form->hidden('user_id', ['value' => $activeUser['id']]);
							            echo $this->Form->hidden('department_id', ['value' => $get_user->department_access]);
							        ?>
							    </fieldset>
							    <?= $this->Form->button(__('Submit'), ['class'=>'button']) ?>
							    <?= $this->Form->end() ?>
							</div>
							<?php
								}else{
									echo '<div class="callout secondary">You cannot make a request at this time because you have a pending request which needs to be attended to or cancelled by you.</div>';
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
				$('#total').val(temp.length * 150);
	    	}
		});
	
		$('#stand-in-cal').multiDatesPicker({
			numberOfMonths: [1,3],
			onSelect: function(dateStr) {
				var standinDates = $(this).multiDatesPicker('getDates');
				$('#stand-in').val(standinDates.toString());
	        	//var selected_dates = standbyDates;
				var temp = new Array();
				temp = standinDates.toString().split(',');
				$('#start-date').val(temp[0]);
				$('#end-date').val(temp[temp.length-1]);
				$('#number-of-days').val(temp.length);
				$('#total').val(temp.length * 150);
	    	}
		});
		//$('#stand-in').prop('readonly', true);
		$('#stand-in-cal').prop('disabled', false).datepicker("option", "disabled", false);
	
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
		  $('#total').val("");
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
		  $('#total').val("");
		});
	});
</script>
