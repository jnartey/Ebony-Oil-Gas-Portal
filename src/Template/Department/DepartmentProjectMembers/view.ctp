<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Projects Member'), ['action' => 'edit', $projectsMember->project_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Projects Member'), ['action' => 'delete', $projectsMember->project_id], ['confirm' => __('Are you sure you want to delete # {0}?', $projectsMember->project_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Projects Members'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Projects Member'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Projects'), ['controller' => 'Projects', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Project'), ['controller' => 'Projects', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="projectsMembers view large-9 medium-8 columns content">
    <h3><?= h($projectsMember->project_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Project') ?></th>
            <td><?= $projectsMember->has('project') ? $this->Html->link($projectsMember->project->name, ['controller' => 'Projects', 'action' => 'view', $projectsMember->project->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $projectsMember->has('user') ? $this->Html->link($projectsMember->user->id, ['controller' => 'Users', 'action' => 'view', $projectsMember->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($projectsMember->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($projectsMember->modified) ?></td>
        </tr>
    </table>
</div>
