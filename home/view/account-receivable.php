<link href="./assets/css/jquery.datepick.css" rel="stylesheet">
<script src="../js/jquery.plugin.js"></script>
<script src="../js/jquery.datepick.js"></script>
<script>
$(function() {
  $('#popupDatepicker').datepick();
  $('.inlineDatepicker').datepick({ });
});

 
</script>
<?php
if(!isset($_REQUEST['CID']))
  return false;
$CID=$_REQUEST['CID'];
$TID=$_REQUEST['TID'];
$MODE=get_mode($TID);
 
if($MODE==1){
$account_name=pabs_query('c_firstname','osd_customer','CID',$CID);
$c_address=pabs_query('c_address1','osd_customer','CID',$CID);
$c='  <li><a href="?page=search-customer">Customer List</a></li>';
$d='    <li><a href="?page=account-list&CID='.$CID.'">Account Ledger</a></li>';

}elseif($MODE==2){

$account_name=pabs_query('sup_name','osd_supplier','SID',$CID);
$c_address=pabs_query('sup_address1','osd_supplier','SID',$CID);
$c='  <li><a href="?page=search-supplier">Supplier List</a></li>';
$d='    <li><a href="?page=supplier-account-list&SID='.$CID.'">Supplier Account Ledger</a></li>';

}


$receipt_no=pabs_query('t_receiptno','osd_transaction','TID',$TID);
$lock_status=lock_status($TID, $MODE);
?>
  <script type="text/javascript" src="../js/bootstrap-datepicker.js"></script>
<link rel="stylesheet" href="assets/lib/bootstrap/css/datepicker.css">
<script >

</script>
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
<div><h5><strong><?php echo $account_name; ?></strong></h5></div>
</header>

 <ol class="breadcrumb">
  <li><a href="?page=index">Home</a></li>
  <li><a href="?page=transaction">Transactions</a></li>
<?php echo $c;?>
<?php echo $d;?>
  <li class="active">Accounts Payable Ledger </li>
</ol>


 
<div class="clear"></div>
<div class="<?php echo $lock_status==0 ?   'col-lg-4' :   'col-lg-12';?> no-right">
 

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"><strong>Accounts Receivable Details</strong></h3>
  </div>
  <div class="panel-body" style="padding:3px;">
  <div id="ar-area"></div>
<ul class="list-group" style="margin-bottom:5px;">
<!--   <li class="list-group-item">Transaction No.: <strong id="loading-tno">#</strong></li> -->
  <li class="list-group-item">Account Name : <strong><?php echo $account_name; ?></strong></li>
  <li class="list-group-item">Payment applied to : <strong><a href="#" class="show_receipt"  data-toggle="modal" data-target="#myModal"   id="<?php echo $TID;?>"><?php echo $receipt_no;?></a></strong></li>
 
</ul>

  <?php if($lock_status==1): 
  if(current_user('view-customer-ledger')):
    ?>
<div class="alert alert-success mb-0" role="alert">
  <div><i class="glyphicon glyphicon-lock"></i> No Balance <br><a href="?page=account-ledger&CID=<?php echo $CID;?>&TID=<?php echo $TID;?>" class="">View Transactions</a>
<br> 
<?php
endif;
if(current_user('unlock-payment')):
?>
<input type="button" id="unlock" data-toggle="modal" data-target="#AUTH" value="Unlock" class="btn btn-success">
<?php endif;?>
  </div>
</div>
 

  <?php endif;?>

<div id="debug"></div>
<div id="form-status"></div>


