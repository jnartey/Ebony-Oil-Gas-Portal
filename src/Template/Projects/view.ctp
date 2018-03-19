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
$this->assign('title', 'Projects');
echo $this->element('head');
?>
<main id="mains" class="row events-main">
    <div class="column small-12 large-9">
        <section class="large-12 columns event-section">
            <div class="large-12 columns event-heading">
                <h1 class="column small-2">Projects</h1>
                <div class="column small-10 text-right">
					<?php
						if($activeUser['role_id'] == 1 || $department_details->department_role == 2 || $department_details->department_role == 3){
							echo $this->Html->link(__('<span class="fa fa-list"></span> All Projects'), ['controller' => 'projects', 'action' => 'index'], ['class'=>'button', 'escape'=>false]);
							echo $this->Html->link(__('<span class="fa fa-plus"></span> Create Project'), ['controller' => 'projects', 'action' => 'add'], ['class'=>'button', 'escape'=>false]);
							echo $this->Html->link(__('<span class="fa fa-plus"></span> Edit Project'), ['controller' => 'projects', 'action' => 'edit', $project->id], ['class'=>'button', 'escape'=>false]);
							echo $this->Form->postLink(
				                __('Delete'),
				                ['action' => 'delete', $project->id],
				                ['confirm' => __('Are you sure you want to delete # {0}?', $project->name), 'class'=>'button alert']
				            );
						}
						echo $this->Html->link(__('<span class="fa fa-plus"></span> My Tasks'), ['controller' => 'tasks', 'action' => 'index', $activeUser['id']], ['class'=>'button', 'escape'=>false]);
					?>
				</div>
            </div>
			<div class="large-12 columns event-content">
				<nav aria-label="You are here:" role="navigation">
				  <ul class="breadcrumbs">
				    <li><?= $this->Html->link(__('Projects'), ['controller' => 'projects', 'action' => 'index'], ['escape'=>false]); ?></li>
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
							if($activeUser['role_id'] == 1 || $department_details->department_role == 2 || $department_details->department_role == 3){
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
						?>
					</div>
					<div class="large-12 columns misc-wrap text-right">
						<?php
							$comment_cat = array(1, 2);
							echo $this->Html->link(__('<span class="fa fa-folder"></span> Files • 0'), ['controller' => 'media', 'action' => 'index', $project->id], ['class'=>'', 'escape'=>false]);
							echo $this->Html->link(__('<span class="fa fa-comments"></span> Comments • '.$this->cell('Misc::count', ['Comments', 'comment_src', $comment_cat])->render('count')), ['controller' => 'projects', 'action' => 'comments', $project->id], ['class'=>'', 'escape'=>false]);
						?>
					</div>
					<div class="large-12 columns portal-sp">
						<?php
							echo $this->Html->link(__('<span class="fa fa-plus"></span> Add Task'), ['controller' => 'tasks', 'action' => 'add', $project->id], ['class'=>'button active', 'escape'=>false]);
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
					                <td><?= $this->Html->link($data->name, ['controller' => 'tasks', 'action' => 'view', $data->id]); ?></td>
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
										 	echo $this->Html->link(__('<span class="fa fa-comments"></span> '.$this->cell('Misc::count', ['Comments', 'comment_src', 2])->render('count')), ['controller' => 'tasks', 'action' => 'view', $project->id], ['class'=>'', 'escape'=>false]); 
											echo '&nbsp;&nbsp;';
											echo $this->Html->link(__('<span class="fa fa-folder"></span> 0'), ['controller' => 'media', 'action' => 'index', $project->id, $data->id], ['class'=>'', 'escape'=>false]);
										 ?></td>
					                <td class="actions">
										<!-- <?= $this->Html->link(__('Assign User(s)'), ['controller' => 'ProjectsMembers', 'action' => 'add', $data->id], ['class'=>'button small']) ?> -->
					                    <?= $this->Html->link(__('View'), ['controller' => 'tasks', 'action' => 'view', $data->id], ['class'=>'button small']) ?>
					                    <?php 
											if($activeUser['role_id'] == 1 || $department_details->department_role == 2 || $department_details->department_role == 3){
												echo $this->Html->link(__('Edit'), ['controller' => 'tasks', 'action' => 'edit', $data->id], ['class'=>'button small']);
												echo '&nbsp;';
						                    	echo $this->Form->postLink(__('Delete'), ['controller' => 'tasks', 'action' => 'delete', $data->id], ['confirm' => __('Are you sure you want to delete # {0}?', $data->name), 'class'=>'button small alert']); 
												echo '&nbsp;';
												if($data->status == 2 || $data->status == 3){
													echo $this->Html->link(__('Review'), ['controller' => 'tasks', 'action' => 'review', $data->id], ['class'=>'button small']);
													echo '&nbsp;';
												}
											}
											
											if($data->status != 2 && $data->status != 3){
												echo $this->Form->postLink(__('Mark as done'), ['controller' => 'tasks', 'action' => 'set_status', $data->id, $activeUser['id'], 2], ['confirm' => __('Are you sure you want to mark this # {0}?', $data->name.' as done?'), 'class'=>'button small secondary']);
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
					
					<div class="large-12 columns portal-sp">
						<?php
							if($activeUser['role_id'] == 1 || $department_details->department_role == 2 || $department_details->department_role == 3){
								echo $this->Html->link(__('<span class="fa fa-plus"></span> Add Staff'), ['controller' => 'ProjectsMembers', 'action' => 'add', $project->id], ['class'=>'button active', 'escape'=>false]);
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
					                    <!-- <?= $this->Html->link(__('View'), ['controller' => 'ProjectsMembers', 'action' => 'view', $data->id], ['class'=>'button small']) ?> -->
					                    <?php 
											if($activeUser['role_id'] == 1 || $department_details->department_role == 2 || $department_details->department_role == 3){
												echo $this->Form->postLink(__('Remove'), ['controller' => 'ProjectsMembers', 'action' => 'delete', $data->id], ['confirm' => __('Are you sure you want to remove {0}?', $data->user->name), 'class'=>'button small alert']); 
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
        <?php echo $this->element('aside'); ?>
    </aside>
</main>
<?php echo $this->element('footer'); ?>