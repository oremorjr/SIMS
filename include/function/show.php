<?php
require('../db_config.php');
$connect=new DB();
$v1=$_REQUEST['unit_id'];
$query1=mysql_query("SELECT * from osd_product_unit where PUID='$v1' ");
while($q1=mysql_fetch_array($query1)){

?>
<input type="text"  value="<?php echo $q1['pu_price'];?>" placeholder="Price" class="form-control" disabled>
<?php
}
?>