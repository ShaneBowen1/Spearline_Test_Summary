<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SummaryHourly[]|\Cake\Collection\CollectionInterface $summaryHourly
 */
?>
<?= $this->Form->hidden('total_tests_breakdown',['id'=>'total_tests_breakdown', 'value'=>json_encode($totalTestsBreakdown)]) ?>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Summary Hourly'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="summaryHourly index large-9 medium-8 columns content">
    <h3><?= __('Summary Hourly') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('hour_timestamp') ?></th>
                <th scope="col"><?= $this->Paginator->sort('company_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('total_pstn_calls') ?></th>
                <th scope="col"><?= $this->Paginator->sort('total_gsm_calls') ?></th>
                <th scope="col"><?= $this->Paginator->sort('updated') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($summaryHourly as $summaryHourly): ?>
            <tr>
                <td><?= h($summaryHourly->hour_timestamp) ?></td>
                <td><?= $this->Number->format($summaryHourly->company_id) ?></td>
                <td><?= $this->Number->format($summaryHourly->total_pstn_calls) ?></td>
                <td><?= $this->Number->format($summaryHourly->total_gsm_calls) ?></td>
                <td><?= h($summaryHourly->updated) ?></td>
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
