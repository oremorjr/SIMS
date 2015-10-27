<?php
require('../../db_config.php');
$db=new DB();
$mode=$_REQUEST['mode'];
$empid=$_REQUEST['empid'];
$tid=$_REQUEST['TRID'];
if($mode==1){
$rname="SALES";
}elseif($mode==2){
$rname="RECEIVINGS";
}elseif($mode==3){
$rname="RETURN";
}

$tno=pabs_query('t_receiptno','osd_transaction','TID',$tid); 
$edit_mode=transaction('t_edit_mode', $tid);
$lupdate=transaction('t_last_update', $tid);
?>
<input type="hidden" id="RNO" value="<?php echo $tno;?>">
<input type="hidden" id="TID" value="<?php echo $tid;?>">
<h5>

<?php echo $rname;?> # <span id="temp_no" data-tno="<?php echo $tno;?>"><?php echo $tno;?></span>

<?php 
 

  
if($edit_mode==1){
echo '<span class="edit_mode">*[Draft]</span> ';
}else{
$date=transaction('t_last_update', $tid);
$s_date=date('F d, Y h:i A', strtotime($date));
echo '<span class="l_update">(Last Update : '.$s_date.'</span>)'.' <span class="saved">[Saved]</span>';	
}

 

?>

</h5>

