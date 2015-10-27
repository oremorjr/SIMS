<?php
require('../../db_config.php');
$connect=new DB();
$mode=$_GET['page'];
	$dt=date('Y-m-d H:i:s');
	switch ($mode){

		case 'setting':
		$cname=$_REQUEST['company_name'];
		$setting=mysql_query("UPDATE osd_setting SET company_name='$cname' ");
		break;
		case 'customer':
		$tblname='osd_customer';
		$id=$_REQUEST['ID'];
		$f2=$_REQUEST['f2'];
		$f3=$_REQUEST['f3'];
		$f4=$_REQUEST['f4'];
		$f5=$_REQUEST['f5'];
		$f6=$_REQUEST['f6'];
		$f7=$_REQUEST['f7'];
		$f8=$_REQUEST['f8'];
		$f9=$_REQUEST['f9'];
		$f10=$_REQUEST['f10'];
		$f11=$_REQUEST['f11'];
		$f12=$_REQUEST['f12'];
		$query1=mysql_query("UPDATE $tblname SET `c_lastname`='".$f2."',`c_firstname`='".$f3."',`c_email`='$f4',`c_contact_no`='$f5',`c_address1`='$f6',
		`c_address2`='$f7',`c_city`='$f8',`c_state`='$f9',`c_zip`='$f10',`c_country`='$f11',`c_account_no`='$f12' where CID=$id  ");
			if($query1){
				$return['res']=1;
			}			
		break;
		case 'category':
		$id=$_REQUEST['ID'];
		$f1=$_REQUEST['f1'];
		$check=mysql_query("SELECT * from osd_category where cat_name='$f1'");
		$count=mysql_num_rows($check);
		if($count==0){
		$query=mysql_query("UPDATE osd_category SET cat_name='$f1' where CID='$id' ");
			if($query){
				$return['res']=1;
			}else{
				$return['res']=3;
			}	
		}else{
			$return['res']=2;
		}
		break;	
		case 'unit':
		$tb='osd_unit';
		$id=$_REQUEST['ID'];
		$f1=$_REQUEST['f1'];
		$f2=$_REQUEST['f2'];
		$check=mysql_query("SELECT * from $tb where u_name='$f1'");
		$count=mysql_num_rows($check);
		if($count!=-1){
		$query=mysql_query("UPDATE $tb SET u_name='$f1', u_symbol='$f2' where UID='$id' ");
			if($query){
				$return['res']=1;
			}else{
				$return['res']=3;
			}	
		}else{
			// $return['res']=2;
		}
		break;	
		case 'item':
		$tb='osd_product';
		$id=$_REQUEST['ID']; 
		$f2=$_REQUEST['f2'];
		$f3=$_REQUEST['f3'];
		$f4=$_REQUEST['f4'];
		$f5=$_REQUEST['f5'];
		$f6=$_REQUEST['f6'];
		$check=mysql_query("SELECT * from $tb where p_name='$f4' and p_pcode='$f3'");
		$count=mysql_num_rows($check);
		 
		$query=mysql_query("UPDATE $tb SET  p_category_id='$f2', p_name='$f4', p_pcode='$f3', p_desc='$f5', p_brand='$f6' where PID='$id' ");
			if($query){
				$return['res']=1;
			}else{
				$return['res']=3;
			}	
		 
		break;		

		case 'supplier':
		$tblname='osd_supplier';
		$id=$_REQUEST['ID'];
		$f2=$_REQUEST['f2'];
		$f3=$_REQUEST['f3'];
		$f4=$_REQUEST['f4'];
		$f5=$_REQUEST['f5'];
		$f6=$_REQUEST['f6'];
		$f7=$_REQUEST['f7'];
		$f8=$_REQUEST['f8'];
		$f9=$_REQUEST['f9'];
		$f10=$_REQUEST['f10'];
		$f11=$_REQUEST['f11'];
		$f12=$_REQUEST['f12'];
		$f13=$_REQUEST['f13'];
		$query1=mysql_query("UPDATE $tblname SET `sup_last_name`='$f2',`sup_first_name`='$f3',`sup_email`='$f4',`sup_contact_no`='$f5',`sup_address1`='$f6',
		`sup_address2`='$f7',`sup_city`='$f8',`sup_state`='$f9',`sup_zip`='$f10',`sup_country`='$f11',`sup_account_no`='$f12', sup_name='$f13' where SID=$id  ");
			if($query1){
				$return['res']=1;
			}			
		break;

		case 'item-unit':
		$tblname='osd_unit_item';
		$id=$_REQUEST['ID'];
		$count=count($_REQUEST['count']);
 
 
			for($i=0;$i<=$count;$i++){
				$status=$_REQUEST['status_'.$i];
				$check=$_REQUEST['f_'.$i]; 
				if($check==1){
				$query1=mysql_query("UPDATE $tblname SET  ui_status='1' where UIID=$status"); 
				}else{
				$query1=mysql_query("UPDATE $tblname SET  ui_status='0' where UIID=$status"); 
				}
				
			}
			if($query1){
				$return['res']=1;
			}
			
		break;
		
	}
 
echo json_encode($return);
 
?>