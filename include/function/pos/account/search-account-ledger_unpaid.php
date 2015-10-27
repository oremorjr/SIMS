<?php
require('../../../db_config.php');
$connect=new DB();
$str=$_REQUEST['RNO']; 
 
 
?>

  
 <table class="dataTable table table-bordered table-condensed table-hover table-striped">
 <thead>
 <th>Receipt No.</th>
 <th>Customer</th>
 <th>Date</th>
 <th  class="right">Amount</th>
 <th  class="right">Amount Paid</th>
 <th  class="right">Balance</th>
<!--  <th>Progress</th> -->
 <th class="none">Manage</th>
 
 </thead>
 <?php

$t_b_amount=0;
$total_amount=0;
$total_t_b_amount=0;
$total_total_balance=0;
$b_total=0;

$receipts=mysql_query("SELECT TID, t_receiptno, t_amount_t, t_trans_date, t_customer_id from osd_transaction INNER JOIN osd_customer ON (CID=t_customer_id) 

 where  t_mode=1 and t_complete=0 and t_return=0 and t_void=0 and t_active=0 and (c_firstname LIKE '%$str%' OR t_receiptno LIKE '%$str%'  ) ");


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
$b_total+=$b_amount;
 

$t_b_amount=customer_payment($CID, $transID);

$total_balance=$amount-$t_b_amount;
$show_total_balance=number_format($total_balance, 2, '.', ','); 

$show_total_payment=number_format($t_b_amount, 2, '.', ','); 


$total_t_b_amount+=$t_b_amount;
$total_total_balance+=$total_balance;


 ?>
<tr>
<td width="15%">  
<span class="none">
  <?php
$lock=transaction_lock_status($transID);
if($lock==1  ){
echo '  <img src="../images/snk-lock.png" width="13" class="right snk-unlock">';
}

if($lock==0 && current_user('edit-receipt')){
echo '<a target="_blank" href="?page=edit-pos&ID='.$customerID.'&TID='.$TID.'"><img src="../images/snk-unlock.png" width="13" class="right snk-unlock"></a>';

}
  ?>
</span>


  <a href="#" class="show_receipt"  data-toggle="modal" data-target="#myModal"   id="<?php echo $TID;?>"><?php echo $receiptno;?></a></td>
<td width="20%"><?php echo customer_name($CID);?></td>
<td width="15%"><?php echo $td;?></td>
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

  <?php
if(current_user('add-payment')):
  ?>
  <a href="?page=account-receivable&CID=<?php echo $customerID?>&TID=<?php echo $TID;?>" class="manageledgerbtn btn btn-success" title="Add Payment"><i class="glyphicon glyphicon-plus"></i></a> 
 <?php endif; ?>

 <?php
if(current_user('view-customer-ledger')):
 ?>
  <a href="?page=account-ledger&CID=<?php echo $customerID?>&TID=<?php echo $TID;?>" class="manageledgerbtn btn btn-primary" title="Ledger"><i class="glyphicon glyphicon-th-list"></i></a>
<?php endif;?>


</td>
 
</tr>
<?php
endwhile;
?>
 </table>
<?php
$show_total_amount=number_format($total_amount, 2, '.', ','); 
$show_total_t_b_amount=number_format($total_t_b_amount, 2, '.', ','); 
$show_total_total_balance=number_format($total_total_balance, 2, '.', ','); 
?>
<?php if(current_user('view-unpaid-customers-total')):?>
<table class="  table table-bordered table-condensed table-hover table-striped">
<tr>
<td width="15%"></td>
<td width="20%" > </td>
<td width="15%"  class="right"><strong>Total</strong></td>
<td width="15%" class="right">P <?php echo $show_total_amount;?></td>
<td width="15%" class="right">P <?php echo $show_total_t_b_amount;?></td>
<td width="15%" class="right">P <?php echo $show_total_total_balance;?></td>
<td width="15%" class="none"> </td>
</tr>
</table>
<?php endif;?>

<script>
var tb="<?php echo $show_total_total_balance;?>";
$('#total_balance').html('P '+tb);
</script>

    <script src="assets/lib/datatables/DT_bootstrap.js"></script>