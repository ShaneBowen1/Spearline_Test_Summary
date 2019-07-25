<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ApplicationForCompany $applicationForCompany
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Application For Company'), ['action' => 'edit', $applicationForCompany->company_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Application For Company'), ['action' => 'delete', $applicationForCompany->company_id], ['confirm' => __('Are you sure you want to delete # {0}?', $applicationForCompany->company_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Application For Company'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Application For Company'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Company'), ['controller' => 'Company', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Company', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="applicationForCompany view large-9 medium-8 columns content">
    <h3><?= h($applicationForCompany->company_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Company') ?></th>
            <td><?= $applicationForCompany->has('company') ? $this->Html->link($applicationForCompany->company->name, ['controller' => 'Company', 'action' => 'view', $applicationForCompany->company->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Application Id') ?></th>
            <td><?= $this->Number->format($applicationForCompany->application_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($applicationForCompany->status) ?></td>
        </tr>
    </table>
</div>
