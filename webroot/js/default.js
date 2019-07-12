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

//Charts
$(document).ready(function(){
    var total_tests_breakdown = JSON.parse($('#total_tests_breakdown').val());
    var company_breakdown = JSON.parse($('#company_breakdown').val());
    var company_names = JSON.parse($('#company_names').val());
    var test_types = JSON.parse($('#test_types').val());
    var search_params = JSON.parse($('#search_params').val());
    console.log(total_tests_breakdown)
    console.log(company_breakdown)
    console.log(company_names)
    console.log(test_types);
    console.log(search_params);
    
    google.charts.load('current', {'packages':['corechart']});

    if(typeof search_params['company'] == 'undefined'){
        console.log("Line Chart");
        google.charts.setOnLoadCallback(drawLineChart);
    }
    else{
        console.log("Area Chart");
        google.charts.setOnLoadCallback(drawAreaChart);
    }

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

    function drawLineChart() {
        var data = new google.visualization.DataTable();

        data.addColumn('number', 'Date');
        data.addColumn('number', 'Total PSTN Calls');
        data.addColumn('number', 'Total GSM Calls');

        var ticks = [];
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
                viewWindowMode: "explicit", viewWindow:{ min: 0 },
                gridlines: {
                    count: 4
                },
            },
            hAxes: {
                gridlines: {
                    count: 4
                },
            },
            vAxis: {
                title: 'Total Tests',
                viewWindowMode: "explicit", viewWindow:{ min: 0 },
                gridlines: {
                    count: 4
                },
                // minorGridlines: { count: 0 }
            }
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }

    function drawAreaChart(){
        var data = new google.visualization.DataTable();
        data.addColumn('number', 'Date');

        const total_test_list = groupBy(company_breakdown, test => JSON.stringify({hour_timestamp: test.hour_timestamp}));
        console.log(total_test_list);

        var values = [];
        var ticks = [];
        var currentCompanies = [];
        var index = 0;
        var topTests = 0;
        var totalTests = 0;
        var allCompanies = [];
        // var selectedCompanies = [1, 2, 3, 4, 6]
        var selectedCompanies = [];

        for(var i=0; i<search_params['company'].length; i++) {
            selectedCompanies[i] = parseInt(search_params['company'][i]);
        }
        console.log(selectedCompanies);

        for(var i=0; i<company_breakdown.length; i++){
            if(allCompanies.indexOf(company_breakdown[i]['company_id']) == -1){
                allCompanies.push(company_breakdown[i]['company_id'])
            }
        }
        allCompanies = allCompanies.sort()

        var companyNames = {};
        for(i = 0; i<company_names.length; i++){
            companyNames[company_names[i]['id']] = company_names[i]['name']
        }
        
        for(var i=0; i<selectedCompanies.length; i++){
            data.addColumn('number', companyNames[selectedCompanies[i]])
        }

        if(selectedCompanies.length > 5){
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
            index += selectedCompanies.length
            // console.log(value);

            for(var i=0; i<value.length; i++){
                currentCompanies.push(parseFloat(value[i]['company_id']))
                totalTests +=parseFloat(value[i]['total'])
            }
            // console.log(currentCompanies);
            // console.log(selectedCompanies)

            for(var i=0; i<selectedCompanies.length; i++){
                if(currentCompanies.indexOf(selectedCompanies[i]) >= 0){
                    values.push(parseFloat(value[currentCompanies.indexOf(selectedCompanies[i])]['total']))
                    topTests += parseFloat(value[currentCompanies.indexOf(selectedCompanies[i])]['total'])
                }
                else{
                    values.push(0)
                }
            }
           
            if(selectedCompanies.length > 5){
                values.push(totalTests - topTests);
            }

            data.addRow(values);
            console.log(values);

            currentCompanies = [];
            values = [];
            topTests = 0;
            totalTests = 0;
        }

        var options = {
            title: 'Overall Tests',
            hAxis: {title: 'Hour Timestamp', ticks: ticks,  titleTextStyle: {color: '#333'}},
            vAxis: {title: 'Total Tests', minValue: 0},
            // pointSize: 3,
            isStacked: true,
            backgroundColor:'transparent',
            focusTarget: 'category',
            // legend: {position: 'top'}
            // interpolateNulls: true
          };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
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
    //  .on('change', '[type="checkbox"]', function() {
    //      var container = $(this).closest('.dropdown-container');
    //      console.log(container);
    //      var numChecked = container.find('[type="checkbox"]:checked').length;
         
    //      if(numChecked > 0){
    //         container.find('.quantity').text('(' + numChecked + '/' + numCbs + ')' || '');
    //      }
    //      else{
    //         container.find('.quantity').text('');
    //      }
    //  });

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
 
    //  var stateTemplate = _.template(
    //      '<li>' +
    //          '<input name="test_type[]" value="<%= id %>" type="checkbox">' +
    //          '<label for="test_type"><%= test_type %></label>' +
    //      '</li>'
    //  );
     
    //  // Populate list with test types
    //  _.each(test_types, function(s) {
    //      $('.test_types').append(stateTemplate(s));
    //  }); 
});