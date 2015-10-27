<?php 
include('../../../include/class_lib.php');
$pid=$_GET['pid'];
$uid1=$_GET['pid'];
$stocks=0;
?> 
<?php
$query=mysql_query("SELECT * from osd_unit_item INNER JOIN osd_unit ON (ui_uid=UID) where ui_pid='$pid' and ui_status=1 group by UID");
while($row=mysql_fetch_array($query)){
$unit1=$row['u_name'];
$uid1=$row['UIID'];
$s_price=$row['ui_selling_price'];
$sup_price=$row['ui_supplier_price'];
$s_level=$row['ui_reorder_level'];
$count1=mysql_query("SELECT * from osd_product_unit  where pu_unit_id=$uid1");
$cr1=mysql_num_rows($count1);
?>						
<div class="col-lg-12" id="box_<?php echo $uid1;?>">
<div class="row">

<div class="box" >
<header>
<div class="icons">
<i class="fa fa-table"></i>
</div>
<h5><?php echo $unit1; ?>
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
<table  width="50%"  class="table table-bordered table-condensed table-hover table-striped">
<tr>
<td width="10%"> 
<strong>Selling Price</strong>
</td>
<td >


<div id="<?php echo $uid1; ?>" class="edit_tr">
<span id="first_<?php echo $uid1; ?>"></span>
<span id="price_<?php echo $uid1; ?>" class="text"><?php echo $s_price; ?></span>
<input type="text" value="<?php echo $s_price; ?>"  class="form-control editbox positive" id="price_input_<?php echo $uid1; ?>"/>					
</div>				
</td>

<td width="10%"> 
<strong>Supplier Price</strong>
</td>
<td width="30%">
<div id="<?php echo $uid1; ?>" class="edit_tr">

<span id="sup_price_<?php echo $uid1; ?>" class="text"><?php echo $sup_price; ?></span>
<input type="text" value="<?php echo $sup_price; ?>"  class="form-control editbox positive" id="sup_price_input_<?php echo $uid1; ?>"/>					
</div>				
</td>	



<td width="10%"> 
<strong>Reorder Level</strong>
</td>
<td width="30%">
<div id="<?php echo $uid1; ?>" class="edit_tr">

<span id="reorder_<?php echo $uid1; ?>" class="text"><?php echo $s_level; ?></span>
<input type="text" value="<?php echo $s_level; ?>"  class="form-control editbox positive" id="reorder_input_<?php echo $uid1; ?>"/>					
</div>				
</td>				


</tr>
</table>

<div id="collapse4" class="body">
<div id="unit_<?php echo $uid1;?>" style="display:block;"  >
<table  class="dataTable table table-bordered table-condensed table-hover table-striped">
<thead>
<tr>
 
<th>Date Purchased </th>
<th>Price</th>
<th>Stocks</th>

<th>Remarks</th>	
</tr>
</thead>		

<tbody>
<?php
$t=0;
$t_stocks=0;
$sql5=mysql_query("SELECT * from osd_product_unit 
INNER JOIN osd_supply_remarks ON (sr_no=pu_remarks) 
INNER JOIN osd_unit_item ON (pu_unit_id=UIID)
INNER JOIN osd_product ON (PID=pu_product_code)  
where pu_unit_id='$uid1' and PID='$pid' and ui_status=1 order by pu_datepurchased DESC  ");
while($r5=mysql_fetch_array($sql5)){
$dp=$r5['pu_datepurchased'];
$qty=$r5['pu_qty'];
$rem=$r5['pu_remarks'];
$rp=$r5['pu_raw_price'];
$puid=$r5['PUID'];
$p_rem=$r5['sr_name'];
$tno=$r5['p_transno'];
$stocks=$r5['ui_stocks'];

$t=$t+$qty;
 

$q4=mysql_query("SELECT TID from osd_transaction where   t_receiptno='$tno' ");
while($r4=mysql_fetch_array($q4)){
$tid=$r4['TID'];
}

if($rem==2){
$remarks='<a href="?page=view-receipt-supplier&mode=2&TID='.$tid.'">'.$p_rem.'-'.$tno.'</a>';
}else{
$remarks= $p_rem; 
}
?>
<tr> 
<td><?php echo $dp;?></td>
<td><?php echo $rp;?></td>

<td><?php echo $qty;?></td>

<td><?php echo $remarks;?></td>
</tr>
<?php
}
?>


</tbody>



</table>
<div><?php echo $stocks;?></div>
<?php




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


$(".edit_tr").click(function()
{
var ID=$(this).attr('id');
console.log(ID);
$("#price_"+ID).hide();
$("#reorder_"+ID).hide();
$("#sup_price_"+ID).hide();
$("#price_input_"+ID).show();
$("#reorder_input_"+ID).show();
$("#sup_price_input_"+ID).show();

}).change(function()
{
var ID=$(this).attr('id');
var first=$("#first_"+ID).text();
var price=$("#price_input_"+ID).val();
var reorder=$("#reorder_input_"+ID).val();
var sup_price=$("#sup_price_input_"+ID).val();

var dataString = 'id='+ ID + '&price='+price + '&reorder=' + reorder + '&sup_price=' +  sup_price;
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
$("#first_"+ID).html(first);
$(".editbox").hide();
$(".text").show();
}
});
}
else
{
alert('Enter something.');
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



<script src="assets/lib/datatables/DT_bootstrap.js"></script>
<script src="assets/lib/tablesorter/js/jquery.tablesorter.min.js"></script>
<script src="assets/lib/touch-punch/jquery.ui.touch-punch.min.js"></script>