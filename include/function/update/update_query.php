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

		case 'clear-log':
		$days=$_REQUEST['days'];
		$status="";
		
		$count=mysql_query("SELECT COUNT(l_logid) AS c FROM osd_log WHERE TIMESTAMPDIFF(DAY,l_date_time,NOW())>='$days' ");
		if($c1=mysql_fetch_array($count)){
		$count_row=$c1['c'];
		$status.='Deleting '.$count_row.' data...<br>';
		}
		$del=mysql_query("DELETE  FROM osd_log WHERE TIMESTAMPDIFF(DAY,l_date_time,NOW())>='$days' ");
		
		$status.='Process Completed<br>';
		echo $status;
		
		break;
		
	}
 
 
?>