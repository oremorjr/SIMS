<?php 
include('../../../include/class_lib.php');
$class=new unit();
$slug=$_GET['slug'];

$rows=osd_query('osd_page',$where='',$group='');
?> 
 <span id="slug" data-value="<?php echo $slug;?>"></span>
 <table class="dataTable table table-bordered table-condensed table-hover table-striped">
                      <thead>
                        <tr>
                          <th width="25%">ID</th>
                          <th>Page Name</th>
                          <th>Slug</th>
                          <!-- <th>Manage</th> -->
              
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      foreach($rows as $row){
                      $v1=$row['p_pageid'];
                      $v2=$row['p_pagename'];
                      $v3=$row['p_pageslug'];
                      $v4=$row['p_pagedesc'];

                    $q=mysql_query("SELECT * from osd_access where a_pageid=$v1 ");
                    $qc=mysql_num_rows($q);

                      ?>
                      <tr>
                        <td><?php echo $v1;?></td>
                        <td><div><?php echo $v2;?></div><div class="desc"><?php echo $v4;?></div></td>
                          <td><?php echo $v3;?></td>

<!--                         <td>
                      <?php if(current_user('edit-page')):?>
                      <a  data-value="<?php echo $v1;?>" data-toggle="modal" data-original-title="Help" data-placement="bottom"  href="#edit-modal"   class="btn_update btn btn-sm btn-default minimize-box">
                      <i class="glyphicon glyphicon-edit"></i> Edit
                      </a>
                      <?php endif;?>
                    <?php if(current_user('delete-page')):?>
                     <?php if($qc==0):?>                     
                    <a id="delete_id"  data-value="<?php echo $v1; ?>" data-toggle="modal" data-original-title="del" data-placement="bottom"  href="#del-modal"   class="btn_delete btn btn-sm btn-default minimize-box">
                    <i class="glyphicon glyphicon-remove"></i>
                    </a>  
                    <?php endif;?>
                      <?php endif;?>

                        </td>
 -->

                      </tr>
                      <?php
                      }
                      ?>
 
 
                      </tbody>
					  
</table>
 

  <script type="text/javascript" src="../js/update/update-extension.js"></script>
    <script src="assets/lib/datatables/DT_bootstrap.js"></script>