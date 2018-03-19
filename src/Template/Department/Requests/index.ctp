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
use Cake\Chronos\Chronos;
use Cake\I18n\Time;

$this->layout = 'default';
$this->assign('title', 'Requests');
echo $this->element('department/head');
?>
<main id="mains" class="large-12 columns main-content">
	<div class="row">
	    <div class="column small-12 large-9">
	        <section class="large-12 columns event-section">
				<?php echo $this->element('department/request_head'); ?>
	            <div class="medium-12 columns event-heading">
	                <h1 class="column medium-4">Requests</h1>
		            <div class="column medium-8 text-right">
						<?php
							if(!$check_request){
								echo $this->Html->link(__('Request Leave'), ['controller' => 'Requests', 'action' => 'add'], ['class'=>'button', 'escape'=>false]);
							}
						?>
					</div>
	            </div>
				<div class="large-12 columns event-content">
					<div class="large-12 columns">
						<div class="large-12 columns portal-sp space-button">
					        <table id="general-table" class="display" width="100%" cellpadding="0" cellspacing="0">
								<thead>
						            <tr>
						                <th><?= __('#') ?></th>
						                <th><?= __('Leave') ?></th>
										<th><?= __('Start Date') ?></th>
										<th><?= __('End Date') ?></th>
										<th><?= __('Resume Date') ?></th>
										<th><?= __('No. of days') ?></th>
										<th><?= __('Status') ?></th>
										<th><?= __('Req. Date') ?></th>
						                <th class="actions"><?= __('Actions') ?></th>
						            </tr>
								</thead>
								<tbody>
						            <?php 
										$i=1;
										foreach ($leaveRequests as $data): 
									?>
						            <tr>
						                <td><?= h($i) ?></td>
						                <td><?= $this->Html->link($data->leave_type, ['controller' => 'Requests', 'action' => 'view', $data->id]); ?></td>
										<td><?php
											echo '<span class="label secondary">'.date("d/m/Y", strtotime($data->start_date)).'</span>';
										?></td>
										<td><?php
											echo '<span class="label secondary">'.date("d/m/Y", strtotime($data->end_date)).'</span>';
										?></td>
										<td><?php
											if($data->resumption_date){
												echo '<span class="label secondary">'.date("d/m/Y", strtotime($data->resumption_date)).'</span>';
											}
										?></td>
										<td><?= $data->number_of_days_requested; ?></td>
										<td>
											<?php
												if($data->status == 1){
													echo '<span class="label secondary">Pending</span>';
												}elseif($data->status == 2){
													echo '<span class="label secondary">Recommended</span>';
													echo '<br /><span class="date-sp">'.$data->recommended_date.'</span>';
												}elseif($data->status == 3){
													echo '<span class="label secondary">Approved</span>';
													//echo '<br /><span class="date-sp">'.$data->approved_date.'</span>';
												}elseif($data->status == 4){
													echo '<span class="label success">Approved</span>';
													echo '<br /><span class="date-sp">'.$data->approved_m_date.'</span>';
												}elseif($data->status == 5){
													echo '<span class="label alert">Declined</span>';
												}elseif($data->status == 6){
													echo '<span class="label secondary">Cancelled</span>';
												}
											?>
										</td>
										<td><?= '<span class="label secondary">'.$data->created.'</span>'; ?></td>
						                <td class="actions">
						                    <?php 
											
												if($data->user_id == $activeUser['id']){
													echo $this->Html->link(__('View'), ['controller' => 'Requests', 'action' => 'view', $data->id], ['class'=>'button small']);
												}
											
												if($data->status != 2 && $data->status != 3 && $data->status != 4 && $data->status != 5){
													if($data->user_id == $activeUser['id']){
														echo $this->Html->link(__('Edit'), ['controller' => 'Requests', 'action' => 'edit', $data->id], ['class'=>'button small']);
														echo $this->Form->postLink(__('Delete'), ['controller' => 'Requests', 'action' => 'delete', $data->id], ['confirm' => __('Are you sure you want to delete # {0}?', $data->leave_type), 'class'=>'button small alert']);
													} 
												}
												
												if($user_details_chk->department_role == 3){
													echo $this->Html->link(__('Edit'), ['controller' => 'Requests', 'action' => 'edit', $data->id], ['class'=>'button small']);
													echo $this->Form->postLink(__('Delete'), ['controller' => 'Requests', 'action' => 'delete', $data->id], ['confirm' => __('Are you sure you want to delete # {0}?', $data->leave_type), 'class'=>'button small alert']);
												}
												
													
												if($activeUser['role_id'] == 1 && $user_details_chk->department_role == 3){ 
													echo $this->Html->link(__('Approve'), ['controller' => 'Requests', 'action' => 'approve', $data->id], ['class'=>'button small']);
												}else{
													if(!empty($department_details_ch)){
														foreach($department_details as $check):
															if($check->department_id == $data->department_id){
																if($check->department_role == 2){
																	if($current_department->department_id == $check->department_id){
																		if($data->status == 3){
																			echo $this->Html->link(__('Recommended'), ['controller' => 'Requests', 'action' => 'recommend', $data->id], ['class'=>'button small success']);
																		}else{
																			echo $this->Html->link(__('Recommend'), ['controller' => 'Requests', 'action' => 'recommend', $data->id], ['class'=>'button small']);
																		}
																		
																	}
																	
																}elseif($check->department_role == 3){
																	if(!empty($check_request_admin)){
																		if($check_request_admin->department_id != $check->department_id){
																			if($current_department->department_id == $check->department_id){
																				if($data->status == 3){
																					echo $this->Html->link(__('Approved'), ['controller' => 'Requests', 'action' => 'review', $data->id], ['class'=>'button small success']);
																				}else{
																					echo $this->Html->link(__('Approve'), ['controller' => 'Requests', 'action' => 'review', $data->id], ['class'=>'button small']);
																				}
																		
																			}
																		}
																	}
																}elseif($check->department_role == 3){
																	if($data->status == 4){
																		echo $this->Html->link(__('Approve'), ['controller' => 'Requests', 'action' => 'approve', $data->id], ['class'=>'button small success']);
																	}else{
																		echo $this->Html->link(__('Approve'), ['controller' => 'Requests', 'action' => 'approve', $data->id], ['class'=>'button small']);
																	}
																}
															}elseif($check->department_role == 2){
																if(!empty($check_request_admin)){
																	if($check_request_admin->department_id == $check->department_id){
																		if($current_department->department_id == $check->department_id){
																			if($data->status == 4){
																				echo $this->Html->link(__('Approve'), ['controller' => 'Requests', 'action' => 'approve', $data->id], ['class'=>'button small success']);
																			}else{
																				echo $this->Html->link(__('Approve'), ['controller' => 'Requests', 'action' => 'approve', $data->id], ['class'=>'button small']);
																			}
																	
																		}
																	}
																}
																
															}elseif($check->department_role == 3){
																if(!empty($check_request_admin)){
																	if($check_request_admin->department_id == $check->department_id){
																		if($current_department->department_id == $check->department_id){
																			if($data->status == 4){
																				echo $this->Html->link(__('Approved'), ['controller' => 'Requests', 'action' => 'approve', $data->id], ['class'=>'button small success']);
																			}else{
																				echo $this->Html->link(__('Approve'), ['controller' => 'Requests', 'action' => 'approve', $data->id], ['class'=>'button small']);
																			}
																	
																		}
																	}
																}
															}
														
														endforeach;
													}
												}
											
												if($data->status == 6){
													if($data->user_id == $activeUser['id']){
														echo $this->Form->postLink(__('Re-activate'), ['controller' => 'Requests', 'action' => 'set_status', $data->id, 1], ['confirm' => __('Are you sure you want to Re-activate {0}?', $data->request_type), 'class'=>'button small secondary']);
													}
												}elseif($data->status == 1){
													if($data->user_id == $activeUser['id']){
														echo $this->Form->postLink(__('Cancel'), ['controller' => 'Requests', 'action' => 'set_status', $data->id, 6], ['confirm' => __('Are you sure you want to cancel {0}?', $data->request_type), 'class'=>'button small secondary']);
													}
												}
											?>
						                </td>
						            </tr>
						            <?php 
										$i++;
										endforeach; 
									?>
								</tbody>
					        </table>
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