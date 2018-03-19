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
$this->assign('title', 'News');
?>

<div class="off-canvas-content" data-off-canvas-content>
	<!-- Your page content lives here -->
	<div id="mains" class="medium-12 columns admin-content">
		<?= $this->element('admin'.DS.'topbar') ?>
		<div class="large-12 columns main-admin-content">
			<div class="large-12 columns panel-wrap action-bar">
				<?= $this->Html->link(__('<span class="fa fa-list-ol"></span> List News'), ['action' => 'index'], ['class'=>'button active', 'escape'=>false]) ?>
			    <?= $this->Html->link(__('<span class="fa fa-plus"></span> Add News'), ['action' => 'add'], ['class'=>'button', 'escape'=>false]) ?>
				<?= $this->Html->link(__('<span class="fa fa-list-ol"></span> List Categories'), ['controller'=>'Categories', 'action' => 'index'], ['class'=>'button', 'escape'=>false]) ?>
			    <?= $this->Html->link(__('<span class="fa fa-plus"></span> Add Categories'), ['controller'=>'Categories', 'action' => 'add'], ['class'=>'button', 'escape'=>false]) ?>
			</div>
			<div class="large-12 columns panel-wrap">
			    <table id="general-table" class="display" width="100%" cellpadding="0" cellspacing="0">
			        <thead>
			            <tr>
			                <th ><?= __('#') ?></th>
			                <th ><?= __('Category') ?></th>
			                <th ><?= __('Title') ?></th>
			                <th ><?= __('Created') ?></th>
			                <th ><?= __('Modified') ?></th>
			                <th  class="actions"><?= __('Actions') ?></th>
			            </tr>
			        </thead>
			        <tbody>
			            <?php foreach ($news as $news): ?>
			            <tr>
			                <td><?= $this->Number->format($news->id) ?></td>
			                <td><?= $news->has('category') ? $this->Html->link('<span class="label secondary">'.$news->category->name.'</span>', ['controller' => 'Categories', 'action' => 'view', $news->category->id], ['escape'=>false]) : '' ?></td>
			                <td><?= h($news->title) ?></td>
			                <td><?= h($news->created) ?></td>
			                <td><?= h($news->modified) ?></td>
			                <td class="actions">
			                    <?= $this->Html->link(__('View'), ['action' => 'view', $news->id], ['class'=>'button small']) ?>
			                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $news->id], ['class'=>'button small']) ?>
			                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $news->id], ['confirm' => __('Are you sure you want to delete # {0}?', $news->id), 'class'=>'button small alert']) ?>
			                </td>
			            </tr>
			            <?php endforeach; ?>
			        </tbody>
			    </table>
			</div>
		</div>
	</div>
</div>