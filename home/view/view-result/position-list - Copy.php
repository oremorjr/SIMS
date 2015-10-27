<?php 
include('../../../include/class_lib.php');
$class=new unit();
$slug=$_GET['slug'];

$rows=osd_query('osd_position',$where='',$group='');
?> 
 <span id="slug" data-value="<?php echo $slug;?>"></span>
 <table class="dataTable table table-bordered table-condensed table-hover table-striped">
                      <thead>
                        <tr>
                          <th width="25%">ID</th>
                          <th>Position Name</th>
                          <th>Manage</th>
              
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      foreach($rows as $row){
                      $posid=$row['p_posid'];
                      $posname=$row['p_posname'];
                      ?>
                      <tr>
                        <td><?php echo $posid;?></td>
                        <td><?php echo $posname;?></td>
                        <td><a href="#">User Role</a></td>
                      </tr>
                      <?php
                      }
                      ?>
<!--                       <?php

                      for($i=0;$i<6000;$i++){
?>
                      <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $i+2;?></td>
                      </tr>
<?php
                      }
                      ?> -->
 
                      </tbody>
					  
</table>
 

  <script type="text/javascript" src="../js/update/update-extension.js"></script>
    <script src="assets/lib/datatables/DT_bootstrap.js"></script>