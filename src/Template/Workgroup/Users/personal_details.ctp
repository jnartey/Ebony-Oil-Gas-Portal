<?php
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;

$this->layout = 'ajax';
?>

<div class="medium-6 columns pad-col">
	<h6><?= __('First Name') ?></h6>
	<?= h($user->first_name) ?>
</div>
<div class="medium-6 columns pad-col">
	<h6><?= __('Last Name') ?></h6>
	<?= h($user->last_name) ?>
</div>
<div class="medium-6 columns pad-col">
	<h6><?= __('Date of Birth') ?></h6>
	<?= h($user->date_of_birth) ?>
</div>
<?php if($activeUser['role_id'] == 1){ ?>
<div class="medium-6 columns pad-col">
	<h6><?= __('Username') ?></h6>
	<?= h($user->username) ?>
</div>
<?php } ?>
<div class="medium-6 columns pad-col">
	<h6><?= __('Position') ?></h6>
	<?php
		if($user->position){
			echo h($user->position);
		}else{
			echo '-';
		}
	?>
</div>
<div class="medium-6 columns pad-col">
	<h6><?= __('Email') ?></h6>
	<?= h($user->email) ?>
</div>
<div class="medium-6 columns pad-col">
	<h6><?= __('Employee ID') ?></h6>
	<?= h($user->employee_id) ?>
</div>
<div class="medium-6 columns pad-col">
	<h6><?= __('Grade') ?></h6>
	<?= h($user->grade) ?>
</div>
<div class="medium-6 columns pad-col">
	<h6><?= __('Phone Number') ?></h6>
	<?php
		if($user->phone_number){
			echo h($user->phone_number);
		}else{
			echo '-';
		}
	?>
</div>
<div class="medium-12 columns pad-col text-left">
	<?php 
		if($user->role_id === 1 || $activeUser['id'] === $user->id){
			echo $this->Html->link(__('<span class="fa fa-pencil"></span> Edit'), ['controller' => 'users', 'action' => '#'], ['class' => 'button personal-details-edit', 'escape'=>false]);
		}
	?>
</div>