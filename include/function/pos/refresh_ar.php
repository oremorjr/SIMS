<?php
require('../../db_config.php');
$db=new DB(); 
$empid=$_REQUEST['empid'];
$TID=$_REQUEST['TID'];
$CID=$_REQUEST['CID'];
 $uniq=sha1(md5(time()));

$y=date('Y');
$m=date('m');
// $unique_transaction_code=strtoupper(uniqid());

$rno=mysql_query("SELECT  al_transID  from osd_account_ledger" );
while($rno1=mysql_fetch_array($rno)){
	$unique_transaction_code=strtoupper(get_unique_id($rno1['al_transID']+1, 6));
}

// $checkno=mysql_query("SELECT *  from osd_account_ledger where al_empid='$empid' and al_active=1 ");

// $count=mysql_num_rows($checkno);
// if($count==0){
// 	// $rno=mysql_query("SELECT COUNT(al_transID) as transID from osd_account_ledger where al_month=$m and al_year=$y and al_trash=0" );
// 	// while($rno1=mysql_fetch_array($rno)){
// 	// 	$rid=$rno1['transID']+1;
// 	// }
// 	while($rno2=mysql_fetch_array($checkno)){
// 	$rid=$rno2['al_transID']+1;  
// 	}
	
// 	$tno2=str_pad($rid, 5, "0", STR_PAD_LEFT);
	
// 	$tno=$y.'-'.$m.'-'.$tno2;

// 	$query=mysql_query("INSERT INTO osd_account_ledger (al_month,al_year, al_empid) values ('$m','$y','$empid') ");	
// 	$tid=mysql_insert_id();
// }else{
// 	while($rno1=mysql_fetch_array($checkno)){

 
// 	$tno=$rno1['al_receipt_no'];
	 

// 	$current_tid=$rno1['al_transID'];  

// 	}
// }


?>
<input type="hidden" id="RNO" value="<?php echo $tno;?>">
<input type="hidden" id="CTID" value="<?php echo $unique_transaction_code;?>">  
 <span id="temp_no" data-tno="<?php echo $unique_transaction_code;?>"><?php echo $unique_transaction_code;?></span> 
 
