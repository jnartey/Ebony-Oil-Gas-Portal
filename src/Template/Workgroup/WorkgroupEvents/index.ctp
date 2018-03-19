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
$this->assign('title', 'Events');
echo $this->element('workgroup/head');
?>
<main id="mains" class="large-12 columns main-content">
	<div class="row">
	    <div class="column small-12 large-9">
	        <section class="event-section">
	            <div class="event-heading row">
	                <h1 class="column small-3">Events</h1>
	                <div class="column small-9 text-right">
						<?php
							echo $this->Html->link(__('<span class="fa fa-calendar"></span> Event Calendar'), ['controller' => 'WorkgroupEvents', 'action' => 'index'], ['class'=>'button active', 'escape'=>false]);
							echo $this->Html->link(__('<span class="fa fa-list"></span> All Events'), ['controller' => 'WorkgroupEvents', 'action' => 'events'], ['class'=>'button', 'escape'=>false]);
							if($activeUser['role_id'] == 1 || $workgroup_details->user_id == $activeUser['id']){
								echo $this->Html->link(__('<span class="fa fa-list"></span> My Events'), ['controller' => 'WorkgroupEvents', 'action' => 'my_events'], ['class'=>'button', 'escape'=>false]);
								echo $this->Html->link(__('<span class="fa fa-plus"></span> Add Event'), ['controller' => 'WorkgroupEvents', 'action' => 'add'], ['class'=>'button', 'escape'=>false]);
							}
						?>
					</div>
	            </div>
				
	        </section>
	    </div>
		<div id='calendar'></div>
		<ul class="legends">
			<li>
				<span class="events"></span>
				<span class="legend-name">Events</span>
			</li>
			<li>
				<span class="events-attending"></span>
				<span class="legend-name">Events (Attending)</span>
			</li>
			<li>
				<span class="birthdays"></span>
				<span class="legend-name">Birthdays</span>
			</li>
			<li>
				<span class="projects"></span>
				<span class="legend-name">Projects</span>
			</li>
			<li>
				<span class="project-member"></span>
				<span class="legend-name">Projects (Member)</span>
			</li>
		</ul>
	    <aside class="column small-12 large-3 pad-aside">
	        <?php echo $this->element('work_aside'); ?>
	    </aside>
	</div>
</main>
<?php echo $this->element('footer'); ?>
<script>
	$(document).ready(function() {

	    // page is now ready, initialize the calendar...

	    $('#calendar').fullCalendar({
	        // put your options and callbacks here
				<?php if(!empty($all_events->toArray()) || !empty($birthdays->toArray()) || !empty($projects->toArray())){ ?>
			    events: [
					<?php
						if(!empty($all_events->toArray())){
						foreach($all_events as $event):
					?>
					{
			            title: '<?= $event->name ?>',
			            start: '<?= $event->from_date ?>',
						end: '<?= $event->to_date ?>',
						url: '<?= $this->Url->build('/workgroup/events/view/'.$event->id, true) ?>',
						<?php 
						$k = 1;
						
						if(!empty($event->events_members)){
						foreach($event->events_members as $events_member):
							if($userID == $events_member->user_id){ 
								if($k == 1){
						?>
				    		color: '#ffb214',   // an option!
				    		textColor: 'black'
							<?php }}else{ 
								if($k == 1){ 
							?>
				    		color: '#eeeeee',   // an option!
				    		textColor: 'black'
						<?php 
							}
						} 
							$k++;
						endforeach;
						}
						?>
					},
					<?php
						endforeach;
						}
					?>
					<?php
						if(!empty($birthdays->toArray())){
						foreach($birthdays as $birthday):
					?>
					{
			            title: "<?= $birthday->name.'\'s Birthday' ?>",
			            start: '<?= $birthday->date_of_birth ?>',
						allDay : true, // will make the time show
						<?php 
							if($userID == $birthday->id){ 
						?>
				    		color: 'cyan',   // an option!
				    		textColor: 'black'
							<?php }else{ ?>
				    		color: '#004A80',   // an option!
				    		textColor: 'black'
						<?php 
							} 
						?>
					},
					<?php
						endforeach;
						}
					?>
					
				<?php
					if(!empty($projects->toArray())){
					foreach($projects as $project):
				?>
				{
		            title: '<?= $project->name ?>',
		            start: '<?= $project->start_date ?>',
					end: '<?= $project->end_date ?>',
					url: '<?= $this->Url->build('/workgroup/projects/view/'.$project->id, true) ?>',
					<?php 
					$b = 1;
					if(!empty($project->workgroup_project_members)){
					foreach($project->workgroup_project_members as $project_member):
						if($userID == $project_member->user_id){ 
							if($b == 1){
					?>
			    		color: 'red',   // an option!
			    		textColor: 'white'
						<?php 
							} 
						}else{ 
							if($b == 1){
						?>
			    		color: 'green',   // an option!
 			    		textColor: 'white'
					<?php 
							}
						} 
						$b++;
					endforeach;
					}
					?>
				},
				<?php
					endforeach;
					}
				?>
			        
			    ],
			<?php } ?>
	    })

	});
</script>