<?php 
include('../../../include/class_lib.php');
$slug='supplier';
$class=new supplier();
$query="SELECT * from osd_supplier";
?> 
<span id="slug" data-value="<?php echo $slug;?>"></span>
<table class="dataTable table table-bordered table-condensed table-hover table-striped">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Company Name</th>
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