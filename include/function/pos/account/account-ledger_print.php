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



  <div class="panel-body">


<?php
$amount_arr=array();
$balances=array();
$payments2=mysql_query("SELECT al_amount from osd_account_ledger where al_receipt_ID=$TID and al_status=1 and al_mode=$MODE ORDER BY al_transID  ");
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

<table border="0" width="100%" cellspacing="0" cellpadding="0" id="ledger">
 <thead>
 <th class="right">Reference No.</th>
 <th class="right">Transaction Date</th> 
 <th class="right">Type</th> 
 <th class="right">Cheque Date</th> 
 <th  class="right">Amount Paid</th>
 <th  class="right">Balance</th>
<!--  <th>Progress</th> -->
 
 </thead>

 <?php

$count_payments=count_sims_query2('COUNT(al_transID)','s','osd_account_ledger','al_receipt_ID',$TID);


$payments=mysql_query("SELECT * from osd_account_ledger where al_receipt_ID=$TID and al_status=1 and al_mode=$MODE ORDER BY al_transID  ");

$j=-1;
$count_balances=count($balances);
while($row=mysql_fetch_array($payments)){
$j++;
 


$p_ID=$row['al_transID'];
$p_rno=$row['al_receipt_no'];
$p_transdate=$row['al_transaction_date'];
$p_c_transdate=$row['al_trans_date'];

$p_desc=$row['al_payment_description'];
$p_checque=$row['al_chequeno'];
$p_type=$row['al_trans_type'];
$typename=pabs_query('tt_name','osd_transaction_type','tt_ID',$p_type);
$p_payment_date=$row['al_transaction_date'];
$p_bank=$row['al_bank'];
$bankname=pabs_query('b_bankName','osd_bank','b_bankID',$p_bank);

$p_type=$row['al_trans_type'];
$typename=pabs_query('tt_name','osd_transaction_type','tt_ID',$p_type);
$p_ref_no=strtoupper($row['al_unique_transID']);
$show_p_transdate=date('F d, Y', strtotime($p_c_transdate));

$p_amount=$row['al_amount'];
$show_p_amount=number_format($p_amount, 2, '.', ','); 

$show_tp_transdate=date('F d, Y', strtotime($p_payment_date));
$show_balance=number_format($balances[$j], 2, '.', ','); 

$total_amount=receipt_total($TID);
$d=number_format($total_amount, 2, '.', ','); 
if($typename!="Cheque"){
$show_p_transdate="N/A";
}


 ?>
 
 <tr>
  <td width="20%" class="right"> <?php echo $p_ref_no;?> </td>
  <td width="15%" class="right"><?php echo $show_tp_transdate;?></td>
  <td width="15%" class="right"><?php echo $typename;?></td>
  <td width="15%" class="right"><?php echo $show_p_transdate;?></td>
  <td width="15%" class="right"><?php echo $show_p_amount;?></td>
  <td width="15%" class="right"><?php echo $show_balance;?></td>
</tr>
 <tr id="details-<?php echo $p_ID;?>" style="display:none;" >
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
 
<table style="width:100%;" class="  table table-bordered table-condensed table-hover table-striped"  id="ledger-footer">
<tr>
<td   class="right" width="90%"><strong>Total : </strong></td><td class="right" > <strong>P <?php echo $d;?></strong> </td>
</tr>
<tr>
<td  class="right" width="90%"><strong>Total Payment :</strong></td><td class="right" > <strong>P <?php echo $c;?></strong></td>
</tr>
<tr>
<td   class="right" width="90%"><strong>Ending Balance : </strong></td><td class="right" ><strong>P <?php echo $b;?></strong></td> 
</tr>
</table>
 

  </div>








<style>
.right{
  text-align: right;
}
</style>