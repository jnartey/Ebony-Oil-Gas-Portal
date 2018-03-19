<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\WorkgroupEventMember $workgroupEventMember
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Workgroup Event Member'), ['action' => 'edit', $workgroupEventMember->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Workgroup Event Member'), ['action' => 'delete', $workgroupEventMember->id], ['confirm' => __('Are you sure you want to delete # {0}?', $workgroupEventMember->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Workgroup Event Members'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Workgroup Event Member'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Events'), ['controller' => 'Events', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Event'), ['controller' => 'Events', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Workgroups'), ['controller' => 'Workgroups', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Workgroup'), ['controller' => 'Workgroups', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="workgroupEventMembers view large-9 medium-8 columns content">
    <h3><?= h($workgroupEventMember->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Event') ?></th>
            <td><?= $workgroupEventMember->has('event') ? $this->Html->link($workgroupEventMember->event->name, ['controller' => 'Events', 'action' => 'view', $workgroupEventMember->event->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $workgroupEventMember->has('user') ? $this->Html->link($workgroupEventMember->user->name, ['controller' => 'Users', 'action' => 'view', $workgroupEventMember->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Workgroup') ?></th>
            <td><?= $workgroupEventMember->has('workgroup') ? $this->Html->link($workgroupEventMember->workgroup->name, ['controller' => 'Workgroups', 'action' => 'view', $workgroupEventMember->workgroup->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($workgroupEventMember->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($workgroupEventMember->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($workgroupEventMember->modified) ?></td>
        </tr>
    </table>
</div>
