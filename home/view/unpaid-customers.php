<?php
$mode=1;
?>

<span id="slug" data-value="<?php echo $slug;?>"></span>
<link rel="stylesheet" href="assets/lib/validationengine/css/validationEngine.jquery.css">
 

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
          <div><h5> Unpaid Customers</h5></div>
        </header>
 
            <div id="div-4" class="accordion-body collapse in body">

<div class="col-lg-12 grid ledger">
      <div class="print print-report none"><i class="glyphicon glyphicon-print"></i> Print</div>

 <div id="unpaid-invoice">
</div>
 

</div>
<!-- list of paid -->
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
var CID="0"; 
var MODE="<?php echo $mode;?>";
unpaid_invoice_list(CID, MODE);
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
<script>
$(document).ready(function() {  
  $('.year').hide();
  $('.print-report').click(function(){
    window.print();
  });
 
}); 
</script> 
 