<?php
require('../db_config.php');
$connect=new DB();
$v1=$_REQUEST['pcode'];
$empid=$_SESSION['SESS_MEMBER_UID'];
 
$checkno=mysql_query("SELECT * from osd_transaction where t_empid='$empid' and t_active=1");
	while($rno1=mysql_fetch_array($checkno)){
	$tno=$rno1['t_receiptno'];
	$tid=$rno1['TID'];
	}

 
$query1=mysql_query("SELECT * from osd_unit_item 
INNER JOIN osd_product ON (PID=ui_pid)
INNER JOIN osd_unit ON (UID=ui_uid) where   ui_status=1 and PID='$v1'
"); 
$query2=mysql_query("SELECT * from osd_unit_item 
INNER JOIN osd_product ON (PID=ui_pid)
INNER JOIN osd_unit ON (UID=ui_uid) where   ui_status=1 and PID='$v1'
"); 

$count=mysql_num_rows($query2);

?>

<script>
$(document).ready(function(){

	// $("#save").attr("disabled","disabled");

	function compute_total(){
		var price=parseFloat($("#price").val());
		var qty=parseFloat($("#qty").val());
		if(isNaN(qty)){qty=0;}
		if(isNaN(price)){price=0;}

		var total=parseFloat(price)*parseFloat(qty);

		$(".show-total").text('₱'+total.toFixed(2));
		$('.show-price').text('₱'+price.toFixed(2));
		$(".show-qty").text(qty);
	}

	var selected = $('#unit').find('option:selected');
	var extra = selected.data('value'); 
	if(extra==0){

		$("#unitqty").val(0);
	}else{
		$("#unitqty").val(extra);
	}


	$("#price").keyup(function(){
		compute_total();
		var p=$(this).val();
		console.log(p);
		if(p.length==0){
			// $('#save').attr("disabled","disabled");
		}else{
			$('#save').removeAttr("disabled");
		}
		$('tr.details-item').fadeIn();
	});	
	$("#qty").keyup(function(){
		compute_total();

	});		
	$("#unit").change(function(){
//$('#save').removeAttr("disabled");
var show_price = $(this).children('option:selected').attr('data-price');
$('.show-price').text(show_price);
$(".show-total").text(show_price);
$("#qty").val(1);
$(".show-qty").text(1);

});


});
</script>
<?php
if($count!=0){
while($q2=mysql_fetch_array($query2)){
	$pname=$q2['p_name'];
	$p2=$q2['ui_selling_price'];
	$code=$q2['p_pcode'];
	$image=$q2['p_image_name'];
	$brand=$q2['p_brand'];
	 

}
}else{
$pname='Please add';
}

if($count!=0){
?>

<!-- <div class="col-lg-12 no-right no-left">
                  <header class="text-center">
                    <h5 style="font-weight:normal;"><?php echo $brand.' - '.$pname;?><span class="show-code"></span></h5>
					<div class="code"><?php echo $code?></div>
                  </header>
</div> -->
	<div class="col-lg-12" style="margin:0;padding:0;position: relative;font-size:11px;">

 

                <div class="box">










 <table class="table table-bordered table-condensed table-hover table-striped">
<tr>
<td colspan="2">
<select name="unit_id" class="form-control" id="unit" >
<?php
while($q1=mysql_fetch_array($query1)){
	$p_unitid=$q1['UIID'];
	$unit_name=$q1['u_name'];


	
	$drate=$q1['ui_disc_rate'];
	$base=$q1['ui_base_price'];
	
	if($base=='0.00'){
	$p=$q1['ui_selling_price'];
	}else{
	$p=$q1['ui_base_price'];	
	}



	$p_stocks=$q1['ui_stocks'];
	$p_name=$q1['p_name'];
	$pcode=$q1['p_pcode'];
	$brand=$q1['p_brand'];
?>
<option value="<?php echo $p_unitid?>"  data-pid="<?php echo $pcode;?>" data-price="<?php echo $p;?>" data-value="<?php echo $p_stocks;?>"><?php echo $unit_name.'  ['.$p_stocks.']'?></option>
<?php 
}
?>
</select> 

</td>
</tr>
<tr>
<td  >Quantity</td> 
</tr>

<tr>
<td  ><input type="text" placeholder="Quantity" value="1" class="positive form-control " class="qty" id="qty" name="qty"></td>
<!-- <td><input type="text" placeholder="Price" value="" class="positive form-control " class="positive" id="price" name="price"></td> -->
</tr>

   </table>

				  
 

                  <div id="defaultTable" class="body collapse in">






<!-- 
                    <table class="table responsive-table">
                      <thead>
                        <tr>
						<th>QTY</th>
						<th>PRICE</th>
						<th>SUBTOTAL</th>
                        
                        </tr>
                      </thead>
                      <tbody>
                        <tr class="details-item" style="display:none;">
						<td><span class="show-qty"></span></td>
						<td><span class="show-price"></span></td>
						<td><span class="show-total"></span></td>
                        </tr>
 
                      </tbody>
                    </table>

 -->

                  </div>	
 
                </div>
              </div>
	 
<?php
}else{
?>
<div class="col-lg-12" style="position: relative;font-size:12px;">
 <div class="box">
<div class="alert alert-danger">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <strong>Warning!</strong> No stocks found. <span id="alert_content"><a href="?page=item"  class="btn_del btn btn-sm btn-default">
	<i class="glyphicon glyphicon-plus"></i> add here
</a> </span>
</div>
<div>
 
 </div></div>
</div>
<?php
}
?>

 
 
  <script type="text/javascript" src="../js/jquery.numeric.js"></script>
	<script type="text/javascript">
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




