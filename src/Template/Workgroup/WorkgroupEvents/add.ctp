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
							echo $this->Html->link(__('<span class="fa fa-list"></span> All Events'), ['controller' => 'WorkgroupEvents', 'action' => 'events'], ['class'=>'button', 'escape'=>false]);
							if($activeUser['role_id'] == 1 || $workgroup_details->user_id == $activeUser['id']){
								echo $this->Html->link(__('<span class="fa fa-list"></span> My Events'), ['controller' => 'WorkgroupEvents', 'action' => 'my_events'], ['class'=>'button', 'escape'=>false]);
								echo $this->Html->link(__('<span class="fa fa-plus"></span> Add Event'), ['controller' => 'WorkgroupEvents', 'action' => 'add'], ['class'=>'button active', 'escape'=>false]);
							}
						?>
					</div>
	            </div>
				<div class="large-12 columns event-content">
					<nav aria-label="You are here:" role="navigation">
					  <ul class="breadcrumbs">
					    <li><?= $this->Html->link(__('Events'), ['controller' => 'WorkgroupEvents', 'action' => 'index'], ['escape'=>false]); ?></li>
					    <li><?= __('Add Event'); ?></li>
					  </ul>
					</nav>
					<div class="large-12 columns">
					    <?= $this->Form->create($event) ?>
					    <?php
							echo '<div class="medium-6 columns pad-col-x">';
					    	echo $this->Form->control('from_date', ['type' => 'text', 'id'=>'from']);
							echo '</div>';
							echo '<div class="medium-6 columns pad-col-x">';
							echo $this->Form->control('to_date', ['type' => 'text', 'id'=>'to']);
							echo '</div>';
							echo '<div class="medium-6 columns pad-col-x">';
							echo $this->Form->control('registration_deadline', ['type' => 'text', 'class'=>'extra-date']);
							echo '</div>';
					
							echo '<div class="medium-12 columns pad-col-x">';
					        echo $this->Form->control('name');
							echo '</div>';
							echo '<div class="medium-12 columns pad-col-x">';
					        echo $this->Form->control('description', ['class'=>'editor']);
							echo '</div>';
							echo '<div class="medium-12 columns pad-col-x">';
					        echo $this->Form->control('location');
							echo $this->Form->hidden('user_id', ['value'=>$activeUser['id']]);
							echo '</div>';
					    ?>
						<div class="medium-12 columns pad-col-x">
						<?= $this->Form->button(__('Add'), ['class'=>'button']) ?>
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