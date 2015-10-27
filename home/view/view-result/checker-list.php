<?php 
include('../../../include/class_lib.php');
$class=new unit();
$slug=$_GET['slug'];

$rows=osd_query('osd_checker',$where="c_checkerID!=0 ORDER BY c_checkerID DESC",$group='');
$currentrows=count_sims_query('COUNT(c_checkerID)','P','osd_checker')+1;
?> 
 <span id="slug" data-value="<?php echo $slug;?>"></span>
 <table class="dataTable table table-bordered table-condensed table-hover table-striped">
                      <thead>
                        <tr>
                          <th style="width:10%; !Important;">ID</th>
          
                          <th>Checker Name</th>
                          <th>Manage</th>
              
                        </tr>
                      </thead>
                      <tbody>
                      <?php

                      foreach($rows as $row){
                        $currentrows--;
                      $v1=$row['c_checkerID'];
                      $v2=$row['c_firstname'];
                      $v3=$row['c_lastname'];
                    $q=mysql_query("SELECT * from osd_transaction where t_checker=$v1 ");
                    $qc=mysql_num_rows($q);


                      ?>
                      <tr id="list-<?php echo $v1;?>">
                        <td><?php echo $currentrows;?></td>
                        <td ><span class="n1-<?php echo $v1;?>"><?php echo $v2;?></span> <span class="n2-<?php echo $v1;?>"><?php echo $v3;?></span></td>
                        <td>
                      <?php if(current_user('edit-checker')):?>
                      <a  data-value="<?php echo $v1;?>" data-toggle="modal" data-original-title="Help" data-placement="bottom"  href="#edit-modal"   class="btn_update btn btn-sm btn-default minimize-box">
                      <i class="glyphicon glyphicon-edit"></i> Edit
                      </a>
                      <?php endif;?>
                    <?php if(current_user('delete-checker')):?>
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