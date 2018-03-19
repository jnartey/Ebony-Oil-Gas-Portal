<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\DepartmentEventMember $departmentEventMember
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Department Event Member'), ['action' => 'edit', $departmentEventMember->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Department Event Member'), ['action' => 'delete', $departmentEventMember->id], ['confirm' => __('Are you sure you want to delete # {0}?', $departmentEventMember->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Department Event Members'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Department Event Member'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Events'), ['controller' => 'Events', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Event'), ['controller' => 'Events', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Departments'), ['controller' => 'Departments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Department'), ['controller' => 'Departments', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="departmentEventMembers view large-9 medium-8 columns content">
    <h3><?= h($departmentEventMember->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Event') ?></th>
            <td><?= $departmentEventMember->has('event') ? $this->Html->link($departmentEventMember->event->name, ['controller' => 'Events', 'action' => 'view', $departmentEventMember->event->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $departmentEventMember->has('user') ? $this->Html->link($departmentEventMember->user->name, ['controller' => 'Users', 'action' => 'view', $departmentEventMember->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Department') ?></th>
            <td><?= $departmentEventMember->has('department') ? $this->Html->link($departmentEventMember->department->name, ['controller' => 'Departments', 'action' => 'view', $departmentEventMember->department->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($departmentEventMember->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($departmentEventMember->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($departmentEventMember->modified) ?></td>
        </tr>
    </table>
</div>
