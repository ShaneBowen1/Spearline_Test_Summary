<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TestTypeForCompany $testTypeForCompany
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Test Type For Company'), ['action' => 'edit', $testTypeForCompany->company_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Test Type For Company'), ['action' => 'delete', $testTypeForCompany->company_id], ['confirm' => __('Are you sure you want to delete # {0}?', $testTypeForCompany->company_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Test Type For Company'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Test Type For Company'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Company'), ['controller' => 'Company', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Company', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Test Type'), ['controller' => 'TestType', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Test Type'), ['controller' => 'TestType', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="testTypeForCompany view large-9 medium-8 columns content">
    <h3><?= h($testTypeForCompany->company_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Company') ?></th>
            <td><?= $testTypeForCompany->has('company') ? $this->Html->link($testTypeForCompany->company->name, ['controller' => 'Company', 'action' => 'view', $testTypeForCompany->company->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Test Type') ?></th>
            <td><?= $testTypeForCompany->has('test_type') ? $this->Html->link($testTypeForCompany->test_type->test_type, ['controller' => 'TestType', 'action' => 'view', $testTypeForCompany->test_type->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($testTypeForCompany->status) ?></td>
        </tr>
    </table>
</div>
