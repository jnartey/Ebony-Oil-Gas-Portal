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
$this->assign('title', 'Banners');
?>

<div class="off-canvas-content" data-off-canvas-content>
	<!-- Your page content lives here -->
	<div id="mains" class="medium-12 columns admin-content">
		<?= $this->element('admin'.DS.'topbar') ?>
		<div class="large-12 columns main-admin-content">
			<div class="large-12 columns panel-wrap action-bar">
				<?= $this->Html->link(__('<span class="fa fa-list-ol"></span> List Banners'), ['controller'=>'Banners', 'action' => 'index'], ['class'=>'button active', 'escape'=>false]) ?>
			    <?= $this->Html->link(__('<span class="fa fa-plus"></span> Add Banner'), ['controller'=>'Banners', 'action' => 'add'], ['class'=>'button', 'escape'=>false]) ?>
			</div>
			<div class="large-12 columns panel-wrap">
				<h3><?= __('Banners') ?></h3>
			    <table id="general-table" class="display" width="100%" cellpadding="0" cellspacing="0">
			        <thead>
			            <tr>
			                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
			                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
			                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
			                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
			                <th scope="col" class="actions"><?= __('Actions') ?></th>
			            </tr>
			        </thead>
			        <tbody>
			            <?php foreach ($banners as $banner): ?>
			            <tr>
			                <td><?= $this->Number->format($banner->id) ?></td>
			                <td><span class="banner-title"><?= h($banner->title).'</span><span class="banner-photo" style="background-image: url('.$this->Url->build(DS.'files'.DS.'Banners'.DS.'banner_image'.DS.'small-'.$banner->banner_image, true).'"></span>' ?></td>
			                <td><?= h($banner->created) ?></td>
			                <td><?= h($banner->modified) ?></td>
			                <td class="actions">
			                    <!-- <?= $this->Html->link(__('View'), ['action' => 'view', $banner->id], ['class'=>'button small']) ?> -->
			                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $banner->id], ['class'=>'button small']) ?>
			                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $banner->id], ['confirm' => __('Are you sure you want to delete # {0}?', $banner->id), 'class'=>'button alert']) ?>
			                </td>
			            </tr>
			            <?php endforeach; ?>
			        </tbody>
			    </table>
			</div>
		</div>
	</div>
</div>
