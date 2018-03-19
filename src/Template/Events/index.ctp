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
echo $this->element('head');
?>
<main id="mains" class="row events-main">
    <div class="column small-12 large-9">
        <section class="event-section">
            <div class="event-heading row">
                <h1 class="column small-3">Events</h1>
                <div class="column small-9 text-right">
					<?php
						echo $this->Html->link(__('<span class="fa fa-calendar"></span> Event Calendar'), ['controller' => 'events', 'action' => 'index'], ['class'=>'button active', 'escape'=>false]);
						echo $this->Html->link(__('<span class="fa fa-list"></span> All Events'), ['controller' => 'events', 'action' => 'events'], ['class'=>'button', 'escape'=>false]);
						if($activeUser['role_id'] == 1 || $department_details->department_role == 2 || $department_details->department_role == 3){
							echo $this->Html->link(__('<span class="fa fa-list"></span> My Events'), ['controller' => 'events', 'action' => 'my_events'], ['class'=>'button', 'escape'=>false]);
							echo $this->Html->link(__('<span class="fa fa-plus"></span> Add Event'), ['controller' => 'events', 'action' => 'add'], ['class'=>'button', 'escape'=>false]);
						}
					?>
				</div>
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
				<!-- <li>
					<span class="projects"></span>
					<span class="legend-name">Projects</span>
				</li>
				<li>
					<span class="project-member"></span>
					<span class="legend-name">Projects (Member)</span>
				</li> -->
			</ul>
        </section>
    </div>

    <aside class="column small-12 large-3 pad-aside">
        <?php echo $this->element('events_list'); ?>
    </aside>
</main>
<?php echo $this->element('footer'); ?>
<script>
	$(document).ready(function() {

	    // page is now ready, initialize the calendar...

	    $('#calendar').fullCalendar({
	        // put your options and callbacks here
			    events: [
					<?php
						foreach($all_events as $event):
					?>
					{
			            title: '<?= $event->name ?>',
			            start: '<?= $event->from_date ?>',
						end: '<?= $event->to_date ?>',
						url: '<?= $this->Url->build('/events/view/'.$event->id, true) ?>',
						<?php 
						$k = 1;
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
						?>
					},
					<?php
						endforeach;
					?>
					<?php
						foreach($birthdays as $birthday):
					?>
					{
			            title: "<?= $birthday->name.'\'s Birthday' ?>",
			            start: '<?= $birthday->date_of_birth ?>',
						allDay : true, // will make the time show
						<?php 
							if($userID == $birthday->id){ 
						?>
				    		color: 'red',   // an option!
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
					?>
			        
			    ],
			
	    })

	});
</script>