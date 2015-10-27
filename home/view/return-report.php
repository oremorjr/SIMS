
<div id="content">
<div class="outer">
 
<div class="inner">
<div id="loading-result" >
<?php
$d_temp=strtotime(Date("F d, Y")); 
$date=date("Y-m-d", $d_temp);
$tdate="";
$add="";
if(isset($_GET['date'])){
	$tdate=$_GET['date'];
	
	$q_s="AND t_transaction_date='$tdate'";
	$month_title="";
}elseif(isset($_GET['month'])) {
	$tdate=$_GET['month'];
	$tyear=$_GET['year'];
	$month_title=date("F", mktime(0, 0, 0,$tdate, 1)).' '.$tyear;
	$q_s="AND MONTH(t_transaction_date)='$tdate' AND YEAR(t_transaction_date)='$tyear' ";
}


//$q_s="$add AND YEAR(t_transaction_date) = YEAR(CURDATE()) AND MONTH(t_transaction_date) = MONTH(CURDATE())";	
?>
<div class="col-lg-12" style="min-height:470px;">
  <div class="row">
    <div class="box">
      <header>
        <div class="icons"> <i class="fa fa-table"></i> </div>
        <div>
          <h5>Return Report Details</h5>
        </div>
      </header>

 <ol class="breadcrumb mb-0">
  <li><a href="?page=general">General</a></li> 
  <li class="active">Returns Report Details</li>
