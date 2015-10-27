<div id="content">
	<div class="outer">
		<div id="breadcrumb2">
			<ul class="crumbs">
				<li class="first">
					<a href="?page=general" style="z-index:9;">General</a>
				</li>
			</ul>
		</div>
		<div class="inner">
			<div class="row">
<div class="col-lg-12">
<div class="box dark">
<header>
<div class="icons"></div>
<h5>
Choose
</h5><!-- .toolbar -->
<div class="toolbar">
<ul class="nav">
<li>
<a href="#">Link</a>
</li>
<li class="dropdown">
<a data-toggle="dropdown" href="#"></a>
<ul class="dropdown-menu">
<li>
<a href="">q</a>
</li>
<li>
<a href="">a</a>
</li>
<li>
<a href="">b</a>
</li>
</ul>
</li>
<li>
<a class="minimize-box" data-toggle="collapse" href="#div-1"></a>
</li>
</ul>
</div><!-- /.toolbar -->
</header>
<div id="div-1" class="accordion-body body in" style="height: auto;">




<form class="form-horizontal" method="post">
<table class="table table-bordered table-striped">
<tbody>
<tr>
<td colspan="2">
<div class="col-lg-6">
<strong>Date Range</strong>
</div>
</td>
</tr>
 <tr>
 	<td></td>
 	<td colspan=>
              <div id="reportrange" class="pull-right" style="width:100%;background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                  <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                  <span></span> <b style="
    float: right;
    margin-top: 8px;
" class="caret"></b>
               </div>		
 	</td>
 </tr>
 
<tr>
<td colspan="2">
<div class="col-lg-6">
<strong>Sale Type</strong>
</div>
</td>
</tr>
<tr>
<td style="width:10px;"></td>
<td>
<div class="col-lg-4">
<select id="type" class="form-control">
<option value="2">
Sales
</option>
<option value="1">
All
</option>
<option value="3">
Return
</option>
</select>
</div>
<div class="col-lg-2">
<input type="button" value="Search" id="save" disabled style="width: 100%;padding: 7px 15px;" class="btn btn-success btn-sm btn-grad">
</div>
</td>
</tr>
</tbody>
</table>
</form>
</div>
</div>
</div><!--END TEXT INPUT FIELD-->
 
 	</div><!-- end .inner -->
		</div><!-- end .outer -->
	</div><!-- end #content -->
</div><script type="text/javascript" src="assets/js/style-switcher.js">

</script>

 

<script type="text/javascript">
$(document).ready(function(){
 
                var cb = function(start, end, label) {
                    $('#reportrange span').html(start.format('MM-D-YYYY') + ' - ' + end.format('MM-D-YYYY'));
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



$('#save').click(function(){
var ID=$('.range:checked').attr('id');
var selected = $('#type').find('option:selected');
var type = selected.val();  

if(type==2){
if(ID=='c_1'){
var choice=$('.choice').val();
if(choice==1){
window.location='?page=report&type=sales&dr=today';
}else if(choice==2){
window.location='?page=report&type=sales&dr=yesterday';
}else if(choice==3){
window.location='?page=report&type=sales&dr=lastweek';
}else if(choice==4){
window.location='?page=report&type=sales&dr=monthly';
}else if(choice==5){
window.location='?page=report&type=sales&dr=annual';
}else if(choice==6){
window.location='?page=report&type=sales&dr=lastyear';
}
}else if(ID=='c_2'){    
var d1=$('#d_1').val();
var d2=$('#d_2').val();
window.location='?page=report&type=sales&dr=range&d1='+d1+'&d2='+d2;
}
}


});

$('.choice').click(function(){
var ID=$(this).data('value');
$('#c_'+ID).attr('checked', 'checked');
$("#save").removeAttr('disabled','disabled');
});
});
</script>

<link rel="stylesheet" href="assets/lib/datepicker/css/datepicker.css">  
      <link rel="stylesheet" type="text/css" media="all" href="assets/lib/datepicker/css/daterangepicker-bs3.css" />
      <script type="text/javascript" src="assets/lib/datepicker/js/moment.js"></script>
      <script type="text/javascript" src="assets/lib/datepicker/js/daterangepicker.js"></script>