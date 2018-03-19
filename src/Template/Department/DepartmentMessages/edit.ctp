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
                ['action' => 'delete', $departmentMessage->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $departmentMessage->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Department Messages'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Departments'), ['controller' => 'Departments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Department'), ['controller' => 'Departments', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="departmentMessages form large-9 medium-8 columns content">
    <?= $this->Form->create($departmentMessage) ?>
    <fieldset>
        <legend><?= __('Edit Department Message') ?></legend>
        <?php
            echo $this->Form->control('message');
            echo $this->Form->control('date');
            echo $this->Form->control('from');
            echo $this->Form->control('to');
            echo $this->Form->control('department_id', ['options' => $departments]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
