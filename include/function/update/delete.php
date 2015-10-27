<?php
require('../../db_config.php');
$connect=new DB();
$mode=$_REQUEST['page']; 
$empid=$_REQUEST['empid'];
	$dt=date('Y-m-d H:i:s');

	$pwd=$_REQUEST['f1'];
	$check=mysql_query("SELECT * from osd_users where UID=$empid and pwd='$pwd' ");
	$count=mysql_num_rows($check);
	if($count==1){	

	switch ($mode){

		case 'customer':
		$id=$_REQUEST['ID'];
		$tb="osd_customer";
		$f="CID";
		$del=mysql_query("DELETE FROM $tb where $f=$id");
		if($del){$return['res']=1;}
		break;		
		
		case 'category':
		$id=$_REQUEST['ID'];
 		$tb="osd_category";
		$f="CID";
		$del=mysql_query("DELETE FROM $tb where $f=$id");
		if($del){$return['res']=1;}
		break;	

		case 'supplier':
		$id=$_REQUEST['ID'];
 		$tb="osd_supplier";
		$f="SID";
		$del=mysql_query("DELETE FROM $tb where $f=$id");
		if($del){$return['res']=1;}
		break;	

		case 'unit':
		$id=$_REQUEST['ID'];
		$tb="osd_unit";
		$f="UID";
		$del=mysql_query("DELETE FROM $tb where $f=$id");
		$del2=mysql_query("DELETE FROM osd_unit_item where ui_uid=$id and ui_status=0");
		if($del){$return['res']=1;}
		break;		
		
		case 'item':
		$id=$_REQUEST['ID'];
		$tb="osd_product";
		$f="PID";
		$del=mysql_query("DELETE FROM $tb where $f=$id");
		if($del){$return['res']=1;}
		break;		
		
		
	}


		}else{
			$return['res']=404;	
		}
  
 
echo json_encode($return);
 
 
?>