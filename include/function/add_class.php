<?php
require('../db_config.php');
$connect=new DB();
$page=$_GET['page'];
$UID=get_employeee_id();
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
				$message="Added ".$v1;
				$category="Supplier";
				save_log($UID, $message, $category)

				 ?>
				 <span class="result" data-value="1"></span>
				 <?php
			}		
		}else{
			?>
			<span class="result" data-value="2">Error 002 : Duplicate </span>
			<?php
		} 

    break;
	
    case 'customer':
		//$v1=mysql_real_escape_string($_REQUEST['f1']);
		$v2=stripslashes($_REQUEST['f2']);
		$v3=$_REQUEST['f3'];
		$v4=stripslashes($_REQUEST['f4']);
		$v5=stripslashes($_REQUEST['f5']);
		$v6=stripslashes($_REQUEST['f6']);
		$v7=stripslashes($_REQUEST['f7']);
		$v8=stripslashes($_REQUEST['f8']);
		$v9=stripslashes($_REQUEST['f9']);
		$v10=stripslashes($_REQUEST['f10']);
		$v11=stripslashes($_REQUEST['f11']);
		$v12=stripslashes($_REQUEST['f12']);
		$v13=stripslashes($_REQUEST['f13']);
		
		$check=mysql_query("SELECT * from osd_customer WHERE c_lastname='".$v2."' and c_firstname='".$v3."' ");
		$cq1=mysql_num_rows($check);
		
		if($cq1==0){
			$query1=mysql_query('INSERT INTO osd_customer (`c_lastname`, `c_firstname`, `c_email`, `c_contact_no`, `c_address1`, `c_address2`, `c_city`, `c_state`, `c_zip`, `c_country`, `c_account_no`, `c_agentID`) 
			VALUES ("'.$v2.'","'.$v3.'","'.$v4.'","'.$v5.'", "'.$v6.'", "'.$v7.'", "'.$v8.'", "'.$v9.'", "'.$v10.'", "'.$v11.'", "'.$v12.'", "'.$v13.'")');
			if($query1){
				?>
				<span class="result" data-value="1"> </span>
				<?php
			}		
		}else{
				?>
				<span class="result" data-value="2">Error 002 : Duplicate </span>
				<?php
		}

    break;			
	
    case 'category':
		$v1=mysql_real_escape_string($_REQUEST['f1']);
		$check=mysql_query("SELECT * from osd_category WHERE cat_name='$v1'");
		$cq1=mysql_num_rows($check);
		
		if($cq1==0){
			$query1=mysql_query("INSERT INTO osd_category (cat_name) VALUES ('$v1')");
			if($query1){
			$message="Added ".$v1;
			$category="Category";
			save_log($UID, $message, $category);				
			?>
			<span class="result" data-value="1"></span>
			<?php
			}		
		}else{
			?>
			<div class="duplicate-data"><span class="result" data-value="2">Error 002 : Duplicate </span></div>
			<?php
		}

    break;	


    case 'bank':
		$v1=mysql_real_escape_string($_REQUEST['f1']);
		$check=mysql_query("SELECT * from osd_bank WHERE b_bankName='$v1'");
		$cq1=mysql_num_rows($check);
		
		if($cq1==0){
			$query1=mysql_query("INSERT INTO  osd_bank (b_bankName) VALUES ('$v1')");
			if($query1){
			$message="Added ".$v1;
			$category="Bank";
			save_log($UID, $message, $category);				
			?>
			<span class="result" data-value="1"></span>
			<?php
			}		
		}else{
			?>
			<div class="duplicate-data"><span class="result" data-value="2">Error 002 : Duplicate </span></div>
			<?php
		}

    break;



    case 'transaction-type':
		$v1=mysql_real_escape_string($_REQUEST['f1']);
		$check=mysql_query("SELECT * from osd_transaction_type WHERE tt_name='$v1'");
		$cq1=mysql_num_rows($check);
		
		if($cq1==0){
			$query1=mysql_query("INSERT INTO  osd_transaction_type (tt_name) VALUES ('$v1')");
			if($query1){
			$message="Added ".$v1;
			$category="Transaction Type";
			save_log($UID, $message, $category);				
			?>
			<span class="result" data-value="1"></span>
			<?php
			}		
		}else{
			?>
			<div class="duplicate-data"><span class="result" data-value="2">Error 002 : Duplicate </span></div>
			<?php
		}

    break;

    case 'checker':
		$v1=mysql_real_escape_string($_REQUEST['f1']);
		$v2=mysql_real_escape_string($_REQUEST['f2']);
		$check=mysql_query("SELECT * from osd_checker WHERE c_firstname='$v1' and c_lastname='$v2' ");
		$cq1=mysql_num_rows($check);
		
		if($cq1==0){
			$query1=mysql_query("INSERT INTO  osd_checker (c_firstname, c_lastname) VALUES ('".$v1."','".$v2."')");
			if($query1){
			$message="Added ".$v1.' '.$v2;
			$category="Checker";
			save_log($UID, $message, $category);				
			?>
			<span class="result" data-value="1"></span>
			<?php
			}		
		}else{
			?>
			<div class="duplicate-data"><span class="result" data-value="2">Error 002 : Duplicate </span></div>
			<?php
		}

    break;

	
    case 'item':
		#$v1=mysql_real_escape_string($_REQUEST['f1']);
		$v2=strtoupper(mysql_real_escape_string($_REQUEST['f2']));
		$v3=strtoupper(mysql_real_escape_string($_REQUEST['f3']));
		$v5=strtoupper(mysql_real_escape_string($_REQUEST['f5']));
		$v6=strtoupper(mysql_real_escape_string($_REQUEST['f6']));
		$v4=strtoupper(mysql_real_escape_string($_REQUEST['f4']));

		$check=mysql_query("SELECT p_name from osd_product WHERE p_name='$v4' and p_brand='$v6' and p_pcode='$v3' ");
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
			$message="Added ".$v4;
			$category="Item";
			save_log($UID, $message, $category);		

				
				?>
				<span class="result" data-value="1"></span>
				<?php



			}		
		}else{
			?>
			<div class="duplicate-data"><span class="result" data-value="2">Error 002 : Duplicate </span></div>
			<?php		
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
				?>
				<span class="result" data-value="1"></span>
				<?php
			}		
		}else{
				?>
				<div class="duplicate-data"><span class="result" data-value="2">Error 002 : Duplicate </span></div>
				<?php		
		}

    break;		
    case 'product-list':
		$v1=mysql_real_escape_string($_REQUEST['field1']);
		$v2=mysql_real_escape_string($_REQUEST['field2']);
		$v3=mysql_real_escape_string($_REQUEST['field3']);
		$v5 =date('Y-m-d H:i:s');
		$v6 = mysql_real_escape_string($_REQUEST['f14']);
		$v7 = mysql_real_escape_string($_REQUEST['field7']);
		$v8 = mysql_real_escape_string($_REQUEST['field8']);
		$v14 = mysql_real_escape_string($_REQUEST['f14']);
		$v9 = '';
		
		$table='osd_product_unit';
			$query1=mysql_query("INSERT INTO $table (pu_unit_id, pu_product_code, pu_stocks, pu_datepurchased, pu_remarks, pu_qty, pu_raw_price, pu_price, p_supplier_unit_id, pu_status) VALUES ('$v1','$v2','$v3','$v5','$v6','$v3','$v7','$v8', '$v9',1)");
			if($query1){
				$id=mysql_insert_id();
				$code = str_pad($id, 5, "0", STR_PAD_LEFT);
				$f_code='B-'.$code;
				if($v14==1){
				$pname=pabs_query('p_name','osd_product','PID', $v2);
				$uid=pabs_query('ui_uid','osd_unit_item','UIID', $v1);
				$uname=pabs_query('u_name','osd_unit','UID', $uid);


				$query3=mysql_query("UPDATE osd_unit_item SET ui_stocks=ui_stocks + $v3,  ui_qty=ui_qty + $v3, ui_manual_type=1 where UIID=$v1");			
				$message="Manually added ".$v3.' '.$uname.' of '.$pname;
				$category="Item";
				save_log($UID, $message, $category);					

				}elseif ($v14==7) {
				$pname=pabs_query('p_name','osd_product','PID', $v2);
				$uid=pabs_query('ui_uid','osd_unit_item','UIID', $v1);
				$uname=pabs_query('u_name','osd_unit','UID', $uid);

				$query3=mysql_query("UPDATE osd_unit_item SET ui_stocks=ui_stocks - $v3,  ui_qty=ui_qty - $v3, ui_manual_type=7 where UIID=$v1");			
				$message="Manually remove ".$v3.' '.$uname.' of '.$pname;
				$category="Item";
				save_log($UID, $message, $category);					
				}
				
				$query2=mysql_query("UPDATE $table SET pu_batchno='$f_code' where PUID='$id'");			
				
				echo '<span class="result" data-value="1"></span>';
				// $return['fname']="";
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
    case 'position':
		$v1=mysql_real_escape_string($_REQUEST['f1']); 
		$table='osd_position';

		$check=mysql_query("SELECT p_posname from $table WHERE p_posname='$v1'");	
		$cq1=mysql_num_rows($check);
		
		if($cq1==0){
			$query1=mysql_query("INSERT INTO $table (p_posname) VALUES ('$v1')");
			if($query1){
				?>
				<span class="result" data-value="1"></span>
				<?php
			}		
		}else{
				?>
				<div class="duplicate-data"><span class="result" data-value="2">Error 002 : Duplicate </span></div>
				<?php		
		}

    break;

    case 'user':
		$v1=mysql_real_escape_string($_REQUEST['f1']); 
		$v2=mysql_real_escape_string($_REQUEST['f2']); 
		$v3=mysql_real_escape_string($_REQUEST['f3']); 

		$v4=mysql_real_escape_string($_REQUEST['f4']); 
		$v5=mysql_real_escape_string($_REQUEST['f5']); 
		$v6=md5(mysql_real_escape_string($_REQUEST['f3']));
		$table='osd_users';



		$check=mysql_query("SELECT UID from $table WHERE uname='$v5'   ");	
		$cq1=mysql_num_rows($check);
		
		if($cq1==0){
			$query1=mysql_query("INSERT INTO $table (fname,mname, lname, u_position, uname, pwd) VALUES ('$v1', '$v2', '$v3','$v4','$v5', '$v6')");
			$empid=mysql_insert_id();

			$s2=mysql_query("SELECT * from osd_access WHERE a_posid='$v4' and a_pageid='5' ");
			$count_s2=mysql_num_rows($s2);

			if($count_s2==0):
			mysql_query("INSERT INTO osd_access (a_pageid, a_posid) VALUES ('5','$v4') ");
			endif;




			if($query1){
				?>
				<span class="result" data-value="1"></span>
				<?php
			}		
		}else{
				?>
				<div class="duplicate-data"><span class="result" data-value="2">Error 002 : Duplicate </span></div>
				<?php		
		}

    break;

    case 'page':
		$v1=mysql_real_escape_string($_REQUEST['f1']); 
		$v2=mysql_real_escape_string($_REQUEST['f2']); 
		// $v3=mysql_real_escape_string($_REQUEST['f3']); 
		$v4=mysql_real_escape_string($_REQUEST['f4']); 
		$v5=mysql_real_escape_string($_REQUEST['f5']); 
		$v6=mysql_real_escape_string($_REQUEST['f6']); 
		$table='osd_page';

		$check=mysql_query("SELECT p_pageslug from $table WHERE p_pageslug='$v2'");	
		$cq1=mysql_num_rows($check);
		
		if($cq1==0){
			$query1=mysql_query("INSERT INTO $table (p_pagecategory, p_pagename, p_pageslug,p_type, p_cap_group) VALUES ('$v4', '$v1','$v2','$v5', '$v6')");
			if($query1){
				?>
				<span class="result" data-value="1"></span>
				<?php
			}		
		}else{
				?>
				<div class="duplicate-data"><span class="result" data-value="2">Error 002 : Duplicate </span></div>
				<?php		
		}

    break;	








    case 'driver':
		$v1=mysql_real_escape_string($_REQUEST['f1']); 
		$v2=mysql_real_escape_string($_REQUEST['f2']); 
		$v3=mysql_real_escape_string($_REQUEST['f3']); 
		$v4=mysql_real_escape_string($_REQUEST['f4']); 
 
		$v6=md5('12345');
		$table='osd_driver';

		$check=mysql_query("SELECT d_driverID from $table WHERE d_firstname='$v1' AND d_lastname='$v2'   ");	
		$cq1=mysql_num_rows($check);
		
		if($cq1==0){
			$query1=mysql_query("INSERT INTO $table (d_firstname, d_lastname, d_contact_num, d_address) VALUES ('$v1', '$v2', '$v3','$v4')");
			if($query1){
				?>
				<span class="result" data-value="1"></span>
				<?php
			}		
		}else{
				?>
				<div class="duplicate-data"><span class="result" data-value="2">Error 002 : Duplicate </span></div>
				<?php		
		}

    break;





    case 'custom-item':
		$desc=mysql_real_escape_string($_REQUEST['desc']); 
		$cost=mysql_real_escape_string($_REQUEST['cost']); 
		$qty=mysql_real_escape_string($_REQUEST['qty']); 
		$disc=mysql_real_escape_string($_REQUEST['disc']); 
		$disc_l=mysql_real_escape_string($_REQUEST['disc_l']); 
		$total=mysql_real_escape_string($_REQUEST['total']); 
		$tr_ID=mysql_real_escape_string($_REQUEST['tr_ID']); 
 		$TID=mysql_real_escape_string($_REQUEST['TID']); 
 		$unit=mysql_real_escape_string($_REQUEST['unit']); 
		$table='osd_custom_transaction_details';


		$query1=mysql_query("INSERT INTO $table (ctd_TID, ctd_item_name, ctd_price, ctd_qty, ctd_disc, ctd_disc_l, ctd_total, ctd_unit) VALUES ('".$TID."', '".$desc."', '".$cost."', '".$qty."', '".$disc."', '".$disc_l."', '".$total."', '".$unit."')");
		$CustItemID=mysql_insert_id();
		if($query1){
			?>
			<span class="result" data-value="1"></span>
			<span class="custom_id"  data-value="<?php echo $CustItemID;?>"> </span>
			<span class="tr_id"  data-value="<?php echo $tr_ID;?>"> </span>
			<?php
		}		
 

    break;

    case 'update-custom-item':
		$desc=mysql_real_escape_string($_REQUEST['desc']); 
		$cost=mysql_real_escape_string($_REQUEST['cost']); 
		$qty=mysql_real_escape_string($_REQUEST['qty']); 
		$CTD_ID=mysql_real_escape_string($_REQUEST['CTD_ID']); 
		$disc=mysql_real_escape_string($_REQUEST['disc']); 
		$disc_l=mysql_real_escape_string($_REQUEST['disc_l']); 
		$total=mysql_real_escape_string($_REQUEST['total']); 		
		$unit=mysql_real_escape_string($_REQUEST['unit']); 		

 
		$table='osd_custom_transaction_details';


		$query1=mysql_query("UPDATE $table SET ctd_item_name='".$desc."' , ctd_price='".$cost."', ctd_qty='".$qty."', ctd_disc='".$disc."', ctd_disc_l='".$disc_l."', ctd_total='".$total."', ctd_unit='".$unit."' WHERE ctd_transID=$CTD_ID ");
		if($query1){
			?>
			<span class="result" data-value="1"> </span>
			<?php
		}		
 

    break;

    case 'delete-custom-item':
 
		$CTD_ID=mysql_real_escape_string($_REQUEST['CTD_ID']); 
		

 
		$table='osd_custom_transaction_details';


		$query1=mysql_query("DELETE FROM $table  WHERE ctd_transID=$CTD_ID ");
		if($query1){
			?>
			<span class="result" data-value="1"> </span>
			<?php
		}		
 

    break;

    case 'truck':
		$v1=strtoupper(mysql_real_escape_string($_REQUEST['f1'])); 
 
		$table='osd_truck';

		$check=mysql_query("SELECT t_truckID from $table WHERE t_truckNo='$v1'    ");	
		$cq1=mysql_num_rows($check);
		
		if($cq1==0){
			$query1=mysql_query("INSERT INTO $table (t_truckNo) VALUES ('$v1')");
			if($query1){
				?>
				<span class="result" data-value="1"></span>
				<?php
			}		
		}else{
				?>
				<div class="duplicate-data"><span class="result" data-value="2">Error 002 : Duplicate </span></div>
				<?php		
		}

    break;








    case 'agent':
		$v1=mysql_real_escape_string($_REQUEST['f1']); 
		$v2=mysql_real_escape_string($_REQUEST['f2']); 
		$v3=mysql_real_escape_string($_REQUEST['f3']); 

		$v4=mysql_real_escape_string($_REQUEST['f4']); 
  
		$table='osd_agent';

		$check=mysql_query("SELECT a_agentID from $table WHERE a_firstname='$v1' AND a_lastname='$v2'   ");	
		$cq1=mysql_num_rows($check);
		
		if($cq1==0){
			$query1=mysql_query("INSERT INTO $table (a_firstname, a_lastname, a_contact_num, a_address) VALUES ('$v1', '$v2', '$v3','$v4')");
			if($query1){
				?>
				<span class="result" data-value="1"></span>
				<?php
			}		
		}else{
				?>
				<div class="duplicate-data"><span class="result" data-value="2">Error 002 : Duplicate </span></div>
				<?php		
		}

    break;

    case 'remove-ar':
 	$TID=$_REQUEST['TID'];
 	mysql_query("DELETE FROM osd_account_ledger where al_transID=$TID");
 	mysql_query("DELETE FROM osd_log where l_ACID=$TID");
    break;

    case 'deactivate-ar':
 	$TID=$_REQUEST['TID'];
 	$CID=$_REQUEST['CID'];
 	$CTID=$_REQUEST['CTID'];
 	mysql_query("UPDATE  osd_account_ledger SET al_status=0 where al_transID=$TID");
 	// mysql_query("DELETE FROM osd_log where l_ACID=$TID");

 
 	$balance=customer_balance($CID, $CTID);
 	
 	if($balance<=0):
 	$paid=1;
 	else:
 	$paid=0;
 	endif;

	mysql_query("UPDATE osd_transaction SET t_complete=$paid WHERE TID=$CTID") or die(mysql_error());



 	// echo $balance;
    break;

 



    case 'accounts-receivable': 
	$CID=$_REQUEST['CID'];
	$TID=$_REQUEST['TID'];
	$checque=strtoupper($_REQUEST['checque']);
	$bank=$_REQUEST['bank'];
	$type=$_REQUEST['type'];
	$date=$_REQUEST['date'];
	$mode=$_REQUEST['mode'];
	$payment_date=$_REQUEST['payment_date'];
	$d1=date('Y-m-d', strtotime($date));
	$d2=date('Y-m-d', strtotime($payment_date));
	$receipt=get_receipt_no($TID);

	if(empty($date)){
	$d1=date('Y-m-d');
	}
	if(empty($payment_date)){
	$d2=date('Y-m-d');
	}



	$amount=$_REQUEST['amount'];
	$desc=$_REQUEST['desc'];
	$unique_transaction_no=strtoupper(uniqid());
	$dt=date('Y-m-d H:i:s');
	$y=date('Y');
	$m=date('m');
	$t_date=date('Y-m-d');
	
	$update_ar=mysql_query("INSERT INTO osd_account_ledger  
		(al_receipt_ID , 
		al_customer_ID ,
		al_chequeno ,
		al_amount ,
		al_bank ,
		al_trans_type,
		al_trans_date,
		al_transaction_date,
		al_active, al_year, al_month, al_payment_description,al_transact_date, al_mode, al_receipt_no) VALUES

		('$TID', '$CID', '".$checque."', '".$amount."', '".$bank."', '".$type."', '".$d1."', '$dt', '0', '$y', '$m', '".$desc."', '".$d2."', '".$mode."', '".$receipt."' )
		 
		 ") or die(mysql_error());
		$unid=mysql_insert_id();
		$uniqueid=strtoupper(get_unique_id($unid, 5));
		mysql_query("UPDATE osd_account_ledger SET al_unique_transID='$uniqueid' WHERE al_transID=$unid ") or die(mysql_error());


		// echo $unique_transaction_no;
		$s_amount=number_format($amount, 2, '.', ','); 

		$message='Process '.$s_amount.' payment for '.get_customer_name($CID).' in Receipt #<a href="?page=account-ledger&CID='.customer_tid($TID).'&TID='.$TID.'">'.get_receipt_no($TID).'</a>  ';
		$category="Account Receivable";
		$UID=get_employeee_id();
		save_log_payment($UID, $message, $category, $unid);	




    break;



    case 'update-ar': 
	$CID=$_REQUEST['CID'];
	$TID=$_REQUEST['TID'];
	$MODE=$_REQUEST['mode'];
	$dt=date('Y-m-d H:i:s');

 	
 	mysql_query("UPDATE osd_account_ledger SET al_status=1, al_transaction_date='$dt' where al_receipt_ID=$TID and al_customer_ID=$CID ") or die(mysql_error());

 	$balance=customer_balance($CID, $TID, $MODE);
 	
 	if($balance<=0):
 	$paid=1;
 	else:
 	$paid=0;
 	endif;

	mysql_query("UPDATE osd_transaction SET t_complete=$paid WHERE TID=$TID") or die(mysql_error());


	




    break;


    case 'lock-payment':
 	$TID=$_REQUEST['TID'];
 	$empid=$_REQUEST['empid'];
 	$pwd=md5($_REQUEST['pwd']);
 	$CID=customer_tid($TID);
 	$count=mysql_query("SELECT UID from osd_users WHERE UID=$empid and pwd='".$pwd."' ");
 	$c=mysql_num_rows($count);
 	if($c==1):
 	mysql_query("UPDATE osd_account_ledger SET al_locked=1 WHERE al_receipt_ID=$TID  ");
 	echo '<div class="alert alert-info mb-0" role="alert"><i class="glyphicon glyphicon-ok"></i> Successful</div>';	
 	echo '<div class="result-ar" id="1"></div>' ;

	$message='Lock Payment for  '.get_customer_name($CID).' with Receipt #<a href="?page=account-ledger&CID='.customer_tid($TID).'&TID='.$TID.'">'.get_receipt_no($TID).'</a>';
	$category="Account Receivable";
	$UID=get_employeee_id();
	save_log($UID, $message, $category);	



 	else:
 	echo '<div class="alert alert-warning mb-0" role="alert">Try again</div>';
 	echo '<div class="result-ar" id="0"></div>' ;
 	endif;
 	 
    break;


    case 'unlock-payment':
 	$TID=$_REQUEST['TID'];
 	$empid=$_REQUEST['empid'];
 	$pwd=md5($_REQUEST['pwd']);
 	$CID=customer_tid($TID);
 	$count=mysql_query("SELECT UID from osd_users WHERE UID=$empid and pwd='".$pwd."' ");
 	$c=mysql_num_rows($count);
 	if($c==1):
 	mysql_query("UPDATE osd_account_ledger SET al_locked=0 WHERE al_receipt_ID=$TID  ");
 	echo '<div class="alert alert-info mb-0" role="alert"><i class="glyphicon glyphicon-ok"></i> Successful</div>';	
 	echo '<div class="result-ar" id="1"></div>' ;

	$message='Unlock Payment for  '.get_customer_name($CID).' with Receipt #<a href="?page=account-ledger&CID='.customer_tid($TID).'&TID='.$TID.'">'.get_receipt_no($TID).'</a>';
	$category="Account Receivable";
	$UID=get_employeee_id();
	save_log($UID, $message, $category);	


 	else:
 	echo '<div class="alert alert-warning mb-0" role="alert">Try again</div>';
 	echo '<div class="result-ar" id="0"></div>' ;
 	endif;
 	 
    break;



    case 'lock-receipt':
 	$TID=$_REQUEST['TID'];
 	$empid=$_REQUEST['empid'];
 	$pwd=md5($_REQUEST['pwd']);
 	$count=mysql_query("SELECT UID from osd_users WHERE UID=$empid and pwd='".$pwd."' ");
 	$c=mysql_num_rows($count);
 	if($c==1):
 	mysql_query("UPDATE osd_transaction SET t_locked=1 WHERE TID=$TID  ");
 	echo '<div class="alert alert-info mb-0" role="alert"><i class="glyphicon glyphicon-ok"></i> Successful</div>';	
 	echo '<div class="result-ar" id="1"></div>' ;

 
	$message='Lock Receipt <a href="?page=edit-pos&ID='.customer_tid($TID).'&TID='.$TID.'">'.get_receipt_no($TID).'</a>';
	$category="Edit Sales Receipt";
	$UID=$empid;
	save_log($UID, $message, $category);


 	else:
 	echo '<div class="alert alert-warning mb-0" role="alert">Try again</div>';
 	echo '<div class="result-ar" id="0"></div>' ;





 	endif;
 	 
    break;


    case 'unlock-receipt':
 	$TID=$_REQUEST['TID'];
 	$empid=$_REQUEST['empid'];
 	$pwd=md5($_REQUEST['pwd']);
 	$count=mysql_query("SELECT UID from osd_users WHERE UID=$empid and pwd='".$pwd."' ");
 	$c=mysql_num_rows($count);
 	if($c==1):
 	mysql_query("UPDATE osd_transaction SET t_locked=0 WHERE TID=$TID  ");
 	echo '<div class="alert alert-info mb-0" role="alert"><i class="glyphicon glyphicon-ok"></i> Successful</div>';	
 	echo '<div class="result-ar" id="1"></div>' ;

	$message='Unlock Receipt <a href="?page=edit-pos&ID='.customer_tid($TID).'&TID='.$TID.'">'.get_receipt_no($TID).'</a>';
	$category="Edit Sales Receipt";
	$UID=$empid;
	save_log($UID, $message, $category);


 	else:
 	echo '<div class="alert alert-warning mb-0" role="alert">Try again</div>';
 	echo '<div class="result-ar" id="0"></div>' ;
 	endif;
 	 
    break;




	
}



 
 

?>