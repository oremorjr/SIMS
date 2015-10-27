<?php
// MODE : SALES
$mode=2;
$tr_mode=0;

if(isset($_GET['return'])){
$tr_mode=$_GET['return'];
}


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

if(isset($_GET['d1'])){
	$d1=$_GET['d1'];	
	$d2=$_GET['d2'];	
	$pid=$_GET['PID'];
	$q_s="AND td_trans_date >= '$d1' AND td_trans_date <= '$d2' and td_pcode=$pid ";	
	$month_title="";

	if($d1!=$d2):
	$date_range=date('F d, Y', strtotime($d1)).' - '.date('F d, Y', strtotime($d2));
	else:
	$date_range=date('F d, Y', strtotime($d1));
	endif;

}elseif(isset($_GET['month'])) {
	$tdate=$_GET['month'];
	$tyear=$_GET['year'];
	$month_title=date("F", mktime(0, 0, 0,$tdate, 1)).' '.$tyear;
	$q_s="AND MONTH(td_trans_date)='$tdate' AND YEAR(td_trans_date)='$tyear' ";
}






//$q_s="$add AND YEAR(t_transaction_date) = YEAR(CURDATE()) AND MONTH(t_transaction_date) = MONTH(CURDATE())";	
?>
<div class="col-lg-12 sales-report" style="min-height:470px;">
  <div class="row">
    <div class="box">
      <header>
        <div class="icons"> <i class="fa fa-table"></i> </div>
        <div>
          <h5>Sales Per Item Report Details</h5>
        </div>
           <div class="report-date"><?php echo $month_title; ?></div>
      </header>
 <ol class="breadcrumb mb-0">
  <li><a href="?page=general">General</a></li> 
  <li class="active">Sales Per Item Report Details</li>
