am4core.ready(function() {

    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end

    // Create chart
    var chart = am4core.create("chartmiss", am4charts.PieChart);
    chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

    chart.data = [
        {
            country: "DES",
            value: 80
          },
          {
            country: "DGS",
            value: 90
          },
          {
            country: "DWS",
            value: 100
          },
          {
            country: "DCS",
            value: 120
          },
    ];

    var series = chart.series.push(new am4charts.PieSeries());
    series.dataFields.value = "value";
    series.dataFields.radiusValue = "value";
    series.dataFields.category = "country";
    series.slices.template.cornerRadius = 6;
    series.colors.step = 7;

    series.hiddenState.properties.endAngle = -90;

    chart.legend = new am4charts.Legend();

    }); // end am4core.ready()
