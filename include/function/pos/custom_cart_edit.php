<?php
require('../../db_config.php');
$connect=new DB();
$empid=get_employeee_id();
 $mode=1;
$TID=$_REQUEST['tid'];

$last=mysql_query("SELECT TID  from osd_transaction where TID=$TID and t_mode=1");
while($lastrow=mysql_fetch_array($last)){
$tid=$lastrow['TID'];
}


?>
 
 

<div class="result_custom_edit">


</div>
 <table class="table table-bordered table-condensed table-hover table-striped" id="CC">
<thead>
<tr>
<th width="30%" colspan="2">Description</th>
<th>Cost</th>
<th>Qty.</th>
<th>Unit</th>
<th>Disc (+)%</th>
<th>Disc (L)%</th>
<th>Total</th>
</tr>
</thead>
<tbody class="custom-table">


<?php
$rows=osd_query('osd_custom_transaction_details',"ctd_TID=$TID", $group="");
foreach($rows as $row){

$ctd_ID=$row['ctd_transID'];
$desc=$row['ctd_item_name'];
$cost=$row['ctd_price'];
$qty=$row['ctd_qty'];
$disc=$row['ctd_disc'];
$disc_l=$row['ctd_disc_l'];
$total=$row['ctd_total'];
$unit=$row['ctd_unit'];

if(empty($disc_l)){$disc_l=0;}
if(empty($disc)){$disc=0;}

?>
 <tr class="txtCustom"  id="custom-<?php echo $ctd_ID;?>">
 <td width="2%"><a href="#CC" id="<?php echo $ctd_ID;?>" class="remove-custom" ><i class="glyphicon glyphicon-remove-circle"></i></a></td>
 <td width="30%"><input type="text" class="form-control  " id="desc-<?php echo $ctd_ID;?>"  value="<?php echo $desc;?>" data-id="<?php echo $ctd_ID;?>" ></td>
 <td><input type="text" class="    form-control" id="cost-<?php echo $ctd_ID;?>" value="<?php echo $cost;?>" data-id="<?php echo $ctd_ID;?>"></td>
 <td><input type="text" class="    form-control" id="qty-<?php echo $ctd_ID;?>" value="<?php echo $qty;?>" data-id="<?php echo $ctd_ID;?>"  ></td>
 <td><input type="text" class="    form-control" id="unit-<?php echo $ctd_ID;?>" value="<?php echo $unit;?>" data-id="<?php echo $ctd_ID;?>"  ></td>
 <td><input type="text" class="  form-control" id="disc-<?php echo $ctd_ID;?>"  value="<?php echo $disc;?>" data-id="<?php echo $ctd_ID;?>"></td>
 <td><input type="text" class="form-control  " id="disc_l-<?php echo $ctd_ID;?>" value="<?php echo $disc_l;?>" data-id="<?php echo $ctd_ID;?>"></td>
 <td><span  id="total-<?php echo $ctd_ID;?>" class="custom_total"><?php echo $total;?></span></td>
 
</tr> 

 
<?php

}
?>
</tbody>
<tr>
<td colspan="20" class="right">Total : <span id="ct_value"></span></td>
</tr>

 </table>

 