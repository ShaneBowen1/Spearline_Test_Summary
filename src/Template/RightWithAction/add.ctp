<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RightWithAction $rightWithAction
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Right With Action'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Right'), ['controller' => 'Right', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Right'), ['controller' => 'Right', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Platform Action'), ['controller' => 'PlatformAction', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Platform Action'), ['controller' => 'PlatformAction', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="rightWithAction form large-9 medium-8 columns content">
    <?= $this->Form->create($rightWithAction) ?>
    <fieldset>
        <legend><?= __('Add Right With Action') ?></legend>
        <?php
            echo $this->Form->control('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
