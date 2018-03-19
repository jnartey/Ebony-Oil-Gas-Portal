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
$this->assign('title', 'Events');
echo $this->element('workgroup/head');
?>
<main id="mains" class="large-12 columns main-content">
	<div class="row">
	    <div class="column small-12 large-9">
	        <section class="large-12 columns event-section">
	            <div class="large-12 columns event-heading">
	                <h1 class="column small-3">Events</h1>
	                <div class="column small-9 text-right">
						<?php
							echo $this->Html->link(__('<span class="fa fa-calendar"></span> Event Calendar'), ['controller' => 'WorkgroupEvents', 'action' => 'index'], ['class'=>'button', 'escape'=>false]);
							echo $this->Html->link(__('<span class="fa fa-list"></span> All Events'), ['controller' => 'WorkgroupEvents', 'action' => 'events'], ['class'=>'button active', 'escape'=>false]);
							if($activeUser['role_id'] == 1 || $workgroup_details->user_id == $activeUser['id']){
								echo $this->Html->link(__('<span class="fa fa-list"></span> My Events'), ['controller' => 'WorkgroupEvents', 'action' => 'my_events'], ['class'=>'button', 'escape'=>false]);
								if($activeUser['role_id'] == $event->id){
									echo $this->Form->postLink(
						                __('Delete'),
						                ['action' => 'delete', $event->id],
						                ['confirm' => __('Are you sure you want to delete # {0}?', $event->name), 'class'=>'button alert']
						            );
								}
							
								echo $this->Html->link(__('<span class="fa fa-plus"></span> Add Event'), ['controller' => 'WorkgroupEvents', 'action' => 'add'], ['class'=>'button', 'escape'=>false]);
							}
						?>
					</div>
	            </div>
				<div class="large-12 columns event-content">
					<nav aria-label="You are here:" role="navigation">
					  <ul class="breadcrumbs">
					    <li><?= $this->Html->link(__('Events'), ['controller' => 'WorkgroupEvents', 'action' => 'index'], ['escape'=>false]); ?></li>
					    <li><?= $event->name; ?></li>
					  </ul>
					</nav>
					<div class="large-12 columns">
					    <?= $this->Form->create($event) ?>
					    <?php
							echo '<div class="medium-6 columns pad-col-x">';
					    	echo $this->Form->control('from_date', ['type' => 'text', 'id'=>'from', 'value'=>date("Y-m-d H:i:s", strtotime($event->from_date))]);
							echo '</div>';
							echo '<div class="medium-6 columns pad-col-x">';
							echo $this->Form->control('to_date', ['type' => 'text', 'id'=>'to', 'value'=>date("Y-m-d H:i:s", strtotime($event->to_date))]);
							echo '</div>';
							echo '<div class="medium-6 columns pad-col-x">';
							echo $this->Form->control('registration_deadline', ['type' => 'text', 'class'=>'extra-date', 'value'=>date("Y-m-d H:i:s", strtotime($event->registration_deadline))]);
							echo '</div>';
							echo '<div class="medium-12 columns pad-col-x">';
					        echo $this->Form->control('name');
							echo '</div>';
							echo '<div class="medium-12 columns pad-col-x">';
					        echo $this->Form->control('description', ['class'=>'editor']);
							echo '</div>';
							echo '<div class="medium-12 columns pad-col-x">';
					        echo $this->Form->control('location');
							echo '</div>';
					    ?>
						<div class="medium-12 columns pad-col-x">
						<?= $this->Form->button(__('Update'), ['class'=>'button']) ?>
						</div>
					    <?= $this->Form->end() ?>
					</div>
				</div>
	        </section>
	    </div>

	    <aside class="column small-12 large-3 pad-aside">
	        <?php echo $this->element('work_aside'); ?>
	    </aside>
	</div>
</main>
<?php echo $this->element('footer'); ?>