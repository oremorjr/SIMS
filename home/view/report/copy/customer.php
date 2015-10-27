<?php
$dr=$_GET['dr'];
$d_temp=strtotime(Date("F d, Y")); 
$date=date("Y-m-d", $d_temp);
$td=date("Y", $d_temp);
$F=date("F", $d_temp);

if($dr=='today'){
	$day=date("F j, Y", strtotime( '0 days' ) );
	$q_s="AND t_transaction_date='$date'";
}elseif($dr=='yesterday'){
	$day=date("F j, Y", strtotime( '-1 days' ) );
	$q_s="AND t_transaction_date = CURDATE() - INTERVAL 1 DAY";	
}elseif ($dr=='monthly') {
	$day=date("F Y", strtotime( '0 days' ) );
	$q_s="AND YEAR(t_transaction_date) = YEAR(CURDATE()) AND MONTH(t_transaction_date) = MONTH(CURDATE())";	
}elseif ($dr=='lastweek') {
	$today = getdate();
	$weekStartDate = $today['mday'] - $today['wday'];
	$weekEndDate = $today['mday'] - $today['wday']+6;
	$day=$F.' '.$weekStartDate.', '.$td.'/'.$F.' '.$weekEndDate.', '.$td;
	$q_s="AND t_transaction_date <= NOW() AND t_transaction_date >= DATE_SUB(t_transaction_date, INTERVAL 7 DAY)";	
}elseif ($dr=='annual') {
	$q_s="AND YEAR(t_transaction_date) = $td";
}elseif ($dr=='lastyear') {	
	$q_s="AND YEAR(t_transaction_date) = $td";	
}elseif ($dr=='range') {
	$d1=$_GET['d1'];
	$d2=$_GET['d2'];
	$q_s="AND t_transaction_date >= '$d1' AND t_transaction_date <= '$d2' ";		
}
?>
<div class="col-lg-12" style="min-height:470px;">
  <div class="row">
    <div class="box">
      <header>
        <div class="icons"> <i class="fa fa-table"></i> </div>
        <div>
            <h5 style="text-transform:capitalize;"><?php echo $day;?></h5>
        </div>
      </header>
      <div id="div-4" class="accordion-body collapse in body">
		<table id="" class="dataTable table table-bordered table-condensed table-hover table-striped">
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
  </div>
  
  <!-- /.row --> 
</div>
<!-- /.col --> 


  