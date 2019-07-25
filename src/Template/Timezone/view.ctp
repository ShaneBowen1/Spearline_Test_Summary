<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Timezone $timezone
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Timezone'), ['action' => 'edit', $timezone->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Timezone'), ['action' => 'delete', $timezone->id], ['confirm' => __('Are you sure you want to delete # {0}?', $timezone->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Timezone'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Timezone'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List User'), ['controller' => 'User', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'User', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="timezone view large-9 medium-8 columns content">
    <h3><?= h($timezone->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Ui Name') ?></th>
            <td><?= h($timezone->ui_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Timezone') ?></th>
            <td><?= h($timezone->timezone) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($timezone->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($timezone->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($timezone->status) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related User') ?></h4>
        <?php if (!empty($timezone->user)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Company Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?= __('Sms') ?></th>
                <th scope="col"><?= __('Country Code Id') ?></th>
                <th scope="col"><?= __('Timezone Id') ?></th>
                <th scope="col"><?= __('Department Id') ?></th>
                <th scope="col"><?= __('Login Name') ?></th>
                <th scope="col"><?= __('Password') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Edited On') ?></th>
                <th scope="col"><?= __('Show') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Backendadmin') ?></th>
                <th scope="col"><?= __('Old Id') ?></th>
                <th scope="col"><?= __('Role Id') ?></th>
                <th scope="col"><?= __('Api Access') ?></th>
                <th scope="col"><?= __('Login Token') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($timezone->user as $user): ?>
            <tr>
                <td><?= h($user->id) ?></td>
                <td><?= h($user->company_id) ?></td>
                <td><?= h($user->name) ?></td>
                <td><?= h($user->email) ?></td>
                <td><?= h($user->sms) ?></td>
                <td><?= h($user->country_code_id) ?></td>
                <td><?= h($user->timezone_id) ?></td>
                <td><?= h($user->department_id) ?></td>
                <td><?= h($user->login_name) ?></td>
                <td><?= h($user->password) ?></td>
                <td><?= h($user->created_by) ?></td>
                <td><?= h($user->created_on) ?></td>
                <td><?= h($user->edited_on) ?></td>
                <td><?= h($user->show) ?></td>
                <td><?= h($user->status) ?></td>
                <td><?= h($user->backendadmin) ?></td>
                <td><?= h($user->old_id) ?></td>
                <td><?= h($user->role_id) ?></td>
                <td><?= h($user->api_access) ?></td>
                <td><?= h($user->login_token) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'User', 'action' => 'view', $user->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'User', 'action' => 'edit', $user->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'User', 'action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
