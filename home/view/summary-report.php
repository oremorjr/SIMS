<?php
if(!isset($_REQUEST['year']))
  return false;
$slug=$_GET['type'];
$year=$_REQUEST['year'];
$report_title="";
if($slug=='sales-monthly'){
$report_title="Monthly Sales Invoice";
}elseif($slug=='sales'){
$report_title="Daily Sales Invoice Report";
}elseif($slug=='sales-annually'){
$report_title="Annual Sales Invoice Report";
}elseif($slug=='sales-monthly-collection'){
$report_title="Monthly Sales Collection Report";

}elseif($slug=='sales-annuall-collection'){
$report_title="Annual Sales Collection Report";
}elseif($slug=='agent-statistics'){
$report_title="Agent Statistical Report"; 
}elseif($slug=='return'){
$report_title="Summary of Returns"; 
}elseif($slug=='returns-monthly'){
$report_title="Monthly Returns"; 
}elseif($slug=='receivings'){
$report_title="Receivings Report"; 
 
}elseif($slug=='receivings-monthly'){
$report_title="Monthly Receivings Report"; 
 

}elseif($slug=='paid-customers'){
$report_title="Paid Customers"; 
} 





?>

<span id="slug" data-value="<?php echo $slug;?>"></span>
<div id="content">
<div class="outer">
<div class="inner">	

<div class="row">
<div class="col-lg-12">
<div class="box dark">
<header>
<div class="icons">
<i class="fa fa-table"></i>
</div>
   <div class="lbl-report">
    <h5><span id="report-title"><span class="year_label"></span> <?php echo $report_title;?></span></h5>
   <div class="report-date"><?php //echo date('F d, Y');?></div>
  </div>  

</header>
<span id="range" data-value=""></span>
<div class="col-lg-12" id="report_range">
<div id="div-1" class="accordion-body body in" style="height:50px ;">
<div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">
<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
<span></span> <b class="caret"></b>
</div>	
</div>
<div id="div-2" class="accordion-body body in year" style="height:50px ;" >

<?php
$where="t_paid=1 and t_mode=1";
$group="YEAR(t_transaction_date)";
$rows=osd_query('osd_transaction',$where, $group);
?>

<div class="col-lg-3">
<select id="select_year" class="form-control "> 
<option value="<?php echo $year;?>"><?php echo $year;?></option>
<option value="<?php echo $year;?>">----------------------</option>

<?php
foreach($rows as $row){
  $y=date('Y');
$year=date('Y', strtotime($row['t_transaction_date']));
// if($y!=$year):
?>
<option value="<?php echo $year;?>"><?php echo $year;?></option>
<?php
// endif;
}

?>
</select>
</div>

<!-- end 6 -->
</div>


</div>

<div id="loading-result">



</div>



</div>
</div>
</div>

