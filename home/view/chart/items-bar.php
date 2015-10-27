<?php
$d_temp=strtotime(Date("F d, Y")); 
$date=date("Y-m-d", $d_temp);
$td=date("Y", $d_temp);
$F=date("F", $d_temp);
$show_gtotal=0;
$show_gprofit=0;


  $d1="";
 if($_REQUEST['d1']!="" ){
  $d1=$_REQUEST['d1'];
  $show_d1=date("F d, Y", strtotime($d1));
  $d2=$_REQUEST['d2'];
  $show_d2=date("F d, Y", strtotime($d2));
  $day=$show_d1.' -  '.$show_d2;
}else{
 $day="";
}



 
?>


<span id="d1" data-value="<?php echo $d1;?>"></span>
<span id="d2" data-value="<?php echo $d2;?>"></span>

<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>amCharts tutorial: Loading external data</title>

  <style>
  #chartdiv > div > div > a {
display: none !important;
}
.d-label h5 {
font-size: 20px;
margin: 0;
padding: 0;
font-weight: normal;
font-family: arial;
text-align: center;
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
   <div class="d-label" style="width: 90%;margin:auto; height: auto;">
      <h5><?php echo  $day;?></h5>
   </div>

  <div id="chartdiv" style="width: 90%;margin:auto; height: 500px;">

  </div>

  <!-- the chart code -->
  <script>
var chart;
var d1_t = document.getElementById("d1");
var d1=d1_t.getAttribute("data-value");

var d2_t = document.getElementById("d2");
var d2=d2_t.getAttribute("data-value");

// create chart
AmCharts.ready(function() {

  // load the data
  var chartData = AmCharts.loadJSON('items-data.php?d1='+d1+'&d2='+d2);

                // SERIAL CHART
                chart = new AmCharts.AmSerialChart();
                chart.dataProvider = chartData;
                chart.categoryField = "category";
                chart.startDuration = 1;
                chart.plotAreaBorderColor = "#DADADA";
                chart.plotAreaBorderAlpha = 1;
                
                // this single line makes the chart a bar chart
                chart.rotate = true;

                // AXES
                // Category
                var categoryAxis = chart.categoryAxis;
                categoryAxis.gridPosition = "start";
                categoryAxis.gridAlpha = 0.1;
                categoryAxis.axisAlpha = 0;

                // Value
                var valueAxis = new AmCharts.ValueAxis();
                valueAxis.axisAlpha = 0;
                valueAxis.gridAlpha = 0.1;
                valueAxis.position = "top";
                chart.addValueAxis(valueAxis);

                // GRAPHS
                // first graph
                var graph1 = new AmCharts.AmGraph();
                graph1.type = "column";
                graph1.title = "Sales";
                graph1.valueField = "Sales";
                graph1.balloonText = "Sales :[[value]]";
                graph1.lineAlpha = 0;
                graph1.fillColors = "#ADD981";
                graph1.fillAlphas = 1;
                chart.addGraph(graph1);

                // second graph
                var graph2 = new AmCharts.AmGraph();
                graph2.type = "column";
                graph2.title = "Profit";
                graph2.valueField = "Profit";
                graph2.balloonText = "Profit :[[value]]";
                graph2.lineAlpha = 0;
                graph2.fillColors = "#81acd9";
                graph2.fillAlphas = 1;
                chart.addGraph(graph2);

                // LEGEND
                var legend = new AmCharts.AmLegend();
                legend.position = "bottom";
                legend.valueText = "[[value]]";
                legend.valueWidth = 200;
                legend.valueAlign = "left";
                legend.equalWidths = false;
                legend.periodValueText = "Total: [[value.sum]]"; // this is displayed when mouse is not over the chart.                
                chart.addLegend(legend);

                chart.creditsPosition = "top-right";

                // WRITE
                chart.write("chartdiv");
});

  </script>

</body>
</html>

