<?php 
include('../../../include/class_lib.php');
$class=new unit();
$slug=$_GET['slug'];

$rows=osd_query('osd_driver',$where="",$group='');
?> 
 <span id="slug" data-value="<?php echo $slug;?>"></span>
 <table class="dataTable table table-bordered table-condensed table-hover table-striped">
                      <thead>
                        <tr>
                          <th style="width:10%; !Important;">ID</th>
                          <th>Name</th>
                          <th>Address</th>
              
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      foreach($rows as $row){
                      $v1=$row['d_driverID'];
                      $v2=$row['d_firstname'];
                      $v3=$row['d_lastname'];
                      $v4=$row['d_address'];
                      $v5=$row['d_contact_num'];
                      ?>
                      <tr>
                        <td><?php echo $v1;?></td>
                        <td><div><?php echo $v2.' '.$v3;?></div><div class="sub"><?php echo $v5;?></div></td>
                        <td><?php echo $v4;?></td>
                       
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