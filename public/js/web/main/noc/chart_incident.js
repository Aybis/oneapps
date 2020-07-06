let dataIncident = [];
function ajaxChartIncident(m, y,customer="all")
{
    $.ajaxSetup({
        cache       : true,
        destroy     : true,
        processing  : true,
        serverSide  : true,
        async       : true,
    });

    $.ajax({
        url         : url_chart_incident,
        type        : 'get',
        data        : {
                        month       : m,
                        year        : y,
                        customer    : customer,
                    },
        dataType    : 'json',
        success : function(data){
            // declare variable for status miss and met
            let met = 0;
            let miss = 0;

            data.forEach( (element) => {

                // condition where data have miss or met
                if(element.timeStatus == "MET"){
                    met++;
                }else if(element.timeStatus == "MISS"){
                    miss++;
                }
            });

            chartIncident(met, miss);

        },
        error : function (data){
        }
    });
}

function chartIncident(met, miss) {

    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end

    var chart = am4core.create("incident", am4charts.PieChart);
    chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

    chart.data = [
        {
            area : "MET",
            value : met,
        },{
            area    : "MISS",
            value   : miss,
        }
    ];
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
