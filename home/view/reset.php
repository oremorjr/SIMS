<?php
// truncate osd_transaction;
// truncate osd_transaction_details;
// truncate osd_product_unit;
// truncate osd_unit_item;
// truncate osd_customer;

if(isset($_POST['resetcode'])){

$val=$_POST['code'];


if($val=='1107'){
mysql_query("truncate osd_transaction");
mysql_query("truncate osd_transaction_details");
mysql_query("truncate osd_product_unit");
mysql_query("truncate osd_unit_item"); 
mysql_query("truncate osd_account_ledger"); 
mysql_query("truncate osd_customer"); 
mysql_query("truncate osd_product"); 
mysql_query("truncate osd_category"); 
mysql_query("truncate osd_supplier"); 
mysql_query("truncate osd_unit"); 
mysql_query("truncate osd_agent");  
mysql_query("truncate osd_checker"); 
mysql_query("truncate osd_driver"); 
mysql_query("truncate osd_log"); 
mysql_query("truncate osd_truck"); 

echo 'SUCCESSFULLY RESET';

}

}
 ?>
<div class="col-lg-12">

<form name="reset" method="POST">
<div class="col-lg-6">	
<input type="password" name="code">
</div>
<div class="col-lg-6">
<input type="submit" name="resetcode" value="Reset">
</div>
</form>	
</div>
</div>