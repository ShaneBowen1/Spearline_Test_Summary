<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CompanyExtension[]|\Cake\Collection\CollectionInterface $companyExtension
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Company Extension'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List User'), ['controller' => 'User', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'User', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="companyExtension index large-9 medium-8 columns content">
    <h3><?= __('Company Extension') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('company_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('company_type_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('account_manager_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('manual_test_timeout') ?></th>
                <th scope="col"><?= $this->Paginator->sort('gsm_on_manual_test') ?></th>
                <th scope="col"><?= $this->Paginator->sort('api_doc_access') ?></th>
                <th scope="col"><?= $this->Paginator->sort('management_report_access') ?></th>
                <th scope="col"><?= $this->Paginator->sort('has_gsm') ?></th>
                <th scope="col"><?= $this->Paginator->sort('view_passcode_tag') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($companyExtension as $companyExtension): ?>
            <tr>
                <td><?= $this->Number->format($companyExtension->company_id) ?></td>
                <td><?= $this->Number->format($companyExtension->company_type_id) ?></td>
                <td><?= $companyExtension->has('user') ? $this->Html->link($companyExtension->user->name, ['controller' => 'User', 'action' => 'view', $companyExtension->user->id]) : '' ?></td>
                <td><?= $this->Number->format($companyExtension->manual_test_timeout) ?></td>
                <td><?= h($companyExtension->gsm_on_manual_test) ?></td>
                <td><?= h($companyExtension->api_doc_access) ?></td>
                <td><?= h($companyExtension->management_report_access) ?></td>
                <td><?= h($companyExtension->has_gsm) ?></td>
                <td><?= h($companyExtension->view_passcode_tag) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $companyExtension->company_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $companyExtension->company_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $companyExtension->company_id], ['confirm' => __('Are you sure you want to delete # {0}?', $companyExtension->company_id)]) ?>
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
