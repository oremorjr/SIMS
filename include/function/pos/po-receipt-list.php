<?php
require('../../db_config.php');
$connect=new DB();
$receipt=$_REQUEST['RNO'];
 
?>
<div class="clear"></div>
<div class="col-lg-12 grid">
<h1>Result</h1>
</div>
<hr>
<div class="col-lg-12 grid">
 <table class="dataTable table table-bordered table-condensed table-hover table-striped">
 <thead>
 <th>Receipt No.</th>
 <th>Customer</th>
 <th>Date</th>
 <th>Processed by</th>
 <th>Status</th>
  <th>Last Update</th>
 </thead>
 <?php
$receipts=mysql_query("SELECT * from osd_transaction where t_receiptno LIKE '%$receipt%'  and t_mode=2   ");
while($row=mysql_fetch_array($receipts)):
$receiptno=$row['t_receiptno'];
$TID=$row['TID'];
$empid=$row['t_empid'];
$customerID=$row['t_supplier_id'];
$transdate=$row['t_trans_date'];
$td=date('F d, Y h:i A', strtotime($transdate));
$customername=pabs_query('sup_name','osd_supplier','SID',$customerID);
$empname=get_employee_name($empid);

 

$status=$row['t_active'];
$void=$row['t_void'];
$edit=$row['t_edit_mode'];
$editor=$row['t_edited_by'];
$update=date('F d, Y h:i A', strtotime($row['t_last_update']));
$emp=get_employee_name($editor);
$current=get_employeee_id();
 ?>
<tr>

<td>
<?php if(($edit==0) || ($editor==$current)):?>
<a href="?page=edit-pos-receivings&ID=<?php echo $customerID?>&TID=<?php echo $TID;?>"><?php echo $receiptno;?></a>
<?php else:?>
<?php echo $receiptno;?> <i class="glyphicon glyphicon-pencil"></i>...	
<?php endif;?>
</td>

 
<td><?php echo $customername;?></td>
<td><?php echo $td;?></td>
<td><?php echo $empname;?></td>
<td><?php    echo $status==0 ? 'Completed' :  'Draft' ;?><?php    echo $void==0 ? '' :  '/Void' ;?></td>
 <td>
<?php 
if($edit!=0):
?>
<div>ongoing...</div>
<div class="sub"><?php if($editor!=0): echo ' ('.$emp.')'; endif;?></div>
<?php
else:
echo $update;
?>
<?php ?>
<?php
endif;?>
</td>
</tr>
<?php
endwhile;
?>
 </table>
</div>


  <script type="text/javascript" src="../js/update/update-extension.js"></script>
    <script src="assets/lib/datatables/DT_bootstrap.js"></script>