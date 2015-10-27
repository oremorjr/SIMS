<?php
require('../../db_config.php');
$connect=new DB();
$mode=$_GET['page'];
	$dt=date('Y-m-d H:i:s');
		$tblname='osd_customer';
		$id=$_REQUEST['ID'];
		$f1=$_REQUEST['f2'];
		$query=mysql_query("UPDATE $tblname SET c_lastname='vcvcvx' where CID=9  ");
			 if($query){
				echo "Your item has been sent";
			 }
			 else{
				echo "Error in sending your comment";
			 }	
 

 
?>