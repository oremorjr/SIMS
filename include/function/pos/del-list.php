<?php
require('../../db_config.php');
$db=new DB();
 
if($_POST['id'])
{
$id=mysql_escape_String($_POST['id']);
mysql_query("UPDATE osd_unit_item SET ui_status=0 WHERE UIID=$id");

}
?>