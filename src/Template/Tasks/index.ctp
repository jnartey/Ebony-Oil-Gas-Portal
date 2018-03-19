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
$this->assign('title', 'Projects');
echo $this->element('head');
?>
<main id="mains" class="row events-main">
    <div class="column small-12 large-9">
        <section class="large-12 columns event-section">
            <div class="large-12 columns event-heading">
                <h1 class="column small-2">Projects</h1>
                <div class="column small-10 text-right">
					<?php
						echo $this->Html->link(__('Projects'), ['controller' => 'projects', 'action' => 'index'], ['class'=>'button', 'escape'=>false]);
					?>
				</div>
            </div>
			<div class="large-12 columns event-content">
				<nav aria-label="You are here:" role="navigation">
				  <ul class="breadcrumbs">
				    <li><?= $this->Html->link(__('Projects'), ['controller' => 'projects', 'action' => 'index'], ['escape'=>false]); ?></li>
					<li><?= __('My Task'); ?></li>
				  </ul>
				</nav>
				<div class="large-12 columns">
					<div class="large-12 columns portal-sp">
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
										$filter_ids = explode(',', $data->user_id);
										if(in_array($activeUser['id'], $filter_ids)){
								?>
					            <tr>
					                <td><?= h($i) ?></td>
					                <td><?= $this->Html->link($data->name, ['controller' => 'tasks', 'action' => 'view', $data->id]); ?></td>
									<td><?php
										echo $this->cell('Misc::getUsers', [$data->user_id])->render('getUsers');
									?></td>
									<td><!-- <?= $data->user->active; ?> --></td>
									<td><?php
										 	echo $this->Html->link(__('<span class="fa fa-comments"></span> '.$this->cell('Misc::count', ['Comments', 'comment_src', 2])->render('count')), ['controller' => 'tasks', 'action' => 'view', $data->project_id], ['class'=>'', 'escape'=>false]); 
											echo '&nbsp;&nbsp;';
											echo $this->Html->link(__('<span class="fa fa-folder"></span> 0'), ['controller' => 'media', 'action' => 'index', $data->project_id, $data->id], ['class'=>'', 'escape'=>false]);
										 ?></td>
					                <td class="actions">
										<!-- <?= $this->Html->link(__('Assign User(s)'), ['controller' => 'ProjectsMembers', 'action' => 'add', $data->id], ['class'=>'button small']) ?> -->
					                    <?= $this->Html->link(__('View'), ['controller' => 'tasks', 'action' => 'view', $data->id], ['class'=>'button small']) ?>
					                    <?php 
											if($activeUser['role_id'] == 1 || $activeUser['role_id'] == 2){
												echo $this->Html->link(__('Edit'), ['controller' => 'tasks', 'action' => 'edit', $data->id], ['class'=>'button small']);
												echo '&nbsp;';
												echo $this->Html->link(__('Review'), ['controller' => 'tasks', 'action' => 'review', $data->id, $activeUser['id']], ['class'=>'button small']);
												echo '&nbsp;';
						                    	echo $this->Form->postLink(__('Delete'), ['controller' => 'tasks', 'action' => 'delete', $data->id], ['confirm' => __('Are you sure you want to delete # {0}?', $data->name), 'class'=>'button small alert']); 
											}else{
												//echo $this->Html->link(__('Set status'), ['controller' => 'tasks', 'action' => 'status', $data->id, $activeUser['id']], ['class'=>'button small']);
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