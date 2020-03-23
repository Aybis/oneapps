function chartReg(value) {

    /* Chart code */
    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end

    // Create chart MET
    let chart = am4core.create("chartReg", am4charts.PieChart);
    chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

    chart.data = value;

    let series = chart.series.push(new am4charts.PieSeries());
    series.dataFields.value = "total";
    series.dataFields.radiusValue = "total";
    series.dataFields.category = "area";
    series.slices.template.cornerRadius = 10;
    series.colors.step = 5;

    series.hiddenState.properties.endAngle = -90;

    chart.legend = new am4charts.Legend();


}
