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

$this->layout = 'default';
$this->assign('title', 'Dashboard');
echo $this->element('head');
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
						<li><?= $this->Html->link(__('<span class="fa fa-circle-o blue"></span> Documents'), ['controller'=> 'documents', 'action' => 'index'], ['escape'=>false]) ?></li>
						<li><?= $this->Html->link(__('<span class="fa fa-circle-o brown"></span> Departments'), ['controller'=> 'departments', 'action' => 'index'], ['escape'=>false]) ?></li>
						<li><?= $this->Html->link(__('<span class="fa fa-circle-o green"></span> Workgroups'), ['controller'=> 'workgroups', 'action' => 'index'], ['escape'=>false]) ?></li>
					</ul>
				
					<h6>Upcoming Events</h6>
					<div class="events-summary">
						<span class="day">Monday</span>
						<span class="date">28th April 2017</span><br />
						<span class="event-title">MERRY CHRISTMAS EVERYONE AND DAYS OFF SCHEDULE</span>
						<span class="time">1:00pm</span><br />
					</div>
				
					<h6>Canteen Menu</h6>
					<ul class="larg-12 columns canteen-menu">
						<li>
							<div class="small-4 columns day">Mon</div>
							<div class="small-8 columns">Rice and Stew</div>
						</li>
						<li>
							<div class="small-4 columns day">Tues</div>
							<div class="small-8 columns">Rice and Stew</div>
						</li>
						<li>
							<div class="small-4 columns day">Wed</div>
							<div class="small-8 columns">Rice and Stew</div>
						</li>
						<li>
							<div class="small-4 columns day">Thurs</div>
							<div class="small-8 columns">Rice and Stew</div>
						</li>
						<li class="active">
							<div class="small-4 columns day">Fri</div>
							<div class="small-8 columns">Rice and Stew</div>
						</li>
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
					<ul>
						<li class="large-12 columns">
							<a class="large-12 columns" href="#">
								<div class="medium-6 columns">
								  <div class="media-object">
								    <div class="media-object-section">
								      <span class="fa fa-bars"></span>
								    </div>
								    <div class="media-object-section">
										<span class="project-title">Project Title</span><br />
										<span class="project-date">Last updated today at 8:45am</span>
								    </div>
								  </div>
								</div>
								<div class="medium-3 columns">
									<div class="large-3 columns center-v">
										<span class="fa fa-folder-o"> <em>14</em></span>
										<span class="fa fa-comments-o"> <em>14</em></span>
									</div>
								</div>
								<div class="medium-3 columns">
									<div class="medium-3 columns success progress center-v">
									  <div class="progress-meter" style="width: 98%">
									    <p class="progress-meter-text">98%</p>
									  </div>
									</div>
								</div>
							</a>
						</li>
						<li class="large-12 columns">
							<a class="large-12 columns" href="#">
								<div class="medium-6 columns">
								  <div class="media-object">
								    <div class="media-object-section">
								      <span class="fa fa-bars"></span>
								    </div>
								    <div class="media-object-section">
										<span class="project-title">Project Title</span><br />
										<span class="project-date">Last updated today at 8:45am</span>
								    </div>
								  </div>
								</div>
								<div class="medium-3 columns">
									<div class="large-3 columns center-v">
										<span class="fa fa-folder-o"> <em>14</em></span>
										<span class="fa fa-comments-o"> <em>14</em></span>
									</div>
								</div>
								<div class="medium-3 columns">
									<div class="medium-3 columns success progress center-v">
									  <div class="progress-meter" style="width: 80%">
									    <p class="progress-meter-text">80%</p>
									  </div>
									</div>
								</div>
							</a>
						</li>
						<li class="large-12 columns">
							<a class="large-12 columns" href="#">
								<div class="medium-6 columns">
								  <div class="media-object">
								    <div class="media-object-section">
								      <span class="fa fa-bars"></span>
								    </div>
								    <div class="media-object-section">
										<span class="project-title">Project Title</span><br />
										<span class="project-date">Last updated today at 8:45am</span>
								    </div>
								  </div>
								</div>
								<div class="medium-3 columns">
									<div class="large-3 columns center-v">
										<span class="fa fa-folder-o"> <em>14</em></span>
										<span class="fa fa-comments-o"> <em>14</em></span>
									</div>
								</div>
								<div class="medium-3 columns">
									<div class="medium-3 columns warning progress center-v">
									  <div class="progress-meter" style="width: 70%">
									    <p class="progress-meter-text">70%</p>
									  </div>
									</div>
								</div>
							</a>
						</li>
						<li class="large-12 columns">
							<a class="large-12 columns" href="#">
								<div class="medium-6 columns">
								  <div class="media-object">
								    <div class="media-object-section">
								      <span class="fa fa-bars"></span>
								    </div>
								    <div class="media-object-section">
										<span class="project-title">Project Title</span><br />
										<span class="project-date">Last updated today at 8:45am</span>
								    </div>
								  </div>
								</div>
								<div class="medium-3 columns">
									<div class="large-3 columns center-v">
										<span class="fa fa-folder-o"> <em>14</em></span>
										<span class="fa fa-comments-o"> <em>14</em></span>
									</div>
								</div>
								<div class="medium-3 columns">
									<div class="medium-3 columns warning progress center-v">
									  <div class="progress-meter" style="width: 50%">
									    <p class="progress-meter-text">50%</p>
									  </div>
									</div>
								</div>
							</a>
						</li>
						<li class="large-12 columns">
							<a class="large-12 columns" href="#">
								<div class="medium-6 columns">
								  <div class="media-object">
								    <div class="media-object-section">
								      <span class="fa fa-bars"></span>
								    </div>
								    <div class="media-object-section">
										<span class="project-title">Project Title</span><br />
										<span class="project-date">Last updated today at 8:45am</span>
								    </div>
								  </div>
								</div>
								<div class="medium-3 columns">
									<div class="large-3 columns center-v">
										<span class="fa fa-folder-o"> <em>14</em></span>
										<span class="fa fa-comments-o"> <em>14</em></span>
									</div>
								</div>
								<div class="medium-3 columns">
									<div class="medium-3 columns alert progress center-v">
									  <div class="progress-meter" style="width: 25%">
									    <p class="progress-meter-text">25%</p>
									  </div>
									</div>
								</div>
							</a>
						</li>
					</ul>
				</div>
				
				<div class="large-12 columns portal-box misc-list">
					<h6>My Forums</h6>
					<ul>
						<li class="large-12 columns">
							<a class="large-12 columns" href="#">
								<div class="medium-6 columns">
								  <div class="media-object">
								    <div class="media-object-section">
								      <span class="fa fa-bars"></span>
								    </div>
								    <div class="media-object-section">
										<span class="project-title">Forum Title</span><br />
										<span class="project-date">Today at 8:45am</span>
								    </div>
								  </div>
								</div>
								<div class="medium-3 columns">
									<div class="large-3 columns center-v">
										<span class="project-date">Created by Anonymous</span>
									</div>
								</div>
								<div class="medium-3 columns text-right">
									<div class="large-3 columns center-v">
										<span class="fa fa-square-o"> <em>14</em></span>
										<span class="fa fa-comments-o"> <em>14</em></span>
									</div>
								</div>
							</a>
						</li>
						<li class="large-12 columns">
							<a class="large-12 columns" href="#">
								<div class="medium-6 columns">
								  <div class="media-object">
								    <div class="media-object-section">
								      <span class="fa fa-bars"></span>
								    </div>
								    <div class="media-object-section">
										<span class="project-title">Forum Title</span><br />
										<span class="project-date">Today at 8:45am</span>
								    </div>
								  </div>
								</div>
								<div class="medium-3 columns">
									<div class="large-3 columns center-v">
										<span class="project-date">Created by Anonymous</span>
									</div>
								</div>
								<div class="medium-3 columns text-right">
									<div class="large-3 columns center-v">
										<span class="fa fa-square-o"> <em>14</em></span>
										<span class="fa fa-comments-o"> <em>14</em></span>
									</div>
								</div>
							</a>
						</li>
						<li class="large-12 columns">
							<a class="large-12 columns" href="#">
								<div class="medium-6 columns">
								  <div class="media-object">
								    <div class="media-object-section">
								      <span class="fa fa-bars"></span>
								    </div>
								    <div class="media-object-section">
										<span class="project-title">Forum Title</span><br />
										<span class="project-date">Today at 8:45am</span>
								    </div>
								  </div>
								</div>
								<div class="medium-3 columns">
									<div class="large-3 columns center-v">
										<span class="project-date">Created by Anonymous</span>
									</div>
								</div>
								<div class="medium-3 columns text-right">
									<div class="large-3 columns center-v">
										<span class="fa fa-square-o"> <em>14</em></span>
										<span class="fa fa-comments-o"> <em>14</em></span>
									</div>
								</div>
							</a>
						</li>
					</ul>
				</div>
				
				<div class="medium-12 columns portal-box">
					<div class="large-12 columns misc-box">
						<h5>News</h5>
						<div class="large-12 columns text">
							<div class="orbit" role="region" aria-label="News" data-orbit>
							  <ul class="orbit-container">
							    <li class="is-active orbit-slide">
							      <a href="#">
									  <div class="media-object">
									    <div class="media-object-section">
									      <?php echo $this->Html->image("dummy.png", ["alt" => "Ebony Oil & Gas", 'class'=>'orbit-image']); ?>
									    </div>
									    <div class="media-object-section">
											<span class="label secondary">Oil and Gas</span><br />
											<h6>Launching of Ebony Oil & Gas portal</h6>
											<span class="date">1st August, 2017</span>
											<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde harum rem, beatae ipsa consectetur quisquam. Rerum ratione.</p>
									    </div>
									  </div>
							      </a>
							    </li>
							    <li class="is-active orbit-slide">
							      <a href="#">
									  <div class="media-object">
									    <div class="media-object-section">
									      <?php echo $this->Html->image("dummy.png", ["alt" => "Ebony Oil & Gas", 'class'=>'orbit-image']); ?>
									    </div>
									    <div class="media-object-section">
											<span class="label secondary">Research</span><br />
											<h6>Launching of Ebony Oil & Gas portal</h6>
											<span class="date">1st August, 2017</span>
											<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde harum rem, beatae ipsa consectetur quisquam. Rerum ratione.</p>
									    </div>
									  </div>
							      </a>
							    </li>
							    <li class="is-active orbit-slide">
							      <a href="#">
									  <div class="media-object">
									    <div class="media-object-section">
									      <?php echo $this->Html->image("dummy.png", ["alt" => "Ebony Oil & Gas", 'class'=>'orbit-image']); ?>
									    </div>
									    <div class="media-object-section">
											<span class="label secondary">Finance</span><br />
											<h6>Launching of Ebony Oil & Gas portal</h6>
											<span class="date">1st August, 2017</span>
											<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde harum rem, beatae ipsa consectetur quisquam. Rerum ratione.</p>
									    </div>
									  </div>
							      </a>
							    </li>
							  </ul>
							  <nav class="orbit-bullets">
							    <button class="is-active" data-slide="0"><span class="show-for-sr">First slide details.</span><span class="show-for-sr">Current Slide</span></button>
							    <button data-slide="1"><span class="show-for-sr">Second slide details.</span></button>
							    <button data-slide="2"><span class="show-for-sr">Third slide details.</span></button>
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
				        <?php echo $this->element('wiki'); ?>
				    </aside>
				</div>
			</div>
			
		</div>
	</div>
</div>
<?= $this->element('footer'); ?>