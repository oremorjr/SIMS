<?php
include('../../../include/db_config.php');
$db=new DB();
$d_temp=strtotime(Date("F d, Y")); 
$date=date("Y-m-d", $d_temp);
$td=date("Y", $d_temp);
$F=date("F", $d_temp);

$mode=2;

$show_gtotal=0;
$show_gprofit=0;

if($_REQUEST['d1']!="" ){
	$d1=$_REQUEST['d1'];
	$show_d1=date("F d, Y", strtotime($d1));
	$d2=$_REQUEST['d2'];
	$show_d2=date("F d, Y", strtotime($d2));
	$day=$show_d1.' '.$show_d2;
	$YEAR=$_REQUEST['year'];
	$q_s="AND al_transact_date >= '$d1' AND al_transact_date <= '$d2' ";	

}else{
	// 2014-12-15
	$today=date('Y-m-d');
	$day=date("F d, Y", $d_temp);	
	$q_s="AND al_transact_date='$today' ";	
}


?>
<?php
if(!current_user('daily-sales'))
  return false;
?>
<div class="col-lg-12" style="min-height:470px;">
      <div id="div-4" class="accordion-body collapse in body">
     <div class="print print-report none"><i class="glyphicon glyphicon-print"></i> Print</div>
		<table  id="" class="report dataTable table table-bordered table-condensed table-hover table-striped">
		  <thead>
			<tr>
			  <th>Transaction Date</th>
			  <th class="right">Total</th> 
			</tr>
		  </thead>
		  <tbody>
		  <?php
		 $gtotal=0;
		 $gprofit=0;
		  $q0=mysql_query("SELECT * from osd_account_ledger where al_status=1 $q_s and al_mode=$mode group by al_transact_date order by al_transID ");
		  while($r0=mysql_fetch_array($q0)){
			$r0_date=$r0['al_transact_date'];
		  
		  $q1=mysql_query("SELECT * from osd_account_ledger where al_transact_date='$r0_date' and al_mode=$mode and al_status=1  $q_s order by al_transID ");
		  $profit=0;
		  $sale=0;
		  $show_sale=0;
		  $show_profit=0;
		 
		 
		  
		  while($row=mysql_fetch_array($q1)){
			$td=$row['al_transact_date'];
			$date=date('F d, Y', strtotime($r0_date));
			$day=date('l', strtotime($r0_date));
			$t_profit=0;
			$amount=$row['al_amount'];
			
			$profit=$profit+$t_profit;
			$show_profit=number_format($profit, 2, '.', ',');
			
			$sale=$sale+$amount;
			$show_sale=number_format($sale, 2, '.', ',');
			
			}
 		
			?>
			<tr>
				<td><a href="?page=po-collection-report&date=<?php echo $td;?>"><?php echo $date;?></a></td>
				<td class="right"><?php if(current_user('view-total-p-o-collection')):?><?php echo $show_sale;?><?php endif;?></td> 
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
      	<?php if(current_user('view-total-p-o-collection')):?>
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
$(document).ready(function() {  
	$('.year').hide();
	$('.print-report').click(function(){
		window.print();
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
 