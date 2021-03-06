<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $user->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Roles'), ['controller' => 'Roles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Role'), ['controller' => 'Roles', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Departments Members'), ['controller' => 'DepartmentsMembers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Departments Member'), ['controller' => 'DepartmentsMembers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Library Permissions'), ['controller' => 'LibraryPermissions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Library Permission'), ['controller' => 'LibraryPermissions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Projects Members'), ['controller' => 'ProjectsMembers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Projects Member'), ['controller' => 'ProjectsMembers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Workgroups Members'), ['controller' => 'WorkgroupsMembers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Workgroups Member'), ['controller' => 'WorkgroupsMembers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Edit User') ?></legend>
        <?php
            echo $this->Form->control('username');
            echo $this->Form->control('first_name');
            echo $this->Form->control('last_name');
            echo $this->Form->control('email');
            //echo $this->Form->control('password');
			//echo $this->Form->control('confirm_password');
            echo $this->Form->control('skype_name');
            echo $this->Form->control('phone_number');
            echo $this->Form->control('im_account_name');
            echo $this->Form->control('photo');
            echo $this->Form->control('role_id', ['options' => $roles]);
            echo $this->Form->control('im_status');
            //echo $this->Form->control('active');
            echo $this->Form->control('is_blocked');
        ?>
	    <?= $this->Form->button(__('Submit')) ?>
	    <?= $this->Form->end() ?>
    </fieldset>
    
	
	<?= $this->Form->create($user, ['url' => ['action' => 'change_password']]) ?> 
	<fieldset> 
		<legend><?= __('Change password') ?></legend> 
		<?= $this->Form->input('old_password',['type' => 'password' , 'label'=>'Old password'])?> 
		<?= $this->Form->input('password1',['type'=>'password' ,'label'=>'Password']) ?> 
		<?= $this->Form->input('password2',['type' => 'password' , 'label'=>'Repeat password'])?> 
		<?= $this->Form->button(__('Save')) ?> 
		<?= $this->Form->end() ?> 
	</fieldset>
</div>
