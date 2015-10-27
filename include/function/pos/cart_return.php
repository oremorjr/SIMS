<?php
require('../../db_config.php');
$connect=new DB();
$empid=$_REQUEST['empid'];
 $mode=$_REQUEST['mode'];
// $tid=$_REQUEST['tid'];
$tid=0;
$trno=0;
$last=mysql_query("SELECT TID, t_receiptno  from osd_transaction where t_empid='$empid' and t_active=1 and t_mode=$mode");
while($lastrow=mysql_fetch_array($last)){
$tid=$lastrow['TID'];
$trno=$lastrow['t_receiptno'];
}
 if($trno!=0):
echo '<div class="rno">DNO: '.$trno.'</div>';
else:
echo '<div class="no_tid">Cart has no reference Transaction No. Please click New Transaction.</div>';
endif;

?>
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

	TDID,p_name,p_brand ,td_pcode, p_pcode, ui_stocks, u_symbol, td_qty, ui_reorder_level, td_price, ui_reorder_level, td_disc, td_disc_l, td_total, disc_status, ui_disc_rate, return_reason

  from osd_transaction_details
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
$p_brand=$q1['p_brand'];
$p_code=$q1['td_pcode'];
$product_code=$q1['p_pcode'];
 
$stock=$q1['ui_stocks'];
$p_unit=$q1['u_symbol'];
$qty=$q1['td_qty'];
$order_level=$q1['ui_reorder_level'];
$p_price=$q1['td_price'];
$td_total=$q1['td_total'];
$disc_status=$q1['disc_status'];
$ui_disc_rate=$q1['ui_disc_rate'];
$reason=$q1['return_reason'];

if($disc_status==0){
$discount_rate_l=$ui_disc_rate;
}else{
$discount_rate_l='0.00';	
}
if($disc_status==1){
$discount_rate=$ui_disc_rate;
}else{
$discount_rate='0.00';	
}

$reorder_level=$q1['ui_reorder_level'];

$show=0;
if($stock<=$qty){
	$show=1;
}
$show_td_total=number_format($td_total, 2, '.', ',');	

 
	$status='';
 

//$p_price=number_format($p_price, 2, '.', ',');

$disc=$q1['td_disc'];
$disc_l=$q1['td_disc_l'];
?>

<tr id="<?php echo $id; ?>" class="record txtMult edit_tr">
<td width="1%" align="center" ><a href="#" id="<?php echo $id; ?>" data-value="<?php echo $qty; ?>" class="delbutton"><i class="glyphicon glyphicon-remove-circle"></i></a></td>
<td width="100" class="edit_td">
<div><span><?php echo $p_brand; ?></span><span  class="p_name" ><?php echo $p_name; ?> </span></div>
<div style="font-size:11px;"><span id="first_<?php echo $id; ?>" data-label="<?php echo $product_code; ?>" ><?php echo $product_code;?></span></div>

</td>
<td width="100" class="edit_td">
<span id="price_<?php echo $id; ?>"  class="text"><?php echo $p_price; ?></span>
<input type="text" value="<?php echo $p_price; ?>"  class="val1 editbox positive" id="price_input_<?php echo $id; ?>" <?php echo $status;?>/>
 
</td>

 
<td width="100" class="edit_td">
<span id="last_<?php echo $id; ?>" class="text left"><?php echo $qty; ?></span><span class="left"> <?php echo $p_unit;?></span>
<input type="text" value="<?php echo $qty; ?>"  class="val2 editbox integer" id="last_input_<?php echo $id; ?>" <?php echo $status;?>/>
<input type="hidden" value=""  class="item_total" id="total_input_<?php echo $id; ?>" />
</td>

<td width="100" class="edit_td">
<span id="disc_<?php echo $id; ?>" class="text"><?php echo $discount_rate; ?></span>
<input type="text" data-mask="99%" value="<?php echo $discount_rate;?>"  class=" val3 editbox" id="disc_input_<?php echo $id; ?>" <?php echo $status;?>/>
 <input type="hidden" value="<?php echo $order_level;?>" id="level" class="val4" /> 
</td>

<td width="100" class="edit_td">
<span id="disc_l_<?php echo $id; ?>" class="text"><?php echo $discount_rate_l; ?></span>
<input type="text" data-mask="99%" value="<?php echo $discount_rate_l;?>"  class=" val5 editbox" id="disc_input_l_<?php echo $id; ?>" <?php echo $status;?>/>
 
</td>

<td width="100"><span class="strike"><div class="less" ></div></span> ₱<span  class="multTotal"><?php echo $show_td_total;?></span>
<input type="hidden" id="td_total_<?php echo $id; ?>" class="gtotal_value" value="<?php echo $td_total;?>">
</td>
</tr>
<tr id="<?php echo $id; ?>" class="edit_tr">
<td colspan="10">
<textarea id="reason_id_<?php echo $id; ?>" class="form-control"   style="font-size:12px;height:40px;width:100%;"placeholder="Comment"><?php echo $reason;?></textarea>
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
	<script type="text/javascript">
	show_form();

	$(".numeric").numeric();
	$(".integer").numeric(false, function() { alert("Integers only"); this.value = ""; this.focus(); });
	$(".positive").numeric({ negative: false }, function() { alert("No negative values"); this.value = ""; this.focus(); });
	$(".positive-integer").numeric({ decimal: false, negative: false }, function() { alert("Positive integers only"); this.value = ""; this.focus(); });
	$("#remove").click(
		function(e)
		{
			e.preventDefault();
			$(".numeric,.integer,.positive").removeNumeric();
		}
	);
	</script>

<!-- SHOW TOTAL -->
<script type="text/javascript" src="../js/pos/total.js"></script>	  
<!-- EDIT QTY -->
<script type="text/javascript" src="../js/pos/editqty_return.js"></script>
<!-- DELETE -->
<script type="text/javascript" src="../js/pos/del.js"></script>	  
