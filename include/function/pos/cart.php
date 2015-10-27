<?php
require('../../db_config.php');
$connect=new DB();
$empid=$_SESSION['SESS_MEMBER_UID'];
 
?>
 <table class="table table-bordered table-condensed table-hover table-striped">
<tr>
<td width="50%" colspan="2" class="bold">Item Name445</td>
<td class="bold">Cost</td>
<td class="bold">Qty.</td>
<td  class="bold">Disc (%)</td>
<td class="bold">Total</td>
</tr>
<?php
function plural($amount, $singular = '', $plural = 's' ) {
    if ( $amount <= 1 )
        return $singular;
    else
        return $plural;
}	
$mode=$_GET['mode'];
$tid=$_GET['tid'];
$query1=mysql_query("SELECT * from osd_transaction_details
INNER JOIN osd_transaction ON (t_receiptno=td_transaction_id)
INNER JOIN osd_product ON (td_pcode=PID)
INNER JOIN osd_unit_item ON (td_unit_id=UIID)
INNER JOIN osd_unit ON (ui_uid=UID)
where t_active=1 and t_empid='$empid' and td_mode=$mode and TID=$tid and td_ispaid=0 order by TDID  ");
$s=0;
$count_rec=mysql_num_rows($query1);
if($count_rec!=0){
while($q1=mysql_fetch_array($query1)){
$id=$q1['TDID'];
$p_name=$q1['p_name'];
$p_code=$q1['td_pcode'];
$product_code=$q1['p_pcode'];
 
$stock=$q1['ui_stocks'];
$p_unit=$q1['u_symbol'];
$qty=$q1['td_qty'];
$order_level=$q1['ui_reorder_level'];
$p_price=$q1['ui_selling_price'];
$reorder_level=$q1['ui_reorder_level'];
$show=0;
if($stock<=$qty){
	$show=1;
}


if($stock<=0){
	$status='disabled';
	$l='No stock';
}else{
	$status='';
	$l='in stock';
}

//$p_price=number_format($p_price, 2, '.', ',');

$disc=$q1['td_disc'];
?>

<tr id="<?php echo $id; ?>" class="record txtMult edit_tr">
<td width="1%" align="center" ><a href="#" id="<?php echo $id; ?>" data-value="<?php echo $qty; ?>" class="delbutton"><i class="glyphicon glyphicon-remove-circle"></i></a></td>
<td width="100" class="edit_td">
<div><span  class="p_name" ><?php echo $p_name; ?></span></div>
<div style="font-size:11px;"><span id="first_<?php echo $id; ?>" data-label="<?php echo $product_code; ?>" ><?php echo $product_code;?></span></div>
<div style="font-size:11px;"> [<?php echo $stock.' '.$l;?>]</span></div>
</td>
 
 
<td width="100">

<span class="" id="price_<?php echo $id; ?>">₱<?php echo $p_price;?></span>
<input type="hidden" value="<?php echo $p_price; ?>"  class="val1" />
</td>
<td width="100" class="edit_td">
<span id="last_<?php echo $id; ?>" class="text"><?php echo $qty; ?> <?php echo $p_unit;?></span>
<input type="text" value="<?php echo $qty; ?>"  class="  val2 editbox" id="last_input_<?php echo $id; ?>" <?php echo $status;?>/>
<input type="hidden" value=""  class="item_total" id="total_input_<?php echo $id; ?>" /></td>

<td width="100" class="edit_td">
<span id="disc_<?php echo $id; ?>" class="text"><?php echo $disc; ?></span>
<input type="text" data-mask="99%" value="<?php echo $disc;?>"  class=" val3 editbox" id="disc_input_<?php echo $id; ?>" <?php echo $status;?>/>
 <input type="hidden" value="<?php echo $order_level;?>" id="level" class="val4" /> 

<td width="100">
₱<span class="multTotal">0.00</span>
<span data-value="" id="multTotal_<?php echo $id; ?>" class="multTotal-2"></span>
</td>
</tr>
<tr id="empty-cart" style="display:none;">
<td colspan="10" align="center" height="20">There are no items in your cart</td>
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
<div style="position:absolute;top:0;z-index:111;color:#fff;right:0;margin-top:10px;margin-right:10px;">
<span id="label-qty">Total item<?php echo plural($count_rec);?></span> (<span id="item-count" ><?php echo $count_rec?></span>)
</div>
 


<!-- SHOW TOTAL -->
<script type="text/javascript" src="../js/pos/total.js"></script>	  
<!-- EDIT QTY -->
<script type="text/javascript" src="../js/pos/editqty.js"></script>
<!-- DELETE -->
<script type="text/javascript" src="../js/pos/del.js"></script>	  
