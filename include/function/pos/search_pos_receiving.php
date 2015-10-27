<?php
require('../../db_config.php');
$db=new DB();
 

?>

<?php
 $query=mysql_query("SELECT p_pcode,PID, p_name, p_brand  from osd_unit_item 
INNER JOIN osd_product ON (PID=ui_pid)
INNER JOIN osd_unit ON (UID=ui_uid) group by ui_pid order by p_name
"); ?> 
<select autofocus="autofocus"   name="pcode" data-placeholder="Choose an item..."  id="code" class="    "   tabindex="4">
<option value="" selected="selected"> </option>
<?php
 while($row=mysql_fetch_array($query)){ ?>
<option value="<?php  echo $row['PID']; ?>" >
<div><?php  echo $row['p_brand']; ?> <?php  echo $row['p_name'] ?> <?php  echo $row['p_pcode']; ?></div>
</option>	
<?php
 } ?>
</select>
 <script src="../js/selectize.js"></script>   
<link rel="stylesheet" href="../home/assets/css/selectize.css"> 
<script>
$('#code').selectize({});
</script>