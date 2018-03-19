<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Department'), ['action' => 'edit', $department->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Department'), ['action' => 'delete', $department->id], ['confirm' => __('Are you sure you want to delete # {0}?', $department->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Departments'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Department'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Departments Forums'), ['controller' => 'DepartmentsForums', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Departments Forum'), ['controller' => 'DepartmentsForums', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Departments Members'), ['controller' => 'DepartmentsMembers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Departments Member'), ['controller' => 'DepartmentsMembers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Documents'), ['controller' => 'Documents', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Document'), ['controller' => 'Documents', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Media'), ['controller' => 'Media', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Media'), ['controller' => 'Media', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Projects'), ['controller' => 'Projects', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Project'), ['controller' => 'Projects', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Threads'), ['controller' => 'Threads', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Thread'), ['controller' => 'Threads', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Wiki'), ['controller' => 'Wiki', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Wiki'), ['controller' => 'Wiki', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="departments view large-9 medium-8 columns content">
    <h3><?= h($department->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $department->has('user') ? $this->Html->link($department->user->id, ['controller' => 'Users', 'action' => 'view', $department->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($department->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Logo') ?></th>
            <td><?= h($department->logo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($department->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($department->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($department->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($department->description)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Departments Forums') ?></h4>
        <?php if (!empty($department->departments_forums)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Department Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Title') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($department->departments_forums as $departmentsForums): ?>
            <tr>
                <td><?= h($departmentsForums->id) ?></td>
                <td><?= h($departmentsForums->department_id) ?></td>
                <td><?= h($departmentsForums->user_id) ?></td>
                <td><?= h($departmentsForums->title) ?></td>
                <td><?= h($departmentsForums->description) ?></td>
                <td><?= h($departmentsForums->created) ?></td>
                <td><?= h($departmentsForums->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'DepartmentsForums', 'action' => 'view', $departmentsForums->department_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'DepartmentsForums', 'action' => 'edit', $departmentsForums->department_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'DepartmentsForums', 'action' => 'delete', $departmentsForums->department_id], ['confirm' => __('Are you sure you want to delete # {0}?', $departmentsForums->department_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Departments Members') ?></h4>
        <?php if (!empty($department->departments_members)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Department Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($department->departments_members as $departmentsMembers): ?>
            <tr>
                <td><?= h($departmentsMembers->id) ?></td>
                <td><?= h($departmentsMembers->department_id) ?></td>
                <td><?= h($departmentsMembers->user_id) ?></td>
                <td><?= h($departmentsMembers->created) ?></td>
                <td><?= h($departmentsMembers->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'DepartmentsMembers', 'action' => 'view', $departmentsMembers->department_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'DepartmentsMembers', 'action' => 'edit', $departmentsMembers->department_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'DepartmentsMembers', 'action' => 'delete', $departmentsMembers->department_id], ['confirm' => __('Are you sure you want to delete # {0}?', $departmentsMembers->department_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Documents') ?></h4>
        <?php if (!empty($department->documents)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Folder Name') ?></th>
                <th scope="col"><?= __('File Name') ?></th>
                <th scope="col"><?= __('Workflow Step') ?></th>
                <th scope="col"><?= __('Uploaded By') ?></th>
                <th scope="col"><?= __('Department Id') ?></th>
                <th scope="col"><?= __('Uploaded On') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($department->documents as $documents): ?>
            <tr>
                <td><?= h($documents->id) ?></td>
                <td><?= h($documents->folder_name) ?></td>
                <td><?= h($documents->file_name) ?></td>
                <td><?= h($documents->workflow_step) ?></td>
                <td><?= h($documents->uploaded_by) ?></td>
                <td><?= h($documents->department_id) ?></td>
                <td><?= h($documents->uploaded_on) ?></td>
                <td><?= h($documents->created) ?></td>
                <td><?= h($documents->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Documents', 'action' => 'view', $documents->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Documents', 'action' => 'edit', $documents->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Documents', 'action' => 'delete', $documents->id], ['confirm' => __('Are you sure you want to delete # {0}?', $documents->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Media') ?></h4>
        <?php if (!empty($department->media)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Folder Name') ?></th>
                <th scope="col"><?= __('File Name') ?></th>
                <th scope="col"><?= __('Size') ?></th>
                <th scope="col"><?= __('Uploaded By') ?></th>
                <th scope="col"><?= __('Department Id') ?></th>
                <th scope="col"><?= __('Uploaded On') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($department->media as $media): ?>
            <tr>
                <td><?= h($media->id) ?></td>
                <td><?= h($media->folder_name) ?></td>
                <td><?= h($media->file_name) ?></td>
                <td><?= h($media->size) ?></td>
                <td><?= h($media->uploaded_by) ?></td>
                <td><?= h($media->department_id) ?></td>
                <td><?= h($media->uploaded_on) ?></td>
                <td><?= h($media->created) ?></td>
                <td><?= h($media->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Media', 'action' => 'view', $media->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Media', 'action' => 'edit', $media->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Media', 'action' => 'delete', $media->id], ['confirm' => __('Are you sure you want to delete # {0}?', $media->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Projects') ?></h4>
        <?php if (!empty($department->projects)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Department Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Deadline') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($department->projects as $projects): ?>
            <tr>
                <td><?= h($projects->id) ?></td>
                <td><?= h($projects->department_id) ?></td>
                <td><?= h($projects->name) ?></td>
                <td><?= h($projects->created_by) ?></td>
                <td><?= h($projects->deadline) ?></td>
                <td><?= h($projects->status) ?></td>
                <td><?= h($projects->created) ?></td>
                <td><?= h($projects->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Projects', 'action' => 'view', $projects->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Projects', 'action' => 'edit', $projects->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Projects', 'action' => 'delete', $projects->id], ['confirm' => __('Are you sure you want to delete # {0}?', $projects->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Threads') ?></h4>
        <?php if (!empty($department->threads)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Date Created') ?></th>
                <th scope="col"><?= __('Department Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($department->threads as $threads): ?>
            <tr>
                <td><?= h($threads->id) ?></td>
                <td><?= h($threads->date_created) ?></td>
                <td><?= h($threads->department_id) ?></td>
                <td><?= h($threads->created) ?></td>
                <td><?= h($threads->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Threads', 'action' => 'view', $threads->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Threads', 'action' => 'edit', $threads->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Threads', 'action' => 'delete', $threads->id], ['confirm' => __('Are you sure you want to delete # {0}?', $threads->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Wiki') ?></h4>
        <?php if (!empty($department->wiki)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Department Id') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Content') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($department->wiki as $wiki): ?>
            <tr>
                <td><?= h($wiki->id) ?></td>
                <td><?= h($wiki->department_id) ?></td>
                <td><?= h($wiki->description) ?></td>
                <td><?= h($wiki->content) ?></td>
                <td><?= h($wiki->created) ?></td>
                <td><?= h($wiki->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Wiki', 'action' => 'view', $wiki->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Wiki', 'action' => 'edit', $wiki->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Wiki', 'action' => 'delete', $wiki->id], ['confirm' => __('Are you sure you want to delete # {0}?', $wiki->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
