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
          <div><h5> Search Item</h5></div>
        </header>
 
            <div id="div-4" class="accordion-body collapse in body">

              <div id="loading-result" >
  <div class="col-lg-5">
 
<div class="col-lg-12 grid">
<label>Item Name</label>
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

var string=$('.string').val();
// search(string);

$('.filter').click(function(){

var string2=$('.string').val();
search(string2);

});


function update_btn(){

$(".btn_update").click(function(){       
  var slug='item';
  var ID=$(this).data('value');
  $.ajax({
  data: {slug:slug, ID:ID}, 
  url: "view/view-result/edit-form/edit-"+slug+"-form.php",
  success:function(data){
  $('#load-record').html(data);
  }
  });
       
}); 

$(".btn_unit").click(function(){
 var slug='item';
var ID=$(this).data('value');
//alert(ID);
$.ajax({
  data: {slug:slug, ID:ID}, 
  url: "view/view-result/edit-form/add-unit-form.php",
  success:function(data){
    $('#load-record-2').html(data);
  }
});
}); 


$(".btn_delete").click(function(){
  var slug='item';
  var ID=$(this).data('value');
  // console.log(ID);

  $.ajax({
  data: {slug:slug, ID:ID}, 
  url: "view/view-result/edit-form/auth.php",
  success:function(data){
  $('#auth-load').html(data);
  }
  });


}); 


}


function search(string){
  $('#receipt-list').html('<div class="col-lg-12 loading-img"><img src="../images/loading-long.gif"></div>');
   $.ajax({
    data: {RNO:string},
    url:'../include/function/pos/item-list.php',
    success:function(data){
   $('#receipt-list').html(data);
   update_btn();
    }


  }); 
}

 });
 </script>


 
     <!-- #helpModal -->
    <div id="edit-modal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Edit </h4>
          </div>
          <div class="modal-body">
      <div id="div-1" class="accordion-body collapse in body">


      <div id="load-record"></div>


      </div>
          </div>
          <div class="modal-footer">
            <button id="btn-close" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal --><!-- /#helpModal -->


     <!-- #addUnit -->
    <div id="unit-modal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="form-name">Add Unit </h4>
          </div>
          <div class="modal-body">
      <div id="div-1" class="accordion-body collapse in body">


      <div id="load-record-2"></div>


      </div>
          </div>
          <div class="modal-footer">
            <button id="btn-close" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal --><!-- /#helpModal -->

         <!-- #AUTH -->
    <div id="del-modal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Security </h4>
          </div>
          <div class="modal-body">
            <div id="div-1" class="accordion-body collapse in body">
              <div id="auth-load"></div>
            </div>
          </div>
          <div class="modal-footer">
            <button id="btn-close" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal --><!-- /#helpModal -->