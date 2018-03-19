<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\DepartmentMessage $departmentMessage
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Department Message'), ['action' => 'edit', $departmentMessage->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Department Message'), ['action' => 'delete', $departmentMessage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $departmentMessage->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Department Messages'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Department Message'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Departments'), ['controller' => 'Departments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Department'), ['controller' => 'Departments', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="departmentMessages view large-9 medium-8 columns content">
    <h3><?= h($departmentMessage->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Department') ?></th>
            <td><?= $departmentMessage->has('department') ? $this->Html->link($departmentMessage->department->name, ['controller' => 'Departments', 'action' => 'view', $departmentMessage->department->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($departmentMessage->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('From') ?></th>
            <td><?= $this->Number->format($departmentMessage->from) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('To') ?></th>
            <td><?= $this->Number->format($departmentMessage->to) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date') ?></th>
            <td><?= h($departmentMessage->date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($departmentMessage->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($departmentMessage->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Message') ?></h4>
        <?= $this->Text->autoParagraph(h($departmentMessage->message)); ?>
    </div>
</div>
