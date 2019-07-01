$( document ).ready(function() {
    var getUrl = window.location.pathname;
    var hid_form_submit = false;

    //when user clicks forgot password button 
     $( '#login-forgotpassword' ).click( function() {
        $( '#login-footer' ).toggleClass( 'hiddenelem' );
        $( "#text-forgotpassword" ).toggleClass( 'hiddenelem' ); //because is not enaugh space in the box;
        $( "#text-forgotpassword_login" ).toggleClass( 'hiddenelem' ); //because is not enaugh space in the box;
        $( '.message' ).addClass( 'hiddenelem' ); //because is not enaugh space in the box;
        $( '#login-credentials' ).toggleClass( 'hiddenelem' ); //because is not enaugh space in the box;
    })

    //when user clicks add button the add Modal form opens
    $("#add_button").click(function(){
        $("#loadingDiv").show();
        var dataURL = $(this).attr('data-href');
        $('.modal-body').load(dataURL,function(){
            $('[id*="addModal"]').modal('show');
            $(".modal-footer").removeClass('success error');
            $(".modal-footer p").html('');
            $("#loadingDiv").hide();
        });
    });

    //when user clicks edit  button the edit Modal form opens
    $(".editButton").click(function(){
        $("#loadingDiv").show();
        var dataURL = $(this).attr('data-href');
        $('.modal-body').load(dataURL,function(){
            $('[id*="editModal"]').modal('show');
            $(".modal-footer").removeClass('success error');
            $(".modal-footer p").html('');
            $("#loadingDiv").hide();
        });
    });

    //when user clicks add button the add Modal form opens
    $(".contact").click(function(){
        $("#loadingDiv").show();
        var dataURL = $(this).attr('data-href');
        $('.modal-body').load(dataURL,function(){
            $('[id*="contactModal"]').modal('show');
            $(".modal-footer").removeClass('success error');
            $(".modal-footer p").html('');
            $("#loadingDiv").hide();
        });
    });
    
    $(".loadModal").click(function(){
        var dataURL = $(this).attr('data-href');
        $('.modal-content').load(dataURL,function(){
            $("#loadingDiv").hide();
        });
    });

    //when user clicks breakdown button the breakdown Modal form opens
    $(".breakdownButton").click(function(){
        var id = this.id;
        var mapObj = {
            countries:"Country",
            test_types:" Test_type",
            number_type:"Number_type",
            call_type: "Call_type",
            bundle: "Bundle",
            daily: "Date"
         };
        var lastIndex = this.id.lastIndexOf('_');
        var company_id = id.substr(lastIndex + 1,id.lenght);
        var breakdown = id.substr(0,lastIndex);
        var data = JSON.parse($("#data").val());
        var test_types = JSON.parse($("#test_type_data").val());

        var breakdown_heading = breakdown.replace(/countries|test_types|number_type|call_type|bundle|daily/gi, function(matched){
            return mapObj[matched];
        });

        $('#' + breakdown).modal('show');
        var title = data[company_id]['name'] + ' ' + breakdown.replace('_',' ') + ' breakdown';
        $('#'+ breakdown + '_breakdown_title').html("");
        $('#'+ breakdown + '_breakdown_body').html("");
        $('#'+ breakdown + '_breakdown_title').append(title);

        var html = "<div class='row-fluid'>" +
                        "<div class='span12'>" +
                            "<div class='widget-box'>" +
                                "<div class='widget-content nopadding'>"+
                                    "<table cellpadding='0' cellspacing='0' class='table table-bordered data-table dataTable' id ='billingTable'>"+
                                        "<tr><th>" + breakdown_heading.replace('_',' ') + "</th><th>Total test</th><th>Total revenue</th></tr>";

        for (var row in data[company_id][breakdown]) {
            var billable_calls = data[company_id][breakdown][row]['billable_calls'];
            var revenue = data[company_id][breakdown][row]['revenue'];
            if (breakdown == 'test_types') {
                row = test_types[row];
            }

            if(breakdown == 'bundle'){
                html += "<tr><th colspan=3>" + row + "</th></tr>";
                var bundles = data[company_id][breakdown][row];
                for(var bundle in bundles){
                    console.log(data[company_id]['currency_symbol']);
                    if(bundle == 0){
                        bundle_name = 'Additional';
                    }
                    else{
                        bundle_name = bundle;
                    }
                    html += "<tr><td>" + bundle_name + "</td><td>" + data[company_id][breakdown][row][bundle]['total_tests'] + "</td><td>" + data[company_id]['currency_symbol'] + data[company_id][breakdown][row][bundle]['revenue'] + "</td></tr>"
                }
            }
            else{
                html += "<tr><td>" + row + "</td><td>" + billable_calls + "</td><td>&euro;" + revenue + "</td></tr>"
            }
        }
        $('#'+ breakdown + '_breakdown_body').append(html);
    });

    /*On change event of filter dropdowns on index page*/
    $(document).on("change", "#country, #call_start_time, #date, #company, #is-gsm, #filter_date_range, #number-type-id, #test-type, #contracted, #provider", function(){
        $(this).parents('form').submit();
    });



    /*Toggle options dropdown on index page*/
    $('#more_options').on( "click", function() {
        $('#more_options_list').toggleClass("hiddenElement");
    });


    //when user changes timezone update session
    $('.currency_rate_1, .currency_rate_3, .currency_rate_4').change(function() {
        $.ajax({
            type: "POST",
            url: window.location.origin +"/billing-summary-daily/change_rate",
            data: {currency_code_id:$(this).attr('id'), rate: $(this).val()},
            cache: false,
            success: function(response){
                location.reload();
            },
            error: function(xhr,textStatus,error){
                alert(error);
            }
        });
        return false;
    });


    $(".filterBox select").select2({
        allowClear: true
    });

    $(".filterBox #provider").select2({
        placeholder: 'Provider',
        allowClear: true
    });

    $(".filterBox #company").select2({
        placeholder: 'Company',
        allowClear: true
    });

    $(".filterBox #country").select2({
        placeholder: 'Country',
        allowClear: true
    });

    $(".filterBox #number-type-id").select2({
        placeholder: 'Number Type',
        allowClear: true
    });

    $(".filterBox #test-type").select2({
        placeholder: 'Test Type',
        allowClear: true
    });

    $(".filterBox #is-gsm").select2({
        placeholder: 'Call Type',
        allowClear: true
    });

    $(".filterBox #contracted").select2({
        placeholder: 'Contract',
        allowClear: true
    });

  
  
    /*refresh page after modal closes*/
    $('.close').on( "click", function() {
        /*Reload page on popup close only if form is submitted else just close popup*/
        if(hid_form_submit){
            location.reload();
        }
    });


    $('.ModalBox').on('submit' ,function(e){
        e.preventDefault();
        /*Get id of parent div for currently opened modal box*/
        modalParentId = $(this).closest('div.modal').attr("id");
        //alert(modalParentId);
        $.ajax({
            type: "POST",
            url: $(this).prop('action'),
            data: new FormData( this ),
            cache: false,
            processData: false, // Don't process the files
            contentType: false, // Set content type to false as jQuery will tell the server its a query string request
            beforeSend: function(){
                // Show image container
                $("#loadingDiv").show();
            },
            success: function(response){
                /*Parse json response and display in popup footer*/
                /*JSON.parse throws syntax issue when response is not having proper data i.e. it just have html*/
                //console.log("response = " + response.status);
                try
                {
                    var response = JSON.parse(response);

                    /*Useful in case of import only*/
                    var html = '';
                    var error_type = '';
                    var errorsArray = [];

                    $(".ajax_message").text(response['message']);
                    $(".modal-footer").removeClass('success error');
                    $(".modal-footer").addClass(response['class']);
                    /*Set variable true only if form is successfully submitted*/
                    hid_form_submit = true;
                }catch(e){
                    $(".ajax_message").text('Error while getting response!!!');
                    $(".modal-footer").removeClass('success error');
                    $(".modal-footer").addClass('error');
                }
            },
            error: function(xhr,textStatus,error){
                alert(error);
            },
            complete:function(data){
                // Hide image container
                $("#loadingDiv").hide();
            }
        });
        return false;
    });

    /*Flushing old messages from modal footer*/
    $('.modal').on('hidden.bs.modal', function (e) {
        $(".ajax_message").text('');
        $(".modal-footer").removeClass('success error');
    });

    /*Adjust modal box height as per content*/
    $('.modal').on('show.bs.modal', function () {
        $('.modal .modal-body').css('overflow-y', 'auto');
        $('.modal .modal-body').css('max-height', $(window).height() * 0.7);
    });

    /*Initialize bootstrap dropdown toggle menu*/
    $(".dropdown-toggle").dropdown();

    /*Submit form on selecting second date*/
    $('.customDateTimeRangePicker').daterangepicker({
        initialText: 'Date Range',
        datepickerOptions : {
             numberOfMonths : 1
        },
        presetRanges:
            [
                { text: 'Today', dateStart: function() { return moment(); }, dateEnd: function() { return moment(); } },
                { text: 'Yesterday', dateStart: function() { return moment().subtract('days', 1); }, dateEnd: function() { return moment().subtract('days', 1); } },
                { text: 'This Week', dateStart: function() { return moment().startOf('week'); }, dateEnd: function() { return moment().endOf('week'); } },
                { text: 'Last Week', dateStart: function() { return moment().subtract('weeks', 1).startOf('week'); }, dateEnd: function() { return moment().subtract('weeks', 1).endOf('week'); } },
                { text: 'This Month', dateStart: function() { return moment().startOf('month'); }, dateEnd: function() { return moment().endOf('month'); } },
                { text: 'Last Month', dateStart: function() { return moment().subtract('months', 1).startOf('month'); }, dateEnd: function() { return moment().subtract('months', 1).endOf('month'); } },
                { text: 'This Year', dateStart: function() { return moment().startOf('year'); }, dateEnd: function() { return moment().endOf('year'); } },
                { text: 'Last Year', dateStart: function() { return moment().subtract('years', 1).startOf('year'); }, dateEnd: function() { return moment().subtract('years', 1).endOf('year'); } },
                { text: 'All Time', dateStart: function() { return moment(new Date(0)); }, dateEnd: function() { return moment(new Date('9999-12-31')); } }
            ],
    });

    $("#numberTable, #providerTable").tablesorter({
        emptyTo: '0' // consider blank cell as 0 and so that blank cell will also be sorted
    });
   
    $('body').on('dblclick', '.editable', function(){
        
        var $el = $(this).find('span.editable');
                    
        var $input = $('<input/>').val( $el.text() ).data('action', $el.data('action')).data('parameter', $el.data('parameter')).data('format', $el.data('format'));
        if ($input.data('format') == 'number')
            $input.val($input.val().replace(",",""));
        
        $el.replaceWith( $input );
        
        var save = function(){
            var $p = $('<span class="editable" />').text( $input.val() ) .data('action', $input.data('action')) .data('parameter', $input.data('parameter')) .data('format', $input.data('format'));
            if ($p.data('format') == 'number')
                $p.text(new Intl.NumberFormat('EN-US').format($input.val()));
            
            var data = {};
            data[$(this).data('parameter')] = $(this).val();
            
            $.ajax({
                type:"POST",
                dataType: "json",
                url:$(this).data('action'),
                data: data,
                success: function(data){
                    if(data.errors){
                        $input.replaceWith( $p.text($el.text()) );
                        $p.notify("update error", { className: "error", position:"bottom center", autoHideDelay: 2000 });
                    }
                    else{
                        $input.replaceWith( $p );
                        $p.notify("updated successfully", { className: "success", position:"bottom center", autoHideDelay: 2000 });
                    }
    
                },
                error: function(){
                    $input.replaceWith( $p.text($el.text()) );
                    $p.notify("update error", { className: "error", position:"bottom center", autoHideDelay: 2000 });
                }
            });
          
        };
        
        $input.one('blur', save).focus();
  
    });
    $('body').on('keypress', '.editable input', function(event) {
        if (event.keyCode == 13) {
            $( this ).trigger( "blur" );
        }
    });
});



