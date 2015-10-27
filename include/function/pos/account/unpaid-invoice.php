<?php
require('../../../db_config.php');
$connect=new DB();
$CID=$_REQUEST['CID']; 
$MODE=$_REQUEST['MODE']; 
$mode=$_REQUEST['MODE']; 

if($MODE==1){
$f="t_customer_id";
$page='?page=edit-pos';
}elseif($MODE==2){
$f="t_supplier_id";
$page='?page=edit-pos-receivings';
}



if($CID!=0){
$qs="$f=$CID AND";
}else{
  $qs=" ";
}


?>

  
 <table id="dataTable1" class=" table table-bordered table-condensed table-hover table-striped">
 <thead>
 <th>Receipt No.</th>
 <th>Date</th>
 <th  class="right">Amount</th>
 <th  class="right">Amount Paid</th>
 <th  class="right">Balance</th>
 
 <th>Options</th>
 
 </thead>
 <tbody>
 <?php

$t_b_amount=0;
$total_amount=0;
$total_t_b_amount=0;
$total_total_balance=0;
$b_total=0;

$receipts=mysql_query("SELECT TID, t_receiptno, t_amount_t, t_trans_date, t_customer_id, t_supplier_id from osd_transaction where  $qs t_mode=$MODE and t_complete=0 and t_return=0 and t_void=0 ");
while($row=mysql_fetch_array($receipts)):
$receiptno=$row['t_receiptno'];
$TID=$row['TID'];
$transID=$row['TID'];

if($MODE==1){
$customerID=$row['t_customer_id'];
$CID=$row['t_customer_id'];
}elseif($MODE==2){
$customerID=$row['t_supplier_id'];	
$CID=$row['t_supplier_id'];
}



$transdate=$row['t_trans_date'];

$amount=$row['t_amount_t'];
$total_amount+=$amount;

$td=date('F d, Y h:i A', strtotime($transdate));
$customername=pabs_query('c_firstname','osd_customer','CID',$customerID);
$show_td_total=number_format($amount, 2, '.', ','); 


$b_amount=customer_balance($CID, $transID, $MODE);
$b_total+=$b_amount;
 

$t_b_amount=customer_payment($CID, $transID, $MODE);

$total_balance=$amount-$t_b_amount;
$show_total_balance=number_format($total_balance, 2, '.', ','); 

$show_total_payment=number_format($t_b_amount, 2, '.', ','); 


$total_t_b_amount+=$t_b_amount;
$total_total_balance+=$total_balance;
$lock=transaction_lock_status($transID);
    $CID=$row['t_customer_id'];
    $SID=$row['t_supplier_id'];

 ?>
<tr>
<td width="15%">  

 
         <?php
         if($mode==1){
        edit_sales_receipt($TID, $CID);
         }elseif($mode==2){
        edit_po_receipt($TID, $SID);
         }
         ?>



  <a href="#" class="show_receipt"  data-toggle="modal" data-target="#myModal"   id="<?php echo $TID;?>"><?php echo $receiptno;?></a></td>
<td width="25%"><?php echo $td;?></td>
<td width="15%" class="right"><?php echo $show_td_total;?></td>
<td  width="15%" class="right"><?php echo $show_total_payment;?></td>
<td  width="15%" class="right"><?php echo $show_total_balance;?></td>
 
<td width="15%">
 
  
         <?php
         if($mode==1){
        customer_options($TID, $CID);
         }elseif($mode==2){
        supplier_options($TID, $SID);
         }
         ?>
 
</td>
 
</tr>
<?php
endwhile;
?>
</tbody>
 </table>
<?php
$show_total_amount=number_format($total_amount, 2, '.', ','); 
$show_total_t_b_amount=number_format($total_t_b_amount, 2, '.', ','); 
$show_total_total_balance=number_format($total_total_balance, 2, '.', ','); 
?>

<?php if(current_user('view-total-unpaid-invoices')):?>

<table class="  table table-bordered table-condensed table-hover table-striped">
<tr>
<td width="15%"></td>
<td width="25%"  class="right"><strong>Total</strong> </td>
<td width="15%" class="right">P <?php echo $show_total_amount;?></td>
<td width="15%" class="right">P <?php echo $show_total_t_b_amount;?></td>
<td width="15%" class="right">P <?php echo $show_total_total_balance;?></td>
<td width="15%"> </td>
</tr>
</table>

<?php endif;?>

<script>
var tb="<?php echo $show_total_total_balance;?>";
$('#total_balance').html('P '+tb);

$(document).ready(function(){

$('#dataTable1').dataTable({

        "bDeferRender": true   ,
        "bPaginate": false, 
        "bInfo": false
});
 
}); 

</script>
 
 