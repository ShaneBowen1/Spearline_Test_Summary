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
    <body>
        <div id="curve_chart" style="width: 900px; height: 500px"></div>
    </body>
</div>
