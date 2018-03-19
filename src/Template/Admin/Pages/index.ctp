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

$this->layout = 'admin';
$this->assign('title', 'Dashboard');
?>

<div class="off-canvas-content" data-off-canvas-content>
	<!-- Your page content lives here -->
	<div id="mains" class="medium-12 columns admin-content">
		<?= $this->element('admin'.DS.'topbar') ?>
		<div class="large-12 columns main-admin-content">
			<div class="large-12 columns panel-wrap">
				<div class="large-12 columns panel">
					<div class="large-12 columns title-pane">
						<h6>Project Activity</h6>
					</div>
					<div class="large-12 columns content">
						<div class="large-12 columns">
							<div class="medium-8 columns">
								<select>
									<option value="">Month</option>
								</select>
								<select>
									<option value="">Start Date</option>
								</select>
								<select>
									<option value="">End Date</option>
								</select>
							</div>
							<div class="medium-4 columns text-right">
								<a class="button-tag" href="#">Today</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="large-12 columns misc-list">
				<h6>Current Projects</h6>
				<!-- <ul>
					<li class="large-12 columns">
						<a class="large-12 columns" href="#" data-equalizer data-equalize-on="medium">
							<div class="medium-4 columns list-col" data-equalizer-watch>
							  <div class="media-object">
							    <div class="media-object-section">
							      <span class="fa fa-bars"></span>
							    </div>
							    <div class="media-object-section">
									<span class="project-title">Project Title</span><br />
									<span class="project-department">Department Name</span>
							    </div>
							  </div>
							</div>
							<div class="medium-3 columns list-col" data-equalizer-watch>
								<div class="medium-12 columns center-v">
									<span class="project-date">Last updated today at 8:45am</span>
								</div>
							</div>
							<div class="medium-3 columns list-col" data-equalizer-watch>
								<div class="medium-12 columns center-v">
									<span class="fa fa-clock-o"> <em>16-05-2017</em></span>
									<span class="fa fa-folder-o"> <em>14</em></span>
									<span class="fa fa-comments-o"> <em>14</em></span>
								</div>
							</div>
							<div class="medium-2 columns list-col" data-equalizer-watch>
								<div class="medium-12 columns success progress center-v">
								  <div class="progress-meter" style="width: 98%">
								    <p class="progress-meter-text">98%</p>
								  </div>
								</div>
							</div>
						</a>
					</li>
					<li class="large-12 columns">
						<a class="large-12 columns" href="#" data-equalizer data-equalize-on="medium">
							<div class="medium-4 columns list-col" data-equalizer-watch>
							  <div class="media-object">
							    <div class="media-object-section">
							      <span class="fa fa-bars"></span>
							    </div>
							    <div class="media-object-section">
									<span class="project-title">Project Title</span><br />
									<span class="project-department">Department Name</span>
							    </div>
							  </div>
							</div>
							<div class="medium-3 columns list-col" data-equalizer-watch>
								<div class="medium-12 columns center-v">
									<span class="project-date">Last updated today at 8:45am</span>
								</div>
							</div>
							<div class="medium-3 columns list-col" data-equalizer-watch>
								<div class="medium-12 columns center-v">
									<span class="fa fa-clock-o"> <em>16-05-2017</em></span>
									<span class="fa fa-folder-o"> <em>14</em></span>
									<span class="fa fa-comments-o"> <em>14</em></span>
								</div>
							</div>
							<div class="medium-2 columns list-col" data-equalizer-watch>
								<div class="medium-12 columns success progress center-v">
								  <div class="progress-meter" style="width: 88%">
								    <p class="progress-meter-text">88%</p>
								  </div>
								</div>
							</div>
						</a>
					</li>
					<li class="large-12 columns">
						<a class="large-12 columns" href="#" data-equalizer data-equalize-on="medium">
							<div class="medium-4 columns list-col" data-equalizer-watch>
							  <div class="media-object">
							    <div class="media-object-section">
							      <span class="fa fa-bars"></span>
							    </div>
							    <div class="media-object-section">
									<span class="project-title">Project Title</span><br />
									<span class="project-department">Department Name</span>
							    </div>
							  </div>
							</div>
							<div class="medium-3 columns list-col" data-equalizer-watch>
								<div class="medium-12 columns center-v">
									<span class="project-date">Last updated today at 8:45am</span>
								</div>
							</div>
							<div class="medium-3 columns list-col" data-equalizer-watch>
								<div class="medium-12 columns center-v">
									<span class="fa fa-clock-o"> <em>16-05-2017</em></span>
									<span class="fa fa-folder-o"> <em>14</em></span>
									<span class="fa fa-comments-o"> <em>14</em></span>
								</div>
							</div>
							<div class="medium-2 columns list-col" data-equalizer-watch>
								<div class="medium-12 columns primary progress center-v">
								  <div class="progress-meter" style="width: 78%">
								    <p class="progress-meter-text">78%</p>
								  </div>
								</div>
							</div>
						</a>
					</li>
					<li class="large-12 columns">
						<a class="large-12 columns" href="#" data-equalizer data-equalize-on="medium">
							<div class="medium-4 columns list-col" data-equalizer-watch>
							  <div class="media-object">
							    <div class="media-object-section">
							      <span class="fa fa-bars"></span>
							    </div>
							    <div class="media-object-section">
									<span class="project-title">Project Title</span><br />
									<span class="project-department">Department Name</span>
							    </div>
							  </div>
							</div>
							<div class="medium-3 columns list-col" data-equalizer-watch>
								<div class="medium-12 columns center-v">
									<span class="project-date">Last updated today at 8:45am</span>
								</div>
							</div>
							<div class="medium-3 columns list-col" data-equalizer-watch>
								<div class="medium-12 columns center-v">
									<span class="fa fa-clock-o"> <em>16-05-2017</em></span>
									<span class="fa fa-folder-o"> <em>14</em></span>
									<span class="fa fa-comments-o"> <em>14</em></span>
								</div>
							</div>
							<div class="medium-2 columns list-col" data-equalizer-watch>
								<div class="medium-12 columns primary progress center-v">
								  <div class="progress-meter" style="width: 58%">
								    <p class="progress-meter-text">58%</p>
								  </div>
								</div>
							</div>
						</a>
					</li>
					<li class="large-12 columns">
						<a class="large-12 columns" href="#" data-equalizer data-equalize-on="medium">
							<div class="medium-4 columns list-col" data-equalizer-watch>
							  <div class="media-object">
							    <div class="media-object-section">
							      <span class="fa fa-bars"></span>
							    </div>
							    <div class="media-object-section">
									<span class="project-title">Project Title</span><br />
									<span class="project-department">Department Name</span>
							    </div>
							  </div>
							</div>
							<div class="medium-3 columns list-col" data-equalizer-watch>
								<div class="medium-12 columns center-v">
									<span class="project-date">Last updated today at 8:45am</span>
								</div>
							</div>
							<div class="medium-3 columns list-col" data-equalizer-watch>
								<div class="medium-12 columns center-v">
									<span class="fa fa-clock-o"> <em>16-05-2017</em></span>
									<span class="fa fa-folder-o"> <em>14</em></span>
									<span class="fa fa-comments-o"> <em>14</em></span>
								</div>
							</div>
							<div class="medium-2 columns list-col" data-equalizer-watch>
								<div class="medium-12 columns primary progress center-v">
								  <div class="progress-meter" style="width: 48%">
								    <p class="progress-meter-text">48%</p>
								  </div>
								</div>
							</div>
						</a>
					</li>
					<li class="large-12 columns">
						<a class="large-12 columns" href="#" data-equalizer data-equalize-on="medium">
							<div class="medium-4 columns list-col" data-equalizer-watch>
							  <div class="media-object">
							    <div class="media-object-section">
							      <span class="fa fa-bars"></span>
							    </div>
							    <div class="media-object-section">
									<span class="project-title">Project Title</span><br />
									<span class="project-department">Department Name</span>
							    </div>
							  </div>
							</div>
							<div class="medium-3 columns list-col" data-equalizer-watch>
								<div class="medium-12 columns center-v">
									<span class="project-date">Last updated today at 8:45am</span>
								</div>
							</div>
							<div class="medium-3 columns list-col" data-equalizer-watch>
								<div class="medium-12 columns center-v">
									<span class="fa fa-clock-o"> <em>16-05-2017</em></span>
									<span class="fa fa-folder-o"> <em>14</em></span>
									<span class="fa fa-comments-o"> <em>14</em></span>
								</div>
							</div>
							<div class="medium-2 columns list-col" data-equalizer-watch>
								<div class="medium-12 columns alert progress center-v">
								  <div class="progress-meter" style="width: 28%">
								    <p class="progress-meter-text">28%</p>
								  </div>
								</div>
							</div>
						</a>
					</li>
				</ul> -->
			</div>
			
			<div class="large-12 columns">
				<div class="large-4 columns panel-wrap">
					<div class="large-12 columns panel">
						<div class="large-12 columns title-pane">
							<h6>List of Staff</h6>
						</div>
						<div class="large-12 columns content">
							<div class="large-12 columns">
								<?php
									foreach($staff as $data):
										echo '<a href="'.$this->Url->build('/admin/users/view/'.$data->id, true).'" class="large-12 columns staff"><div class="media-object">';
										echo '<div class="media-object-section">';
										if($data->photo){
											echo '<span class="user-photo" style="background-image: url('.$this->Url->build(DS.'files'.DS.'Users'.DS.'photo'.DS.'small-'.$data->photo, true).');"></span>';
										}else{
											echo '<span class="user-photo" style="background-image: url('.$this->Url->build('/img/dummy.png', true).')"></span>';
										}
										echo '</div>';
										echo '<div class="media-object-section staff-details">';
										echo '<span class="name">'.$data->name.'</span>';
										echo '<span class="position">'.$data->position.'</span>';
										echo '</div>';
										echo '</div></a>';
									endforeach;
								?>
								<div class="large-12 columns text-center">
									<?= $this->Html->link(__('<span class="fa fa-plus"></span> more'), ['controller'=>'users', 'action' => 'index'], ['class'=>'button', 'escape'=>false]) ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			
				<div class="large-8 columns panel-wrap">
					<div class="large-12 columns panel">
						<div class="large-12 columns title-pane">
							<h6>Canteen</h6>
						</div>
						<div class="large-12 columns content">
							<div class="large-12 columns">
						        <?php if (!empty($menu)): ?>
						        <table id="" class="display" width="100%" cellpadding="0" cellspacing="0">
									<thead>
							            <tr>
							                <th><?= __('Day') ?></th>
							                <th><?= __('Breakfast') ?></th>
											<th><?= __('Lunch') ?></th>
											<th><?= __('Dinner') ?></th>
							            </tr>
									</thead>
									<tbody>
							            <?php 
											$i=1;
											foreach ($menu as $data): 
										?>
							            <tr>
							                <td>
												<?php
													if($data->day == 1){
														echo 'Monday';
													}
												
													if($data->day == 2){
														echo 'Tuesday';
													}
												
													if($data->day == 3){
														echo 'Wednesday';
													}
												
													if($data->day == 4){
														echo 'Thursday';
													}
												
													if($data->day == 5){
														echo 'Friday';
													}
							                	?>
											</td>
							                <td><?= $data->morning_meal ?></td>
											<td><?= $data->afternoon_meal ?></td>
											<td><?= $data->evening_meal ?></td>
							            </tr>
							            <?php 
											$i++;
											endforeach; 
										?>
									</tbody>
						        </table>
						        <?php endif; ?>
							</div>
							<div class="large-12 columns text-right">
								<?= $this->Html->link(__('<span class="fa fa-plus"></span> Add Menu'), ['controller'=>'canteen', 'action' => 'add'], ['class'=>'button', 'escape'=>false]) ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="large-12 columns">
				<div class="large-6 columns panel-wrap">
					<div class="large-12 columns panel">
						<div class="large-12 columns title-pane">
							<h6>News</h6>
						</div>
						<div class="large-12 columns content">
							<div class="large-12 columns">
								<ul class="timeline">
								  <?php
								  	$n = 1;
								  	foreach($news_data as $news):
									
										$news_date = Time::parse($news->created);
										echo '<li>';
									
										echo '<a class="direction-r" href="'.$this->Url->build('/news/view/'.$news->id, true).'">';	
										echo '<div class="flag-wrapper"><span class="flag"></span></div>';
										echo '<div class="desc">';
										if($news->image){
											echo '<div class="media-object"><div class="media-object-section">';
											echo $this->Html->image("dummy.png", ["alt" => "Ebony Oil & Gas", 'class'=>'orbit-image']);
											echo '</div>';
											echo '<div class="media-object-section">';
											echo '<span class="label secondary">'.$news->category->name.'</span><br />';
											echo '<h6>'.$news->title.'</h6>';
											echo '<span class="date">'.$news_date->nice().'</span>';
											echo '<p>'.$news->summary.'</p>';
											echo '</div></div>';
										}else{
											echo '<span class="label secondary">'.$news->category->name.'</span><br />';
											echo '<h6>'.$news->title.'</h6>';
											echo '<span class="date">'.$news_date->nice().'</span>';
											echo '<p>'.$news->summary.'</p>';
										}
										echo '</div></a>';
										echo '</li>';
										$n++;
									endforeach;
								  ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			
				<div class="large-6 columns panel-wrap">
					<div class="large-12 columns panel">
						<div class="large-12 columns title-pane">
							<h6>Events</h6>
						</div>
						<div class="large-12 columns content">
							<div class="large-12 columns">
								<ul class="timeline">
								  <?php
								  	$e = 1;
								  	foreach($events_data as $event):
								
										$from = Time::parse($event->from_date);
										$to = Time::parse($event->to_date);
										$event_status = $this->cell('Misc::eventStatus', [$event->from_date, $event->to_date, null])->render('eventStatus');
									
										echo '<li>';
										echo '<a class="direction-r" href="'.$this->Url->build('/events/view/'.$event->id, true).'">';	
										echo '<div class="flag-wrapper"><span class="flag"></span></div>';
										echo '<div class="desc">';
										echo $event_status.'<br />';
										echo '<h6>'.$event->name.'</h6>';
										if($event->to_date){
											echo '<span class="date">'.$from->nice().' - '.$to->nice().'</span>';
										}else{
											echo '<span class="date">'.$from->nice().'</span>';
										}
									
										echo substr($event->description, 0, 210);
										echo '...';
										echo '<div class="location"><span class="fa fa-map-marker"></span> '.$event->location.'</div>';
										echo '</div></a>';
										echo '</li>';
										$e++;
								  	endforeach;
								  ?>
						  		</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="large-6 columns panel-wrap">
				<a href="<?php echo $this->Url->build('/admin/departments', true); ?>" class="large-12 columns panel sp">
					<div class="large-12 columns content">
						<div class="small-7 columns">
							<h5>Departments</h5>
							<span class="sub-title">Total number of departments</span>
						</div>
						<div class="small-5 columns text-right">
							<h5><?= $departments_count; ?></h5>
						</div>
					</div>
				</a>
			</div>
			
			<div class="large-6 columns panel-wrap">
				<a href="<?php echo $this->Url->build('/admin/users', true); ?>" class="large-12 columns panel sp">
					<div class="large-12 columns content">
						<div class="small-7 columns">
							<h5>Staff</h5>
							<span class="sub-title">Total number of employees/staff</span>
						</div>
						<div class="small-5 columns text-right">
							<h5><?= $staff_count; ?></h5>
						</div>
					</div>
				</a>
			</div>
			
			<?php
				foreach($departments_data as $department):
					$count = $this->cell('Misc::count', ['DepartmentsMembers', 'department_id', $department->id])->render('count');
					echo '<div class="large-3 columns panel-wrap float-left"><a href="'.$this->Url->build('/admin/departments/view/'.$department->id, true).'" class="large-12 columns panel sp">';
					echo '<div class="large-12 columns content">';
					echo '<h6>'.$count.'</h6>';
					echo '<span class="sub-title">Total Staff</span>';
					echo '</div>';
					echo '<div class="large-12 columns title-pane-x">';
					echo '<h6>'.$department->name.'</h6>';
					echo '</div>';
					echo '</a></div>';
				endforeach;
			?>
			
		</div>
	</div>
</div>