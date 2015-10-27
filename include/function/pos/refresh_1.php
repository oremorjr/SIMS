<?php
require('../../db_config.php');
$db=new DB();
$mode=$_REQUEST['mode'];
$empid=get_employeee_id();
$new=$_REQUEST['new_tno'];
if($mode==1){
$rname="SALES";
}elseif($mode==2){
$rname="P.O";
}elseif($mode==3){
$rname="RETURN";
}
$tno=0;
 

$y=date('Y');
$m=date('m');


$checkno=mysql_query("SELECT TID,t_receiptno,t_payment,t_customer_id  from osd_transaction where t_empid='$empid' and t_active=1 and t_mode=$mode");
$count=mysql_num_rows($checkno);
if($count==0){
	if($new==1):
	$rno=mysql_query("SELECT COUNT(TID) as tid from osd_transaction where t_mode=$mode and t_month=$m and t_year=$y ");
	while($rno1=mysql_fetch_array($rno)){
		$rid=$rno1['tid']+1;
	}
	$tno2=str_pad($rid, 5, "0", STR_PAD_LEFT);
	$tno=$y.'-'.$m.'-'.$tno2;

	$search_duplicate=mysql_query("SELECT TID from osd_transaction WHERE t_receiptno='$tno' and t_mode='$mode' ");
	$count1=mysql_num_rows($search_duplicate);

	if($count1==0):
	$query=mysql_query("INSERT INTO osd_transaction(t_year, t_month, t_receiptno, t_empid, t_mode, t_series) values('$y', '$m', '$tno','$empid','$mode', $rid) ");	
	$tid=mysql_insert_id();

	else:
	$tno2=str_pad($rid+1, 5, "0", STR_PAD_LEFT);
	$tno=$y.'-'.$m.'-'.$tno2;
	$b=$rid+1;

	$query=mysql_query("INSERT INTO osd_transaction(t_year, t_month, t_receiptno, t_empid, t_mode, t_series) values('$y', '$m', '$tno','$empid','$mode', $b) ");	
	$tid=mysql_insert_id();
	endif;


	endif;

}else{
	while($rno1=mysql_fetch_array($checkno)){

 
	$tno=$rno1['t_receiptno'];
	 

	$tid=$rno1['TID'];
	$money=$rno1['t_payment'];
	$cid=$rno1['t_customer_id'];
	$GLOBALS['transID']=$tid;

	}
}

 

if($tno!=0):
 
?>
<!--  <div class="new_tno">
<a href="#" id="cancel_tno" class="btn btn-danger"  ><i class="glyphicon glyphicon-remove"></i> Cancel Transaction</a>
</div> -->
<input type="hidden" id="RNO" value="<?php echo $tno;?>">
<input type="hidden" id="TID" value="<?php echo $tid;?>">
<input type="hidden" id="money" value="<?php echo $money;?>">
<input type="hidden" id="c_cid" value="<?php echo $cid;?>">
<h5><?php echo $rname;?> # <span id="temp_no" data-tno="<?php echo $tno;?>"><?php echo $tno;?></span></h5>
 <script>
$(".toolbar").show();
</script>
 <?php
 else:
?>
<div class="new_tno">
<a href="#" id="newTNO" class="btn btn-success"  ><i class="glyphicon glyphicon-plus"></i> New Transaction</a>
</div>
<script>
$(".toolbar").hide();
</script>
<?php
endif;


if($new==2){
mysql_query("DELETE FROM osd_transaction_details where  td_transaction_id='$tno' and td_mode=$mode ");
mysql_query("DELETE FROM osd_transaction where t_empid='$empid' and t_active=1 and t_mode=$mode ");


}


 ?>