</div><!-- end .inner -->
</div><!-- end .outer -->
</div><!-- end #content -->

 
<script type="text/javascript">
$(document).ready(function(){

 var xy=$("#select_year").val();
 show(xy);

$('#select_year').change(function(){
var y=$(this).val();
$('.report-date').html(y);
show(y);


});
 

 
function show_result(){
	var slug=$("#slug").data('value'); 
	
}
var y="";
function show(y){
  $('#loading-result').html('<div class="col-lg-12 loading-img"><div class="col-lg-12"><img src="../images/loading-long.gif"></div></div>...');
	var d= $('#range').data('value');
    // alert(y);
	var arr=d.split('/');
	var d1=arr[0];
	var d2=arr[1];
	console.log(d2);
	var slug=$("#slug").data('value'); 
	var dataString='d1='+d1+'&d2='+d2+'&year='+y;
	$.ajax({
	type:'post',
	url: 'view/report/'+slug+'.php',
	data: dataString,
	success: function(data){
	console.log('YES');
	$('#loading-result').html(data);
	} 

	});
}
 
                var cb = function(start, end, label) {
                    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                    var dt=start.format('YYYY-MM-DD') + '/' + end.format('YYYY-MM-DD');
                    var title=start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY');

                    if(start.format('MMMM D, YYYY')==end.format('MMMM D, YYYY')){
                      var title=start.format('MMMM D, YYYY');
                    }
                    var slug=$("#slug").data('value'); 
                    $('#range').data('value',dt);
                    $('.report-date').text(title);
  		 show();
                  }

                  var optionSet1 = {
                    startDate: moment().subtract('days', 29),
                    endDate: moment(),
                    minDate: '01/01/2011',
                    maxDate: '12/31/<?php echo date("Y")+1;?>',
                    dateLimit: { days: 99999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999 },
                    showDropdowns: true,
                    showWeekNumbers: true,
                    timePicker: false,
                    timePickerIncrement: 1,
                    timePicker12Hour: true,
                    ranges: {
                       'Today': [moment(), moment()],
                       'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                       'Last 7 Days': [moment().subtract('days', 6), moment()],
                       'Last 30 Days': [moment().subtract('days', 29), moment()],
                       'This Month': [moment().startOf('month'), moment().endOf('month')],
                       'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                    },
                    opens: 'left',
                    buttonClasses: ['btn btn-default'],
                    applyClass: 'btn-small btn-primary',
                    cancelClass: 'btn-small',
                    format: 'MM/DD/YYYY',
                    separator: ' to ',
                    locale: {
                        applyLabel: 'Submit',
                        cancelLabel: 'Clear',
                        fromLabel: 'From',
                        toLabel: 'To',
                        customRangeLabel: 'Custom',
                        daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
                        monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                        firstDay: 1
                    }
                  };

                  var optionSet2 = {
                    startDate: moment().subtract('days', 7),
                    endDate: moment(),
                    opens: 'left',
                    ranges: {
                       'Today': [moment(), moment()],
                       'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                       'Last 7 Days': [moment().subtract('days', 6), moment()],
                       'Last 30 Days': [moment().subtract('days', 29), moment()],
                       'This Month': [moment().startOf('month'), moment().endOf('month')],
                       'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                    }
                  };

                  $('#reportrange span').html(moment().subtract('days', 29).format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));

                  $('#reportrange').daterangepicker(optionSet1, cb);

                  $('#reportrange').on('show.daterangepicker', function() { console.log("show event fired"); });
                  $('#reportrange').on('hide.daterangepicker', function() { console.log("hide event fired"); });
                  $('#reportrange').on('apply.daterangepicker', function(ev, picker) { 
                    console.log("apply event fired, start/end dates are " 
                      + picker.startDate.format('MMMM D, YYYY') 
                      + " to " 
                      + picker.endDate.format('MMMM D, YYYY')
                    ); 
                  });
                  $('#reportrange').on('cancel.daterangepicker', function(ev, picker) { console.log("cancel event fired"); });

                  $('#options1').click(function() {
                    $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
                  });

                  $('#options2').click(function() {
                    $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
                  });

                  $('#destroy').click(function() {
                    $('#reportrange').data('daterangepicker').remove();
                  });
});
</script>
<link rel="stylesheet" href="assets/lib/datepicker/css/datepicker.css">  
<link rel="stylesheet" type="text/css" media="all" href="assets/lib/datepicker/css/daterangepicker-bs3.css" />
<script type="text/javascript" src="assets/lib/datepicker/js/moment.js"></script>
<script type="text/javascript" src="assets/lib/datepicker/js/daterangepicker.js"></script>

 



    <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width:800px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Receipt Details</h4>
      </div>
      <div class="modal-body" id="transaction_details_ledger">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
      </div>
    </div>
  </div>
</div>



<?php

$slugs=array('agent-statistics', 'return');

foreach($slugs as $slug_comp){

if($slug==$slug_comp){

?>
<script>
var d="<?php echo date('F d, Y');?>";
$(".report-date").html(d);
</script>
<?php

}

}

?>

 
<?php

$slugs=array('sales-monthly', 'sales-monthly-collection', 'sales-annuall-collection', 'sales-annually', 'returns-monthly', 'returns-annual', 'receivings-monthly', 'receivings-annual', 'monthly-po-collection', 'po-annual-collection');

foreach($slugs as $slug_comp2){

if($slug==$slug_comp2){

?>
<script> 
jQuery('#div-1').hide();
</script>
<?php

}

}

?>


<?php

$slugs=array('category');

foreach($slugs as $slug_comp3){

if($slug==$slug_comp3){

?>
<script> 
jQuery('#div-2').hide();
</script>
<?php

}

}

?>