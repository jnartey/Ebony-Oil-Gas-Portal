<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Wiki'), ['action' => 'edit', $wiki->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Wiki'), ['action' => 'delete', $wiki->id], ['confirm' => __('Are you sure you want to delete # {0}?', $wiki->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Wiki'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Wiki'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Departments'), ['controller' => 'Departments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Department'), ['controller' => 'Departments', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="wiki view large-9 medium-8 columns content">
    <h3><?= h($wiki->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Department') ?></th>
            <td><?= $wiki->has('department') ? $this->Html->link($wiki->department->name, ['controller' => 'Departments', 'action' => 'view', $wiki->department->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($wiki->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($wiki->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($wiki->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($wiki->description)); ?>
    </div>
    <div class="row">
        <h4><?= __('Content') ?></h4>
        <?= $this->Text->autoParagraph(h($wiki->content)); ?>
    </div>
</div>
