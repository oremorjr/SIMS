<?php
$mode=1;
$tr_mode=0;
?>
<div id="content">
<div class="outer">

<div class="inner">
<div id="loading-result" >
<?php
$d_temp=strtotime(Date("F d, Y")); 
$date=date("Y-m-d", $d_temp);
$tdate="";
$add="";
$q_s="";
if(isset($_GET['date'])){
	$tdate=$_GET['date'];
	
	$q_s="AND t_transaction_date='$tdate'";
	$month_title="";
}elseif(isset($_GET['month'])) {
	$tdate=$_GET['month'];
	$tyear=$_GET['year'];
	$month_title=date("F", mktime(0, 0, 0,$tdate, 1)).' '.$tyear;
	$q_s="AND MONTH(t_transaction_date)='$tdate' AND YEAR(t_transaction_date)='$tyear' ";
}elseif(isset($_GET['CID'])) {
	$CID=$_GET['CID'];   
	$d1=$_REQUEST['d1'];
	$show_d1=date("F d, Y", strtotime($d1));
	$d2=$_REQUEST['d2'];
	$show_d2=date("F d, Y", strtotime($d2));
	$q_s="AND  t_customer_id=$CID  AND t_transaction_date >= '$d1' AND t_transaction_date <= '$d2' ";

	if($d1==$d2){
	$show_range=$show_d1;
	}else{
	$show_range=$show_d1.' - '.$show_d2;

	}
}





//$q_s="$add AND YEAR(t_transaction_date) = YEAR(CURDATE()) AND MONTH(t_transaction_date) = MONTH(CURDATE())";	
?>
<div class="col-lg-12 sales-report" style="min-height:470px;">
  <div class="row">
    <div class="box">
      <header>
        <div class="icons"> <i class="fa fa-table"></i> </div>
        <div>
          <h5>Customer Sales Report Details</h5>
        </div>
           <div class="report-date"><?php echo $show_range; ?> </div>
      </header>
 <ol class="breadcrumb mb-0">
  <li><a href="?page=general">General</a></li> 
  <li class="active">Customer Sales Report Details</li>
