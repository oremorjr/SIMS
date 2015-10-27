<?php
require('../../../db_config.php');
$connect=new DB();
$CID="0"; 
$Y=$_REQUEST['Y']; 
$M=$_REQUEST['M']; 
$MODE=$_REQUEST['MODE']; 
$mode=$_REQUEST['MODE']; 

 
 
if($MODE==1){
$f="t_customer_id";
}elseif($MODE==2){
$f="t_supplier_id";
}


if($CID!=0){
$qs="  YEAR(t_transaction_date)='$Y' AND MONTH(t_transaction_date)='$M' AND";
}else{
 $Y=date('Y');
  $qs=" YEAR(t_transaction_date)='$Y' AND MONTH(t_transaction_date)='$M' AND ";
}
?>


  <table class="dataTable1 table table-bordered table-condensed table-hover table-striped">
 <thead>
 <th>Receipt No.</th>
 <th>Customer</th>
 <th>Date</th>
 <th  class="right">Amount</th>
 <th  class="right">Amount Paid</th>
 <th  class="right">Balance</th> 
 <th>Manage</th>
 </thead>
 <tbody>
 <?php

$t_b_amount=0;
$total_amount=0;
$total_t_b_amount=0;
$total_total_balance=0;
$c_balance=0;


$receipts=mysql_query("SELECT TID, t_receiptno, t_amount_t, t_trans_date, t_supplier_id, t_customer_id from osd_transaction where $qs t_mode=$MODE and t_complete=1 and t_return=0 and t_void=0 ") or die(mysql_error());
while($row=mysql_fetch_array($receipts)):
$receiptno=$row['t_receiptno'];
$TID=$row['TID'];
$transID=$row['TID'];
$customerID=$row[$f];
$CID=$row[$f];
$transdate=$row['t_trans_date'];




$amount=$row['t_amount_t'];
$total_amount+=$amount;

$td=date('F d, Y', strtotime($transdate));
$customername=pabs_query('c_firstname','osd_customer','CID',$customerID);
$show_td_total=number_format($amount, 2, '.', ','); 


$b_amount=customer_balance($CID, $transID, $MODE);

//  if($b_amount>0):
//   $update_transaction=mysql_query("UPDATE osd_transaction SET t_complete=0 WHERE TID=$transID");
// endif;



$t_b_amount=customer_payment($CID, $transID);

$total_balance=round($amount-$t_b_amount,2);
$show_total_balance=number_format($total_balance, 2, '.', ','); 

$show_total_payment=number_format($t_b_amount, 2, '.', ','); 


$total_t_b_amount+=$t_b_amount;
$total_total_balance+=$total_balance;
$c_balance+=$b_amount;

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
<td width="25%" class=" "><?php echo $customername;?></td>
<td width="15%"><?php echo $td;?></td>

<td width="15%" class="right"><?php echo $show_td_total;?></td>
<td  width="10%" class="right"><?php echo $show_total_payment;?></td>
<td  width="10%" class="right"><?php echo $show_total_balance;?></td>
 
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
$show_total_total_balance=number_format($c_balance, 2, '.', ','); 
?>
<?php if(current_user('view-po-total')):?>
<table class="  table table-bordered table-condensed table-hover table-striped">
<tr>
<td width="15%"></td>
<td width="25%"  class="right"> <strong>Total</strong></td>
<td width="15%" class="right">P <?php echo $show_total_amount;?></td>
<td width="15%" class="right">P <?php echo $show_total_t_b_amount;?></td>
<td width="15%" class="right"><?php echo $show_total_total_balance;?> </td>
<td width="15%" class="right"></td>

</tr>
</table>
<?php endif;?>
 
    <script type="text/javascript">
 
$(document).ready(function(){
$('.dataTable1').dataTable({

        "bDeferRender": true   ,
           "order": [[ 0, "desc" ]],
         "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "pageLength": 50
});
});
 

  
    </script>
