<?php
require('../../db_config.php');
$db=new DB();
$empid=$_SESSION['SESS_MEMBER_UID'];
$checkno=mysql_query("SELECT * from osd_transaction where t_empid='$empid' and t_active=1");
$count=mysql_num_rows($checkno);
if($count==0){
	$rno=mysql_query("SELECT COUNT(TID) as tid from osd_transaction");
	while($rno1=mysql_fetch_array($rno)){
		$rid=$rno1['tid']+1;
	}
	$tno=str_pad($rid, 8, "0", STR_PAD_LEFT);
	$query=mysql_query("INSERT INTO osd_transaction(t_receiptno, t_empid) values('$tno','$empid') ");	
	$tid=mysql_insert_id();
}else{
	while($rno1=mysql_fetch_array($checkno)){
	$tno=$rno1['t_receiptno'];
	$tid=$rno1['TID'];
	}
}

?>
<input type="hidden" id="RNO" value="<?php echo $tno;?>">
<input type="hidden" id="TID" value="<?php echo $tid;?>">
<h5>RNO-<span id="temp_no" data-tno="<?php echo $tno;?>"><?php echo $tno;?></span></h5>