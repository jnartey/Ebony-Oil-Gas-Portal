<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $imMessage->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $imMessage->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Im Messages'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="imMessages form large-9 medium-8 columns content">
    <?= $this->Form->create($imMessage) ?>
    <fieldset>
        <legend><?= __('Edit Im Message') ?></legend>
        <?php
            echo $this->Form->control('message');
            echo $this->Form->control('date');
            echo $this->Form->control('from');
            echo $this->Form->control('to');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
