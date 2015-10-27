<?php
require('../../db_config.php');
$connect=new DB();
$empid=$_REQUEST['empid'];
$mode=$_REQUEST['mode'];
$tid=$_REQUEST['tid'];

$last=mysql_query("SELECT TID, t_receiptno, t_amount_t, t_trans_date, t_customer_id, t_mode, t_supplier_id, t_COD  from osd_transaction where TID=$tid");
while($lastrow=mysql_fetch_array($last)){
$tid=$lastrow['TID'];
$rno=$lastrow['t_receiptno'];
$total_amount_t=$lastrow['t_amount_t'];
$show_total_amount_t=number_format($total_amount_t, 2, '.', ',');	
$trans_date=$lastrow['t_trans_date'];
$COD=$lastrow['t_COD'];

$mode=$lastrow['t_mode'];

if($mode==1){
$TCID=$lastrow['t_customer_id'];
$c=' <div>Customer :  <strong >'.pabs_query('c_firstname','osd_customer','CID',$TCID).'</strong></div>';
}elseif($mode==2){
$TCID=$lastrow['t_supplier_id'];
$c=' <div>Supplier :  <strong >'.pabs_query('sup_name','osd_supplier','SID',$TCID).'</strong></div>';
}

}

 

?>
<input type="hidden" id="mode_cart" value="<?php echo $mode;?>">
<div class="col-lg-12 grid">
 <table class="table table-bordered table-condensed table-hover table-striped">
 <tr>
 <td colspan="2">
<?php echo $c;?>
 <div>Unique Transaction ID : #<strong class="all-caps"><?php $input  =md5($rno); echo substr($input,0,6) . substr($input,-6);?></strong></div>

 </td>
<td colspan="3" class="right">
	<div>DNO : <strong><?php echo $rno;?></strong></div>	
	 <div>Transaction Date : <strong><?php echo date('F d, Y h:i A', strtotime($trans_date));?></strong></div>
	  <div>TERMS : <strong><?php echo $COD?></strong> </div>
</td>
 </tr>
<tr>
<td    class="bold">Item Description</td>
<td class="bold right">Cost</td>
<td class="bold right">Qty.</td>
<td  class="bold right">Discount</td> 
<td class="bold right">Total</td>
</tr>
<tbody>
<?php
function plural($amount, $singular = '', $plural = 's' ) {
    if ( $amount <= 1 )
        return $singular;
    else
        return $plural;
}	

$query1=mysql_query("SELECT 

	TDID,p_name, td_pcode, p_pcode, p_brand, ui_stocks, u_symbol, td_qty, ui_reorder_level, td_price, ui_reorder_level, td_disc, td_disc_l, td_total, ui_disc_rate, disc_status, ui_supplier_price

  from osd_transaction_details
INNER JOIN osd_transaction ON (t_receiptno=td_transaction_id)
INNER JOIN osd_product ON (td_pcode=PID)
INNER JOIN osd_unit_item ON (td_unit_id=UIID)
INNER JOIN osd_unit ON (ui_uid=UID)
where  td_mode=$mode and TID=$tid and td_return=0  order by TDID  ");
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
$raw=$q1['ui_supplier_price'];
$p_price=$q1['td_price'];
$td_total=$q1['td_total'];
$reorder_level=$q1['ui_reorder_level'];
$show=0;
if($stock<=$qty){
	$show=1;
}
$show_td_total=number_format($td_total, 2, '.', ',');	

 
	$status='';
 

$p_price=number_format($p_price, 2, '.', ',');

$disc=$q1['td_disc'];
$disc_l=$q1['td_disc_l'];
$disc_status=$q1['disc_status'];
$disc_rate=$q1['ui_disc_rate'];
if($disc==0):$disc='0.00';endif;
if($disc_l==0):$disc_l='0.00';endif;

 
?>

<tr>

<td  >
<div><span  ><?php echo $p_brand; ?> </span> <span  ><?php echo $p_name; ?> </span> <?php echo $product_code;?> </div>
 

 
</td>
<td class="right">
 <?php echo $p_price; ?>  
 
</td>

 
<td  class="right" >
<span ><?php echo $qty; ?></span><span> <?php echo $p_unit;?></span>
 
</td>

<td  >
		<span  class="discount"> 
	<?php
	if($disc_l!=0.00){ 
	$discounts = explode(',', $disc_l);	
	$last = end($discounts);
	echo 'L ';
	foreach($discounts as $discount){
		
		if($last!=$discount){
			echo $discount.'%, ';
		}else{
			echo $last.'%';
		}
	}	
	?>		
		 
	<?php
	}
	?>	
	
	<?php
	if($disc!=0.00){ 
	$discounts = explode(',', $disc);	
	$last = end($discounts);
	echo '+ ';
	foreach($discounts as $discount){
		
		if($last!=$discount){
			echo $discount.'%, ';
		}else{
			echo $last.'%';
		}
	}	
	?>		
		 
	<?php
	}
	?>
	</span>
</td>

<td  class="right"><span  > <?php echo $show_td_total;?>  
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
custom_cart($tid);
?>
<tr>
<td colspan="4"><span id="label-qty"><!-- Total item<?php echo plural($count_rec);?></span> (<span id="item-count" ><?php echo $count_rec?></span>) --></td>
<td class="right"><strong><div>P <span id="grandTotal"><?php echo $show_total_amount_t;?></span></div></strong></td>
</tr>
</tbody>

</table>
</div>
 
 