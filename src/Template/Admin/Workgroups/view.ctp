<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Workgroup'), ['action' => 'edit', $workgroup->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Workgroup'), ['action' => 'delete', $workgroup->id], ['confirm' => __('Are you sure you want to delete # {0}?', $workgroup->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Workgroups'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Workgroup'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Workgroups Members'), ['controller' => 'WorkgroupsMembers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Workgroups Member'), ['controller' => 'WorkgroupsMembers', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="workgroups view large-9 medium-8 columns content">
    <h3><?= h($workgroup->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Approve Members') ?></th>
            <td><?= h($workgroup->approve_members) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Content Access') ?></th>
            <td><?= h($workgroup->content_access) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($workgroup->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($workgroup->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($workgroup->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($workgroup->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($workgroup->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Approved') ?></th>
            <td><?= $workgroup->is_approved ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($workgroup->description)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Workgroups Members') ?></h4>
        <?php if (!empty($workgroup->workgroups_members)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Workgroup Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($workgroup->workgroups_members as $workgroupsMembers): ?>
            <tr>
                <td><?= h($workgroupsMembers->workgroup_id) ?></td>
                <td><?= h($workgroupsMembers->user_id) ?></td>
                <td><?= h($workgroupsMembers->created) ?></td>
                <td><?= h($workgroupsMembers->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'WorkgroupsMembers', 'action' => 'view', $workgroupsMembers->workgroup_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'WorkgroupsMembers', 'action' => 'edit', $workgroupsMembers->workgroup_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'WorkgroupsMembers', 'action' => 'delete', $workgroupsMembers->workgroup_id], ['confirm' => __('Are you sure you want to delete # {0}?', $workgroupsMembers->workgroup_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
