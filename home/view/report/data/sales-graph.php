<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>amCharts tutorial: Loading external data</title>

  <style>
  #chartdiv > div > div > a {
display: none !important;
}
  </style>
</head>
<body>

  <!-- prerequisites --> 
 <script src="../../assets/lib/amcharts/amcharts.js" type="text/javascript"></script>
<script src="../../assets/lib/amcharts/serial.js" type="text/javascript"></script>

  <!-- cutom functions -->
  <script>
AmCharts.loadJSON = function(url) {
  // create the request
  if (window.XMLHttpRequest) {
    // IE7+, Firefox, Chrome, Opera, Safari
    var request = new XMLHttpRequest();
  } else {
    // code for IE6, IE5
    var request = new ActiveXObject('Microsoft.XMLHTTP');
  }

  // load it
  // the last "false" parameter ensures that our code will wait before the
  // data is loaded
  request.open('GET', url, false);
  request.send();

  // parse adn return the output
  return eval(request.responseText);
};
  </script>

  <!-- chart container -->
  <?php
echo $_GET['slug'];
  ?>
  <div id="chartdiv" style="width: 90%;margin:auto; height: 500px;"></div>

  <!-- the chart code -->
  <script>
var chart;

// create chart
AmCharts.ready(function() {

  // load the data
  var chartData = AmCharts.loadJSON('data.php');

  // SERIAL CHART
  chart = new AmCharts.AmSerialChart();
  chart.pathToImages = "http://www.amcharts.com/lib/images/";
  chart.dataProvider = chartData;
  chart.categoryField = "category";
  chart.dataDateFormat = "YYYY-MM-DD";

     
                // AXES
                // category
                var categoryAxis = chart.categoryAxis;
                categoryAxis.parseDates = true; // as our data is date-based, we set parseDates to true
                categoryAxis.minPeriod = "DD"; // our data is daily, so we set minPeriod to DD               
                categoryAxis.gridAlpha = 0.1;
                categoryAxis.minorGridAlpha = 0.1;
                categoryAxis.axisAlpha = 0;
                categoryAxis.minorGridEnabled = true;
                categoryAxis.inside = true;
     
                // value
                var valueAxis = new AmCharts.ValueAxis();
                valueAxis.tickLength = 0;
                valueAxis.axisAlpha = 0;
                valueAxis.showFirstLabel = false;
                valueAxis.showLastLabel = false;
                chart.addValueAxis(valueAxis);
     
                // GRAPH
                var graph = new AmCharts.AmGraph();
                graph.dashLength = 3;
                graph.lineColor = "#00CC00";
                graph.valueField = "value";
                graph.dashLength = 3;
                graph.bullet = "round";
                graph.balloonText = "[[category]]<br><b><span style='font-size:14px;'>value:[[value]]</span></b>";
                chart.addGraph(graph);
     
                // CURSOR
                var chartCursor = new AmCharts.ChartCursor();
                chart.addChartCursor(chartCursor);
     
                // SCROLLBAR
                var chartScrollbar = new AmCharts.ChartScrollbar();
                chart.addChartScrollbar(chartScrollbar);
     
                // HORIZONTAL GREEN RANGE
                var guide = new AmCharts.Guide();
                guide.value = 10;
                guide.toValue = 20;
                guide.fillColor = "#00CC00";
                guide.inside = true;
                guide.fillAlpha = 0.2;
                guide.lineAlpha = 0;
                valueAxis.addGuide(guide);
     
                // TREND LINES
                // first trend line
                var trendLine = new AmCharts.TrendLine();
                // note,when creating date objects 0 month is January, as months are zero based in JavaScript.
                trendLine.initialDate = new Date(2012, 0, 2, 12); // 12 is hour - to start trend line in the middle of the day
                trendLine.finalDate = new Date(2012, 0, 11, 12);
                trendLine.initialValue = 10;
                trendLine.finalValue = 19;
                trendLine.lineColor = "#CC0000";
                chart.addTrendLine(trendLine);
     
                // second trend line
                trendLine = new AmCharts.TrendLine();
                trendLine.initialDate = new Date(2012, 0, 17, 12);
                trendLine.finalDate = new Date(2012, 0, 22, 12);
                trendLine.initialValue = 16;
                trendLine.finalValue = 10;
                trendLine.lineColor = "#CC0000";
                chart.addTrendLine(trendLine);
     
                // WRITE
                chart.write("chartdiv");
});

  </script>

</body>
</html>