</ol>


      <div id="div-4" class="accordion-body collapse in body">
          <div class="none f-left collapse-all">Collapse All</div>
      <div class="print print-report none"><i class="glyphicon glyphicon-print"></i> Print</div>
		<table id="" class=" table table-bordered table-condensed table-hover table-striped receipt">
		  <thead>
			<tr>
			  <th>Item Name</th>
			  <th class="right none">Qty</th> 
			  <th class="right none">Total</th> 
			  <th class="none">Manage</th>
			</tr>
		  </thead>
		  <tbody>
		  <?php
		 $gtotal=0;
		 $gprofit=0;
		   $q0=mysql_query("SELECT * from osd_transaction_details where td_ispaid=1 and td_mode=$mode $q_s and td_return=$tr_mode group by td_pcode  ");
		  while($r0=mysql_fetch_array($q0)){
			$r0_date=$r0['td_trans_date'];
			$r0_pid=$r0['td_pcode'];
		  
		  $q1=mysql_query("SELECT * from osd_transaction_details where td_pcode='$r0_pid' and td_ispaid=1 and td_mode=$mode and td_return=$tr_mode $q_s   ");
		  $profit=0;
		  $sale=0;
		  $show_sale=0;
		  $show_profit=0;
		  $t_qty=0;
		 
		 
		  
		  while($row=mysql_fetch_array($q1)){
			$td=$row['td_trans_date'];
			$date=date('Y-m-d', strtotime($r0_date));
			$date2=date('F d, Y', strtotime($r0_date));
			$day=date('l', strtotime($r0_date));
			$t_profit=0;
			$amount=$row['td_total'];

			$qty=$row['td_qty'];
			$td_unit_id=$row['td_unit_id'];
			$UID=unit_item('ui_uid', $td_unit_id);
			$uname=unit('u_symbol', $UID);

			$pid=$row['td_pcode'];
			$pname=product('p_name', $pid);
			$pname=product('p_brand', $pid).' '.$pname;
			$t_qty+=$qty;
			
			 
			
			$sale=$sale+$amount;
			$show_sale=number_format($sale, 2, '.', ',');
			
			}
			
 		
			?>
			<tr class="receipt-date">
				<td> <?php echo $pname;?> </td>
				<td class="right none"><?php echo $t_qty.' '.$uname;?></td> 
				<td class="right none"><?php if(current_user('view-sales-total')): ?><?php echo $show_sale;?><?php endif;?></td> 

				<td class="none">

				<a href="#" id="<?php echo $r0_date;?>" class="btn_details btn btn-sm btn-default">
				<i class="glyphicon glyphicon-barcode"></i> Details
				</a>				
				</td>				
			</tr>
			<tr  class="  trans_<?php echo $r0_date;?>">
				<td colspan="10" style="text-align:center;" class="none">
				<h3><?php echo $date_range;?></h3>
				</td>
			</tr>	
			<tr   class="  trans_<?php echo $r0_date;?> receipt-details"  >
			<td colspan="20">
				<div class="print print-report none"><i class="glyphicon glyphicon-print"></i> Print</div>
				<table id="" class="dataTable1 table table-bordered  receipt-table   ">
				 <thead>
				<tr>
				<th>DNO</th>
				<th>Supplier</th>
				<th class="right">Qty</th>
				<th class="right">Subtotal</th> 
				<th class="none" >Options</th> 
				 
				</tr>
				</thead>
				<tbody>
 			
			<?php 
			$t=0;
			$t_qty2=0;
			$t_sale=0;
			 $q3=mysql_query("SELECT * from osd_transaction_details where   td_ispaid=1 and td_return=$tr_mode and td_mode=$mode $q_s     ");
			 while($q2row=mysql_fetch_array($q3)){
			 $t_id=$q2row['TDID'];
			 $td_mode=$q2row['td_mode'];
			 $td_qty=$q2row['td_qty'];
			 $t_no=$q2row['td_transaction_id'];
			 $TID=get_tid_by_receipt_no($t_no, $td_mode);


			$td_unit_id=$q2row['td_unit_id'];
			$UID=unit_item('ui_uid', $td_unit_id);
			$uname=unit('u_symbol', $UID);



			 $t_amount=$q2row['td_total'];
			 $t_profit=0;
			 $CID=get_supplier_tid_bytransid($t_no, $td_mode);

			 $t_disc=$q2row['td_disc'];
			 $show_t_profit=number_format($t_profit, 2, '.', ',');
			 $show_t_amount=number_format($t_amount, 2, '.', ',');
			 $show_t_disc=number_format($t_disc, 2, '.', ',');
			 $t++;
			 $t_qty2+=$td_qty;
			 $t_sale+=$t_amount;
			 ?>

					<tr>
						<td width="20%"  >
 						<?php  edit_po_receipt($TID, $CID);?>


							<a href="#" class="show_receipt"  data-toggle="modal" data-target="#myModal"   id="<?php echo $TID;?>"><?php echo $t_no;?></a></td> 
						<!-- <td width="20%"><a href="?page=view-receipt&mode=1&TID=<?php echo $t_id; ?>"><?php echo $t_no;?></a></td> -->
						<td width="30%" ><?php echo supplier('sup_name', $CID);?></td> 
						<td width="10%" class="right" > <?php echo $td_qty.' '.$uname;?></td> 
						<td width="30%" class="right"><?php echo $show_t_amount;?></td> 
						<td class='none'>
 						<?php supplier_options($TID, $CID);?>
						</td>
						 
 			
					</tr>
					 
		 
			 <?php
			 }
			  $t_sale=number_format($t_sale, 2, '.', ',');
			?>


			</tbody>
			 
			</table>
			<table id="" class="  table table-bordered  receipt-table   ">
			<tr>
				<td width="20%"  ></td>
				<td width="30%"  ></td>
				<td width="10%" class="right"  ><strong><?php echo $t_qty2.' '.$uname;?></strong></td>
				<td width="30%" class="right"  ><strong>Total : <?php echo $t_sale;?></strong></td>
			</tr>
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
    
      		<?php if(current_user('view-sales-total')): ?>
 		<div class=" total-sales none">
		<table id="" class="gtotal" width="100%">
		<tr>
			<td class=" ">Total : <strong>P <?php echo $show_gtotal;?></strong></td>  
		</tr>
		 
		</table>
		</div>     
		<?php endif;?>

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
  var mode='<?php echo $mode;?>';
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

$('.dataTable1').dataTable({

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