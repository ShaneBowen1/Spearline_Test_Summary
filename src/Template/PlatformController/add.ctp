<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PlatformController $platformController
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Platform Controller'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Platform Action'), ['controller' => 'PlatformAction', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Platform Action'), ['controller' => 'PlatformAction', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="platformController form large-9 medium-8 columns content">
    <?= $this->Form->create($platformController) ?>
    <fieldset>
        <legend><?= __('Add Platform Controller') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('description');
            echo $this->Form->control('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
