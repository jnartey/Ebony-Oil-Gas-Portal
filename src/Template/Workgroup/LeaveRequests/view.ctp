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
						echo $this->Html->link(__('Back'), ['controller' => 'LeaveRequests', 'action' => 'index'], ['class'=>'button', 'escape'=>false]);
						
						if($leaveRequest->status != 2 && $leaveRequest->status != 3 && $leaveRequest->status != 4 && $leaveRequest->status != 5){
							if($leaveRequest->user_id == $activeUser['id']){
								echo $this->Html->link(__('Edit'), ['controller' => 'LeaveRequests', 'action' => 'edit', $leaveRequest->id], ['class'=>'button']);
								echo $this->Form->postLink(__('Delete'), ['controller' => 'LeaveRequests', 'action' => 'delete', $leaveRequest->id], ['confirm' => __('Are you sure you want to delete # {0}?', $leaveRequest->request_type), 'class'=>'button alert']);
							} 
						}
						
						if($activeUser['role_id'] == 1 || $department_details->department_role == 2){
							echo $this->Html->link(__('Recommend'), ['controller' => 'LeaveRequests', 'action' => 'recommend', $leaveRequest->id], ['class'=>'button']);
						}
						
						if($department_member->department_role == 3 && $department_details->department->department_type != 3){
							echo $this->Html->link(__('Approve'), ['controller' => 'LeaveRequests', 'action' => 'review', $data->id], ['class'=>'button small']);
						}elseif($department_details->department->department_type == 3 && $department_member->department_role == 3){
							echo $this->Html->link(__('Approve'), ['controller' => 'LeaveRequests', 'action' => 'approve', $data->id], ['class'=>'button small']);
						}
						
						if($leaveRequest->status == 6){
							if($leaveRequest->user_id == $activeUser['id']){
								echo $this->Form->postLink(__('Re-activate'), ['controller' => 'LeaveRequests', 'action' => 'set_status', $leaveRequest->id, 1], ['confirm' => __('Are you sure you want to Re-activate {0}?', $leaveRequest->request_type), 'class'=>'button secondary']);
							}
						}elseif($leaveRequest->status == 1){
							if($leaveRequest->user_id == $activeUser['id']){
								echo $this->Form->postLink(__('Cancel'), ['controller' => 'LeaveRequests', 'action' => 'set_status', $leaveRequest->id, 6], ['confirm' => __('Are you sure you want to cancel {0}?', $leaveRequest->request_type), 'class'=>'button secondary']);
							}
						}
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
						Leave type: <span class="label secondary"><?= $leaveRequest->leave_type ?></span>
						&nbsp;&nbsp;
						Start date: <span class="label secondary"><?= $leaveRequest->start_date ?></span>
						&nbsp;&nbsp;
						End date: <span class="label secondary"><?= $leaveRequest->end_date ?></span>
						<br />
						Resumption date: <span class="label secondary"><?= $leaveRequest->resumption_date ?></span>
						&nbsp;&nbsp;
						Number of days requested: <span class="label secondary"><?= $leaveRequest->number_of_days_requested ?></span>
						<br /><br />
						<?php
							if($recommended->name){
								echo 'Recommended by supervisor: <span class="label secondary">'.$recommended->name.'</span>';
								echo '<br />';
							}
							
							if($approve->name){
								echo 'Approved by management staff (Department Head): <span class="label secondary">'.$approve->name.'</span>';
								echo '<br />';
							}
							
							if($relief->name){
								echo 'Relieved by: <span class="label secondary">'.$relief->name.'</span>';
								echo '<br />';
							}
							
							if($administration->name){
								echo 'Approved by HR manager: <span class="label secondary">'.$administration->name.'</span>';
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
						        <?php
									
									echo '<h5>'.__('Leave Statistics').'</h5>';
									if($leaveRequest->leave_entitlement){
										echo 'Leave entitlement prior to this leave being taken: <span class="label secondary">'.$leaveRequest->leave_entitlement.'</span>';
										echo '&nbsp;&nbsp;';
									}
									
									if($leaveRequest->leave_taken){
										echo 'Leave taken now: <span class="label secondary">'.$leaveRequest->leave_taken.'</span>';
										echo '&nbsp;&nbsp;';
									}
									
									if($leaveRequest->leave_days_remaining){
										echo '<br />';
										echo 'Leave days remaining: <span class="label secondary">'.$leaveRequest->leave_days_remaining.'</span>';
										echo '&nbsp;&nbsp;';
									}
									
									echo '<h5>'.__('Leave Benefits').'</h5>';
									if($leaveRequest->leave_travel_allowance){
										echo 'Leave travel allowance GHS: <span class="label secondary">'.$leaveRequest->leave_travel_allowance.'</span>';
										echo '&nbsp;&nbsp;';
									}
									
									if($leaveRequest->meal_allowance){
										echo 'Meal allowance GHS: <span class="label secondary">'.$leaveRequest->meal_allowance.'</span>';
										echo '&nbsp;&nbsp;';
									}
									
									if($leaveRequest->leave_holidays){
										echo 'Holidays in leave period (Senior staff only): <span class="label secondary">'.$leaveRequest->leave_holidays.'</span>';
										echo '&nbsp;&nbsp;';
									}
						        ?>
						</div>
					</div>
				</div>
			</div>
        </section>
    </div>

    <aside class="column small-12 large-3 pad-aside">
        <?php echo $this->element('aside'); ?>
    </aside>
</main>
<?php echo $this->element('footer'); ?>
