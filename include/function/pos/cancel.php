<?php
require('../../db_config.php');
$connect=new DB();

	$pcode=$_REQUEST['pcode'];
	$tno=$_REQUEST['tno'];
	$uid=$_REQUEST['unit_id'];
	
	$pos=mysql_query("INSERT INTO osd_transaction_details (td_transaction_id, td_pcode, td_unit_id) VALUES ('$tno','$pcode','$uid') ");
 
     if($query){
        echo "Your item has been sent";
     }
     else{
        echo "Error in sending your comment";
     }
 
?>