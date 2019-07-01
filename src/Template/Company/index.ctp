<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Company[]|\Cake\Collection\CollectionInterface $company
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Company'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="company index large-9 medium-8 columns content">
    <h3><?= __('Company') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('address') ?></th>
                <th scope="col"><?= $this->Paginator->sort('city') ?></th>
                <th scope="col"><?= $this->Paginator->sort('country_code_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('phone') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('logo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('report_logo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('parent_company_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('style_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('url') ?></th>
                <th scope="col"><?= $this->Paginator->sort('currency_code_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('no_of_users_allowed') ?></th>
                <th scope="col"><?= $this->Paginator->sort('campaign_style') ?></th>
                <th scope="col"><?= $this->Paginator->sort('api_key') ?></th>
                <th scope="col"><?= $this->Paginator->sort('show_benchmarks') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ivr_traversal_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('has_campaign_report') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('expire_on') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_by') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_on') ?></th>
                <th scope="col"><?= $this->Paginator->sort('old_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($company as $company): ?>
            <tr>
                <td><?= $this->Number->format($company->id) ?></td>
                <td><?= h($company->name) ?></td>
                <td><?= h($company->address) ?></td>
                <td><?= h($company->city) ?></td>
                <td><?= $this->Number->format($company->country_code_id) ?></td>
                <td><?= h($company->phone) ?></td>
                <td><?= h($company->email) ?></td>
                <td><?= h($company->logo) ?></td>
                <td><?= h($company->report_logo) ?></td>
                <td><?= $company->has('company') ? $this->Html->link($company->company->name, ['controller' => 'Company', 'action' => 'view', $company->company->id]) : '' ?></td>
                <td><?= $this->Number->format($company->style_id) ?></td>
                <td><?= h($company->url) ?></td>
                <td><?= $this->Number->format($company->currency_code_id) ?></td>
                <td><?= $this->Number->format($company->no_of_users_allowed) ?></td>
                <td><?= $this->Number->format($company->campaign_style) ?></td>
                <td><?= h($company->api_key) ?></td>
                <td><?= h($company->show_benchmarks) ?></td>
                <td><?= $this->Number->format($company->ivr_traversal_id) ?></td>
                <td><?= h($company->has_campaign_report) ?></td>
                <td><?= $this->Number->format($company->status) ?></td>
                <td><?= h($company->expire_on) ?></td>
                <td><?= $this->Number->format($company->created_by) ?></td>
                <td><?= h($company->created_on) ?></td>
                <td><?= $this->Number->format($company->old_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $company->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $company->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $company->id], ['confirm' => __('Are you sure you want to delete # {0}?', $company->id)]) ?>
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
