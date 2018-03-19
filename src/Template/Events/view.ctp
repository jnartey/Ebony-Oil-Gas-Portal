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
						echo $this->Html->link(__('<span class="fa fa-calendar"></span> Event Calendar'), ['controller' => 'events', 'action' => 'index'], ['class'=>'button', 'escape'=>false]);
						echo $this->Html->link(__('<span class="fa fa-list"></span> All Events'), ['controller' => 'events', 'action' => 'events'], ['class'=>'button active', 'escape'=>false]);
						if($activeUser['role_id'] == 1 || $department_details->department_role == 2 || $department_details->department_role == 3){
							echo $this->Html->link(__('<span class="fa fa-list"></span> My Events'), ['controller' => 'events', 'action' => 'my_events'], ['class'=>'button', 'escape'=>false]);
							if($activeUser['id'] == $event->user_id){
								echo $this->Html->link(__('<span class="fa fa-pencil"></span> Edit'), ['controller' => 'events', 'action' => 'edit', $event->id], ['class'=>'button', 'escape'=>false]);
								echo $this->Form->postLink(
					                __('Delete'),
					                ['action' => 'delete', $event->id],
					                ['confirm' => __('Are you sure you want to delete # {0}?', $event->name), 'class'=>'button alert']
					            );
							}
							
							echo $this->Html->link(__('<span class="fa fa-plus"></span> Add Event'), ['controller' => 'events', 'action' => 'add'], ['class'=>'button', 'escape'=>false]);
						}
					?>
				</div>
            </div>
			<div class="large-12 event-content">
				<nav aria-label="You are here:" role="navigation">
				  <ul class="breadcrumbs">
				    <li><?= $this->Html->link(__('Events'), ['controller' => 'events', 'action' => 'index'], ['escape'=>false]); ?></li>
				    <li><?= $event->name; ?></li>
				  </ul>
				</nav>
				<?php
					
					echo '<h4>'.$event->name.'</h4>'; 
					if($event->to_date){
						echo '<span class="date">'.$event->from_date.' - '.$event->to_date.'</span>';
					}else{
						echo '<span class="date">'.$event->from_date.'</span>';
					}
					
					echo $event->description;
					
					echo '<span class="fa fa-map-marker"></span> <span>'.$event->location.'</span>';
					
					echo '<br /><br />';
					
					if(!$check_register){
					    echo $this->Form->create($eventsMember, ['url'=>['action'=>'register']]);
						echo $this->Form->hidden('user_id', ['value'=>$activeUser['id']]);
						echo $this->Form->hidden('event_id', ['value' => $event->id]);
						echo '<div class="medium-2 pad-col-x">';
		            	echo $this->Form->control('status', ['options' => [1 => 'Register', 2 => 'Decline']]);
						echo '</div>';
						echo '<div class="medium-12 pad-col-x">';
		            	echo $this->Form->control('comment', ['placeholder' => 'Comment']);
						echo '</div>';
						echo '<div class="medium-12 pad-col-x">';
						echo $this->Form->button(__('Submit'), ['class'=>'button']);
						echo '</div>';
					    echo $this->Form->end();
					}else{
						if($check_user->status == 1){
							echo '<span class="label secondary">You are attending this event</span><br /><br />';
						}elseif($check_user->status == 2){
							echo '<span class="label secondary">You are not attending this event</span><br /><br />';
						}
					    echo $this->Form->create($eventsMember, ['url'=>['action'=>'register']]);
						echo $this->Form->hidden('user_id', ['value'=>$activeUser['id']]);
						echo $this->Form->hidden('event_id', ['value' => $event->id]);
						echo $this->Form->hidden('id', ['value' => $check_user->id]);
						echo '<div class="medium-2 pad-col-x">';
		            	echo $this->Form->control('status', ['options' => [2 => 'Decline']]);
						echo '</div>';
						echo '<div class="medium-12 pad-col-x">';
		            	echo $this->Form->control('comment', ['placeholder' => 'Comment']);
						echo '</div>';
						echo '<div class="medium-12 pad-col-x">';
						echo $this->Form->button(__('Submit'), ['class'=>'button']);
						echo '</div>';
					    echo $this->Form->end();
					}
				?>
				<div class="large-12 portal-sp">
		        <h5><?= __('Registered Members') ?></h5>
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
							foreach ($registered as $data): 
							//if($data->user->id != $activeUser['id']){
						?>
			            <tr>
			                <td><?= h($i) ?></td>
			                <td><?= $this->Html->link($data->user->name, ['controller' => 'Users', 'action' => 'view', $data->user->id]); ?></td>
							<!-- <td><?= $data->user->active; ?></td> -->
			                <td class="actions">
			                    <!-- <?= $this->Html->link(__('View'), ['controller' => 'WorkgroupsMembers', 'action' => 'view', $data->id], ['class'=>'button small']) ?> -->
			                    <?php 
									if($activeUser['role_id'] == 1 || $department_details->department_role == 2 || $department_details->department_role == 3 || $event->user_id == $activeUser['id']){
										echo $this->Form->postLink(__('Remove'), ['controller' => 'EventsMembers', 'action' => 'delete', $data->id, $event->id], ['confirm' => __('Are you sure you want to remove {0}?', $data->user->name), 'class'=>'button small alert']); 
									}
								?>
			                </td>
			            </tr>
			            <?php 
								//}
							$i++;
							endforeach; 
						?>
					</tbody>
		        </table>
				</div>
			</div>
        </section>
    </div>

    <aside class="column small-12 large-3 pad-aside">
        <?php echo $this->element('aside'); ?>
    </aside>
</main>
<?php echo $this->element('footer'); ?>