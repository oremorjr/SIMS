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
                          <th>Company Name</th>
				 
                        </tr>
                      </thead>
                      <tbody>
                        <?php $class->select_home($query);?>
 
                      </tbody>
					  
</table> 
 
  <script type="text/javascript" src="../js/update/update-extension.js"></script>
<script>
$(document).ready(function(){

$('.dataTable').dataTable({

        "bDeferRender": true   ,
 
});
 
});
</script>