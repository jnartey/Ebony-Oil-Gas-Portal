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
$this->assign('title', 'Projects');
echo $this->element('workgroup/head');
?>
<main id="mains" class="large-12 columns main-content">
	<div class="row">
	    <div class="column small-12 large-9">
	        <section class="large-12 columns event-section">
	            <div class="large-12 columns event-heading">
	                <h1 class="column small-2">Projects</h1>
	                <div class="column small-10 text-right">
						<?php
							if($activeUser['role_id'] == 1 || $workgroup_details->user_id == $activeUser['id']){
								echo $this->Html->link(__('<span class="fa fa-list"></span> All Projects'), ['controller' => 'WorkgroupProjects', 'action' => 'index'], ['class'=>'button', 'escape'=>false]);
								echo $this->Html->link(__('<span class="fa fa-edit"></span> Edit Project'), ['controller' => 'WorkgroupProjects', 'action' => 'edit', $project->id], ['class'=>'button', 'escape'=>false]);
								echo $this->Form->postLink(
					                __('Delete'),
					                ['action' => 'delete', $project->id],
					                ['confirm' => __('Are you sure you want to delete # {0}?', $project->name), 'class'=>'button alert']
					            );
							}
							echo $this->Html->link(__('<span class="fa fa-tasks"></span> My Tasks'), ['controller' => 'WorkgroupTasks', 'action' => 'index', $project->id], ['class'=>'button', 'escape'=>false]);
						?>
					</div>
	            </div>
				<div class="large-12 columns event-content">
					<nav aria-label="You are here:" role="navigation">
					  <ul class="breadcrumbs">
					    <li><?= $this->Html->link(__('Projects'), ['controller' => 'WorkgroupProjects', 'action' => 'index'], ['escape'=>false]); ?></li>
					    <li><?= __($project->name); ?></li>
					  </ul>
					</nav>
					<div class="large-12 columns">
						<div class="large-4 columns">
							<?php
								echo '<h6><strong>Start date:</strong> <span class="label secondary">'.$project->start_date.'</span></h6>'; 
							?>
						</div>
						<div class="large-4 columns">
							<?php
								echo '<h6><strong>End date:</strong> <span class="label secondary">'.$project->end_date.'</span></h6>'; 
							?>
						</div>
						<div class="large-12 columns">
							<?= $project->description ?>
							<br />
							<?php
								if($activeUser['role_id'] == 1 || $workgroup_details->user_id == $activeUser['id']){
									if($project->monitor_timeline == 1){
										echo $this->Form->create($project);
										echo '<div class="medium-2 columns pad-col-x">';
						            	echo $this->Form->control('progress', ['label'=>false, 'type'=>'number', 'min'=>"0", 'max'=>"100", 'step'=>"1"]);
										echo '</div>';
										echo '<div class="medium-4 columns pad-col-x float-left">';
										echo $this->Form->button(__('Update Timeline'), ['class'=>'button', 'escape'=>false]);
										echo '</div>';
										echo $this->Form->end();
									}
								}
								
								echo '<a data-fancybox data-type="ajax" href="'.$this->Url->build(DS.'workgroup'.DS.'workgroup-projects'.DS.'upload'.DS.$project->id, true).'" class="button"> <span class="fa fa-upload"></span> Upload file</a>';
							?>
						</div>
						<div class="large-12 columns misc-wrap text-right">
							<?php
								echo '<button class="slide-toggle" href="#"><span class="fa fa-folder"></span> Files • '.$media_files_count.'</button>';
								$comment_cat = array(1);
								echo $this->Html->link(__('<span class="fa fa-comments"></span> Comments • '.$this->cell('Misc::countComment', ['WorkgroupComments', $comment_cat, $project->id])->render('count')), ['controller' => 'WorkgroupProjects', 'action' => 'comments', $project->id], ['class'=>'', 'escape'=>false]);
							?>
						</div>
						<div class="large-12 columns file-box">
							<?php
								if($media_files_count > 0){
									foreach($media_files as $media_file):
										
										$trimmed_file_name = null;
								
										if(strlen($media_file->file_name) > 15){
											$trimmed_file_name = substr($media_file->file_name,0,15).'....';
										}else{
											$trimmed_file_name = $media_file->file_name;
										} 
										
										if($media_file->media_type == 'image/jpeg' || $media_file->media_type == 'image/png' || $media_file->media_type == 'image/gif'){
											echo '<a href="'.$this->Url->build(DS.$media_file->media_dir.DS.$media_file->file_name, true).'" class="small-6 medium-3 large-2 columns media-folder float-left" title="'.$media_file->file_name.'" data-fancybox="'.$media_file->parent_id.'">';
											echo '<div class="icon thumbnail">';
											echo $this->Html->image(DS.$media_file->media_dir.DS.$media_file->file_name, ["alt" => "Ebony Oil & Gas"]);
											echo '</div>';
									  
											echo '<h6>'.$trimmed_file_name.'</h6>';
											if($activeUser['role_id'] == 1 || $activeUser['role_id'] == 2){
								
											}
											echo '</a>';
										}elseif($media_file->media_type == 'application/pdf'){
											echo '<a target="_blank" href="'.$this->Url->build(DS.$media_file->media_dir.DS.$media_file->file_name, true).'" class="small-6 medium-3 large-2 columns media-folder float-left" title="'.$media_file->file_name.'">';
											echo '<div class="icon">';
											echo '<span class="fa fa-file-pdf-o fa-3x"></span>';
											echo '</div>';
											echo '<h6>'.$trimmed_file_name.'</h6>';
											if($activeUser['role_id'] == 1 || $activeUser['role_id'] == 2){
								
											}
											echo '</a>';
										}else{
											echo '<a target="_blank" href="'.$this->Url->build(DS.$media_file->media_dir.DS.$media_file->file_name, true).'" class="small-6 medium-3 large-2 columns media-folder float-left" title="'.$media_file->file_name.'">';
											echo '<div class="icon">';
											echo '<span class="fa fa-file fa-3x"></span>';
											echo '</div>';
											echo '<h6>'.$trimmed_file_name.'</h6>';
											if($activeUser['role_id'] == 1 || $activeUser['role_id'] == 2){
								
											}
											echo '</a>';
										}
									endforeach;
								}else{
									echo '<p>No files uploaded</p>';
								}
							?>
						</div>
						<div class="large-12 columns portal-sp">
							<?php
								echo $this->Html->link(__('<span class="fa fa-plus"></span> Add Task'), ['controller' => 'WorkgroupTasks', 'action' => 'add', $project->id], ['class'=>'button active', 'escape'=>false]);
							?>
					        <h5><?= __('Project Tasks') ?></h5>
					        <table id="general-table" class="display" width="100%" cellpadding="0" cellspacing="0">
								<thead>
						            <tr>
						                <th><?= __('#') ?></th>
						                <th><?= __('Task') ?></th>
										<?php
											if($project->monitor_timeline == 2){
												echo '<th>Progress Point</th>';
											}
										?>
										<th><?= __('Assigned Staff') ?></th>
										<th><?= __('Status') ?></th>
										<th><?= __('*') ?></th>
						                <th class="actions"><?= __('Actions') ?></th>
						            </tr>
								</thead>
								<tbody>
						            <?php 
										$i=1;
										foreach ($tasks as $data): 
									?>
						            <tr>
						                <td><?= h($i) ?></td>
						                <td><?= $this->Html->link($data->name, ['controller' => 'WorkgroupTasks', 'action' => 'view', $data->id]); ?></td>
										<?php
											if($project->monitor_timeline == 2){
												echo '<td>'.$data->progress.'</td>';
											}
										?>
										<td><?php
												if($data->user_id){
													echo $this->cell('Misc::getUsers', [$data->user_id])->render('getUsers');
												}
										?></td>
										<td>
											<?php
												if($data->status == 1){
													echo '<span class="label secondary">Pending</span>';
												}
											
												if($data->status == 2){
													echo '<span class="label primary">Done</span>';
												}
											
												if($data->status == 3){
													echo '<span class="label success">Complete</span>';
												}
											?>
										</td>
										<td><?php
												$comment_cat = array(2);
												echo $this->Html->link(__('<span class="fa fa-comments"></span> '.$this->cell('Misc::countComment', ['WorkgroupComments', $comment_cat, $data->id, $project->id])->render('count')), ['controller' => 'WorkgroupTasks', 'action' => 'comments', $project->id], ['class'=>'', 'escape'=>false]);
												echo '&nbsp;&nbsp;';
												echo '<span class="fa fa-folder"></span> '.$this->cell('Misc::countFiles', ['WorkgroupMedia', $data->id, $project->id, $data->id, null, $data->workgroup_id])->render('count');
											 ?></td>
						                <td class="actions">
											<!-- <?= $this->Html->link(__('Assign User(s)'), ['controller' => 'WorkgroupProjectMembers', 'action' => 'add', $data->id], ['class'=>'button small']) ?> -->
						                    <?= $this->Html->link(__('View'), ['controller' => 'WorkgroupTasks', 'action' => 'view', $data->id], ['class'=>'button small']) ?>
						                    <?php 
												if($activeUser['role_id'] == 1 || $workgroup_details->user_id == $activeUser['id']){
													echo $this->Html->link(__('Edit'), ['controller' => 'WorkgroupTasks', 'action' => 'edit', $data->id], ['class'=>'button small']);
													echo '&nbsp;';
							                    	echo $this->Form->postLink(__('Delete'), ['controller' => 'WorkgroupTasks', 'action' => 'delete', $data->id], ['confirm' => __('Are you sure you want to delete # {0}?', $data->name), 'class'=>'button small alert']); 
													echo '&nbsp;';
													if($data->status == 2 || $data->status == 3){
														echo $this->Html->link(__('Review'), ['controller' => 'WorkgroupTasks', 'action' => 'review', $data->id], ['class'=>'button small']);
														echo '&nbsp;';
													}
												}
											
												$assignees = explode(',', $data->user_id);
												
												foreach($assignees as $assigned):
													if($data->status != 2 && $data->status != 3 && $activeUser['id'] == $assigned){
														echo $this->Form->postLink(__('Mark as done'), ['controller' => 'DepartmentTasks', 'action' => 'set_status', $data->id, $activeUser['id'], 2], ['confirm' => __('Are you sure you want to mark this # {0}?', $data->name.' as done?'), 'class'=>'button small secondary']);
													}
												endforeach;
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
					
						<div class="large-12 columns portal-sp">
							<?php
								if($activeUser['role_id'] == 1 || $workgroup_details->user_id == $activeUser['id']){
									echo $this->Html->link(__('<span class="fa fa-plus"></span> Add Staff'), ['controller' => 'WorkgroupProjectMembers', 'action' => 'add', $project->id], ['class'=>'button active', 'escape'=>false]);
								}
							
							?>
					        <h5><?= __('Project Members') ?></h5>
					        <table id="general-table-i" class="display" width="100%" cellpadding="0" cellspacing="0">
								<thead>
						            <tr>
						                <th><?= __('#') ?></th>
						                <th><?= __('User') ?></th>
										<!-- <th><?= __('Status') ?></th> -->
										<th class="actions"><?= __('Actions') ?></th>
						            </tr>
								</thead>
								<tbody>
						            <?php 
										$i=1;
										foreach ($project_members as $data): 
										//if($data->user->id != $activeUser['id']){
									?>
						            <tr>
						                <td><?= h($i) ?></td>
						                <td><?= $this->Html->link($data->user->name, ['controller' => 'Users', 'action' => 'view', $data->user->id]); ?></td>
										<!-- <td><?= $data->user->active; ?></td> -->
						                <td class="actions">
						                    <!-- <?= $this->Html->link(__('View'), ['controller' => 'WorkgroupProjectMembers', 'action' => 'view', $data->id], ['class'=>'button small']) ?> -->
						                    <?php 
												if($activeUser['role_id'] == 1 || $workgroup_details->user_id == $activeUser['id']){
													echo $this->Form->postLink(__('Remove'), ['controller' => 'WorkgroupProjectMembers', 'action' => 'delete', $data->id], ['confirm' => __('Are you sure you want to remove {0}?', $data->user->name), 'class'=>'button small alert']); 
												}
											?>
						                </td>
						            </tr>
						            <?php 
											//ruerit.com}
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
	        <?php echo $this->element('work_aside'); ?>
	    </aside>
	</div>
</main>
<?php echo $this->element('footer'); ?>
<script type="text/javascript">
    $(document).ready(function(){
        $(".slide-toggle").click(function(){
            $(".file-box").slideToggle();
        });
    });
</script>