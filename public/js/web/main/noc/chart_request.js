let dataPoints = [];

function ajaxChartRequest(m, y) {
    $.ajaxSetup({
        cache       : true,
        destroy     : true,
        processing  : true,
        serverSide  : true,
        async       : true,
    });

    $.ajax({
        url: url_chart_request,
        type: 'get',
        data: {
            month: m,
            year: y,
        },
        dataType: 'json',
        success: function (data) {
            dataPoints = [];
            // declare variable for status miss and met
            data.forEach((element) => {
                dataPoints.push({
                    area: element.customer,
                    value: element.total,
                })
            });
            chartRequest();
        },
        error: function (data) {
        }
    });
}

function chartRequest() {
    am4core.disposeAllCharts();
    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end

    var chart = am4core.create("request", am4charts.PieChart);
    chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

    chart.data = dataPoints;
    chart.radius = am4core.percent(70);
    chart.innerRadius = am4core.percent(40);
    chart.startAngle = 180;
    chart.endAngle = 360;

    var series = chart.series.push(new am4charts.PieSeries());
    series.dataFields.value = "value";
    series.dataFields.category = "area";

    series.slices.template.cornerRadius = 10;
    series.slices.template.innerCornerRadius = 7;
    series.slices.template.draggable = true;
    series.slices.template.inert = true;
    series.alignLabels = false;

    series.hiddenState.properties.startAngle = 90;
    series.hiddenState.properties.endAngle = 90;

    chart.legend = new am4charts.Legend();
}
