<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Im Message'), ['action' => 'edit', $imMessage->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Im Message'), ['action' => 'delete', $imMessage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $imMessage->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Im Messages'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Im Message'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="imMessages view large-9 medium-8 columns content">
    <h3><?= h($imMessage->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($imMessage->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('From') ?></th>
            <td><?= $this->Number->format($imMessage->from) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('To') ?></th>
            <td><?= $this->Number->format($imMessage->to) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date') ?></th>
            <td><?= h($imMessage->date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($imMessage->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($imMessage->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Message') ?></h4>
        <?= $this->Text->autoParagraph(h($imMessage->message)); ?>
    </div>
</div>