</ol>


      <div id="div-4" class="accordion-body collapse in body">
          <div class="none f-left collapse-all">Collapse All</div>
      <div class="print print-report none"><i class="glyphicon glyphicon-print"></i> Print</div>
		<table id="" class=" table table-bordered table-condensed table-hover table-striped receipt">
		  <thead>
			<tr>
			  <th>Customer</th>
			  <th class="right none">Total</th> 
			  <th class="none">Manage</th>
			</tr>
		  </thead>
		  <tbody>
		  <?php
		 $gtotal=0;
		 $gprofit=0;
		 $q0=mysql_query("SELECT * from osd_transaction where t_paid=1 and t_mode=$mode and t_return=0 and t_void=0 $q_s group by t_transaction_date  order by t_trans_date   ");
		  while($r0=mysql_fetch_array($q0)){
			$r0_date=$r0['t_transaction_date'];
			$tno=$r0['t_receiptno'];
			$tid=$r0['TID'];
		  
		  $q1=mysql_query("SELECT * from osd_transaction where t_transaction_date='$r0_date' and t_paid=1 and t_void=0 and t_return=0 and t_mode=$mode $q_s");
		  $profit=0;
		  $sale=0;
		  $show_sale=0;
		  $show_profit=0;
		 
		 
		  
		  while($row=mysql_fetch_array($q1)){
			$td=$row['t_transaction_date'];
			$date=date('F d, Y', strtotime($r0_date));
			$t_profit=$row['t_profit'];
			$amount=$row['t_amount_t'];
			
			$profit=$profit+$t_profit;
			$show_profit=number_format($profit, 2, '.', ',');
			
			$sale=$sale+$amount;
			$show_sale=number_format($sale, 2, '.', ',');
			
			}
			
 		
			?>
			<tr class="receipt-date">
				<td><?php echo customer_name($CID);?></td>
				<td class="right none"><?php echo $show_sale;?></td> 
				<td class="none">

				<a href="#" id="<?php echo $r0_date;?>" class="btn_details btn btn-sm btn-default">
				<i class="glyphicon glyphicon-barcode"></i> Details
				</a>				
				</td>				
			</tr>
			<tr  class="  trans_<?php echo $r0_date;?>">
				<td colspan="10" style="text-align:center;" class="none">
				<h3><?php echo $date;?></h3>
				</td>
			</tr>	
			<tr   class="  trans_<?php echo $r0_date;?> receipt-details"  >
			<td colspan="20">
				<div class="print print-report none"><i class="glyphicon glyphicon-print"></i> Print</div>
				<table id="" class="dataTable table table-bordered  receipt-table   ">
				 <thead>
				<tr>
				<th>DNO</th>
				 
				<th class="right">Subtotal</th> 
				 
				</tr>
			</thead>
				<tbody>
 			
			<?php 
			$t=0;
			 $q3=mysql_query("SELECT * from osd_transaction where t_transaction_date='$r0_date' and t_paid=1 and t_void=0 and t_return=0 and  t_mode=$mode and  t_customer_id=$CID order by TID ASC");
			 while($q2row=mysql_fetch_array($q3)){
			 $t_id=$q2row['TID'];
			 $t_no=$q2row['t_receiptno'];
			 $t_amount=$q2row['t_amount_t'];
			 $t_profit=$q2row['t_profit'];
			 $CID=$q2row['t_customer_id'];
			 $t_disc=$q2row['t_disc'];
			 $show_t_profit=number_format($t_profit, 2, '.', ',');
			 $show_t_amount=number_format($t_amount, 2, '.', ',');
			 $show_t_disc=number_format($t_disc, 2, '.', ',');
			 $t++;
			 ?>

					<tr>
						<td width="30%"  ><a href="#" class="show_receipt"  data-toggle="modal" data-target="#myModal"   id="<?php echo $t_id;?>"><?php echo receipt_no($t_id);?></a></td> 
						<!-- <td width="20%"><a href="?page=view-receipt&mode=1&TID=<?php echo $t_id; ?>"><?php echo $t_no;?></a></td> -->
						 
						<td width="30%" class="right"><?php echo $show_t_amount;?></td> 
						 
 			
					</tr>
					 
		 
			 <?php
			 }
			?>
		</tbody>
			 
				</table>
			</td>
			</tr>	
			<?php	
			$gtotal+=$sale;
			$gprofit+=$profit;
			$show_gtotal=number_format($gtotal, 2, '.', ',');
			$show_gprofit=number_format($gprofit, 2, '.', ',');
			}
			?>
			 
		  </tbody>
		</table>

	  </div>

      <!-- end Results--> 
    

 		<div class=" total-sales">
		<table id="" class="gtotal" width="100%">
		<tr>
			<td class=" ">Total : <strong>P <?php echo $show_gtotal;?></strong></td>  
		</tr>
		 
		</table>
		</div>     

    </div>
    <!-- /.box --> 
  	
  </div>
  
  <!-- /.row --> 
</div>
<!-- /.col --> 


  
</div>

</div>
<!-- end .inner -->
</div>
<!-- end .outer -->
</div>
<!-- end #content -->	  
<script>
$(document).ready(function() {  

$(".collapse-all ").click(function(){

$(".hide_details").slideToggle();

})


$('.show_receipt').click(function(){

var TID=$(this).attr('id');
item_summary(TID);
});

 


function item_summary(tid){
  // reset();
  $("#transaction_details_ledger").html('<div class="col-lg-12 loading-img"><img src="../images/loading-long.gif"></div>');
  var mode="<?php echo $mode?>";
  var empid="<?php echo get_employeee_id();?>";
  //console.log(tid);
  $("#show-btn").removeAttr("disabled", "disabled");
 
  $.ajax({
    data:{tid:tid, mode:mode, empid:empid},
    url:'../include/function/pos/cart_summary_custom.php',
    success:function(data){
      $("#transaction_details_ledger").html(data);

    }
  });

}










	$('.print-report').click(function(){
		window.print();
	});
	$('.btn_details').click(function(){
		var ID=$(this).attr('id');

		$('.trans_'+ID).fadeToggle();
		return false;
	});
	$('.btn_td_details').click(function(){
		var ID=$(this).attr('id');

		$('.td_trans_'+ID).fadeToggle();
		return false;
	});	
}); 

$(document).ready(function(){

$('.dataTable').dataTable({

        "bDeferRender": true   ,
        "bPaginate": false,
         "bFilter": false,
        "bInfo": false
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