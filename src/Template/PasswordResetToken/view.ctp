<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PasswordResetToken $passwordResetToken
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Password Reset Token'), ['action' => 'edit', $passwordResetToken->token]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Password Reset Token'), ['action' => 'delete', $passwordResetToken->token], ['confirm' => __('Are you sure you want to delete # {0}?', $passwordResetToken->token)]) ?> </li>
        <li><?= $this->Html->link(__('List Password Reset Token'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Password Reset Token'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List User'), ['controller' => 'User', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'User', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="passwordResetToken view large-9 medium-8 columns content">
    <h3><?= h($passwordResetToken->token) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Token') ?></th>
            <td><?= h($passwordResetToken->token) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $passwordResetToken->has('user') ? $this->Html->link($passwordResetToken->user->name, ['controller' => 'User', 'action' => 'view', $passwordResetToken->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Added By') ?></th>
            <td><?= $this->Number->format($passwordResetToken->added_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($passwordResetToken->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Expires On') ?></th>
            <td><?= h($passwordResetToken->expires_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Added On') ?></th>
            <td><?= h($passwordResetToken->added_on) ?></td>
        </tr>
    </table>
</div>
