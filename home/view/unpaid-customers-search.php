<?php
if(!current_user('search-unpaid-customers'))
  return false;
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
          <div><h5>Search Unpaid Customers</h5></div>
        </header>
 
            <div id="div-4" class="accordion-body collapse in body">

              <div id="loading-result" >
  <div class="col-lg-5">
 
<div class="col-lg-12 grid">
<label>Customer Name/Receipt No.</label>
</div>
 

<div class="col-lg-8 grid no-right">
<input type="text" class="form-control string">
</div>
 
<div class="col-lg-4 grid">
<input type="button" class="filter btn btn-success" value="Search" >
</div>


</div><!-- end col-lg-6 -->
   
             
              </div>
              <div class="col-lg-12">
              <div id="receipt-list">
              </div>
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
$('.filter').click(function(){

var string=$('.string').val();
if(string!=""){
  $(".string").removeClass('red-border');
  $('#receipt-list').html('<div class="col-lg-12 loading-img"><img src="../images/loading-long.gif"></div>');
 search_customers_unpaid(string);
}else{
   $(".string").addClass('red-border'); 
     $('#receipt-list').html(' ');
}
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

 