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
<script src="../../assets/lib/amcharts/pie.js" type="text/javascript"></script>

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
  var chartData = AmCharts.loadJSON('category-data.php?d1='+d1+'&d2='+d2);

                chart = new AmCharts.AmPieChart();
                chart.dataProvider = chartData;
                chart.titleField = "category";
                chart.valueField = "Sales";
                chart.outlineColor = "#FFFFFF";
                chart.outlineAlpha = 0.8;
                chart.outlineThickness = 2;
                chart.balloonText = "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>";
                // this makes the chart 3D
                chart.depth3D = 15;
                chart.angle = 30;

                // LEGEND
                var legend = new AmCharts.AmLegend();
                legend.position = "bottom";
                legend.valueText = "[[value]]";
                legend.valueWidth = 120;
                legend.valueAlign = "left";
                legend.equalWidths = false;
                legend.periodValueText = "Total: [[value.sum]]"; // this is displayed when mouse is not over the chart.                
                chart.addLegend(legend);
     

                // WRITE
                chart.write("chartdiv");
});

  </script>

</body>
</html>

