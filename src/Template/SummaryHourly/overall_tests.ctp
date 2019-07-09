<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SummaryHourly[]|\Cake\Collection\CollectionInterface $summaryHourly
 */
?>
<?= $this->Form->hidden('total_tests_breakdown',['id'=>'total_tests_breakdown', 'value'=>json_encode($totalTestsBreakdown)]) ?>
<?= $this->Form->hidden('company_breakdown',['id'=>'company_breakdown', 'value'=>json_encode($companyBreakdown)]) ?>
<?= $this->Form->hidden('company_names',['id'=>'company_names', 'value'=>json_encode($companyNames)]) ?>
<?= $this->Form->hidden('total_tests',['id'=>'total_tests', 'value'=>json_encode($totalTests)]) ?>
<?= $this->Form->hidden('total_pstn',['id'=>'total_pstn', 'value'=>json_encode($totalPSTN)]) ?>
<?= $this->Form->hidden('total_gsm',['id'=>'total_gsm', 'value'=>json_encode($totalGSM)]) ?>
<?= $this->Form->hidden('avg_tests',['id'=>'avg_tests', 'value'=>json_encode($avgTests)]) ?>
<?= $this->Form->hidden('test_types',['id'=>'test_types', 'value'=>json_encode($testTypes)]) ?>
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
                        }
                    ?>
                        <div class="span2 widerFilter">
                            <div class="dropdown-container">
                                <div class="dropdown-button noselect">
                                    <div class="dropdown-label">Test Types</div>
                                    <div class="dropdown-quantity">(<span class="quantity">Any</span>)</div>
                                </div>
                                <div class="dropdown-list" style="display: none;">
                                    <?= $this->Form->input($key, $value);?>
                                    <ul class="test_types"></ul>
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
                    <div class="span2" style="margin-left:125px;">
                        <?php
                        //echo $this->Html->link('Reset', ['action' => 'index']);
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
    
    <!-- <div class="charts">
        <div id="barchart-container">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-signal"></i> </span>
                    <h5>Overall Testing Page</h5>
        <body>
            <div id="curve_chart" style="width: 1800px; height: 600px"></div>
        </body>
    </div> -->

    <div class="charts">
        <div id="barchart-container">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-signal"></i> </span>
                <h5>Overall Tests</h5>
            </div>
            <div class="widget-content">
                <div id="barchart-container">
                    <body>
                        <div id="chart_div" style="width: 1800px; height: 600px; z-index: 2;"></div>
                        <div class="overlay">
                            <div style="font-family:'Arial Black'; font-size: 16px; margin-right: 15px">Total Tests: <?= number_format($totalTests) ?></div>
                            <div style="font-family:'Arial Black'; font-size: 16px; margin-right: 15px">Total PSTN: <?= number_format($totalPSTN) ?></div>
                            <div style="font-family:'Arial Black'; font-size: 16px; margin-right: 15px">Total GSM: <?= number_format($totalGSM) ?></div>
                            <div style="font-family:'Arial Black'; font-size: 16px;">Avg Tests: <?= number_format($avgTests, 2) ?></div>
                        </div>
                    </body>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    var test_types = JSON.parse($('#test_types').val());
    console.log(test_types);

    // Events
    $('.dropdown-container')
    .on('click', '.dropdown-button', function() {
        console.log('click');
        $(this).siblings('.dropdown-list').toggle();
    })
    .on('input', '.dropdown-search', function() {
        var target = $(this);
        var dropdownList = target.closest('.dropdown-list');
        var search = target.val().toLowerCase();
        if (!search) {
            dropdownList.find('li').show();
            return false;
        }
        dropdownList.find('li').each(function() {
            var text = $(this).text().toLowerCase();
            var match = text.indexOf(search) > -1;
            $(this).toggle(match);
        });
    })
    .on('change', '[type="checkbox"]', function() {
        var container = $(this).closest('.dropdown-container');
        var numChecked = container. find('[type="checkbox"]:checked').length;
        container.find('.quantity').text(numChecked || 'Any');
    });

    var stateTemplate = _.template(
        '<li>' +
            '<input name="<%= id %>" type="checkbox">' +
            '<label for="<%= id %>"><%= capName %></label>' +
        '</li>'
    );
    
    // Populate list with test types
    _.each(test_types, function(s) {
        console.log(s.id)
        s.capName = s.test_type.toLowerCase();
        $('.test_types').append(stateTemplate(s));
    });


    function myFunction() {
    document.getElementById("dropdown-list").classList.toggle("show");
    }

    function filterFunction() {
        var input, filter, ul, li, a, i;
        input = document.getElementById("testTypeSearch");
        filter = input.value.toUpperCase();
        div = document.getElementById("dropdown-list");
        a = div.getElementsByTagName("a");
        for (i = 0; i < a.length; i++) {
            txtValue = a[i].textContent || a[i].innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
            a[i].style.display = "";
            } else {
            a[i].style.display = "none";
            }
        }
    }
</script> 