<?php
require('../../../db_config.php');
$connect=new DB();
$CID=$_REQUEST['CID'];
$TID=$_REQUEST['TID'];
$MODE=get_mode($TID);
 

$account_name=pabs_query('c_firstname','osd_customer','CID',$CID);
$c_address=pabs_query('c_address1','osd_customer','CID',$CID);
$tb=customer_balance($CID, $TID, $MODE);
$cp=customer_payment($CID, $TID, $MODE);
$b=number_format($tb, 2, '.', ','); 
$c=number_format($cp, 2, '.', ','); 
?>


  <div class="panel-body" style="padding:10px;">


<?php
$amount_arr=array();
$balances=array();
$payments2=mysql_query("SELECT al_amount from osd_account_ledger where al_receipt_ID=$TID and al_status=1 and al_trash=0 and al_locked=0 and al_mode=$MODE ORDER BY al_transID  ");
while($row2=mysql_fetch_array($payments2)){
 
$p_amount_arr=$row2['al_amount'];
$amount_arr[]=$p_amount_arr; 
}
 ?>
 
 <?php
 $t_balance=0;
$count_payment=count($amount_arr);
 $total_amount=receipt_total($TID);

for($i=0;$i<$count_payment;$i++){

  
$total_amount=round($total_amount-$amount_arr[$i], 2);  
 

// echo $amount_arr[$i].'  == '.$total_amount.'<br>';

$balances[]=$total_amount;

}



 ?>

 <table class="  table table-bordered table-condensed table-hover table-striped">
  <tr>
 <td colspan="10">Amount Paid : <strong><?php echo $c; ?></strong></td>
</tr>		
 <tr>
 <td colspan="2"><strong>Transaction No.</strong></td>
  <td><strong>Transaction Date</td> 
  <td><strong>Payment Type</td> 
 
 <td><strong>Cheque Date</td> 
 <td  class="right"><strong>Amount</strong></td> 
 <td  class="right"><strong>Status</strong></td>
<!--  <th>Progress</th> -->
 
 </tr>

 <?php

$count_payments=count_sims_query_general('COUNT(al_transID)','s','osd_account_ledger',"al_receipt_ID=$TID and al_status=1 and al_locked=0 and al_mode=$MODE ");


$payments=mysql_query("SELECT * from osd_account_ledger where al_receipt_ID=$TID and al_status=1 and al_trash=0 and al_locked=0 and al_mode=$MODE ORDER BY al_transID  ");

$j=-1;
$count_balances=count($balances);
while($row=mysql_fetch_array($payments)){
$j++;

$p_ID=$row['al_transID'];
$p_rno=$row['al_receipt_no'];
$p_transdate=$row['al_trans_date'];
$p_payment_date=$row['al_transaction_date'];
$transaction_date=$row['al_transact_date'];

$p_desc=$row['al_payment_description'];
$p_checque=$row['al_chequeno'];
$p_type=$row['al_trans_type'];
$typename=pabs_query('tt_name','osd_transaction_type','tt_ID',$p_type);

$p_bank=$row['al_bank'];
$bankname=pabs_query('b_bankName','osd_bank','b_bankID',$p_bank);


$p_ref_no=strtoupper($row['al_unique_transID']);
$show_p_transdate=date('F d, Y', strtotime($p_transdate));
$show_tp_transdate=date('F d, Y', strtotime($p_payment_date));
$show_transcation_date=date('F d, Y', strtotime($transaction_date));

$p_amount=$row['al_amount'];
$show_p_amount=number_format($p_amount, 2, '.', ','); 


$show_balance=number_format($balances[$j], 2, '.', ','); 

$total_amount=receipt_total($TID);
$payment_date=date('Y-m-d', strtotime($p_transdate));

if($typename!="Cheque"){
$show_p_transdate="N/A";
}



 ?>
 
 <tr>
  <td width="1%">
  <?php
if(current_user('remove-payment')):
  ?>
  	<a href="#"  class="deactivate" id="<?php echo $p_ID;?>"><i class="glyphicon glyphicon-remove-circle"></i></a>
<?php endif;?>
  </td>	
  <td width="15%"><button  class="ardetails" id="<?php echo $p_ID;?>"><?php echo $p_ref_no;?></button> <!-- <a href="#" class="s10"><i class="glyphicon glyphicon-print"></i></a> --></td>
  
  <td width="25%"><?php echo $show_transcation_date;?></td>
  <td width="25%"><?php if($typename=='Cheque') :  echo date_status($payment_date,$p_ID ); endif ;?> <?php echo $typename; ?> </td>
  <td width="25%"><?php echo $show_p_transdate;?></td>
  <td width="15%" class="right"><?php echo $show_p_amount;?></td> 
  <td width="15%" ><span class=" align-center"><?php payment_status($p_ID);?></span></td>
</tr>
 <tr id="details_posted-<?php echo $p_ID;?>" style="display:none;">
<td colspan="10">
 <table class="  table table-bordered  ">
<tr>
<td>
<ul class="list-group" style="margin-bottom:5px;">
  <li class="list-group-item">Cheque No. : <?php echo $p_checque;?></li>
  <li class="list-group-item">Type : <?php echo $typename;?></li>
  <li class="list-group-item">Bank : <?php echo $bankname;?></li>
   <li class="list-group-item">Payment Description : <?php echo $p_desc;?></li>
</ul>
</td>	
</tr>
 
</table>
</td>
</tr>
<?php
}

if($count_payments==0):
?>
<tr  >
<td colspan="10" align="center" height="20">There is no payment made yet</td>
</tr>
<?php
endif;
?>
 </table>
 <?php
if(current_user('finalize-payment')):
$bl=customer_balance($CID, $TID, $MODE);
$lock_status=lock_status($TID, $MODE);
if($bl<=0 && $lock_status==0):
 ?>
   <table class="  table table-bordered table-condensed table-hover table-striped">
 <tr>
<td><input type="button" id="lock" data-toggle="modal" data-target="#AUTH" value="Lock Payment" class="btn btn-success"></td>
</tr>
</table>
 <?php 
endif;
 endif;?>

  </div>







 