function constructModalContent(results) {
    var span = document.createElement("span");
    var table = document.createElement("table");
    table.setAttribute("class", "table table-bordered data-table dataTable");
    table.setAttribute("cellspacing", 0);

    if (results) {
        data = results;
        var trHeading = document.createElement("tr");
        Object.keys(data['headings']).forEach(function(key) {
            var tdHeading = document.createElement("th");
                tdHeading.appendChild(document.createTextNode(data['headings'][key]));
                trHeading.appendChild(tdHeading);
        });
        table.appendChild(trHeading);
        Object.keys(data['items']).forEach(function(row) {
            var tr = document.createElement("tr");
            tr.setAttribute("id", "row" + row);

            Object.keys(data['items'][row]).forEach(function(col) {
                var td = document.createElement("td");
                if (col == "Status") {
                    var icon = document.createElement("span");
                    icon.innerHTML = "<i " + queueIconArr[data['items'][row][col]] + "></i>&ensp;&ensp;";
                    td.appendChild(icon);
                    td.appendChild(document.createTextNode(queueStatuses[data['items'][row][col]]));
                } else if (col == "Try") {
                    td.appendChild("<b>" + document.createTextNode(data['items'][row][col]) + "</b>")
                } else {
                    td.appendChild(document.createTextNode(data['items'][row][col]));
                }
                tr.appendChild(td);
            });

            table.appendChild(tr);
        });

        span.appendChild(table);
        $('.modal-title').html(results['title']);
        $('#modal-body-provider').html(span);
        $('[id*="editModal"]').modal('show');
        
    }
}

