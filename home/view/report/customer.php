<?php
include('../../../include/db_config.php');
$db=new DB();
$d_temp=strtotime(Date("F d, Y")); 
$date=date("Y-m-d", $d_temp);
$td=date("Y", $d_temp);
$F=date("F", $d_temp);
$show_gtotal=0;
$show_gprofit=0;

if($_REQUEST['d1']!="" ){
	$d1=$_REQUEST['d1'];
	$show_d1=date("F d, Y", strtotime($d1));
	$d2=$_REQUEST['d2'];
	$show_d2=date("F d, Y", strtotime($d2));
	$day=$show_d1.' '.$show_d2;
	$q_s="AND t_transaction_date >= '$d1' AND t_transaction_date <= '$d2' ";	
}else{
	$day=date("F d, Y", $d_temp);	
	$q_s="";	
}


?>
<div class="col-lg-12" style="min-height:470px;">
 
      <div id="div-4" class="accordion-body collapse in body">
   
		<table  id="" class="report dataTable table table-bordered table-condensed table-hover table-striped">
		  <thead>
			<tr>
			  <th>Transaction Date</th>
			  <th>Total</th>
			  <th>Profit</th>
			</tr>
		  </thead>
		  <tbody>
		  <?php
		 $gtotal=0;
		 $gprofit=0;
		  $q0=mysql_query("SELECT * from osd_transaction
		  INNER JOIN osd_customer ON (CID=t_customer_id)
		  where t_paid=1 and t_mode=1 $q_s group by CID ");
		  while($r0=mysql_fetch_array($q0)){
			$r0_date=$r0['t_transaction_date'];
			$r0_cid=$r0['CID'];
			$r0_name=$r0['c_firstname'].' '.$r0['c_lastname'];
		  
		  $q1=mysql_query("SELECT * from osd_transaction
			INNER JOIN osd_customer ON (CID=t_customer_id)
		  where t_customer_id='$r0_cid' and t_paid=1 and t_mode=1 $q_s");
		  $profit=0;
		  $sale=0;
		  $show_sale=0;
		  $show_profit=0;
		 
		 
		  
		  while($row=mysql_fetch_array($q1)){
			$td=$row['t_transaction_date'];
			$date=date('M d, Y', strtotime($r0_date));
			$t_profit=$row['t_profit'];
			$amount=$row['t_amount_t'];
			
			$profit=$profit+$t_profit;
			$show_profit=number_format($profit, 2, '.', ',');
			
			$sale=$sale+$amount;
			$show_sale=number_format($sale, 2, '.', ',');
			
			}
			
 		
			?>
			<tr>
				<td><?php echo $r0_name;?></td>
				<td>₱<?php echo $show_sale;?></td>
				<td>₱<?php echo $show_profit;?></td>
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
 		<div class="col-lg-5 total-sales">
		<table id="" class="table table-bordered table-condensed table-hover table-striped">
		<tr>
			<th>Grand Total</th>
			<th>Total Profit</th>
		</tr>
		<tbody>
		<tr>
				<td>₱<?php echo $show_gtotal;?></td>
				<td>₱<?php echo $show_gprofit;?></td>
		</tr>
		</tbody>
		</table>
		</div>     	
 

    <script src="assets/lib/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="assets/lib/datatables/dataTables.columnFilter.js" type="text/javascript"></script>
<script src="assets/lib/datatables/DT_bootstrap.js" type="text/javascript"></script>
<script src="assets/lib/tablesorter/js/jquery.tablesorter.min.js" type="text/javascript"></script>
<script src="assets/lib/touch-punch/jquery.ui.touch-punch.min.js" type="text/javascript"></script>
