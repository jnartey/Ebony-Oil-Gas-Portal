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
<main id="mains" class="large-12 columns main-content">
	<div class="row workgroup-main">
	    <div class="column small-12 large-9">
	        <section class="workgroup-section">
	            <h1>Workgroups</h1>

	            <div class="workgroup-separation">
	                <p id="my-workgroup">My Workgroups</p>
					<?php
						echo $this->Html->link(__('<span class="fa fa-plus"></span> Create workgroup'), ['controller' => 'workgroups', 'action' => 'add'], ['class'=>'button create-workgroup', 'escape'=>false]);
					?>
	            </div>

	            <div class="large-12 columns my-workgroup-list">
					
						<div class="workgroup-sub-t">
							<h6>Created by you</h6>
						</div>
						<?php
						
							if(!empty($my_workgroups_ch)){
								foreach($my_workgroups as $data):
									echo '<article class="my-workgroup row">';
									echo '<a href="'.$this->Url->build(DS.'workgroups'.DS.'view'.DS.$data->id, true).'" class="workgroup-avatar column medium-6"><div>';
									echo '<span></span>';
									echo '<h3>'.$data->name.'</h3>';
									echo '</div></a>';
									echo '<div class="medium-6 columns workgroup-description">';
									echo __($data->description);
									
									if($activeUser['role_id'] == 1 || $activeUser['role_id'] == 2 || $data->user_id == $activeUser['id']){
										echo '<div class="large-12 ex-controls">';
										echo $this->Html->link(__('View'), ['controller' => 'workgroups', 'action' => 'view', $data->id], ['class'=>'', 'escape'=>false]);
										echo ' • ';
										echo $this->Html->link(__('Edit'), ['controller' => 'workgroups', 'action' => 'edit', $data->id], ['class'=>'', 'escape'=>false]);
										echo ' • ';
										echo $this->Form->postLink(__('Delete'), ['controller' => 'workgroups', 'action' => 'delete', $data->id], ['confirm' => __('Are you sure you want to delete {0}?', $data->name), 'class'=>'']); 
										echo '</div>';
									}
									if($data->is_approved == 2){
										echo '<div class="label success">Approved</div><br />';
									}elseif($data->is_approved == 1){
										echo '<div class="label primary">Pending approval</div><br />';
									}
									
									echo '</div></article>';
								endforeach;
							}else{
								echo '<div class="workgroup-content">';
								echo 'No workgroup created by you';
								echo '</div>';
							}
						?>
					
	            </div>

	            <div class="large-12 columns my-workgroup-list">
					<article class="my-workgroup row">
					<div class="workgroup-sub-t">
						<h6>Joined</h6>
					</div>
					<?php
						if(!empty($groups_ch)){
							$w = 1;
							foreach($groups as $data):
								if($data->workgroup->is_approved == 2){
									echo '<article class="my-workgroup row">';
									echo '<a href="'.$this->Url->build(DS.'workgroup'.DS.'?workgroup='.$data->workgroup->id, true).'" class="workgroup-avatar column medium-6"><div>';
									echo '<span></span>';
									echo '<h3>'.$data->workgroup->name.'</h3>';
									echo '</div></a>';
									echo '<div class="medium-6 columns workgroup-description">';
									echo __($data->workgroup->description);
									echo '</div></article>';
								}else{
									if($w == 1){
										echo '<div class="workgroup-content">';
										echo 'No workgroups';
										echo '</div>';
									}
								}
								$w++;
							endforeach;
						}else{
							echo '<div class="workgroup-content">';
							echo 'No workgroups';
							echo '</div>';
						}
					?>
					</atricle>
	            </div>

	            <div class="large-12 columns workgroup-sorting">
	                <h6>All Workgroups</h6>
	                <div class="sort-area">
						<?php
							if($workgroups_ch){
								foreach($workgroups as $workgroup):
									echo '<div class="column small-6 sort-element float-left">';
									echo '<a href="'.$this->Url->build(DS.'workgroup'.DS.'?workgroup='.$workgroup->id, true).'">';
									echo '<span style="background-color: #004A80"></span><h3>'.$workgroup->name.'</h3>';
									echo '</a>';
									echo '</div>';
								endforeach;
							}else{
								echo '<p>&nbsp; No workgroups</p>';
							}
						?>
	                </div>
				    <div class="large-12 columns paginator">
				        <ul class="pagination">
				            <?= $this->Paginator->first('<< ' . __('first')) ?>
				            <?= $this->Paginator->prev('< ' . __('previous')) ?>
				            <?= $this->Paginator->numbers() ?>
				            <?= $this->Paginator->next(__('next') . ' >') ?>
				            <?= $this->Paginator->last(__('last') . ' >>') ?>
				        </ul>
				        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
				    </div>
	            </div>
	        </section>
	    </div>
	    <aside class="column small-12 large-3 pad-aside">
	        <?php echo $this->element('aside'); ?>
	    </aside>
	</div>
</main>
<?php echo $this->element('footer'); ?>