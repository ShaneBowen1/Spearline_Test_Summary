<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SummaryHourly[]|\Cake\Collection\CollectionInterface $summaryHourly
 */
?>
<?= $this->Form->hidden('total_tests_breakdown',['id'=>'total_tests_breakdown', 'value'=>json_encode($totalTestsBreakdown)]) ?>
    <div class="summaryHourly index large-9 medium-8 columns content">
        <h3><?= __('Overall Testing Page') ?></h3>
        <body>
            <div id="curve_chart" style="width: 1800px; height: 600px"></div>
        </body>
    </div>