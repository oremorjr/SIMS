<?php
require('../db_config.php');
$connect=new DB();

$positionid=$_REQUEST['positionid'];
$page=$_REQUEST['page'];


$check=mysql_query("SELECT a_accessid from osd_access where a_pageid='$page' and a_posid='$positionid'  ");
$count=mysql_num_rows($check);

if($count==0){
mysql_query("INSERT INTO osd_access (a_pageid,a_posid ) VALUES ('$page','$positionid') ");
}else{
mysql_query("DELETE FROM osd_access where a_pageid='$page' and a_posid='$positionid' ");	
}

// echo $count;

?>
