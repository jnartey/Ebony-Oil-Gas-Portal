<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Workgroups Member'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Workgroups'), ['controller' => 'Workgroups', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Workgroup'), ['controller' => 'Workgroups', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="workgroupsMembers index large-9 medium-8 columns content">
    <h3><?= __('Workgroups Members') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('workgroup_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($workgroupsMembers as $workgroupsMember): ?>
            <tr>
                <td><?= $workgroupsMember->has('workgroup') ? $this->Html->link($workgroupsMember->workgroup->id, ['controller' => 'Workgroups', 'action' => 'view', $workgroupsMember->workgroup->id]) : '' ?></td>
                <td><?= $workgroupsMember->has('user') ? $this->Html->link($workgroupsMember->user->id, ['controller' => 'Users', 'action' => 'view', $workgroupsMember->user->id]) : '' ?></td>
                <td><?= h($workgroupsMember->created) ?></td>
                <td><?= h($workgroupsMember->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $workgroupsMember->workgroup_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $workgroupsMember->workgroup_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $workgroupsMember->workgroup_id], ['confirm' => __('Are you sure you want to delete # {0}?', $workgroupsMember->workgroup_id)]) ?>
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
