let dataPoints = [];

function ajaxChartRequest(m, y) {
    $.ajaxSetup({
        cache: false,
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
            // declare variable for status miss and met
            let label = [];
            let val = [];

            data.forEach((element) => {
                dataPoints.push({
                    area: element.customer,
                    value: element.total,
                })
            });

            chartRequest();
        },
        error: function (data) {
            // console.log(data);
        }
    });
}

function chartRequest() {
    /**
     * ---------------------------------------
     * This demo was created using amCharts 4.
     *
     * For more information visit:
     * https://www.amcharts.com/
     *
     * Documentation is available at:
     * https://www.amcharts.com/docs/v4/
     * ---------------------------------------
     */

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
