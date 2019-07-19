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


    /*On change event of filter dropdowns on index page*/
    $(document).on("change", "#date, #filter_date_range, #test-type", function(){
        $(this).parents('form').submit();
    });

    $(".filterBox select").select2({
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

//Charts
$(document).ready(function(){
    var total_tests_breakdown = JSON.parse($('#total_tests_breakdown').val());
    var company_breakdown = JSON.parse($('#company_breakdown').val());
    var company_names = JSON.parse($('#company_names').val());
    var test_types = JSON.parse($('#test_types').val());
    var search_params = JSON.parse($('#search_params').val());
    var total_test_count = JSON.parse($('#total_test_count').val());
    var current_company_totals = JSON.parse($('#current_company_totals').val());
    var previous_company_totals = JSON.parse($('#previous_company_totals').val());
    var totals_dict = JSON.parse($('#totals_dict').val());
    var current_dict = JSON.parse($('#current_dict').val());
    var previous_dict = JSON.parse($('#previous_dict').val());
    console.log(total_tests_breakdown);
    console.log(company_breakdown);
    console.log(company_names);
    console.log(test_types);
    console.log(total_test_count);
    console.log(previous_company_totals);
    console.log(current_company_totals);
    
    google.charts.load('current', {'packages':['corechart']});
    if(typeof search_params['company'] == 'undefined'){
        google.charts.setOnLoadCallback(drawLineChart);
    }
    else{
        google.charts.setOnLoadCallback(drawAreaChart);
    }

    //Dropdown - num of checkboxes ticked
    var numChecked = $("[name='test_type']").find('[type="checkbox"]:checked').length;
    var numChecked2 = $("[name='company']").find('[type="checkbox"]:checked').length;

    if(numChecked > 0){
        $("[name='test_type'] .quantity").text('(' + numChecked + '/' + test_types.length + ')' || '');
    }
    else{
        $("[name='test_type'] .quantity").text('');
    }

    if(numChecked2 > 0){
        $("[name='company'] .quantity").text('(' + numChecked2 + '/' + company_names.length + ')' || '');
    }
    else{
        $("[name='company'] .quantity").text('');
    }

    const total_test_list = groupBy(company_breakdown, test => JSON.stringify({hour_timestamp: test.hour_timestamp}));
    
    function drawLineChart() {
        var data = new google.visualization.DataTable();
        var ticks = [];
        var percentArray = [];

        data.addColumn('number', 'Date');
        data.addColumn('number', 'PSTN Calls');
        data.addColumn('number', 'GSM Calls');

        for(var i=0; i<total_tests_breakdown.length; i++){
            var d = new Date()
            d = new Date(total_tests_breakdown[i]['hour_timestamp'])
            d.setHours(d.getHours() - 1);

            var hours = ("0" + d.getHours()).slice(-2);
            var minutes = ("0" + d.getMinutes()).slice(-2)
            var seconds = ("0" + d.getSeconds()).slice(-2)

            var day = d.getDate();
            var month = d.toLocaleString('en-us', { month: 'short' });
            var year = d.getFullYear();
            
            ticks.push({
                v: i,
                f: day + ' ' + month + ' ' + year + ' ' + hours + ':' + minutes + ':' + seconds
            });

            data.addRow(
                [{v: i, f: day + ' ' + month + ' ' + year + ' ' + hours + ':' + minutes + ':' + seconds}, parseFloat(total_tests_breakdown[i]['total_pstn_calls']), parseFloat(total_tests_breakdown[i]['total_gsm_calls'])]
            );
        }
        
        var options = {
            title: 'Summary Hourly',
            curveType: 'function',
            legend: { position: 'right' },
            focusTarget: 'category',
            isStacked: true,
            backgroundColor:'transparent',
            // pointSize: 3,
            hAxis: {
                title: 'Hour Timestamp',
                ticks: ticks,
                viewWindowMode: "explicit",
                viewWindow:{ min: 0 },
                gridlines: {
                    count: 4
                }
            },
            hAxes: {
                gridlines: {
                    count: 4
                }
            },
            vAxis: {
                title: 'Total Tests',
                viewWindowMode: "explicit",
                viewWindow:{ min: 0 },
                gridlines: {
                    count: 4
                }
                // minorGridlines: { count: 0 }
            }
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);

        if(previous_dict['totalTests'] > 0){
            console.log("Ok");
            diff = current_dict['avgPSTN'] - previous_dict['avgPSTN']
            percent = Math.round(((diff / previous_dict['avgPSTN']) * 100) * 100) / 100;
            percent = percent || 0;
            percentArray.push(percent);

            diff = current_dict['avgGSM'] - previous_dict['avgGSM']
            percent = Math.round(((diff / previous_dict['avgGSM']) * 100) * 100) / 100;
            percent = percent || 0;
            percentArray.push(percent);
        }
        console.log(percentArray);

        var labelSelector = '> g:eq(1) text:last-child';
        var svg = $('svg', document.getElementById('chart_div'));

        $(labelSelector, svg).each(function (i, v) {
            if(percentArray[i] > 0){
                var newText = document.createElementNS("http://www.w3.org/2000/svg", "tspan");
                newText.setAttributeNS(null,"font-size","17");
                newText.setAttributeNS(null,"fill","green");

                var textNode = document.createTextNode("  (+" + percentArray[i]  + "%)");
                newText.appendChild(textNode);
                $(this).append(newText);
            }
            else{
                if(typeof percentArray[i]  == 'undefined'){
                    var newText = document.createElementNS("http://www.w3.org/2000/svg", "tspan");
                    newText.setAttributeNS(null,"font-size","17");
                    newText.setAttributeNS(null,"fill","grey");
    
                    var textNode = document.createTextNode("  (0%)");
                    newText.appendChild(textNode);
                    $(this).append(newText);
                }
                else{
                    var newText = document.createElementNS("http://www.w3.org/2000/svg", "tspan");
                    newText.setAttributeNS(null,"font-size","17");
                    newText.setAttributeNS(null,"fill","red");
    
                    var textNode = document.createTextNode("  (" + percentArray[i]  + "%)");
                    newText.appendChild(textNode);
                    $(this).append(newText);
                }
            }
        });
    }

    function drawAreaChart(){
        var data = new google.visualization.DataTable();
        data.addColumn('number', 'Date');

        var values = [];
        var ticks = [];
        var currentCompanies = [];
        var selectedCompIds = [];
        var topTests = 0;
        var index = 0;
        var k = 0;
        var selectedCompNames = [];
        var percentArray = []

        var companyNames = {};
        for(i = 0; i<company_names.length; i++){
            companyNames[company_names[i]['id']] = company_names[i]['name']
        }
        console.log(companyNames);

        for(var i=0; i<search_params['company'].length; i++) {
            selectedCompIds[i] = parseInt(search_params['company'][i]);
        }
        console.log(selectedCompIds);

        for(var i=0; i<selectedCompIds.length; i++){
            data.addColumn('number', companyNames[selectedCompIds[i]])
        }

        if(selectedCompIds.length > 5){
            data.addColumn('number', 'Others');
        }

        for (let [key, value] of total_test_list) {
            key = (JSON.parse(key));
            var d = new Date()
            d = new Date(key['hour_timestamp'])
            d.setHours(d.getHours() - 1);

            var hours = ("0" + d.getHours()).slice(-2);
            var minutes = ("0" + d.getMinutes()).slice(-2);
            var seconds = ("0" + d.getSeconds()).slice(-2);

            var day = d.getDate();
            var month = d.toLocaleString('en-us', { month: 'short' });
            var year = d.getFullYear();

            ticks.push({
                v: index,
                f: day + ' ' + month + ' ' + year + ' ' + hours + ':' + minutes + ':' + seconds
            });

            values = [{v: index, f: day + ' ' + month + ' ' + year + ' ' + hours + ':' + minutes + ':' + seconds}]
            index += selectedCompIds.length

            console.log(value);
            for(var i=0; i<value.length; i++){
                currentCompanies.push(parseFloat(value[i]['company_id']))
            }

            for(var i=0; i<selectedCompIds.length; i++){
                if(currentCompanies.indexOf(selectedCompIds[i]) >= 0){ //Check if company selected is in current company batch
                    values.push(parseFloat(value[currentCompanies.indexOf(selectedCompIds[i])]['total']));
                    topTests += parseFloat(value[currentCompanies.indexOf(selectedCompIds[i])]['total']);

                    if(selectedCompNames.indexOf(companyNames[selectedCompIds[i]]) == -1){ //Add company name if not in array
                        selectedCompNames.push(companyNames[selectedCompIds[i]]);
                    }
                }
                else{
                    values.push(0)
                    if(selectedCompNames.indexOf(companyNames[selectedCompIds[i]]) == -1){
                        selectedCompNames.push(companyNames[selectedCompIds[i]]);
                    }
                }
            }
           
            if(selectedCompIds.length > 5){
                values.push(total_test_count[k]['total'] - topTests);
                k+=1
            }
            data.addRow(values);

            currentCompanies = [];
            values = [];
            topTests = 0;
        }

        var options = {
            title: 'Overall Tests',
            hAxis: {title: 'Hour Timestamp', ticks: ticks,  titleTextStyle: {color: '#333'}},
            vAxis: {title: 'Total Tests', minValue: 0},
            isStacked: true,
            backgroundColor:'transparent',
            focusTarget: 'category',
            chartArea: {  width: "72%" }
            // pointSize: 3,
            // interpolateNulls: true
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);

        selectedCompIds.sort(function(a, b){return a-b});
        console.log(selectedCompIds);

        selectedCompNames.sort(function (a, b) {
            return b.localeCompare(a);
        });
        console.log(selectedCompNames);
        console.log(previous_company_totals);
        console.log(current_company_totals);

        var percentDict = {};
        var previous_company_total = 0;
        for(var i=0; i<selectedCompIds.length; i++){
            if((typeof current_company_totals[i] != 'undefined') && (typeof previous_company_totals[i] != 'undefined')){
                var diff = current_company_totals[i]['total'] - previous_company_totals[i]['total'];
                previous_company_total += parseFloat(previous_company_totals[i]['total']);
                var percent = Math.round(((diff / previous_company_totals[i]['total']) * 100) * 100) / 100;
                percent = percent || 0;
                percentDict[companyNames[selectedCompIds[i]]] = percent;
            }
            else{
                percentDict[companyNames[selectedCompIds[i]]] = 0;
            }
        }

        console.log(percentDict);
        console.log(previous_company_total);
        if(selectedCompIds.length > 5){ //Add others percentage value
            var diff = ((current_dict['totalTests']) - totals_dict['totalTests']) - ((previous_dict['totalTests']) - previous_company_total);
            var percent = Math.round(((diff / ((previous_dict['totalTests']) - previous_company_total)) * 100) * 100) / 100;
            percent = percent || 0;
            percentArray.push(percent);
        }

        for(var i=0; i<selectedCompNames.length; i++){
            percentArray.push(percentDict[selectedCompNames[i]]);
        }
        console.log(percentArray);

        //Add Percentage figures to legend labels
        var labelSelector = '> g:eq(1) text:last-child';
        var svg = $('svg', document.getElementById('chart_div'));
        $(labelSelector, svg).each(function (i, v) {
            if(percentArray[i] > 0){
                var newText = document.createElementNS("http://www.w3.org/2000/svg", "tspan");
                newText.setAttributeNS(null,"font-size","17");
                newText.setAttributeNS(null,"fill","green");

                var textNode = document.createTextNode("  (+" + percentArray[i]  + "%)");
                newText.appendChild(textNode);
                $(this).append(newText);
            }
            else{
                if(typeof percentArray[i]  == 'undefined' || percentArray[i]  == 0){
                    var newText = document.createElementNS("http://www.w3.org/2000/svg", "tspan");
                    newText.setAttributeNS(null,"font-size","17");
                    newText.setAttributeNS(null,"fill","grey");
    
                    var textNode = document.createTextNode("  (0%)");
                    newText.appendChild(textNode);
                    $(this).append(newText);
                }
                else{
                    var newText = document.createElementNS("http://www.w3.org/2000/svg", "tspan");
                    newText.setAttributeNS(null,"font-size","17");
                    newText.setAttributeNS(null,"fill","red");
    
                    var textNode = document.createTextNode("  (" + percentArray[i]  + "%)");
                    newText.appendChild(textNode);
                    $(this).append(newText);
                }
            }
        });
    }

    function groupBy(list, keyGetter) {
        const map = new Map();
        list.forEach((item) => {
            const key = keyGetter(item);
            if (!map.has(key)) {
                map.set(key, [item]);
            } else {
                map.get(key).push(item);
            }
        });
        return map;
    }

     // Dropdown
     $('.dropdown-container')
     .on('click', '.dropdown-button', function() {
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
    });

    $("[name='test_type']")
    .on('change', '[type="checkbox"]', function() {
        var container = $(this).closest('.dropdown-container');
        console.log(container);
        var numChecked = container.find('[type="checkbox"]:checked').length;
        
        if(numChecked > 0){
           container.find('.quantity').text('(' + numChecked + '/' + test_types.length + ')' || '');
        }
        else{
           container.find('.quantity').text('');
        }
    });

    $("[name='company']")
    .on('change', '[type="checkbox"]', function() {
        var container = $(this).closest('.dropdown-container');
        console.log(container);
        var numChecked2 = container.find('[type="checkbox"]:checked').length;
        
        if(numChecked2 > 0){
           container.find('.quantity').text('(' + numChecked2 + '/' + company_names.length + ')' || '');
        }
        else{
           container.find('.quantity').text('');
        }
    });
});