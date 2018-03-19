<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\WorkgroupEventMember[]|\Cake\Collection\CollectionInterface $workgroupEventMembers
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Workgroup Event Member'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Events'), ['controller' => 'Events', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Event'), ['controller' => 'Events', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Workgroups'), ['controller' => 'Workgroups', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Workgroup'), ['controller' => 'Workgroups', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="workgroupEventMembers index large-9 medium-8 columns content">
    <h3><?= __('Workgroup Event Members') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('event_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('workgroup_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($workgroupEventMembers as $workgroupEventMember): ?>
            <tr>
                <td><?= $this->Number->format($workgroupEventMember->id) ?></td>
                <td><?= $workgroupEventMember->has('event') ? $this->Html->link($workgroupEventMember->event->name, ['controller' => 'Events', 'action' => 'view', $workgroupEventMember->event->id]) : '' ?></td>
                <td><?= $workgroupEventMember->has('user') ? $this->Html->link($workgroupEventMember->user->name, ['controller' => 'Users', 'action' => 'view', $workgroupEventMember->user->id]) : '' ?></td>
                <td><?= $workgroupEventMember->has('workgroup') ? $this->Html->link($workgroupEventMember->workgroup->name, ['controller' => 'Workgroups', 'action' => 'view', $workgroupEventMember->workgroup->id]) : '' ?></td>
                <td><?= h($workgroupEventMember->created) ?></td>
                <td><?= h($workgroupEventMember->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $workgroupEventMember->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $workgroupEventMember->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $workgroupEventMember->id], ['confirm' => __('Are you sure you want to delete # {0}?', $workgroupEventMember->id)]) ?>
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
