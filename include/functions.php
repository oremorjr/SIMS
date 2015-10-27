<?php


function date_status($date="", $ALID){

$dnow=date('Y-m-d');

if($dnow>=$date){
// mysql_query("UPDATE osd_account_ledger SET al_verified_payment=1 WHERE al_transID=$ALID ");
return " ";

}else{
  return "Post-dated";
// mysql_query("UPDATE osd_account_ledger SET al_verified_payment=0 WHERE al_transID=$ALID ");
}



}


 function current_user($val){
 
$pos=$_SESSION['SESS_POSITION'];
$pageid=pabs_query('p_pageid','osd_page','p_pageslug',$val);

$s=mysql_query("SELECT a_accessid from osd_access where a_pageid=$pageid and a_posid=$pos ");
$count_s=mysql_num_rows($s);
// echo $count_s;
if($count_s==1){
return true;
}

}



function current_ARID(){
  $empid=$_SESSION['SESS_MEMBER_UID'];
$last=mysql_query("SELECT al_transID  from osd_account_ledger where al_empid='$empid' and al_active=1");
while($lastrow=mysql_fetch_array($last)){
$tid=$lastrow['al_transID']; 
}  
return $tid;
}

function get_unique_id($ID, $digits){
$UID=md5($ID); 
return substr($UID,0,$digits) . substr($UID,-$digits);
}



function get_current_position(){

$pos=$_SESSION['SESS_POSITION'];
return $pos;

}

function get_employeee_id(){

$id=$_SESSION['SESS_MEMBER_UID'];
return $id;

}

// function current_user($slug1=''){

// $position1=$_SESSION['SESS_POSITION']; 

// $rows=osd_query("osd_access INNER JOIN osd_page ON (a_pageid=p_pageid) ",$where="a_posid='$position1' ORDER BY p_pagename ", $group='');
// foreach($rows as $row){

// $pageid=$row['a_pageid'];
// $pageslug=pabs_query('p_pageslug','osd_page','p_pageid', $pageid);
// $slugs[]=$pageslug;
// }

// foreach($slugs as $slug){

// if($slug==$slug1){
// return true;
// }

// }

// }


function computeDiscountLess($dp, $p, $qty){
$bp=$p*$qty;
$c=count($dp);

$sub=0;
for($i=0;$i<$c;$i++){
$disc=$dp[$i]/100;
if($i==0): $sub=$bp-($bp*$disc); endif; if($i>0): $sub=$sub-($sub*$disc); endif;
}
return $sub;    
}



function computeDiscountAdd($dp, $p, $qty){
$bp=$p*$qty;
$c=count($dp);

$sub=0;
for($i=0;$i<$c;$i++){
$disc=$dp[$i]/100;
if($i==0): $sub=$bp+($bp*$disc); endif; if($i>0): $sub=$sub+($sub*$disc); endif;
}
return $sub;    
}


function Discount($disc_rate, $disc_status){

  if($disc_status==0){ 
    if($disc_rate!=''): echo 'L '; endif;
    $discounts = explode(',', $disc_rate);  
    $last = end($discounts);
    $count=count($discounts);
    $index="";

    foreach($discounts as $discount){
     $index++;
    
     if($index != $count)   {
      echo $discount.'%, ';
     }else{
      if($discount!="")
       echo $last.'%';    
     }
      

    } 
   
  }




  if($disc_status==1){
  echo '+';
  $discounts = explode(',', $disc_rate);  
  $last = end($discounts);
  $count=count($discounts);
  $index="";
   
  foreach($discounts as $discount){
    $index++;
    if($index!=$count){
      echo $discount.'%, ';
    }else{
      if($discount!="")
      echo $last.'%';
    }
  } 
  ?>    
     
  <?php
  } 
}



function pabs_query($field,$table,$whereField, $column){
$cur=mysql_query("SELECT $field from $table where $whereField='$column' ") or die(mysql_error());
if($res=mysql_fetch_array($cur)):
return $res[$field];
endif;
}

function pabs_query_general($field,$table,$where){
$cur=mysql_query("SELECT $field from $table WHERE $where ") or die(mysql_error());
if($res=mysql_fetch_array($cur)):
return $res[$field];
endif;
}


