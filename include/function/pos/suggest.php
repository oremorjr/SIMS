<?php
require('../../db_config.php');
$db=new DB();
$q = strtolower($_GET["q"]);
if (!$q) return;

$sql = "select DISTINCT pu_product_code as p_code, p_name from osd_product_unit INNER JOIN osd_product ON (p_pcode=pu_product_code) where pu_product_code LIKE '%$q%' OR p_name LIKE '%$q%'";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$cname = $rs['p_code'];
	$pname = $rs['p_name'];
	?>
	 <?php echo $cname;?> 
 
	<?php
}

?>
