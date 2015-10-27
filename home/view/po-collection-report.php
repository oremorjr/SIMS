<?php
$mode=2;
?>
<div id="content">
<div class="outer">

<div class="inner">
<div id="loading-result" >
<?php
$d_temp=strtotime(Date("F d, Y")); 
$date=date("Y-m-d", $d_temp);
$tdate="";
$add="";
if(isset($_GET['date'])){
	$tdate=$_GET['date'];
	
	$q_s="AND al_transact_date='$tdate'";
	$month_title="";
}elseif(isset($_GET['month'])) {
	$tdate=$_GET['month'];
	$tyear=$_GET['year'];
	$month_title=date("F", mktime(0, 0, 0,$tdate, 1)).' '.$tyear;
	$q_s="AND MONTH(al_transact_date)='$tdate' AND YEAR(al_transact_date)='$tyear' ";
}




//$q_s="$add AND YEAR(t_transaction_date) = YEAR(CURDATE()) AND MONTH(t_transaction_date) = MONTH(CURDATE())";	
?>
<div class="col-lg-12 sales-report" style="min-height:470px;">
  <div class="row">
    <div class="box">
      <header>
        <div class="icons"> <i class="fa fa-table"></i> </div>
        <div>
          <h5>Monthly Collection Report Details</h5>
        </div>
           <div class="report-date"><?php echo $month_title; ?></div>
      </header>
 <ol class="breadcrumb mb-0">
  <li><a href="?page=general">General</a></li> 
  <li class="active">Collection Details</li>
