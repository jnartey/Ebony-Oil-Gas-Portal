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
$this->assign('title', 'Wiki');
echo $this->element('department/head');
?>
<main id="mains" class="large-12 columns main-content">
	<div class="row">
	    <div class="column small-12 large-9">
	        <section class="large-12 columns event-section">
	            <div class="medium-12 columns event-heading">
	                <h1 class="column medium-4">Wiki</h1>
		            <div class="column medium-8 text-right">
						<?php
							if($activeUser['role_id'] == 1 || $department_details->department_role == 2 || $department_details->department_role == 3){
								echo $this->Html->link(__('Add Wiki'), ['controller' => 'DepartmentWiki', 'action' => 'add'], ['class'=>'button', 'escape'=>false]);
							}
						?>
					</div>
	            </div>
				<div class="large-12 columns event-content">
					<div class="large-12 columns">
						<div class="large-12 columns portal-sp space-button">
					        <table id="general-table" class="display" width="100%" cellpadding="0" cellspacing="0">
								<thead>
						            <tr>
						                <th><?= __('#') ?></th>
						                <th><?= __('Title') ?></th>
										<th><?= __('Date') ?></th>
						                <th class="actions"><?= __('Actions') ?></th>
						            </tr>
								</thead>
								<tbody>
						            <?php 
										$i=1;
										foreach ($wiki as $data): 
									?>
						            <tr>
						                <td><?= h($i) ?></td>
						                <td><?= $this->Html->link($data->title, ['controller' => 'DepartmentWiki', 'action' => 'view', $data->id]); ?></td>
										<td><?= $data->created; ?></td>
						                <td class="actions">
						                    <?php 
											echo $this->Html->link(__('View'), ['controller' => 'DepartmentWiki', 'action' => 'view', $data->id], ['class'=>'button small']);
										
											if($activeUser['role_id'] == 1 || $department_details->department_role == 2 || $department_details->department_role == 3){
													if($data->user_id == $activeUser['id']){
														echo $this->Html->link(__('Edit'), ['controller' => 'DepartmentWiki', 'action' => 'edit', $data->id], ['class'=>'button small']);
														echo $this->Form->postLink(__('Delete'), ['controller' => 'DepartmentWiki', 'action' => 'delete', $data->id], ['confirm' => __('Are you sure you want to delete # {0}?', $data->title), 'class'=>'button small alert']);
													} 
												}
											?>
						                </td>
						            </tr>
						            <?php 
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
	        <?php echo $this->element('dpt_aside'); ?>
	    </aside>
	</div>
</main>
<?php echo $this->element('footer'); ?>