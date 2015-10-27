
<?php
if(!current_user('void-p-o'))
return false;
$tid=$_GET['ID'];
?>
<div id="content">

<div class="outer">

<div class="inner">
<div class="col-lg-12" style="min-height:470px;">
<div class="row">
<div class="box">
<header>
<div class="icons">
<i class="fa fa-table"></i>
</div>
<div><h5> Void P.O Receipt # <?php echo get_receipt_no($tid);?></h5></div>
</header>

<div id="div-4" class="accordion-body collapse in body">

<div id="loading-result" >

<?php
// mysql_query("UPDATE osd_unit_item SET ui_qty='1' WHERE UIID=5");

$sql=mysql_query("SELECT * from osd_transaction where TID=$tid  and t_mode=2");
if($row=mysql_fetch_array($sql)){
$rno=$row['t_receiptno'];
$rno_c=$row['t_rno'];
$v_status=$row['t_void'];
    $v_status==0 ? $s2="Valid" : $s2="Void";
}

?>

<?php
if(isset($_POST['pw'])){




$tpass=md5($_POST['pw']);
$check=mysql_query("SELECT * from osd_users where UID='$empid' and pwd='$tpass' ");
$count=mysql_num_rows($check);
if($count==1){


	$update2=mysql_query("UPDATE osd_transaction_details SET  td_ispaid=0 , td_void=1  where td_TID=$tid");
	

	$sql3=mysql_query("SELECT * from osd_transaction_details
	INNER JOIN osd_transaction ON (t_receiptno=td_transaction_id)
	INNER JOIN osd_product ON (td_pcode=PID)
	INNER JOIN osd_unit_item ON (td_unit_id=UIID)
	INNER JOIN osd_product_unit ON (pu_unit_id=UIID)
	INNER JOIN osd_unit ON (ui_uid=UID)
	INNER JOIN osd_supplier ON (SID=t_supplier_id)
	where TID='$tid'  and td_mode=2 group by pu_unit_id  ");
	while($row3=mysql_fetch_array($sql3)){
	 $dt = date('Y-m-d H:i:s');
	$tdid=$row3['TDID'];
	$uid=$row3['td_unit_id'];
	$qty=$row3['td_qty'];
	$mode=4;
	$pcode=$row3['td_pcode'];
	$supid=$row3['SID'];
	$price=$row3['ui_supplier_price'];
	$reason=$_POST['void_reason'];
	$trno=$row3['td_transaction_id'];

	$update=mysql_query("UPDATE osd_transaction SET  t_paid=0 , t_void=1, void_reason='$reason' where TID=$tid");

	$insert=mysql_query("INSERT INTO osd_product_unit (p_transno, pu_raw_price, p_supplier_unit_id, pu_product_code, pu_unit_id, pu_qty, pu_stocks, pu_datepurchased, pu_remarks, pu_status) VALUES ('$trno', '$price','$supid', '$pcode','$uid', '$qty','$qty','$dt','$mode',1)")or die(mysql_error());
	$update2=mysql_query("UPDATE osd_transaction_details SET  td_ispaid=0 and td_void=1 where TDID=$tdid");
	$update_stock=mysql_query("UPDATE osd_unit_item SET ui_stocks=ui_stocks-$qty WHERE UIID=$uid");
	}
	?>
	<script>
	window.location='?page=transaction-log&m=2';
	</script>
	<?php
	 

}else{
echo '<div class="alert alert-warning" role="alert"> VOID Declined</div>';

}

}

?>



<div class="receipt_area col-lg-12">                
</div>


<?php
if($v_status==0){

 
?>


<form method="post" onsubmit="return confirm('Are you sure you want to delete this case?');">
<table class="dataTable table-bordered table-condensed table-hover table-striped" width="100%" border=1>
<tr>
<td colspan="10"><textarea name="void_reason" placeholder="Void Reason" class="form-control"></textarea></td>
</tr>
	<tr>
	<td width="180">
		
			<input type="password" name="pw" class="form-control">
		

	</td>
	<td>
		<input type="submit" value="Void" class="btn btn-danger" style="padding: 6px 12px;">
	</td>
</tr>
	</table>
</form>

<?php
}else{
?>
Transaction is already VOID
<?php


}
?>

</div>
</div> 

<!-- end Results-->

</div><!-- /.box -->
</div><!-- /.row -->
</div><!-- /.col -->


</div>
<!-- end .inner -->
</div>
<!-- end .outer -->
</div>
<!-- end #content -->	  
 

<link rel="stylesheet" href="assets/css/print.css">

 <script type="text/javascript">
$(document).ready(function(){

var TID="<?php echo $tid;?>";
show_recv_receipt(TID);



});
 </script>