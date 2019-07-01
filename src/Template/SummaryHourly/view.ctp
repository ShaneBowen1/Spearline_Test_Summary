<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SummaryHourly $summaryHourly
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Summary Hourly'), ['action' => 'edit', $summaryHourly->hour_timestamp, company_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Summary Hourly'), ['action' => 'delete', $summaryHourly->hour_timestamp, company_id], ['confirm' => __('Are you sure you want to delete # {0}?', $summaryHourly->hour_timestamp, company_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Summary Hourly'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Summary Hourly'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="summaryHourly view large-9 medium-8 columns content">
    <h3><?= h($summaryHourly->hour_timestamp, company_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Company Id') ?></th>
            <td><?= $this->Number->format($summaryHourly->company_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Total Pstn Calls') ?></th>
            <td><?= $this->Number->format($summaryHourly->total_pstn_calls) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Total Gsm Calls') ?></th>
            <td><?= $this->Number->format($summaryHourly->total_gsm_calls) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hour Timestamp') ?></th>
            <td><?= h($summaryHourly->hour_timestamp) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Updated') ?></th>
            <td><?= $summaryHourly->updated ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
