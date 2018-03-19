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
        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->username), 'class'=>'button small alert']) ?>
    </td>
</tr>
<?php 
		//}
	endforeach; 
?>