<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\DepartmentComment $departmentComment
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Department Comment'), ['action' => 'edit', $departmentComment->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Department Comment'), ['action' => 'delete', $departmentComment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $departmentComment->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Department Comments'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Department Comment'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Projects'), ['controller' => 'Projects', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Project'), ['controller' => 'Projects', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Forums'), ['controller' => 'Forums', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Forum'), ['controller' => 'Forums', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Parent Department Comments'), ['controller' => 'DepartmentComments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Parent Department Comment'), ['controller' => 'DepartmentComments', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="departmentComments view large-9 medium-8 columns content">
    <h3><?= h($departmentComment->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Project') ?></th>
            <td><?= $departmentComment->has('project') ? $this->Html->link($departmentComment->project->name, ['controller' => 'Projects', 'action' => 'view', $departmentComment->project->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Forum') ?></th>
            <td><?= $departmentComment->has('forum') ? $this->Html->link($departmentComment->forum->title, ['controller' => 'Forums', 'action' => 'view', $departmentComment->forum->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Parent Department Comment') ?></th>
            <td><?= $departmentComment->has('parent_department_comment') ? $this->Html->link($departmentComment->parent_department_comment->id, ['controller' => 'DepartmentComments', 'action' => 'view', $departmentComment->parent_department_comment->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $departmentComment->has('user') ? $this->Html->link($departmentComment->user->name, ['controller' => 'Users', 'action' => 'view', $departmentComment->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($departmentComment->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Comment Src') ?></th>
            <td><?= $this->Number->format($departmentComment->comment_src) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Source Id') ?></th>
            <td><?= $this->Number->format($departmentComment->source_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Lft') ?></th>
            <td><?= $this->Number->format($departmentComment->lft) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rght') ?></th>
            <td><?= $this->Number->format($departmentComment->rght) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($departmentComment->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($departmentComment->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Comment') ?></h4>
        <?= $this->Text->autoParagraph(h($departmentComment->comment)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Department Comments') ?></h4>
        <?php if (!empty($departmentComment->child_department_comments)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Comment Src') ?></th>
                <th scope="col"><?= __('Source Id') ?></th>
                <th scope="col"><?= __('Project Id') ?></th>
                <th scope="col"><?= __('Forum Id') ?></th>
                <th scope="col"><?= __('Parent Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Comment') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Lft') ?></th>
                <th scope="col"><?= __('Rght') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($departmentComment->child_department_comments as $childDepartmentComments): ?>
            <tr>
                <td><?= h($childDepartmentComments->id) ?></td>
                <td><?= h($childDepartmentComments->comment_src) ?></td>
                <td><?= h($childDepartmentComments->source_id) ?></td>
                <td><?= h($childDepartmentComments->project_id) ?></td>
                <td><?= h($childDepartmentComments->forum_id) ?></td>
                <td><?= h($childDepartmentComments->parent_id) ?></td>
                <td><?= h($childDepartmentComments->user_id) ?></td>
                <td><?= h($childDepartmentComments->comment) ?></td>
                <td><?= h($childDepartmentComments->created) ?></td>
                <td><?= h($childDepartmentComments->modified) ?></td>
                <td><?= h($childDepartmentComments->lft) ?></td>
                <td><?= h($childDepartmentComments->rght) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'DepartmentComments', 'action' => 'view', $childDepartmentComments->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'DepartmentComments', 'action' => 'edit', $childDepartmentComments->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'DepartmentComments', 'action' => 'delete', $childDepartmentComments->id], ['confirm' => __('Are you sure you want to delete # {0}?', $childDepartmentComments->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