function osd_query($table,$where='', $group=''){
if($where!=""){
$where='where '.$where;
}
if($group!=""){
$group='GROUP BY  '.$group;
}

$cur=mysql_query("SELECT * from $table $where $group") or die(mysql_error());
$rows=array();
while($res=mysql_fetch_array($cur)):
$rows[]=$res;
endwhile;

return $rows;

}



function sims_query($field, $table,$where='', $group=''){
if($where!=""){
$where='where '.$where;
}
if($group!=""){
$group='GROUP BY  '.$group;
}

$cur=mysql_query("SELECT $field from $table $where $group") or die(mysql_error());
$rows=array();
while($res=mysql_fetch_array($cur)):
$rows[]=$res;
endwhile;

return $rows;

}

function sims_query2($field, $table,$where='', $group='', $order=""){
if($where!=""){
$where='where '.$where;
}
if($group!=""){
$group='GROUP BY  '.$group;
}
if($order!=""){
$order='ORDER BY  '.$order;
}

$cur=mysql_query("SELECT $field from $table $where $group $order") or die(mysql_error());
$rows=array();
while($res=mysql_fetch_array($cur)):
$rows[]=$res;
endwhile;

return $rows;

}



// $rows=osd_query('osd_transaction',$where,$group);

// foreach($rows as $row){
// $a=$row['t_transaction_date'];
// }


function save_log($UID, $message, $category){
$dt=date('Y-m-d H:i:s');
$d=date('Y-m-d');

mysql_query("INSERT INTO osd_log (l_UID, l_message, l_category, l_date_time, l_date) VALUES ('$UID','$message','$category', '$dt', '$d') ");
}


function save_log_payment($UID, $message, $category, $TRID){
$dt=date('Y-m-d H:i:s');
$d=date('Y-m-d');

mysql_query("INSERT INTO osd_log (l_UID, l_message, l_category, l_date_time, l_date, l_ACID) VALUES ('$UID','$message','$category', '$dt', '$d', '$TRID') ");
}

function page_privelege($position){

if(isset($_GET['page'])){
$pageName = $_GET['page'];
}else{
 $pageName = 'index';
}


$userposition1=pabs_query('p_posname','osd_position','p_posid', $position);

$allowed=0;
$rows=osd_query('osd_access',$where="a_posid='$position'", $group='');
foreach($rows as $row){

$pageid=$row['a_pageid'];
$pagename=pabs_query('p_pagename','osd_page','p_pageid', $pageid);
$page_slug=pabs_query('p_pageslug','osd_page','p_pageid', $pageid);

// echo $page_slug.'<br>';

if($page_slug==$pageName){
 
$allowed+=1;
} 

} 
 return $allowed;

 

}

 


function count_sims_query($count, $field,$table){
$cur=mysql_query("SELECT $count as $field from $table") or die(mysql_error());
if($res=mysql_fetch_array($cur)):
return $res[$field];
endif;
}

function count_sims_query2($count, $field,$table,$whereField, $column){
$cur=mysql_query("SELECT $count as $field from $table where $whereField='$column' ") or die(mysql_error());
if($res=mysql_fetch_array($cur)):
return $res[$field];
endif;
}
function count_sims_query_general($count, $field,$table,$where){
$cur=mysql_query("SELECT $count as $field from $table where $where ") or die(mysql_error());
if($res=mysql_fetch_array($cur)):
return $res[$field];
endif;
}









function customer_balance($CID, $TID){
$t_b_amount=0;
$MODE=get_mode($TID);

if($MODE==1){
$f="t_customer_id";
}elseif($MODE==2){
$f="t_supplier_id";
}

$amount=pabs_query_general('t_amount_t', 'osd_transaction',"TID='$TID' and $f=$CID and t_mode=$MODE ");

$balances=osd_query('osd_account_ledger',"al_receipt_ID=$TID and al_status=1 and al_trash=0 ", $group='');

foreach($balances as $balance){

$b_amount=$balance['al_amount'];
$t_b_amount+=$b_amount;

}
$total_balance=round($amount-$t_b_amount,2);

return $total_balance;
}


