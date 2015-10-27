<?php
$mode=2;
?>

<span id="slug" data-value="<?php echo $slug;?>"></span>
<link rel="stylesheet" href="assets/lib/validationengine/css/validationEngine.jquery.css">
 

<div id="content">

<div class="outer">
 	
<div class="inner">
	<div class="col-lg-12" style="min-height:470px;">
		<div class="row">
			<div class="box">
				<header>
					<div class="icons">
						<i class="fa fa-table"></i>
					</div>
					<div><h5> Paid P.O</h5></div>
				</header>
 
						<div id="div-4" class="accordion-body collapse in body">

<div class="col-lg-12 grid ledger">


<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"><strong>List of Paid P.O</strong></h3>
  </div>

 <table class="table table-bordered table-condensed table-hover table-striped">
<tr>
<td colspan="2"><strong>Filter Date</strong></td>
</tr>

<tr>
  <td>
   <select class="form-control mb-0" id="month" >

  <?php
$rows=osd_query("osd_transaction", $where="t_mode=$mode and t_active=0 and t_transaction_date!='' ", "MONTH(t_transaction_date)");
$ynow=date('F');
$mnow=date('m');
echo '<option value='.$mnow.'>--Select Month--</option>';
echo '<option value='.$mnow.'>'.$ynow.'</option>';

foreach($rows as $row){
$ty=$row['t_transaction_date'];
$y_ty=date('m', strtotime($ty));
$m_ty=date('m', strtotime($ty));
$m_ty2=date('F', strtotime($ty));
if($mnow!=$m_ty):
echo '<option value='.$m_ty.'>'.$m_ty2.'</option>';
endif;
} 
?>

   </select>
  </td>
  <td>

   <select class="form-control mb-0" id="sy" >

  <?php
$rows=osd_query("osd_transaction", $where="t_mode=$mode and t_active=0 and t_transaction_date!='' ", "YEAR(t_transaction_date)");
$ynow=date('Y');
echo '<option value='.$ynow.'>--Select Year--</option>';
echo '<option value='.$ynow.'>'.$ynow.'</option>';
foreach($rows as $row){
$ty=$row['t_transaction_date'];
$y_ty=date('Y', strtotime($ty));
if($y_ty!=$ynow):
echo '<option value='.$y_ty.'>'.$y_ty.'</option>';
endif;
} 
?>

   </select>

  </td>

</tr>
</table>

 



  <div class="panel-body">


  <div id="paid-invoice">
  </div>


  </div>
</div>





            </div> 
         


						</div> 
				 
				<!-- end Results-->

			</div><!-- /.box -->
		</div><!-- /.row -->
	</div><!-- /.col -->

 	
</div>
<!-- end .inner -->
</div>
<!-- end .outer -->
</div>
<!-- end #content -->	  
 
 <script>
 $(document).ready(function(){


var CID="";
var MODE="<?php echo $mode;?>";
var Y=$("#sy option:selected").val();
var M=$("#month option:selected").val();
 
paid_po_year_report(CID, Y, M, MODE);


$("#sy").change(function(){
var Y=$(this).val();
 var M=$("#month option:selected").val();
paid_po_year_report(CID, Y, M, MODE);



});


$("#month").change(function(){
var Y=$("#sy option:selected").val();
 var M=$(this).val();
paid_po_year_report(CID, Y, M, MODE);



});

$('.filter').click(function(){
  $('#receipt-list').html('<div class="col-lg-12 loading-img"><img src="../images/loading-long.gif"></div>');
var string=$('.string').val();
  $.ajax({
    data: {RNO:string},
    url:'../include/function/pos/customer-list.php',
    success:function(data){
   $('#receipt-list').html(data);
    }


  });

});
 });
 </script>

  

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
<script>
$(document).ready(function() {  
	$('.year').hide();
	$('.print-report').click(function(){
		window.print();
	});
 
}); 
</script> 
 