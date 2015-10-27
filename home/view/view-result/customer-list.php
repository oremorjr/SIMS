<?php 
include('../../../include/class_lib.php');
$slug=$_GET['slug'];
$class=new customer();
$query="SELECT * from osd_customer ";
?> 
<span id="slug" data-value="<?php echo $slug;?>"></span>
<table id="d1" class="dataTable table table-bordered table-condensed table-hover table-striped">
                      <thead>
                        <tr>
                          <th width="25%">ID</th>
                          <th>Comany Name</th> 
				<th>Option</th>
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
$('#d1').dataTable({
"bDeferRender": true  
});
 
});
</script>
  