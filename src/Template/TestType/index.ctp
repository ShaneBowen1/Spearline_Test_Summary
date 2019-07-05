<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TestType[]|\Cake\Collection\CollectionInterface $testType
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Test Type'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="testType index large-9 medium-8 columns content">
    <h3><?= __('Test Type') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('application_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('test_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('description') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('job_processing_table') ?></th>
                <th scope="col"><?= $this->Paginator->sort('job_processing_rerun_table') ?></th>
                <th scope="col"><?= $this->Paginator->sort('score_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('pesq_table') ?></th>
                <th scope="col"><?= $this->Paginator->sort('pesq_rerun_table') ?></th>
                <th scope="col"><?= $this->Paginator->sort('polqa_table') ?></th>
                <th scope="col"><?= $this->Paginator->sort('polqa_rerun_table') ?></th>
                <th scope="col"><?= $this->Paginator->sort('reference_file') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ref_file_length') ?></th>
                <th scope="col"><?= $this->Paginator->sort('checkin_timeout') ?></th>
                <th scope="col"><?= $this->Paginator->sort('no_of_prompts') ?></th>
                <th scope="col"><?= $this->Paginator->sort('upload_full_recording') ?></th>
                <th scope="col"><?= $this->Paginator->sort('campaign_style') ?></th>
                <th scope="col"><?= $this->Paginator->sort('has_alert') ?></th>
                <th scope="col"><?= $this->Paginator->sort('has_offset') ?></th>
                <th scope="col"><?= $this->Paginator->sort('has_gsm') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($testType as $testType): ?>
            <tr>
                <td><?= $this->Number->format($testType->id) ?></td>
                <td><?= $this->Number->format($testType->application_id) ?></td>
                <td><?= h($testType->test_type) ?></td>
                <td><?= h($testType->description) ?></td>
                <td><?= $this->Number->format($testType->status) ?></td>
                <td><?= h($testType->job_processing_table) ?></td>
                <td><?= h($testType->job_processing_rerun_table) ?></td>
                <td><?= $this->Number->format($testType->score_type) ?></td>
                <td><?= h($testType->pesq_table) ?></td>
                <td><?= h($testType->pesq_rerun_table) ?></td>
                <td><?= h($testType->polqa_table) ?></td>
                <td><?= h($testType->polqa_rerun_table) ?></td>
                <td><?= h($testType->reference_file) ?></td>
                <td><?= $this->Number->format($testType->ref_file_length) ?></td>
                <td><?= $this->Number->format($testType->checkin_timeout) ?></td>
                <td><?= $this->Number->format($testType->no_of_prompts) ?></td>
                <td><?= h($testType->upload_full_recording) ?></td>
                <td><?= $this->Number->format($testType->campaign_style) ?></td>
                <td><?= h($testType->has_alert) ?></td>
                <td><?= h($testType->has_offset) ?></td>
                <td><?= h($testType->has_gsm) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $testType->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $testType->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $testType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $testType->id)]) ?>
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
