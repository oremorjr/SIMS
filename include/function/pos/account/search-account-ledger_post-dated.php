<?php
require('../../../db_config.php');
$connect=new DB();
$str=$_REQUEST['RNO'];
$mode=$_REQUEST['MODE'];
 
$limit="";
if(empty($str)):
$limit="";
endif;

 
?>


  <div class="panel-body" style="padding:10px;">

 
 

 <table id="d1" class="dataTable table table-bordered table-condensed table-hover table-striped posted">
 <thead>	
 <tr>
    <th><strong>Payment Applied to</strong></th> 
  <th><strong>Payment Date</strong></th> 
 <th  ><strong>Transaction No.</strong></th>
  <th><strong>Customer</strong></th>  

 
<!-- 
 <th><strong>Payment Type</strong></th>  -->
 <th><strong>Cheque No.</strong></th> 
 <th><strong>Cheque Date</strong></th> 
 <th><strong>Bank</strong></th> 
 <th  class="right"><strong>Amount</strong></th>   
 
 </tr>
</thead>
<tbody>
 <?php

$count_payments=count_sims_query_general('COUNT(al_transID)','s','osd_account_ledger',"al_status=1 and al_locked=0 ");

$payments=mysql_query("SELECT * from osd_account_ledger INNER JOIN osd_customer ON (CID=al_customer_ID) where  (al_chequeno LIKE '%$str%' OR al_unique_transID LIKE '%$str%' OR c_firstname LIKE '%$str%' OR al_receipt_no LIKE '%$str%' ) and al_status=1 and al_trash=0 and al_verified_payment=0 and al_mode=$mode  ORDER BY al_transID $limit  ");

$j=-1; 
$t=0;
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

$t+=$p_amount;

$total_amount=receipt_total($TID);
$payment_date=date('Y-m-d', strtotime($p_transdate));
 
$receipt_no=get_receipt_no($TRID);
 ?>
 
 <tr>
   <td width="10%">  <a href="#" class="show_receipt"  data-toggle="modal" data-target="#myModal"   id="<?php echo $TRID;?>"><?php echo $receipt_no;?></a></td>
   <td width="15%"><?php echo $show_tp_transdate;?></td>
  <td width="15%"> <?php echo $p_ref_no;?> </td>
    <td width="20%"><a href="?page=account-list&CID=<?php echo $CID;?>"><?php customer_name($CID);?></a></td>



<!--   <td width="15%">

    <div><?php if($typename=='Cheque') :  echo date_status($payment_date,$p_ID ); endif ;?> <?php echo $typename; ?></div>
 
  </td> -->

 
  <td width="20%"  ><?php echo $p_checque;?></td>  
  <td width="15%"  ><?php echo $show_p_transdate;?></td>  
  <td width="15%"  ><?php echo $bankname;?></td>  
  <td width="15%" class="right"><?php echo $show_p_amount;?></td>   
</tr>
 
<?php
}
?>

 
</tbody>
 </table>
 
<?php
$show_gtotal=number_format($t, 2, '.', ','); 
?>


<?php if(current_user('view-total-post-dated-cheques')):?>
      <div class=" total-sales">
    <table id="" class="gtotal" width="100%">
    <tr>
      <td class=" ">Total : <strong>P <?php echo $show_gtotal;?></strong></td>  
    </tr>
     
    </table>
    </div> 
    <?php endif;?>    

  </div>






  
<script>
$(document).ready(function(){

$('#d1').dataTable({

        "bDeferRender": true  
  
});
 
});

</script>
  