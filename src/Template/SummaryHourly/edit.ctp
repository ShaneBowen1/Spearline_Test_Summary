<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SummaryHourly $summaryHourly
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $summaryHourly->hour_timestamp, company_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $summaryHourly->hour_timestamp, company_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Summary Hourly'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Company'), ['controller' => 'Company', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Company', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="summaryHourly form large-9 medium-8 columns content">
    <?= $this->Form->create($summaryHourly) ?>
    <fieldset>
        <legend><?= __('Edit Summary Hourly') ?></legend>
        <?php
            echo $this->Form->control('hour_timestamp');
            echo $this->Form->control('company_id', ['options' => $company]);
            echo $this->Form->control('test_type_id');
            echo $this->Form->control('total_pstn_calls');
            echo $this->Form->control('total_gsm_calls');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
