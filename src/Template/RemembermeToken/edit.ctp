<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RemembermeToken $remembermeToken
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $remembermeToken->user_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $remembermeToken->user_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Rememberme Token'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List User'), ['controller' => 'User', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'User', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="remembermeToken form large-9 medium-8 columns content">
    <?= $this->Form->create($remembermeToken) ?>
    <fieldset>
        <legend><?= __('Edit Rememberme Token') ?></legend>
        <?php
            echo $this->Form->control('token');
            echo $this->Form->control('expires_on');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
