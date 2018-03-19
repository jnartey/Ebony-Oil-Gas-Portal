<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\DepartmentEventMember[]|\Cake\Collection\CollectionInterface $departmentEventMembers
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Department Event Member'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Events'), ['controller' => 'Events', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Event'), ['controller' => 'Events', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Departments'), ['controller' => 'Departments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Department'), ['controller' => 'Departments', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="departmentEventMembers index large-9 medium-8 columns content">
    <h3><?= __('Department Event Members') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('event_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('department_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($departmentEventMembers as $departmentEventMember): ?>
            <tr>
                <td><?= $this->Number->format($departmentEventMember->id) ?></td>
                <td><?= $departmentEventMember->has('event') ? $this->Html->link($departmentEventMember->event->name, ['controller' => 'Events', 'action' => 'view', $departmentEventMember->event->id]) : '' ?></td>
                <td><?= $departmentEventMember->has('user') ? $this->Html->link($departmentEventMember->user->name, ['controller' => 'Users', 'action' => 'view', $departmentEventMember->user->id]) : '' ?></td>
                <td><?= $departmentEventMember->has('department') ? $this->Html->link($departmentEventMember->department->name, ['controller' => 'Departments', 'action' => 'view', $departmentEventMember->department->id]) : '' ?></td>
                <td><?= h($departmentEventMember->created) ?></td>
                <td><?= h($departmentEventMember->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $departmentEventMember->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $departmentEventMember->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $departmentEventMember->id], ['confirm' => __('Are you sure you want to delete # {0}?', $departmentEventMember->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
