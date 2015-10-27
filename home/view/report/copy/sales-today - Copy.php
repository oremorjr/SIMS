<?php $slug='category';?>
<span id="slug" data-value="<?php echo $slug;?>"></span>
<link rel="stylesheet" href="assets/lib/validationengine/css/validationEngine.jquery.css">
 

<div id="content">

<div class="outer">
			<div id="breadcrumb2">
				<ul class="crumbs">
					<li class="first"><a href="?page=dashboard" style="z-index:9;"><span></span>Dashboard</a></li>
					<li><a href="?page=supplier" style="z-index:8;"><?php echo $slug;?></a></li>
				</ul>
			</div>		
<div class="inner">
	<div class="col-lg-12" style="min-height:470px;">
		<div class="row">
			<div class="box">
				<header>
					<div class="icons">
						<i class="fa fa-table"></i>
					</div>
					<div><h5><?php echo $slug;?>'s Dashboard</h5></div>
				</header>
 
						<div id="div-4" class="accordion-body collapse in body">
						
 					
<div class="text-center">
<?php
 
$date_choice=$_REQUEST['choice'];
if($date_choice=='c_1'){
	$date_range=$_REQUEST['date_range_fixed'];
	if($date_range==1){
		echo 'Today<br>';
		print(Date("l F d, Y")); 
		$d_temp=strtotime(Date("F d, Y")); 
		$date=date("Y-m-d", $d_temp);
		$q_s="AND t_transaction_date='$date'";
	}elseif($date_range==2){
		echo 'Yesterday<br>';
		echo date("l F j, Y", strtotime( '-1 days' ) );
		$d_temp=strtotime(Date("F d, Y")); 
		$date=date("Y-m-d", $d_temp);
		$q_s="AND t_transaction_date = CURDATE() - INTERVAL 1 DAY";	
	}elseif($date_range==3){
		echo 'Last 7 Days<br>';
		$d_temp=strtotime(Date("F d, Y")); 
		$date=date("Y-m-d", $d_temp);
		$q_s="AND t_transaction_date <= NOW() AND t_transaction_date >= DATE_SUB(t_transaction_date, INTERVAL 7 DAY)";	
	}elseif($date_range==4){
		echo 'This Month<br>';
		$d_temp=strtotime(Date("F d, Y")); 
		$date=date("Y-m-d", $d_temp);
		$q_s="AND YEAR(t_transaction_date) = YEAR(CURDATE()) AND MONTH(t_transaction_date) = MONTH(CURDATE())";	
	}elseif($date_range==5){
		echo 'This Year<br>';
		$d_temp=strtotime(Date("F d, Y")); 
		$td=date("Y", $d_temp);
		$q_s="AND YEAR(t_transaction_date) = $td";	
	}elseif($date_range==6){
		echo 'Last Year<br>';
		$d_temp=strtotime(Date("F d, Y")); 
		$td=date("Y", $d_temp)-1;
		$q_s="AND YEAR(t_transaction_date) = $td";	
	}
}

?>
</div>						

							<div id="loading-result" >
							<?php 
							
							$query=mysql_query("SELECT * from osd_transaction where t_paid=1 and t_mode=1 $q_s")or die(mysql_error());
							?> 
		 
												  <?php
												  $i=0;
												  while($qrow=mysql_fetch_array($query)){
													$id=$qrow['t_receiptno'];
													$total=$qrow['t_amount_t'];
													$dt=$qrow['t_transaction_date'];
													$date=date('M d, Y', strtotime($dt));
													
													$i=$i+$total;
													$t=number_format($total, 2, '.', ',');
													
													$tdetails=mysql_query("SELECT * from osd_transaction_details 
													where td_transaction_id='$id' and td_mode=1 ");
													while($trow=mysql_fetch_array($tdetails)){
													
														$profit_temp=$trow['td_profit'];
														$t_profit_temp=number_format($profit_temp, 2, '.', ',');
														
														 
													}
												 
													
													}
													
													?>
												
													<?php
												  
												  ?>

							 
						 
							
							
							<?php 
							
							$query=mysql_query("SELECT * from osd_transaction where t_paid=1 and t_mode=1 $q_s GROUP by t_transaction_date")or die(mysql_error());
							?> 
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
												  $i=0;
												  while($qrow=mysql_fetch_array($query)){
													$id=$qrow['t_receiptno'];
													$total=$qrow['t_amount_t'];
													$dt=$qrow['t_transaction_date'];
													$date=date('M d, Y', strtotime($dt));
													
													$i=$i+$total;
													$t=number_format($total, 2, '.', ',');
													
													$t_profit=0;
													$total_profit=0;
													$grandtotal=0;
													$grandtotal_profit=0;
													$tdetails=mysql_query("SELECT * from osd_transaction where t_transaction_date='$dt' and t_mode=1 ");
													while($trow=mysql_fetch_array($tdetails)){
														$t_amount=$trow['t_amount_t'];
														$total_profit=$total_profit+$trow['t_profit'];
														$t_profit=$t_profit+$t_amount;
														$t1=number_format($t_profit, 2, '.', ',');
														$t2=number_format($total_profit, 2, '.', ',');
														$grandtotal=$grandtotal+$t_profit;
														$grandtotal_profit=$grandtotal_profit+$total_profit;
													}
													
													 												
													
													
													?>
													<tr>
													 
													<td><?php echo $date;?></td>
													<td>₱<?php echo $t1;?></td>
													<td>₱<?php echo $t2;?></td>
												 
													</tr>														
													<?php
													
													}
													
													?>
												
													<?php
												  
												  ?>

							 
												  </tbody>
												  
							</table>							
							
							
 
							 
						 
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
 
		
<script src="assets/lib/datatables/jquery.dataTables.js"></script>
<script src="assets/lib/datatables/dataTables.columnFilter.js"></script>	
<script src="assets/lib/datatables/DT_bootstrap.js"></script>
<script type="text/javascript" charset="utf-8">

$(document).ready(function(){
                $.datepicker.regional[""].dateFormat = 'dd/mm/yy';
                $.datepicker.setDefaults($.datepicker.regional['']);
     $('.dataTable').dataTable({
		"aoColumns": [ 
			{ "sWidth": "200px" },
			null,
			null
		]
	} )
		  .columnFilter({ sPlaceHolder: "head:before",
			aoColumns: [ { type: "text" },
				     { type: "date-range" },
                                     { type: "date-range"  }
				]

		});
});
</script>		
    <script src="assets/lib/tablesorter/js/jquery.tablesorter.min.js"></script>
    <script src="assets/lib/touch-punch/jquery.ui.touch-punch.min.js"></script>
 
 
  