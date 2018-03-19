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
                ['action' => 'delete', $wiki->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $wiki->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Wiki'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Departments'), ['controller' => 'Departments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Department'), ['controller' => 'Departments', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="wiki form large-9 medium-8 columns content">
    <?= $this->Form->create($wiki) ?>
    <fieldset>
        <legend><?= __('Edit Wiki') ?></legend>
        <?php
            echo $this->Form->control('department_id', ['options' => $departments]);
            echo $this->Form->control('description');
            echo $this->Form->control('content');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
