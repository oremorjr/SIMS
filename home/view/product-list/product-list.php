<?php 
include('../../../include/class_lib.php');
$pid=$_GET['pid'];
$uid1=$_GET['pid'];
$stocks=0;
$current_stocks="";
$o="";
?> 
<?php




$query=mysql_query("SELECT * from osd_unit_item INNER JOIN osd_unit ON (ui_uid=UID) where ui_pid='$pid' and ui_status=1 group by UID");
while($row=mysql_fetch_array($query)){
$unit1=$row['u_name'];
$uid1=$row['UIID'];
$s_price=$row['ui_selling_price'];
$sup_price=$row['ui_supplier_price'];
$base_price=$row['ui_base_price'];
$s_level=$row['ui_reorder_level'];
$disc_rate=$row['ui_disc_rate'];
$disc_status=$row['disc_status'];
if(empty($disc_rate)){
$disc_rate=0;
}
$count1=mysql_query("SELECT * from osd_product_unit  where pu_unit_id=$uid1 and pu_status=1");
$cr1=mysql_num_rows($count1);

 // echo $uid1;
 // echo '<br>';
 // echo get_current_stocks($uid1);

?>						
<div class="col-lg-12" id="box_<?php echo $uid1;?>">

<h1  class="unit-name" style="text-transform:capitalize;font-size:50px;text-align:right;"><?php echo get_current_stocks($uid1).' '.$unit1; ?></h1>

<div class="row">

<div class="box" >
<header>
<div class="icons">
<i class="fa fa-table"></i>
</div>
<h5 style="text-transform:capitalize;"><?php echo $unit1; ?>
</h5>
<div class="toolbar">
<div class="btn-group">
<a  href="#borderedTable" data-toggle="collapse"  data-value="<?php echo $uid1;?>" class="btn-show btn btn-default btn-sm minimize-box">
<i class="fa fa-angle-up"> </i>
</a>
<?php 
if($cr1==0){
?>
<a data-value="<?php echo $uid1;?>"  class="btn-del btn btn-danger btn-sm close-box">
<i class="fa fa-times"></i>
</a>  
<?php
}
?>
</div>
</div>					
</header>

<?php
if(current_user('control-price')):
?>
<table  width="50%"  class="price-mgt table table-bordered table-condensed table-hover table-striped">

<tr>
<td colspan="10" class="t-center"style="padding: 10px !important;"><h4>Price Management</h4></td>
</tr>

<tr>
<td  > 
<strong>Selling Price</strong>
</td>
<td >


<div id="<?php echo $uid1; ?>" class="edit_tr">
<span id="first_<?php echo $uid1; ?>"></span>
<span id="price_<?php echo $uid1; ?>" class="text"><?php echo $s_price; ?></span>
<input type="text" value="<?php echo $s_price; ?>"  class="form-control editbox positive" id="price_input_<?php echo $uid1; ?>"/>					
</div>				
</td>

<td class="hidden" > 
<strong>Capital</strong>
</td>
<td  class="hidden">
<div id="<?php echo $uid1; ?>" class="edit_tr">

<span id="sup_price_<?php echo $uid1; ?>" class="text"><?php echo $sup_price; ?></span>
<input type="text" value="<?php echo $sup_price; ?>"  class="form-control editbox positive" id="sup_price_input_<?php echo $uid1; ?>"/>					
</div>				
</td>	


<td  > 
<strong>Base Price</strong>
</td>
<td width="10%">
<div id="<?php echo $uid1; ?>" class="edit_tr">

<span id="base_price_<?php echo $uid1; ?>" class="text"><?php echo $base_price; ?></span>
<input type="text" value="<?php echo $base_price; ?>"  class="form-control editbox positive" id="base_price_input_<?php echo $uid1; ?>"/>					
</div>				
</td>	

<td  class="hidden" > 
<strong>Discount Rate</strong>

</td>
<td class="hidden">
<div class="edit_tr">
<select class=" " id="status">
<?php 
$disc_status==1 ? $dval='ADD' : $dval='LESS';
echo '<option value='.$disc_status.' data-value="'.$uid1.'">'.$dval.'</option>';
echo '<option value='.$disc_status.' data-value="'.$uid1.'">-----------</option>';

?>
<option value="0" data-value="<?php echo $uid1?>">LESS</option>
<option value="1"  data-value="<?php echo $uid1?>">ADD</option>
</select>
</div>	
</td>
<td class="hidden" >
<div id="<?php echo $uid1; ?>" class="edit_tr">

<span id="rate_<?php echo $uid1; ?>" class="text"><?php echo $disc_rate; ?></span>
<input type="text" value="<?php echo $disc_rate; ?>"  class="form-control editbox  " id="rate_input_<?php echo $uid1; ?>"/>					
</div>				
</td>	

<td  > 
<strong>Reorder Level</strong>
</td>
<td  >
<div id="<?php echo $uid1; ?>" class="edit_tr">

<span id="reorder_<?php echo $uid1; ?>" class="text"><?php echo $s_level; ?></span>
<input type="text" value="<?php echo $s_level; ?>"  class="form-control editbox positive" id="reorder_input_<?php echo $uid1; ?>"/>					
</div>				
</td>				


</tr>
</table>

<?php endif;?>

<div id="collapse4" class="body">
<div id="unit_<?php echo $uid1;?>" style="display:block;"  >

 

<table  class="dataTable table table-bordered table-condensed table-hover table-striped">
<thead>
<tr>

<th>ID</th>
<th>Date Purchased </th>
<th>Customer/Supplier</th>
<!-- 
<th>Price</th> -->
<th>Qty</th>
<th>RS</th>

<th>Remarks</th>	
</tr>
</thead>		

<tbody>
<?php
$t=0;
$t_stocks=0;

$stocks_arr=array();
$qty_arr=array();


 
$t_qty=0;
$sql7=mysql_query("SELECT PUID, ui_stocks from osd_product_unit 
INNER JOIN osd_supply_remarks ON (sr_no=pu_remarks) 
INNER JOIN osd_unit_item ON (pu_unit_id=UIID)
INNER JOIN osd_product ON (PID=pu_product_code)  
where pu_unit_id='$uid1' and PID='$pid' and ui_status=1 and pu_status=1 order by PUID ASC  ");
while($r7=mysql_fetch_array($sql7)){ 

$puiid_r=$r7['PUID'];
$qt=mysql_query("SELECT pu_qty, pu_remarks from osd_product_unit where PUID=$puiid_r and pu_status=1 ");

while($qt1=mysql_fetch_array($qt)){
$r=$qt1['pu_remarks'];

if($r==1){
$operand[]=1;
$o[]='+';
}elseif ($r==2) {
$operand[]=2;
$o[]='+';
}elseif ($r==3) {
$operand[]=3;
$o[]='+';
}elseif ($r==4) {
$operand[]=4;
$o[]='-';
}elseif ($r==5) {
$operand[]=5;
$o[]='-';
}elseif ($r==6) {
$operand[]=6;
$o[]='-';
}elseif ($r==7) {
$operand[]=7;
$o[]='-';
}elseif ($r==8) {
$operand[]=8;
$o[]='+';
}elseif ($r==9) {
$operand[]=9;
$o[]='-';
}




$qty_arr[]=$qt1['pu_qty'];
}

$stocks_arr[]=$r7['PUID'];
$stocks_t=$r7['ui_stocks'];


}

$count_arr=count($stocks_arr);

 

// echo '<br>';
for($i=0;$i<$count_arr;$i++):


	$op=$operand[$i];

	if($op==1){
	$t_qty=$t_qty+$qty_arr[$i];
	}elseif ($op==2) {
	$t_qty=$t_qty+$qty_arr[$i];
	}elseif ($op==3) {
	$t_qty=$t_qty+$qty_arr[$i];
	}elseif ($op==4) {
	$t_qty=$t_qty-$qty_arr[$i];
	}elseif ($op==5) {
	$t_qty=$t_qty-$qty_arr[$i];
	}elseif ($op==6) {
	$t_qty=$t_qty-$qty_arr[$i];
	}elseif ($op==7) {
	$t_qty=$t_qty-$qty_arr[$i];
	}elseif ($op==8) {
	$t_qty=$t_qty+$qty_arr[$i];
	}elseif ($op==9) {
	$t_qty=$t_qty-$qty_arr[$i];
	}
	
 	
 
$current_stocks[]=$t_qty; 

// echo $qty_arr[$i].' '.$t_qty.'<br>';

endfor;

$c=array_reverse($current_stocks);
$o=array_reverse($o);

 


$sql5=mysql_query("SELECT pu_datepurchased,pu_qty, pu_stocks, pu_remarks, pu_raw_price, PUID, sr_name, p_transno
, ui_stocks, p_supplier_unit_id, ui_manual_type
 from osd_product_unit 
INNER JOIN osd_supply_remarks ON (sr_no=pu_remarks) 
INNER JOIN osd_unit_item ON (pu_unit_id=UIID)
INNER JOIN osd_product ON (PID=pu_product_code)  
where pu_unit_id='$uid1' and PID='$pid' and ui_status=1 and pu_status=1 order by PUID DESC  LIMIT 500");

$i=-1;
while($r5=mysql_fetch_array($sql5)){
	$i++;
$p_transno=$r5['p_transno'];
$dp=$r5['pu_datepurchased'];
$qty=$r5['pu_qty'];
$c_stocks=$r5['pu_stocks'];
$rem=$r5['pu_remarks'];
$rp=$r5['pu_raw_price'];
$puid=$r5['PUID'];
$puuuid=str_pad($puid, 5, "0", STR_PAD_LEFT);
$p_rem=$r5['sr_name'];
$tno=$r5['p_transno'];
$stocks=$r5['ui_stocks']; 
$manual=$r5['ui_manual_type']; 
$supid=$r5['p_supplier_unit_id']; 
$t=$t+$qty;
 


  if($rem==1){
$mode=2;
$customer=pabs_query('sup_name','osd_supplier','SID',$supid);
  }elseif ($rem==2) {
$mode=2;
$customer=pabs_query('sup_name','osd_supplier','SID',$supid);
  }elseif ($rem==3) {
$mode=1;
$customer=pabs_query('sup_name','osd_supplier','SID',$supid);
  }elseif ($rem==4) {
$customer=pabs_query('sup_name','osd_supplier','SID',$supid);
$mode=2;
  }elseif ($rem==5) {
  	$customer=pabs_query('c_firstname','osd_customer','CID',$supid);
  	// $customer=$sup_name;
$mode=1;
  }elseif ($rem==6) {
$mode=3;
$customer=pabs_query('sup_name','osd_supplier','SID',$supid);
  }elseif ($rem==7) {
$mode=3;
$customer=pabs_query('sup_name','osd_supplier','SID',$supid);
  }elseif ($rem==8) {
$mode=1;
 $customer=pabs_query('c_firstname','osd_customer','CID',$supid);
  }elseif ($rem==9) {
$mode=2;
 $customer=pabs_query('sup_name','osd_supplier','SID',$supid);
  }
 
 

$stid=mysql_query("SELECT TID from osd_transaction where t_receiptno='$tno' and t_mode=$mode ");
while($trow=mysql_fetch_array($stid)){
$tid=$trow['TID'];
}


if($rem==2){
$remarks='<a target="_blank" href="?page=view-receipt-supplier&mode=2&TID='.$tid.'">'.$p_rem.'-'.$tno.'</a>';
}elseif ($rem==4) {
$remarks='<a target="_blank" href="?page=view-receipt-supplier&mode=2&TID='.$tid.'">'.$p_rem.'-'.$tno.'</a>';
}elseif ($rem==3) {
$remarks='<a target="_blank" href="?page=view-receipt&mode=1&TID='.$tid.'">'.$p_rem.'-'.$tno.'</a>';
$customer="N/A";
}elseif ($rem==5) {
$remarks='<a target="_blank" href="?page=view-receipt&mode=1&TID='.$tid.'">'.$p_rem.'-'.$tno.'</a>';
}elseif ($rem==1) {
$remarks='Manual Edit of Quantity (Add)';
$rp="N/A";
$customer="N/A";
}elseif ($rem==6) {
$remarks='<a target="_blank" href="view/print-preview-return.php?mode=3&TID='.$tid.'">'.$p_rem.'-'.$tno.'</a>';
$customer="N/A";
}elseif ($rem==7) {
$remarks='Manual Edit of Quantity (Less)';
$customer="N/A";
$rp="N/A";

}elseif ($rem==8) {
$remarks='<a target="_blank" href="?page=view-receipt&mode=1&TID='.$tid.'">'.$p_rem.'-'.$tno.'</a>';

}elseif ($rem==9) {
$remarks='<a target="_blank" href="?page=view-receipt-supplier&mode=2&TID='.$tid.'">'.$p_rem.'-'.$tno.'</a>';


}else{
$remarks= $p_rem; 
}


 
?>
<tr>
<td>PU<?php echo $puuuid;?></td>
<td width="20%"><?php echo date('M d, Y h:i A', strtotime($dp));?></td>
<td><?php echo $customer;?></td>

<!-- <td><?php echo $rp;?></td> -->

<td><?php echo $o[$i].''.$qty;?></td>
<td><?php echo $c[$i] ?></td>
 

<td  width="20%"><?php echo $remarks;?></td>
</tr>
<?php
}
?>


</tbody>



</table>
<!-- <div><h2><?php echo $stocks;?></h2></div> -->

<script>
var st_total="<?php echo $stocks;?>";
var st_current=$(".unit-name").html();

// $(".unit-name").html(st_total+' '+st_current);

</script>

<?php

// else:

// echo '<div class="alert alert-danger mb-0" role="alert">Set price first</div>';

// endif;
?>


</div>	
</div>


</div>
</div>
</div><!-- /.row -->	


 
<?php
}
?>


 



<script type="text/javascript">
$(document).ready(function()
{

$(".btn-show").click(function(){
var ID=$(this).data('value');
$("#unit_" + ID).slideToggle();
});

$(".btn-del").click(function(){
if(confirm("Sure you want to process this? There is NO undo!")){
var ID=$(this).data('value');
var dataString = 'id='+ ID;
console.log(ID);
$.ajax({
type: "POST",
url: "../include/function/pos/del-list.php",
data: dataString,
cache: false,
success: function(data)
{ 
$("#box_"+ID).slideUp('slow');
//show_product();
}
});
}
});



function show_product(){
$("#loading").load("view/product-list/product-list.php?pid=<?php echo $pid;?>");
}


$("#status").change(function(){
var disc_status=$(this).val();
var ID=$("#status option:selected").data('value');
// alert(ID);
$.ajax({
data:{status:disc_status, edit_status:1, id:ID},
url: "../include/function/pos/price.php",

success:function(data){
// alert(data);
}

});
});

$(".edit_tr").click(function()
{
var ID=$(this).attr('id');
console.log(ID);
$("#price_"+ID).hide();
$("#reorder_"+ID).hide();
$("#sup_price_"+ID).hide();
$("#base_price_"+ID).hide();
$("#rate_"+ID).hide();


$("#price_input_"+ID).show();
$("#rate_input_"+ID).show();
$("#reorder_input_"+ID).show();
$("#sup_price_input_"+ID).show();
$("#base_price_input_"+ID).show();

}).change(function()
{
var ID=$(this).attr('id');
var first=$("#first_"+ID).text();
var price=$("#price_input_"+ID).val();
var reorder=$("#reorder_input_"+ID).val();
var sup_price=$("#sup_price_input_"+ID).val();
var base_price=$("#base_price_input_"+ID).val();
var disc_rate=$("#rate_input_"+ID).val();
var disc_status=$("#status").val();

var dataString = 'id='+ ID + '&price='+price + '&reorder=' + reorder + '&sup_price=' +  sup_price+'&base_price='+base_price+'&disc_rate='+disc_rate+'&status='+disc_status+'&edit_status=0';
$("#first_"+ID).html('<img src="../images/load.gif" />');
$("#reorder_"+ID).html('<img src="../images/load.gif" />');

if(price.length>0)
{
$.ajax({
type: "POST",
url: "../include/function/pos/price.php",
data: dataString,
cache: false,
success: function(html)
{ 
show_product();
$("#price_"+ID).html(price);
$("#reorder_"+ID).html(reorder);
$("#sup_price_"+ID).html(sup_price);
$("#base_price_"+ID).html(base_price);
$("#first_"+ID).html(first);
$(".editbox").hide();
$(".text").show();
}
});
}
else
{
 
}

});

$(".editbox").mouseup(function() 
{
return false
});

$(document).mouseup(function()
{
$(".editbox").hide();
$(".text").show();
});

});


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


     <script type="text/javascript">
$(document).ready(function(){

$(".selectize").selectize({});
$('.dataTable').dataTable({

	    "bDeferRender": true   ,
	       "order": [[ 0, "desc" ]]
});
});
    </script>

  
<script src="assets/lib/tablesorter/js/jquery.tablesorter.min.js"></script>
<script src="assets/lib/touch-punch/jquery.ui.touch-punch.min.js"></script>