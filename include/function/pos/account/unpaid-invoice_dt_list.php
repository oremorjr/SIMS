<?php
require('../../../db_config.php');
$connect=new DB();
$CID=$_REQUEST['CID']; 
$mode=$_REQUEST['MODE'];
if($CID!=0){
$qs="t_customer_id=$CID AND";
}else{
  $qs=" ";
}
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

$receipts=mysql_query("SELECT TID, t_receiptno, t_amount_t, t_trans_date, t_customer_id from osd_transaction where  $qs t_mode=$mode and t_complete=0 and t_return=0 and t_void=0 and t_active=0");
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
  <?php edit_sales_receipt($TID, $customerID);?>

  <a href="#" class="show_receipt"  data-toggle="modal" data-target="#myModal"   id="<?php echo $TID;?>"><?php echo $receiptno;?></a></td>
<td width="20%"><?php echo customer_name($CID);?></td>
<td width="15%"><?php echo $td;?></td>
<td width="15%" class="right"><?php echo $show_td_total;?></td>
<td  width="15%" class="right"><?php echo $show_total_payment;?></td>
<td  width="10%" class="right"><?php echo $show_total_balance;?></td>
 
<td width="20%" class="none">

  <?php customer_options($TID, $customerID);?>

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

<ul class="list-group footer-total" >
  <li class="list-group-item">Total Amount : <strong><?php echo currency();?> <?php echo $show_total_amount;?></strong></li>
  <li class="list-group-item">Total Amount Paid  : <strong><?php echo currency();?> <?php echo $show_total_t_b_amount;?></strong></li>
  <li class="list-group-item">Total Balance : <strong><?php echo currency();?> <?php echo $show_total_total_balance;?></strong></li>
 
</ul>

<?php endif;?>

<script>
var tb="<?php echo $show_total_total_balance;?>";
$('#total_balance').html('P '+tb);
</script>

<script>

$(document).ready(function(){

$('.dataTable').dataTable({

        "bDeferRender": true   ,
        "bPaginate": false, 
        "bInfo": false
});
 
});
</script>