function showProviderBreakdown(providerID, type) {
    $.ajax({
        url: window.location.origin + "/billing-summary-daily/get-" + type + "-breakdown-for-provider/",
        data: {providerID: providerID},
        cache: false,
        type: 'POST',
        success: function (data) {
            response = JSON.parse(data.split("<")[0]);
            if (response.hasOwnProperty('success')) {
                constructModalContent(response);
            }
        },
        error: function(xhr, textStatus, error) {
            console.log("Error fetching AJAX response:")
            console.log(error);
        }
    });
}

function filter()
{
    $date = document.getElementById('date');
    console.log($date.value);
}

$( window ).load(function() {
    if ($( window ).width() < 680){
        $( ".welcome, .help" ).remove();
        $('.shrink, .total').attr('colspan',2);
        $('.weekRange, .name_heading').attr('colspan',1);
        $('.welcome, .help, .main_footer, .blank_space').hide();
        $('.child_footer,').show();
        $('#sidebar .content').prependTo($('#sidebar .content').parent().parent());
    }
    else if($( window ).width() > 680 && $( window ).width() < 970){
        $('.main_footer, .eto_logo').hide();
        $('.child_footer,').show();
    }
    else{
        $('.shrink').attr('colspan',3);
        //$('.country_heading, .total_heading').attr('colspan',2);
    }
});