function payment_percentage($CID, $TID, $MODE){
$t_b_amount=0;

if($MODE==1){
$f="t_customer_id";
}elseif($MODE==2){
$f="t_supplier_id";
}


$amount=pabs_query_general('t_amount_t', 'osd_transaction',"TID='$TID' and $f=$CID  ");

$balances=osd_query('osd_account_ledger',"al_receipt_ID=$TID and al_status=1 and al_trash=0 and al_mode=$MODE ", $group='');

foreach($balances as $balance){

$b_amount=$balance['al_amount'];
$t_b_amount+=$b_amount;
}
$total_balance=round($amount-$t_b_amount,2);
 
if($total_balance==0){
$rate=100;
}else{
$rate=100-round($total_balance/$amount*100,2);
}

return $rate;
}


function customer_balance2($CID, $TID, $MODE){
$t_b_amount=0;

if($MODE==1){
$f="t_customer_id";
}elseif($MODE==2){
$f="t_supplier_id";
}


$amount=pabs_query_general('t_amount_t', 'osd_transaction',"TID='$TID' and $f=$CID and t_mode=$MODE ");

$balances=osd_query('osd_account_ledger',"al_receipt_ID=$TID and al_trash=0 ", $group='');

foreach($balances as $balance){

$b_amount=$balance['al_amount'];
$t_b_amount+=$b_amount;

}
$total_balance=round($amount-$t_b_amount,2);

return $total_balance;
}





function customer_payment($CID, $TID){
$t_b_amount=0;

$MODE=get_mode($TID);

if($MODE==1){
$f="t_customer_id";
}elseif($MODE==2){
$f="t_supplier_id";
}


$amount=pabs_query_general('t_amount_t', 'osd_transaction',"TID='$TID' and $f=$CID and t_mode=$MODE ");

$balances=osd_query('osd_account_ledger',"al_receipt_ID=$TID and al_status=1 and al_trash=0 ", $group='');

foreach($balances as $balance){

$b_amount=$balance['al_amount'];
$t_b_amount+=$b_amount;

}
 
return $t_b_amount;
}


function receipt_total($TID){
$amount=pabs_query_general('t_amount_t', 'osd_transaction',"TID='$TID'  ");
return $amount;
}

function lock_status($TID, $MODE){
$status=pabs_query_general('al_locked', 'osd_account_ledger',"al_receipt_ID=$TID AND al_mode=$MODE");
return $status;
}

function transaction_lock_status($TID){
$status=pabs_query_general('t_locked', 'osd_transaction',"TID=$TID");
return $status;
}

function customer($field, $ID){
$row=pabs_query_general($field, 'osd_customer',"CID=$ID");
return $row;
}

function employee_name($EMPID){
$fname=pabs_query_general('fname', 'osd_users',"UID=$EMPID");
$lname=pabs_query_general('lname', 'osd_users',"UID=$EMPID");
echo $fname.' '.$lname;
}

function get_employee_name($EMPID){
$fname=pabs_query_general('fname', 'osd_users',"UID=$EMPID");
$lname=pabs_query_general('lname', 'osd_users',"UID=$EMPID");
return $fname.' '.$lname;
}


function customer_name($CID){
$fname=pabs_query_general('c_firstname', 'osd_customer',"CID=$CID");
echo $fname;
}


function update_stocks($uid, $qty){
  $update_stock=mysql_query("UPDATE osd_unit_item SET ui_stocks=$qty WHERE UIID=$uid");
}




