<?php 
include('../../../include/class_lib.php');
$slug=$_GET['slug'];
$class=new customer();
$query="SELECT * from osd_customer ";
?> 
<span id="slug" data-value="<?php echo $slug;?>"></span>
<table class="dataTable table table-bordered table-condensed table-hover table-striped">
                      <thead>
                        <tr>
                        
                          <th>Company Name</th> 
			 
                        </tr>
                      </thead>
                      <tbody>
                        <?php $class->home_customer($query);?>
 
                      </tbody>
					  
</table> 
 
  <script type="text/javascript" src="../js/update/update-extension.js"></script>
    <script  >
$(document).ready(function(){

$('.dataTable').dataTable({

        "bDeferRender": true   ,
 
});
 
});

    </script>
  