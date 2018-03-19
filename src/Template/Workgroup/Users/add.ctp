<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
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
        <legend><?= __('Add User') ?></legend>
        <?php
            echo $this->Form->control('username');
            echo $this->Form->control('first_name');
            echo $this->Form->control('last_name');
            echo $this->Form->control('email');
            echo $this->Form->control('password');
			echo $this->Form->control('confirm_password');
            echo $this->Form->control('skype_name');
            echo $this->Form->control('phone_number');
            echo $this->Form->control('im_account_name');
            echo $this->Form->control('photo');
            echo $this->Form->control('role_id', ['options' => $roles]);
            echo $this->Form->control('im_status');
            //echo $this->Form->control('active');
            //echo $this->Form->control('is_blocked');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
