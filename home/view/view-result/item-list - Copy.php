<?php 
include('../../../include/class_lib.php');
$slug='item';
$class=new product();
$query="SELECT * from osd_product";
				//item list
				$checkunit_item=mysql_query("SELECT * from osd_product");
				while($c_item=mysql_fetch_array($checkunit_item)){
					$pi_id=$c_item['PID'];
					$check=mysql_query("SELECT * from osd_unit where UID NOT IN (SELECT ui_uid from osd_unit_item where ui_pid=$pi_id)"); 
					while($c_row=mysql_fetch_array($check)){
						$ui_uid=$c_row['UID'];
						mysql_query("INSERT INTO osd_unit_item (ui_pid, ui_uid) VALUES ($pi_id, $ui_uid)");
					}
				 
					
				}	
?> 
<span id="slug" data-value="<?php echo $slug;?>"></span>
 <table class="dataTable table table-bordered table-condensed table-hover table-striped">
                      <thead>
                        <tr>
                          <th width="10%">ID</th>
						  <th>Name</th>
						  <th>Manage</th>
						 
                        </tr>
                      </thead>
                      <tbody>
                        <?php $class->select($query);?>
 
                      </tbody>
					  
</table>
<div>Total : <?php echo $class->t_count;?> <?php echo  $slug.plural($class->t_count);?> found</div>
	<script type="text/javascript" src="../js/update/update-extension.js"></script>
    <script src="assets/lib/datatables/DT_bootstrap.js"></script>

  