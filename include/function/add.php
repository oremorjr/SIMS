<?php
require('../db_config.php');
$connect=new DB();
$page=$_GET['page'];

switch ($page)
{
    case 'supplier':
		$v1=mysql_real_escape_string($_REQUEST['f1']);
		$v2=stripslashes($_REQUEST['f2']);
		$v3=stripslashes($_REQUEST['f3']);
		$v4=stripslashes($_REQUEST['f4']);
		$v5=stripslashes($_REQUEST['f5']);
		$v6=stripslashes($_REQUEST['f6']);
		$v7=stripslashes($_REQUEST['f7']);
		$v8=stripslashes($_REQUEST['f8']);
		$v9=stripslashes($_REQUEST['f9']);
		$v10=stripslashes($_REQUEST['f10']);
		$v11=stripslashes($_REQUEST['f11']);
		$v12=stripslashes($_REQUEST['f12']);
		
		$check=mysql_query("SELECT * from osd_supplier WHERE sup_name='$v1'");
		$cq1=mysql_num_rows($check);
		
		if($cq1==0){
			$query1=mysql_query("INSERT INTO osd_supplier (`sup_name`,  `sup_last_name`, `sup_first_name`, `sup_email`, `sup_contact_no`, `sup_address1`, `sup_address2`, `sup_city`, `sup_state`, `sup_zip`, `sup_country`, `sup_account_no`) 
			VALUES ('$v1','$v2','$v3','$v4','$v5', '$v6', '$v7', '$v8', '$v9', '$v10', '$v11', '$v12')");
			if($query1){
				$sid=mysql_insert_id();
				$code = str_pad($sid, 8, "0", STR_PAD_LEFT);
				$supcode='S-'.$code;
				$query2=mysql_query("UPDATE osd_supplier SET sup_code='$supcode' where SID='$sid'");
				$return['res']=1;
				$return['fname']=$v1;
			}		
		} 

    break;
	
    case 'customer':
		//$v1=mysql_real_escape_string($_REQUEST['f1']);
		$v2=stripslashes($_REQUEST['f2']);
		$v3=stripslashes($_REQUEST['f3']);
		$v4=stripslashes($_REQUEST['f4']);
		$v5=stripslashes($_REQUEST['f5']);
		$v6=stripslashes($_REQUEST['f6']);
		$v7=stripslashes($_REQUEST['f7']);
		$v8=stripslashes($_REQUEST['f8']);
		$v9=stripslashes($_REQUEST['f9']);
		$v10=stripslashes($_REQUEST['f10']);
		$v11=stripslashes($_REQUEST['f11']);
		$v12=stripslashes($_REQUEST['f12']);
		
		$check=mysql_query("SELECT * from osd_customer WHERE c_lastname='$v2' and c_firstname='$v3' ");
		$cq1=mysql_num_rows($check);
		
		if($cq1==0){
			$query1=mysql_query("INSERT INTO osd_customer (`c_lastname`, `c_firstname`, `c_email`, `c_contact_no`, `c_address1`, `c_address2`, `c_city`, `c_state`, `c_zip`, `c_country`, `c_account_no`) 
			VALUES ('$v2','$v3','$v4','$v5', '$v6', '$v7', '$v8', '$v9', '$v10', '$v11', '$v12')");
			if($query1){
				$return['res']=1;
				$return['fname']=$v2.' '.$v3;
			}		
		}else{
				$return['res']=2;
		}

    break;			
	
    case 'category':
		$v1=mysql_real_escape_string($_REQUEST['f1']);
		$check=mysql_query("SELECT * from osd_category WHERE cat_name='$v1'");
		$cq1=mysql_num_rows($check);
		
		if($cq1==0){
			$query1=mysql_query("INSERT INTO osd_category (cat_name) VALUES ('$v1')");
			if($query1){
				$return['res']=1;
			}		
		}else{
				$return['res']=2;
		}

    break;	
	
    case 'item':
		#$v1=mysql_real_escape_string($_REQUEST['f1']);
		$v2=strtoupper(mysql_real_escape_string($_REQUEST['f2']));
		$v3=strtoupper(mysql_real_escape_string($_REQUEST['f3']));
		$v5=strtoupper(mysql_real_escape_string($_REQUEST['f5']));
		$v6=strtoupper(mysql_real_escape_string($_REQUEST['f6']));
		$v4=strtoupper(mysql_real_escape_string($_REQUEST['f4']));

		$check=mysql_query("SELECT p_name from osd_product WHERE p_name='$v4' and p_brand='$v6' ");
		$cq1=mysql_num_rows($check);
		$totalcq=$cq1;
		
		
		
		if($totalcq==0){
			$query1=mysql_query("INSERT INTO osd_product (p_name, p_category_id, p_pcode, p_desc, p_brand) VALUES ('$v4','$v2','$v3','$v5','$v6')");
			if($query1){

			//item list
				$checkunit_item=mysql_query("SELECT PID from osd_product");
				while($c_item=mysql_fetch_array($checkunit_item)){
					$pi_id=$c_item['PID'];
					$check=mysql_query("SELECT UID from osd_unit where UID NOT IN (SELECT ui_uid from osd_unit_item where ui_pid=$pi_id)"); 
					while($c_row=mysql_fetch_array($check)){
						$ui_uid=$c_row['UID'];
						mysql_query("INSERT INTO osd_unit_item (ui_pid, ui_uid) VALUES ($pi_id, $ui_uid)");
					}
				 
					
				}	
				
				$return['res']=1;



			}		
		}else{
			$return['res']=2;		
		}
	
		

    break;		
    case 'product':
		$v1=mysql_real_escape_string($_REQUEST['field1']);
		$v2=mysql_real_escape_string($_REQUEST['field2']);
		$v3=mysql_real_escape_string($_REQUEST['field3']);
		$v4=strtoupper(mysql_real_escape_string($_REQUEST['field4']));
		$v5=strtoupper(mysql_real_escape_string($_REQUEST['field5']));

		$check=mysql_query("SELECT * from osd_product WHERE p_name='$v1'");
		$check2=mysql_query("SELECT * from osd_product WHERE p_pcode='$v4'");
		
		$cq1=mysql_num_rows($check);
		$cq2=mysql_num_rows($check2);
		$totalcq=$cq1+$cq2;
		
		if($totalcq==0){
			$query1=mysql_query("INSERT INTO osd_product (p_name, p_supplier_id, p_category_id, p_pcode, p_reorder_level) VALUES ('$v1','$v2','$v3','$v4','$v5')");
			if($query1){
				$return['res']=1;
				$return['fname']=$v1;
			}		
		}else{
			$error='';
			if($cq1>0){
				$error.='<li>Product name exists</li>';
			}
			if($cq2>0){
				$error.='<li>Product code exists</li>';
			}
			$return['res']=2;
			$return['status']=$error;
				
		}

    break;	
    case 'unit':
		$v1=mysql_real_escape_string($_REQUEST['f1']);
		$v2=mysql_real_escape_string($_REQUEST['f2']);
		$table='osd_unit';

		$check=mysql_query("SELECT * from $table WHERE u_name='$v1'");	
		$cq1=mysql_num_rows($check);
		
		if($cq1==0){
			$query1=mysql_query("INSERT INTO $table (u_name, u_symbol) VALUES ('$v1','$v2')");
			if($query1){
				$return['res']=1;
			}		
		}else{
				$return['res']=2;			
		}

    break;		
    case 'product-list':
		$v1=mysql_real_escape_string($_REQUEST['field1']);
		$v2=mysql_real_escape_string($_REQUEST['field2']);
		$v3=mysql_real_escape_string($_REQUEST['field3']);
		$v5 = mysql_real_escape_string($_REQUEST['field5']);
		$v6 = mysql_real_escape_string($_REQUEST['field6']);
		$v7 = mysql_real_escape_string($_REQUEST['field7']);
		$v8 = mysql_real_escape_string($_REQUEST['field8']);
		$v9 = mysql_real_escape_string($_REQUEST['field9']);
		
		$table='osd_product_unit';
			$query1=mysql_query("INSERT INTO $table (pu_unit_id, pu_product_code, pu_stocks, pu_datepurchased, pu_remarks, pu_qty, pu_raw_price, pu_price, p_supplier_unit_id) VALUES ('$v1','$v2','$v3','$v5','$v6','$v3','$v7','$v8', '$v9')");
			if($query1){
				$id=mysql_insert_id();
				$code = str_pad($id, 5, "0", STR_PAD_LEFT);
				$f_code='B-'.$code;
				$query3=mysql_query("UPDATE osd_unit_item SET ui_stocks=ui_stocks + $v3,  ui_qty=ui_qty + $v3 where UIID=$v1");			
				$query2=mysql_query("UPDATE $table SET pu_batchno='$f_code' where PUID='$id'");			
				
				$return['res']=1;
				$return['fname']="";
			}		
	break;		
    case 'unit-list':
		$v1=mysql_real_escape_string($_REQUEST['f2']);
		$v2=($_REQUEST['f1']);
		$cv2=count($_REQUEST['f1']);
		
		$table='osd_unit_item';
			//$update=mysql_query("UPDATE osd_product SET ");
			for($i=0;$i<$cv2;$i++){
			$query1=mysql_query("INSERT INTO $table (ui_pid,ui_uid) VALUES ('$v1','$v2[$i]')");
			}
			
			if($query1){
				$id=mysql_insert_id();			
				$return['res']=1;
				$return['fname']="";
			}		
	break;		
	
	
}



 

echo json_encode($return);

?>