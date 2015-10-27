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

<div class="col-lg-12">
      <div class="print print-report none"><i class="glyphicon glyphicon-print"></i> Print</div>

</div>	
      <div id="div-4" class="accordion-body collapse in body">
     
		<table  id="" class="report dataTable table table-bordered table-condensed table-hover table-striped">
		  <thead>
			<tr>
			  <th>Transaction Date</th>
			  <th>Total</th> 
			</tr>
		  </thead>
		  <tbody>
		  <?php
		 $gtotal=0;
		 $gprofit=0;
		  $q0=mysql_query("SELECT * from osd_transaction where t_paid=1 and t_mode=3  $q_s group by t_transaction_date ");
		  while($r0=mysql_fetch_array($q0)){
			$r0_date=$r0['t_transaction_date'];
		  
		  $q1=mysql_query("SELECT * from osd_transaction where t_transaction_date='$r0_date' and t_paid=1 and t_mode=3 $q_s");
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
				<td><a href="?page=return-report&date=<?php echo $td;?>"><?php echo $date;?></a></td>
				<td><?php if(current_user('view-total-returns')):?><?php echo $show_sale;?><?php endif;?></td> 
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
      
    </div>
    <!-- /.box --> 
    		<?php if(current_user('view-total-returns')):?>
 		<div class=" total-sales">
		<table id="" class="gtotal" width="100%">
		<tr>
			<td class=" ">Total : <strong>P <?php echo $show_gtotal;?></strong></td>  
		</tr>
		 
		</table>
		</div>     
		<?php endif;?>	
 
 
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
 