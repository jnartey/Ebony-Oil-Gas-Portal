<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\WorkgroupMessage[]|\Cake\Collection\CollectionInterface $workgroupMessages
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Workgroup Message'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Workgroups'), ['controller' => 'Workgroups', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Workgroup'), ['controller' => 'Workgroups', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="workgroupMessages index large-9 medium-8 columns content">
    <h3><?= __('Workgroup Messages') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('from') ?></th>
                <th scope="col"><?= $this->Paginator->sort('to') ?></th>
                <th scope="col"><?= $this->Paginator->sort('workgroup_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($workgroupMessages as $workgroupMessage): ?>
            <tr>
                <td><?= $this->Number->format($workgroupMessage->id) ?></td>
                <td><?= h($workgroupMessage->date) ?></td>
                <td><?= $this->Number->format($workgroupMessage->from) ?></td>
                <td><?= $this->Number->format($workgroupMessage->to) ?></td>
                <td><?= $workgroupMessage->has('workgroup') ? $this->Html->link($workgroupMessage->workgroup->id, ['controller' => 'Workgroups', 'action' => 'view', $workgroupMessage->workgroup->id]) : '' ?></td>
                <td><?= h($workgroupMessage->created) ?></td>
                <td><?= h($workgroupMessage->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $workgroupMessage->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $workgroupMessage->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $workgroupMessage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $workgroupMessage->id)]) ?>
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
