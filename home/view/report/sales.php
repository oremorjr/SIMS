<?php
include('../../../include/db_config.php');
$db=new DB();
$d_temp=strtotime(Date("F d, Y")); 
$date=date("Y-m-d", $d_temp);
$td=date("Y", $d_temp);
$F=date("F", $d_temp);

$show_gtotal=0;
$show_gprofit=0;
// MODE : SALES
$mode=1;

if($_REQUEST['d1']!="" ){
	$d1=$_REQUEST['d1'];
	$show_d1=date("F d, Y", strtotime($d1));
	$d2=$_REQUEST['d2'];
	$show_d2=date("F d, Y", strtotime($d2));
	$day=$show_d1.' '.$show_d2;
	$YEAR=$_REQUEST['year'];
	$q_s="AND t_transaction_date >= '$d1' AND t_transaction_date <= '$d2' ";	

}else{
	// 2014-12-15
	$today=date('Y-m-d');
	$day=date("F d, Y", $d_temp);	
	$q_s="AND t_transaction_date='$today' ";	
}


?>
<div class="col-lg-12" style="min-height:470px;">
      <div id="div-4" class="accordion-body collapse in body">
     <div class="print print-report none"><i class="glyphicon glyphicon-print"></i> Print</div>
		<table  id="" class="report dataTable table table-bordered table-condensed table-hover table-striped">
		  <thead>
			<tr>
			  <th class="hidden">Transaction Date </th>
			  <th>Transaction Date  </th>
			  <th class="right">Total</th> 
			</tr>
		  </thead>
		  <tbody>
		  <?php
		 $gtotal=0;
		 $gprofit=0;
		  $q0=mysql_query("SELECT * from osd_transaction where t_paid=1 and t_mode=$mode $q_s and t_return=0 and t_void=0 and  t_active=0 group by t_transaction_date order by TID ");
		  while($r0=mysql_fetch_array($q0)){
			$r0_date=$r0['t_transaction_date'];
		  
		  $q1=mysql_query("SELECT * from osd_transaction where t_transaction_date='$r0_date' and t_paid=1 and t_return=0 and t_void=0 and  t_active=0 and t_mode=$mode $q_s order by TID ");
		  $profit=0;
		  $sale=0;
		  $show_sale=0;
		  $show_profit=0;
		 
		 
		  
		  while($row=mysql_fetch_array($q1)){
			$td=$row['t_transaction_date'];
			$date=date('Y-m-d', strtotime($r0_date));
			$date2=date('F d, Y', strtotime($r0_date));
			$day=date('l', strtotime($r0_date));
			$t_profit=$row['t_profit'];
			$amount=$row['t_amount_t'];
			
			$profit=$profit+$t_profit;
			$show_profit=number_format($profit, 2, '.', ',');
			
			$sale=$sale+$amount;
			$show_sale=number_format($sale, 2, '.', ',');
			
			}
 		
			?>
			<tr>
				<td class="hidden"><a href="?page=sales-report&date=<?php echo $td;?>"><?php echo $date;?></a></td>
				<td><a href="?page=sales-report&date=<?php echo $td;?>"><?php echo $date2;?></a></td>
				<td class="right"><?php if(current_user('view-sales-total')): ?><?php echo $show_sale;?><?php endif;?></td> 
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

 
      <!-- end Results--> 
      		<?php if(current_user('view-sales-total')): ?>
 		<div class=" total-sales">
		<table id="" class="gtotal" width="100%">
		<tr>
			<td class=" ">Total : <strong>P <?php echo $show_gtotal;?></strong></td>  
		</tr>
		 
		</table>
		</div>     
		<?php endif;?>

    </div>
    <!-- /.box --> 
	
 
  <!-- /.row --> 
</div>
<!-- /.col --> 

<script>


$(document).ready(function(){

$('.dataTable').dataTable({

        "bDeferRender": true   ,
        "bPaginate": false,
         "bFilter": false,
        "bInfo": false,
          "order": [[ 0, "desc" ]],
});
 
});






$(document).ready(function() {  





	$('.year').hide();
	$('.print-report').click(function(){
		window.print();
	});
 
}); 
</script> 
 