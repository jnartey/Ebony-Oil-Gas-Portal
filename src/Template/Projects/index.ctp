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
<main id="mains" class="large-12 columns main-content">
	<div class="row">
	    <div class="column small-12 large-9">
	        <section class="large-12 columns" id="projects-section">
				<div class="large-12 columns">
		            <h1>Projects</h1>

		            <div class="large-12 columns sorting-row">
						<div class="medium-7 columns">
			                <!-- <ul id="project-sorting">
			                    <li><a href="javascript:void(0);" class="active">By Name</a></li>
			                    <li><a href="javascript:void(0);">By Phase</a></li>
			                    <li><a href="javascript:void(0);">By Days Left</a></li>
			                </ul> -->
						</div>
						<div class="medium-5 columns float-right text-right">
							<?php
								if($activeUser['role_id'] == 1 || $department_details->department_role == 2 || $department_details->department_role == 3){
									echo $this->Html->link(__('<span class="fa fa-plus"></span> Create Projects'), ['controller' => 'projects', 'action' => 'add'], ['class'=>'button create-project-btn', 'escape'=>false]);
								}
								echo '&nbsp;';
								echo $this->Html->link(__('<span class="fa fa-plus"></span> My Tasks'), ['controller' => 'tasks', 'action' => 'index'], ['class'=>'button create-project-btn', 'escape'=>false]);
							?>
						</div>
		            </div>
				</div>

	            <div class="large-12 columns project-sorting-area">
					 <?php 
					 	foreach ($projects as $project):
							
							$start = new DateTime($project->start_date);
							$end = new DateTime($project->end_date);

							$diff = $start->diff($end)->format("%a");
							
							$now = new DateTime();
							
							if($now < $end){
								$diff = $start->diff($end)->format("%a");
							}else{
								$diff = 0;
							}
							
							if($project->status == 1){
								echo '<div class="large-4 columns project incomplete-project"><div class="inner">';
								echo '<a href="'.$this->Url->build('/projects/view/'.$project->id, true).'" class="header">';
								echo '<span class="project-type">&nbsp;</span>';
								echo '<p class="project-name">'.$project->name.'</p>';
								echo '<div class="progress project-timeline">';
								if($project->monitor_timeline == 1){
									echo '<span class="progress-slider" style="left: calc('.$project->progress.'% - 0.7rem)"></span>';
									echo '<div class="progress-meter" style="width: '.$project->progress.'%"></div>';
									echo '<span class="progress-data" style="left: calc('.$project->progress.'% - 1.25rem">'.$project->progress.'%</span>';
								}
								
								if($project->monitor_timeline == 2){
									$task_progress = 0;
									if(!empty($project->tasks)){
										foreach($project->tasks as $task):
											if($task->status == 3){
												$task_progress += $task->progress;
											}
										endforeach;
									}
									echo '<span class="progress-slider" style="left: calc('.$task_progress.'% - 0.7rem)"></span>';
									echo '<div class="progress-meter" style="width: '.$task_progress.'%"></div>';
									echo '<span class="progress-data" style="left: calc('.$task_progress.'% - 1.25rem">'.$task_progress.'%</span>';
								}
								
								if($project->monitor_timeline == 3){
									$task_progress = 0;
									$task_count = 0;
									if(!empty($project->tasks)){
										foreach($project->tasks as $task):
											if($task->status == 3){
												$task_progress += 1;
											}
											$task_count++;
										endforeach;
										
										$task_percentage = 100/$task_count;
										$task_progress = $task_progress * $task_percentage;
										$task_progress = number_format($task_progress, 0, '.', '');
									}
									echo '<span class="progress-slider" style="left: calc('.$task_progress.'% - 0.7rem)"></span>';
									echo '<div class="progress-meter" style="width: '.$task_progress.'%"></div>';
									echo '<span class="progress-data" style="left: calc('.$task_progress.'% - 1.25rem">'.$task_progress.'%</span>';
								}
								
								echo '</div>';
								echo '<ul class="project-tasks-days">';
								echo '<li>'.$this->cell('Misc::count', ['Tasks', 'project_id', $project->id, 0])->render('count').' <span>Tasks Left<br>To finish</span></li>';
								echo '<li></li>';
								echo '<li>'.$diff.' <span>Days Left<br />To finish</span></li>';
								echo '</ul>';
								echo '</a>';
								echo '<ul class="footer">';
								echo '<li><a href="javascript:void(0)"><span class="tasks"></span> 0</a></li>';
								echo '<li>'.$this->Html->link(__('<span class="fa fa-comments"></span> '.$this->cell('Misc::countComment', ['Comments', 'project_id', $project->id])->render('countComment')), ['controller' => 'projects', 'action' => 'comments', $project->id], ['class'=>'', 'escape'=>false]).'</li>';
								echo '<li><a href="javascript:void(0)"><span class="folders"></span> 0</a></li>';
								echo '</ul>';
								echo '</div></div>';
							}elseif($project->status == 2){
								echo '<div class="large-4 columns project complete-project"><div class="inner">';
								echo '<a href="'.$this->Url->build('/projects/view/'.$project->id, true).'" class="header">';
								echo '<span>Completed Project</span>';
								echo '<p>'.$project->name.'</p>';
								echo '</a>';
								echo '<div class="footer row">';
								echo '<p class="column small-6"><span></span>Completed</p>';
								echo $this->Form->postLink(
					                __('Reactivate'),
					                ['action' => 'activate', $project->id],
					                ['confirm' => __('Are you sure you want to Reactivate # {0}?', $project->name), 'class'=>'button alert']
					            );
								echo '</div>';
								echo '</div></div>';
							}elseif($project->status == 3){
								echo '<div class="large-4 columns project complete-project"><div class="inner">';
								echo '<a href="'.$this->Url->build('/projects/view/'.$project->id, true).'" class="header">';
								echo '<span>Closed Project</span>';
								echo '<p>'.$project->name.'</p>';
								echo '</a>';
								echo '<div class="footer row">';
								echo '<p class="column small-6"><span></span>Completed</p>';
								echo $this->Form->postLink(
					                __('Reactivate'),
					                ['action' => 'activate', $project->id],
					                ['confirm' => __('Are you sure you want to Reactivate # {0}?', $project->name), 'class'=>'button alert']
					            );
								echo '</div>';
								echo '</div></div>';
							}
						endforeach;
				     ?>
 				    <div class="large-12 columns paginator">
 				        <ul class="pagination">
 				            <?= $this->Paginator->first('<< ' . __('first')) ?>
 				            <?= $this->Paginator->prev('< ' . __('previous')) ?>
 				            <?= $this->Paginator->numbers() ?>
 				            <?= $this->Paginator->next(__('next') . ' >') ?>
 				            <?= $this->Paginator->last(__('last') . ' >>') ?>
 				        </ul>
 				        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
 				    </div>
	        </section>
	    </div>
	    <aside class="column small-12 large-3 pad-aside">
	        <?php echo $this->element('aside'); ?>
	    </aside>
	</main>
</div>
<?php echo $this->element('footer'); ?>