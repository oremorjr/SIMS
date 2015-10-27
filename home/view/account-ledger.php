 
<?php
if(!isset($_REQUEST['CID']))
  return false;
$CID=$_REQUEST['CID'];
$TID=$_REQUEST['TID'];
$MODE=get_mode($TID);


if($MODE==1){
$account_name=pabs_query('c_firstname','osd_customer','CID',$CID);
$c_address=pabs_query('c_address1','osd_customer','CID',$CID);
$c_link='  <li><a href="?page=search-customer">Customer List</a></li>';
$d_link='    <li><a href="?page=account-list&CID='.$CID.'">Account Ledger</a></li>';

}elseif($MODE==2){

$account_name=pabs_query('sup_name','osd_supplier','SID',$CID);
$c_address=pabs_query('sup_address1','osd_supplier','SID',$CID);
$c_link='  <li><a href="?page=search-supplier">Supplier List</a></li>';
$d_link='    <li><a href="?page=supplier-account-list&SID='.$CID.'">Supplier Account Ledger</a></li>';

}


$receiptno=pabs_query('t_receiptno','osd_transaction','TID',$TID);
$tb=customer_balance($CID, $TID, $MODE);
$cp=customer_payment($CID, $TID, $MODE);
$b=number_format($tb, 2, '.', ','); 
$c=number_format($cp, 2, '.', ','); 
$rate=payment_percentage($CID, $TID, $MODE);
$lock=transaction_lock_status($TID);

 
?>
<div id="content">

<div class="outer">
  
<div class="inner">
  <div class="col-lg-12" style="min-height:470px;">
    <div class="row">
      <div class="box">
        <header>
          <div class="icons">
            <i class="fa fa-table"></i>
          </div>
          <div><h5> Account Ledger</h5></div>
        </header>
 <ol class="breadcrumb">
  <li><a href="?page=index">Home</a></li>
  <li><a href="?page=transaction">Transactions</a></li>
<?php echo $c_link;?>
<?php echo $d_link;?>
  <li class="active">Accounts Payable Ledger </li>
</ol>



            <div id="div-4" class="accordion-body collapse in body">

 
              <div class="col-lg-12">
<div class="clear"></div>



<div class="col-lg-12 grid">

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"><strong><?php echo $account_name; ?></strong></h3>
  </div>
  <div class="panel-body">


  
 <table class="table table-bordered table-condensed table-hover table-striped mb-1">
<tr>
  <td width="50%">Customer Account ID : <strong><span class="all-caps"><?php echo get_unique_id($CID, 4);?></span></strong></td> 
  <td> Account Name  : <strong><span ><?php echo $account_name;?></span></strong></td>
</tr>
<tr> 
  <td width="50%">Address : <strong><span class="all-caps"><?php echo $c_address;?></span></strong></td>  
  <td>Total Balance  : <strong><span  >P <?php echo $b; ?></span></strong></td>
</tr>
<tr>
  <td colspan="2">
<div class="progress mb-0">
  <div class="progress-bar" role="progressbar" aria-valuenow=" <?php echo payment_percentage($CID, $TID, $MODE);?>" aria-valuemin="0" aria-valuemax="100" style="width:  <?php echo payment_percentage($CID, $TID, $MODE);?>%;">
<?php
if($rate==100):
echo 'Payment Complete';
else:
echo $rate.'%';
endif;
?>
  </div>
</div>
  </td>
</tr>
</table>

<?php if(current_user('add-payment')):
 
?>
<div class="right">
<a href="?page=account-receivable&CID=<?php echo $CID;?>&TID=<?php echo $TID;?>" class="btn btn-success mb-0">Add Payment</a>
</div>

 
<?php endif;?>

  </div>
</div>


</div>








<div class="col-lg-12 grid ledger">


<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"><strong>Accounts Payable Ledger (<a href="#" class="show_receipt"  data-toggle="modal" data-target="#myModal"   id="<?php echo $TID;?>"><?php echo $receiptno;?></a>)</strong>
    <div class="print"> <a href="#" class="s10"><i class="glyphicon glyphicon-print"></i></a></div>
    </h3>
 

  </div>
<div id="load-area">
</div>
</div>

 
 

</div>
<!-- list of unpaid -->


 





















 


            </div> 
         
        <!-- end Results-->

      </div><!-- /.box -->
    </div><!-- /.row -->
  </div><!-- /.col -->

  
</div>
<!-- end .inner -->
</div>
<!-- end .outer -->
</div>
<!-- end #content -->   















 
 <script>
 $(document).ready(function(){



var CID="<?php echo $CID;?>";
var TID="<?php echo $TID?>";
var MODE="<?php echo $MODE;?>";

$(".print").click(function(){
a2("view/print-ledger.php?CID="+CID+"&TID="+TID+"&MODE="+MODE);
});

function a2(url) { 
popupWindow2 = window.open(url, 'popUpWindow2', 'height=500,width=1200,left=0,top=0,resizable=no,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no,status=no')


}



show_account_ledger(CID, TID, MODE);




$('.show_receipt').click(function(){
var TID=$(this).attr('id');
item_summary(TID);
});



function item_summary(tid){
  // reset();
  $("#transaction_details_ledger").html('<div class="col-lg-12 loading-img"><img src="../images/loading-long.gif"></div>');
  var mode='1';
  var empid="<?php echo get_employeee_id();?>";
  //console.log(tid);
  $("#show-btn").removeAttr("disabled", "disabled");
  // $("#loading-cart").load("?tid="+tid + "&mode=1").fadeIn(); 
  $.ajax({
    data:{tid:tid, mode:mode, empid:empid},
    url:'../include/function/pos/cart_summary_custom.php',
    success:function(data){
      $("#transaction_details_ledger").html(data);

    }
  });

}

 
 });
 </script>

     <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width:800px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Receipt Details</h4>
      </div>
      <div class="modal-body" id="transaction_details_ledger">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
      </div>
    </div>
  </div>
</div>