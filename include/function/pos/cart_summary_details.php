<?php
require('../../db_config.php');
$connect=new DB();
$empid=$_REQUEST['empid'];
 $mode=$_REQUEST['mode'];
$tid=$_REQUEST['tid'];
$CID=$_REQUEST['CID'];
$current_tid=$tid;
$tdid=get_receipt_no($tid);
$cart1=cart_total_mode($tdid, 0, $mode);
// mysql_query("UPDATE osd_transaction SET t_amount_t='$cart1' WHERE TID=$tid ");

?>
 <div>
 <?php
$t1=transaction('t_amount_t', $tid);
// echo $t1;
 ?></div>
 <table class=" table table-bordered table-condensed table-hover table-striped col-lg-12"   >
 <thead>
 <th colspan="2"><h4>Delivery Details</h4></th>
 </thead>

 <tr>
 	<td width="20%"><label class="c1">Terms</label></td>
 	<td>
 	<?php $COD=transaction('t_COD', $current_tid); ?>
 	<input type="text" id="COD" class="form-control" value="<?php echo $COD;?>">
 	</td>
 </tr>


 <tr>
 	<td width="20%"><label class="c1">Driver</label></td>
 	<td>
 	<select id="driver">
 	<?php
 	 
 	$dID=pabs_query('t_driver', 'osd_transaction','TID',$current_tid);
 	$d_fname=pabs_query('d_firstname', 'osd_driver','d_driverID',$dID);
 	$d_lname=pabs_query('d_lastname', 'osd_driver','d_driverID',$dID);
 	echo '<option value="'.$dID.'">'.$d_fname.' '.$d_lname.'</option>'; 


 	$drivers=osd_query('osd_driver',$where="", $group="");
 	foreach($drivers as $driver){
 	$d_id=$driver['d_driverID'];
 	$dname=$driver['d_firstname'].' '.$driver['d_lastname'];
 	echo '<option value='.$d_id.'>'.$dname.'</option>';
 	}
 	?>
 	</select>
 	</td>
 </tr>
  <tr>
 	<td><label class="c1">Agent  </label></td>
 	<td>
 	<?php ?>
 	 
 	<select   id="agent" class="form-control">
 
 	<?php



 	
	


 	$c_agent=pabs_query('t_agent', 'osd_transaction','TID',$current_tid);
 	$agent_fname=pabs_query('a_firstname', 'osd_agent','a_agentID',$c_agent);
 	$agent_lname=pabs_query('a_lastname', 'osd_agent','a_agentID',$c_agent);
 	

	 if($c_agent>0){
	 	// echo '<option value="'.$c_agent.'">'.$agent_fname.' '.$agent_lname.'</option>'; 

 	 }
 	

 	$cust_agent=pabs_query('c_agentID', 'osd_customer','CID',$CID);
 	 $cust_agent_name=get_agent_name($cust_agent);

 echo '<option value="'.$cust_agent.'">'.$cust_agent_name.'</option>'; 
  




 	$agents=osd_query('osd_agent',$where="", $group="");
 	foreach($agents as $agent){
 	$a_id=$agent['a_agentID'];
 	$aname=$agent['a_firstname'].' '.$agent['a_lastname'];
 	// echo '<option value='.$a_id.'>'.$aname.'</option>';
 	}
 	?>
 	</select>
 	</td>
 </tr>
   <tr>
 	<td><label class="c1">Truck</label></td>
 	<td>
 	<select  id="truck">
 	<?php


 	$t_ID=pabs_query('t_truck', 'osd_transaction','TID',$current_tid);
 	$t_name=pabs_query('t_truckNo', 'osd_truck','t_truckID',$t_ID); 
 	echo '<option value="'.$t_ID.'">'.$t_name.'</option>';  


 	$trucks=osd_query('osd_truck',$where="", $group="");
 	foreach($trucks as $truck){
 	$t_id=$truck['t_truckID'];
 	$tname=$truck['t_truckNo'];
 	echo '<option value='.$t_id.'>'.$tname.'</option>';
 	}
 	?>
 	</select>
 	</td>
 </tr>
    <tr>
 	<td><label class="c1">Checker</label></td>
 	<td>
 	<select   id="checker">
 	<?php


 	$c_ID=pabs_query('t_checker', 'osd_transaction','TID',$current_tid);
 	$c_fname=pabs_query('c_firstname', 'osd_checker','c_checkerID',$c_ID);
 	$c_lname=pabs_query('c_lastname', 'osd_checker','c_checkerID',$c_ID);
 	echo '<option value="'.$c_ID.'">'.$c_fname.' '.$c_lname.'</option>'; 


 	$checkers=osd_query('osd_checker',$where="", $group="");
 	foreach($checkers as $checker){
 	$c_id=$checker['c_checkerID'];
 	$cname=$checker['c_firstname'].' '.$checker['c_lastname'];
 	echo '<option value='.$c_id.'>'.$cname.'</option>';
 	}
 	?>
 	</select>
 	</td>
 </tr>
 
 </table>
 
<!-- SHOW TOTAL -->
<script type="text/javascript" src="../js/pos/total.js"></script>	  
<!-- EDIT QTY --> 
<!-- DELETE -->
 
<script>
$('#driver').selectize({});
// $('#agent').selectize({});
$('#truck').selectize({});
$('#checker').selectize({});
var $select=$('#code').selectize({});

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

var control = $select[0].selectize; 

</script>