<div id="form-area">
<form id="form-ar">
  <?php if($lock_status==0): ?>
 <table class="table table-bordered table-condensed table-hover table-striped">


  <tr  class=" ">
  <td colspan="2" style="padding:10px ;"><strong >PAYMENT DATE</strong></td>
   
 </tr>
      <tr  class=" ">
  <td colspan="2"><strong>MM/DD/YYYY (<?php echo date('m/d/Y');?>)</strong></td>
   
 </tr>
     <tr class=" ">
  <td colspan="2"><input type="date" class="inlineDatepicker form-control datepicker" placeholder="Date" id="payment_date"></td>
   
 </tr>


  <tr>
 	<td class="col-lg-6">

 	<select class="form-control" id="type">
      <?php
      $rows1=sims_query2("tt_ID, tt_name","osd_transaction_type", $where="", $group="", "tt_name");
      foreach ($rows1 as $row1) {
      $ttID=$row1['tt_ID'];
      $tt_name=$row1['tt_name'];
      echo '<option value='.$ttID.'>'.$tt_name.'</option>';
      }
      ?>
 	</select>

 	</td>
 	<td>
 	<select class="form-control" id="bank">
      <option value="0">--Select Bank--</option>
      <?php
      $rows=sims_query2("b_bankID, b_bankName","osd_bank", $where="", $group="", "b_bankName");
      foreach ($rows as $row) {
      $b_bankID=$row['b_bankID'];
      $b_bankName=$row['b_bankName'];
      echo '<option value='.$b_bankID.'>'.$b_bankName.'</option>';
      }
      ?>
 	</select>
 	</td>
 </tr>


   <tr class="hide_form">
 	<td colspan="2"><input type="text" class="form-control all-caps" placeholder="Cheque #" id="chequeno"></td> 
 </tr>
     <tr  class="hide_form">
  <td colspan="2" style="padding:10px  ;"><strong>CHEQUE DATE</strong></td>
   
 </tr>
      <tr  class="hide_form">
  <td colspan="2"><strong>MM/DD/YYYY (<?php echo date('m/d/Y');?>)</strong></td>
   
 </tr>
     <tr class="hide_form">
  <td colspan="2"><input type="date" class="inlineDatepicker form-control datepicker" placeholder="Date" id="date"></td>
   
 </tr>

     <tr  class="hide_form">
  <td  class="right" ><strong>Balance</strong></td>
  <td class="balance"  > </td>
   
 </tr>
 
   <tr>
        <td ><span id="show_amount">P 0.00</span></td> 
 	<td ><input type="text" class="form-control numeric " placeholder="Amount" id="amount" autocomplete="off"></td>

 </tr>
   <tr>
  <td colspan="2">
<textarea class="form-control" id="note" placeholder="Payment Remarks"></textarea>

  </td>
   
 </tr>
 <tr>
 <tr>
<td colspan="2" id="save_area"></td>
 </tr>
 </tr>
 </table>
<?php endif;?>
</form>
</div>


  </div>
</div>

</div>
  <?php if($lock_status==0): ?>
<div class="col-lg-8 ledger">
 

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"><strong>Review Transaction/s</strong></h3>
  </div>

<div id="load-area_pending">
</div>
</div>


<div class="panel panel-success">
  <div class="panel-heading">
    <h3 class="panel-title"><strong>Successful Payments</strong></h3>
  </div>
    <div id="payment-success"></div>
<div id="load-area">
</div>
</div>




</div>
<?php endif;?>

<div id="div-4" class="accordion-body collapse in body">

<div id="loading-result" >


</div>
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

 
$("#type").change(function(){

var type=$("#type option:selected").text();
if(type=='Cheque'){

$(".hide_form").slideDown();

}else{
  $(".hide_form").slideUp();

}

});


  function commaSeparateNumber(val){
    while (/(\d+)(\d{3})/.test(val.toString())){
      val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
    }
    return val;
  }

var CID="<?php echo $CID;?>";
var TID="<?php echo $TID?>";
var MODE="<?php echo $MODE?>";

show_account_ledger(CID, TID, MODE);
show_account_ledger_pending(CID, TID, MODE);


function show_account_ledger_pending(CID, TID, MODE){

  $.ajax({
    data: {CID:CID, TID:TID, MODE:MODE},
    url:'../include/function/pos/account/account-ledger_pending.php',
    success:function(data){
   $('#load-area_pending').html(data);
      remove_btn();
      finalize_btn();
      ar_details();
      // deactivate();
    }


  });


}


