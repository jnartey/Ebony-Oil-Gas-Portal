<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Comment[]|\Cake\Collection\CollectionInterface $comments
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Comment'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Projects'), ['controller' => 'Projects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Project'), ['controller' => 'Projects', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Workgroups'), ['controller' => 'Workgroups', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Workgroup'), ['controller' => 'Workgroups', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="comments index large-9 medium-8 columns content">
    <h3><?= __('Comments') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('comment_src') ?></th>
                <th scope="col"><?= $this->Paginator->sort('project_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('workgroup_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('forum_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('parent_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col"><?= $this->Paginator->sort('lft') ?></th>
                <th scope="col"><?= $this->Paginator->sort('rght') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($comments as $comment): ?>
            <tr>
                <td><?= $this->Number->format($comment->id) ?></td>
                <td><?= $this->Number->format($comment->comment_src) ?></td>
                <td><?= $comment->has('project') ? $this->Html->link($comment->project->name, ['controller' => 'Projects', 'action' => 'view', $comment->project->id]) : '' ?></td>
                <td><?= $comment->has('workgroup') ? $this->Html->link($comment->workgroup->id, ['controller' => 'Workgroups', 'action' => 'view', $comment->workgroup->id]) : '' ?></td>
                <td><?= $this->Number->format($comment->forum_id) ?></td>
                <td><?= $this->Number->format($comment->parent_id) ?></td>
                <td><?= $comment->has('user') ? $this->Html->link($comment->user->name, ['controller' => 'Users', 'action' => 'view', $comment->user->id]) : '' ?></td>
                <td><?= h($comment->created) ?></td>
                <td><?= h($comment->modified) ?></td>
                <td><?= $this->Number->format($comment->lft) ?></td>
                <td><?= $this->Number->format($comment->rght) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $comment->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $comment->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $comment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $comment->id)]) ?>
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
