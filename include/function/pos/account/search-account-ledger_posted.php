<?php
require('../../../db_config.php');
$connect=new DB();
$str=$_REQUEST['RNO'];
 
$limit="";
if(empty($str)):
$limit="LIMIT 5";
endif;
?>

<div class="panel-body" style="padding:10px;">

 <table class="dataTable table table-bordered table-condensed table-hover table-striped posted">
 <thead>	
 <tr>
  <td><strong>Payment Applied to</strong></td> 
  <td><strong>Payment Date</strong></td> 
 <td  ><strong>Transaction No.</strong></td>
  <td><strong>Customer</strong></td>  

 

 <td><strong>Payment Info</strong></td> 
 <td  class="right"><strong>Amount</strong></td>  
 <td><strong>Status</strong></td>
 
 </tr>
</thead>
<tbody>
 <?php

$count_payments=count_sims_query_general('COUNT(al_transID)','s','osd_account_ledger',"al_status=1 and al_locked=0 ");

$payments=mysql_query("SELECT * from osd_account_ledger INNER JOIN osd_customer ON (CID=al_customer_ID) where  (al_chequeno LIKE '%$str%' OR al_unique_transID LIKE '%$str%' OR c_firstname LIKE '%$str%'  OR al_receipt_no LIKE '%$str%') and al_status=1 and al_trash=0 and al_mode=1    ORDER BY al_transID $limit  ");

$j=-1; 
while($row=mysql_fetch_array($payments)){
$j++;

$p_ID=$row['al_transID'];
$TID=$row['al_transID'];
$TRID=$row['al_receipt_ID'];
$p_rno=$row['al_receipt_no'];
$CID=$row['al_customer_ID'];
$p_transdate=$row['al_trans_date'];
$p_payment_date=$row['al_transaction_date'];

$p_desc=$row['al_payment_description'];
$p_checque=$row['al_chequeno'];
$p_type=$row['al_trans_type'];
$typename=pabs_query('tt_name','osd_transaction_type','tt_ID',$p_type);

$p_bank=$row['al_bank'];
$bankname=pabs_query('b_bankName','osd_bank','b_bankID',$p_bank);


$p_ref_no=strtoupper($row['al_unique_transID']);
$show_p_transdate=date('F d, Y', strtotime($p_transdate));
$show_tp_transdate=date('F d, Y', strtotime($p_payment_date));

$p_amount=$row['al_amount'];
$show_p_amount=number_format($p_amount, 2, '.', ','); 


$total_amount=receipt_total($TRID);
$payment_date=date('Y-m-d', strtotime($p_transdate));
 
$receipt_no=get_receipt_no($TRID);
 ?>
 
 <tr>
   <td width="10%">  <a href="#" class="show_receipt"  data-toggle="modal" data-target="#myModal"   id="<?php echo $TRID;?>"><?php echo $receipt_no;?></a></td>
   <td width="20%"><?php echo $show_tp_transdate;?></td>
  <td width="15%"> <?php echo $p_ref_no;?> </td>
    <td width="20%"><?php customer_name($CID);?></td>



  <td width="15%">

    <div><?php if($typename=='Cheque') :  echo date_status($payment_date,$p_ID ); endif ;?> <?php echo $typename; ?></div>
    <div>Date: <?php echo $show_p_transdate;?></div>
    <div><?php if(!empty($p_checque)): echo 'Cheque No.: '; endif; echo $p_checque;?></div>
  </td>

 
  <td width="15%" class="right"><?php echo $show_p_amount;?></td>  
  <td width="5%" ><span class="align-center"><?php payment_status($p_ID);?></span></td>
</tr>
 
<?php
}
?>

 
</tbody>
 </table>
 
 

  </div>






  
<script src="assets/lib/datatables/DT_bootstrap.js"></script>
  