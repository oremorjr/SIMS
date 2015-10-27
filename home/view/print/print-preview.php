<?php
/**
 * HTML2PDF Librairy - example
 *
 * HTML => PDF convertor
 * distributed under the LGPL License
 *
 * @author      Laurent MINGUET <webmaster@html2pdf.fr>
 *
 * isset($_GET['vuehtml']) is not mandatory
 * it allow to display the result in the HTML format
 */

    // get the HTML
    ob_start();
?>
<style type="text/css">
 page{
    margin:0;
    padding:0;
 }

 body{
    font-weight: normal;
 }
 page{
    width:100%;
    font-size: 100%;
 }
    #receipt-form{
        
        width: 90%;
        margin: auto;
        padding-bottom:30px;
     padding-top:30px;
     font-weight: normal;
    }
 
    .bold{
    font-weight:bold;
    }
    .t-center{
    text-align:center;
      font-weight: normal;
    }
    .f-20{
        font-size:18px
    }
 
    .b-line{
        border-bottom:1px dashed #000;
    }
    .b-line-2{
        border-bottom:1px solid #000;
    }
    .b-line-3{
        border-bottom:1px solid #000;
        
    }   
    .b-line-4{
        border-top:1px solid #000;
    }       
    .col-2{
        width:20%;
    }   
    .col-3{
        width:30%;
    }
    .col-7{
        width:70%;
    }
    .col-8{
        width:80%;
    } 
    .p-1{
        padding:10px 0px; 
        border-right:1px solid #000;
        text-align:center;
    }
    .p-2{
        padding:10px 0px; 
         
        text-align:center;
    }
    .item{
        border-right:1px solid #000;
        padding:4px 0px;
    }
    .item-last{
        border-right:none;
        padding:3px 0px;
    }   
    .left{
        text-align:left;
        padding-left:20px;
    }
    .right{
        text-align:right;
        padding-right:20px;
    }   
    .info{
    padding:5px 0px;
    }
    .right-2{
        padding-right:15px;
        text-align:right;
    }

 
 .l-1{
    width:10%;
    
        font-weight: normal;   
 }

 .l-2{
width:50%;
border-bottom:1px dashed #000;
padding:4px;
         font-weight: normal;
 }

  .l-3{
    width:10%;
    padding:4px;
    text-align: right;
    padding-right:10px;
   
        font-weight: normal;
 }
  .l-4{
width:30%;
border-bottom:1px dashed #000;
padding:4px;
    
        font-weight: normal;
 }
    
.r-label{
    border-top:1px solid #000;
    border-left:1px solid #000;
    padding:5px 5px;
    text-align: center;
   
        font-weight: normal;
}
.r-label-no{
    border-left:none;
} 


 

</style>
<page  style="font-family: courier">
<?php
include('../../../include/class_lib.php');
$db=new DB();

$tid=$_GET['TID'];
$user=new User();
$user->not_login_();
$UID = $_SESSION['SESS_MEMBER_UID'];
$empid=$_SESSION['SESS_MEMBER_UID'];


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


<div id="receipt-form">

  <table border="0" style="width:100%;"  cellspacing="0" cellpadding="0">
 
 
    <tr>
        <td class="center">
        <div style="font-size:20px;font-weight: normal;" class="greeting bold t-center f-20"><?php echo $company->name; ?></div>
        <div style="font-size:14px;font-weight: normal;" class="greeting t-center"><?php echo $company->tagline; ?></div>
        <div style="font-size:14px;font-weight: normal;" class="greeting t-center"><?php echo $company->address; ?></div>
        <div style="font-size:14px;font-weight: normal;" class="greeting t-center"><?php echo $company->contact; ?></div>
        <div style="font-size:14px;font-weight: normal;" class="greeting t-center">VAT Reg. TIN <?php echo $company->tin; ?></div>
        <div style="padding-top:10px;font-size:14px;" class="greeting ptop1 t-center">OFFICIAL RECEIPT</div>
        </td>
    </tr>