function get_stocks($uid1, $pid){

$t_qty=0;

$sql7=mysql_query("SELECT PUID, ui_stocks from osd_product_unit 
INNER JOIN osd_supply_remarks ON (sr_no=pu_remarks) 
INNER JOIN osd_unit_item ON (pu_unit_id=UIID)
INNER JOIN osd_product ON (PID=pu_product_code)  
where pu_unit_id='$uid1' and PID='$pid' and ui_status=1 and pu_status=1 order by PUID ASC  ");
while($r7=mysql_fetch_array($sql7)){ 

$puiid_r=$r7['PUID'];
$qt=mysql_query("SELECT pu_qty, pu_remarks from osd_product_unit where PUID=$puiid_r and pu_status=1 ");

while($qt1=mysql_fetch_array($qt)){
$r=$qt1['pu_remarks'];

if($r==1){
$operand[]=1;
$o[]='+';
}elseif ($r==2) {
$operand[]=2;
$o[]='+';
}elseif ($r==3) {
$operand[]=3;
$o[]='+';
}elseif ($r==4) {
$operand[]=4;
$o[]='-';
}elseif ($r==5) {
$operand[]=5;
$o[]='-';
}elseif ($r==6) {
$operand[]=6;
$o[]='-';
}elseif ($r==7) {
$operand[]=7;
$o[]='-';
}elseif ($r==8) {
$operand[]=8;
$o[]='+';
}elseif ($r==9) {
$operand[]=9;
$o[]='-';
}




$qty_arr[]=$qt1['pu_qty'];
}

$stocks_arr[]=$r7['PUID'];
$stocks_t=$r7['ui_stocks'];


}

$count_arr=count($stocks_arr);

 

// echo '<br>';
for($i=0;$i<$count_arr;$i++):


 
  $op=$operand[$i];

  if($op==1){
  $t_qty=$t_qty+$qty_arr[$i];
  }elseif ($op==2) {
  $t_qty=$t_qty+$qty_arr[$i];
  }elseif ($op==3) {
  $t_qty=$t_qty+$qty_arr[$i];
  }elseif ($op==4) {
  $t_qty=$t_qty-$qty_arr[$i];
  }elseif ($op==5) {
  $t_qty=$t_qty-$qty_arr[$i];
  }elseif ($op==6) {
  $t_qty=$t_qty-$qty_arr[$i];
  }elseif ($op==7) {
  $t_qty=$t_qty-$qty_arr[$i];
  }elseif ($op==8) {
  $t_qty=$t_qty+$qty_arr[$i];
  }elseif ($op==9) {
  $t_qty=$t_qty-$qty_arr[$i];
  }
  
  
  
 
 
$current_stocks[]=$t_qty; 

// echo $qty_arr[$i].' '.$t_qty.'<br>';

endfor;  

$index=count($current_stocks);

return $current_stocks[$index-1];
}








function system_version(){
 
  echo pabs_query_general('s_ver','osd_setting',"SID=1");
}

function currency(){
  echo pabs_query_general('s_currency','osd_setting',"SID=1");
}

function receipt_no($TID){
$mode=get_mode($TID);
  echo pabs_query_general('t_receiptno','osd_transaction',"TID=$TID and t_mode=$mode");
}
function get_receipt_no($TID){
  $mode=get_mode($TID);
  return pabs_query_general('t_receiptno','osd_transaction',"TID=$TID and t_mode=$mode");
}


function custom_cart($TID){
 
$tdid=get_receipt_no($TID);
$td_mode=get_mode($TID);
 

$cart2=cart_total_mode($tdid, 1, $td_mode);

if($cart2>0):
?>
<tr>
<td colspan="10" class="t-center">-- Returns --</td>
</tr>
<?php
endif;

$rows=osd_query("osd_transaction_details", "td_transaction_id='$tdid' and td_mode=$td_mode and td_return=1", $group="");
$custom_total=0;

?>

<?php
foreach($rows as $row){
$c_itemname=$row['td_pcode'];  
$pname=product('p_name', $c_itemname);
$pname=product('p_brand', $c_itemname).' '.$pname;
$c_cost=$row['td_price'];  
$c_qty=$row['td_qty']; 
$disc=$row['td_disc']; 
$disc_l=$row['td_disc_l'];
$c_total=$row['td_total']; 
$c_unit=$row['td_unit_id']; 
$UID=unit_item('ui_uid', $c_unit);
$uname=unit('u_symbol', $UID);
$custom_total+=$c_total;
?>
<tr>
<td><?php echo $pname;?></td>
<td class="right"><?php echo $c_cost;?></td>
<td><?php echo $c_qty.' '.$uname;?></td>
<td>

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

<td class="right"><?php
$show_sub=number_format($c_total, 2, '.', ',');
 echo $show_sub;?></td>


</tr>
<?php

}
}

function custom_cart_total($TID){
$rows=osd_query("osd_custom_transaction_details", "ctd_TID=$TID", $group="");
$custom_total=0;
foreach($rows as $row){
 
$c_total=$row['ctd_total']; 
 
$custom_total+=$c_total;
}
return $custom_total;
}

function cart_total($TID){

 

$rows=osd_query("osd_transaction_details", "td_transaction_id=$TID  ", $group="");
$cart_total=0;
foreach($rows as $row){
 
$c_total=$row['td_total']; 
 
$cart_total+=$c_total;
}
return $cart_total;
}






function custom_cart_print($TID){






$tdid=get_receipt_no($TID);
$td_mode=get_mode($TID);

$cart2=cart_total_mode($tdid, 1, $td_mode);

if($cart2>0):
?>
<tr>
<td colspan="10" class="t-center return">-- Returns --</td>
</tr>
<?php
endif;


$rows=osd_query("osd_transaction_details", "td_transaction_id='$tdid' and td_mode=$td_mode and td_return=1", $group="");
$custom_total=0;

?>

<?php
foreach($rows as $row){
$c_itemname=$row['td_pcode'];  
$pname=product('p_name', $c_itemname);
$pname=product('p_brand', $c_itemname).' '.$pname;
$c_cost=$row['td_price'];  
$c_qty=$row['td_qty']; 
$disc=$row['td_disc']; 
$disc_l=$row['td_disc_l'];
$c_total=$row['td_total']; 
$c_unit=$row['td_unit_id']; 
$UID=unit_item('ui_uid', $c_unit);
$uname=unit('u_symbol', $UID);
$custom_total+=$c_total;
?>

<tr>
<td width="10" valign="top" class="right item"  ><?php echo $c_qty;?></td>
<td width="50" valign="top" class="t-center item"><?php echo $uname;?></td>
<td width="550" valign="top" class="left item"><?php echo $pname;?>


    <span  class="discount"> 
  <?php
  if(!empty($c_disc_l)){ 
  $discounts = explode(',', $c_disc_l); 
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
  if(!empty($c_disc)){ 
  $discounts = explode(',', $c_disc); 
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

 
<td width="100"   valign="top" class="right item"><?php echo $c_cost;?> </td>
<td class="right"><?php
$show_sub=number_format($c_total, 2, '.', ',');
 echo $show_sub;?></td>
</tr>


<?php

}

 
}




function payment_status($ALID){

$payment_verified=pabs_query("al_verified_payment", "osd_account_ledger","al_transID",$ALID);

if($payment_verified==0){
echo '<img src="../images/payment-pending.png" width="15"   title="Payment Pending">';
}elseif($payment_verified==1){
echo '<img src="../images/payment-completed.png" width="15"  title="Payment Complete">';
}


}




function update_cheque(){


$dnow=date('Y-m-d');

 


$c=mysql_query("SELECT al_trans_type, al_chequeno, al_unique_transID, al_verified_payment, al_transID from osd_account_ledger WHERE al_trans_Date<='$dnow'  and al_verified_payment=0 ") or die(mysql_error());
while($row=mysql_fetch_array($c)){

$type=$row['al_trans_type'];
$pstatus=$row['al_verified_payment'];

$typename=pabs_query_general("tt_name", "osd_transaction_type", "tt_id=$type");

 

 if($pstatus==0){

 $al_chequeno=$row['al_chequeno'];
$al_unique_transID=$row['al_unique_transID'];


$transID=$row['al_transID']; 
mysql_query("UPDATE osd_account_ledger SET al_verified_payment='1' WHERE al_transID='$transID' ");

$UID=1;
$message="Transaction ".$al_unique_transID." with  Check #".$al_chequeno." has been updated as Dated-cheque";
$category="Payment";
save_log($UID, $message, $category);


 }

}


 // mysql_query("UPDATE osd_account_ledger SET al_verified_payment=0 WHERE al_trans_Date>$dnow  ");
mysql_query("DELETE FROM osd_log  WHERE l_date>'$dnow' and l_category='Payment' ");


}




function customer_tid($TID){

$CID=pabs_query_general('t_customer_id', 'osd_transaction',"TID=$TID");
 return $CID;

}

function get_customer_tid_bytransid($transID, $mode){

$CID=pabs_query_general('t_customer_id', 'osd_transaction',"t_receiptno='$transID' AND t_mode=$mode");
 return $CID;

}

function get_supplier_tid_bytransid($transID, $mode){

$CID=pabs_query_general('t_supplier_id', 'osd_transaction',"t_receiptno='$transID' AND t_mode=$mode");
 return $CID;

}

function get_tid_by_receipt_no($receipt_no, $mode){

$TID=pabs_query_general('TID', 'osd_transaction',"t_receiptno='$receipt_no' AND t_mode=$mode");
 return $TID;

}



 
 
function get_customer_name($CID){
$fname=pabs_query_general('c_firstname', 'osd_customer',"CID=$CID");
return $fname;
}

function get_agent_name($AID){
$fname=pabs_query_general('a_firstname', 'osd_agent',"a_agentID=$AID");
$lname=pabs_query_general('a_lastname', 'osd_agent',"a_agentID=$AID");
return $fname.' '.$lname;
}

function get_supplier_name($SID){
$fname=pabs_query_general('sup_name', 'osd_supplier',"SID=$SID");
return $fname;
}

function get_unit_name($PID){
$UID=pabs_query_general('ui_uid', 'osd_unit_item',"ui_pid=$PID and ui_status=1 ");
$uname=pabs_query_general('u_name', 'osd_unit',"UID='$UID' ");
return $uname;

}

function get_price($PID){
$UIID=pabs_query_general('UIID', 'osd_unit_item',"ui_pid=$PID and ui_status=1 ");
$disc_rate=pabs_query_general('ui_disc_rate', 'osd_unit_item',"UIID='$UIID' ");
$disc_status=pabs_query_general('disc_status', 'osd_unit_item',"UIID='$UIID' ");

if(empty($disc_rate)){
$p=pabs_query_general('ui_selling_price', 'osd_unit_item',"UIID='$UIID' ");
}else{
$p=pabs_query_general('ui_base_price', 'osd_unit_item',"UIID='$UIID' ");  
}

return $p;

}

function get_disc_rate($PID){
$UIID=pabs_query_general('UIID', 'osd_unit_item',"ui_pid=$PID and ui_status=1 ");
$disc_rate=pabs_query_general('ui_disc_rate', 'osd_unit_item',"UIID='$UIID' ");
return $disc_rate;

}

function get_disc_status($PID){
$UIID=pabs_query_general('UIID', 'osd_unit_item',"ui_pid=$PID and ui_status=1 ");
$status=pabs_query_general('disc_status', 'osd_unit_item',"UIID='$UIID' ");
return $status;

}

function current_tid(){
$empid=get_employeee_id();
$last=mysql_query("SELECT TID, t_receiptno  from osd_transaction where t_empid='$empid' and t_active=1 and t_mode=1");
while($lastrow=mysql_fetch_array($last)){
$tid=$lastrow['TID']; 
}  
return $tid;
}



function update_DB(){
echo '<pre>';
$al_mode=mysql_query("SELECT al_mode from osd_account_ledger");
if(!$al_mode){
mysql_query("ALTER TABLE `osd_account_ledger` ADD `al_mode` TINYINT(1) NOT NULL");
echo 'Successful';
}else{
echo 'Update OSD123014-001 has been installed.';
}


echo '</pre>';


}


function supplier($field, $ID){
$row=pabs_query_general($field, 'osd_supplier',"SID=$ID");
return $row;
}



function get_mode($TID){
$row=pabs_query_general('t_mode', 'osd_transaction',"TID=$TID");
return $row;
}


function cart_total_mode($TID, $TYPE, $mode){


$rows=osd_query("osd_transaction_details", "td_transaction_id='$TID' and td_return=$TYPE and td_mode=$mode ", $group="");
$cart_total=0;
foreach($rows as $row){
 
$c_total=$row['td_total']; 
 
$cart_total+=$c_total;
}
return $cart_total;
}



function product($field, $ID){
$row=pabs_query_general($field, 'osd_product',"PID=$ID");
return $row;
}

function unit_item($field, $ID){
$row=pabs_query_general($field, 'osd_unit_item',"UIID=$ID");
return $row;
}

function unit($field, $ID){
$row=pabs_query_general($field, 'osd_unit',"UID=$ID");
return $row;
}

 
function transaction($field, $ID){
$row=pabs_query_general($field, 'osd_transaction',"TID=$ID");
return $row;
}

function employee($field, $ID){
$row=pabs_query_general($field, 'osd_users',"UID=$ID");
return $row;
}


function get_current_stocks($UIID){
$row=pabs_query_general('ui_stocks', 'osd_unit_item',"UIID=$UIID");
return $row;
}

function setting($field, $ID){
$row=pabs_query_general($field, 'osd_setting',"SID=$ID");
return $row;
}


function edit_sales_receipt($t_id, $CID){

echo '<span class="none">';

$lock=transaction_lock_status($t_id);

if($lock==1  ){

 if(current_user('edit-receipt')){ 

echo '<a target="_blank" href="?page=edit-pos&ID='.$CID.'&TID='.$t_id.'"><img src="../images/snk-lock.png" width="13" class="right snk-lock"></a>';
}else{
  echo '  <img src="../images/snk-lock.png" width="13" class="right snk-unlock">';
}

}



if($lock==0){

 if(current_user('edit-receipt')){ 
echo '<a target="_blank" href="?page=edit-pos&ID='.$CID.'&TID='.$t_id.'"><img src="../images/snk-unlock.png" width="13" class="right snk-unlock"></a>';
}else{
echo ' <img src="../images/snk-unlock.png" width="13" class="right snk-unlock">';
}


} 


echo '</span>';
 

}



function edit_po_receipt($t_id, $CID){

$lock=transaction_lock_status($t_id);

if($lock==1  ){

 if(current_user('edit-receivings')){ 

echo '<a target="_blank" href="?page=edit-pos-receivings&ID='.$CID.'&TID='.$t_id.'"><img src="../images/snk-lock.png" width="13" class="right snk-lock"></a>';
}else{
  echo '  <img src="../images/snk-lock.png" width="13" class="right snk-unlock">';
}

}



if($lock==0){

 if(current_user('edit-receivings')){ 
echo '<a target="_blank" href="?page=edit-pos-receivings&ID='.$CID.'&TID='.$t_id.'"><img src="../images/snk-unlock.png" width="13" class="right snk-unlock"></a>';
}else{
echo ' <img src="../images/snk-unlock.png" width="13" class="right snk-unlock">';
}


} 
 

}






function customer_options($t_id, $CID){

?>
<span class="none">


  <?php
if(current_user('view-customer-account')):
  ?>
  <a href="?page=account-list&CID=<?php echo $CID?>&TID=<?php echo $t_id;?>" class="manageledgerbtn btn btn-primary" title="View Customer Account"><i class="glyphicon glyphicon-user"></i></a> 
 <?php endif; ?>


   <?php
if(current_user('add-payment')):
$mode=get_mode($t_id);
$lock_status=lock_status($t_id, $mode);
if($lock_status==0){
  ?>
  <a href="?page=account-receivable&CID=<?php echo $CID?>&TID=<?php echo $t_id;?>" class="manageledgerbtn btn btn-success" title="Add Payment"><i class="glyphicon glyphicon-plus"></i></a> 
 <?php
}else{
?>
  <a href="?page=account-receivable&CID=<?php echo $CID?>&TID=<?php echo $t_id;?>" class="manageledgerbtn btn btn-danger" title="Add Payment"><i class="glyphicon glyphicon-lock"></i></a> 
<?php
}
  endif; ?>

 <?php
if(current_user('view-customer-ledger')):
 ?>
  <a href="?page=account-ledger&CID=<?php echo $CID?>&TID=<?php echo $t_id;?>" class="manageledgerbtn btn btn-primary" title="Ledger"><i class="glyphicon glyphicon-th-list"></i></a>
<?php endif;?>
  
</span>
<?php


}



function supplier_options($t_id, $CID){

?>
<span class="none">

  <?php
if(current_user('view-supplier-account')):
  ?>
  <a href="?page=supplier-account-list&SID=<?php echo $CID?>&TID=<?php echo $t_id;?>" class="manageledgerbtn btn btn-primary" title="View Supplier Account"><i class="glyphicon glyphicon-user"></i></a> 
 <?php endif; ?>
  <?php




if(current_user('add-payment-supplier')):
$mode=get_mode($t_id);
$lock_status=lock_status($t_id, $mode);  
if($lock_status==0){
  ?>
  <a href="?page=account-receivable&CID=<?php echo $CID?>&TID=<?php echo $t_id;?>" class="manageledgerbtn btn btn-success" title="Add Payment"><i class="glyphicon glyphicon-plus"></i></a> 
 <?php
}else{
  ?>
  <a href="?page=account-receivable&CID=<?php echo $CID?>&TID=<?php echo $t_id;?>" class="manageledgerbtn btn btn-danger" title="Add Payment"><i class="glyphicon glyphicon-lock"></i></a> 

  <?php
}
  endif; ?>

 <?php
if(current_user('view-supplier-ledger')):
 ?>
  <a href="?page=account-ledger&CID=<?php echo $CID?>&TID=<?php echo $t_id;?>" class="manageledgerbtn btn btn-primary" title="Ledger"><i class="glyphicon glyphicon-th-list"></i></a>
<?php endif;?>
  
</span>
<?php


}


 
?>