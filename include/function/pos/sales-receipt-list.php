<?php
require('../../db_config.php');
$connect=new DB();
$receipt=$_REQUEST['RNO'];
$year=$_REQUEST['year'];
 
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
 <th>Options</th>
 </thead>
 <?php
$receipts=mysql_query("SELECT * from osd_transaction INNER JOIN osd_customer ON (t_customer_id=CID) where (t_receiptno='$receipt'   )  and t_mode=1 and YEAR(t_transaction_date)='$year'   ");
while($row=mysql_fetch_array($receipts)):
$receiptno=$row['t_receiptno'];
$TID=$row['TID'];
$empid=$row['t_empid'];
$customerID=$row['t_customer_id'];
$transdate=$row['t_trans_date'];
$td=date('F d, Y h:i A', strtotime($transdate));
$customername=pabs_query('c_firstname','osd_customer','CID',$customerID);
$empname=get_employee_name($empid);

$status=$row['t_active'];

 ?>
<tr>
<td><?php  edit_sales_receipt($TID, $customerID);?> <a target="_blank" href="?page=view-receipt&ID=<?php echo $customerID?>&TID=<?php echo $TID;?>"><?php echo $receiptno;?></a></td>
<td><?php echo $customername;?></td>
<td><?php echo $td;?></td>
<td><?php echo $empname;?></td>
<td><?php    echo $status==0 ? 'Completed' :  'Draft' ;?></td>
 <td class="none"><?php customer_options($TID, $customerID);?> </td>
</tr>
<?php
endwhile;
?>
 </table>
</div>


  <script type="text/javascript" src="../js/update/update-extension.js"></script>
    <script src="assets/lib/datatables/DT_bootstrap.js"></script>