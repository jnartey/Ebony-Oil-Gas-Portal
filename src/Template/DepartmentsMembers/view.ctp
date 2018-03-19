<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Departments Member'), ['action' => 'edit', $departmentsMember->department_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Departments Member'), ['action' => 'delete', $departmentsMember->department_id], ['confirm' => __('Are you sure you want to delete # {0}?', $departmentsMember->department_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Departments Members'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Departments Member'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Departments'), ['controller' => 'Departments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Department'), ['controller' => 'Departments', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="departmentsMembers view large-9 medium-8 columns content">
    <h3><?= h($departmentsMember->department_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Department') ?></th>
            <td><?= $departmentsMember->has('department') ? $this->Html->link($departmentsMember->department->name, ['controller' => 'Departments', 'action' => 'view', $departmentsMember->department->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $departmentsMember->has('user') ? $this->Html->link($departmentsMember->user->id, ['controller' => 'Users', 'action' => 'view', $departmentsMember->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($departmentsMember->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($departmentsMember->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($departmentsMember->modified) ?></td>
        </tr>
    </table>
</div>