</ol>


      <div id="div-4" class="accordion-body collapse in body">
      <div class="none f-left collapse-all">Collapse All</div>
      <div class="print print-report none"><i class="glyphicon glyphicon-print"></i> Print</div>
		<table id="" class=" table table-bordered table-condensed table-hover table-striped receipt">
		  <thead>
			<tr>
			  <th>Transaction Date</th>
			  <th class="right">Total</th> 
			  <th class="none">Manage</th>
			</tr>
		  </thead>
		  <tbody>
		  <?php
		 $gtotal=0;
		 $gprofit=0;
		 $q0=mysql_query("SELECT * from osd_account_ledger where al_status=1 and al_trash=0 $q_s and al_mode=$mode group by al_transact_date  order by al_transID   ");
		  while($r0=mysql_fetch_array($q0)){
			$r0_date=$r0['al_transact_date'];
			$tno=$r0['al_unique_transID'];
			$tid=$r0['al_transID'];
		  
		  $q1=mysql_query("SELECT * from osd_account_ledger where al_transact_date='$r0_date' and al_status=1 and al_mode=$mode and al_trash=0  $q_s");
		  $profit=0;
		  $sale=0;
		  $show_sale=0;
		  $show_profit=0;
		 
		 
		  
		  while($row=mysql_fetch_array($q1)){
			$td=$row['al_transact_date'];
			$date=date('F d, Y', strtotime($r0_date));
			$t_profit=0;
			$amount=$row['al_amount'];
			
			$profit=$profit+$t_profit;
			$show_profit=number_format($profit, 2, '.', ',');
			
			$sale=$sale+$amount;
			$show_sale=number_format($sale, 2, '.', ',');
			
			}
			
 		
			?>
			<tr class="receipt-date">
				<td><?php echo $date;?></td>
				<td class="right "><?php if(current_user('view-total-p-o-collection')):?><?php echo $show_sale;?><?php endif;?></td> 
				<td class="none">

				<a href="#" id="<?php echo $r0_date;?>" class="btn_details btn btn-sm btn-default">
				<i class="glyphicon glyphicon-barcode"></i> Details
				</a>				
				</td>				
			</tr>
			<tr style="display:none;" class="trans_<?php echo $r0_date;?>">
				<td colspan="10" style="text-align:center;" class="none">
				<h3><?php echo $date;?></h3>
				</td>
			</tr>	
			<tr   class="hide_details trans_<?php echo $r0_date;?> receipt-details"  >
			<td colspan="20">
				<div class="print print-report none"><i class="glyphicon glyphicon-print"></i> Print</div>
				<table id="" class="dataTable table table-bordered  receipt-table   ">
				 <thead>
				<tr>
				<th>TNO</th>
				<th  >Receipt No.</th>  
				<th  >Customer</th>  
				<th  >Type</th>  
				<th  >Bank</th>  
				<th class="right">Amount Paid</th>  
				<th class="none">Options</th>  
				</tr>
				</thead>
 			
			<?php 
			$t=0;
			$daily_total=0;
			 $q3=mysql_query("SELECT * from osd_account_ledger where al_transact_date='$r0_date' and al_status=1 and al_trash=0  and al_mode=$mode order by al_transID ASC");
			 while($q2row=mysql_fetch_array($q3)){
			 $t_id=$q2row['al_transID'];
			 $t_no=$q2row['al_unique_transID'];
			 $al_receipt_ID=$q2row['al_receipt_ID'];
			  $al_customer_ID=$q2row['al_customer_ID'];
			 $t_amount=$q2row['al_amount'];
			 $t_profit=0;
			 $t_disc=0;
			 $daily_total+=$t_amount;
			 $show_t_profit=number_format($t_profit, 2, '.', ',');
			 $show_t_amount=number_format($t_amount, 2, '.', ',');
			 $show_t_disc=number_format($t_disc, 2, '.', ',');
			 $show_daily_total=number_format($daily_total, 2, '.', ',');

			$p_type=$q2row['al_trans_type'];
			$typename=pabs_query('tt_name','osd_transaction_type','tt_ID',$p_type);


			$p_bank=$q2row['al_bank'];
			$bankname=pabs_query('b_bankName','osd_bank','b_bankID',$p_bank);			


			 $t++;
			 ?>

					<tr>
						<td width="15%"> <?php echo $t_no;?> </td>
						<td width="15%"  >
						<?php edit_po_receipt($al_receipt_ID,$al_customer_ID );?>
						<a href="#" class="show_receipt"  data-toggle="modal" data-target="#myModal"   id="<?php echo $al_receipt_ID;?>"><?php echo receipt_no($al_receipt_ID);?></a></td> 
						<td width="20%"  ><?php echo supplier('sup_name', $al_customer_ID);?></td> 
						<td width="10%"  ><?php echo $typename;?></td> 
						<td width="10%"  ><?php echo $bankname;?></td> 
						<td width="15%" class="right"><?php echo $show_t_amount;?></td> 
						<td class="none">
						<?php supplier_options($al_receipt_ID,$al_customer_ID );?>
						</td>
					</tr>
					 
		 
			 <?php
			 }
			?>
			
				</table>
		<?php if(current_user('view-total-p-o-collection')):?>
 		<div class=" total-sales">
		<table id="" class="gtotal collection-table" width="100%">
		<tr class=" ">
			<td colspan="5" class="text-right"  >
			<strong> Total : P <?php echo $show_daily_total;?></strong>
			</td>
			</tr>
		 
		</table>
		</div>     
		<?php endif;?>






			</td>
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
    
      		<?php if(current_user('view-total-p-o-collection')):?>
 		<div class=" total-sales ">
		<table id="" class="gtotal" width="100%">
		<tr>
			<td class=" "><strong>Grand Total : P <?php echo $show_gtotal;?></strong></td>  
		</tr>
		 
		</table>
		</div>     
	<?php endif;?>

    </div>
    <!-- /.box --> 
  	
  </div>
  
  <!-- /.row --> 
</div>
<!-- /.col --> 


  
</div>

</div>
<!-- end .inner -->
</div>
<!-- end .outer -->
</div>
<!-- end #content -->	  
<script>
$(document).ready(function() {  

$(".collapse-all ").click(function(){

$(".hide_details").slideToggle();

})


$('.show_receipt').click(function(){

var TID=$(this).attr('id');
item_summary(TID);
});

 


function item_summary(tid){
  // reset();
  $("#transaction_details_ledger").html('<div class="col-lg-12 loading-img"><img src="../images/loading-long.gif"></div>');
  var mode="<?php echo $mode;?>";
  var empid="<?php echo get_employeee_id();?>";
  //console.log(tid);
  $("#show-btn").removeAttr("disabled", "disabled");
 
  $.ajax({
    data:{tid:tid, mode:mode, empid:empid},
    url:'../include/function/pos/cart_summary_custom.php',
    success:function(data){
      $("#transaction_details_ledger").html(data);

    }
  });

}










	$('.print-report').click(function(){
		window.print();
	});
	$('.btn_details').click(function(){
		var ID=$(this).attr('id');

		$('.trans_'+ID).fadeToggle();
		return false;
	});
	$('.btn_td_details').click(function(){
		var ID=$(this).attr('id');

		$('.td_trans_'+ID).fadeToggle();
		return false;
	});	





 
$(document).ready(function(){

$('.dataTable').dataTable({

        "bDeferRender": true   ,
        "bPaginate": false,
         "bFilter": false,
        "bInfo": false
});
 
});
 

  







}); 
</script>  

     <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width:800px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Receipt Details</h4>
      </div>
      <div class="modal-body" id="transaction_details_ledger">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
      </div>
    </div>
  </div>
</div>

  