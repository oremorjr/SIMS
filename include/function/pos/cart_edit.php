<?php
require('../../db_config.php');
$connect=new DB();
$empid=get_employeee_id();
 $mode=$_REQUEST['mode'];
$tid=$_REQUEST['tid'];

$last=mysql_query("SELECT TID, t_receiptno  from osd_transaction where t_empid='$empid' and TID=$tid and t_mode=$mode");
while($lastrow=mysql_fetch_array($last)){
$tid=$lastrow['TID'];
$TDID=$lastrow['t_receiptno'];
}

 
?>

<div class="cart-label">Sales <span class="cart1-count cart-count"></span></div>
<input type="hidden" id="mode_cart" value="<?php echo $mode;?>">
 <table class="table table-bordered table-condensed table-hover table-striped">
<tr>
<td width="30%" colspan="2" class="bold">Item Name</td>
<td class="bold">Cost</td>
<td class="bold">Qty.</td>
<td  class="bold">Disc (+)%</td>
<td  class="bold">Disc (L)%</td>
<td class="bold">Total</td>
</tr>
<?php
function plural($amount, $singular = '', $plural = 's' ) {
    if ( $amount <= 1 )
        return $singular;
    else
        return $plural;
}	

$query1=mysql_query("SELECT 

	TDID,p_name, td_pcode, p_pcode, p_brand, ui_stocks, u_symbol, td_qty,td_pu_logID, ui_reorder_level, td_price, ui_reorder_level, td_disc, td_disc_l, td_total, ui_disc_rate, disc_status, ui_supplier_price, ui_base_price, ui_selling_price, td_return

  from osd_transaction_details
INNER JOIN osd_transaction ON (t_receiptno=td_transaction_id)
INNER JOIN osd_product ON (td_pcode=PID)
INNER JOIN osd_unit_item ON (td_unit_id=UIID)
INNER JOIN osd_unit ON (ui_uid=UID)
where  td_mode=$mode and TID=$tid and td_return=0    order by TDID  ");
$s=0;


$count_rec=mysql_num_rows($query1);
 
if($count_rec!=0){
while($q1=mysql_fetch_array($query1)){
$id=$q1['TDID'];
$p_name=$q1['p_name'];
$p_brand=$q1['p_brand'];
$p_code=$q1['td_pcode'];
$product_code=$q1['p_pcode'];
 $base=$q1['ui_base_price'];
$stock=$q1['ui_stocks'];
$p_unit=$q1['u_symbol'];
$qty=$q1['td_qty'];
$order_level=$q1['ui_reorder_level'];
$raw=$q1['ui_supplier_price'];
$p_price=$q1['td_price'];
$td_total=$q1['td_total'];
$td_trmode=$q1['td_return'];
$reorder_level=$q1['ui_reorder_level'];
$pu_logid=$q1['td_pu_logID'];
$show=0;
if($stock<=$qty){
	$show=1;
}
$show_td_total=number_format($td_total, 2, '.', ',');	

 
	$status='';
 

//$p_price=number_format($p_price, 2, '.', ',');

$disc=$q1['td_disc'];
$disc_l=$q1['td_disc_l'];
$disc_status=$q1['disc_status'];
$disc_rate=$q1['ui_disc_rate'];
if($disc==0): $disc='0.00'; endif;
if($disc_l==0):$disc_l='0.00';endif;
?>

<tr id="<?php echo $id; ?>" class="record txtMult edit_tr">
<td width="1%" align="center" ><a href="#" id="<?php echo $id; ?>" data-value="<?php echo $qty; ?>" class="delbutton" data-tid="<?php echo $tid;?>"  data-empid="<?php echo get_employeee_id();?>" data-mode="<?php echo $mode;?>"   data-log="<?php echo $pu_logid;?>" data-trmode="<?php echo $td_trmode;?>"><i class="glyphicon glyphicon-remove-circle"></i></a></td>
<td width="100" class="edit_td">
<div><span  class="p_name" ><?php echo $p_brand.' '.$p_name; ?> </span></div>
<div style="font-size:11px;"><span id="first_<?php echo $id; ?>" data-label="<?php echo $product_code; ?>" ><?php echo $product_code;?></span></div>
 

 
</td>
<?php if($base!='0.00'):
$p_price=$q1['ui_base_price'];
?>
<td width="100"  >
 <?php echo $p_price; ?> 
<input type="hidden" value="<?php echo $p_price; ?>"  class="val1 editbox positive" id="price_input_<?php echo $id; ?>" <?php echo $status;?>/>
</td>
<?php else:
if($p_price=='0.00'){
$p_price=$q1['ui_selling_price'];
}
?>
<td width="100" class="edit_td">
<span id="price_<?php echo $id; ?>"  class="text"><?php echo $p_price; ?></span>
<input type="text" value="<?php echo $p_price; ?>"  class="val1 editbox positive inline" id="price_input_<?php echo $id; ?>" <?php echo $status;?>/>
</td>
<?php endif;?>
 
<td width="100" class="edit_td">
<span id="last_<?php echo $id; ?>" class="text"><?php echo $qty; ?></span><span> <?php echo $p_unit;?></span>
<input type="text" value="<?php echo $qty; ?>"  class="val2 editbox integer inline-half" data-stock="<?php echo $stock;?>" id="last_input_<?php echo $id; ?>" <?php echo $status;?>/>
<input type="hidden" value=""  class="item_total" id="total_input_<?php echo $id; ?>"  />
 
</td>

<td width="100" class="edit_td">
<span id="disc_<?php echo $id; ?>" class="text"><?php echo $disc; ?></span>
<input type="text" data-mask="99%" value="<?php echo $disc;?>"  class=" val3 editbox" id="disc_input_<?php echo $id; ?>" <?php echo $status;?>/>
 <input type="hidden" value="<?php echo $order_level;?>" id="level" class="val4" /> 
</td>

<td width="100" class="edit_td">
<span id="disc_l_<?php echo $id; ?>" class="text"><?php echo $disc_l; ?></span>
<input type="text" data-mask="99%" value="<?php echo $disc_l;?>"  class=" val5 editbox" id="disc_input_l_<?php echo $id; ?>" <?php echo $status;?>/>
 
</td>

<td width="100"><span class="strike"><div class="less" ></div></span> ₱<span  class="multTotal"><?php echo $show_td_total;?></span>
<input type="hidden" id="td_total_<?php echo $id; ?>" class="gtotal_value cart_sales" value="<?php echo $td_total;?>">
</td>
</tr>

<?php
}
 
}else{
?>
 
<tr  >
<td colspan="10" align="center" height="20">There are no items in your cart</td>
</tr>
<?php
}
?>
</table>

<script>
var c1_label="<?php echo plural($count_rec);?>";
var c1_count="<?php echo $count_rec;?>";

$(".cart1-count").html('Total Item'+c1_label+' ('+c1_count+')');
</script>
 



 






































 


<?php



 

$last1=mysql_query("SELECT TID, t_receiptno  from osd_transaction where t_empid='$empid' and TID=$tid and t_mode=$mode");
while($lastrow1=mysql_fetch_array($last1)){
$tid=$lastrow1['TID'];
$TDID=$lastrow1['t_receiptno'];
}


?>
<div class="cart-label">Returns <span class="cart2-count cart-count"></span></div>

 <table class="table table-bordered table-condensed table-hover table-striped">
<tr>
<td width="30%" colspan="2" class="bold">Item Name</td>
<td class="bold">Cost</td>
<td class="bold">Qty.</td>
<td  class="bold">Disc (+)%</td>
<td  class="bold">Disc (L)%</td>
<td class="bold">Total</td>
</tr>
<?php
 

$query1=mysql_query("SELECT TDID,p_name, td_pcode, p_pcode, ui_stocks, u_symbol, td_qty,td_pu_logID, ui_reorder_level, td_price, ui_reorder_level, td_disc, td_disc_l, td_total, ui_disc_rate, disc_status, ui_supplier_price, ui_base_price, ui_selling_price, p_brand

  from osd_transaction_details
INNER JOIN osd_transaction ON (t_receiptno=td_transaction_id)
INNER JOIN osd_product ON (td_pcode=PID)
INNER JOIN osd_unit_item ON (td_unit_id=UIID)
INNER JOIN osd_unit ON (ui_uid=UID)
where  td_mode=$mode and TID=$tid and td_return=1   order by TDID  ");
$s=0;
$count_rec1=mysql_num_rows($query1);

 

if($count_rec1!=0){
while($q1=mysql_fetch_array($query1)){
$id=$q1['TDID'];
$p_name=$q1['p_name'];
$p_brand=$q1['p_brand'];
$p_code=$q1['td_pcode'];
$product_code=$q1['p_pcode'];
 $base=$q1['ui_base_price'];
$stock=$q1['ui_stocks'];
$p_unit=$q1['u_symbol'];
$qty=$q1['td_qty'];
$order_level=$q1['ui_reorder_level'];
$raw=$q1['ui_supplier_price'];
$p_price=$q1['td_price'];
$td_total=$q1['td_total'];
$reorder_level=$q1['ui_reorder_level'];
$pu_logid=$q1['td_pu_logID'];
$show=0;
if($stock<=$qty){
	$show=1;
}
$show_td_total=number_format($td_total, 2, '.', ',');	

 
	$status='';
 

//$p_price=number_format($p_price, 2, '.', ',');

$disc=$q1['td_disc'];
$disc_l=$q1['td_disc_l'];
$disc_status=$q1['disc_status'];
$disc_rate=$q1['ui_disc_rate'];
if($disc==0): $disc='0.00'; endif;
if($disc_l==0):$disc_l='0.00';endif;
?>

<tr id="<?php echo $id; ?>" class="record txtMult edit_tr">
<td width="1%" align="center" ><a href="#" id="<?php echo $id; ?>" data-value="<?php echo $qty; ?>" class="delbutton" data-trmode="1"  data-tid="<?php echo $tid;?>"  data-empid="<?php echo get_employeee_id();?>" data-mode="<?php echo $mode;?>" data-log="<?php echo $pu_logid;?>"><i class="glyphicon glyphicon-remove-circle"></i></a></td>
<td width="100" class="edit_td">
<div><span  class="p_name" ><?php echo $p_brand.' '.$p_name; ?> </span></div>
<div style="font-size:11px;"><span id="first_<?php echo $id; ?>" data-label="<?php echo $product_code; ?>" ><?php echo $product_code;?></span></div>
 

 
</td>
<?php if($base!='0.00'):
$p_price=$q1['ui_base_price'];
?>
<td width="100"  >
 <?php echo $p_price; ?> 
<input type="hidden" value="<?php echo $p_price; ?>"  class="val1 editbox positive" id="price_input_<?php echo $id; ?>" <?php echo $status;?>/>
</td>
<?php else:
if($p_price=='0.00'){
$p_price=$q1['ui_selling_price'];
}
?>
<td width="100" class="edit_td">
<span id="price_<?php echo $id; ?>"  class="text"><?php echo $p_price; ?></span>
<input type="text" value="<?php echo $p_price; ?>"  class="val1 editbox positive inline" id="price_input_<?php echo $id; ?>" <?php echo $status;?>/>
</td>
<?php endif;?>
 
<td width="100" class="edit_td">
<span id="last_<?php echo $id; ?>" class="text"><?php echo $qty; ?></span><span> <?php echo $p_unit;?></span>
<input type="text" value="<?php echo $qty; ?>"  class="val2 editbox integer inline-half" data-stock="<?php echo $stock;?>" id="last_input_<?php echo $id; ?>" <?php echo $status;?>/>
<input type="hidden" value=""  class="item_total" id="total_input_<?php echo $id; ?>"  />
 
</td>

<td width="100" class="edit_td">
<span id="disc_<?php echo $id; ?>" class="text"><?php echo $disc; ?></span>
<input type="text" data-mask="99%" value="<?php echo $disc;?>"  class=" val3 editbox" id="disc_input_<?php echo $id; ?>" <?php echo $status;?>/>
 <input type="hidden" value="<?php echo $order_level;?>" id="level" class="val4" /> 
</td>

<td width="100" class="edit_td">
<span id="disc_l_<?php echo $id; ?>" class="text"><?php echo $disc_l; ?></span>
<input type="text" data-mask="99%" value="<?php echo $disc_l;?>"  class=" val5 editbox" id="disc_input_l_<?php echo $id; ?>" <?php echo $status;?>/>
 
</td>

<td width="100"><span class="strike"><div class="less" ></div></span> ₱<span  class="multTotal"><?php echo $show_td_total;?></span>
<input type="hidden" id="td_total_<?php echo $id; ?>" class="gtotal_value cart_return" value="<?php echo $td_total;?>">
</td>
</tr>

<?php
}
?>
 

<?PHP
}else{
?>
 
<tr  >
<td colspan="10" align="center" height="20">There are no items in your cart</td>
</tr>
<?php
}
?>
</table>
<script>
var c1_label="<?php echo plural($count_rec1);?>";
var c1_count="<?php echo $count_rec1;?>";

$(".cart2-count").html('Total Item'+c1_label+' ('+c1_count+')');
</script>
 



 












<!-- EDIT QTY -->
<script type="text/javascript" src="../js/pos/editqty_edit.js"></script>
<!-- DELETE -->
<script type="text/javascript" src="../js/pos/del_edit.js"></script>	  
<!-- SHOW TOTAL -->
<script type="text/javascript" src="../js/pos/total_custom.js"></script>	  
