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
	                <h1 class="column small-3">Projects</h1>
	                <div class="column small-9 text-right">
						<?php
							if($activeUser['role_id'] == 1 || $workgroup_details->user_id == $activeUser['id']){
								echo $this->Html->link(__('<span class="fa fa-list"></span> Back'), ['controller' => 'WorkgroupProjects', 'action' => 'view', $project->id], ['class'=>'button', 'escape'=>false]);
								echo $this->Html->link(__('<span class="fa fa-edit"></span> Edit Project'), ['controller' => 'WorkgroupProjects', 'action' => 'edit', $project->id], ['class'=>'button', 'escape'=>false]);
							}
							echo $this->Html->link(__('<span class="fa fa-plus"></span> Tasks'), ['controller' => 'WorkgroupTasks', 'action' => 'view', $activeUser['id']], ['class'=>'button', 'escape'=>false]);
						?>
					</div>
	            </div>
				<div class="large-12 columns event-content">
					<nav aria-label="You are here:" role="navigation">
					  <ul class="breadcrumbs">
					    <li><?= $this->Html->link(__('Projects'), ['controller' => 'WorkgroupProjects', 'action' => 'index'], ['escape'=>false]); ?></li>
					    <li><?= __($project->name); ?></li>
					  </ul>
					</nav>
					<div class="large-12 columns">
					   	<?= $project->description ?>
						<div class="large-12 columns portal-sp">
							<div class="tasks form large-12 medium-10 columns content">
							    <?= $this->Form->create($task) ?>
							    <fieldset>
							        <h4><?= __('Add Task') ?></h4>
							        <?php
										echo $this->Form->control('name', ['label'=>'Title']);
										echo $this->Form->hidden('workgroup_id', ['value' => $workgroup_details->id]);
							            //echo $this->Form->control('workgroup_id', ['options' => $workgroups]);
							            //echo $this->Form->control('project_id', ['options' => $projects]);
							            echo $this->Form->control('description');
										If($users){
											echo '<h5>Assign Users</h5>';
											echo $this->Form->control('user_id', [
												'templates' => [ 
												        'checkboxWrapper' => '<div class="medium-4 columns float-left checkbox">{{label}}</div>',
												    ],
												'options' => $users, 
												'multiple' => 'checkbox', 
												'label'=>false
											]);
										}
										echo $this->Form->hidden('project_id', ['value' => $project->id]);
							        ?>
							    </fieldset>
							    <?= $this->Form->button(__('Add Task'), ['class'=>'button']) ?>
							    <?= $this->Form->end() ?>
							</div>
						</div>
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