<?php 
include('../../../include/class_lib.php');
$class=new unit();
$slug=$_GET['slug'];

$rows=osd_query('osd_category',$where="",$group='');
$currentrows=count_sims_query('COUNT(CID)','P','osd_category');
?> 
 <span id="slug" data-value="<?php echo $slug;?>"></span>
 <table class="dataTable table table-bordered table-condensed table-hover table-striped">
                      <thead>
                        <tr>
                          <th style="width:10%; !Important;">ID</th>
          
                          <th>Category Name</th>
                          <th>Manage</th>
              
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      foreach($rows as $row){
                      $v1=$row['CID'];
                      $v2=$row['cat_name'];
                    $q=mysql_query("SELECT * from osd_product where p_category_id=$v1 ");
                    $qc=mysql_num_rows($q);


                      ?>
                      <tr id="list-<?php echo $v1;?>">
                        <td width="10%"><?php echo $v1;?></td>
                        <td> <div class="n1-<?php echo $v1;?>"><?php echo $v2;?></div></td>
                        <td>
                      <?php if(current_user('edit-category')):?>
                      <a  title="Edit Category" data-value="<?php echo $v1;?>" data-toggle="modal" data-original-title="Help" data-placement="bottom"  href="#edit-modal"   class="btn_update btn btn-sm btn-default minimize-box">
                      <i class="glyphicon glyphicon-edit"></i> Edit
                      </a>
                      <?php endif;?>
                    <?php if(current_user('delete-category')):?>
                     <?php if($qc==0):?>                     
                    <a title="Delete Category" id="delete_id"  data-value="<?php echo $v1; ?>" data-toggle="modal" data-original-title="del" data-placement="bottom"  href="#del-modal"   class="btn_delete btn btn-sm btn-default minimize-box">
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