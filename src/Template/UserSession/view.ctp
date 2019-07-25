<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UserSession $userSession
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User Session'), ['action' => 'edit', $userSession->user_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User Session'), ['action' => 'delete', $userSession->user_id], ['confirm' => __('Are you sure you want to delete # {0}?', $userSession->user_id)]) ?> </li>
        <li><?= $this->Html->link(__('List User Session'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User Session'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="userSession view large-9 medium-8 columns content">
    <h3><?= h($userSession->user_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Browser') ?></th>
            <td><?= h($userSession->browser) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Platform') ?></th>
            <td><?= h($userSession->platform) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User Agent') ?></th>
            <td><?= h($userSession->user_agent) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User Id') ?></th>
            <td><?= $this->Number->format($userSession->user_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Public Ip') ?></th>
            <td><?= $this->Number->format($userSession->public_ip) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Login Time') ?></th>
            <td><?= h($userSession->login_time) ?></td>
        </tr>
    </table>
</div>
