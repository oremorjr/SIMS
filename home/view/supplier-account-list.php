<?php
if(!current_user('supplier-account-ledger'))
  return false;
?>
<?php
if(!isset($_REQUEST['SID']))
  return false;
$CID=$_REQUEST['SID'];
$account_name=pabs_query('sup_name','osd_supplier','SID',$CID);
$c_address=pabs_query('sup_address1','osd_supplier','SID',$CID);
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
  <li><a href="?page=search-supplier">Supplier List</a></li>
  <li class="active">Account Ledger</li>
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


  
 <table class="table table-bordered table-condensed table-hover table-striped">
<tr>
  <td width="50%">Customer Account ID : <strong><span class="all-caps"><?php echo get_unique_id($CID, 4);?></span></strong></td> 
  <td> Account Name  : <strong><span ><?php echo $account_name;?></span></strong></td>
</tr>
<tr>
  <td width="50%">Address : <strong><span class="all-caps"><?php echo $c_address;?></span></strong></td>  
  <td>Total Balance  : <strong><span id="total_balance" >0.00</span></strong></td>
</tr>
</table>


  </div>
</div>


</div>








<div class="col-lg-12 grid ledger">


<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"><strong>List of Unpaid Invoices</strong></h3>
  </div>
  <div class="panel-body">


  <div id="unpaid-invoice">
  </div>
 
 

  </div>
</div>


 

</div>
<!-- list of unpaid -->
<?php

$position=get_current_position();

if($position==1 OR $position==2):
?>
 
<div class="col-lg-12 grid ledger">


<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"><strong>List of Paid Invoices</strong></h3>
  </div>



 <table class="table table-bordered table-condensed table-hover table-striped">
<tr>
<td colspan="2"><strong>Filter Date</strong></td>
</tr>


<tr>
<td>
   <select class="form-control mb-0" id="month" >

  <?php
$rows=osd_query("osd_account_ledger", $where="al_mode=2", "MONTH(al_transact_date)");
$ynow=date('F');
$mnow=date('m');
echo '<option value='.$mnow.'>--Select Month--</option>';
echo '<option value='.$mnow.'>'.$ynow.'</option>';
 

foreach($rows as $row){
$ty=$row['al_transact_date'];
$y_ty=date('m', strtotime($ty));
$m_ty=date('m', strtotime($ty));
$show_tm=date('F', strtotime($ty));
if($mnow!=$m_ty):
echo '<option value='.$m_ty.'>'.$show_tm.'</option>';
endif;
} 
?>

   </select>

</td>
<td>

   <select class="form-control mb-0" id="sy" >

  <?php
$rows=osd_query("osd_account_ledger", $where="al_mode=2", "YEAR(al_transact_date)");
$ynow=date('Y');
echo '<option value='.$ynow.'>--Select Year--</option>';
echo '<option value='.$ynow.'>'.$ynow.'</option>';
 
foreach($rows as $row){
$ty=$row['al_transact_date'];
$y_ty=date('Y', strtotime($ty));
if($y_ty!=$ynow):
echo '<option value='.$y_ty.'>'.$y_ty.'</option>';
endif;
} 
?>

   </select>

</td>

</tr>

</table>






 
 

  <div class="panel-body">


  <div id="paid-invoice">
  </div>


  </div>
</div>





            </div> 
          <?php endif;?>
         
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
var MODE="2";
var Y=$("#sy option:selected").val();
var M=$("#month option:selected").val();


unpaid_invoice(CID,MODE);
paid_invoice_year(CID, Y, M, MODE);


$("#sy").change(function(){
var Y=$(this).val();
 var M=$("#month option:selected").val();
paid_invoice_year(CID, Y, M, MODE);


});

$("#month").change(function(){
var Y=$("#sy option:selected").val();
 var M=$(this).val();
paid_invoice_year(CID, Y, M, MODE);


});

$('.filter').click(function(){
  $('#receipt-list').html('<div class="col-lg-12 loading-img"><img src="../images/loading-long.gif"></div>');
var string=$('.string').val();
  $.ajax({
    data: {RNO:string},
    url:'../include/function/pos/customer-list.php',
    success:function(data){
   $('#receipt-list').html(data);
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


 