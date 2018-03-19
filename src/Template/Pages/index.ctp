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
$this->assign('title', 'Home');
echo $this->element('head');
?>
<div id="mains" class="large-12 columns" data-equalizer data-equalize-on="large">
	<div class="large-12 columns banner">
		<div class="orbit" role="region" aria-label="Banners" data-orbit>
		  <ul class="orbit-container">
		    <button class="orbit-previous"><span class="show-for-sr">Previous Slide</span><span class="fa fa-angle-left fa-3x"></span></button>
		    <button class="orbit-next"><span class="show-for-sr">Next Slide</span><span class="fa fa-angle-right fa-3x"></span></button>
			<?php
				$b = 1;
				foreach($banners as $banner):
					if($b == 1){
						echo '<li class="is-active orbit-slide">';
						echo $this->Html->image(DS.'files'.DS.'Banners'.DS.'banner_image'.DS.'large-'.$banner->banner_image, ["alt" => "Ebony Oil & Gas", 'class'=>'orbit-image']);
						echo '<figcaption class="orbit-caption"><div class="row">';
						echo '<h2>'.$banner->description.'</h2>';
						echo '</div></figcaption>';
						echo '</li>';
					}else{
						echo '<li class="orbit-slide">';
						echo $this->Html->image(DS.'files'.DS.'Banners'.DS.'banner_image'.DS.'large-'.$banner->banner_image, ["alt" => "Ebony Oil & Gas", 'class'=>'orbit-image']);
						echo '<figcaption class="orbit-caption"><div class="row">';
						echo '<h2>'.$banner->description.'</h2>';
						echo '</div></figcaption>';
						echo '</li>';
					}
					
					$b++;
				endforeach;
			?>
		  </ul>
		</div>
	</div>
	
	<div class="large-12 columns main-content dashboard">
		<div class="row">
			<div class="medium-3 columns">
				<div class="medium-12 columns portal-box">
					<div class="large-12 columns resources">
						<span class="fa fa-pie-chart fa-3x"></span>
						<h5>Helpful <br />Resources</h5>
						<ul class="resource-links">
							<li><?php echo $this->Html->link(__('News'), ['controller'=> 'news', 'action' => 'index'], ['escape'=>false]); ?></li>
							<li><?php echo $this->Html->link(__('Events'), ['controller'=> 'events', 'action' => 'index'], ['escape'=>false]); ?></li>
							<!-- <li><?php echo $this->Html->link(__('Leave Request'), ['controller'=> 'Requests', 'action' => 'index'], ['escape'=>false]); ?></li> -->
							<li><?php echo $this->Html->link(__('Company Profile'), ['controller'=> 'pages', 'action' => 'company-profile'], ['escape'=>false]); ?></li>
							<!-- <li><?php echo $this->Html->link(__('Document Library'), ['controller'=> 'documents', 'action' => 'index'], ['escape'=>false]); ?></li> -->
							<li><?php echo $this->Html->link(__('Forum'), ['controller'=> 'forums', 'action' => 'index'], ['escape'=>false]); ?></li>
							<!-- <li><?php echo $this->Html->link(__('FAQ'), ['controller'=> 'events', 'action' => 'index'], ['escape'=>false]); ?></li> -->
							<!-- <li><?php echo $this->Html->link(__('Support'), ['controller'=> 'support', 'action' => 'index'], ['escape'=>false]); ?></li> -->
						</ul>
					</div>
				</div>
				
				<div class="medium-12 columns portal-box">
					<div class="large-12 columns misc-box">
						<h5>Canteen Menu</h5>
						<span class="sub-title">This Week:</span>
						<div class="large-12 columns">
					        <?php if (!empty($menu)): ?>
					        <table>
								<tbody>
						            <?php 
										$i=1;
										foreach ($menu as $data): 
									?>
						            <tr>
						                <td>
											<?php
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
						                	?>
										</td>
						                <td>
											<?php 
												echo $data->morning_meal;
												echo ', '.$data->afternoon_meal;
												echo ', '.$data->evening_meal; 
											?>
										</td>
						            </tr>
						            <?php 
										$i++;
										endforeach; 
									?>
								</tbody>
					        </table>
					        <?php endif; ?>
						</div>
					</div>
				</div>
				
			</div>
			
			<div class="medium-6 columns">
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
				
				<div class="medium-12 columns portal-box">
					<div class="large-12 columns misc-box">
						<h5>News</h5>
						<div class="large-12 columns text">
							<div class="orbit" role="region" aria-label="News" data-orbit>
							  <ul class="orbit-container">
								  <?php
								  	$n = 1;
								  	foreach($news_data as $news):
										
										$news_date = Time::parse($news->created);
										
										if($n == 1){
											echo '<li class="is-active orbit-slide">';
										}else{
											echo '<li class="orbit-slide">';
										}
										
										echo '<a href="'.$this->Url->build('/news/view/'.$news->id, true).'">';	
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
				
				<div class="medium-6 columns portal-box widget">
					<!-- Oil Price Script - OILCRUDEPRICE.COM -->
					<!-- <div style="width:100%; border:1px solid #d6d6d6;height:auto;background-color:#d6d6d6;font-family:Arial;"><div style="background-color:#4a4a4a;height:24px;width:100%; margin:0 auto;font-size:18px; font-weight:bold;text-align:center; padding-top:0px;"><a href="https://www.oilcrudeprice.com/" rel="nofollow" style="color:#ffffff;text-decoration:none;">Brent Oil Price</a></div><script async type="text/javascript" src="https://www.oilcrudeprice.com/oilwidget.php?l=en&m=000000&g=d6d6d6&c=4a4a4a&i=d6d6d6&l=4a4a4a&o=d6d6d6&u=brent"></script></div> -->
					<!-- End of oil Price Script -->	
				</div>
				
				<div class="medium-6 columns portal-box widget">
					<!-- Oil Price Script - OILCRUDEPRICE.COM -->
					<!-- <div style="width:100%; border:1px solid #d6d6d6;height:auto;background-color:#d6d6d6;font-family:Arial;"><div style="background-color:#4a4a4a;height:24px;width:100%; margin:0 auto;font-size:18px; font-weight:bold;text-align:center; padding-top:0px;"><a href="https://www.oilcrudeprice.com/" rel="nofollow" style="color:#ffffff;text-decoration:none;">Natural Gas Price</a></div><script async type="text/javascript" src="https://www.oilcrudeprice.com/oilwidget.php?l=en&m=000000&g=d6d6d6&c=4a4a4a&i=d6d6d6&l=4a4a4a&o=d6d6d6&u=gas"></script></div> -->
					<!-- End of oil Price Script -->	
				</div>
				
			</div>
			
			<div class="medium-3 columns">
				<?php if(!$activeUser){ ?>
				<div class="medium-12 columns portal-box">
					<?= $this->Flash->render() ?>
			        <div class="medium-12 columns form-section">
			            <h2>Sign In</h2>
						<?= $this->Form->create() ?>
				        <?= $this->Form->control('username', array('placeholder'=>'Username', 'label'=>false)) ?>
				        <?= $this->Form->control('password', array('placeholder'=>'Password', 'label'=>false)) ?>
						<?= $this->Form->button(__('Login')); ?>
						<?= $this->Form->end() ?>
			        </div>
				</div>
				<?php } ?>
				
				<?php if($activeUser){ ?>
				<div class="medium-12 columns portal-box-x">
				    <aside class="column small-12">
				        <?php echo $this->element('aside'); ?>
				    </aside>
				</div>
				<?php } ?>
				
				<div class="medium-12 columns portal-box">
					<div class="large-12 columns misc-box">
						<span class="sub-title">Employee of the year:</span>
						<div class="large-12 blank">
							<?php
								if(!empty($employee_of_the_year) && isset($employee_of_the_year)){
									if($employee_of_the_year->photo){
										echo '<div class="employee-photo" style="background-image:url('.$this->Url->build(DS.'files'.DS.'Users'.DS.'photo'.DS.'medium-'.$employee_of_the_year->photo).');"></div>';
									}else{
										echo $this->Html->image("dummy.png", ["alt" => "Ebony Oil & Gas"]); 
									}
								}else{
									echo $this->Html->image("dummy.png", ["alt" => "Ebony Oil & Gas"]); 
								}
							?>
						</div>
						<?php if(!empty($employee_of_the_year) && isset($employee_of_the_year)){ ?>
						<span class="employee-name"><?= $employee_of_the_year->name; ?></span>
						<?php } ?>
					</div>
				</div>
				
			</div>
		</div>
	</div>
</div>
<?= $this->element('footer'); ?>