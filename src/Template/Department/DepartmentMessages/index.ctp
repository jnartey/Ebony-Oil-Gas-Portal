<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\DepartmentMessage[]|\Cake\Collection\CollectionInterface $departmentMessages
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Department Message'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Departments'), ['controller' => 'Departments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Department'), ['controller' => 'Departments', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="departmentMessages index large-9 medium-8 columns content">
    <h3><?= __('Department Messages') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('from') ?></th>
                <th scope="col"><?= $this->Paginator->sort('to') ?></th>
                <th scope="col"><?= $this->Paginator->sort('department_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($departmentMessages as $departmentMessage): ?>
            <tr>
                <td><?= $this->Number->format($departmentMessage->id) ?></td>
                <td><?= h($departmentMessage->date) ?></td>
                <td><?= $this->Number->format($departmentMessage->from) ?></td>
                <td><?= $this->Number->format($departmentMessage->to) ?></td>
                <td><?= $departmentMessage->has('department') ? $this->Html->link($departmentMessage->department->name, ['controller' => 'Departments', 'action' => 'view', $departmentMessage->department->id]) : '' ?></td>
                <td><?= h($departmentMessage->created) ?></td>
                <td><?= h($departmentMessage->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $departmentMessage->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $departmentMessage->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $departmentMessage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $departmentMessage->id)]) ?>
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
