<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CompanyExtension $companyExtension
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Company Extension'), ['action' => 'edit', $companyExtension->company_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Company Extension'), ['action' => 'delete', $companyExtension->company_id], ['confirm' => __('Are you sure you want to delete # {0}?', $companyExtension->company_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Company Extension'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Company Extension'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List User'), ['controller' => 'User', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'User', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="companyExtension view large-9 medium-8 columns content">
    <h3><?= h($companyExtension->company_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $companyExtension->has('user') ? $this->Html->link($companyExtension->user->name, ['controller' => 'User', 'action' => 'view', $companyExtension->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Company Id') ?></th>
            <td><?= $this->Number->format($companyExtension->company_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Company Type Id') ?></th>
            <td><?= $this->Number->format($companyExtension->company_type_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Manual Test Timeout') ?></th>
            <td><?= $this->Number->format($companyExtension->manual_test_timeout) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Gsm On Manual Test') ?></th>
            <td><?= $companyExtension->gsm_on_manual_test ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Api Doc Access') ?></th>
            <td><?= $companyExtension->api_doc_access ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Management Report Access') ?></th>
            <td><?= $companyExtension->management_report_access ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Has Gsm') ?></th>
            <td><?= $companyExtension->has_gsm ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('View Passcode Tag') ?></th>
            <td><?= $companyExtension->view_passcode_tag ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
