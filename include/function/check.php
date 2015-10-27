<?php
require('../db_config.php');
$connect=new DB();
 
		$v1 =$_REQUEST['sup_name'];
		if (isset($v1)) {
			
			$check_for_username = mysql_query("SELECT sup_name FROM osd_supplier WHERE sup_name='$v1'");
			$c=mysql_num_rows($check_for_username);
			if ($c==1) {
				echo "false";
			} else {
				echo "true";//No Record Found - Username is available
			}
		}  
		exit;


 
 
 


?>