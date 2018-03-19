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
$this->assign('title', 'Workgroups');
echo $this->element('head');
?>
<main id="mains" class="row events-main">
    <div class="column small-12 large-9">
        <section class="large-12 columns event-section">
            <div class="large-12 columns event-heading">
                <h1 class="column small-2">Workgroups</h1>
                <div class="column small-10 text-right">
					<?php
						echo $this->Html->link(__('<span class="fa fa-list"></span> Workgroups'), ['controller' => 'workgroups', 'action' => 'index'], ['class'=>'button', 'escape'=>false]);
						if($activeUser['role_id'] == 1 || $department_details->department_role == 2 || $department_details->department_role == 3 || $workgroup->user_id == $activeUser['id']){
							echo $this->Html->link(__('<span class="fa fa-plus"></span> Create Workgroup'), ['controller' => 'workgroups', 'action' => 'add'], ['class'=>'button', 'escape'=>false]);
							echo $this->Html->link(__('<span class="fa fa-plus"></span> Edit Workgroup'), ['controller' => 'workgroups', 'action' => 'edit', $workgroup->id], ['class'=>'button', 'escape'=>false]);
							echo $this->Form->postLink(
				                __('Delete'),
				                ['action' => 'delete', $workgroup->id],
				                ['confirm' => __('Are you sure you want to delete # {0}?', $workgroup->name), 'class'=>'button alert']
				            );
						}
						
						if($workgroup->user_id != $activeUser['id'] && $workgroup->approve_members == 1 && !$check_join){
						    echo $this->Form->create($workgroupsMember, ['url'=>['action'=>'join']]);
							echo $this->Form->hidden('user_id', ['value'=>$activeUser['id']]);
							echo $this->Form->hidden('workgroup_id', ['value' => $workgroup->id]);
						    echo $this->Form->button(__('Join'), ['class'=>'button']);
						    echo $this->Form->end();
						}
					?>
				</div>
            </div>
			<div class="large-12 columns event-content">
				<nav aria-label="You are here:" role="navigation">
				  <ul class="breadcrumbs">
				    <li><?= $this->Html->link(__('Workgroups'), ['controller' => 'workgroups', 'action' => 'index'], ['escape'=>false]); ?></li>
				    <li><?= __($workgroup->name); ?></li>
				  </ul>
				</nav>
				<div class="large-12 columns">
					<h4><?= $workgroup->name ?></h4>
					<div class="large-4 columns">
						<?php
							echo '<h6><strong>Created by:</strong> '.$workgroup->user->name.'</h6>'; 
						?>
					</div>
					<div class="large-4 columns">
						<?php
							echo '<h6><strong>Content Access:</strong> ';
							if($workgroup->content_access == 1){
								echo 'All';
							}else{
								echo 'Group Members';
							}
							echo '</h6>'; 
						?>
					</div>
					<div class="large-4 columns">
						<?php
							echo '<h6><strong>Approve Members:</strong> ';
							if($workgroup->approve_members == 1){
								echo 'Yes';
							}else{
								echo 'No';
							}
							echo '</h6>'; 
						?>
					</div>
					<div class="large-12 columns">
						<?= $workgroup->description ?>
					</div>
					<div class="large-12 columns misc-wrap text-right">
						<?php
							$comment_cat = array(3);
							echo $this->Html->link(__('<span class="fa fa-folder"></span> Files • 0'), ['controller' => 'media', 'action' => 'index', $workgroup->id], ['class'=>'', 'escape'=>false]);
							echo $this->Html->link(__('<span class="fa fa-comments"></span> Comments • '.$this->cell('Misc::count', ['Comments', 'comment_src', $comment_cat])->render('count')), ['controller' => 'workgroups', 'action' => 'comments', $workgroup->id], ['class'=>'', 'escape'=>false]);
						?>
					</div>
					
					<div class="large-12 columns portal-sp">
						<?php
							if($activeUser['role_id'] == 1 || $department_details->department_role == 2 || $department_details->department_role == 3 || $workgroup->user_id == $activeUser['id']){
								if($workgroup->is_approved == 2){
									echo $this->Html->link(__('<span class="fa fa-plus"></span> Add Members'), ['controller' => 'WorkgroupsMembers', 'action' => 'add', $workgroup->id], ['class'=>'button active', 'escape'=>false]);
								}
							}
							
						?>
				        <h5><?= __('Workgroup Members') ?></h5>
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
									foreach ($workgroup_members as $data): 
									//if($data->user->id != $activeUser['id']){
								?>
					            <tr>
					                <td><?= h($i) ?></td>
					                <td><?= $this->Html->link($data->user->name, ['controller' => 'Users', 'action' => 'view', $data->user->id]); ?></td>
									<!-- <td><?= $data->user->active; ?></td> -->
					                <td class="actions">
					                    <!-- <?= $this->Html->link(__('View'), ['controller' => 'WorkgroupsMembers', 'action' => 'view', $data->id], ['class'=>'button small']) ?> -->
					                    <?php 
											if($activeUser['role_id'] == 1 || $department_details->department_role == 2 || $department_details->department_role == 3 || $workgroup->user_id == $activeUser['id']){
												echo $this->Form->postLink(__('Remove'), ['controller' => 'WorkgroupsMembers', 'action' => 'delete', $data->id], ['confirm' => __('Are you sure you want to remove {0}?', $data->user->name), 'class'=>'button small alert']); 
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
			</div>
        </section>
    </div>

    <aside class="column small-12 large-3 pad-aside">
        <?php echo $this->element('aside'); ?>
    </aside>
</main>
<?php echo $this->element('footer'); ?>