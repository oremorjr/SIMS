<?php 
include('../../../include/class_lib.php');
$class=new unit();
$slug=$_GET['slug'];


// $checkunit_item=mysql_query("SELECT PID from osd_product");

// while($c_item=mysql_fetch_array($checkunit_item)){
// $pi_id=$c_item['PID'];
//   $check=mysql_query("SELECT UID from osd_unit where UID NOT IN (SELECT ui_uid from osd_unit_item where ui_pid=$pi_id)"); 
//     while($c_row=mysql_fetch_array($check)){
//       $ui_uid=$c_row['UID'];
//       mysql_query("INSERT INTO osd_unit_item (ui_pid, ui_uid) VALUES ($pi_id, $ui_uid)");
//     }


// }




$query="SELECT * from osd_unit ";

?> 
 <span id="slug" data-value="<?php echo $slug;?>"></span>
 <table id="unit" class="dataTable table table-bordered table-condensed table-hover table-striped">
                      <thead>
                        <tr>
                          <th  >ID</th>
                          <th>Unit Name</th>
                          <th>Symbol</th>
                          <th>Manage</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $class->select($query);?>
 
                      </tbody>
					  
</table> 

  <script type="text/javascript" src="../js/update/update-extension.js"></script>
<script src="assets/lib/datatables/jquery.dataTables.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$('#unit').dataTable({
"bDeferRender": true  
});
 
});
</script>
