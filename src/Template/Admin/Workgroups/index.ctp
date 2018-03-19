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
$this->assign('title', 'Workgroups');
?>

<div class="off-canvas-content" data-off-canvas-content>
	<!-- Your page content lives here -->
	<div id="mains" class="medium-12 columns admin-content">
		<?= $this->element('admin'.DS.'topbar') ?>
		<div class="large-12 columns main-admin-content">
			<div class="large-12 columns panel-wrap action-bar">
				<?= $this->Html->link(__('<span class="fa fa-list-ol"></span> List Workgroups'), ['controller'=>'Workgroups', 'action' => 'index'], ['class'=>'button active', 'escape'=>false]) ?>
			    <!-- <?= $this->Html->link(__('<span class="fa fa-plus"></span> Add Workgroup'), ['controller'=>'Workgroups', 'action' => 'add'], ['class'=>'button', 'escape'=>false]) ?>
				<?= $this->Html->link(__('<span class="fa fa-list-ol"></span> List Workgroups Members'), ['controller'=>'WorkgroupsMembers', 'action' => 'index'], ['class'=>'button', 'escape'=>false]) ?> -->
			</div>
			<div class="large-12 columns panel-wrap">
				<h3><?= __('Workgroups') ?></h3>
			    <table id="general-table" class="display" width="100%" cellpadding="0" cellspacing="0">
			        <thead>
			            <tr>
			                <th scope="col"><?= __('id') ?></th>
			                <th scope="col"><?= __('Created by') ?></th>
			                <th scope="col"><?= __('Approve Members') ?></th>
			                <th scope="col"><?= __('Content Access') ?></th>
			                <th scope="col"><?= __('Approved') ?></th>
			                <th scope="col"><?= __('Created') ?></th>
			                <th scope="col"><?= __('Modified') ?></th>
			                <th scope="col" class="actions"><?= __('Actions') ?></th>
			            </tr>
			        </thead>
			        <tbody>
			            <?php foreach ($workgroups as $workgroup): ?>
			            <tr>
			                <td><?= $this->Number->format($workgroup->id) ?></td>
			                <td><?= $workgroup->user->name ?></td>
			                <td>
								<?php 
									if($workgroup->approve_members == 1){
										echo '<div class="label secondary">Any site member can join</div><br />';
									}elseif($workgroup->approve_members == 2){
										echo '<div class="label secondary">Only approved members can join</div><br />';
									}elseif($workgroup->approve_members == 3){
										echo '<div class="label secondary">Only approved members can join <br />except for invited members</div><br />';
									}
								?>
							</td>
			                <td>
								<?php 
									if($workgroup->content_access == 1){
										echo '<div class="label secondary">Anybody can view the content</div><br />';
									}elseif($workgroup->content_access == 2){
										echo '<div class="label secondary">Site members can view the content</div><br />';
									}elseif($workgroup->content_access == 3){
										echo '<div class="label secondary">Only group members can view the content</div><br />';
									}
								?>
							</td>
			                <td>
								<?php
									if($workgroup->is_approved == 2){
										echo '<div class="label success">Approved</div><br />';
									}elseif($workgroup->is_approved == 1){
										echo '<div class="label primary">Pending approval</div><br />';
									}
								?>
							</td>
			                <td><?= h($workgroup->created) ?></td>
			                <td><?= h($workgroup->modified) ?></td>
			                <td class="actions">
			                    <!-- <?= $this->Html->link(__('View'), ['action' => 'view', $workgroup->id], ['class'=>'button small']) ?>
			                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $workgroup->id], ['class'=>'button small']) ?> -->
			                    <?php 
									
									if($workgroup->is_approved == 1){
										echo $this->Form->postLink(__('Approve'), ['action' => 'approve', $workgroup->id, 2], ['confirm' => __('Are you sure you want to approve ', $workgroup->name.'?'), 'class'=>'button small primary']);
									}elseif($workgroup->is_approved == 2){
										echo $this->Form->postLink(__('Disable'), ['action' => 'approve', $workgroup->id, 1], ['confirm' => __('Are you sure you want to disable ', $workgroup->name.'?'), 'class'=>'button small secondary']);
								}
									
								?>
								<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $workgroup->id], ['confirm' => __('Are you sure you want to delete # {0}?', $workgroup->id), 'class'=>'button small alert']) ?>
			                </td>
			            </tr>
			            <?php endforeach; ?>
			        </tbody>
			    </table>
			</div>
		</div>
	</div>
</div>