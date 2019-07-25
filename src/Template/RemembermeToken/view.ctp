<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RemembermeToken $remembermeToken
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Rememberme Token'), ['action' => 'edit', $remembermeToken->user_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Rememberme Token'), ['action' => 'delete', $remembermeToken->user_id], ['confirm' => __('Are you sure you want to delete # {0}?', $remembermeToken->user_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Rememberme Token'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Rememberme Token'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List User'), ['controller' => 'User', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'User', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="remembermeToken view large-9 medium-8 columns content">
    <h3><?= h($remembermeToken->user_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $remembermeToken->has('user') ? $this->Html->link($remembermeToken->user->name, ['controller' => 'User', 'action' => 'view', $remembermeToken->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Token') ?></th>
            <td><?= h($remembermeToken->token) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Browser') ?></th>
            <td><?= h($remembermeToken->browser) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ip') ?></th>
            <td><?= $this->Number->format($remembermeToken->ip) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Expires On') ?></th>
            <td><?= h($remembermeToken->expires_on) ?></td>
        </tr>
    </table>
</div>
