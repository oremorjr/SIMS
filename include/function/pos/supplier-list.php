<?php
require('../../db_config.php');
$connect=new DB();
$receipt=$_REQUEST['RNO'];
 
?>
<div class="clear"></div>
<div class="col-lg-12 grid">
<h1>Suppliers</h1>
</div>
<hr>
<br>
<div class="col-lg-12 grid">
 <table class="dataTable table table-bordered table-condensed table-hover table-striped">
 <thead> 
 <th>Customer</th>
 <th>Address</th>
 </thead>
 <?php
$receipts=mysql_query("SELECT SID, sup_address1, sup_name from osd_supplier where sup_name LIKE '%$receipt%' ");
while($row=mysql_fetch_array($receipts)):
$receiptno=$row['SID'];    
$customername=$row['sup_name'];
$address=$row['sup_address1'];
 ?>
<tr>
<td><a href="?page=supplier-account-list&SID=<?php echo $receiptno;?>"><?php echo $customername;?></a></td>
<td><?php echo $address;?></td>
</tr>
<?php
endwhile;
?>
 </table>
</div>
 
    <script >

$(document).ready(function(){

$('.dataTable').dataTable({

        "bDeferRender": true   
 
});
 
});

    </script>