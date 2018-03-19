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
$this->assign('title', 'News');
echo $this->element('department/head');
?>
<main id="mains" class="large-12 columns main-content">
	<div class="row">
	    <div class="column small-12 large-9">
	        <section class="large-12 columns event-section">
	            <div class="large-12 columns event-heading">
	                <h1 class="column small-3">News</h1>
	                <div class="column small-9 text-right">
						<?php
							echo $this->Html->link(__('<span class="fa fa-list"></span> All News'), ['controller' => 'DepartmentNews', 'action' => 'index'], ['class'=>'button', 'escape'=>false]);
							if($activeUser['role_id'] == 1 || $department_details->department_role == 2 || $department_details->department_role == 3){
								echo $this->Html->link(__('<span class="fa fa-list"></span> My News'), ['controller' => 'DepartmentNews', 'action' => 'my_news'], ['class'=>'button', 'escape'=>false]);
								echo $this->Html->link(__('<span class="fa fa-plus"></span> Add News'), ['controller' => 'DepartmentNews', 'action' => 'add'], ['class'=>'button active', 'escape'=>false]);
							}
						?>
					</div>
	            </div>
				<div class="large-12 columns event-content">
					<nav aria-label="You are here:" role="navigation">
					  <ul class="breadcrumbs">
					    <li><?= $this->Html->link(__('News'), ['controller' => 'events', 'action' => 'index'], ['escape'=>false]); ?></li>
					    <li><?= __('Add News'); ?></li>
					  </ul>
					</nav>
					<div class="large-12 columns">
					    <?= $this->Form->create($news) ?>
					        <?php
								echo '<div class="medium-12 columns pad-col-x">';
					            echo $this->Form->control('category_id');
								echo '</div>';
								echo '<div class="medium-12 columns pad-col-x">';
					            echo $this->Form->control('title');
								echo '</div>';
								echo '<div class="medium-12 columns pad-col-x">';
					            echo $this->Form->control('summary');
								echo '</div>';
								echo '<div class="medium-12 columns pad-col-x">';
					            echo $this->Form->control('story', ['class'=>'editor']);
								echo $this->Form->hidden('user_id', ['value'=>$activeUser['id']]);
								echo '</div>';
					            //echo $this->Form->control('image');
					        ?>
							<div class="medium-12 columns pad-col-x">
							<?= $this->Form->button(__('Add'), ['class'=>'button']) ?>
							</div>
						    <?= $this->Form->end() ?>
					</div>
				</div>
	        </section>
	    </div>

	    <aside class="column small-12 large-3 pad-aside">
	        <?php echo $this->element('dpt_aside'); ?>
	    </aside>
	</div>
</main>
<?php echo $this->element('footer'); ?>