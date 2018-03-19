<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Canteen'), ['action' => 'edit', $canteen->day]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Canteen'), ['action' => 'delete', $canteen->day], ['confirm' => __('Are you sure you want to delete # {0}?', $canteen->day)]) ?> </li>
        <li><?= $this->Html->link(__('List Canteen'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Canteen'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="canteen view large-9 medium-8 columns content">
    <h3><?= h($canteen->day) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Meal') ?></th>
            <td><?= h($canteen->meal) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($canteen->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($canteen->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Day') ?></th>
            <td><?= $canteen->day ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
