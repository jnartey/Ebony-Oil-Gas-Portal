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
                <h1 class="column small-3">Workgroups</h1>
                <div class="column small-9 text-right">
					<?php
						if($activeUser['role_id'] == 1 || $department_details->department_role == 2 || $department_details->department_role == 3){
							echo $this->Html->link(__('<span class="fa fa-list"></span> Back'), ['controller' => 'workgroups', 'action' => 'index'], ['class'=>'button', 'escape'=>false]);
						}
					?>
				</div>
            </div>
			<div class="large-12 columns event-content">
				<nav aria-label="You are here:" role="navigation">
				  <ul class="breadcrumbs">
				    <li><?= $this->Html->link(__('Workgroup'), ['controller' => 'workgroups', 'action' => 'index'], ['escape'=>false]); ?></li>
				    <li><?= __("Add Workgroup"); ?></li>
				  </ul>
				</nav>
				<div class="large-12 columns">
					<div class="large-12 columns portal-sp">
						<div class="tasks form large-9 medium-8 columns content">
						    <?= $this->Form->create($workgroup) ?>
						    <fieldset>
							    <?php
									echo '<div class="large-12 columns">';
									echo $this->Form->control('name');
									echo '</div>';
									echo '<div class="large-12 columns">';
									echo $this->Form->control('description');
									echo '</div>';
									echo '<div class="large-12 columns">';
									echo $this->Form->control('approve_members', [
										'type' => 'radio',
										'options' => [1 =>'Any site member can join', 2 => 'Only approved members can join', 3 => 'Only approved members can join except for invited members'],
									]);
									echo '</div>';
									echo '<div class="large-12 columns">';
									echo $this->Form->control('content_access', [
										'type' => 'radio',
										'options' => [1 =>'Anybody can view the content', 2 => 'Site members can view the content', 3 => 'Only group members can view the content'], 
									]);
									echo '</div>';
									echo $this->Form->hidden('user_id', ['value' => $activeUser['id']]);
						        ?>
						    </fieldset>
							<br />
						    <?= $this->Form->button(__('Add Workgroup'), ['class'=>'button']) ?>
						    <?= $this->Form->end() ?>
						</div>
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
