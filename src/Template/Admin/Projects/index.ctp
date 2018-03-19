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
			    <!-- <?= $this->Html->link(__('<span class="fa fa-plus"></span> Add Project'), ['controller'=>'Projects', 'action' => 'add'], ['class'=>'button', 'escape'=>false]) ?> -->
			</div>
			<div class="large-12 columns panel-wrap">
				<h3><?= __('Projects') ?></h3>
			    <table id="general-table" class="display" width="100%" cellpadding="0" cellspacing="0">
			        <thead>
			            <tr>
			                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
			                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
			                <th scope="col"><?= $this->Paginator->sort('created_by') ?></th>
			                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
			                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
			                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
			                <th scope="col" class="actions"><?= __('Actions') ?></th>
			            </tr>
			        </thead>
			        <tbody>
			            <?php foreach ($projects as $project): ?>
			            <tr>
			                <td><?= $this->Number->format($project->id) ?></td>
			                <td><?= $this->Html->link(__($project->name), ['action' => 'view', $project->id]) ?></td>
			                <td><?= $project->user->name; ?></td>
			                <td><?php 
									if($project->status == 1){
										echo 'In Progress';
									}
								
									if($project->status == 2){
										echo 'Completed';
									}
								
									if($project->status == 3){
										echo 'Closed';
									}
									
									if($project->status == 3){
										echo 'Cancelled';
									}
								?>
							</td>
			                <td><?= h($project->created) ?></td>
			                <td><?= h($project->modified) ?></td>
			                <td class="actions">
			                    <?= $this->Html->link(__('View'), ['action' => 'view', $project->id], ['class'=>'button small']) ?>
			                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $project->id], ['class'=>'button small']) ?>
			                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $project->id], ['confirm' => __('Are you sure you want to delete # {0}?', $project->id), 'class'=>'button small alert']) ?>
			                </td>
			            </tr>
			            <?php endforeach; ?>
			        </tbody>
			    </table>
			</div>
		</div>
	</div>
</div>
