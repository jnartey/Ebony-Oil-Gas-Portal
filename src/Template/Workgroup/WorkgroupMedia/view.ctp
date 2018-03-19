<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Media'), ['action' => 'edit', $media->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Media'), ['action' => 'delete', $media->id], ['confirm' => __('Are you sure you want to delete # {0}?', $media->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Media'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Media'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Workgroups'), ['controller' => 'Workgroups', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Workgroup'), ['controller' => 'Workgroups', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="media view large-9 medium-8 columns content">
    <h3><?= h($media->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Folder Name') ?></th>
            <td><?= h($media->folder_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('File Name') ?></th>
            <td><?= h($media->file_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Workgroup') ?></th>
            <td><?= $media->has('workgroup') ? $this->Html->link($media->workgroup->name, ['controller' => 'Workgroups', 'action' => 'view', $media->workgroup->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($media->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Size') ?></th>
            <td><?= $this->Number->format($media->size) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Uploaded By') ?></th>
            <td><?= $this->Number->format($media->uploaded_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Uploaded On') ?></th>
            <td><?= h($media->uploaded_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($media->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($media->modified) ?></td>
        </tr>
    </table>
</div>
