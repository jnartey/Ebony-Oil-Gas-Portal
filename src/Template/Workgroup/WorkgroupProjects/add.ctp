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
$this->assign('title', 'Projects');
echo $this->element('workgroup/head');
?>
<main id="mains" class="large-12 columns main-content">
	<div class="row">
	    <div class="column small-12 large-9">
	        <section class="large-12 columns event-section">
	            <div class="large-12 columns event-heading">
	                <h1 class="column small-2">Projects</h1>
	                <div class="column small-10 text-right">
						<?php
							echo $this->Html->link(__('<span class="fa fa-list"></span> All Projects'), ['controller' => 'WorkgroupProjects', 'action' => 'index'], ['class'=>'button', 'escape'=>false]);
						?>
					</div>
	            </div>
				<div class="large-12 columns event-content">
					<nav aria-label="You are here:" role="navigation">
					  <ul class="breadcrumbs">
					    <li><?= $this->Html->link(__('Projects'), ['controller' => 'WorkgroupProjects', 'action' => 'index'], ['escape'=>false]); ?></li>
					    <li><?= __('Add Project'); ?></li>
					  </ul>
					</nav>
					<div class="large-12 columns">
					    <?= $this->Form->create($project) ?>
					    <?php
							echo $this->Form->hidden('workgroup_id', ['value' => $workgroup_details->workgroup_id]);
							echo $this->Form->hidden('created_by', ['value'=>$activeUser['id']]);
							echo $this->Form->hidden('status', ['value'=>1]);
							echo $this->Form->control('monitor_timeline', [
								'templates' => [ 
								        'checkboxWrapper' => '<div class="medium-4 columns float-left checkbox">{{label}}</div>',
								    ],
								'options' => [/*1 => 'Manual by Project', 2 => 'Manual by task',*/ 3 => 'Auto by task'], 
							]);
							echo '</div></div>';
							echo '<div class="medium-6 columns pad-col-x">';
							echo $this->Form->control('start_date', ['type' => 'text', 'id'=>'from']);
							echo '</div>';
							echo '<div class="medium-6 columns pad-col-x">';
							echo $this->Form->control('end_date', ['type' => 'text', 'id'=>'to']);
							echo '</div>';
							echo '<div class="medium-12 columns pad-col-x">';
					    	echo $this->Form->control('name');
							echo '</div>';
							echo '<div class="medium-12 columns pad-col-x">';
					        echo $this->Form->control('description', ['class'=>'editor']);
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