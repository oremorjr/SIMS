<?php
include('../../include/class_lib.php');
$empid=$_SESSION['SESS_MEMBER_UID'];
$user=new User();
$user->not_login_();
$tid=$_GET['TID'];

//RECEIPT
$receipt=new receipt();
$query="SELECT * from osd_transaction INNER JOIN osd_users ON (UID=t_empid) where TID=$tid";
$receipt->select($query);
$tdate=$receipt->tdate;
$show_date=date('Y-m-d h:i A', strtotime($tdate));
//company info
$company=new company();
$query="SELECT * from osd_setting";
$company->select($query);
$cid=$receipt->customer;
$cname="";
$address="";
$customer=mysql_query("SELECT * from osd_customer where CID=$cid ");
if($c1=mysql_fetch_array($customer)){
	$cname=$c1['c_firstname'].' '.$c1['c_lastname'];
	$address=$c1['c_address1'];
}

?>
<head>
<title><?php echo $receipt->tno;?></title>
<script type="text/javascript"> 
// window.print();
//window.onfocus=function(){ window.close();}


</script> 
<script type="text/javascript">
    function printpage() {
        //Get the print button and put it into a variable
        var printButton = document.getElementById("printpagebutton");
        //Set the print button visibility to 'hidden' 
        printButton.style.visibility = 'hidden';
        //Print the page content
        window.print()
        //Set the print button to 'visible' again 
        //[Delete this line if you want it to stay hidden after printing]
        printButton.style.visibility = 'visible';
    }
</script>
<script type="text/javascript"> 
 //window.close();
</script>
  <link rel="stylesheet" href="../assets/css/print.css">
