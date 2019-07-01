<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Company $company
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Company'), ['action' => 'edit', $company->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Company'), ['action' => 'delete', $company->id], ['confirm' => __('Are you sure you want to delete # {0}?', $company->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Company'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Company'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Company'), ['controller' => 'Company', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Company', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="company view large-9 medium-8 columns content">
    <h3><?= h($company->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($company->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Address') ?></th>
            <td><?= h($company->address) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('City') ?></th>
            <td><?= h($company->city) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Phone') ?></th>
            <td><?= h($company->phone) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($company->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Logo') ?></th>
            <td><?= h($company->logo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Report Logo') ?></th>
            <td><?= h($company->report_logo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Company') ?></th>
            <td><?= $company->has('company') ? $this->Html->link($company->company->name, ['controller' => 'Company', 'action' => 'view', $company->company->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Url') ?></th>
            <td><?= h($company->url) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Api Key') ?></th>
            <td><?= h($company->api_key) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($company->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Country Code Id') ?></th>
            <td><?= $this->Number->format($company->country_code_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Style Id') ?></th>
            <td><?= $this->Number->format($company->style_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Currency Code Id') ?></th>
            <td><?= $this->Number->format($company->currency_code_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('No Of Users Allowed') ?></th>
            <td><?= $this->Number->format($company->no_of_users_allowed) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Campaign Style') ?></th>
            <td><?= $this->Number->format($company->campaign_style) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ivr Traversal Id') ?></th>
            <td><?= $this->Number->format($company->ivr_traversal_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($company->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($company->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Old Id') ?></th>
            <td><?= $this->Number->format($company->old_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Expire On') ?></th>
            <td><?= h($company->expire_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created On') ?></th>
            <td><?= h($company->created_on) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Show Benchmarks') ?></th>
            <td><?= $company->show_benchmarks ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Has Campaign Report') ?></th>
            <td><?= $company->has_campaign_report ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
