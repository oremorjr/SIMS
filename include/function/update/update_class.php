<?php
require('../../db_config.php');
$connect=new DB();
$mode=$_GET['page'];
$UID=get_employeee_id();
	$dt=date('Y-m-d H:i:s');
	switch ($mode){

		case 'setting':
		$cname=mysql_real_escape_string($_REQUEST['company_name']);
		$setting=mysql_query("UPDATE osd_setting SET company_name='$cname' ");
		break;
		case 'customer':
		$tblname='osd_customer';
		$id=$_REQUEST['ID'];
		$f2=mysql_real_escape_string($_REQUEST['f2']);
		$f3=mysql_real_escape_string($_REQUEST['f3']);
		$f4=mysql_real_escape_string($_REQUEST['f4']);
		$f5=mysql_real_escape_string($_REQUEST['f5']);
		$f6=mysql_real_escape_string($_REQUEST['f6']);
		$f7=mysql_real_escape_string($_REQUEST['f7']);
		$f8=mysql_real_escape_string($_REQUEST['f8']);
		$f9=mysql_real_escape_string($_REQUEST['f9']);
		$f10=mysql_real_escape_string($_REQUEST['f10']);
		$f11=mysql_real_escape_string($_REQUEST['f11']);
		$f12=mysql_real_escape_string($_REQUEST['f12']);
		$f13=mysql_real_escape_string($_REQUEST['f13']);
		$query1=mysql_query("UPDATE $tblname SET `c_lastname`='".$f2."',`c_firstname`='".$f3."',`c_email`='$f4',`c_contact_no`='$f5',`c_address1`='$f6',
		`c_address2`='$f7',`c_city`='$f8',`c_state`='$f9',`c_zip`='$f10',`c_country`='$f11',`c_account_no`='$f12', `c_agentID`='$f13' where CID=$id  ");
			if($query1){
			echo '<span class="result" data-value="1"></span>';

			$message="Updated ".$f3.' '.$f2." information";
			$category="Customer";
			save_log($UID, $message, $category);

			}			
		break;




		case 'category':
		$id=$_REQUEST['ID'];
		$f1=mysql_real_escape_string($_REQUEST['f1']);
		$check=mysql_query("SELECT CID from osd_category where cat_name='$f1'");
		$count=mysql_num_rows($check);
		if($count==0){
		$query=mysql_query("UPDATE osd_category SET cat_name='$f1' where CID='$id' ");
			if($query){
			echo '<span class="result" data-value="1"></span>';
			$message="Updated ".$f1;
			$category="Category";
			save_log($UID, $message, $category);
			}
		}else{
			echo '<span class="result" data-value="2">Error 002 : Duplicate </span>';
		}
		break;	


		case 'bank':
		$id=$_REQUEST['ID'];
		$f1=$_REQUEST['f1'];
		$check=mysql_query("SELECT b_bankID from osd_bank where b_bankName='$f1'");
		$count=mysql_num_rows($check);
		if($count==0){
		$query=mysql_query("UPDATE osd_bank SET b_bankName='$f1' where b_bankID='$id' ");
			if($query){
			echo '<span class="result" data-value="1"></span>';
			$message="Updated ".$f1;
			$category="Bank";
			save_log($UID, $message, $category);
			}
		}else{
			echo '<span class="result" data-value="2">Error 002 : Duplicate </span>';
		}
		break;	






		case 'position':
		$id=$_REQUEST['ID'];
		$f1=mysql_real_escape_string($_REQUEST['f1']);

 		$check=mysql_query("SELECT p_posid from osd_position where p_posname='$f1'");
		$count=mysql_num_rows($check);
		if($count==0){
 
		$query=mysql_query("UPDATE osd_position SET p_posname='$f1' where p_posid='$id' ");
			if($query){
			echo '<span class="result" data-value="1"></span>';
			$message="Updated ".$f1;
			$category="User Group";
			save_log($UID, $message, $category);
			}
		}else{
			echo '<span class="result" data-value="2">Error 002 : Duplicate </span>';
		}

 
		break;	








		case 'transaction-type':
		$id=$_REQUEST['ID'];
		$f1=$_REQUEST['f1'];
		$check=mysql_query("SELECT tt_ID from osd_transaction_type where tt_name='$f1'");
		$count=mysql_num_rows($check);
		if($count==0){
		$query=mysql_query("UPDATE osd_transaction_type SET tt_name='$f1' where tt_ID='$id' ");
			if($query){
			echo '<span class="result" data-value="1"></span>';
			$message="Updated ".$f1;
			$category="Transaction Type";
			save_log($UID, $message, $category);
			}
		}else{
			echo '<span class="result" data-value="2">Error 002 : Duplicate </span>';
		}
		break;	



		case 'checker':
		$id=$_REQUEST['ID'];
		$f1=$_REQUEST['f1'];
		$f2=$_REQUEST['f2'];
	 
		$query=mysql_query("UPDATE osd_checker SET c_firstname='".$f1."', c_lastname='".$f2."' where c_checkerID='$id' ");
			if($query){
			echo '<span class="result" data-value="1"></span>';
			$message="Updated ".$f1;
			$category="Checker";
			save_log($UID, $message, $category);
			}
		 
		break;	



 		case 'truck':
		$id=$_REQUEST['ID'];
		$f1=$_REQUEST['f1'];
		$check=mysql_query("SELECT t_truckID from osd_truck where t_truckNo='$f1'");
		$count=mysql_num_rows($check);
		if($count==0){
		$query=mysql_query("UPDATE osd_truck SET t_truckNo='$f1' where t_truckID='$id' ");
			if($query){
			echo '<span class="result" data-value="1"></span>';
			$message="Updated ".$f1;
			$category="Truck";
			save_log($UID, $message, $category);
			}
		}else{
			echo '<span class="result" data-value="2">Error 002 : Duplicate </span>';
		}
		break;	


 		case 'driver':
		$id=$_REQUEST['ID'];
		$f1=mysql_real_escape_string($_REQUEST['f1']);
		$f2=mysql_real_escape_string($_REQUEST['f2']);
		$f3=mysql_real_escape_string($_REQUEST['f3']);
		$f4=mysql_real_escape_string($_REQUEST['f4']);
 
		$query=mysql_query("UPDATE osd_driver SET d_firstname='".$f1."', d_lastname='".$f2."', d_contact_num='".$f3."', d_address='".$f4."' where d_driverID='$id' ");
			if($query){
			echo '<span class="result" data-value="1"></span>';
			$message="Updated ".$f1;
			$category="Driver";
			save_log($UID, $message, $category);
			}

		 
		break;	

 		case 'agent':
		$id=$_REQUEST['ID'];
		$f1=mysql_real_escape_string($_REQUEST['f1']);
		$f2=mysql_real_escape_string($_REQUEST['f2']);
		$f3=mysql_real_escape_string($_REQUEST['f3']);
		$f4=mysql_real_escape_string($_REQUEST['f4']);
 
		$query=mysql_query("UPDATE osd_agent SET a_firstname='".$f1."', a_lastname='".$f2."', a_contact_num='".$f3."', a_address='".$f4."' where a_agentID='$id' ");
			if($query){
			echo '<span class="result" data-value="1"></span>';
			$message="Updated ".$f1.' '.$f2;
			$category="Agent";
			save_log($UID, $message, $category);
			}

		 
		break;	


 		case 'user':
		$id=$_REQUEST['ID'];
		$f1=mysql_real_escape_string($_REQUEST['f1']);
		$f2=mysql_real_escape_string($_REQUEST['f2']);
		$f3=mysql_real_escape_string($_REQUEST['f3']);
		$f4=mysql_real_escape_string($_REQUEST['f4']);
		$f10=mysql_real_escape_string($_REQUEST['f10']);
		$category="User";

		$f4=md5(mysql_real_escape_string($_REQUEST['f5']));

		if($_REQUEST['f5']!=""){
			mysql_query("UPDATE osd_users SET pwd='".$f4."'  where UID='$id' ");
			$message="Update the password of ".$f1.' '.$f3."'password";
			save_log($UID, $message, $category);	
		}else{
			$message2="Updated ".$f1.' '.$f3." information";	
			save_log($UID, $message2, $category);	
		}		
 
		$query=mysql_query("UPDATE osd_users SET fname='".$f1."', mname='".$f2."', lname='".$f3."', u_position='".$f10."' where UID='$id' ");

		echo '<span class="result" data-value="1"></span>';
		
		
		 
		 
		break;	


		case 'driver-pos':
		$transactionID=$_REQUEST['TID'];
		$driverID=$_REQUEST['ID']; 
		// echo $transactionID; 

		$q1=mysql_query("UPDATE osd_transaction SET t_driver=$driverID where TID=$transactionID ");
		if($q1){
		echo '<span class="result" data-value="1"><div class="alert alert-success mb-0" role="alert">Driver has been updated.</div></span>';
		}
		break;	

		case 'agent-pos':
		$transactionID=$_REQUEST['TID'];
		$ID=$_REQUEST['ID']; 
		// echo $transactionID; 

		$q1=mysql_query("UPDATE osd_transaction SET t_agent=$ID where TID=$transactionID ");
		if($q1){
		echo '<span class="result" data-value="1"><div class="alert alert-success mb-0" role="alert">Agent has been updated.</div></span>';
		}
		break;	

		case 'truck-pos':
		$transactionID=$_REQUEST['TID'];
		$ID=$_REQUEST['ID']; 
		// echo $transactionID; 

		$q1=mysql_query("UPDATE osd_transaction SET t_truck=$ID where TID=$transactionID ");
		if($q1){
		echo '<span class="result" data-value="1"><div class="alert alert-success mb-0" role="alert">Truck has been updated.</div></span>';
		}
		break;	


		case 'checker-pos':
		$transactionID=$_REQUEST['TID'];
		$ID=$_REQUEST['ID']; 
		// echo $transactionID; 

		$q1=mysql_query("UPDATE osd_transaction SET t_checker=$ID where TID=$transactionID ");
		if($q1){
		echo '<span class="result" data-value="1"><div class="alert alert-success mb-0" role="alert">Checker has been updated.</div></span>';
		}
		break;	




		case 'cod':
		$transactionID=$_REQUEST['TID'];
		$ID=$_REQUEST['ID']; 
		// echo $transactionID; 

		$q1=mysql_query("UPDATE osd_transaction SET t_COD='$ID' where TID=$transactionID ");
		if($q1){
		echo '<span class="result" data-value="1"><div class="alert alert-success mb-0" role="alert">COD has been updated.</div></span>';
		}
		break;	



		case 'unit':
		$tb='osd_unit';
		$id=$_REQUEST['ID'];
		$f1=mysql_real_escape_string($_REQUEST['f1']);
		$f2=mysql_real_escape_string($_REQUEST['f2']);
		$check=mysql_query("SELECT * from $tb where u_name='$f1'");
		$count=mysql_num_rows($check);
		if($count!=-1){
		$query=mysql_query("UPDATE $tb SET u_name='$f1', u_symbol='$f2' where UID='$id' ");
			if($query){
			echo '<span class="result" data-value="1"></span>';
			}else{
				// $return['res']=3;
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
		$check=mysql_query("SELECT PID from $tb where p_name='$f4'  ");
		$count=mysql_num_rows($check);
		 
		$query=mysql_query("UPDATE $tb SET  p_category_id='$f2', p_name='$f4', p_pcode='$f3', p_desc='$f5', p_brand='$f6' where PID='$id' ");
			if($query){
			echo '<span class="result" data-value="1"></span>';
			} 	
		 
		break;		

		case 'supplier':
		$tblname='osd_supplier';
		$id=mysql_real_escape_string($_REQUEST['ID']);
		$f2=mysql_real_escape_string($_REQUEST['f2']);
		$f3=mysql_real_escape_string($_REQUEST['f3']);
		$f4=mysql_real_escape_string($_REQUEST['f4']);
		$f5=mysql_real_escape_string($_REQUEST['f5']);
		$f6=mysql_real_escape_string($_REQUEST['f6']);
		$f7=mysql_real_escape_string($_REQUEST['f7']);
		$f8=mysql_real_escape_string($_REQUEST['f8']);
		$f9=mysql_real_escape_string($_REQUEST['f9']);
		$f10=mysql_real_escape_string($_REQUEST['f10']);
		$f11=mysql_real_escape_string($_REQUEST['f11']);
		$f12=mysql_real_escape_string($_REQUEST['f12']);
		$f13=mysql_real_escape_string($_REQUEST['f13']);
		$query1=mysql_query("UPDATE $tblname SET `sup_last_name`='$f2',`sup_first_name`='$f3',`sup_email`='$f4',`sup_contact_no`='$f5',`sup_address1`='$f6',
		`sup_address2`='$f7',`sup_city`='$f8',`sup_state`='$f9',`sup_zip`='$f10',`sup_country`='$f11',`sup_account_no`='$f12', sup_name='$f13' where SID=$id  ");
			if($query1){
			echo '<span class="result" data-value="1"></span>';
			}			
		break;

		case 'item-unit':
		$tblname='osd_unit_item';
		$id=$_REQUEST['UID'];
		$PID=$_REQUEST['PID'];
		$live=$_REQUEST['live'];


		// echo $PID;
		$check=mysql_query("SELECT UIID from osd_unit_item where ui_uid=$id and ui_pid=$PID ");
		$c=mysql_num_rows($check);
		// echo $c;

		if($c==0){
			 
		mysql_query("INSERT INTO osd_unit_item (ui_pid, ui_uid) VALUES ($PID, $id)");
		$uiid=mysql_insert_id();

		$ui_selling_price=pabs_query_general("ui_selling_price", 'osd_unit_item', "UIID=$uiid");
		$ui_base_price=pabs_query_general("ui_base_price", 'osd_unit_item', "UIID=$uiid");
		echo '<span id="base_price" data-value="'.$ui_base_price.'"></span>';
		echo '<span id="selling_price" data-value="'.$ui_selling_price.'"></span>';
		}

		$check2=mysql_query("SELECT * from osd_unit_item where ui_uid=$id and ui_pid=$PID ");
		$d=mysql_num_rows($check2);
		
		// echo $d;
		if($d==1){
		$UIID=pabs_query_general("UIID", 'osd_unit_item', "ui_uid=$id and ui_pid=$PID ");
		$ui_selling_price=pabs_query_general("ui_selling_price", 'osd_unit_item', "UIID=$UIID");
		$ui_base_price=pabs_query_general("ui_base_price", 'osd_unit_item', "UIID=$UIID");
		echo '<span id="base_price" data-value="'.$ui_base_price.'"></span>';
		echo '<span id="selling_price" data-value="'.$ui_selling_price.'"></span>';

		if($live==1){
		$SPRICE=$_REQUEST['SPRICE'];
		$BASE=$_REQUEST['BASE'];
		mysql_query("UPDATE osd_unit_item SET ui_base_price='".$BASE."', ui_selling_price='".$SPRICE."' WHERE UIID=$UIID  ");	 
		
		}		


		mysql_query("UPDATE $tblname SET  ui_status='1' where ui_uid=$id and ui_pid=$PID"); 
		mysql_query("UPDATE $tblname SET  ui_status='0' where ui_uid!=$id and ui_pid=$PID"); 
		// mysql_query("DELETE from osd_unit_item where ui_uid!=$id and ui_pid=$PID");
		 echo '<div class="success">Process Completed</div>';

		 $p1_name=pabs_query('p_name','osd_product','PID',$PID);
		 $u_name=pabs_query('u_name','osd_unit','UID',$id);
		$message="Change ".$u_name." unit for ".$p1_name;
		$category="Unit";
		save_log($UID, $message, $category);


		}		
		// $query1=mysql_query("DELETE from $tblname SET  ui_status='1' where ui_uid=$id and ui_pid=$PID"); 
		// $query2=mysql_query("UPDATE $tblname SET  ui_status='0' where ui_uid!=$id and ui_pid=$PID"); 
		// echo '<div class="success">Process Completed</div>';
		// $query2=mysql_query("UPDATE $tblname SET  ui_status='0' where UIID!=$id"); 
 
 
			// for($i=0;$i<=$count;$i++){
			// 	$status=$_REQUEST['status_'.$i];
			// 	$check=$_REQUEST['f_'.$i]; 
			// 	if($check==1){
			// 	$query1=mysql_query("UPDATE $tblname SET  ui_status='1' where UIID=$status"); 
			// 	}else{
			// 	$query1=mysql_query("UPDATE $tblname SET  ui_status='0' where UIID=$status"); 
			// 	}
				
			// }
			// if($query1){
			// 	$return['res']=1;
			// }
			
		break;
		
	}
 
 
 
?>