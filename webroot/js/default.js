$(document).ready(function(){
    var total_tests_breakdown = JSON.parse($('#total_tests_breakdown').val());
    console.log(total_tests_breakdown)

    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = new google.visualization.DataTable();

        data.addColumn('number', 'Date');
        data.addColumn('number', 'Total PSTN Calls');
        data.addColumn('number', 'Total GSM Calls');

        var ticks = [];
        for(var i=0; i<total_tests_breakdown.length; i++){

            var d = new Date()
            d = new Date(total_tests_breakdown[i]['hour_timestamp'])
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
            legend: { position: 'top' },
            hAxis: { 
                title: 'Hour Timestamp',
                ticks: ticks },
            vAxis: {
                title: 'Total Tests',
                minValue: 1000,
                viewWindowMode: "explicit", viewWindow:{ min: 0 }
            },
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
});