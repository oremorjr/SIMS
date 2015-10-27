<?php
require('../../db_config.php');
$db=new DB();
 
if($_POST['TID'])
{
$id=mysql_escape_string($_REQUEST['TID']);
$amount=($_REQUEST['amount']);
$amount_t = number_format($amount, 2, '.', '');
$cid = $_REQUEST['cid'];
mysql_query("update osd_transaction set t_payment=$amount_t, t_customer_id=$cid where TID=$id ");
}
?>