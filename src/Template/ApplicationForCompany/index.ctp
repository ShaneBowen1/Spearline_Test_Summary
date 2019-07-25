<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ApplicationForCompany[]|\Cake\Collection\CollectionInterface $applicationForCompany
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Application For Company'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Company'), ['controller' => 'Company', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Company', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="applicationForCompany index large-9 medium-8 columns content">
    <h3><?= __('Application For Company') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('company_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('application_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($applicationForCompany as $applicationForCompany): ?>
            <tr>
                <td><?= $applicationForCompany->has('company') ? $this->Html->link($applicationForCompany->company->name, ['controller' => 'Company', 'action' => 'view', $applicationForCompany->company->id]) : '' ?></td>
                <td><?= $this->Number->format($applicationForCompany->application_id) ?></td>
                <td><?= $this->Number->format($applicationForCompany->status) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $applicationForCompany->company_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $applicationForCompany->company_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $applicationForCompany->company_id], ['confirm' => __('Are you sure you want to delete # {0}?', $applicationForCompany->company_id)]) ?>
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
