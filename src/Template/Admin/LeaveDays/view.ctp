<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\LeaveDay $leaveDay
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Leave Day'), ['action' => 'edit', $leaveDay->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Leave Day'), ['action' => 'delete', $leaveDay->id], ['confirm' => __('Are you sure you want to delete # {0}?', $leaveDay->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Leave Days'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Leave Day'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="leaveDays view large-9 medium-8 columns content">
    <h3><?= h($leaveDay->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $leaveDay->has('user') ? $this->Html->link($leaveDay->user->name, ['controller' => 'Users', 'action' => 'view', $leaveDay->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($leaveDay->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Number Of Days') ?></th>
            <td><?= $this->Number->format($leaveDay->number_of_days) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($leaveDay->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($leaveDay->modified) ?></td>
        </tr>
    </table>
</div>