<style>

	
</style>
</head>
<body>
<div id="receipt-form">
<table border="0" width="100%" cellspacing="0" cellpadding="0">
 
 
	<tr>
		<td class="center" colspan="10">
		<div class="greeting bold t-center f-20"><?php echo $company->name; ?></div>
		<div class="greeting t-center"><?php echo $company->tagline; ?></div>
		<div class="greeting t-center"><?php echo $company->address; ?></div>
 
		<div class="greeting ptop1 t-center">RETURN RECEIPT</div>
		</td>
	</tr>
	<tr>
		<td height="15"  colspan="10"></td>
	</tr>
 
	
	<tr> 
		<td colspan="10">
		<table border="0" width="100%">
			<tr>
				<td class="info left-2" width="6%">Name</td>
				<td width="50%"class="b-line info ">&nbsp;<?php //echo $cname;?></td>
				<td width="6%" class=" info right-2 ">DNO.</td>
				<td width="20%" class="b-line info">&nbsp;<strong><?php echo $receipt->tno;?></strong></td>
			</tr>
			<tr>
				<td class="info left-2">ADDRESS</td>
				<td class="info b-line">&nbsp;<?php //echo $address;?></td>
				<td class="info right-2">DATE</td>
				<td class="b-line info">&nbsp;<?php echo $show_date?></td>				
			</tr>			
		</table>
		</td>	
 
 
	</tr>	
 
 	<tr>
	<td colspan="10" class="b-line-2"><br></td>
	</tr>
	<tr>
 
		<td class="bold b-line-3 p-1">
		<div class="desc"> QTY.</div>
		</td>
 		<td class=" bold b-line-3 p-1">
		<div class="desc"> UNIT</div>
		</td>	
		<td class=" bold b-line-3 p-1">
		<div class="desc"> DESCRIPTION</div>
		</td>	
		<td class=" bold b-line-3 p-1">
		<div class="desc"> UNIT PRICE</div>
		</td>			
		<td class="bold b-line-3 p-2">
		 <div class="last-desc">AMOUNT</div>
		</td>
 
	</tr>
 
	<?php	
	$query1=mysql_query("SELECT * from osd_transaction_details
	INNER JOIN osd_transaction ON (t_receiptno=td_transaction_id)
	INNER JOIN osd_product ON (td_pcode=PID)
	INNER JOIN osd_unit_item ON (td_unit_id=UIID)
	INNER JOIN osd_unit ON (ui_uid=UID)
	where TID='$tid'  and td_mode=3 ");
	
	$subtotal=0;
	$i=0;
	while($row=mysql_fetch_array($query1)){
		$i++;
		$tno=$row['t_receiptno'];
		$itemno=$row['p_pcode'];
		$desc=$row['p_name'];
		$price=$row['td_price'];
		$selling_price=$row['ui_selling_price'];
		$qty=$row['td_qty'];
		$cash=$row['t_amount_t'];		
		$payment=$row['t_payment'];		
		$change=$row['t_change'];	
		$unit_name=$row['u_symbol'];
		$disc=$row['td_disc'];
		$disc=$row['td_disc'];
		$disc_l=$row['td_disc_l'];		
		$brand=$row['p_brand'];		
		$td_total=$row['td_total'];		
		$reason=$row['return_reason'];		
		

		if($disc!=0){
			$amount=($selling_price*$qty) - ($selling_price*$qty * $disc/100);
		}else{
			$amount=$selling_price*$qty;
		}
		
		
		$show_change=number_format($change, 2, '.', ',');		
		$show_price=number_format($price, 2, '.', ',');		
		
		$show_cash=number_format($cash, 2, '.', ',');		
		$show_p=number_format($payment, 2, '.', ',');		
		
		 
		$show_amount=number_format($amount, 2, '.', ',');		
		$subtotal=$subtotal+$td_total;
		$grandtotal=$subtotal;
		$show_grandtotal=number_format($grandtotal, 2, '.', ',');	
		$show_subtotal=number_format($subtotal, 2, '.', ',');	
		$show_selling_price=number_format($selling_price, 2, '.', ',');
		$show_td_total=number_format($td_total, 2, '.', ',');		

	
	?>
	<tr>
		<td width="50" valign="top" class="t-center item"  >
		<?php echo $qty;?>  
		</td>
		<td width="50" valign="top" class="t-center item">
		 <?php echo $unit_name;?> 
		</td>		
		<td width="550" valign="top" class="left item">
		 <div><?php echo $brand.' '.$itemno;?> <?php echo $desc;?>
		 
		<span  class="discount"> 
	<?php
	if($disc_l!=0.00){ 
	$discounts = explode(',', $disc_l);	
	$last = end($discounts);
	echo 'L ';
	foreach($discounts as $discount){
		
		if($last!=$discount){
			echo $discount.'%, ';
		}else{
			echo $last.'%';
		}
	}	
	?>		
		 
	<?php
	}
	?>	
	
	<?php
	if($disc!=0.00){ 
	$discounts = explode(',', $disc);	
	$last = end($discounts);
	echo '+ ';
	foreach($discounts as $discount){
		
		if($last!=$discount){
			echo $discount.'%, ';
		}else{
			echo $last.'%';
		}
	}	
	?>		
		 
	<?php
	}
	?>
	</span>	
	</div>
	<div>
	<i>(<?php echo $reason;?>)</i>
	</div>	
		</td>
		<td width="150"   valign="top" class="t-center item">
		<div>P <?php echo  $show_selling_price;?></div>
		
		</td>	
		<td width="100" valign="top" class="t-center item-last">
		<div>P <?php echo $show_td_total;?></div>
		</td>			
	</tr>
 

	<?php
	}
	?>

 	


 	<tr>
	<td  colspan="4" class="total-view">TOTAL  P</td>
	<td class="total-value "><?php echo $show_subtotal;?></td>
	</tr>
<!-- 	<tr>
		<td class="terms" colspan="5">
		<div>TERMS: Cash unless otherwise stipulated. Interest at 2% per month is to be charged on all overdue attorney's fee cost of colletion.</div>	
		<div>The parties expressly submit themselves to the jurisdiction of the courts of the Province of Nueva Ecija in any legal action arising out of this transaction.</div>
		</td>
	</tr>
 -->
 
 	
			</table>
<!-- 	<table border="0" width="100%">

		<tr>
			<td style="width:50%;">&nbsp;</td>
			<td style="width:50%;text-align:right;padding:4px 0;">Received the above articles in good order and condition</td>
		</tr>
	</table> -->			
			<br>

 	<table border="0" width="100%" id="footer">
 		<tr>
 			<td style="width:13%;">Prepared By: </td><td style="width:30%;border-bottom:1px solid #000;">&nbsp;</td>
 			<td>&nbsp;</td><td>&nbsp;</td>
 		</tr>
 		<tr>
 			<td>Checked by: </td><td style="border-bottom:1px solid #000;">&nbsp;</td>
 			<td style="width:10%;text-align:right;">By: </td><td style="border-bottom:1px solid #000;text-align:center;">&nbsp;</td>
 		</tr>
  		<tr>
 			<td> &nbsp; </td><td>&nbsp;</td>
 			<td>&nbsp;</td><td style="text-align:center;"><div>Signature</div><div>SALES INVOICE TO FOLLOW</div></td>
 		</tr>	
 					
 	</table>
 
 
</div>

 

</body>

