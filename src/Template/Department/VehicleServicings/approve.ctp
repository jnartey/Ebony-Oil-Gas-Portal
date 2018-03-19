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
$this->assign('title', 'Request Vehicle Servicing');
echo $this->element('department/head');
?>
<main id="mains" class="large-12 columns main-content">
	<div class="row">
	    <div class="column small-12 large-9">
	        <section class="large-12 columns event-section">
	            <div class="large-12 columns event-heading">
	                <h1 class="column medium-6">Request Vehicle Servicing</h1>
		            <div class="column medium-6 text-right">
						<?php
							echo $this->Html->link(__('Cancel'), ['controller' => 'VehicleServicings', 'action' => 'index'], ['class'=>'button', 'escape'=>false]);
						?>
					</div>
	            </div>
				<div class="large-12 columns event-content">
					<nav aria-label="You are here:" role="navigation">
					  <ul class="breadcrumbs">
					    <li><?= $this->Html->link(__('Vehicle Servicing Request'), ['controller' => 'VehicleServicings', 'action' => 'index'], ['escape'=>false]); ?></li>
					    <li><?= __($leaveRequest->vehicle->model.' | '.$leaveRequest->vehicle->registeration_number); ?></li>
					  </ul>
					</nav>
					<div class="large-12 columns">
						<div class="large-12 columns portal-sp">
							
							<div class="tasks form large-9 medium-8 columns content">
							    <?php
									echo '<div class="medium-6 columns pad-col-x">';
						            echo '<strong>Requested By</strong> <span class="label secondary">'.$leaveRequest->user->name.'</span>';
									echo '<br />';
									echo '</div>';
									echo '<div class="medium-4 columns pad-col-x">';
						            echo '<strong>Date:</strong> <span class="label secondary">'.date("d/m/Y", strtotime($leaveRequest->created)).'</span>';
									echo '<br />';
									echo '</div>';
									echo '<div class="medium-6 columns pad-col-x">';
						            echo '<strong>Car Model:</strong> <span class="label secondary">'.$leaveRequest->vehicle->model.'</span>';
									echo '<br />';
									echo '</div>';
									echo '<div class="medium-4 columns pad-col-x">';
						            echo '<strong>Car Reg. No.:</strong> <span class="label secondary">'.$leaveRequest->vehicle->registeration_number.'</span>';
									echo '<br />';
									echo '</div>';
									echo '<div class="medium-4 columns pad-col-x">';
						            echo '<strong>Mileage:</strong> <span class="label secondary">'.$leaveRequest->mileage.'</span>';
									echo '<br />';
									echo '</div>';
									echo '<div class="medium-4 columns pad-col-x">';
						            echo '<strong>Service Date:</strong> <span class="label secondary">'.$leaveRequest->service_date.'</span>';
									echo '<br />';
									echo '</div>';
									echo '<div class="medium-4 columns pad-col-x">';
						            echo '<strong>Next Service Date:</strong> <span class="label secondary">'.$leaveRequest->next_service_date.'</span>';
									echo '<br />';
									echo '</div>';
									echo '<div class="medium-12 columns pad-col-x">';
						            echo '<strong>General Servicing: </strong>';
									if($leaveRequest->general_servicing == 1){
										echo '<span class="label secondary">Yes</span>';
									}else{
										echo '<span class="label secondary">No</span>';
									}
									echo '<br />';
									echo '</div>';
									if(!empty($leaveRequest->other)){
										echo '<div class="medium-12 columns pad-col-x">';
										echo '<strong>Other:</strong><br />';
										echo '<div class="callout">'.$leaveRequest->other.'</div>';
										echo '</div>';
									}
							    ?>
							</div>
						
							<div class="columns medium-12">
								<?php
									if(isset($approve->name)){
										echo '<strong>Approved by:</strong> <span class="label secondary">'.$approve->name.'</span>';
										echo '<br />';
										echo '<strong>Paid by:</strong> <span class="label secondary">'.$approve->name.'</span>';
										echo '<br />';
									}
								?>
							</div>
							<div class="tasks form large-9 medium-8 columns content float-left">
							    <?= $this->Form->create($leaveRequest) ?>
							    <fieldset>
							        <?php
										echo '<div class="medium-12 columns pad-col-x">';
										echo '<div class="medium-6 columns float-left pad-col-x">';
										echo $this->Form->control('service_date', ['type' => 'text', 'id'=>'service-date']);
										echo '</div><div class="medium-6 columns float-left pad-col-x">';
										echo $this->Form->control('next_service_date', ['type' => 'text', 'id'=>'next-service-date']);
										echo '</div>';
							            echo $this->Form->hidden('approved_by', ['value' => $activeUser['id']]);
										echo $this->Form->hidden('approval_date', ['value' => date('Y-m-d H:i:s')]);
										echo '<div class="medium-4 columns float-left pad-col-x">';
							            $options = array(4 => 'Approve', 5 => 'Decline');
							            echo $this->Form->control('status', ['options'=>$options]);
										echo '</div>';
										echo '</div>';
							        ?>
							    </fieldset>
								<div class="medium-12 columns text-right pad-col-x">
							    <?= $this->Form->button(__('Approve'), ['class'=>'button']) ?>
								</div>
							    <?= $this->Form->end() ?>
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
 	    $('#service-date').datepicker({
 			dateFormat: "yy-mm-dd",
 			onSelect: function(dateStr) {
 	        	$('#next-service-date').datepicker('option', {minDate: $(this).datepicker('getDate')});
 	    	}
 		});
		
 	    $('#next-service-date').datepicker({
 			dateFormat: "yy-mm-dd",
			beforeShow: function(dateStr){
				var toDate = $('#service-date').datepicker('getDate');
			},
 			onSelect: function(dateStr) {
 		        $('#service-date').datepicker('option', {maxDate: $(this).datepicker('getDate')});
 	    }});
	});
</script>
