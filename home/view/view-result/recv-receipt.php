<?php 
include('../../../include/class_lib.php');
$class=new unit();
 
$tid=$_REQUEST['TID']; 
$TRID=$_GET['TID'];
$mode=get_mode($tid);

//RECEIPT
$receipt=new receipt();
$query="SELECT * from osd_transaction INNER JOIN osd_users ON (UID=t_empid) where TID=$tid";
$receipt->select($query);
$tdate=$receipt->tdate;
$show_date=date('Y-m-d h:i A', strtotime($tdate));
//company info
$company=new company();
$query="SELECT * from osd_setting";
$company->select($query);
$cid=$receipt->supplier;
$cname="";
$address="";
$customer=mysql_query("SELECT * from osd_supplier where SID=$cid ");
if($c1=mysql_fetch_array($customer)){
  $cname=$c1['sup_name'];
  $address=$c1['sup_address1'];
}
 
$void_status=transaction('t_void', $tid);

?> 
 <div id="receipt-form">
<table border="0" width="100%" cellspacing="0" cellpadding="0">
 
 
  <tr>
    <td class="center" colspan="10">
    <div class="greeting bold t-center f-20"><?php echo $cname;?> </div>
    <div class="greeting t-center"><?php echo $address;?></div> 
 
    <div class="greeting ptop1 t-center">DELIVERY RECEIPT</div>
    </td>
  </tr>
  <tr>
    <td height="15"  colspan="10"></td>
  </tr>
 
  
  <tr> 
    <td colspan="10">
    <table border="0" width="100%">
      <tr>
        <td class="info left-2" width="6%">SOLD TO</td>
        <td width="50%"class="b-line info ">&nbsp;<?php echo $company->name; ?></td>
        <td width="6%" class=" info right-2 ">DNO.</td>
        <td width="20%" class="b-line info">&nbsp;<strong><?php echo $receipt->tno;?> / <?php echo $receipt->t_rno;?></strong></td>
      </tr>
      <tr>
        <td class="info left-2">ADDRESS</td>
        <td class="info b-line">&nbsp;<?php echo $company->address;?></td>
        <td class="info right-2">DATE</td>
        <td class="b-line info">&nbsp;<?php echo $show_date?></td>        
      </tr>     
    </table>
    </td> 
 
 
  </tr> 
 
  <tr>
  <td colspan="10" class="b-line-2"><br></td>
  </tr>
  <tr>
 
    <td class="bold b-line-3 p-1">
    <div class="desc"> QTY.</div>
    </td>
    <td class=" bold b-line-3 p-1">
    <div class="desc"> UNIT</div>
    </td> 
    <td class=" bold b-line-3 p-1">
    <div class="desc"> DESCRIPTION</div>
    </td> 
    <td class=" bold b-line-3 p-1">
    <div class="desc"> UNIT PRICE</div>
    </td>     
    <td class="bold b-line-3 p-2">
     <div class="last-desc">AMOUNT</div>
    </td>
 
  </tr>
 
  <?php 
  $query1=mysql_query("SELECT * from osd_transaction_details
  INNER JOIN osd_transaction ON (t_receiptno=td_transaction_id)
  INNER JOIN osd_product ON (td_pcode=PID)
  INNER JOIN osd_unit_item ON (td_unit_id=UIID)
  INNER JOIN osd_unit ON (ui_uid=UID)
  where TID='$tid'  and  t_active=0 and td_mode=$mode and td_return=0 ");
  
  $subtotal=0;
  $i=0;
  while($row=mysql_fetch_array($query1)){
    $i++;
    $tno=$row['t_receiptno'];
    $itemno=$row['p_pcode'];
    $desc=$row['p_name'];
    $price=$row['td_price'];
    $selling_price=$row['ui_selling_price'];
    $qty=$row['td_qty'];
    $cash=$row['t_amount_t'];   
    $payment=$row['t_payment'];   
    $change=$row['t_change']; 
    $unit_name=$row['u_symbol'];
    $disc=$row['td_disc'];
    $disc=$row['td_disc'];
    $disc_l=$row['td_disc_l'];    
    $brand=$row['p_brand'];   
    $td_total=$row['td_total'];   
    

    if($disc!=0){
      $amount=($selling_price*$qty) - ($selling_price*$qty * $disc/100);
    }else{
      $amount=$selling_price*$qty;
    }
    
    
    $show_change=number_format($change, 2, '.', ',');   
    $show_price=number_format($price, 2, '.', ',');   
    
    $show_cash=number_format($cash, 2, '.', ',');   
    $show_p=number_format($payment, 2, '.', ',');   
    
     
     
    $show_amount=number_format($amount, 2, '.', ',');   
    $subtotal=$subtotal+$td_total;
    $custom_total=custom_cart_total($tid);
    $grandtotal=$subtotal+$custom_total;
    $show_grandtotal=number_format($grandtotal, 2, '.', ','); 
    $show_subtotal=number_format($grandtotal, 2, '.', ','); 
    $show_selling_price=number_format($selling_price, 2, '.', ',');
    $show_td_total=number_format($td_total, 2, '.', ',');   


  
  ?>
  <tr>
    <td width="10%" valign="top" class="right item"  >
    <?php echo $qty;?>  
    </td>
    <td width="10%" valign="top" class="t-center item">
     <?php echo $unit_name;?> 
    </td>   
    <td width="50%" valign="top" class="left item">
     <?php echo $brand.' '.$itemno;?> <?php echo $desc;?>
     
    <span  class="discount"> 
  <?php
  if($disc_l!=0.00){ 
  $discounts = explode(',', $disc_l); 
  $last = end($discounts);
  echo 'L ';
  foreach($discounts as $discount){
    
    if($last!=$discount){
      echo $discount.'%, ';
    }else{
      echo $last.'%';
    }
  } 
  ?>    
     
  <?php
  }
  ?>  
  
  <?php
  if($disc!=0.00){ 
  $discounts = explode(',', $disc); 
  $last = end($discounts);
  echo '+ ';
  foreach($discounts as $discount){
    
    if($last!=$discount){
      echo $discount.'%, ';
    }else{
      echo $last.'%';
    }
  } 
  ?>    
     
  <?php
  }
  ?>
  </span>   
    </td>
    <td width="15%"   valign="top" class="right item">
    <div><?php echo  $price;?></div>
    
    </td> 
    <td width="15%" valign="top" class="right item-last">
    <div><?php echo $show_td_total;?></div>
    </td>     
  </tr>
 

  <?php
  }
  ?>

  <?php
$cart1=cart_total_mode($receipt->tno, 0, $mode);
$cart2=cart_total_mode($receipt->tno, 1, $mode);
$t=$cart1-$cart2;
$gt=number_format($t, 2, '.', ',');



custom_cart_print($tid);
?>


  <tr>
  <td  colspan="4" class="total-view">TOTAL  P</td>
  <td class="total-value "><?php echo $gt;?></td>
  </tr>
 
  
      </table>
  
      <br>



  <?php

  $c_agent=pabs_query('t_agent', 'osd_transaction','TID',$TRID);
  $agent_fname=pabs_query('a_firstname', 'osd_agent','a_agentID',$c_agent);
  $agent_lname=pabs_query('a_lastname', 'osd_agent','a_agentID',$c_agent);

  $dID=pabs_query('t_driver', 'osd_transaction','TID',$TRID);
  $d_fname=pabs_query('d_firstname', 'osd_driver','d_driverID',$dID);
  $d_lname=pabs_query('d_lastname', 'osd_driver','d_driverID',$dID);

  $c_ID=pabs_query('t_checker', 'osd_transaction','TID',$TRID);
  $c_fname=pabs_query('c_firstname', 'osd_checker','c_checkerID',$c_ID);
  $c_lname=pabs_query('c_lastname', 'osd_checker','c_checkerID',$c_ID);

  $t_ID=pabs_query('t_truck', 'osd_transaction','TID',$TRID);
  $t_name=pabs_query('t_truckNo', 'osd_truck','t_truckID',$t_ID); 
  ?>

  <table border="0" width="50%" id="footer-table" style="float:left;display:none">
    <tr>
      <td style="width:13%;">Agent: </td><td style="width:100%;border-bottom:1px solid #000;padding-left:10px;"><?php echo $agent_fname.' '.$agent_lname;?></td>
      <td>&nbsp;</td><td>&nbsp;</td>
    </tr>
      <tr>
      <td style="width:13%;">Driver: </td><td style="width:100%;border-bottom:1px solid #000;padding-left:10px;"><?php echo $d_lname.' '.$d_lname;?></td>
      <td>&nbsp;</td><td>&nbsp;</td>
    </tr>    
      <tr>
      <td style="width:13%;">Truck: </td><td style="width:100%;border-bottom:1px solid #000;padding-left:10px;"><?php echo $t_name;?></td>
      <td>&nbsp;</td><td>&nbsp;</td>
    </tr>          
        <tr>
      <td style="width:13%;">Checker: </td><td style="width:100%;border-bottom:1px solid #000;padding-left:10px;"><?php echo $c_fname.' '.$c_lname;?></td>
      <td>&nbsp;</td><td>&nbsp;</td>
    </tr>         
  </table>
  <table border="0" width="50%" id=" " style="float:right;">
     
    <tr>
       
      <td style="width:5%;text-align:right;">By: </td><td style="width:100%;border-bottom:1px solid #000;text-align:center;">&nbsp;</td>
    </tr>
      <tr>
       
      <td>&nbsp;</td><td style="text-align:center;"><div>Signature of Customer</div><div>SALES INVOICE TO FOLLOW</div></td>
    </tr> 
          
  </table>
   <?php
if($void_status==1):
  ?>
 
   <table border="0" width="100%" id=" " style="float:left;margin-top:10px;border-top:1px dashed;margin-top:20px; ">
 <tr>
  <td style="padding-top:10px;">
Status : <strong>Void</strong>
  </td>
</tr>
    <tr>
       <td style="width:100%;border-bottom:1px solid #000;text-align:left;">
        <?php echo transaction('void_reason', $tid);?>
       </td>
    </tr>
  </table>

<?php
endif;
?>

 
</div>
