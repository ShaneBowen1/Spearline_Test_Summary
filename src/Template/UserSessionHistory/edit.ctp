<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UserSessionHistory $userSessionHistory
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $userSessionHistory->user_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $userSessionHistory->user_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List User Session History'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List User'), ['controller' => 'User', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'User', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="userSessionHistory form large-9 medium-8 columns content">
    <?= $this->Form->create($userSessionHistory) ?>
    <fieldset>
        <legend><?= __('Edit User Session History') ?></legend>
        <?php
            echo $this->Form->control('logout_time');
            echo $this->Form->control('browser');
            echo $this->Form->control('platform');
            echo $this->Form->control('user_agent');
            echo $this->Form->control('public_ip');
            echo $this->Form->control('is_forced_logout');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
