<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Timezone $timezone
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Timezone'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List User'), ['controller' => 'User', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'User', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="timezone form large-9 medium-8 columns content">
    <?= $this->Form->create($timezone) ?>
    <fieldset>
        <legend><?= __('Add Timezone') ?></legend>
        <?php
            echo $this->Form->control('ui_name');
            echo $this->Form->control('timezone');
            echo $this->Form->control('description');
            echo $this->Form->control('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
