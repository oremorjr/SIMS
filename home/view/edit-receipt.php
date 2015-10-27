<?php
if(!current_user('edit-receipt'))
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
          <div><h5> Edit Receipt</h5></div>
        </header>
 
            <div id="div-4" class="accordion-body collapse in body">

              <div id="loading-result" >
  <div class="col-lg-5">
 
<div class="col-lg-12 grid">
<label>Receipt No.</label>
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
  $('#receipt-list').html('<div class="col-lg-12 loading-img"><img src="../images/loading-long.gif"></div>');
var string=$('.string').val();
  $.ajax({
    data: {RNO:string},
    url:'../include/function/pos/receipt-list.php',
    success:function(data){
   $('#receipt-list').html(data);
    }


  });

});
 });
 </script>