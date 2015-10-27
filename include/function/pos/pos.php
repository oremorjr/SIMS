<?php
require('../../db_config.php');
$connect=new DB();
 
 
	$pcode=strtoupper($_REQUEST['pcode']);
	$tno=$_REQUEST['tno'];
	$uid=$_REQUEST['unit_id'];
	$qty_t=$_REQUEST['qty'];
	$mode=$_REQUEST['mode'];
	$CID=$_REQUEST['customer'];
	$unit_price=$_REQUEST['unit_price'];
	$empid=get_employeee_id();

	$EDIT=0;
	$transtype=0;
	if(isset($_REQUEST['EDIT'])){
	$EDIT=$_REQUEST['EDIT'];
	$transtype=$_REQUEST['trans_type'];
	} 
	
	if(empty($qty_t)){
		$qty=1;
	}else{
		$qty=$_REQUEST['qty'];
	}
	$dt=date('Y-m-d H:i:s');
	$t_date=date('Y-m-d');

	$ref_TID=get_tid_by_receipt_no($tno, $mode);


	switch($mode){
		case '1':
			
			mysql_query("UPDATE osd_transaction SET t_edit_mode=1, t_empid=$empid, t_edited_by=$empid,  t_last_update='$dt', t_transaction_date='$t_date' WHERE t_receiptno='$tno' and t_mode=1 ");

			$checkprofit=mysql_query("SELECT ui_supplier_price, ui_selling_price, ui_disc_rate, disc_status, ui_base_price, pu_raw_price from osd_unit_item INNER JOIN osd_product_unit ON (pu_unit_id=UIID) where ui_pid=$pcode");
			while($cp=mysql_fetch_array($checkprofit)){
				$raw_price=$cp['pu_raw_price'];
				$raw=$cp['ui_supplier_price']; 
				$base=$cp['ui_base_price']; 
				$selling=$cp['ui_selling_price']; 
				
				// $profit=($selling-$raw)*$qty;
				$disc_rate=$cp['ui_disc_rate'];
				$disc_status=$cp['disc_status'];

 
			}
			$selling=$unit_price;
			$t=$qty*$unit_price;
			
			
			$check_pcode=mysql_query("SELECT td_transaction_id, TDID, td_pu_logID from osd_transaction_details where td_transaction_id='$tno' and td_pcode='$pcode' and td_unit_id='$uid' and td_mode='$mode' and td_return='$transtype' ");
			$count_c=mysql_num_rows($check_pcode);
			if($count_c==0){

			$raw_price=0;
			$profit=0;
			$insert=mysql_query("INSERT INTO osd_product_unit (p_transno, pu_raw_price, p_supplier_unit_id, pu_product_code, pu_unit_id, pu_qty, pu_stocks, pu_datepurchased, pu_remarks) 
			VALUES ('$tno', '$raw_price','$CID', '$pcode','$uid', '$qty','$qty','$dt','5')")or die(mysql_error());

			$pu_logID=mysql_insert_id();

			$pos=mysql_query("INSERT INTO osd_transaction_details (td_transaction_id, td_TID,  td_pcode, td_unit_id, td_date_added, td_qty, td_mode, td_price, td_profit, td_trans_date, td_total, td_pu_logID) VALUES ('$tno','$ref_TID','$pcode','$uid','$dt','$qty', '$mode','$unit_price', '$profit', '$t_date', '$t', '$pu_logID') ");
			$TDID_new=mysql_insert_id();

			if($EDIT==1):
				
			
			$update_td=mysql_query("UPDATE osd_transaction_details SET td_return=$transtype WHERE TDID=$TDID_new ");
			
			$pos3=mysql_query("UPDATE osd_product_unit SET pu_status=1, pu_datepurchased='$dt' WHERE PUID='$pu_logID' ");

				if($transtype==1):
				$CID=$_REQUEST['customer'];
				$update_punit=mysql_query("UPDATE osd_product_unit SET pu_remarks=8, p_supplier_unit_id='$CID' WHERE PUID='$pu_logID' "); 
				endif;

			$latest_stock=get_stocks($uid, $pcode);
			update_stocks($uid, $latest_stock);


			
			endif;

			
			}else{
				while($row=mysql_fetch_array($check_pcode)){
					$tdid=$row['TDID'];
					$pu_logID=$row['td_pu_logID'];
				}
				mysql_query("UPDATE osd_transaction_details SET td_qty=td_qty+$qty, td_total=td_total+$t where TDID='$tdid' ");
				mysql_query("UPDATE osd_product_unit SET pu_qty=pu_qty+$qty, pu_stocks=pu_stocks+$qty  where PUID='$pu_logID' ");

			if($EDIT==1):

			$pos3=mysql_query("UPDATE osd_product_unit SET pu_status=1, pu_datepurchased='$dt' WHERE PUID='$pu_logID' ");

			$transtype=$_REQUEST['trans_type'];

				if($transtype==1):
				$CID=$_REQUEST['customer'];
				$update_punit=mysql_query("UPDATE osd_product_unit SET pu_remarks=8, p_supplier_unit_id='$CID' WHERE PUID='$pu_logID' "); 
				endif;

			$latest_stock=get_stocks($uid, $pcode);
			update_stocks($uid, $latest_stock);			


			endif;
					
			}		
		break;















		case '2':
			$price=$_REQUEST['price'];
			 
			$raw_price="";

			$selling=$unit_price;
			$td_total=$qty*$unit_price;			
 
			mysql_query("UPDATE osd_transaction SET t_edit_mode=1, t_empid=$empid, t_edited_by=$empid,  t_last_update='$dt', t_transaction_date='$t_date' WHERE t_receiptno='$tno' and t_mode=2 ");
			$check_pcode=mysql_query("SELECT td_transaction_id, TDID from osd_transaction_details where td_transaction_id='$tno' and td_pcode='$pcode' and td_unit_id='$uid' and td_mode='$mode' and td_return='$transtype' ");
			$count_c=mysql_num_rows($check_pcode);
			if($count_c==0){


			$insert=mysql_query("INSERT INTO osd_product_unit (p_transno, pu_raw_price, p_supplier_unit_id, pu_product_code, pu_unit_id, pu_qty, pu_stocks, pu_datepurchased, pu_remarks) 
			VALUES ('$tno', '$raw_price','$CID', '$pcode','$uid', '$qty','$qty','$dt','2')")or die(mysql_error());

			$pu_logID=mysql_insert_id();

			$pos=mysql_query("INSERT INTO osd_transaction_details (td_transaction_id,td_TID,  td_pcode, td_unit_id, td_date_added, td_qty, td_mode, td_price,td_trans_date, td_total, td_pu_logID) VALUES ('$tno', '$ref_TID', '$pcode','$uid','$dt','$qty', '$mode','$unit_price', '$t_date', '$td_total', '$pu_logID') ");
			$TDID_new=mysql_insert_id();
			
			if($EDIT==1):
				
			$transtype=$_REQUEST['trans_type'];
			$update_td=mysql_query("UPDATE osd_transaction_details SET td_return=$transtype WHERE TDID=$TDID_new ");
			
			$pos3=mysql_query("UPDATE osd_product_unit SET pu_status=1, pu_datepurchased='$dt' WHERE PUID='$pu_logID' ");

				if($transtype==1):
				$CID=$_REQUEST['customer'];
				$update_punit=mysql_query("UPDATE osd_product_unit SET pu_remarks=9, p_supplier_unit_id='$CID' WHERE PUID='$pu_logID' "); 
				endif;

			$latest_stock=get_stocks($uid, $pcode);
			update_stocks($uid, $latest_stock);


			
			endif;




			}else{
				while($row=mysql_fetch_array($check_pcode)){
					$tdid=$row['TDID'];
					$pu_logID=$row['td_pu_logID'];
				}
				mysql_query("UPDATE osd_transaction_details SET td_qty=td_qty+$qty where TDID='$tdid' ");

				mysql_query("UPDATE osd_product_unit SET pu_qty=pu_qty+$qty, pu_stocks=pu_stocks+$qty  where PUID='$pu_logID' ");

			if($EDIT==1):

			$pos3=mysql_query("UPDATE osd_product_unit SET pu_status=1, pu_datepurchased='$dt' WHERE PUID='$pu_logID' ");

			$transtype=$_REQUEST['trans_type'];

				if($transtype==1):
				$CID=$_REQUEST['customer'];
				$update_punit=mysql_query("UPDATE osd_product_unit SET pu_remarks=8, p_supplier_unit_id='$CID' WHERE PUID='$pu_logID' "); 
				endif;

			$latest_stock=get_stocks($uid, $pcode);
			update_stocks($uid, $latest_stock);			


			endif;






			}	
		break;	

		case '3':

			$price=$_REQUEST['price'];
			$td_total=$qty*$price;
			$raw_price=0;		

			$checkprofit=mysql_query("SELECT ui_supplier_price, ui_selling_price  from osd_unit_item INNER JOIN osd_product_unit ON (pu_unit_id=UIID) where ui_pid=$pcode");
			while($cp=mysql_fetch_array($checkprofit)){
				//$raw=$cp['pu_raw_price'];
				$raw=$cp['ui_supplier_price'];
				$selling=$cp['ui_selling_price'];
				$profit=($selling-$raw)*$qty;
			}

			
			
			$check_pcode=mysql_query("SELECT TDID from osd_transaction_details where td_transaction_id='$tno' and td_pcode='$pcode' and td_unit_id='$uid' and td_mode='$mode' ");
			$count_c=mysql_num_rows($check_pcode);
			if($count_c==0){


			$insert=mysql_query("INSERT INTO osd_product_unit (p_transno, pu_raw_price, p_supplier_unit_id, pu_product_code, pu_unit_id, pu_qty, pu_stocks, pu_datepurchased, pu_remarks) 
			VALUES ('$tno', '$raw_price','$CID', '$pcode','$uid', '$qty','$qty','$dt','6')")or die(mysql_error());

			$pu_logID=mysql_insert_id();

			$pos=mysql_query("INSERT INTO osd_transaction_details (td_transaction_id, td_TID, td_pcode, td_unit_id, td_date_added, td_qty,  td_total, td_mode, td_price, td_profit, td_trans_date, td_pu_logID, td_return) VALUES ('$tno',  '$ref_TID','$pcode','$uid','$dt','$qty','$td_total',  '$mode','$unit_price', '$profit', '$t_date','$pu_logID', '1') ");

			}else{
				while($row=mysql_fetch_array($check_pcode)){
					$tdid=$row['TDID'];
				}
				mysql_query("UPDATE osd_transaction_details SET td_qty=td_qty+$qty, td_profit=$profit where TDID='$tdid' ");
			}		
		break;



		
		
	}

 

 
?>
 