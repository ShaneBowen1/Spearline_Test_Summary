<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TestType $testType
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Test Type'), ['action' => 'edit', $testType->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Test Type'), ['action' => 'delete', $testType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $testType->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Test Type'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Test Type'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="testType view large-9 medium-8 columns content">
    <h3><?= h($testType->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Test Type') ?></th>
            <td><?= h($testType->test_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($testType->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Job Processing Table') ?></th>
            <td><?= h($testType->job_processing_table) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Job Processing Rerun Table') ?></th>
            <td><?= h($testType->job_processing_rerun_table) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Pesq Table') ?></th>
            <td><?= h($testType->pesq_table) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Pesq Rerun Table') ?></th>
            <td><?= h($testType->pesq_rerun_table) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Polqa Table') ?></th>
            <td><?= h($testType->polqa_table) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Polqa Rerun Table') ?></th>
            <td><?= h($testType->polqa_rerun_table) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Reference File') ?></th>
            <td><?= h($testType->reference_file) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($testType->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Application Id') ?></th>
            <td><?= $this->Number->format($testType->application_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($testType->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Score Type') ?></th>
            <td><?= $this->Number->format($testType->score_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ref File Length') ?></th>
            <td><?= $this->Number->format($testType->ref_file_length) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Checkin Timeout') ?></th>
            <td><?= $this->Number->format($testType->checkin_timeout) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('No Of Prompts') ?></th>
            <td><?= $this->Number->format($testType->no_of_prompts) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Campaign Style') ?></th>
            <td><?= $this->Number->format($testType->campaign_style) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Upload Full Recording') ?></th>
            <td><?= $testType->upload_full_recording ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Has Alert') ?></th>
            <td><?= $testType->has_alert ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Has Offset') ?></th>
            <td><?= $testType->has_offset ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Has Gsm') ?></th>
            <td><?= $testType->has_gsm ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
