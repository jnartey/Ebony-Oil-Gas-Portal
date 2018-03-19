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
                ['action' => 'delete', $workgroupsMember->workgroup_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $workgroupsMember->workgroup_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Workgroups Members'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Workgroups'), ['controller' => 'Workgroups', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Workgroup'), ['controller' => 'Workgroups', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="workgroupsMembers form large-9 medium-8 columns content">
    <?= $this->Form->create($workgroupsMember) ?>
    <fieldset>
        <legend><?= __('Edit Workgroups Member') ?></legend>
        <?php
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
