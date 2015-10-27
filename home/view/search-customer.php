<?php
if(!current_user('customer-account-ledger'))
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
          <div><h5> Account Ledger</h5></div>
        </header>
 
            <div id="div-4" class="accordion-body collapse in body">

              <div id="loading-result" >
  <div class="col-lg-5">
 
 
 


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
 

search_customer('');

function search_customer(string){

    $('#receipt-list').html('<div class="col-lg-12 loading-img"><img src="../images/loading-long.gif"></div>');
   $.ajax({
    data: {RNO:string},
    url:'../include/function/pos/customer-list.php',
    success:function(data){
   $('#receipt-list').html(data);
    }


  }); 
}

 });
 </script>