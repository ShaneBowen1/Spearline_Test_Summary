<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Role $role
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Role'), ['action' => 'edit', $role->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Role'), ['action' => 'delete', $role->id], ['confirm' => __('Are you sure you want to delete # {0}?', $role->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Role'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Role'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List User'), ['controller' => 'User', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'User', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Company'), ['controller' => 'Company', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Company', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="role view large-9 medium-8 columns content">
    <h3><?= h($role->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($role->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($role->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($role->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Company Id') ?></th>
            <td><?= $this->Number->format($role->company_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($role->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($role->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($role->created_on) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Company') ?></h4>
        <?php if (!empty($role->company)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Address') ?></th>
                <th scope="col"><?= __('City') ?></th>
                <th scope="col"><?= __('Country Code Id') ?></th>
                <th scope="col"><?= __('Phone') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?= __('Logo') ?></th>
                <th scope="col"><?= __('Report Logo') ?></th>
                <th scope="col"><?= __('Parent Company Id') ?></th>
                <th scope="col"><?= __('Style Id') ?></th>
                <th scope="col"><?= __('Url') ?></th>
                <th scope="col"><?= __('Currency Code Id') ?></th>
                <th scope="col"><?= __('No Of Users Allowed') ?></th>
                <th scope="col"><?= __('Campaign Style') ?></th>
                <th scope="col"><?= __('Api Key') ?></th>
                <th scope="col"><?= __('Show Benchmarks') ?></th>
                <th scope="col"><?= __('Ivr Traversal Id') ?></th>
                <th scope="col"><?= __('Has Campaign Report') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Expire On') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Created On') ?></th>
                <th scope="col"><?= __('Old Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($role->company as $company): ?>
            <tr>
                <td><?= h($company->id) ?></td>
                <td><?= h($company->name) ?></td>
                <td><?= h($company->address) ?></td>
                <td><?= h($company->city) ?></td>
                <td><?= h($company->country_code_id) ?></td>
                <td><?= h($company->phone) ?></td>
                <td><?= h($company->email) ?></td>
                <td><?= h($company->logo) ?></td>
                <td><?= h($company->report_logo) ?></td>
                <td><?= h($company->parent_company_id) ?></td>
                <td><?= h($company->style_id) ?></td>
                <td><?= h($company->url) ?></td>
                <td><?= h($company->currency_code_id) ?></td>
                <td><?= h($company->no_of_users_allowed) ?></td>
                <td><?= h($company->campaign_style) ?></td>
                <td><?= h($company->api_key) ?></td>
                <td><?= h($company->show_benchmarks) ?></td>
                <td><?= h($company->ivr_traversal_id) ?></td>
                <td><?= h($company->has_campaign_report) ?></td>
                <td><?= h($company->status) ?></td>
                <td><?= h($company->expire_on) ?></td>
                <td><?= h($company->created_by) ?></td>
                <td><?= h($company->created_on) ?></td>
                <td><?= h($company->old_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Company', 'action' => 'view', $company->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Company', 'action' => 'edit', $company->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Company', 'action' => 'delete', $company->id], ['confirm' => __('Are you sure you want to delete # {0}?', $company->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related User') ?></h4>
        <?php if (!empty($role->user)): ?>
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
            <?php foreach ($role->user as $user): ?>
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
