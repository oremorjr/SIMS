<?php
require('../../db_config.php');
$connect=new DB();
$mode=$_REQUEST['mode'];

 
	$tid=$_REQUEST['TID'];
	$tno=$_REQUEST['tno'];
	$cid=$_REQUEST['CID'];
	$amount=$_REQUEST['total'];
	$payment=$_REQUEST['payment'];
	$change=$_REQUEST['change'];
	$dt=date("Y-m-d");
	$t_date = date('Y-m-d H:i:s');
	$cp=$_REQUEST['cp'];
	$empid=get_employeee_id();
	
	if($mode==1 || $mode==0){
	$q0=mysql_query("SELECT ui_selling_price,td_disc, td_qty, td_disc_total  from osd_transaction_details 
	INNER JOIN osd_unit_item ON (td_unit_id=UIID) 
	where td_transaction_id='$tno' and td_mode=1
	");
	$t_disc=0;
	while($q0row=mysql_fetch_array($q0)){
		$raw=$q0row['ui_selling_price'];
		$rate=$q0row['td_disc'];
		$disc_total=$q0row['td_disc_total'];
		$t_qty=$q0row['td_qty'];
		$disc=($raw*$rate/100)*$t_qty;
		$t_disc=$t_disc+$disc;
	}
	$pos3=mysql_query("UPDATE osd_transaction SET t_disc='$t_disc' WHERE TID='$tid'");
	
	}
	

	$t_profit=0;
	$q1=mysql_query("SELECT * from osd_transaction_details where td_transaction_id='$tno' and td_mode=1 ");
	while($q1row=mysql_fetch_array($q1)){
		$pcode=$q1row['td_pcode'];
		$qty=$q1row['td_qty'];
		$uid=$q1row['td_unit_id'];
		$price=$q1row['td_price'];
		$profit=$q1row['td_profit'];
		$t_profit=$t_profit+$profit;
		$disc_l=$q1row['td_disc_l'];
		$disc_a=$q1row['td_disc'];
		$pu_logID=$q1row['td_pu_logID'];
		$receipt_no=$q1row['td_transaction_id'];

		if($disc_l!="0.00"){
		$d_rate=$disc_l;
		$d_status=0;
		}
		if($disc_a!="0.00"){
		$d_rate=$disc_a;
		$d_status=1;
		}



	if($mode==0){
		
		$update_stock=mysql_query("UPDATE osd_unit_item SET ui_stocks=ui_stocks-$qty WHERE UIID=$uid");
		
		// $insert=mysql_query("INSERT INTO osd_product_unit (p_transno, pu_raw_price, p_supplier_unit_id, pu_product_code, pu_unit_id, pu_qty, pu_stocks, pu_datepurchased, pu_remarks) 
		// VALUES ('$tno', '$price','$cid', '$pcode','$uid', '$qty','$qty','$t_date','5')")or die(mysql_error());
		
		$pos=mysql_query("UPDATE osd_transaction SET t_customer_id='$cid', t_amount_t=$amount, t_payment=$payment, t_active=0, t_paid=1, t_change='$change' WHERE TID='$tid'");
		$pos2=mysql_query("UPDATE osd_transaction_details SET td_ispaid=1 WHERE td_transaction_id='$tno' ");
		$pos3=mysql_query("UPDATE osd_product_unit SET pu_status=1, pu_datepurchased='$t_date' WHERE PUID='$pu_logID' ");





	}



	if($mode==1){


		
		$latest_stock=get_stocks($uid, $pcode);
		update_stocks($uid, $latest_stock);	
		
		// $insert=mysql_query("INSERT INTO osd_product_unit (p_transno, pu_raw_price, p_supplier_unit_id, pu_product_code, pu_unit_id, pu_qty, pu_stocks, pu_datepurchased, pu_remarks) 
		// VALUES ('$tno', '$price','$cid', '$pcode','$uid', '$qty','$qty','$t_date','5')")or die(mysql_error());
		
		$pos=mysql_query("UPDATE osd_transaction SET t_customer_id='$cid', t_amount_t=$amount, t_payment=$payment, t_active=0, t_paid=1, t_change='$change' WHERE TID='$tid'");
		$pos2=mysql_query("UPDATE osd_transaction_details SET td_ispaid=1 WHERE td_transaction_id='$tno' ");
		$pos3=mysql_query("UPDATE osd_product_unit SET pu_status=1, pu_datepurchased='$t_date' WHERE PUID='$pu_logID' ");

		$UID=get_employeee_id();
		$message='Edited Receipt <a href="?page=edit-pos&ID='.$cid.'&TID='.$tid.'">'.$receipt_no.'</a>';
		$category="Sales Receipt";
		save_log($UID, $message, $category);
  
		$b_amount=customer_balance($cid, $tid, 1);

		 if($b_amount>0):
		  $update_transaction=mysql_query("UPDATE osd_transaction SET t_complete=0 WHERE TID=$tid");
		else:
		$update_transaction=mysql_query("UPDATE osd_transaction SET t_complete=1 WHERE TID=$tid");
		endif;



	}

	
	if($mode==3){
		$update_stock=mysql_query("UPDATE osd_unit_item SET ui_stocks=ui_stocks-$qty WHERE UIID=$uid");
		$pos=mysql_query("UPDATE osd_transaction SET t_customer_id='$cid',t_amount_t=$amount, t_payment=$payment, t_active=0, t_paid=1,t_return=1, t_change='$change' WHERE TID='$tid'");
	}	
	
	if($mode==2){
		$custom_receipt=strtoupper($_REQUEST['c_receipt_no']);
		$custom_receipt_date=$_REQUEST['c_receipt_date'];
		// $q1=mysql_query("SELECT * from osd_unit_item where UIID=$uid");
		// $r1=mysql_num_rows($q1);
		// if($r1==0){
		// $update_stock=mysql_query("UPDATE osd_unit_item SET ui_stocks=$qty, ui_qty=ui_qty+$qty WHERE UIID=$uid");
		// }else{
		//$raw_price_unit=$amount/$qty;
		// $update_stock=mysql_query("UPDATE osd_unit_item SET ui_stocks=ui_stocks+$qty, ui_qty=ui_qty+$qty, ui_selling_price='$price', ui_supplier_price='$price', ui_disc_rate='$d_rate', disc_status='$d_status' WHERE UIID=$uid");
		// }
		// if(!empty($pcode)){
		// $insert=mysql_query("INSERT INTO osd_product_unit (p_transno, p_supplier_unit_id, pu_product_code, pu_unit_id, pu_qty, pu_stocks,pu_raw_price, pu_datepurchased, pu_remarks) VALUES ('$tno', '$cid', '$pcode','$uid', '$qty','$qty','$price','$t_date','$mode')");
		// }
		$pos=mysql_query("UPDATE osd_transaction SET t_supplier_id='$cid', t_amount_t=$amount,t_payment=$payment, t_active=0, t_paid=1, t_change='$change', t_rno='$custom_receipt', t_rno_date='$custom_receipt_date' WHERE TID='$tid'");

		$pos2=mysql_query("UPDATE osd_transaction_details SET td_ispaid=1 WHERE td_transaction_id='$tno' ");
		$pos3=mysql_query("UPDATE osd_product_unit SET pu_status=1, pu_datepurchased='$t_date' WHERE PUID='$pu_logID' ");

		$UID=get_employeee_id();
		$message='Edited Receipt <a href="?page=edit-pos-receivings&ID='.$cid.'&TID='.$tid.'">'.$receipt_no.'</a>';
		$category="Receivings Receipt";
		save_log($UID, $message, $category);
  
		$b_amount=customer_balance($cid, $tid, 1);

		 if($b_amount>0):
		  $update_transaction=mysql_query("UPDATE osd_transaction SET t_complete=0 WHERE TID=$tid");
		else:
		$update_transaction=mysql_query("UPDATE osd_transaction SET t_complete=1 WHERE TID=$tid");
		endif;









	}

		
	$update_td=mysql_query("UPDATE osd_transaction_details SET td_ispaid=1 WHERE td_transaction_id=$tno");
		
 
	}



	$pos2=mysql_query("UPDATE osd_transaction SET  t_edit_mode=0, t_empid=$empid,  t_last_update='$t_date', t_paid=1 WHERE TID='$tid'");
	// $pos3=mysql_query("UPDATE osd_transaction_details SET td_trans_date='$t_date  WHERE td_transaction_id='$tno'");
	
 
	
 
	 
 
?>