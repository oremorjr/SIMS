<?php
include('../../../include/db_config.php');
$db=new DB();
$d_temp=strtotime(Date("F d, Y")); 
$date=date("Y-m-d", $d_temp);
$td=date("Y", $d_temp);
$F=date("F", $d_temp);

$g1=0;
$g2=0;

$show_gtotal=0;
$show_gprofit=0;
// MODE : SALES
$mode=1;
$tr_mode=0;
$q_s="";
if($_REQUEST['d1']!="" ){
	$d1=$_REQUEST['d1'];
	$show_d1=date("F d, Y", strtotime($d1));
	$d2=$_REQUEST['d2'];
	$show_d2=date("F d, Y", strtotime($d2));
	$day=$show_d1.' '.$show_d2;
	$YEAR=$_REQUEST['year'];
	$q_s="AND td_trans_date >= '$d1' AND td_trans_date <= '$d2' ";	

}else{
	// 2014-12-15
	$today=date('Y-m-d');
	$day=date("F d, Y", $d_temp);	
	$q_s="AND td_trans_date='$today' ";
	$d1=$today;
	$d2=$today;	
}


?>
<div class="col-lg-12" >
      <div id="div-4" class="accordion-body collapse in body">
     <div class="print print-report none"><i class="glyphicon glyphicon-print"></i> Print</div>
		<table  id="d1" class="report dataTable table table-bordered table-condensed table-hover table-striped">
		  <thead>
			<tr>
			 
			  <th>Item Name</th>
			  <th class="right">Qty</th> 
			  <th class="right">Total</th> 
			</tr>
		  </thead>
		  <tbody>
		  <?php
		 $gtotal=0;
		 $gprofit=0;
		  $q0=mysql_query("SELECT * from osd_transaction
		   INNER JOIN osd_transaction_details ON (t_receiptno=td_transaction_id)
		    where  t_return=0 AND t_void=0 AND t_active=0 AND t_mode=$mode AND td_mode=$mode   AND t_active=0 $q_s  and td_return=$tr_mode group by td_pcode  ");
		  while($r0=mysql_fetch_array($q0)){
			$r0_date=$r0['td_trans_date'];
			$r0_pid=$r0['td_pcode'];
		  
		  $q1=mysql_query("SELECT * from osd_transaction  INNER JOIN osd_transaction_details ON (t_receiptno=td_transaction_id)   where t_return=0 and  t_void=0 AND t_mode=$mode AND td_mode=$mode AND t_active=0  AND t_active=0 and td_pcode='$r0_pid' and td_ispaid=1 and td_mode=$mode and td_return=$tr_mode $q_s   ");
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
			<tr>
				 
				<td><a href="?page=sales-item-report&PID=<?php echo $pid;?>&d1=<?php echo $d1;?>&d2=<?php echo $d2;?>"><?php echo $pname;?></a></td>
				<td class="right"><?php echo $t_qty.' '.$uname;?></td> 
				<td class="right"><?php echo $show_sale;?></td> 
			</tr>
			<?php	
			$gtotal+=$sale;
			$gprofit+=$profit;
			$g1=$gtotal;
			$show_gtotal=number_format($gtotal, 2, '.', ',');
			$show_gprofit=number_format($gprofit, 2, '.', ',');
			}
			?>
			 
		  </tbody>
		</table>

 
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
	
 
  <!-- /.row --> 
</div>
<!-- /.col --> 




<div class="col-lg-12"  >
      <div id="div-4" class="accordion-body collapse in body">
     <div class="print print-report none"><i class="glyphicon glyphicon-print"></i> Print</div>
		<table  id="d2" class="report dataTable table table-bordered table-condensed table-hover table-striped">
		  <thead>
			<tr>
			 
			  <th>Item Name</th>
			  <th class="right">Qty</th> 
			  <th class="right">Total</th> 
			</tr>
		  </thead>
		  <tbody>
		  <?php

		 $tr_mode=1;
		 $gtotal2=0;
		 $gprofit=0;
		 $show_gtotal2=0;
		 $g2=0;
		  $q0=mysql_query("SELECT * from osd_transaction
		   INNER JOIN osd_transaction_details ON (t_receiptno=td_transaction_id)
		    where  t_return=0 AND t_void=0 AND t_active=0 AND t_mode=$mode AND td_mode=$mode   AND t_active=0 $q_s  and td_return=$tr_mode group by td_pcode  ");
		  while($r0=mysql_fetch_array($q0)){
			$r0_date=$r0['td_trans_date'];
			$r0_pid=$r0['td_pcode'];
		  
		  $q1=mysql_query("SELECT * from osd_transaction  INNER JOIN osd_transaction_details ON (t_receiptno=td_transaction_id)   where t_return=0 and  t_void=0 AND t_mode=$mode AND td_mode=$mode AND t_active=0  AND t_active=0 and td_pcode='$r0_pid' and td_ispaid=1 and td_mode=$mode and td_return=$tr_mode $q_s   ");
		  $profit=0;
		  $sale=0;
		  $show_sale=0;
		  $show_profit=0;
		  $amount=0;
		 
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
			<tr>
				 
				<td><a href="?page=sales-item-report&PID=<?php echo $pid;?>&d1=<?php echo $d1;?>&d2=<?php echo $d2;?>&return=1"><?php echo $pname;?></a></td>
				<td class="right"><?php echo $t_qty.' '.$uname;?></td> 
				<td class="right"><?php echo $show_sale;?></td> 
			</tr>
			<?php	
			$gtotal2+=$sale;
			$g2=$gtotal2;
			$gprofit+=$profit;
			$show_gtotal2=number_format($gtotal2, 2, '.', ',');
			$show_gprofit=number_format($gprofit, 2, '.', ',');
			}
			?>
			 
		  </tbody>
		</table>

 
      <!-- end Results--> 
      
 		<div class=" total-sales">
		<table id="" class="gtotal" width="100%">
		<tr>
			<td class=" ">Total : <strong>P <?php echo $show_gtotal2;?></strong></td>  
		</tr>
		 
		</table>
		</div>     

    </div>
    <!-- /.box --> 
	
 
  <!-- /.row --> 
</div>
<!-- /.col --> 


		<div class="col-lg-12">
		<?php 
		$a=$g1-$g2;
		$g_total=number_format($a, 2, '.', ',');
		?>
 		<div class=" total-sales right">
		<table id="" class="gtotal" width="100%">
		<tr>
			<td class="right ">Total : <strong>P <?php echo $g_total;?></strong></td>  
		</tr>
		 
		</table>
		</div>  
		</div>   





<script>


$(document).ready(function(){

$('#d1').dataTable({

        "bDeferRender": true   ,
        "bPaginate": false,
         "bFilter": false,
        "bInfo": false,
          "order": [[ 0, "ASC" ]],
});


$('#d2').dataTable({

        "bDeferRender": true   ,
        "bPaginate": false,
         "bFilter": false,
        "bInfo": false,
          "order": [[ 0, "ASC" ]],
});





 
});






$(document).ready(function() {  





	$('.year').hide();
	$('.print-report').click(function(){
		window.print();
	});
 
}); 
</script> 
 