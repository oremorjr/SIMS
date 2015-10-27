<?php  
$slug=$_GET['type'];
$cat=$_GET['cat'];
?>

 <script type="text/javascript">
$(document).ready(function(){
 
  
 show();
 
function show(){
  var d= $('#range').data('value');
  var arr=d.split('/');
  var d1=arr[0];
  var d2=arr[1];
  console.log(d2);
  var slug=$("#slug").data('value'); 
  var dataString='d1='+d1+'&d2='+d2;
  $.ajax({
  type:'post',
  url: 'view/chart/'+slug+'.php',
  data: dataString,
  success: function(data){
  console.log('YES'); 
$("#frame").attr("src", "view/chart/"+slug+".php?slug="+slug+"&"+dataString);
 
  }

  });
}
 
                var cb = function(start, end, label) {
                    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                    var dt=start.format('YYYY-MM-DD') + '/' + end.format('YYYY-MM-DD');
                    $('#range').data('value',dt);
       show();
                  }

                  var optionSet1 = {
                    startDate: moment().subtract('days', 29),
                    endDate: moment(),
                    minDate: '01/01/2012',
                    maxDate: '12/31/2014',
                    dateLimit: { days: 60 },
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
 
</header>
<span id="range" data-value=""></span>
<div class="col-lg-12">
<div id="div-1" class="accordion-body body in" style="height:50px ;">
<div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">
<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
<span></span> <b class="caret"></b>
</div>	
</div>
</div>
 



  <div class="d-label">
<h5><?php echo $cat;?></h5>
  </div>

<div class="col-lg-12">
  <div class="col-lg-12">
        <div class="print print-report none"><i class="glyphicon glyphicon-print"></i> Print</div> 
</div>
</div>
   <div id="mydiv">

    <iframe id="frame" src="" width="100%" height="700">
   </iframe></div>


</div>
</div>
</div>

</div><!-- end .inner -->
</div><!-- end .outer -->
</div><!-- end #content -->

 

<link rel="stylesheet" href="assets/lib/datepicker/css/datepicker.css">  
<link rel="stylesheet" type="text/css" media="all" href="assets/lib/datepicker/css/daterangepicker-bs3.css" />
<script type="text/javascript" src="assets/lib/datepicker/js/moment.js"></script>
<script type="text/javascript" src="assets/lib/datepicker/js/daterangepicker.js"></script>

<script>
$(document).ready(function() {  
  $('.year').hide();
  $('.report-date').html('');
  $('.print-report').click(function(){
    window.print();
  });
 
}); 
</script> 
