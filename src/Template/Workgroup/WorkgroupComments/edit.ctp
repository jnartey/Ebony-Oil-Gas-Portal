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
                ['action' => 'delete', $departmentComment->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $departmentComment->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Department Comments'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Projects'), ['controller' => 'Projects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Project'), ['controller' => 'Projects', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Forums'), ['controller' => 'Forums', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Forum'), ['controller' => 'Forums', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Parent Department Comments'), ['controller' => 'DepartmentComments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Parent Department Comment'), ['controller' => 'DepartmentComments', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="departmentComments form large-9 medium-8 columns content">
    <?= $this->Form->create($departmentComment) ?>
    <fieldset>
        <legend><?= __('Edit Department Comment') ?></legend>
        <?php
            echo $this->Form->control('comment_src');
            echo $this->Form->control('source_id');
            echo $this->Form->control('project_id', ['options' => $projects]);
            echo $this->Form->control('forum_id', ['options' => $forums]);
            echo $this->Form->control('parent_id', ['options' => $parentDepartmentComments, 'empty' => true]);
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('comment');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
