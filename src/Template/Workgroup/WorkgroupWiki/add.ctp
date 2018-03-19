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
$this->assign('title', 'Wiki');
echo $this->element('workgroup/head');
?>
<main id="mains" class="large-12 columns main-content">
	<div class="row">
	    <div class="column small-12 large-9">
	        <section class="large-12 columns event-section">
	            <div class="large-12 columns event-heading">
	                <h1 class="column medium-4">Wiki</h1>
		            <div class="column medium-8 text-right">
						<?php
							echo $this->Html->link(__('Cancel'), ['controller' => 'WorkgroupWiki', 'action' => 'index'], ['class'=>'button', 'escape'=>false]);
						?>
					</div>
	            </div>
				<div class="large-12 columns event-content">
					<nav aria-label="You are here:" role="navigation">
					  <ul class="breadcrumbs">
					    <li><?= $this->Html->link(__('Wiki'), ['controller' => 'WorkgroupWiki', 'action' => 'index'], ['escape'=>false]); ?></li>
					    <li><?= __("Add Wiki"); ?></li>
					  </ul>
					</nav>
					<div class="large-12 columns">
						<div class="large-12 columns portal-sp">
							<div class="tasks form large-9 medium-8 columns content">
							    <?= $this->Form->create($wiki) ?>
							    <fieldset>
							        <?php
										echo '<div class="medium-12 columns pad-col-x">';
							            echo $this->Form->control('title');
										echo '</div>';
										echo '<div class="medium-12 columns pad-col-x">';
							            echo $this->Form->control('content', ['class'=>'editor']);
										echo $this->Form->hidden('user_id', ['value'=>$activeUser['id']]);
										echo '</div>';
							        ?>
							    </fieldset>
							    <?= $this->Form->button(__('Add'), ['class'=>'button']) ?>
							    <?= $this->Form->end() ?>
							</div>
						</div>
					</div>
				</div>
	        </section>
	    </div>

	    <aside class="column small-12 large-3 pad-aside">
	        <?php echo $this->element('work_aside'); ?>
	    </aside>
	</div>
</main>
<?php echo $this->element('footer'); ?>
