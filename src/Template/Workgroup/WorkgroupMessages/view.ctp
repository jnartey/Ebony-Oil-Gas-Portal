<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\WorkgroupMessage $workgroupMessage
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Workgroup Message'), ['action' => 'edit', $workgroupMessage->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Workgroup Message'), ['action' => 'delete', $workgroupMessage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $workgroupMessage->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Workgroup Messages'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Workgroup Message'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Workgroups'), ['controller' => 'Workgroups', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Workgroup'), ['controller' => 'Workgroups', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="workgroupMessages view large-9 medium-8 columns content">
    <h3><?= h($workgroupMessage->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Workgroup') ?></th>
            <td><?= $workgroupMessage->has('workgroup') ? $this->Html->link($workgroupMessage->workgroup->id, ['controller' => 'Workgroups', 'action' => 'view', $workgroupMessage->workgroup->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($workgroupMessage->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('From') ?></th>
            <td><?= $this->Number->format($workgroupMessage->from) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('To') ?></th>
            <td><?= $this->Number->format($workgroupMessage->to) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date') ?></th>
            <td><?= h($workgroupMessage->date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($workgroupMessage->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($workgroupMessage->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Message') ?></h4>
        <?= $this->Text->autoParagraph(h($workgroupMessage->message)); ?>
    </div>
</div>
