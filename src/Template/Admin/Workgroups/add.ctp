<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Workgroups'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Workgroups Members'), ['controller' => 'WorkgroupsMembers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Workgroups Member'), ['controller' => 'WorkgroupsMembers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="workgroups form large-9 medium-8 columns content">
    <?= $this->Form->create($workgroup) ?>
    <fieldset>
        <legend><?= __('Add Workgroup') ?></legend>
        <?php
            echo $this->Form->control('description');
            echo $this->Form->control('created_by');
            echo $this->Form->control('created_on');
            echo $this->Form->control('approve_members');
            echo $this->Form->control('content_access');
            echo $this->Form->control('is_approved');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