function show_account_ledger(CID, TID){

  $.ajax({
    data: {CID:CID, TID:TID},
    url:'../include/function/pos/account/account-ledger_posted.php',
    success:function(data){
   $('#load-area').html(data);
     deactivate();
      // finalize_btn();
        ar_details_ledger();
        lock_btn();
 
    }


  });


}


function item_summary(tid){
  // reset();
  $("#transaction_details_ledger").html('LOADING...');
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

$('.show_receipt').click(function(){
var TID=$(this).attr('id');
item_summary(TID);
});




$('#amount').keyup(function(){
show_save();
var c=$(this).val();


var c_f=parseFloat(c);
var show_c=commaSeparateNumber(c_f.toFixed(2));
 
$("#show_amount").html('P '+show_c);

var balance=$("#rBalance").data('value');
// console.log(balance);
var c2=parseFloat(c);
if(isNaN(c2)){
$("#show_amount").html('P 0.00');
}

 
});

function show_save(){
var myBtn='<input type="button" class="btn btn-primary col-lg-12" value="Add Payment" id="save">';
$('#save_area').html(myBtn);
save_btn();

}

function hide_save(){
var myBtn='';
$('#save_area').html(myBtn);
}

function save_btn(){
$('#save').click(function(){

var CID="<?php echo $CID;?>";
var TID="<?php echo $TID?>";
var type=$('#type').val();
var bank=$('#bank').val();
var checque=$('#chequeno').val();
var amount=$('#amount').val();
var tdate=$('#date').val(); 
var desc=$('#note').val(); 
var payment_date=$('#payment_date').val(); 

add_payment( CID, TID, type, bank, checque, amount, tdate, desc, payment_date);

});	
}


function add_payment( CID, TID, type, bank, checque, amount, date, desc, payment_date){
$("#save").attr('disabled','disabled');	
     $('#ar-area').slideDown();
$('#ar-area').html('<div class="col-lg-12 loading-img"><img src="../images/loading-long.gif"></div>');
var slug="accounts-receivable";
var mode="<?php echo $MODE;?>";
  $.ajax({
    data: {  CID:CID, TID:TID,type:type, bank:bank, checque:checque, amount:amount, page:slug, date:date, desc:desc, mode:mode, payment_date:payment_date },
    url:'../include/function/add_class.php',
    success:function(data){
      getTNO();
     $('#ar-area').fadeIn();
   $('#ar-area').html('<div class="alert alert-success" role="alert"><i class="glyphicon glyphicon-ok"></i> Process Completed</div>');
show_account_ledger(CID, TID);
show_account_ledger_pending(CID, TID);
      $('#form-ar')[0].reset();
      $("#save").removeAttr('disabled');	
	close_area2();
	hide_save();
  $("#show_amount").html('P 0.00');
    }


  });


}


    function close_area2(){
     $('#ar-area').delay(5000).slideUp();
    }
        function close_area3(){
     $('#payment-success').delay(5000).slideUp();
    }

getTNO();
refresh_tid();

function refresh_tid(){
 setInterval(function() {
 getTNO();
    }, 5000);
}

function getTNO(){
 
	var empid="<?php echo get_employeee_id();?>";
	var TID="<?php echo $TID;?>";
	var CID="<?php echo $CID;?>";
	$.ajax({
		data:{empid:empid, CID:CID, TID:TID},
		url:'../include/function/pos/refresh_ar.php',
		success:function(data){
			$("#loading-tno").html(data);
		}
	});	
}



 function remove_btn(){
 $('.remove').click(function(){
if(confirm("Are you sure you want to remove the payment? ")){

var TID=$(this).attr('id');
var CTID="<?php echo $TID?>";
 var CID="<?php echo $CID;?>";
var slug="remove-ar";

  $.ajax({
    data: {TID:TID, page: slug},
    url:'../include/function/add_class.php',
    success:function(data){
show_account_ledger(CID, CTID);
show_account_ledger_pending(CID, CTID);
    }


  });

}


});	
 }


 function deactivate(){
 $('.deactivate').click(function(){
if(confirm("Are you sure you want to remove the payment? ")){

var TID=$(this).attr('id');
var CTID="<?php echo $TID?>";
 var CID="<?php echo $CID;?>";
var slug="deactivate-ar";

  $.ajax({
    data: {TID:TID, page: slug, CID:CID, CTID:CTID},
    url:'../include/function/add_class.php',
    success:function(data){
      // $("#debug").html('<pre>'+data+'</pre>');
show_account_ledger(CID, CTID);
show_account_ledger_pending(CID, CTID);
    }


  });

}


});	
 }



function finalize_btn(){
$("#finalize").click(function(){
if(confirm("Are you sure you want to process the payment? ")){
var TID="<?php echo $TID?>";
 var CID="<?php echo $CID;?>";
 var MODE="<?php echo $MODE;?>";
var slug="update-ar";
  $.ajax({
    data: {TID:TID, CID:CID,  page: slug, mode:MODE},
    url:'../include/function/add_class.php',
    success:function(data){
show_account_ledger(CID, TID);
show_account_ledger_pending(CID, TID);
$("#payment-success").html('<div class="alert  alert-info mb-0" role="alert"><i class="glyphicon glyphicon-ok"></i> Payment successful</div>');
close_area3();
    }

  });


}
});	
}

function lock_btn(){
$("#lock").click(function(){
var slug="lock-payment";
  $.ajax({
    data:{page:slug, CID:CID, TID:TID},
    url:'../home/view/view-result/edit-form/auth_payment.php',
    success:function(data){
      $("#auth").html(data);
      auth_event();
    }
  });

// if(confirm("Are you sure you want to process the payment? ")){
// var TID="<?php echo $TID?>";
//  var CID="<?php echo $CID;?>";
// var slug="update-ar";
//   $.ajax({
//     data: {TID:TID, CID:CID,  page: slug},
//     url:'../include/function/add_class.php',
//     success:function(data){
// show_account_ledger(CID, TID);
// show_account_ledger_pending(CID, TID);
// $("#payment-success").html('<div class="alert  alert-info mb-0" role="alert"><i class="glyphicon glyphicon-ok"></i> Payment successful</div>');
// close_area3();
//     }

//   });

// }


}); 
}


function ar_details(){
 $(".ardetails").click(function(){
var id=$(this).attr('id');
$('#details-'+id).slideToggle();
 }); 
}
function ar_details_ledger(){
 $(".ardetails").click(function(){
var id=$(this).attr('id');
$('#details_posted-'+id).slideToggle();
 }); 
}


function auth_event(){
$("#pwd").keyup(function(){
var slug="lock-payment"; 
var empid="<?php echo get_employeee_id();?>"; 
var TID="<?php echo $TID;?>"; 
var pwd=$(this).val();

auth(slug,empid, pwd, TID );

});


}

function auth_event_unlock(){
$("#pwd").keyup(function(){
var slug="unlock-payment"; 
var empid="<?php echo get_employeee_id();?>"; 
var TID="<?php echo $TID;?>"; 
var pwd=$(this).val();

auth(slug,empid, pwd, TID );

});


}

function auth(slug,empid, pwd, ID){
// console.log(slug);
  $.ajax({
    data: {TID:TID, page: slug, empid:empid, pwd:pwd},
    url:'../include/function/add_class.php',
    success:function(data){
  $(".edit-area").html(data);
  var ar=$(".result-ar").attr('id');
  if(ar==1){
  window.location="?page=account-receivable&CID=<?php echo $CID;?>&TID=<?php echo $TID;?>";
  }

    }


  });

}  

$("#unlock").click(function(){
var slug="unlock-payment";
  $.ajax({
    data:{page:slug, CID:CID, TID:TID},
    url:'../home/view/view-result/edit-form/auth_payment.php',
    success:function(data){
      $("#auth").html(data);
      auth_event_unlock();
    }

  });
 


});


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


    <!-- Modal -->
<div class="modal fade" id="AUTH" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width:500px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Authentication</h4>
      </div>
      <div class="modal-body" id="auth">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
      </div>
    </div>
  </div>
</div>