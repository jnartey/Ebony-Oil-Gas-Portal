<?php
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;

$this->layout = 'default';
$this->assign('title', 'Departments');
echo $this->element('head');
?>
<main id="mains" class="large-12 columns main-content">
	<div class="row workgroup-main">
	    <div class="column small-12 large-9">
	        <section class="workgroup-section">
	            <h1>Departments</h1>

	            <div class="large-12 columns workgroup-separation">
	                <p id="my-workgroup">My Departments</p>
					<?php
						if($activeUser['role_id'] == 1 || $department_details->department_role == 2 || $department_details->department_role == 3){
							if($department){
								echo $this->Html->link(__('<span class="fa fa-plus"></span> Add Staff'), ['controller' => 'DepartmentsMembers', 'action' => 'add', $department->id], ['class'=>'button create-workgroup', 'escape'=>false]);
							}
						}
					?>
	            </div>

	            <div class="large-12 columns my-workgroup-list">
					<?php
						foreach($user_details as $data):
							echo '<article class="my-workgroup row">';
							echo '<a href="'.$this->Url->build('/department/?department='.$data->department->id.'', true).'" class="workgroup-avatar column medium-6"><div>';
							echo '<span></span>';
							echo '<h3>'.$data->department->name.'</h3>';
							echo '</div></a>';
							echo '<div class="medium-6 columns workgroup-description">';
							echo __($data->department->description);
							echo '</div>';
							echo '</article>';
						endforeach;
					?>
	            </div>
				
				<div class="large-12 columns portal-sp">
			        <h5><?= __('Departments Members') ?></h5>
			        <table id="general-table" class="display" width="100%" cellpadding="0" cellspacing="0">
						<thead>
				            <tr>
				                <th><?= __('#') ?></th>
				                <th><?= __('User') ?></th>
								<th><?= __('Department') ?></th>
				                <th class="actions"><?= __('Actions') ?></th>
				            </tr>
						</thead>
						<tbody>
							<?php if($staff){ ?>
				            <?php 
								$i=1;
								foreach ($staff as $data): 
							?>
				            <tr>
				                <td><?= h($i) ?></td>
				                <td><?= $this->Html->link($data->user->name, ['controller' => 'Users', 'action' => 'view', $data->user->id]); ?></td>
								<td><?= $data->department->name; ?></td>
				                <td class="actions">
				                    <?= $this->Html->link(__('View'), ['controller' => 'users', 'action' => 'view', $data->user->id], ['class'=>'button small']); ?>
									<?php 
										if($activeUser['role_id'] == 1){ 
											echo $this->Html->link(__('Edit'), ['controller' => 'DepartmentsMembers', 'action' => 'edit', $data->department_id], ['class'=>'button small']);
											echo '&nbsp;';
											echo $this->Form->postLink(__('Delete'), ['controller' => 'DepartmentsMembers', 'action' => 'delete', $data->department_id], ['confirm' => __('Are you sure you want to delete # {0}?', $data->department_id), 'class'=>'button small alert']);
										}else{
											foreach($user_details as $check):
												if($check->department_id == $data->department_id){
													if($check->department_role == 2 || $check->department_role == 3){
														//echo $this->Html->link(__('Edit'), ['controller' => 'DepartmentsMembers', 'action' => 'edit', $data->department_id], ['class'=>'button small']);
														//echo '&nbsp;';
														//echo $this->Form->postLink(__('Delete'), ['controller' => 'DepartmentsMembers', 'action' => 'delete', $data->department_id], ['confirm' => __('Are you sure you want to delete # {0}?', $data->department_id), 'class'=>'button small alert']);
														
													}
												}
											endforeach;
										}
									?>
				                </td>
				            </tr>
				            <?php 
								$i++;
								endforeach; 
							?>
							<?php } ?>
						</tbody>
			        </table>
				</div>
		        

	            <div class="large-12 columns workgroup-sorting">
					<?php if($activeUser['role_id'] == 1){ ?>
	                <h6>All Departments</h6>
	                <div class="sort-area">
						<?php
							foreach($departments as $department):
								echo '<div class="column small-6 sort-element float-left">';
								echo '<a href="'.$this->Url->build('/department/?department='.$department->id.'', true).'">';
								echo '<span style="background-color: #004A80"></span><h3>'.$department->name.'</h3>';
								echo '</a>';
								echo '</div>';
							endforeach;
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
					<?php } ?>
	            </div>
	        </section>
	    </div>
	    <aside class="column small-12 large-3 pad-aside">
	        <?php echo $this->element('aside'); ?>
	    </aside>
	</div>
</main>
<?php echo $this->element('footer'); ?>
