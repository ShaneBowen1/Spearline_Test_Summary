<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TestTypeForCompany[]|\Cake\Collection\CollectionInterface $testTypeForCompany
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Test Type For Company'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Company'), ['controller' => 'Company', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Company', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Test Type'), ['controller' => 'TestType', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Test Type'), ['controller' => 'TestType', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="testTypeForCompany index large-9 medium-8 columns content">
    <h3><?= __('Test Type For Company') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('company_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('test_type_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($testTypeForCompany as $testTypeForCompany): ?>
            <tr>
                <td><?= $testTypeForCompany->has('company') ? $this->Html->link($testTypeForCompany->company->name, ['controller' => 'Company', 'action' => 'view', $testTypeForCompany->company->id]) : '' ?></td>
                <td><?= $testTypeForCompany->has('test_type') ? $this->Html->link($testTypeForCompany->test_type->test_type, ['controller' => 'TestType', 'action' => 'view', $testTypeForCompany->test_type->id]) : '' ?></td>
                <td><?= $this->Number->format($testTypeForCompany->status) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $testTypeForCompany->company_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $testTypeForCompany->company_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $testTypeForCompany->company_id], ['confirm' => __('Are you sure you want to delete # {0}?', $testTypeForCompany->company_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
