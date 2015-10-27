 
<?php 
include('../../../include/db_config.php');
$connect=new DB();
$slug='item';
$receipt=$_REQUEST['RNO'];
$rows=sims_query('PID, p_name, p_pcode, p_brand', 'osd_product',$where="p_name LIKE '%$receipt%'",$group='');

$currentrows=count_sims_query('COUNT(PID)','P','osd_product');



	
?> 
<div class="col-lg-12 grid-2">
<span id="slug" data-value="<?php echo $slug;?>"></span> 
 <table id="d1" class="dataTable table table-bordered table-condensed table-hover table-striped">
                      <thead>
                        <tr>
                          <th width="10%">ID</th>
						  <th>Item Description</th>
						  <th>Option</th>
						 
                        </tr>
                      </thead>
                      <tbody id="item-list">
                      <?php
                      foreach($rows as $row){
                      $v1=$row['PID'];
                      $v2=$row['p_name'];
                      $v4=$row['p_brand'];
                      $v3=$row['p_pcode'];
                   $qc=0;
                $used=count_sims_query2('COUNT(PUID)','s','osd_product_unit','pu_product_code',$v1);
                
                    // $qc=mysql_num_rows($q);


                      ?>
                      <tr id="list-<?php echo $v1;?>">
                       <td width="10%"><?php echo $v1;?></td>
                        <td>
                        	<div class="n1-<?php echo $v1;?>"><?php echo $v4.' '.$v2;?></div>
                        	<div class="sub n2-<?php echo $v1;?>"><?php echo $v3;?></div>

                        </td>
		  <td>
	 	 	<?php
		 	   if(current_user('view-product-details')):
		 	?>
			<a  href="?page=view-product-list&PID=<?php echo $v1;?>" class=" btn btn-sm btn-default minimize-box">
				<i class="glyphicon glyphicon-list-alt"></i> 
			</a>
			<?php
		 	endif;
			?>

			<?php
			  if(current_user('set-item-unit')):
			?>
			<a   data-value="<?php echo $v1; ?>" data-toggle="modal" data-original-title="unit" data-placement="bottom"  href="#unit-modal"   class="btn_unit btn btn-sm btn-default minimize-box">
			<i class="glyphicon glyphicon-wrench"></i> 
			</a> 	
			<?php
			 endif;
			?>

		 					   
			 <?php
			 if(current_user('edit-item')):
			 ?>
			<a  data-value="<?php echo $v1; ?>" data-toggle="modal" data-original-title="Help" data-placement="bottom"  href="#edit-modal"   class="btn_update btn btn-sm btn-default minimize-box">
				<i class="glyphicon glyphicon-edit"></i> 
			</a> 
			<?php
			 endif;
			?>

			<?php
			 
			?>
			 <?php
			if(current_user('delete-item')):
			 if($used==0):
			 ?>
			<a id="delete_id"  data-value="<?php echo $v1; ?>" data-toggle="modal" data-original-title="del" data-placement="bottom"  href="#del-modal"   class="btn_delete btn btn-sm btn-default minimize-box">
				<i class="glyphicon glyphicon-remove"></i> 
			</a>	

			<?php
			 
			 endif;
			 endif;
			?> 					
			 						
			</td>	
                       
                      </tr>
                      <?php
                      }
                      ?>
 
 
 
                      </tbody>
					  
</table> 
 
  </div>

<script type="text/javascript" src="../js/update/update-extension.js"></script>
<script src="assets/lib/datatables/jquery.dataTables.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$('#d1').dataTable({
"bDeferRender": true  
});
 
});
</script>  