</table>
    <br>
 

  <table border="0" style="width:100%;"  cellspacing="0" cellpadding="0">
        <tr>
            <td valign="middle" class="l-1" style="">SOLD TO</td>
            <td valign="middle" class="l-2"><?php echo $cname;?></td>
            <td valign="middle" class="l-3">RNO</td>
            <td  valign="middle" class="l-4"><?php echo $receipt->tno;?></td>

        </tr>
         <tr>
            <td valign="middle"  class="l-1">ADDRESS</td>
            <td valign="middle" class="l-2"><?php echo $address;?></td>
            <td valign="middle" class="l-3">DATE</td>
            <td valign="middle" class="l-4"><?php echo $show_date?></td>

        </tr>       
    </table>

    <br>
  <table id="label" border="0" style="width:100%;"  cellspacing="0" cellpadding="0">
 
        <tr >
 
        <td class="bold r-label-no r-label  "  style="width:10%;" >
     QTY
        </td>
        <td class="bold r-label" style="width:10%;" >
        UNIT
        </td>
         <td class="bold r-label" style="width:60%;" >
        ARTICLES
        </td>
                <td class="bold r-label" style="width:10%;" >
        PRICE
        </td> 
         <td class="bold r-label" style="width:10%;" >
        AMOUNT
        </td>

    </tr>

    <?php   
    $query1=mysql_query("SELECT * from osd_transaction_details
    INNER JOIN osd_transaction ON (t_receiptno=td_transaction_id)
    INNER JOIN osd_product ON (td_pcode=PID)
    INNER JOIN osd_unit_item ON (td_unit_id=UIID)
    INNER JOIN osd_unit ON (ui_uid=UID)
    where TID='$tid' and t_paid=1 and t_empid='$empid' and td_ispaid=1 and td_mode=1 ");
    
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
        $subtotal=$subtotal+$amount;
        $grandtotal=$subtotal;
        $show_grandtotal=number_format($grandtotal, 2, '.', ',');   
        $show_subtotal=number_format($subtotal, 2, '.', ',');   
        $show_selling_price=number_format($selling_price, 2, '.', ',');   

    
    ?>
    <tr>
       <td class=" r-label-no r-label  "  style="width:10%;" ><?php echo $qty;?>  
        </td>
      <td class=" r-label "  style="width:10%;" >
         <?php echo $unit_name;?> 
        </td>       
       <td class=" r-label" style="text-align:left;" >
         <?php echo $itemno;?> <?php echo $desc;?>
         
    <?php
    if($disc!=0){ 
    ?>      
    <?php echo $disc;?>%  
    <?php
    }
    ?>
        </td>
       <td class=" r-label " style="width:10%;" >
    <?php echo  $show_selling_price;?>< 
        
        </td>   
         <td class=" r-label  " style="width:10%;" >
         <?php echo $show_amount;?> 
        </td>           
    </tr>
 

    <?php
    }
    ?>

    <tr>
    <td  class="b-line-4">&nbsp;</td>
    <td  class="b-line-4">&nbsp;</td>
    <td  class="b-line-4">&nbsp;</td>
    <td  class="b-line-4">&nbsp;</td>
    <td  class="b-line-4">&nbsp;</td>
    </tr>
 

</table>
<br>
 <table border="0" style="width:100%;"  cellspacing="0" cellpadding="0">
    <tr>
            <td style="width:80%;" > &nbsp; </td>
        <td valign="middle" style="width:10%;text-align:right;padding-right:10px;font-size:100%;" > TOTAL </td>
        <td> <?php echo $show_subtotal;?> </td>
    </tr>
 </table>
<br>
  <table border="0" style="width:100%;"  cellspacing="0" cellpadding="0">
    <tr>
            <td style="width:30%;" > &nbsp; </td>
            <td class="" style="font-style:italic;border-top:1px solid #000;width:70%;text-align:left;padding-top:5px;'" > 
Received the above articles in good order and condition under terms and condition stipulated heron
        
            </td>
    </tr>
 </table>

</div>
</page>
<?php
    $content = ob_get_clean();

    // convert to PDF
    require_once(dirname(__FILE__).'/html2pdf.class.php');
    try
    {
    $html2pdf = new HTML2PDF('P', 'Letter', 'fr', true, 'UTF-8', 0);
    $html2pdf->pdf->SetDisplayMode('real');
      $html2pdf->pdf->IncludeJS("print(true);");
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('R-'.$tid.'.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
