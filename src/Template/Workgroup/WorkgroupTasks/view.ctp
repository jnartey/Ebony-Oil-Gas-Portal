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
							echo $this->Html->link(__('Back'), ['controller' => 'WorkgroupProjects', 'action' => 'view', $project->id], ['class'=>'button', 'escape'=>false]);
							if($activeUser['role_id'] == 1 || $workgroup_details->workgroup_role == 2 || $workgroup_details->workgroup_role == 3){
								echo $this->Html->link(__('<span class="fa fa-list"></span> All Projects'), ['controller' => 'WorkgroupProjects', 'action' => 'index'], ['class'=>'button', 'escape'=>false]);
								echo $this->Html->link(__('<span class="fa fa-plus"></span> Create Task'), ['controller' => 'WorkgroupTasks', 'action' => 'add', $project->id], ['class'=>'button', 'escape'=>false]);
								echo $this->Html->link(__('<span class="fa fa-plus"></span> Edit Task'), ['controller' => 'WorkgroupTasks', 'action' => 'edit', $task->id], ['class'=>'button', 'escape'=>false]);
								echo $this->Form->postLink(
					                __('Delete'),
					                ['action' => 'delete', $task->id],
					                ['confirm' => __('Are you sure you want to delete # {0}?', $task->name), 'class'=>'button alert']
					            );
							}
						
							if($activeUser['role_id'] == 1 || $workgroup_details->workgroup_role == 2 || $workgroup_details->workgroup_role == 3){
								//echo $this->Html->link(__('Review'), ['controller' => 'WorkgroupTasks', 'action' => 'review', $task->id, $activeUser['id']], ['class'=>'button']);
							}
						
							if($task->status != 2 && $task->status != 3){
								echo $this->Form->postLink(__('Done'), ['controller' => 'WorkgroupTasks', 'action' => 'set_status', $task->id, $activeUser['id'], 2], ['confirm' => __('Are you sure you want to mark this # {0}?', $task->name.' as done?'), 'class'=>'button alert']);
							}
						?>
					</div>
	            </div>
				<div class="large-12 columns event-content">
					<nav aria-label="You are here:" role="navigation">
					  <ul class="breadcrumbs">
					    <li><?= $this->Html->link(__('Projects'), ['controller' => 'WorkgroupProjects', 'action' => 'index'], ['escape'=>false]); ?></li>
					    <li><?= $this->Html->link(__($project->name), ['controller' => 'WorkgroupProjects', 'action' => 'view', $project->id], ['escape'=>false]); ?></li>
						<li><?= __('Task'); ?></li>
					  </ul>
					</nav>
					<div class="large-12 columns">
						<?php
							if($task->status == 1){
								echo '<span class="label secondary">Pending</span>';
							}
						
							if($task->status == 2){
								echo '<span class="label primary">Done</span>';
							}
						
							if($task->status == 3){
								echo '<span class="label success">Complete</span>';
							}
						?>
						<br /><br />
					   	<h5><?= $task->name ?></h5>
						<div class="large-12 columns">
						<?= $task->description ?>
						</div>
					
						<div class="large-12 columns">
						<br />
						<?php
							if($activeUser['role_id'] == 1 || $workgroup_details->workgroup_role == 2 || $workgroup_details->workgroup_role == 3){
								if($project->monitor_timeline == 2){
									echo $this->Form->create($task);
									echo '<div class="medium-2 columns pad-col-x">';
					            	echo $this->Form->control('progress', ['label'=>false, 'type'=>'number', 'min'=>"0", 'max'=>"100", 'step'=>"1"]);
									echo '</div>';
									echo '<div class="medium-4 columns pad-col-x float-left">';
									echo $this->Form->button(__('Task Progress Point'), ['class'=>'button', 'escape'=>false]);
									echo '</div>';
									echo $this->Form->end();
								}
							}
							
							echo '<a data-fancybox data-type="ajax" href="'.$this->Url->build(DS.'department'.DS.'department-tasks'.DS.'upload'.DS.$project->id.DS.$task->id, true).'" class="button"> <span class="fa fa-upload"></span> Upload file</a>';
						?>
						</div>
						<?php
						if(!$comment_id){
						?>
						<div class="large-12 columns misc-wrap text-right">
							<?php
								echo '<button class="slide-toggle" href="#"><span class="fa fa-folder"></span> Files • '.$media_files_count.'</button>';
								$comment_cat = array(2);
								echo $this->Html->link(__('<span class="fa fa-comments"></span> Comments • '.$this->cell('Misc::countComment', ['WorkgroupComments', $comment_cat, $task->id, $project->id])->render('count')), ['controller' => 'WorkgroupTasks', 'action' => 'view', $task->id], ['class'=>'', 'escape'=>false]);
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
					        <h5><?= __('Task Members') ?></h5>
					        <table id="general-table-i" class="display" width="100%" cellpadding="0" cellspacing="0">
								<thead>
						            <tr>
						                <th><?= __('#') ?></th>
						                <th><?= __('User') ?></th>
										<!-- <th><?= __('Status') ?></th> -->
										<!-- <th class="actions"><?= __('Actions') ?></th> -->
						            </tr>
								</thead>
								<tbody>
						            <?php
										if($task_members){
										$i=1;
										foreach ($task_members as $data): 
									?>
						            <tr>
						                <td><?= h($i) ?></td>
						                <td><?= $this->Html->link($data->name, ['controller' => 'Users', 'action' => 'view', $data->id]); ?></td>
										<!-- <td><?= $data->user->active; ?></td> -->
						                <!-- <td class="actions">
						                    <?php
												if($activeUser['role_id'] == 1 || $activeUser['role_id'] == 2){
													echo $this->Form->postLink(__('Remove'), ['controller' => 'ProjectsMembers', 'action' => 'delete', $data->id], ['confirm' => __('Are you sure you want to remove {0}?', $data->user->name), 'class'=>'button small alert']);
												}
											?>
						                </td> -->
						            </tr>
						            <?php 
										$i++;
										endforeach; 
										}
									?>
								</tbody>
					        </table>
						</div>
						<div class="large-12 columns">
					    <?= $this->Form->create($comment) ?>
				        <?php
				            echo $this->Form->hidden('comment_src', ['value' => 2]);
							echo $this->Form->hidden('source_id', ['value' => $task->id]);
				            echo $this->Form->hidden('project_id', ['value' => $project->id]);
				            echo $this->Form->hidden('user_id', ['value' => $activeUser['id']]);
				            echo $this->Form->control('comment', ['label'=>'Add comment']);
				        ?>
						<?= $this->Form->button(__('Submit'), ['class'=>'button']) ?>
					    <?= $this->Form->end() ?>
						<?php }else{
								echo $this->Form->create($comment);
				            	//echo $this->Form->hidden('id');
				            	echo $this->Form->control('comment', ['label'=>'Edit comment']);
								echo $this->Form->hidden('project_id', ['value' => $project->id]);
								echo $this->Form->button(__('Update Comment'), ['class'=>'button']);
								echo $this->Html->link(__('Cancel'), ['controller' => 'WorkgroupTasks', 'action' => 'view', $task->id], ['class'=>'button', 'escape'=>false]);
								echo $this->Form->end();
							} 
						?>
						</div>
						<div id="comments" class="large-12 columns portal-sp comments-box">
							<h6>Comments • <?= $count = $this->cell('Misc::count', ['WorkgroupComments', 'comment_src', 2])->render('count'); ?></h6>
							<?php
								foreach ($posts as $data):
									$now = new Time($data->created);
									echo '<div class="media-object"><div class="media-object-section">';
									if($data->user->photo){
										echo $this->Html->link(__('<span class="user-photo" style="background-image: url('.$this->Url->build(DS.'img'.DS.'users'.DS.'small'.DS.$data->user->photo, true).')"></span>'), ['controller'=>'users', 'action' => 'view', $data->user->id], ['escape'=>false]);
									}else{
										echo $this->Html->link(__('<span class="user-photo" style="background-image: url('.$this->Url->build('/img/dummy.png', true).')"></span><span>'), ['controller'=>'users', 'action' => 'view', $data->user->id], ['escape'=>false]);
									}
									echo '</div>';
									echo '<div class="media-object-section">';
									echo '<h6>'.$data->user->name.'</h6>';
									echo '<p>'.$data->comment.'</p>';
									echo '<div class="date">'.$now->timeAgoInWords(['format' => 'MMM d, YYY', 'end' => '+1 year']).'</div>';
									if($activeUser['role_id'] == 1 || $workgroup_details->workgroup_role == 2 || $workgroup_details->workgroup_role == 3 || $activeUser['id'] == $data->user_id){
										echo '<div class="comment-cp">';
										echo $this->Html->link(__('Edit'), ['controller' => 'WorkgroupTasks', 'action' => 'view', $task->id, $data->id], ['class'=>'', 'escape'=>false]);
										echo ' • ';
										echo $this->Form->postLink(
							                __('Delete'),
							                ['action' => 'delete_comment', $data->id],
							                ['confirm' => __('Are you sure you want to delete {0}?', $data->id), 'class'=>'']
							            );
										echo '</div>';
									}
									echo '</div></div>';
								endforeach;
							?>
						    <div class="paginator text-right">
						        <ul class="pagination">
						            <?= $this->Paginator->first('<< ' . __('first')) ?>
						            <?= $this->Paginator->prev('< ' . __('previous')) ?>
						            <?= $this->Paginator->numbers() ?>
						            <?= $this->Paginator->next(__('next') . ' >') ?>
						            <?= $this->Paginator->last(__('last') . ' >>') ?>
						        </ul>
						        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
						    </div>
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