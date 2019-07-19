<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SummaryHourly[]|\Cake\Collection\CollectionInterface $summaryHourly
 */
?>
<?= $this->Form->hidden('search_params',['id'=>'search_params', 'value'=>json_encode($_searchParams)]) ?>
<?= $this->Form->hidden('total_tests_breakdown',['id'=>'total_tests_breakdown', 'value'=>json_encode($totalTestsBreakdown)]) ?>
<?= $this->Form->hidden('company_breakdown',['id'=>'company_breakdown', 'value'=>json_encode($companyBreakdown)]) ?>
<?= $this->Form->hidden('company_names',['id'=>'company_names', 'value'=>json_encode($companyNames)]) ?>
<?= $this->Form->hidden('test_types',['id'=>'test_types', 'value'=>json_encode($testTypes)]) ?>
<?= $this->Form->hidden('total_test_count',['id'=>'total_test_count', 'value'=>json_encode($totalTestCount)]) ?>
<?= $this->Form->hidden('current_company_totals',['id'=>'current_company_totals', 'value'=>json_encode($currentCompanyTotals)]) ?>
<?= $this->Form->hidden('previous_company_totals',['id'=>'previous_company_totals', 'value'=>json_encode($previousCompanyTotals)]) ?>
<?= $this->Form->hidden('totals_dict',['id'=>'totals_dict', 'value'=>json_encode($totalsDict)]) ?>
<?= $this->Form->hidden('current_dict',['id'=>'current_dict', 'value'=>json_encode($currentTotalsDict)]) ?>
<?= $this->Form->hidden('previous_dict',['id'=>'previous_dict', 'value'=>json_encode($previousTotalsDict)]) ?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <?php if (isset($filters) && $filters): ?>
                <div class="span9 filterBox" style="display:inline-block; margin: 0 auto;">
                <?php
                    echo $this->Form->create(null, ['valueSources' => 'query']);
                    echo $this->Form->submit('',['style'=>'display:none;']);
                    /*Display filters dynamically made through controller*/
                    foreach ($filters as $key=>$value){
                        // debug($key);
                        // debug($value);
                        /*Append first option of dropdown as blank(without value and label) */
                        if(isset($value['options'])) {
                        /*If value options are object , it means we got direct query result so convert it to array for 
                        getting key value pairs for making select dropdown*/
                        if(is_object($value['options'])){
                            $options_v = $value['options']->find('all')->toArray();
                        }else{
                            $options_v = $value['options'];
                        }
                        $value['options'] = ['' => ''] + $options_v ;
                        } ?>
                        <div class="span2 widerFilter">
                            <div class="dropdown-container" name=<?php echo $value['id']?>>
                                <div class="dropdown-button noselect">
                                    <div class="dropdown-label"><?php echo $value['name'] ?></div>
                                    <div class="dropdown-quantity"><span name=<?php echo $value['id'] ?> class="quantity"></span></div>
                                </div>
                                <div class="dropdown-list" style="display: none;">
                                    <?= $this->Form->input($key, $value);?>
                                    <ul class="test_types" style="margin: 0">
                                        <?php if(isset($_GET[$value['id']])){
                                            if($value['id'] == 'test_type'){
                                                foreach ($testTypes as $value){
                                                    if(in_array($value->id, $_GET["test_type"])) { ?>
                                                        <li style="list-style-type: none">
                                                            <input name="test_type[]" value=<?php echo $value->id ?> type="checkbox" style="margin: 0" checked>
                                                            <label for="test_type"><?php echo $value->test_type ?></label>
                                                        </li>
                                                    <?php 
                                                    }
                                                    else { ?>
                                                        <li style="list-style-type: none">
                                                            <input name="test_type[]" value=<?php echo $value->id ?> type="checkbox" style="margin: 0">
                                                            <label for="test_type"><?php echo $value->test_type ?></label>
                                                        </li>
                                                    <?php
                                                    }
                                                }
                                            }
                                            elseif($value['id'] == 'company'){
                                                foreach ($companyNames as $value){
                                                    if(in_array($value->id, $_GET["company"])) { ?>
                                                        <li style="list-style-type: none">
                                                            <input name="company[]" value=<?php echo $value->id ?> type="checkbox" style="margin: 0" checked>
                                                            <label for="company"><?php echo $value->name ?></label>
                                                        </li>
                                                    <?php 
                                                    }
                                                    else { ?>
                                                        <li style="list-style-type: none">
                                                            <input name="company[]" value=<?php echo $value->id ?> type="checkbox" style="margin: 0">
                                                            <label for="company"><?php echo $value->name ?></label>
                                                        </li>
                                                    <?php
                                                    }
                                                }
                                            }
                                        }

                                        else {
                                            if($value['id'] == 'test_type'){
                                                foreach ($testTypes as $value){ ?>
                                                    <li style="list-style-type: none">
                                                        <input name="test_type[]" value=<?php echo $value->id ?> type="checkbox" style="margin: 0">
                                                        <label for="test_type"><?php echo $value->test_type ?></label>
                                                    </li>
                                                    <?php
                                                }
                                            }
                                            elseif($value['id'] == 'company'){
                                                foreach ($companyNames as $value){ ?>
                                                    <li style="list-style-type: none">
                                                        <input name="company[]" value=<?php echo $value->id ?> type="checkbox" style="margin: 0">
                                                        <label for="company"><?php echo $value->name ?></label>
                                                    </li>
                                                    <?php
                                                }
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="span2">
                        <div class="input text">       
                            <?= $this->Form->input('date', ['id'=>'date', 'placeholder'=>'Select Date Range', 'class'=>'customDateTimeRangePicker', 'label'=>false, 'required'=>'required', 'value'=>'{"start":"'.$drStartDate.'","end":"'.$drEndDate.'"}']); ?>
                        </div>
                    </div>
                    <div class="span2" style="margin-left:125px; display:flex;">
                        <?php
                        echo $this->Form->submit('Apply',
                                [
                                    'type' => 'submit',
                                    'id' => 'submit_button'
                                ]);
                        echo $this->Form->button('Reset', 
                                [
                                    'type' => 'button',
                                    'id' => 'reset_button',
                                    'onclick' => "location.href='".$this->Url->build(['action' => 'overall_tests'])."'"
                                ]
                            );
                        echo $this->Form->end();
                    ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="charts">
        <div id="barchart-container">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-signal"></i> </span>
                <h5>Overall Tests</h5>
            </div>
            <div class="widget-content">
                <div id="barchart-container">
                    <body>
                        <div id="chart_div" style="width: 1950px; height: 600px; z-index: 2;"></div>
                            <div class="total-container">
                                <div style="font-family:'Arial Black'; font-size: 16px; margin-right: 15px">Total Tests: <?= number_format($totalsDict['totalTests']) ?></div>
                                <div style="font-family:'Arial Black'; font-size: 16px; margin-right: 15px">Total PSTN: <?= number_format($totalsDict['totalPSTN']) ?></div>
                                <div style="font-family:'Arial Black'; font-size: 16px; margin-right: 15px">Total GSM: <?= number_format($totalsDict['totalGSM']) ?></div>
                                <div style="font-family:'Arial Black'; font-size: 16px;">Avg Tests: <?= number_format($totalsDict['avgTests'], 2) ?></div>
                            </div>
                        </div>
                    </body>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function myFunction() {
        console.log("Load");
        var container = $(this).closest('.dropdown-container');
        var numChecked = container. find('[type="checkbox"]:checked').length;
        container.find('.quantity').text(numChecked || 'Any');
    }
</script>