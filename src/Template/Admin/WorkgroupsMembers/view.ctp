<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Workgroups Member'), ['action' => 'edit', $workgroupsMember->workgroup_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Workgroups Member'), ['action' => 'delete', $workgroupsMember->workgroup_id], ['confirm' => __('Are you sure you want to delete # {0}?', $workgroupsMember->workgroup_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Workgroups Members'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Workgroups Member'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Workgroups'), ['controller' => 'Workgroups', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Workgroup'), ['controller' => 'Workgroups', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="workgroupsMembers view large-9 medium-8 columns content">
    <h3><?= h($workgroupsMember->workgroup_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Workgroup') ?></th>
            <td><?= $workgroupsMember->has('workgroup') ? $this->Html->link($workgroupsMember->workgroup->id, ['controller' => 'Workgroups', 'action' => 'view', $workgroupsMember->workgroup->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $workgroupsMember->has('user') ? $this->Html->link($workgroupsMember->user->id, ['controller' => 'Users', 'action' => 'view', $workgroupsMember->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($workgroupsMember->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($workgroupsMember->modified) ?></td>
        </tr>
    </table>
</div>