</ol>




      <div id="div-4" class="accordion-body collapse in body">

          <div class="none f-left collapse-all">Collapse All</div>
      <div class="print print-report none"><i class="glyphicon glyphicon-print"></i> Print</div>







		<table id="" class="dataTable table table-bordered table-condensed table-hover table-striped">
		  <thead>
			<tr>
			  <th>Transaction Date</th>
			  <th class="right">Total</th> 
			  <th class="none">Manage</th>
			</tr>
		  </thead>
		  <tbody>
		  <?php
		 $gtotal=0;
		 $gprofit=0;
		 $q0=mysql_query("SELECT * from osd_transaction where t_paid=1 and t_mode=3 and t_void=0 $q_s group by t_transaction_date  order by t_trans_date DESC ");
		  while($r0=mysql_fetch_array($q0)){
			$r0_date=$r0['t_transaction_date'];
			$tno=$r0['t_receiptno'];
			$tid=$r0['TID'];
		  
		  $q1=mysql_query("SELECT * from osd_transaction where t_transaction_date='$r0_date' and t_paid=1 and t_void=0 and t_mode=3 $q_s");
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
			<tr>
				<td><?php echo $date;?></td>
				<td class="right"><?php echo $show_sale;?></td> 
				<td class="none">

				<a href="#" id="<?php echo $r0_date;?>" class="btn_details btn btn-sm btn-default">
				<i class="glyphicon glyphicon-barcode"></i> Details
				</a>				
				</td>				
			</tr>
			<tr   class="hide_details trans_<?php echo $r0_date;?>">
				<td colspan="10" style="text-align:center;" class="none">
				<h3><?php echo $date;?></h3>
				</td>
			</tr>	
			<tr  class="hide_details trans_<?php echo $r0_date;?> receipt-details"  >
			<td colspan="20">
				<table id="" class="table table-bordered  return-details  ">
				<tr>
				<th>RNO</th>
				 
				<th class="right">Receipt Total</th> 
				<th class="none">Details</th> 
				</tr>
 			
			<?php 
			$t=0;
			 $q3=mysql_query("SELECT * from osd_transaction where t_transaction_date='$r0_date' and t_paid=1 and t_void=0 and t_mode=3 order by TID ASC");
			 while($q2row=mysql_fetch_array($q3)){
			 $t_id=$q2row['TID'];
			 $t_no=$q2row['t_receiptno'];
			 $t_amount=$q2row['t_amount_t'];
			 $t_profit=$q2row['t_profit'];
			 $t_disc=$q2row['t_disc'];
			 $show_t_profit=number_format($t_profit, 2, '.', ',');
			 $show_t_amount=number_format($t_amount, 2, '.', ',');
			 $show_t_disc=number_format($t_disc, 2, '.', ',');
			 $t++;
			 ?>

					<tr>
						<td width="20%"><a href="view/print-preview-return.php?mode=3&TID=<?php echo $t_id; ?>"><?php echo $t_no;?></a></td>
						 
						<td width="30%" class="right"><?php echo $show_t_amount;?></td> 
						<td width="30%" class="none">
						<a href="#" id="<?php echo $t_id;?>" class="btn_td_details btn btn-sm btn-default">
						<i class="glyphicon glyphicon-barcode"></i> Details
						</a>	
						</td>
 			
					</tr>
					<tr  class="hide_details td_trans_<?php echo $t_id;?>">
						<td colspan="20" class="bg-details">
<table id="" class="table table-bordered return-details  " >
				<tr> 
				<th style="width:25%;">Name</th>
				<th class="right">Disc. Rate</th>
				<th class="right">Unit</th>
				<th class="right">Subtotal</th> 
				</tr>
				 

<?php
$sql5=mysql_query("SELECT * from osd_transaction_details
	INNER JOIN osd_transaction ON (t_receiptno=td_transaction_id)
	INNER JOIN osd_product ON (td_pcode=PID)
	INNER JOIN osd_unit_item ON (td_unit_id=UIID)
	INNER JOIN osd_unit ON (ui_uid=UID)
	where td_transaction_id='$t_no'   and td_void=0 and td_mode=3 group by TDID order by TDID  ");
$total_td_total=0;
$total_td_profit=0;
while($row5=mysql_fetch_array($sql5)){
$td_tdid=$row5['TDID'];
$td_pname=$row5['p_name'];
$td_brand=$row5['p_brand'];
$td_unit_name=$row5['u_symbol'];
$td_td_qty=$row5['td_qty'];
$td_td_total=$row5['td_total'];


$td_td_ui_price=$row5['ui_selling_price'];
$td_td_profit=$row5['td_profit'];
$td_td_disc=$row5['td_disc'];
$td_td_disc_l=$row5['td_disc_l'];
$reason=$row5['return_reason'];

$total_td_total=$total_td_total+$td_td_total;
$total_td_profit=$total_td_profit+$td_td_profit;

$show_td_td_total=number_format($td_td_total, 2, '.', ',');
$show_td_td_profit=number_format($td_td_profit, 2, '.', ',');
$show_total_td_td_profit=number_format($total_td_profit, 2, '.', ',');
$show_total_td_td_total=number_format($total_td_total, 2, '.', ',');



?>
<tr class="receipt-details"> 
	<td><div><?php echo $td_brand.' '.$td_pname;?></div>

<div>
	<i>(<?php echo $reason;?>)</i>
</div>
	</td>
	
	<td class="right">

	<span  class="discount"> 
	<?php
	if($td_td_disc_l!=0.00){ 
	$discounts = explode(',', $td_td_disc_l);	
	$last = end($discounts);
	echo 'L ';
	foreach($discounts as $discount){
		
		if($last!=$discount){
			echo $discount.'%, ';
		}else{
			echo $last.'%';
		}
	}	
	?>		
		 
	<?php
	}
	?>	
	
	<?php
	if($td_td_disc!=0.00){ 
	$discounts = explode(',', $td_td_disc);	
	$last = end($discounts);
	echo '+ ';
	foreach($discounts as $discount){
		
		if($last!=$discount){
			echo $discount.'%, ';
		}else{
			echo $last.'%';
		}
	}	
	?>		
		 
	<?php
	}
	?>
	</span>

	</td>
	<td class="right"><?php echo $td_td_qty.' '.$td_unit_name.' x '.$td_td_ui_price;?></td>	
	<td class="right"><?php echo $show_td_td_total;?></td> 
</tr>

 

<?php


}
?>
<tr class="none">
<td colspan="3"></td>
<td class="right">P <?php echo $show_total_td_td_total;?></td> 
</tr>
</table>
						</td>
					</tr>
		 
			 <?php
			 }
			?>
			<tr class='none'>
			<td colspan="4" class="text-right" style="padding-right:52px;">
			<h3><?php echo $t;?><span style="font-size:12px;"> item<?php echo plural($t)?></span></h3>
			</td>
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
      
    </div>
    <!-- /.box --> 
 		<div class=" total-sales">
		<table id="" class="gtotal" width="100%">
		<tr>
			<td class=" ">Grand Total : <strong>P <?php echo $show_gtotal;?></strong></td>  
		</tr>
		 
		</table>
		</div>    
	
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
</script> 
 	
<script src="assets/lib/tablesorter/js/jquery.tablesorter.min.js"></script>
<script src="assets/lib/touch-punch/jquery.ui.touch-punch.min.js"></script>
 
  