/**----------------------------------------------
 * Shane Bowen
 * Line Chart
 * ---------------------------------------------
 */

 $(document).ready(function(){
    var result = window.location.search.match(/\d+/g);
    console.log(result);

    var companyId = parseInt(result[0], 10);
    console.log(companyId);

    var date = result[1] + '-' + result[2];
    console.log(date);

    if(date == "undefined-undefined"){
        date = "";
    }
    
	$.ajax({
        type: 'POST',
        url: window.location.href,
        data: {company: companyId, date: date},
        success: function(response) {
            var result = JSON.parse(response);
            var revenue = result['data'];
            var labels = result['labels'];
            var ticks = [];
            var data = [];

            for(i=0; i < revenue.length; i++){
                ticks.push([i, labels[i]]);
                data.push([i, revenue[i]]);
            }

            if (revenue.length > 0) { 
                var bar_ctx = document.getElementById('bars');
                var bar_chart = new Chart(bar_ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [
                        {
                            label: 'Revenue',
                            data: revenue,
                            backgroundColor: "#7abdff",
                            hoverBackgroundColor: "rgba(55, 160, 225, 0.7)",
                            hoverBorderWidth: 2,
                            hoverBorderColor: 'lightgrey'
                        },
                        ]
                    },
                    options: {
                        tooltips: {
                            mode: 'label',
                            callbacks: {
                                label: function(tooltipItem) { 
                                    return Number(tooltipItem.yLabel);
                                },
                            }
                        },
                        scales: {
                            xAxes: [{ 
                            stacked: true, 
                                ticks: {
                                    callback: function(value) { return value; },
                                },
                            gridLines: { display: false },
                            }],
                            yAxes: [{ 
                                stacked: true, 
                                ticks: {
                                    callback: function(value) { return Number(value); },
                                }, 
                            }],
                        },
                        legend: {display: true}
                    } 
                });
            }
        }, error: function(xhr,textStatus,error){
            alert(error);
        }
        
    });


/*  var billing_data = JSON.parse($('#data').val());
    console.log(billing_data);

    if (billing_data.length > 0) {
        google.charts.load('current', {packages: ["bar", "corechart"]});
        google.charts.setOnLoadCallback(drawBasic);

        function drawBasic() {
            var data = new google.visualization.DataTable();
            data.addColumn('date', 'Date');
            data.addColumn('number', 'Revenue');
            data.addColumn({type:'string', role:'annotation'});
            
            console.log(billing_data.length)
            for(var i=0; i<billing_data.length; i++)
                {
                    data.addRow(
                        [new Date(billing_data[i]['date']), parseFloat(billing_data[i]['revenue']), "€" + parseFloat(billing_data[i]['revenue']) ]
                    );
                }
            console.log(data);
            var options = {
                title: 'Revenue(€)',
                is3D: true,
                colors: ['#03A9F4'],
                hAxis: {
                    title: 'Month',
                    format: 'MMM-YYYY',
                },
                vAxis: {
                    title: 'Revenue',
                    minValue: 0
                },
                trendlines: {
                    0: {
                        type: 'linear',
                        color: 'red',
                        opacity: 0.8,
                        labelInLegend: 'Trendline',
                        visibleInLegend: true
                    }
                }
            };

            var chart = new google.visualization.ColumnChart(
                document.getElementById('bars'));

            chart.draw(data, options);
        }
    } */

});