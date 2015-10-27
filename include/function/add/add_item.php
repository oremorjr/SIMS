<?php
require('../../db_config.php');
$connect=new DB();
$page=$_GET['page'];
$UID=1;
switch ($page)
{
 
	
    case 'item':
		#$v1=mysql_real_escape_string($_REQUEST['f1']);
		$v2=strtoupper(mysql_real_escape_string($_REQUEST['f2']));
		$v3=strtoupper(mysql_real_escape_string($_REQUEST['f3']));
		$v5=strtoupper(mysql_real_escape_string($_REQUEST['f5']));
		$v6=strtoupper(mysql_real_escape_string($_REQUEST['f6']));
		$v4=strtoupper(mysql_real_escape_string($_REQUEST['f4']));

		$check=mysql_query("SELECT p_name from osd_product WHERE p_name='$v4' and p_brand='$v6'  ");
		$cq1=mysql_num_rows($check);
		$totalcq=$cq1;
		
		
		
		if($totalcq==0){
			$query1=mysql_query("INSERT INTO osd_product (p_name, p_category_id, p_pcode, p_desc, p_brand) VALUES ('$v4','$v2','$v3','$v5','$v6')");
			if($query1){
			$p=mysql_insert_id();
			$v1=mysql_insert_id();
			    $used=count_sims_query2('COUNT(PUID)','s','osd_product_unit','pu_product_code',$v1);
			    $currentrows=count_sims_query('COUNT(PID)','P','osd_product');

			//item list
				$checkunit_item=mysql_query("SELECT PID from osd_product where PID=$p");
				while($c_item=mysql_fetch_array($checkunit_item)){
					$pi_id=$c_item['PID'];
					$check=mysql_query("SELECT UID from osd_unit where UID NOT IN (SELECT ui_uid from osd_unit_item where ui_pid=$pi_id)"); 
					while($c_row=mysql_fetch_array($check)){
						$ui_uid=$c_row['UID'];
						mysql_query("INSERT INTO osd_unit_item (ui_pid, ui_uid) VALUES ($pi_id, $ui_uid)");
					}
				 
					
				}	
			$message="Added ".$v4;
			$category="Item";
			save_log($UID, $message, $category);		

				
				?>
				<span class="result" data-value="1">111</span>
				<span class="PID" data-value="<?php echo $p;?>"></span>
				<span class="pname" data-value="<?php echo $v4;?>"></span>
				<span class="brand" data-value="<?php echo $v6;?>"></span>
				<span class="total" data-value="<?php echo $currentrows;?>"></span>
				<div class="prep">
		 
	 	 	<?php
		 	   if(current_user('view-item')):
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
			 						
			 					
				</div>
				<?php



			}		
		}else{
			?>
			<div class="duplicate-data"><span class="result" data-value="2">Error 002 : Duplicate </span></div>
			<?php		
		}
	
		

    break;		
   







	
}



 
 

?>
 