<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PasswordResetToken $passwordResetToken
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Password Reset Token'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List User'), ['controller' => 'User', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'User', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="passwordResetToken form large-9 medium-8 columns content">
    <?= $this->Form->create($passwordResetToken) ?>
    <fieldset>
        <legend><?= __('Add Password Reset Token') ?></legend>
        <?php
            echo $this->Form->control('user_id', ['options' => $user]);
            echo $this->Form->control('expires_on');
            echo $this->Form->control('added_on');
            echo $this->Form->control('added_by');
            echo $this->Form->control('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
