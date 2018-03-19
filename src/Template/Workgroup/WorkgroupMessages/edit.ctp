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
                ['action' => 'delete', $workgroupMessage->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $workgroupMessage->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Workgroup Messages'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Workgroups'), ['controller' => 'Workgroups', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Workgroup'), ['controller' => 'Workgroups', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="workgroupMessages form large-9 medium-8 columns content">
    <?= $this->Form->create($workgroupMessage) ?>
    <fieldset>
        <legend><?= __('Edit Workgroup Message') ?></legend>
        <?php
            echo $this->Form->control('message');
            echo $this->Form->control('date');
            echo $this->Form->control('from');
            echo $this->Form->control('to');
            echo $this->Form->control('workgroup_id', ['options' => $workgroups]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
