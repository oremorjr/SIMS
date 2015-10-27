<?php
include('../../include/class_lib.php');
$empid=$_SESSION['SESS_MEMBER_UID'];
$user=new User();
$user->not_login_();
$tid=$_GET['TID'];
$TRID=$_GET['TID'];
$CID=$_GET['CID'];
$TID=$_GET['TID'];
$MODE=$_GET['MODE'];
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


// $customer=mysql_query("SELECT * from osd_customer where CID=$cid ");
// if($c1=mysql_fetch_array($customer)){
// 	$cname=$c1['c_firstname'];
// 	$address=$c1['c_address1'];
// }

if($MODE==1){
$cname=customer('c_firstname', $CID);
$address=customer('c_address1', $CID);
}

if($MODE==2){
$cname=supplier('sup_name', $CID);
$address=supplier('sup_address1', $CID);
}

?>
<head>
<title><?php echo $company->name;?></title>
<script type="text/javascript" src="../../js/jquery.min.js"></script>
<script type="text/javascript"> 
// window.print();
//window.onfocus=function(){ window.close();}


</script> 
<script type="text/javascript">
$(document).ready(function(){

var CID="<?php echo $CID;?>";
var TID="<?php echo $TID?>";
var MODE="<?php echo $MODE?>";

show_account_ledger(CID, TID, MODE);
function show_account_ledger(CID, TID, MODE){

  $.ajax({
    data: {CID:CID, TID:TID, MODE:MODE},
    url:'../../include/function/pos/account/account-ledger_print.php',
    success:function(data){
   $('#account-ledger').html(data);
  
    }


  });


}

});

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
 
 <?php if($MODE==1):?>
	<tr>
		<td class="center" colspan="10">
		<div class="greeting bold t-center f-20"><?php echo $company->name; ?></div>
		<div class="greeting t-center"><?php echo $company->address; ?></div>
		<div class="greeting t-center"><?php echo $company->contact; ?></div>
		<div class="greeting t-center">TAX <?php echo $company->tin; ?></div>
 
		<div class="greeting ptop1 t-center">ACCOUNT LEDGER</div>
		</td>
	</tr>
	<tr>
		<td height="15"  colspan="10"></td>
	</tr>
 
	
	<tr> 
		<td colspan="10">
		<table border="0" width="100%">
			<tr>
				<td class="info left-2" width="6%">CUSTOMER</td>
				<td width="50%"class="b-line info ">&nbsp;<?php echo $cname;?></td>
				<td width="6%" class=" info right-2 ">DNO.</td>
				<td width="20%" class="b-line info">&nbsp;<strong><?php echo $receipt->tno;?></strong></td>
			</tr>
			<tr>
				<td class="info left-2">ADDRESS</td>
				<td class="info b-line">&nbsp;<?php echo $address;?></td>
				<td class="info right-2">DATE</td>
				<td class="b-line info">&nbsp;<?php echo $show_date?></td>				
			</tr>			
		</table>
		</td>	
 
 
	</tr>	

<?php endif;?>


<?php if($MODE==2):?>

  <tr>
    <td class="center" colspan="10">
    <div class="greeting bold t-center f-20"><?php echo $cname;?> </div>
    <div class="greeting t-center"><?php echo $address;?></div> 
 
    <div class="greeting ptop1 t-center">ACCOUNT LEDGER</div>
    </td>
  </tr>
  <tr>
    <td height="15"  colspan="10"></td>
  </tr>
 
  
  <tr> 
    <td colspan="10">
    <table border="0" width="100%">
      <tr>
        <td class="info left-2" width="6%">SOLD TO</td>
        <td width="50%"class="b-line info ">&nbsp;<?php echo $company->name; ?></td>
        <td width="6%" class=" info right-2 ">DNO.</td>
        <td width="20%" class="b-line info">&nbsp;<strong><?php echo $receipt->tno;?> / <?php echo $receipt->t_rno;?></strong></td>
      </tr>
      <tr>
        <td class="info left-2">ADDRESS</td>
        <td class="info b-line">&nbsp;<?php echo $company->address;?></td>
        <td class="info right-2">DATE</td>
        <td class="b-line info">&nbsp;<?php echo $show_date?></td>        
      </tr>     
    </table>
    </td> 
 
 
  </tr> 


<?php endif;?>

 
 	<tr>
	<td colspan="10" class="b-line-2"><br></td>
	</tr>


 
			</table>
 	<div id="account-ledger">
	</div>
 



 
 
</div>

 

</body>

