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
$this->assign('title', 'Leave Request');
echo $this->element('head');
?>
<main id="mains" class="row events-main">
    <div class="column small-12 large-9">
        <section class="large-12 columns event-section">
            <div class="large-12 columns event-heading">
                <h1 class="column medium-4">Leave Request</h1>
	            <div class="column medium-8 text-right">
					<?php
						echo $this->Html->link(__('Cancel'), ['controller' => 'LeaveRequests', 'action' => 'index'], ['class'=>'button', 'escape'=>false]);
					?>
				</div>
            </div>
			<div class="large-12 columns event-content">
				<nav aria-label="You are here:" role="navigation">
				  <ul class="breadcrumbs">
				    <li><?= $this->Html->link(__('Leave Request'), ['controller' => 'LeaveRequests', 'action' => 'index'], ['escape'=>false]); ?></li>
				    <li><?= __($leaveRequest->request_type); ?></li>
				  </ul>
				</nav>
				<?php if($department_details->department->department_type == 3) { ?>
				<div class="large-12 columns">
					<div class="large-12 columns portal-sp">
						<div class="large-12 columns">
						Request Status: 
						<?php
							if($leaveRequest->status == 1){
								echo '<span class="label secondary">Pending</span>';
							}elseif($leaveRequest->status == 2){
								echo '<span class="label success">Recommended</span>';
								echo '&nbsp;'.$leaveRequest->recommended_date;
							}elseif($leaveRequest->status == 3){
								echo '<span class="label secondary">Approved by management staff</span>';
								echo '&nbsp;'.$leaveRequest->approved_date;
							}elseif($leaveRequest->status == 4){
								echo '<span class="label secondary">Approved</span>';
								echo '&nbsp;'.$leaveRequest->approved_m_date;
							}elseif($leaveRequest->status == 5){
								echo '<span class="label secondary">Declined</span>';
							}elseif($leaveRequest->status == 6){
								echo '<span class="label secondary">Cancelled</span>';
							}
						?>
						<br /><br />
						Request type: <span class="label secondary"><?= $leaveRequest->leave_type ?></span>
						&nbsp;&nbsp;
						Request type: <span class="label secondary"><?= $leaveRequest->start_date ?></span>
						&nbsp;&nbsp;
						Request type: <span class="label secondary"><?= $leaveRequest->end_date ?></span>
						<br />
						Request type: <span class="label secondary"><?= $leaveRequest->resumption_date ?></span>
						&nbsp;&nbsp;
						Number of working days: <span class="label secondary"><?= $leaveRequest->number_of_days_requested ?></span>
						<br /><br />
						<?php
							if($recommended->name){
								echo 'Recommended by supervisor: <span class="label secondary">'.$recommended->name.'</span>';
								echo '&nbsp;&nbsp;';
							}
							
							if($approve->name){
								echo 'Approved by management staff (Department Head): <span class="label secondary">'.$approve->name.'</span>';
								echo '&nbsp;&nbsp;';
							}
							
							if($relief->name){
								echo 'Relieved by: <span class="label secondary">'.$relief->name.'</span>';
							}
						?>
						<?php
							if($leaveRequest->comments){
								echo '<br /><br />';
								echo 'Comments: <div class="callout secondary">'.$leaveRequest->comments.'</div>';
							}
							
							echo '<h5>'.__('Leave Contact Details').'</h5>';
							if($leaveRequest->tel){
								echo 'Tel: <span class="callout secondary">'.$leaveRequest->tel.'</span>';
								echo '&nbsp;&nbsp;';
							}
							
							if($leaveRequest->email){
								echo 'Email: <div class="callout secondary">'.$leaveRequest->email.'</div>';
							}
							
						?>
						</div>
						<div class="tasks form large-9 medium-8 columns content float-left">
						    <?= $this->Form->create($leaveRequest) ?>
						    <fieldset>
						        <?php
									echo '<div class="medium-4 columns pad-col-x">';
						            $options = array(4 => 'Approve', 5 => 'Decline');
						            echo $this->Form->control('status', ['options'=>$options]);
									echo '</div>';
									echo '<div class="medium-12 columns pad-col-x">';
									echo '<h5>'.__('Leave Statistics').'</h5>';
									echo '</div>';
									echo '<div class="medium-6 columns pad-col-x">';
						            echo $this->Form->control('leave_entitlement', ['label' => 'Leave entitlement prior to this leave being taken']);
									echo '</div>';
									echo '<div class="medium-6 columns pad-col-x">';
						            echo $this->Form->control('leave_taken', ['label' => 'Leave taken now']);
									echo '</div>';
									echo '<div class="medium-4 columns pad-col-x">';
						            echo $this->Form->control('leave_days_remaining', ['label' => 'Leave days remaining']);
									echo '</div>';
									echo '<div class="medium-12 columns pad-col-x">';
									echo '<h5>'.__('Leave Benefits').'</h5>';
									echo '</div>';
									echo '<div class="medium-6 columns pad-col-x">';
						            echo $this->Form->control('leave_travel_allowance', ['label' => 'Leave travel allowance GHS']);
									echo '</div>';
									echo '<div class="medium-6 columns pad-col-x">';
						            echo $this->Form->control('meal_allowance', ['label' => 'Meal allowance']);
									echo '</div>';
									echo '<div class="medium-6 columns pad-col-x">';
						            echo $this->Form->control('leave_holidays', ['label' => 'Holidays in leave period (Senior staff only)']);
									echo '</div>';
									echo '<div class="medium-12 columns pad-col-x">';
						            echo $this->Form->hidden('approved_by_management', ['value' => $activeUser['id']]);
									echo $this->Form->hidden('approved_m_date', ['value' => date('Y-m-d H:i:s')]);
									echo '</div>';
						        ?>
						    </fieldset>
							<br />
						    <?= $this->Form->button(__('Approve'), ['class'=>'button']) ?>
						    <?= $this->Form->end() ?>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
        </section>
    </div>

    <aside class="column small-12 large-3 pad-aside">
        <?php echo $this->element('aside'); ?>
    </aside>
</main>
<?php echo $this->element('footer'); ?>
