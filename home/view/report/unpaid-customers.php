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
	$YEAR=$_REQUEST['year'];
	$q_s="AND t_transaction_date >= '$d1' AND t_transaction_date <= '$d2' ";	

}else{
	// 2014-12-15
	$today=date('Y-m-d');
	$day=date("F d, Y", $d_temp);	
	$q_s="AND t_transaction_date='$today' ";	
}


 
  $qs=" ";
 


?>




<div class="col-lg-12">

      <div class="print print-report none"><i class="glyphicon glyphicon-print"></i> Print</div>

  <table class="dataTable table table-bordered table-condensed table-hover table-striped">
 <thead>
 <th>Receipt No.</th> 
 <th>Customer Name</th>
 <th>Date</th>
 <th  class="right">Amount</th>
 <th  class="right">Amount Paid</th>
 <th  class="right ">Balance</th>
<!--  <th>Progress</th> -->
 <th class="none">Manage</th>
 </thead>
 <?php

$t_b_amount=0;
$total_amount=0;
$total_t_b_amount=0;
$total_total_balance=0;
$c_balance=0;


$receipts=mysql_query("SELECT TID, t_receiptno, t_amount_t, t_trans_date, t_customer_id from osd_transaction where $qs t_mode=1 $q_s and t_complete=0 and t_return=0 and t_void=0 ");
while($row=mysql_fetch_array($receipts)):
$receiptno=$row['t_receiptno'];
$TID=$row['TID'];
$transID=$row['TID'];
$customerID=$row['t_customer_id'];
$CID=$row['t_customer_id'];
$transdate=$row['t_trans_date'];

$amount=$row['t_amount_t'];
$total_amount+=$amount;

$td=date('F d, Y', strtotime($transdate));
$customername=pabs_query('c_firstname','osd_customer','CID',$customerID);
$show_td_total=number_format($amount, 2, '.', ','); 


$b_amount=customer_balance($CID, $transID);

 

$t_b_amount=customer_payment($CID, $transID);

$total_balance=round($amount-$t_b_amount,2);
$show_total_balance=number_format($total_balance, 2, '.', ','); 

$show_total_payment=number_format($t_b_amount, 2, '.', ','); 


$total_t_b_amount+=$t_b_amount;
$total_total_balance+=$total_balance;
$c_balance+=$b_amount;

 ?>
<tr>
<td width="20%">
<span class="none">
<?php
if(lock_status($TID)==1):
echo ' <img src="../images/snk-complete.png" width="15" class="right snk-unlock"> ';
else:
echo '<i class="glyphicons glyphicons-unlock"></i> ';
endif;
?>
</span>
  <a href="#" class="show_receipt"  data-toggle="modal" data-target="#myModal"   id="<?php echo $TID;?>"><?php echo $receiptno;?></a></td>
 
<td width="15%"><?php echo customer_name($CID);?></td>
<td width=" 15%"><?php echo $td;?></td>
<td width="15%" class="right"><?php echo $show_td_total;?></td>
<td  width="15%" class="right"><?php echo $show_total_payment;?></td>
<td  width="15%" class="right"><?php echo $show_total_balance;?></td>
<!-- <td width="10%">
<div class="progress">
  <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
    60%
  </div>
</div>
</td> -->
<td width="15%" class="none">
 
  <a href="?page=account-receivable&CID=<?php echo $customerID?>&TID=<?php echo $TID;?>" class="manageledgerbtn btn btn-success" title="Add Payment"><i class="glyphicon glyphicon-folder-open"></i></a> 
 

  <a href="?page=account-ledger&CID=<?php echo $customerID?>&TID=<?php echo $TID;?>" class="manageledgerbtn btn btn-primary" title="Ledger"><i class="glyphicon glyphicon-th-list"></i></a></td>
</tr>
<?php
endwhile;
?>
 </table>
<?php
$show_total_amount=number_format($total_amount, 2, '.', ','); 
$show_total_t_b_amount=number_format($total_t_b_amount, 2, '.', ','); 
$show_total_total_balance=number_format($c_balance, 2, '.', ','); 
?>

<table class="  table table-bordered table-condensed table-hover table-striped">
<tr>
<td width="15%"></td>
<td width="25%"  class="right"> <strong>Total</strong></td>
<td width="15%" class="right">P <?php echo $show_total_amount;?></td>
<td width="15%" class="right">P <?php echo $show_total_t_b_amount;?></td>
<td width="15%" class="right">--</td>
<td width="15%" class="none"> </td>
</tr>
</table>

</div>
<script>
$(document).ready(function() {  
	$('.year').hide();
	$('.report-date').html('');
	$('.print-report').click(function(){
		window.print();
	});

    $('.show_receipt').click(function(){
var TID=$(this).attr('id');
item_summary(TID);
});
}); 
</script> 
     <script src="assets/lib/datatables/DT_bootstrap.js"></script>