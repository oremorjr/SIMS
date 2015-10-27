<?php
require('../db_config.php');
$connect=new DB();
$v1=$_REQUEST['pcode'];
$empid=$_SESSION['SESS_MEMBER_UID'];
$mode=$_REQUEST['mode'];

 
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

// echo $mode;

?>

<script>
$(document).ready(function(){
	



	var selected = $('#unit').find('option:selected');
	var extra = selected.data('value'); 
	var price = selected.data('price'); 
	console.log(extra);
	var show_price2 = parseFloat($('#unit').children('option:selected').attr('data-price'));
	
	var stocks = parseFloat($('#unit').children('option:selected').attr('data-stocks'));
	var level = $("#reorder_level").data('level');
	
	
	if(parseInt(level) >= parseInt(stocks)){
		$('.reorder').fadeIn();
	}
	var show_code = $('#unit').children('option:selected').attr('data-pid');
	$(".show-total").text(show_price2.toFixed(2));
	
	$('.show-price').text(show_price2.toFixed(2));
	$('.show-code').text(show_code);
	 
	if(extra==0){
	// $("#save").attr("disabled", "disabled");
	$("#unitqty").val(0);
	}else{
	$("#unitqty").val(extra);
	// $('#save').removeAttr("disabled");
	}
			
		$("#unit").change(function(){
			
			$('#save').removeAttr("disabled");
			var show_price = $(this).children('option:selected').attr('data-price');
			$('.show-price').text(show_price);
			$(".show-total").text(show_price);
			$("#qty").val(1);
			$(".show-qty").text(1);
			
		});
		$("#qty").keyup(function(){
			var selected = $('#unit').find('option:selected');
			var extra = selected.data('value'); 	

			
			var val=$(this).val();
			var sub= parseFloat(show_price2)* parseFloat(val);
			$(".show-qty").text(val);
			$(".show-total").text(sub.toFixed(2));
			
	
			if(val > extra){
			// $(this).val(extra);
			$(".show-qty").text(extra);
			}
			if(val==0){
			// $(this).val();
			$("#save").attr("disabled", "disabled");
			}else{
			$("#save").removeAttr("disabled", "disabled");
			}
 
		});
 
	});
</script>

<?php
if($count!=0){
while($q2=mysql_fetch_array($query2)){
	$pname=$q2['p_name'];
	$brand=$q2['p_brand'];
	$p2=$q2['ui_selling_price'];
	$level=$q2['ui_reorder_level'];
}
}else{
$pname='Please add';
}
if($count!=0){
?>
<span id="reorder_level" data-level="<?php echo $level;?>"></span>
			<div class="col-lg-12" style="margin:0;padding:0;position: relative;font-size:11px;">
			
<div class="reorder" style="margin-top:10px;display:none; ">
<div class="alert alert-danger">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <strong>Warning!</strong> Stock level is low.<span id="alert_content"> </span>
        </div>
</div>		



 

<div class="panel panel-default mb-0">
  <div class="panel-heading mb-0">
    <h3 class="panel-title mb-0"><strong>Result</strong></h3>
  </div>

  <div class="panel-body">
  <div id="search-notification"></div>




 <table class="table table-bordered table-condensed table-hover table-striped">
<tr  >
<td>
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
	$image=$q1['p_image_name'];
	
?>


<?php
 
	$v=0;
	
	$query=mysql_query("SELECT * from osd_transaction_details where td_unit_id='$p_unitid'  and td_ispaid=0 and td_void=0 and td_pcode='$v1' and td_mode=$mode")or die(mysql_error());
	$c=mysql_num_rows($query);
	if($c!=0){
		while($q1=mysql_fetch_array($query)){
			$qty=$q1['td_qty'];
			$v=$v+$qty;
		}
		$stocksleft=$p_stocks;
		if($stocksleft<=0):
		?>
		<script>
		 
		 
		$("#search-notification").html('<div class="alert alert-warning" role="alert">No stocks left</div>');
		</script>
		<?php
		endif
		?>
		<option value="<?php echo $p_unitid?>" data-stocks="<?php echo $p_stocks;?>" data-pid="<?php echo $pcode;?>" data-value="<?php echo $stocksleft;?>" data-price="<?php echo $p;?>"><?php echo $unit_name.'  ['.$p_stocks.']'?></option>

		<?php
	}else{
	?>
	<option value="<?php echo $p_unitid?>" data-stocks="<?php echo $p_stocks;?>"   data-pid="<?php echo $pcode;?>" data-price="<?php echo $p;?>" data-value="<?php echo $p_stocks;?>"><?php echo $unit_name.'  ['.$p_stocks.']'?></option>
	<?php
	}
}
 
?>
</select> 
</td>
</tr>
<tr>
<td>
<div><label>Mode</label></div>
<select class="form-control" id="trans_type" name="trans_type">
<option value='0'><?php if($mode==1): echo 'Sales'; elseif($mode==2): echo 'Receiving'; endif;?></option>
<option value='1'>Return</option>
</select>
</td>
</tr>
<tr>
<td>
<div><label>Quantity</label></div>
<input type="text" value="1" class="positive form-control " Placeholder="Quantity" class="qty" id="qty" name="qty">
</td>
</tr>




</table>




 




  </div>
</div>





 
              </div>
 
<?php
}else{
?>
<div class="col-lg-12" style="text-align:center;position: relative;font-size:12px;">
 <div class="box">
 <div>
<div class="alert alert-danger">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <strong>Warning!</strong> No stocks found.<span id="alert_content"> </span>
 
</div>
 </div>
 </div>
</div>
<script type="text/javascript">
 
</script>
<?php
}
?>
 
<input type="hidden" name="unitqty" value="" id="unitqty">
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




