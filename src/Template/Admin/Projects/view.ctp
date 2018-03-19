<?php
/**
  * @var \App\View\AppView $this
  */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;

$this->layout = 'admin';
$this->assign('title', 'Projects');
?>

<div class="off-canvas-content" data-off-canvas-content>
	<!-- Your page content lives here -->
	<div id="mains" class="medium-12 columns admin-content">
		<?= $this->element('admin'.DS.'topbar') ?>
		<div class="large-12 columns main-admin-content">
			<div class="large-12 columns panel-wrap action-bar">
				<?= $this->Html->link(__('<span class="fa fa-list-ol"></span> List Projects'), ['controller'=>'Projects', 'action' => 'index'], ['class'=>'button active', 'escape'=>false]) ?>
				<?= $this->Form->postLink(
				                __('Delete'),
				                ['action' => 'delete', $project->id],
				                ['confirm' => __('Are you sure you want to delete # {0}?', $project->name), 'class'=>'button alert']
				            ) ?>
			</div>
			<div class="large-12 columns">
				<div class="large-12 columns panel-wrap">
					<h3><?= h($project->name) ?></h3>
				</div>
				<div class="large-7 columns panel-wrap">
					<div class="large-12 columns panel sp">
						<div class="large-12 columns content">
							<?= $project->description; ?>
						</div>
					</div>
				</div>
				<div class="large-12 columns panel-wrap">
		        <h4><?= __('Tasks') ?></h4>
		        <?php if (!empty($tasks)): ?>
		        <table id="general-table" class="display" width="100%" cellpadding="0" cellspacing="0">
					<thead>
			            <tr>
			                <th><?= __('#') ?></th>
			                <th><?= __('Task') ?></th>
							<th><?= __('Assigned Staff') ?></th>
							<th><?= __('Status') ?></th>
							<th><?= __('*') ?></th>
			                <th class="actions"><?= __('Actions') ?></th>
			            </tr>
					</thead>
					<tbody>
			            <?php 
							$i=1;
							foreach ($tasks as $data): 
						?>
			            <tr>
			                <td><?= h($i) ?></td>
			                <td><?= $this->Html->link($data->name, ['controller' => 'tasks', 'action' => 'view', $data->id]); ?></td>
							<td><?php
								echo $this->cell('Misc::getUsers', [$data->user_id])->render('getUsers');
							?></td>
							<td><!-- <?= $data->user->active; ?> --></td>
							<td><?php
								 	echo $this->Html->link(__('<span class="fa fa-comments"></span> '.$this->cell('Misc::count', ['Comments', 'comment_src', 2])->render('count')), ['controller' => 'tasks', 'action' => 'view', $project->id], ['class'=>'', 'escape'=>false]); 
									echo '&nbsp;&nbsp;';
									echo $this->Html->link(__('<span class="fa fa-folder"></span> 0'), ['controller' => 'media', 'action' => 'index', $project->id, $data->id], ['class'=>'', 'escape'=>false]);
								 ?></td>
			                <td class="actions">
								<!-- <?= $this->Html->link(__('Assign User(s)'), ['controller' => 'ProjectsMembers', 'action' => 'add', $data->id], ['class'=>'button small']) ?> -->
			                    <?= $this->Html->link(__('View'), ['controller' => 'tasks', 'action' => 'view', $data->id, $project->id], ['class'=>'button small']) ?>
			                    <?php 
									echo $this->Html->link(__('Edit'), ['controller' => 'tasks', 'action' => 'edit', $data->id, $project->id], ['class'=>'button small']);
									echo '&nbsp;';
			                    	echo $this->Form->postLink(__('Delete'), ['controller' => 'tasks', 'action' => 'delete', $data->id, $project->id], ['confirm' => __('Are you sure you want to delete # {0}?', $data->name), 'class'=>'button small alert']); 
									
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
				<div class="large-8 columns panel-wrap">
		        <h4><?= __('Project Members') ?></h4>
		        <?php if (!empty($project_members)): ?>
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
							foreach ($project_members as $data): 
							if($data->user->id != $activeUser['id']){
						?>
			            <tr>
			                <td><?= h($i) ?></td>
			                <td><?= $this->Html->link($data->user->name, ['controller' => 'Users', 'action' => 'view', $data->user->id]); ?></td>
							<!-- <td><?= $data->user->active; ?></td> -->
			                <td class="actions">
			                    <!-- <?= $this->Html->link(__('View'), ['controller' => 'ProjectsMembers', 'action' => 'view', $data->id], ['class'=>'button small']) ?> -->
			                    <?php 
									if($activeUser['role_id'] == 1 || $activeUser['role_id'] == 2){
										echo $this->Form->postLink(__('Remove'), ['controller' => 'ProjectsMembers', 'action' => 'delete', $data->id], ['confirm' => __('Are you sure you want to remove {0}?', $data->user->name), 'class'=>'button small alert']); 
									}
								?>
			                </td>
			            </tr>
			            <?php 
								}
							$i++;
							endforeach; 
						?>
					</tbody>
		        </table>
		        <?php endif; ?>
				</div>
				<div class="large-12 columns panel-wrap">
				<?php
					$comment_cat = array(1, 2);
				?>
		        <h4><?= __('Project Comments • '.$this->cell('Misc::count', ['Comments', 'comment_src', $comment_cat])->render('count')) ?></h4>
		        <?php if (!empty($comments)): ?>
		        <table id="general-table-ii" class="display" width="100%" cellpadding="0" cellspacing="0">
					<thead>
			            <tr>
			                <th><?= __('#') ?></th>
			                <th><?= __('User') ?></th>
							<th><?= __('Comment') ?></th>
							<th><?= __('Comment Source') ?></th>
							<th><?= __('Date Posted') ?></th>
							<!-- <th><?= __('Status') ?></th> -->
							<th class="actions"><?= __('Actions') ?></th>
			            </tr>
					</thead>
					<tbody>
			            <?php 
							$i=1;
							foreach ($comments as $data): 
							if($data->user->id != $activeUser['id']){
						?>
			            <tr>
			                <td><?= h($i) ?></td>
			                <td><?= $this->Html->link($data->user->name, ['controller' => 'Users', 'action' => 'view', $data->user->id]); ?></td>
							<td><?= $data->comment; ?></td>
							<td><?php 
									if($data->comment_src == 1){
										echo 'Project';
									}
									
									if($data->comment_src == 2){
										echo 'Task';
									}	
								?>
							</td>
							<td><?= $data->created; ?></td>
			                <td class="actions">
			                    <?php 
									echo $this->Form->postLink(__('Remove'), ['controller' => 'ProjectsMembers', 'action' => 'delete', $data->id], ['confirm' => __('Are you sure you want to remove {0}?', $data->user->name), 'class'=>'button small alert']); 
								?>
			                </td>
			            </tr>
			            <?php 
								}
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
</div>