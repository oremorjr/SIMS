<?php
include('../../../include/db_config.php');
$db=new DB();
$d_temp=strtotime(Date("F d, Y")); 
$date=date("Y-m-d", $d_temp);
$td=date("Y", $d_temp);
$F=date("F", $d_temp);

$show_gtotal=0;
$show_gprofit=0;

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
	$d1=date('Y-m-d');
	$d2=date('Y-m-d');
}


?>
<div class="col-lg-12" style="min-height:470px;">
      <div id="div-4" class="accordion-body collapse in body">
     <div class="print print-report none"><i class="glyphicon glyphicon-print"></i> Print</div>
		<table  id="" class="report dataTable table table-bordered table-condensed table-hover table-striped">
		  <thead>
			<tr>
			  <th>Agent Name</th>
			  <th class="right">Total</th> 
			  <th class="right">Share (%)</th> 
			</tr>
		  </thead>
		  <tbody>
		  <?php
		 $gtotal=0;
		 $gprofit=0;
		  $q0=mysql_query("SELECT * from osd_transaction where t_paid=1 and t_void=0 and t_return=0 and t_active=0 and t_mode=$mode $q_s group by t_agent order by TID ");
		  while($r0=mysql_fetch_array($q0)){
			$r0_date=$r0['t_transaction_date'];
			$r0_agent=$r0['t_agent'];
		  
		  $q1=mysql_query("SELECT * from osd_transaction where t_agent='$r0_agent' and t_paid=1 and t_void=0 and t_return=0 and t_active=0 and t_mode=$mode $q_s order by TID ");
		  $profit=0;
		  $sale=0;
		  $show_sale=0;
		  $show_profit=0;
		 
		 
		  
		  while($row=mysql_fetch_array($q1)){
			$td=$row['t_transaction_date'];
			$date=date('F d, Y', strtotime($r0_date));
			$day=date('l', strtotime($r0_date));
			$t_profit=$row['t_profit'];
			$amount=$row['t_amount_t'];
			
			$profit=$profit+$t_profit;
			$show_profit=number_format($profit, 2, '.', ',');
			
			$sale=$sale+$amount;
			$show_sale=number_format($sale, 2, '.', ',');
			$agent_name=get_agent_name($r0_agent);
			
			}
 		
			?>
			<tr>
				<td><a href="?page=agent-report&agent_ID=<?php echo $r0_agent;?>&d1=<?php echo $d1;?>&d2=<?php echo $d2;?>"><span   id="rank-<?php echo $r0_agent;?>"></span> <?php echo $agent_name;?></a></td>
				<td class="right"><?php echo $show_sale;?></td> 
				<td class="right rate" data-id="<?php echo $r0_agent;?>" data-rate="<?php echo $sale;?>" id="rate-<?php echo $r0_agent;?>"></td> 
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
      
 		<div class=" total-sales">
		<table id="" class="gtotal" width="100%">
		<tr>
			<td class=" ">Total : <strong>P <?php echo $show_gtotal;?></strong></td>  
		</tr>
		 
		</table>
		</div>    

		<script>
		var n=0;
		$(".rate").each(function(){
		n++;

		var rate=$(this).data('rate');
		var agent=$(this).data('id');
		var gtotal="<?php echo $gtotal;?>";
		var rate=parseFloat(rate/gtotal)*100;


		$(this).html(rate.toFixed(2)); 
		 

		});




		</script> 

    </div>
    <!-- /.box --> 
	
 
  <!-- /.row --> 
</div>
<!-- /.col --> 

<script>
$(document).ready(function() {  
	$('.year').hide();


	function rank(){
	var n=0;
	$(".rate").each(function(){
	n++;
	var agent=$(this).data('id'); 
	$("#rank-"+agent).html(n+'. '); 
	});

	}

	$('.print-report').click(function(){
	rank();
		





		window.print();





	});
 
}); 
</script> 
 

     <script type="text/javascript">
 
$(document).ready(function(){
$('.dataTable').dataTable({

        "bDeferRender": true   ,
           "order": [[ 0, "desc" ]],
         "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "pageLength": 20
});
});
 

  
    </script>
