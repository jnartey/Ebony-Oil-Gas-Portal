<?php
/**
  * @var \App\View\AppView $this
  */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;


$this->layout = 'admin';
$this->assign('title', 'Users');
?>

<div class="off-canvas-content" data-off-canvas-content>
	<!-- Your page content lives here -->
	<div id="mains" class="medium-12 columns admin-content">
		<?= $this->element('admin'.DS.'topbar') ?>
		<div class="large-12 columns main-admin-content">
			<div class="large-12 columns panel-wrap action-bar">
				<?= $this->Html->link(__('<span class="fa fa-list-ol"></span> List Users'), ['action' => 'index'], ['class'=>'button active', 'escape'=>false]) ?>
			    <?= $this->Html->link(__('<span class="fa fa-plus"></span> New User'), ['action' => 'add'], ['class'=>'button', 'escape'=>false]) ?>
				<?= $this->Html->link(__('<span class="fa fa-list-ol"></span> List Roles'), ['controller'=>'Roles', 'action' => 'index'], ['class'=>'button', 'escape'=>false]) ?>
			</div>
			<div class="large-12 columns panel-wrap">
			    <table id="general-table" class="display" width="100%" cellpadding="0" cellspacing="0">
			        <thead>
			            <tr>
			                <th><?= __('#') ?></th>
			                <th><?= __('Username') ?></th>
			                <th><?= __('First Name') ?></th>
			                <th><?= __('Last Name') ?></th>
			                <th><?= __('Email') ?></th>
			                <th><?= __('Employee ID') ?></th>
			                <th><?= __('Phone Number') ?></th>
							<th><?= __('Department') ?></th>
			                <th><?= __('Role') ?></th>
			                <th><?= __('Active') ?></th>
			                <th class="actions"><?= __('Actions') ?></th>
			            </tr>
			        </thead>
			        <tbody id="live-data">
			            <?php 
							foreach ($users as $user): 
								//if($user->id != $activeUser['id'] && $user['id'] != 1){
						?>
							
			            <tr>
			                <td>
								<?php
									echo '<div class="user-pn">';
									if($user->photo){
										echo $this->Html->link(__('<span class="user-photo" style="background-image: url('.$this->Url->build(DS.'files'.DS.'Users'.DS.'photo'.DS.'medium-'.$user->photo).')"></span>'), ['controller'=>'users', 'action' => 'view', $user->id], ['escape'=>false]);
									}else{
										echo $this->Html->link(__('<span class="user-photo" style="background-image: url('.$this->Url->build('/img/dummy.png', true).')"></span><span>'), ['controller'=>'users', 'action' => 'view', $user->id], ['escape'=>false]);
									}
									echo '</div>';
								?>
							</td>
			                <td><?= h($user->username) ?></td>
			                <td><?= h($user->first_name) ?></td>
			                <td><?= h($user->last_name) ?></td>
			                <td><?= h($user->email) ?></td>
			                <td><?= h($user->employee_id) ?></td>
			                <td><?= h($user->phone_number) ?></td>
			                <!-- <td><?= h($user->im_account_name) ?></td> -->
							<td>
								<?php 
									if($user->id){
										echo $this->cell('Misc::getDepartments', [$user->id])->render('getDepartments');
									}
								?>
							</td>
			                <td><?= $user->has('role') ? $this->Html->link($user->role->name, ['controller' => 'Roles', 'action' => 'view', $user->role->id]) : '' ?></td>
			                <td><?= $this->cell('Misc::onlineStatus', [$user->id])->render('onlineStatus'); ?></td>
			                <td class="actions">
								<?php
									if($user->employee_of_the_year == 2){
										echo $this->Form->postLink(__('Disable'), ['action' => 'eoy', $user->id, 1], ['confirm' => __('Are you sure you want to disable '.$user->first_name.' '.$user->last_name.' as employee of the year?'), 'class'=>'button small secondary']);
									}else{
										echo $this->Form->postLink(__('Employee of the year'), ['action' => 'eoy', $user->id, 2], ['confirm' => __('Are you sure you want to set '.$user->first_name.' '.$user->last_name.' as employee of the year?'), 'class'=>'button small primary']);
									}
								?>
			                    <?= $this->Html->link(__('View'), ['action' => 'view', $user->id], ['class'=>'button small']) ?>
								<?= '<a class="button small" data-fancybox data-type="ajax" data-src="'.$this->Url->build(DS.'admin'.DS.'users'.DS.'reset_password'.DS.$user->id, true).'" href="javascript:;" class="user-icon">Reset password</a>'; ?>
			                    <!-- <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id], ['class'=>'button small']) ?> -->
								<?php
									if($user->id != $current_user['id']){
								?>
			                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->username), 'class'=>'button small alert']) ?>
								<?php } ?>
			                </td>
			            </tr>
			            <?php 
								//}
							endforeach; 
						?>
			        </tbody>
			    </table>
			    <!-- <div class="paginator">
			        <ul class="pagination">
			            <?= $this->Paginator->first('<< ' . __('first')) ?>
			            <?= $this->Paginator->prev('< ' . __('previous')) ?>
			            <?= $this->Paginator->numbers() ?>
			            <?= $this->Paginator->next(__('next') . ' >') ?>
			            <?= $this->Paginator->last(__('last') . ' >>') ?>
			        </ul>
			        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
			    </div> -->
			</div>
		</div>
	</div>
</div>
<script>
	$(function() {
		function autoRefresh_div() {
		    $("#live-data").load("<?= $this->Url->build(DS.'admin'.DS.'users'.DS.'live_data', true) ?>", function() {
		        setTimeout(autoRefresh_div, 60000);
				//$('#general-table').DataTable({"pageLength": 50});
		    });
		}

		autoRefresh_div();
	});
</script>
