<?php
require('../../db_config.php');
$db=new DB();
 
if($_REQUEST['id'])
{
$EDIT=0;
$id=mysql_escape_string($_REQUEST['id']);
if(isset($_REQUEST['edit'])){
$EDIT=$_REQUEST['edit'];
} 
$check=mysql_query("SELECT * from osd_transaction_details 
INNER JOIN osd_unit_item ON (td_unit_id=UIID) 
INNER JOIN osd_product_unit ON (UIID=pu_unit_id)  
 where TDID='$id'
");
$empid=get_employeee_id();
$price=floatval($_REQUEST['price']); 
$qty=mysql_escape_string($_REQUEST['lastname']);
while($crow=mysql_fetch_array($check)){
	// $raw=$crow['pu_raw_price'];
	$raw=$crow['ui_supplier_price'];
	$selling=$crow['ui_selling_price'];
	$base=$crow['ui_base_price'];
	$disc_rate=$crow['ui_disc_rate'];
	$disc_status=$crow['disc_status'];
	$unit_id=$crow['td_unit_id'];
	$pu_logID=$crow['td_pu_logID'];
	$pcode=$crow['td_pcode'];

	$tr_mode=$crow['td_return'];

	$wholesale=$qty*$raw;
	$supplier=$qty*$selling;



	// $profit=$price-$wholesale;
}

$sub=0;
// $sub=mysql_escape_string($_REQUEST['sub_total']);
$tno=mysql_escape_string($_REQUEST['tno']);
$disc=mysql_escape_string($_REQUEST['disc']);
$disc_l=mysql_escape_string($_REQUEST['disc_l']);
$td_total=mysql_escape_string($_REQUEST['td_total']);
$mode_cart=mysql_escape_string($_REQUEST['mode_cart']);
$profit=0;


 
 if($mode_cart==1){
$sql = "UPDATE osd_transaction_details set td_qty='$qty',td_price='$price', td_disc='$disc',td_disc_l='$disc_l', td_profit='$profit', td_total='$td_total' where TDID='$id'";
mysql_query($sql);
mysql_query("UPDATE osd_transaction set t_sub_total='$sub', t_edit_mode=1, t_edited_by=$empid where t_receiptno='$tno' and t_mode=$mode_cart ");
mysql_query("UPDATE osd_product_unit SET pu_qty=$qty, pu_stocks=$qty  where PUID='$pu_logID' ");
 
 if($EDIT==1){
$latest_stock=get_stocks($unit_id, $pcode);
update_stocks($unit_id, $latest_stock);
 }


 
 }elseif ($mode_cart==2) {

 
$sql = "UPDATE osd_transaction_details set td_qty='$qty',td_price='$price', td_disc='$disc',td_disc_l='$disc_l', td_profit='0.00', td_total='$td_total' where TDID='$id'";
mysql_query($sql);
mysql_query("UPDATE osd_transaction set t_sub_total='$sub',  t_edit_mode=1, t_edited_by=$empid where t_receiptno='$tno' and t_mode=$mode_cart ");
mysql_query("UPDATE osd_product_unit SET pu_qty=$qty, pu_stocks=$qty  where PUID='$pu_logID' ");

if($EDIT==1){

$latest_stock=get_stocks($unit_id, $pcode);
update_stocks($unit_id, $latest_stock);


}



 }elseif($mode_cart==3){
 $reason=mysql_escape_string($_REQUEST['reason']);
$sql = "UPDATE osd_transaction_details set td_qty='$qty',td_price='$price', td_disc='$disc',td_disc_l='$disc_l', td_profit='0', td_total='$td_total', return_reason='$reason' where TDID='$id'";
mysql_query($sql);
mysql_query("UPDATE osd_transaction set t_sub_total='$sub' where t_receiptno=$tno ");
mysql_query("UPDATE osd_product_unit SET pu_qty=$qty, pu_stocks=$qty  where PUID='$pu_logID' ");

 }



}
?>