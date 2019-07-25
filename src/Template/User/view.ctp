<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <li><?= $this->Html->link(__('List User'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Company'), ['controller' => 'Company', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Company', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="user view large-9 medium-8 columns content">
    <h3><?= h($user->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Company') ?></th>
            <td><?= $user->has('company') ? $this->Html->link($user->company->name, ['controller' => 'Company', 'action' => 'view', $user->company->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($user->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sms') ?></th>
            <td><?= h($user->sms) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Login Name') ?></th>
            <td><?= h($user->login_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Password') ?></th>
            <td><?= h($user->password) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Login Token') ?></th>
            <td><?= h($user->login_token) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Country Code Id') ?></th>
            <td><?= $this->Number->format($user->country_code_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Timezone Id') ?></th>
            <td><?= $this->Number->format($user->timezone_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Department Id') ?></th>
            <td><?= $this->Number->format($user->department_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($user->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($user->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Old Id') ?></th>
            <td><?= $this->Number->format($user->old_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Role Id') ?></th>
            <td><?= $this->Number->format($user->role_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($user->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Edited On') ?></th>
            <td><?= h($user->edited_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Show') ?></th>
            <td><?= $user->show ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Backendadmin') ?></th>
            <td><?= $user->backendadmin ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Api Access') ?></th>
            <td><?= $user->api_access ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
