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
echo $this->element('head');
?>
<div id="mains" class="large-12 columns dashboard" data-equalizer data-equalize-on="large">
	<div class="row">
		<div class="large-3 columns portal-box">
			<div class="large-12 columns highlights float-left" data-equalizer-watch>
				<div class="large-12 columns user-profile">
					<?php
						if($user_pro->photo){
							echo '<div class="small-4 columns photo" style="background-image:url('.$this->Url->build(DS.'files'.DS.'Users'.DS.'photo'.DS.'small-'.$user_pro->photo, true).');"></div>';
						}else{
							echo '<div class="small-4 columns photo" style="background-image:url('.$this->Url->build('/img/dummy.png', true).');"></div>';
						}
					?>
					
					<div class="small-8 columns username">
						<span><?= __($activeUser['first_name'].' '.$activeUser['last_name']); ?></span>
					</div>
				</div>
				<div class="large-12 columns general">
					<h6>Quick Links</h6>
					<ul class="quick-links">
						<li><?= $this->Html->link(__('<span class="fa fa-circle-o red"></span> Employees'), ['controller'=> 'users', 'action' => 'index'], ['escape'=>false]) ?></li>
						<li><?= $this->Html->link(__('<span class="fa fa-circle-o blue"></span> Documents'), ['controller'=> 'media', 'action' => 'index'], ['escape'=>false]) ?></li>
						<li><?= $this->Html->link(__('<span class="fa fa-circle-o brown"></span> Departments'), ['controller'=> 'departments', 'action' => 'index'], ['escape'=>false]) ?></li>
						<li><?= $this->Html->link(__('<span class="fa fa-circle-o green"></span> Workgroups'), ['controller'=> 'workgroups', 'action' => 'index'], ['escape'=>false]) ?></li>
					</ul>
					
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
				<div class="large-12 columns portal-box misc-list">
					<h6>My Forums</h6>
					<?php 
						if($department_forums_ch){
							echo '<ul>'; 
							foreach($department_forums as $department_forum):
								echo '<li class="large-12 columns"><a class="large-12 columns" href="'.$this->Url->build('/DepartmentsForums/view/'.$department_forum->id, true).'">';
								echo '<div class="medium-6 columns"><div class="media-object">';
								echo '<div class="media-object-section"><span class="fa fa-bars"></span></div>';
								echo '<div class="media-object-section">';
								echo '<span class="project-title">'.$department_forum->title.'</span><br />';
								echo '<span class="project-date">'.$department_forum->created.'</span>';
								echo '</div>';
								echo '</div></div>';
								echo '<div class="medium-3 columns"><div class="large-3 columns center-v">';
								echo '<span class="project-date"> Created by '.$department_forum->user->name.'</span>';
								echo '</div></div>';
								echo '<div class="medium-3 columns text-right"><div class="large-3 columns center-v">';
								$comment_cat = array(4);
								echo '<span class="fa fa-comments-o"> <em>'.$this->cell('Misc::countCommentMisc', ['Comments', $comment_cat, $data->id, 'forum_id', $department_forum->id])->render('count').'</em></span>';
								echo '</div></div>';
								echo '</a></li>';
							endforeach;
							echo '</ul>';
							echo '<div class="large-12 columns text-right">'.$this->Html->link(__('More...'), ['controller'=> 'projects', 'action' => 'index'], ['escape'=>false, 'class'=>'button small']).'</div>';
						}else{
							echo '<p class="pad-col-s">No forum</p>';
						} 
					?>
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
				<div class="medium-12 columns portal-box">
					<div class="large-12 columns misc-box">
						<h5>Events</h5>
						<div class="large-12 columns text">
							<div class="orbit" role="region" aria-label="Events" data-orbit>
							  <ul class="orbit-container">
								  <?php
								  	$e = 1;
								  	foreach($events_data as $event):
										
										$from = Time::parse($event->from_date);
										$to = Time::parse($event->to_date);
										$event_status = $this->cell('Misc::eventStatus', [$event->from_date, $event->to_date])->render('eventStatus');
										
										if($e == 1){
											echo '<li class="is-active orbit-slide">';
										}else{
											echo '<li class="orbit-slide">';
										}
										
										echo '<a href="'.$this->Url->build('/events/view/'.$event->id, true).'">';
										echo $event_status.'<br />';
										echo '<h6>'.$event->name.'</h6>';
										if($event->to_date){
											echo '<span class="date">'.$from->nice().' - '.$to->nice().'</span>';
										}else{
											echo '<span class="date">'.$from->nice().'</span>';
										}
										echo $event->description;
										echo '</a>';
										echo '</li>';
										$e++;
								  	endforeach;
								  ?>
							  </ul>
							  <nav class="orbit-bullets">
								  <?php
								  	$i = 1;
								  	foreach($events_data as $event):
										if($i == 1){
											echo '<button class="is-active" data-slide="'.$i.'"><span class="show-for-sr">First slide details.</span><span class="show-for-sr">Current Slide</span></button>';
										}else{
											echo '<button data-slide="'.$i.'"><span class="show-for-sr">First slide details.</span></button>';
										}
										
										$i++;
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
				        <?php echo $this->element('aside'); ?>
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