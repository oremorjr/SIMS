<?php
include('../../../include/db_config.php');
$db=new DB();
$d_temp=strtotime(Date("F d, Y")); 
$date=date("Y-m-d", $d_temp);
$td=date("Y", $d_temp);
$F=date("F", $d_temp);
$show_gtotal=0;
$show_gprofit=0;

// SALES : MODE

$mode=1;
$tr_mode=0;

if($_REQUEST['d1']!="" ){
	$d1=$_REQUEST['d1'];
	$show_d1=date("F d, Y", strtotime($d1));
	$d2=$_REQUEST['d2'];
	$show_d2=date("F d, Y", strtotime($d2));
	$day=$show_d1.' '.$show_d2;
	$q_s="AND td_trans_date >= '$d1' AND td_trans_date <= '$d2' ";	
}else{
	$day=date("F d, Y", $d_temp);	
	$y=date('Y');
	$today=date('Y-m-d');
	$q_s="AND td_trans_date='$today' ";	
}


?>
<div class="col-lg-12"  >
 
<div class="col-lg-12">
      <div class="print print-report none"><i class="glyphicon glyphicon-print"></i> Print</div>

</div>
      <div id="div-4" class="accordion-body collapse in body">
		<table id="" class="report dataTable table table-bordered table-condensed table-hover table-striped">
		  <thead>
			<tr>
			  <th>Category</th>
			  <th class="right">Qty</th> 
			  <th class="right">Total</th> 
			  <th class="right">Share (%)</th> 
			</tr>
		  </thead>
		  <tbody>
		  <?php
		 $gtotal=0;
		 $gprofit=0;
		 $show_gtotal=0;
		 $show_gprofit=0;
		 
		  $q0=mysql_query("SELECT * from osd_transaction_details
		  INNER JOIN osd_product ON (td_pcode=PID) 
		  INNER JOIN osd_category ON (CID=p_category_id) 
		  where td_ispaid=1 and td_mode=$mode and td_void=0 and td_return=$tr_mode $q_s group by CID ");
		  while($r0=mysql_fetch_array($q0)){
			$r0_date=$r0['td_date_added'];
			$p_cid=$r0['CID'];
			$cat_name=$r0['cat_name'];
		  
		  $q1=mysql_query("SELECT * from osd_transaction_details 
		  INNER JOIN osd_product ON (td_pcode=PID) 
		  INNER JOIN osd_category ON (CID=p_category_id) 		  
		  where p_category_id='$p_cid' and td_ispaid=1 and td_mode=$mode and td_return=$tr_mode and td_void=0 $q_s");
		  $profit=0;
		  $sale=0;
		  $show_sale=0;
		  $show_profit=0;
		 
		 
		  $t_qty=0;
		  while($row=mysql_fetch_array($q1)){
			$td=$row['td_date_added'];
			$date=date('M d, Y', strtotime($r0_date));
			$t_profit=$row['td_profit'];
			$amount=$row['td_price'];
			$qty=$row['td_qty'];
			
			$profit=$profit+$t_profit;
			$show_profit=number_format($profit, 2, '.', ',');
			
			$sale=$sale+$amount;
			$show_sale=number_format($sale, 2, '.', ',');
			$t_qty+=$qty;
			
			}
			
 		
			?>
			<tr>
				<td><span id="rank-<?php echo $p_cid;?>"></span> <?php echo $cat_name;?></td>
				<td class="right"><?php echo $t_qty;?></td> 
				<td class="right"><?php echo $show_sale;?></td> 
				<td class="right rate" data-sale="<?php echo $sale;?>" data-id="<?php echo $p_cid;?>" id="rate-<?php echo $p_cid;?>"></td> 
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
			<td class=" ">Total : <strong>P <?php echo $show_gtotal;?></strong></td>  
		</tr>
		 
		</table>
		</div>     	
 

  <script src="assets/lib/datatables/jquery.dataTables.js" type="text/javascript"></script> 
<script src="assets/lib/datatables/DT_bootstrap.js" type="text/javascript"></script> 

<script>
$(document).ready(function() {  


$(".rate").each(function(){

var amount=$(this).data('sale');
var t_amount="<?php echo $gtotal;?>";
var rate=parseFloat(amount/t_amount)*100;

$(this).html(rate.toFixed(2));

});

	function rank(){
	var n=0;
	$(".rate").each(function(){
	n++;
	var agent=$(this).data('id'); 
	$("#rank-"+agent).html(n+'. '); 
	});

	}

	$('.year').hide();
	$('.print-report').click(function(){
		rank();
		window.print();
	});
 
}); 
</script> 
 