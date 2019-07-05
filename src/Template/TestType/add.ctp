<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TestType $testType
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Test Type'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="testType form large-9 medium-8 columns content">
    <?= $this->Form->create($testType) ?>
    <fieldset>
        <legend><?= __('Add Test Type') ?></legend>
        <?php
            echo $this->Form->control('application_id');
            echo $this->Form->control('test_type');
            echo $this->Form->control('description');
            echo $this->Form->control('status');
            echo $this->Form->control('job_processing_table');
            echo $this->Form->control('job_processing_rerun_table');
            echo $this->Form->control('score_type');
            echo $this->Form->control('pesq_table');
            echo $this->Form->control('pesq_rerun_table');
            echo $this->Form->control('polqa_table');
            echo $this->Form->control('polqa_rerun_table');
            echo $this->Form->control('reference_file');
            echo $this->Form->control('ref_file_length');
            echo $this->Form->control('checkin_timeout');
            echo $this->Form->control('no_of_prompts');
            echo $this->Form->control('upload_full_recording');
            echo $this->Form->control('campaign_style');
            echo $this->Form->control('has_alert');
            echo $this->Form->control('has_offset');
            echo $this->Form->control('has_gsm');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
