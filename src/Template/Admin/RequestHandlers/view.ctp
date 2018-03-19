<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\RequestHandler $requestHandler
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Request Handler'), ['action' => 'edit', $requestHandler->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Request Handler'), ['action' => 'delete', $requestHandler->id], ['confirm' => __('Are you sure you want to delete # {0}?', $requestHandler->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Request Handlers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Request Handler'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Request Forms'), ['controller' => 'RequestForms', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Request Form'), ['controller' => 'RequestForms', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Departments'), ['controller' => 'Departments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Department'), ['controller' => 'Departments', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="requestHandlers view large-9 medium-8 columns content">
    <h3><?= h($requestHandler->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Request Form') ?></th>
            <td><?= $requestHandler->has('request_form') ? $this->Html->link($requestHandler->request_form->name, ['controller' => 'RequestForms', 'action' => 'view', $requestHandler->request_form->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Department') ?></th>
            <td><?= $requestHandler->has('department') ? $this->Html->link($requestHandler->department->name, ['controller' => 'Departments', 'action' => 'view', $requestHandler->department->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($requestHandler->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User Id') ?></th>
            <td><?= $this->Number->format($requestHandler->user_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($requestHandler->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($requestHandler->modified) ?></td>
        </tr>
    </table>
</div>
