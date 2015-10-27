<?php
require('../../db_config.php');
$db=new DB();
 
if($_REQUEST['id'])
{
$id=$_REQUEST['id'];
$edit=$_REQUEST['edit_status'];

if($edit==1){
$status=($_REQUEST['status']);
$sql = mysql_query("UPDATE osd_unit_item set disc_status=$status where UIID='$id'");

}else{

$price=($_REQUEST['price']);
$reorder=($_REQUEST['reorder']);
$sup_price=($_REQUEST['sup_price']);
$base_price=($_REQUEST['base_price']);
$disc_rate=($_REQUEST['disc_rate']);
$status=($_REQUEST['status']);


$sql = mysql_query("update osd_unit_item set ui_selling_price='$price', ui_reorder_level='$reorder', ui_supplier_price='$sup_price', ui_base_price='$base_price', ui_disc_rate='$disc_rate', disc_status=$status where UIID='$id'");

 }
 
}
?>