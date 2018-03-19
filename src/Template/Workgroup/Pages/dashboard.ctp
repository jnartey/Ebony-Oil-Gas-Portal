<?php
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
$this->assign('title', 'Dashboard');
echo $this->element('workgroup/head');
?>
<div id="mains" class="large-12 columns dashboard" data-equalizer data-equalize-on="large">
	<div class="row">
		<div class="large-3 columns portal-box">
			<div class="large-12 columns highlights float-left" data-equalizer-watch>
				<div class="large-12 columns user-profile">
					<div class="small-4 columns photo" style="background-image:url(<?= $this->Url->build('/img/dummy.png', true); ?>);"></div>
					<div class="small-8 columns username">
						<span><?= __($activeUser['first_name'].' '.$activeUser['last_name']); ?></span>
					</div>
				</div>
				<div class="large-12 columns general">
					<h6>Quick Links</h6>
					<ul class="quick-links">
						<li><?= $this->Html->link(__('<span class="fa fa-circle-o red"></span> Employees'), ['controller'=> 'users', 'action' => 'index'], ['escape'=>false]) ?></li>
						<li><?= $this->Html->link(__('<span class="fa fa-circle-o blue"></span> Documents'), ['controller'=> 'media', 'action' => 'index'], ['escape'=>false]) ?></li>
						<li><?= $this->Html->link(__('<span class="fa fa-circle-o brown"></span> Workgroups'), ['controller'=> 'workgroups', 'action' => 'index'], ['escape'=>false]) ?></li>
						<li><?= $this->Html->link(__('<span class="fa fa-circle-o green"></span> Workgroups'), ['controller'=> 'workgroups', 'action' => 'index'], ['escape'=>false]) ?></li>
					</ul>
					<?php if(!empty($upcoming_event)) {?>
					<?php 
						$event_status = $this->cell('Misc::eventStatus', [$upcoming_event->from_date, $upcoming_event->to_date, true])->render('eventStatus'); 
						$date = new Time($upcoming_event->from_date);
						
					?>
					<h6><?= $event_status; ?></h6>
					<div class="events-summary">
						<span class="day"><?= date_format($upcoming_event->from_date, 'l'); ?></span>
						<span class="date"><?= date_format($upcoming_event->from_date, 'jS F Y'); ?></span><br />
						<span class="event-title"><?= $upcoming_event->name; ?></span>
						<span class="time"><?= date_format($upcoming_event->from_date, 'g:ia'); ?></span><br />
					</div>
					<?php } ?>
					<h6>Canteen Menu</h6>
					<ul class="larg-12 columns canteen-menu">
			            <?php
							$now = Chronos::now();
							$i=1;
							foreach ($menu as $data):
								if($now->isMonday() && $data->day == 1){
									echo '<li class="active">';
								}elseif($now->isTuesday() && $data->day == 2){
									echo '<li class="active">';
								}elseif($now->isWednesday() && $data->day == 3){
									echo '<li class="active">';
								}elseif($now->isThursday() && $data->day == 4){
									echo '<li class="active">';
								}elseif($now->isFriday() && $data->day == 5){
									echo '<li class="active">';
								}else{
									echo '<li>';
								}
								
								echo '<div class="small-4 columns day">';
								if($data->day == 1){
									echo '<strong>Mon</strong>';
								}
							
								if($data->day == 2){
									echo '<strong>Tues</strong>';
								}
							
								if($data->day == 3){
									echo '<strong>Wed</strong>';
								}
							
								if($data->day == 4){
									echo '<strong>Thurs</strong>';
								}
							
								if($data->day == 5){
									echo '<strong>Fri</strong>';
								}
		                 	   	echo '</div>';
								echo '<div class="small-8 columns">';
								echo $data->morning_meal;
								echo ', '.$data->afternoon_meal;
								echo ', '.$data->evening_meal; 
								echo '</div></li>';
							$i++;
							endforeach; 
						?>
					</ul>
				</div>
			</div>
		</div>
		<div class="large-9 columns dashboard-content" data-equalizer-watch>
			<div class="large-8 columns">
				<div class="large-12 columns portal-box">
					<div class="large-12 columns misc-box">
						<h5>Project Activity</h5>
						<div class="large-12 columns text"></div>
					</div>
				</div>
				
				<div class="large-12 columns portal-box misc-list">
					<h6>Projects</h6>
					<?php if($projects_ch){ ?>
					<ul>
						<?php
							foreach($projects as $project):
								$comment_cat = array(1, 2);
								echo '<li class="large-12 columns"><a class="large-12 columns" href="'.$this->Url->build('/workgroupWorkgroup/WorkgroupProjects/view/'.$project->id, true).'">';
								echo '<div class="medium-6 columns"><div class="media-object">';
								echo '<div class="media-object-section"><span class="fa fa-bars"></span></div>';
								echo '<div class="media-object-section">';
								echo '<span class="project-title">'.$project->name.'</span><br />';
								echo '<span class="project-date">Last updated at '.$project->modified.'</span>';
								echo '</div>';
								echo '</div></div>';
								echo '<div class="medium-3 columns"><div class="large-3 columns center-v">';
								echo '<span class="fa fa-folder-o"> <em>0</em></span>';
								echo '<span class="fa fa-comments"> <em>'.$this->cell('Misc::countCommentMisc', ['Comments', $comment_cat, $project->id, 'project_id', $project->id, 'department_id', $project->department_id])->render('count').'</em></span>';
								echo '</div></div>'; 
								echo '<div class="medium-3 columns"><div class="medium-3 columns success progress center-v">';
								echo '<div class="progress-meter" style="width: 0%"><p class="progress-meter-text text-center">0%</p></div>';
								echo '</div></div>';
								echo '</a></li>';
							endforeach;
						?>
					</ul>
					<?= $this->Html->link(__('More...'), ['controller'=> 'projects', 'action' => 'index'], ['escape'=>false, 'class'=>'button small']) ?>
					<?php }else{
						echo '<p>No projects</p>';
					} ?>
				</div>
				
				<div class="large-12 columns portal-box misc-list">
					<h6>My Forums</h6>
					<?php if($workgroup_forums_ch){ ?>
					<ul>
						<?php
							foreach($workgroup_forums as $workgroup_forum):
								echo '<li class="large-12 columns"><a class="large-12 columns" href="'.$this->Url->build('/workgroup/WorkgroupsForums/view/'.$workgroup_forum->id, true).'">';
								echo '<div class="medium-6 columns"><div class="media-object">';
								echo '<div class="media-object-section"><span class="fa fa-bars"></span></div>';
								echo '<div class="media-object-section">';
								echo '<span class="project-title">'.$workgroup_forum->title.'</span><br />';
								echo '<span class="project-date">'.$workgroup_forum->created.'</span>';
								echo '</div>';
								echo '</div></div>';
								echo '<div class="medium-3 columns"><div class="large-3 columns center-v">';
								echo '<span class="project-date"> Created by '.$workgroup_forum->user->name.'</span>';
								echo '</div></div>';
								echo '<div class="medium-3 columns text-right"><div class="large-3 columns center-v">';
								$comment_cat = array(4);
								echo '<span class="fa fa-comments-o"> <em>'.$this->cell('Misc::countCommentMisc', ['DepartmentComments', $comment_cat, $workgroup_forum->id, 'forum_id', $workgroup_forum->id, 'department_id', $workgroup_forum->department_id])->render('count').'</em></span>';
								echo '</div></div>';
								echo '</a></li>';
							endforeach;
						?>
					</ul>
					<?= $this->Html->link(__('More...'), ['controller'=> 'projects', 'action' => 'index'], ['escape'=>false, 'class'=>'button small']) ?>
					<?php }else{
						echo '<p>No forum</p>';
					} ?>
				</div>
				
				<div class="medium-12 columns portal-box">
					<div class="large-12 columns misc-box">
						<h5>News</h5>
						<div class="large-12 columns text">
							<div class="orbit" role="region" aria-label="News" data-orbit>
							  <ul class="orbit-container">
  								  <?php
  								  	$n = 1;
  								  	foreach($news_data as $news):
  										if($n == 1){
  											echo '<li class="is-active orbit-slide">';
  										}else{
  											echo '<li class="orbit-slide">';
  										}
										
										$news_date = Time::parse($news->created);
										
  										echo '<a href="'.$this->Url->build('/news/view/'.$news->id, true).'">';	
  										if($news->image){
  											echo '<div class="media-object-section">';
  											echo $this->Html->image("dummy.png", ["alt" => "Ebony Oil & Gas", 'class'=>'orbit-image']);
  											echo '</div>';
  											echo '<div class="media-object-section">';
  											echo '<span class="label secondary">'.$news->category->name.'</span><br />';
  											echo '<h6>'.$news->title.'</h6>';
  											echo '<span class="date">'.$news_date->nice().'</span>';
  											echo '<p>'.$news->summary.'</p>';
  											echo '</div>';
  										}else{
  											echo '<span class="label secondary">'.$news->category->name.'</span><br />';
  											echo '<h6>'.$news->title.'</h6>';
  											echo '<span class="date">'.$news_date->nice().'</span>';
  											echo '<p>'.$news->summary.'</p>';
  										}
  										echo '</a>';
  										echo '</li>';
  										$n++;
  									endforeach;
  								  ?>
  							  </ul>
  							  <nav class="orbit-bullets">
  							  <?php
  							  	$j = 1;
  							  	foreach($news_data as $news):
  									if($j == 1){
  										echo '<button class="is-active" data-slide="'.$j.'"><span class="show-for-sr">First slide details.</span><span class="show-for-sr">Current Slide</span></button>';
  									}else{
  										echo '<button data-slide="'.$j.'"><span class="show-for-sr">First slide details.</span></button>';
  									}
									
  									$j++;
  								endforeach;
  							  ?>
  							  </nav>
							  <div class="large-12 slide-nav text-right">
							    <button class="orbit-previous"><span class="show-for-sr">Previous Slide</span><span class="fa fa-chevron-left fa-1x"></span></button>
							    <button class="orbit-next"><span class="show-for-sr">Next Slide</span><span class="fa fa-chevron-right fa-1x"></span></button>
							  </div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
			
			<div class="medium-4 columns">
				<div class="medium-12 columns portal-box-x">
				    <aside class="column small-12">
				        <?php echo $this->element('work_aside'); ?>
				    </aside>
				</div>
				<div class="medium-12 columns portal-box">
				    <aside class="column small-12">
						<div class="large-12 columns misc-box">
							<h5>My Wiki</h5>
							<div class="large-12 columns misc-content r-pad">
								<table>
		  						  <thead>
		  						    <tr>
		  						      <th>Title</th>
		  						      <th>Date</th>
		  						    </tr>
		  						  </thead>
								  <tbody>
							        <?php
										if($wikis_ch){
											foreach($wikis as $wiki):
												echo '<tr>';
												echo '<td>';
												echo '<a class="large-12 columns" href="'.$this->Url->build('/wiki/view/'.$wiki->id, true).'">';
												echo $wiki->title;
												echo '</a>';
												echo '</td>';
												echo '<td>'.$wiki->created.'</td>';
												echo '</tr>';
											endforeach;
										}
							        ?>
								  </tbody>
								</table>
							</div>
						</div>
				    </aside>
				</div>
			</div>
			
		</div>
	</div>
</div>
<?= $this->element('footer'); ?>