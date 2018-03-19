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
$this->assign('title', 'Media');
?>

<div class="large-12 media media-upload">
    <?= $this->Form->create($media) ?>
    <fieldset>
        <h5><?= __('Create folder') ?></h5>
        <?php
            echo $this->Form->control('folder_name');
			$options = array(3=>'Department only');
            echo $this->Form->control('media_access',['options'=>$options, 'type'=>'radio', 'default'=>3]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Create folder'), ['class'=>'button']) ?>
    <?= $this->Form->end() ?>
</div>