<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\DepartmentComment[]|\Cake\Collection\CollectionInterface $departmentComments
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Department Comment'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Projects'), ['controller' => 'Projects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Project'), ['controller' => 'Projects', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Forums'), ['controller' => 'Forums', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Forum'), ['controller' => 'Forums', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="departmentComments index large-9 medium-8 columns content">
    <h3><?= __('Department Comments') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('comment_src') ?></th>
                <th scope="col"><?= $this->Paginator->sort('source_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('project_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('forum_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('parent_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($departmentComments as $departmentComment): ?>
            <tr>
                <td><?= $this->Number->format($departmentComment->id) ?></td>
                <td><?= $this->Number->format($departmentComment->comment_src) ?></td>
                <td><?= $this->Number->format($departmentComment->source_id) ?></td>
                <td><?= $departmentComment->has('project') ? $this->Html->link($departmentComment->project->name, ['controller' => 'Projects', 'action' => 'view', $departmentComment->project->id]) : '' ?></td>
                <td><?= $departmentComment->has('forum') ? $this->Html->link($departmentComment->forum->title, ['controller' => 'Forums', 'action' => 'view', $departmentComment->forum->id]) : '' ?></td>
                <td><?= $departmentComment->has('parent_department_comment') ? $this->Html->link($departmentComment->parent_department_comment->id, ['controller' => 'DepartmentComments', 'action' => 'view', $departmentComment->parent_department_comment->id]) : '' ?></td>
                <td><?= $departmentComment->has('user') ? $this->Html->link($departmentComment->user->name, ['controller' => 'Users', 'action' => 'view', $departmentComment->user->id]) : '' ?></td>
                <td><?= h($departmentComment->created) ?></td>
                <td><?= h($departmentComment->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $departmentComment->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $departmentComment->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $departmentComment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $departmentComment->id)]) ?>
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
