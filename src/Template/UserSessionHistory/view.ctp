<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UserSessionHistory $userSessionHistory
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User Session History'), ['action' => 'edit', $userSessionHistory->user_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User Session History'), ['action' => 'delete', $userSessionHistory->user_id], ['confirm' => __('Are you sure you want to delete # {0}?', $userSessionHistory->user_id)]) ?> </li>
        <li><?= $this->Html->link(__('List User Session History'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User Session History'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List User'), ['controller' => 'User', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'User', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="userSessionHistory view large-9 medium-8 columns content">
    <h3><?= h($userSessionHistory->user_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $userSessionHistory->has('user') ? $this->Html->link($userSessionHistory->user->name, ['controller' => 'User', 'action' => 'view', $userSessionHistory->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Browser') ?></th>
            <td><?= h($userSessionHistory->browser) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Platform') ?></th>
            <td><?= h($userSessionHistory->platform) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User Agent') ?></th>
            <td><?= h($userSessionHistory->user_agent) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Public Ip') ?></th>
            <td><?= $this->Number->format($userSessionHistory->public_ip) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Login Time') ?></th>
            <td><?= h($userSessionHistory->login_time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Logout Time') ?></th>
            <td><?= h($userSessionHistory->logout_time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Forced Logout') ?></th>
            <td><?= $userSessionHistory->is_forced_logout ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
