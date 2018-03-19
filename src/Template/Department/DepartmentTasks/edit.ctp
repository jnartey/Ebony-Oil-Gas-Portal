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
echo $this->element('department/head');
?>
<main id="mains" class="large-12 columns main-content">
	<div class="row">
	    <div class="column small-12 large-9">
	        <section class="large-12 columns event-section">
	            <div class="large-12 columns event-heading">
	                <h1 class="column small-3">Projects</h1>
	                <div class="column small-9 text-right">
						<?php
							if($activeUser['role_id'] == 1 || $department_details->department_role == 2 || $department_details->department_role == 3){
								echo $this->Html->link(__('<span class="fa fa-list"></span> Back'), ['controller' => 'DepartmentProjects', 'action' => 'view', $project->id], ['class'=>'button', 'escape'=>false]);
								echo $this->Html->link(__('<span class="fa fa-edit"></span> Edit Project'), ['controller' => 'DepartmentProjects', 'action' => 'edit', $project->id], ['class'=>'button', 'escape'=>false]);
							}
							echo $this->Html->link(__('<span class="fa fa-plus"></span> Tasks'), ['controller' => 'DepartmentTasks', 'action' => 'view', $activeUser['id']], ['class'=>'button', 'escape'=>false]);
						?>
					</div>
	            </div>
				<div class="large-12 columns event-content">
					<nav aria-label="You are here:" role="navigation">
					  <ul class="breadcrumbs">
					    <li><?= $this->Html->link(__('Projects'), ['controller' => 'DepartmentProjects', 'action' => 'index'], ['escape'=>false]); ?></li>
					    <li><?= __($project->name); ?></li>
					  </ul>
					</nav>
					<div class="large-12 columns">
					   	<?= $project->description ?>
						<div class="large-12 columns portal-sp">
							<div class="tasks form large-12 medium-10 columns content">
							    <?= $this->Form->create($task) ?>
							    <fieldset>
							        <h4><?= __('Task') ?></h4>
							        <?php
										echo $this->Form->control('name', ['label'=>'Title']);
										echo $this->Form->hidden('department_id', ['value' => $department_details->department_id]);
							            //echo $this->Form->control('department_id', ['options' => $departments]);
							            //echo $this->Form->control('project_id', ['options' => $projects]);
							            echo $this->Form->control('description');
										if($users){
											echo $this->Form->control('user_id', [
												'templates' => [ 
												        'checkboxWrapper' => '<div class="medium-4 columns float-left checkbox">{{label}}</div>',
												    ],
												'options' => $users, 
												'multiple' => 'checkbox',
												'val' => $default_ids, 
												'label'=>false
											]);
										}
							        ?>
							    </fieldset>
							    <?= $this->Form->button(__('Update Task'), ['class'=>'button']) ?>
							    <?= $this->Form->end() ?>
							</div>
						</div>
					</div>
				</div>
	        </section>
	    </div>

	    <aside class="column small-12 large-3 pad-aside">
	        <?php echo $this->element('dpt_aside'); ?>
	    </aside>
	</div>
</main>
<?php echo $this->element('footer'); ?>