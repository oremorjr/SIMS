<?php
require('../../db_config.php');
$db=new DB();
 
if($_GET['id'])
{
$id=$_GET['id'];
$PUID=$_GET['PUID'];
$del=$_GET['del'];
$TID=$_GET['TID'];

 $sql = "delete from osd_transaction_details where TDID='$id'";
 mysql_query( $sql);

if($del==1){
$unit_id=pabs_query('pu_unit_id','osd_product_unit','PUID',$PUID);
$UIID=pabs_query('pu_unit_id','osd_product_unit','PUID',$PUID);
$pcode=pabs_query('pu_product_code','osd_product_unit','PUID',$PUID);
$qty=pabs_query('pu_qty','osd_product_unit','PUID',$PUID);


$mode=get_mode($TID);

if($mode==1):
$TR_MODE=$_REQUEST['TR_MODE'];

if($TR_MODE==0){
$c=get_current_stocks($unit_id)+$qty;

}elseif($TR_MODE==1){
$c=get_current_stocks($unit_id)-$qty;
}
mysql_query("UPDATE osd_unit_item SET ui_stocks='$c' WHERE UIID=$unit_id ");

endif;





if($mode==2):
$TR_MODE=$_REQUEST['TR_MODE'];

if($TR_MODE==0){
$c=get_current_stocks($unit_id)-$qty;

}elseif($TR_MODE==1){
$c=get_current_stocks($unit_id)+$qty;
}
mysql_query("UPDATE osd_unit_item SET ui_stocks='$c' WHERE UIID=$unit_id ");

endif;






 

}

 mysql_query("DELETE from osd_product_unit WHERE PUID=$PUID ");



}

?>