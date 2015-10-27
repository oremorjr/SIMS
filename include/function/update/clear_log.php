<?php
require('../../db_config.php');
$connect=new DB();
$mode=$_GET['page'];
	$dt=date('Y-m-d H:i:s');
	switch ($mode){

		case 'setting':
		$cname=$_REQUEST['cname'];
		$address=$_REQUEST['address'];
		$tagline=$_REQUEST['tagline'];
		$tel=$_REQUEST['tel'];
		$cp=$_REQUEST['cp'];
		$tin=$_REQUEST['tin'];
		$version=$_REQUEST['version'];
		$curr=$_REQUEST['curr'];
		$setting=mysql_query("UPDATE osd_setting SET company_name='$cname', s_address='$address', s_tagline='$tagline', s_contact_no='$tel', st_cp_no='$cp', s_TIN='$tin', s_ver='$version', s_currency='$curr' WHERE SID=1 ");
		break;
		
	}
 
 
?>