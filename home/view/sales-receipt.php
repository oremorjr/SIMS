<?php
if(!current_user('sales-receipt'))
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
          <div><h5> Search Receipt</h5></div>
        </header>
 
            <div id="div-4" class="accordion-body collapse in body">

              <div id="loading-result" >
  <div class="col-lg-7">
 
<div class="col-lg-12 grid">
<label>Receipt No.</label>
</div>
 

<div class="col-lg-5 grid no-right">
<input type="text" class="form-control string">
</div>
<div class="col-lg-4 grid no-right">
   <select class="form-control " id="sy" >

  <?php
$rows=osd_query("osd_transaction", $where="t_mode=1 and t_active=0", "YEAR(t_transaction_date)");
$ynow=date('Y');
echo '<option value='.$ynow.'>--Select Year--</option>';
echo '<option value='.$ynow.'>'.$ynow.'</option>';
foreach($rows as $row){
$ty=$row['t_transaction_date'];
$y_ty=date('Y', strtotime($ty));
if($y_ty!=$ynow):
echo '<option value='.$y_ty.'>'.$y_ty.'</option>';
endif;
} 
?>

   </select>
</div>
 
<div class="col-lg-3 grid">
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
var year=$("#sy").val();;
var string=$('.string').val();
if(string!=""){
  $(".string").removeClass('red-border');
  $('#receipt-list').html('<div class="col-lg-12 loading-img"><img src="../images/loading-long.gif"></div>');
 search_receipt(string, year);
}else{
   $(".string").addClass('red-border'); 
     $('#receipt-list').html(' ');
}
});


function search_receipt(string, year){
   $.ajax({
    data: {RNO:string, year:year},
    url:'../include/function/pos/sales-receipt-list.php',
    success:function(data){
   $('#receipt-list').html(data);
    }


  }); 
}
 





 });
 </script>