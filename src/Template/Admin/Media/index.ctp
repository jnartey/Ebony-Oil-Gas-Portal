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
$this->assign('title', 'Media');
?>

<div class="off-canvas-content" data-off-canvas-content>
	<!-- Your page content lives here -->
	<div id="mains" class="medium-12 columns admin-content">
		<?= $this->element('admin'.DS.'topbar') ?>
		<div class="large-12 columns main-admin-content">
			<div class="large-12 columns panel-wrap action-bar">
				<?= $this->Html->link(__('<span class="fa fa-list-ol"></span> List Menu'), ['controller'=>'Media', 'action' => 'index'], ['class'=>'button active', 'escape'=>false]) ?>
			    <?= $this->Html->link(__('<span class="fa fa-plus"></span> Add Menu'), ['controller'=>'Media', 'action' => 'add'], ['class'=>'button', 'escape'=>false]) ?>
			</div>
			<div class="large-12 columns panel-wrap">
				<h3><?= __('Media') ?></h3>
			    <table id="general-table" class="display" width="100%" cellpadding="0" cellspacing="0">
			        <thead>
			            <tr>
			                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
			                <th scope="col"><?= __('Name') ?></th>
			                <th scope="col"><?= $this->Paginator->sort('uploaded_by') ?></th>
			                <th scope="col"><?= $this->Paginator->sort('department_id') ?></th>
			                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
			                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
			                <th scope="col" class="actions"><?= __('Actions') ?></th>
			            </tr>
			        </thead>
			        <tbody>
			            <?php foreach ($media as $media): ?>
			            <tr>
			                <td><?= $this->Number->format($media->id) ?></td>
			                <td>
								<?php
									if($media->folder_name){
										echo $media->folder_name;
									}elseif($media->file_name){
										echo $media->file_name;
									}
								?>
							</td>
			                <!-- <td><?= $this->Number->format($media->size) ?></td> -->
			                <td><?= $media->user->name ?></td>
			                <td><?= $media->has('department') ? $this->Html->link($media->department->name, ['controller' => 'Departments', 'action' => 'view', $media->department->id]) : '' ?></td>
			                <td><?= h($media->created) ?></td>
			                <td><?= h($media->modified) ?></td>
			                <td class="actions">
			                    <!-- <?= $this->Html->link(__('View'), ['action' => 'view', $media->id]) ?>
			                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $media->id]) ?>
			                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $media->id], ['confirm' => __('Are you sure you want to delete # {0}?', $media->id)]) ?> -->
			                </td>
			            </tr>
			            <?php endforeach; ?>
			        </tbody>
			    </table>
			</div>
		</div>
	</div>
</div>
