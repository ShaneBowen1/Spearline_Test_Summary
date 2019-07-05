<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SummaryHourly[]|\Cake\Collection\CollectionInterface $summaryHourly
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Summary Hourly'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Company'), ['controller' => 'Company', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Company', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="summaryHourly index large-9 medium-8 columns content">
    <h3><?= __('Summary Hourly') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('hour_timestamp') ?></th>
                <th scope="col"><?= $this->Paginator->sort('company_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('test_type_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('total_pstn_calls') ?></th>
                <th scope="col"><?= $this->Paginator->sort('total_gsm_calls') ?></th>
                <th scope="col"><?= $this->Paginator->sort('updated') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($summaryHourly as $summaryHourly): ?>
            <tr>
                <td><?= h($summaryHourly->hour_timestamp) ?></td>
                <td><?= $summaryHourly->has('company') ? $this->Html->link($summaryHourly->company->name, ['controller' => 'Company', 'action' => 'view', $summaryHourly->company->id]) : '' ?></td>
                <td><?= $this->Number->format($summaryHourly->test_type_id) ?></td>
                <td><?= $this->Number->format($summaryHourly->total_pstn_calls) ?></td>
                <td><?= $this->Number->format($summaryHourly->total_gsm_calls) ?></td>
                <td><?= h($summaryHourly->updated) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $summaryHourly->hour_timestamp, company_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $summaryHourly->hour_timestamp, company_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $summaryHourly->hour_timestamp, company_id], ['confirm' => __('Are you sure you want to delete # {0}?', $summaryHourly->hour_timestamp, company_id)]) ?>
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
