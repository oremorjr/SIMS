<?php
include('../../../include/db_config.php');
$db=new DB();
$d_temp=strtotime(Date("F d, Y")); 
$date=date("Y-m-d", $d_temp);
$td=date("Y", $d_temp);
$F=date("F", $d_temp);
$show_gtotal=0;
$show_gprofit=0;
$mode=2;

if($_REQUEST['d1']!="" ){
	$d1=$_REQUEST['d1'];
	$show_d1=date("F d, Y", strtotime($d1));
	$d2=$_REQUEST['d2'];
	$show_d2=date("F d, Y", strtotime($d2));
	$day=$show_d1.' '.$show_d2;
	$q_s="";	
}else{
	$day=date("F d, Y", $d_temp);	
	$q_s="";	
}


if($_REQUEST['year']!="" ){
	$ye=$_REQUEST['year'];
	$y="AND YEAR(al_transact_date)='$ye' ";
}else{
	$ye=date('Y');
	$y="AND YEAR(al_transact_date)='$ye' ";
}



?>
<?php
if(!current_user('monthly-sales-collection'))
  return false;
?>
<div class="col-lg-12" style="min-height:470px;">
      <div id="div-4" class="accordion-body collapse in body">
          <div class="print print-report none"><i class="glyphicon glyphicon-print"></i> Print</div> 
		<table  id="" class="report dataTable table table-bordered table-condensed table-hover table-striped">
		  <thead>
			<tr>
			  <th>Transaction Month</th>
			  <th class="right">Total</th> 
			</tr>
		  </thead>
		  <tbody>
		  <?php
		 $gtotal=0;
		 $gprofit=0;
		  $q0=mysql_query("SELECT *, MONTH(al_transact_date) as td from osd_account_ledger where al_status=1 and al_mode=$mode  $q_s $y group by MONTH(al_transact_date) ");
		  while($r0=mysql_fetch_array($q0)){
			$r0_date=$r0['td'];
			$r0_date1=$r0['al_transact_date'];
		  
		  $q1=mysql_query("SELECT * from osd_account_ledger where MONTH(al_transact_date)='$r0_date' and al_status=1 and al_mode=$mode $q_s $y");
		  $profit=0;
		  $sale=0;
		  $show_sale=0;
		  $show_profit=0;
		 
		 
		  
		  while($row=mysql_fetch_array($q1)){
			$td=$row['al_transact_date'];
			$date=date('M d, Y', strtotime($r0_date));
			$date_single=date('F', strtotime($r0_date1));
			$year_single=date('Y', strtotime($r0_date1));
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
				<td><a href="?page=po-collection-report&month=<?php echo $r0_date;?>&year=<?php echo $year_single;?>"><?php echo $date_single;?></a></td>
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
 