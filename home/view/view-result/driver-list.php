<?php 
include('../../../include/class_lib.php');
$class=new unit();
$slug=$_GET['slug'];

$rows=osd_query('osd_driver',$where="d_driverID!=0 ORDER BY d_driverID DESC",$group='');
$currentrows=count_sims_query('COUNT(d_driverID)','P','osd_driver')+1;
?> 
 <span id="slug" data-value="<?php echo $slug;?>"></span>
 <table class="dataTable table table-bordered table-condensed table-hover table-striped">
                      <thead>
                        <tr>
                          <th style="width:10%; !Important;">ID</th>
          
                          <th>Driver Name</th>
                          <th>Manage</th>
              
                        </tr>
                      </thead>
                      <tbody>
                      <?php

                      foreach($rows as $row){
                        $currentrows--;
                      $v1=$row['d_driverID'];
                      $v2=$row['d_firstname'];
                      $v3=$row['d_lastname'];
                      $v4=$row['d_contact_num'];
                      $v5=$row['d_address'];
                    $q=mysql_query("SELECT * from osd_transaction where t_driver=$v1 ");
                    $qc=mysql_num_rows($q);


                      ?>
                      <tr id="list-<?php echo $v1;?>">
                        <td width="10%"><?php echo $currentrows;?></td>
                        <td><div><span  class="n1-<?php echo $v1;?>"><?php echo $v2;?></span> <span  class="n2-<?php echo $v1;?>"><?php echo $v3;?></span></div><div class="sub n3-<?php echo $v1;?> "><?php echo $v4;?></div><div class="sub n4-<?php echo $v1;?>"><?php echo $v5;?></div></td>
                        <td>
                      <?php if(current_user('edit-driver')):?>
                      <a  data-value="<?php echo $v1;?>" data-toggle="modal" data-original-title="Help" data-placement="bottom"  href="#edit-modal"   class="btn_update btn btn-sm btn-default minimize-box">
                      <i class="glyphicon glyphicon-edit"></i> Edit
                      </a>
                      <?php endif;?>
                    <?php if(current_user('delete-driver')):?>
                     <?php if($qc==0):?>                     
                    <a id="delete_id"  data-value="<?php echo $v1; ?>" data-toggle="modal" data-original-title="del" data-placement="bottom"  href="#del-modal"   class="btn_delete btn btn-sm btn-default minimize-box">
                    <i class="glyphicon glyphicon-remove"></i>
                    </a>  
                    <?php endif;?>
                      <?php endif;?>

                        </td>
                       
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
<!--  <div class="row-count"><?php echo $currentrows;?> record/s</div> -->

  <script type="text/javascript" src="../js/update/update-extension.js"></script>
    <script src="assets/lib/datatables/DT_bootstrap.js"></script>