<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Departments Forum'), ['action' => 'edit', $departmentsForum->department_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Departments Forum'), ['action' => 'delete', $departmentsForum->department_id], ['confirm' => __('Are you sure you want to delete # {0}?', $departmentsForum->department_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Departments Forums'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Departments Forum'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Departments'), ['controller' => 'Departments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Department'), ['controller' => 'Departments', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="departmentsForums view large-9 medium-8 columns content">
    <h3><?= h($departmentsForum->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Department') ?></th>
            <td><?= $departmentsForum->has('department') ? $this->Html->link($departmentsForum->department->name, ['controller' => 'Departments', 'action' => 'view', $departmentsForum->department->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $departmentsForum->has('user') ? $this->Html->link($departmentsForum->user->id, ['controller' => 'Users', 'action' => 'view', $departmentsForum->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($departmentsForum->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($departmentsForum->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($departmentsForum->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($departmentsForum->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($departmentsForum->description)); ?>
    </div>
</div>
