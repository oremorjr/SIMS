<?php
require('../db_config.php');
$connect=new DB(); 
$UID=get_employeee_id();
$string=$_REQUEST['string'];
$ID=$_REQUEST['ID'];
?>
<ul class="items-list">
<?php
 
 $query=mysql_query("SELECT * from  osd_product   WHERE p_name LIKE '%$string%'
"); ?> 
 
<?php
 while($row=mysql_fetch_array($query)){ ?>
<li value="<?php  echo $row['PID']; ?>" data-id="<?php echo $ID;?>" ><?php  echo $row['p_brand']; ?> <?php  echo $row['p_name'] ?> <?php  echo $row['p_pcode']; ?></li>	
<?php
 } ?>
 </ul>

 