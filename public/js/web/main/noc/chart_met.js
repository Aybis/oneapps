function chartMet(value) {

    /* Chart code */
    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end

    // Create chart MET
    let chart = am4core.create("chartmet", am4charts.PieChart);
    chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

    chart.data = [{
            country: "MET",
            value: value.met[0]['met'],
        },
        {
            country: "MISS",
            value: value.miss[0]['miss'],
        },
    ];

    let series = chart.series.push(new am4charts.PieSeries());
    series.dataFields.value = "value";
    series.dataFields.radiusValue = "value";
    series.dataFields.category = "country";
    series.slices.template.cornerRadius = 10;
    series.colors.step = 5;

    series.hiddenState.properties.endAngle = -90;

    chart.legend = new am4charts.Legend();


}
