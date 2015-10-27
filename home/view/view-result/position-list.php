<?php 
include('../../../include/class_lib.php');
$class=new unit();
$slug=$_GET['slug'];

$rows=osd_query('osd_position',$where="p_posname!='Developer'",$group='');
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
                      $v1=$row['p_posid'];
                      $posname=$row['p_posname'];

                    $q=mysql_query("SELECT * from osd_access where a_posid=$v1 ");
                    $qc=mysql_num_rows($q);

                    


                      ?>
                      <tr id="list-<?php echo $v1;?>">
                        <td width="15%"><?php echo $posid;?></td>
                        <td class="n1-<?php echo $posid;?>"><?php echo $posname;?></td> 
                        <td>
                      <?php if(current_user('edit-user-group')):?>
                      <a  data-value="<?php echo $v1;?>" data-toggle="modal" data-original-title="Help" data-placement="bottom"  href="#edit-modal"   class="btn_update btn btn-sm btn-default minimize-box">
                      <i class="glyphicon glyphicon-edit"></i> Edit
                      </a>
                      <?php endif;?>
                    <?php if(current_user('delete-user-group')):?>
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
 
 
                      </tbody>
					  
</table>
 

  <script type="text/javascript" src="../js/update/update-extension.js"></script>
    <script src="assets/lib/datatables/DT_bootstrap.js"></script>