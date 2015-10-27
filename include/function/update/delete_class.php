<?php
require('../../db_config.php');
$connect=new DB();
$mode=$_REQUEST['page']; 
$empid=$_REQUEST['empid'];
$UID=get_employeee_id();
	$dt=date('Y-m-d H:i:s');

	$pwd=md5($_REQUEST['pwd']);
	$check=mysql_query("SELECT * from osd_users where UID=$empid and pwd='$pwd' ");
	$count=mysql_num_rows($check);
	// echo $count;
	if($count==1){	

	switch ($mode){

		case 'customer':
		$id=$_REQUEST['ID'];
		$tb="osd_customer";
		$f="CID";
		$del=mysql_query("DELETE FROM $tb where $f=$id");
		if($del){
		echo '<span class="result" data-value="1"></span>';
		}
		break;		
		
		case 'category':
		$id=$_REQUEST['ID'];
 		$tb="osd_category";
		$f="CID";
		$del=mysql_query("DELETE FROM $tb where $f=$id");
		if($del){
		echo '<span class="result" data-value="1"></span>';
		}
		break;	

		case 'bank':
		$id=$_REQUEST['ID'];
 		$tb="osd_bank";
		$f="b_bankID";
		$del=mysql_query("DELETE FROM $tb where $f=$id");
		if($del){
		echo '<span class="result" data-value="1"></span>';
		}
		break;	



		case 'position':
		$id=$_REQUEST['ID'];
 		$tb="osd_position";
		$f="p_posid";


		$name=pabs_query_general("p_posname","osd_position", "p_posid=$id");
		$message="Deleted ".$name;
		$category="User Group";
		save_log($UID, $message, $category);


		$del=mysql_query("DELETE FROM $tb where $f=$id");
		if($del){
		echo '<span class="result" data-value="1"></span>';

		}
		break;	



		case 'transaction-type':
		$id=$_REQUEST['ID'];
 		$tb="osd_transaction_type";
		$f="tt_ID";
		$del=mysql_query("DELETE FROM $tb where $f=$id");
		if($del){
		echo '<span class="result" data-value="1"></span>';
		}
		break;	

		case 'checker':
		$id=$_REQUEST['ID'];
 		$tb="osd_checker";
		$f="c_checkerID";
		$del=mysql_query("DELETE FROM $tb where $f=$id");
		if($del){
		echo '<span class="result" data-value="1"></span>';
		}
		break;	

		case 'driver':
		$id=$_REQUEST['ID'];
 		$tb="osd_driver";
		$f="d_driverID";
		$del=mysql_query("DELETE FROM $tb where $f=$id");
		if($del){
		echo '<span class="result" data-value="1"></span>';
		}
		break;	

		case 'agent':
		$id=$_REQUEST['ID'];
 		$tb="osd_agent";
		$f="a_agentID";
		$del=mysql_query("DELETE FROM $tb where $f=$id");
		if($del){
		echo '<span class="result" data-value="1"></span>';
		}
		break;	


		case 'user':
		$id=$_REQUEST['ID'];
 		$tb="osd_users";
		$f="UID";
		$status=pabs_query('u_status','osd_users','UID',$id);
		if($status==1){
		$s=0;
		}else{
		$s=1;	
		}
		
		$del=mysql_query("UPDATE osd_users SET u_status=$s where $f=$id");
		if($del){
		echo '<span class="result" data-value="1"></span>';
		}
		break;	


		case 'truck':
		$id=$_REQUEST['ID'];
 		$tb="osd_truck";
		$f="t_truckID";
		$del=mysql_query("DELETE FROM $tb where $f=$id");
		if($del){
		echo '<span class="result" data-value="1"></span>';
		}
		break;	


		case 'supplier':
		$id=$_REQUEST['ID'];
 		$tb="osd_supplier";
		$f="SID";
		$del=mysql_query("DELETE FROM $tb where $f=$id");
		if($del){ echo '<span class="result" data-value="1"></span>'; }
		break;	

		case 'unit':
		$id=$_REQUEST['ID'];
		$tb="osd_unit";
		$f="UID";
		$del=mysql_query("DELETE FROM $tb where $f=$id");
		$del2=mysql_query("DELETE FROM osd_unit_item where ui_uid=$id and ui_status=0");
		if($del){ echo '<span class="result" data-value="1"></span>';}
		break;		
		
		case 'item':
		$id=$_REQUEST['ID'];
		$tb="osd_product";
		$f="PID";
		$del=mysql_query("DELETE FROM $tb where $f=$id");
		if($del){echo '<span class="result" data-value="1">666</span>';}
		break;		
		
		
	}


		}else{
		echo '<span class="result" data-value="404"></span>';
		}
  
 
 
 
?>