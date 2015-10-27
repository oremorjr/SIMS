<?php $slug='item';


?>

<span id="slug" data-value="<?php echo $slug;?>"></span> 
 
 
<script type="text/javascript">




 
		$(document).ready(function(){




        
        function loading(){
              $('.result-area').slideDown('fast');
              $('#save').attr("disabled", "disabled");
            $('.result-area').html('<div class="loading"><i class="glyphicon glyphicon-refresh"></i> Loading...</div>');
        }   
        function success(){
            $('.result-area').slideDown('fast');
            $('#form-add')[0].reset();
            $('.result-area').html('<div class="success"><i class="glyphicon glyphicon-ok"></i> Process Completed. </div>');
            close_area2();

        }
        function duplicate(){
              $('.result-area').slideDown('fast');
            $('.result-area').html('<div class="duplicate-data"><i class="glyphicon glyphicon-warning-sign"></i> Record already exists.</div>');
              $('#save').removeAttr("disabled");

            show_result();
        }
        function close_area2(){
         $('.result-area').delay(10000).slideUp('fast');
        }
	function focus(){
	$(".first-input").focus();
	}



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
		// var pname=$("#modal-name").attr('id');
		// $("#form-name").html(pname);
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












		/* @FUNCTIONS */
		focus();

		// function show_result(){
		// var slug=$("#slug").data('value'); 
		// $('#loading-result').load('view/view-result/'+ slug +'-list.php?slug=' + slug);
 	
		// }

		    function show_result(){
		     $('#save').attr("disabled", "disabled");
		    jQuery('#loading-result').html('loading');
		    var slug=jQuery("#slug").data('value'); 
		      jQuery.ajax({
		        data: {slug: slug},
		        url: 'view/view-result/'+ slug +'-list.php',
		        success: function(data){
		           jQuery('#loading-result').html(data);
		             $('#save').removeAttr("disabled");
		        }
		        
		      });

		    }

		


		/* /FUNCTIONS */
		
		/* @EVENTS */		
		$("#new").click(function(){
			$(".first-input").focus();
			reset();
			$(this).fadeOut('fast');
		});
		$("#clear").click(function(){
			reset();
		});	
		$("#retry").click(function(){
			retry();
			$(this).fadeOut('fast');
			$('#clear').removeAttr("disabled", "disabled");
		});		
		$("#save").click(function(){
			$("#form-add").trigger('submit');
		});	 
		/* /FUNCTIONS */
			

			$('.list').addClass('hidden');
			show_result();

			$.validator.setDefaults({
			submitHandler: function() {
			 add();
			}
			});

			$("#form-add").validate({ 
			
				rules:{
					f1:{required:true},
					f2:{required:true},
					// f3:{required:true},
					f4:{required:true,email:false},
					f5:{required:false},
					f6:{required:false},
					f7:{required:false},
					f8:{required:false},
					f9:{required:false},
					f10:{required:false},
					f11:{required:false},
					f12:{required:false},
					f13:{required:false},

				}

			});
        function add(){
         	loading();
                $.ajax({
                    type: "POST",
                    url: "../include/function/add/add_item.php?page=<?php echo $slug;?>",
                    data: $("#form-add").serialize(),
                    success: function(data){
                    	  $('#save').removeAttr("disabled");
                    	$('.result-area').html(data);
                    	var result=$('.result').data('value');
                    	var PID=$('.PID').data('value');
                    	var p1=$('.pname').data('value');
                    	var prep=$('.prep').html();
                    	var brand=$('.brand').data('value');
                    	var total=$('.total').data('value');
                    	if(result==1){
                    		// show_result();
                    		success();
                    		$('#item-list').prepend('<tr id="list-'+PID+'"><td>'+PID+'</td><td><div class="n1-'+PID+'">'+p1+'</div><div class="sub n2-'+PID+'">'+brand+'</div></td><td>'+prep+'</td></tr>');
                    		update_btn();
                    		$('.row-count').html(total+' record/s');
                    		$('.dataTables_info').html('Showing 1 to 5 of '+total+' entries');

                    	}else if(result==2){
			duplicate(); 
                    	}


 
					} 

					// dataType: 'json'
                });
				 // return false;
        }//End funtion for login trigger







		});
	 

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
					<div><h5>Items Dashboard</h5></div>
				</header>

 <ol class="breadcrumb">
  <li><a href="?page=index">Home</a></li> 
  <li class="active">Items</li>
</ol>
				<?php
				$count=0;
				if(current_user('add-item')):
				$count+=1;
				?>

				<!-- start customer-->
				<div class="col-lg-5">
					<div class="box dark">
						<header>
						<div class="icons">
						<i class="fa fa-edit"></i>
						</div>
						<h5>Add Item</h5>
							<div class="toolbar">
								<div class="btn-group">
									<a id="retry" style="display:none;" href="#" data-toggle="collapse" class="btn btn-sm btn-default minimize-box btn-save">
										<i class="glyphicon glyphicon-plus-sign"></i> RETRY
									</a>
									<a id="new" style="display:none;" href="#" data-toggle="collapse" class="btn btn-sm btn-default minimize-box btn-save">
										<i class="glyphicon glyphicon-plus-sign"></i> NEW
									</a>
									<a id="save" href="#" data-toggle="collapse" class="btn btn-sm btn-default minimize-box btn-save">
										<i class="glyphicon glyphicon-plus-sign"></i> ADD
									</a>
									<a  id="clear"  class="btn btn-danger btn-sm">
										<i class="fa fa-times"></i>
									</a>
								</div>
							</div>
						</header>
						<div id="div-1" class="search-form accordion-body collapse in body">
                    <form action="#" method="post" class="form-horizontal" id="form-add">
					<fieldset>


					<div id="status-area" style="display:none;">
					<div>
						<h5 class="form-status"></h5>
					</div>
					</div>

					<div class="result-area">
					</div>
					<br>
					<div id="form-area">
					<div class="new-loading" style="display:none;">
					<img src="../images/loading_animation.gif" width="180">
					</div>
	 
					<div class="form-group trans-form">
					 <label class="control-label col-lg-4 required">Category</label>
					<div class="col-lg-5">
					<div>
					<?php
					$query=mysql_query("SELECT * FROM osd_category")or die(mysql_error());
					?>
					<select name="f2" data-placeholder="Choose Category..."   class="form-control category"   tabindex="4" autocorrect="off" autocomplete="off">
					<option value="" selected="selected">Select Category</option>
					<?php
					while($row=mysql_fetch_array($query)){
					?>
					<option value="<?php echo $row['CID'];?>" ><?php echo $row['cat_name'];?></option>
					<?php
					}
					?>

					</select>

					</div>

					</div>
					<div class="col-lg-2">
					<a style="line-height:1.88;text-decoration:none;" href="welcome?page=category"    >
						<i class="glyphicon glyphicon-plus-sign"></i>  
					</a>
					</div>
					</div>
					<hr style="clear:none;"></hr>

                      <div class="form-group">
                        <label class="control-label col-lg-4 ">UPC/EAN/ISBN:</label>
                          <div class="col-lg-7">
                          <input type="text"  name="f3" class="form-control all-caps" style="text-transform:uppercase;">
                        </div>
                      </div>
                       <div class="form-group">
                        <label class="control-label col-lg-4 required ">Brand</label>
                          <div class="col-lg-7">
                          <input type="text"  name="f6" class="form-control all-caps">
                        </div>
						</div>
                      <div class="form-group hidden">
                        <label class="control-label col-lg-4 required">Item Name</label>
                          <div class="col-lg-7">
                          <input type="text"  name="f5" class="form-control all-caps">
                        </div>
                      </div>
                       <div class="form-group">
                        <label class="control-label col-lg-4 required">Item Description</label>
                          <div class="col-lg-7">
                          <textarea  name="f4" class="form-control all-caps"></textarea>
                        </div>
						</div>





					  </fieldset>
                    </form>





						</div>
					</div>
				</div>
				<!-- end customer-->

			<?php endif;?>


				<?php
				 
				if(current_user('view-item')):
					$count+=1;
				?>
				<!-- start results-->
				<div class="col-lg-7">
					<div class="box inverse"  style="min-height:400px;">
						<header>
							<div class="icons">
								<i class="glyphicon glyphicon-shopping-cart"></i>
							</div>
							<h5>Results</h5>
							<!-- .toolbar -->
							<div class="toolbar">
							</div><!-- /.toolbar -->
						</header>
						<div id="div-4" class="accordion-body collapse in body">
							<div id="loading-result" >
							</div>
						</div>
					</div>
				</div>
				<!-- end Results-->
				<?php endif;?>


				<?php
				if($count==0):
				?>

				<div class="col-lg-12 grid mb-0">
 

				<div class="panel panel-default">
				  <div class="panel-heading">
				    <h3 class="panel-title"><strong>Items</strong></h3>
				  </div>
				  <div class="panel-body">


				  
				<div class="alert alert-warning" role="alert"><i class="glyphicon glyphicon-warning-sign"></i> Page blocked. Please ask for your Administrator's permission for this menu.</div>


				  </div>
				</div>
				</div> 


				<?php endif;?>








			</div><!-- /.box -->
		</div><!-- /.row -->
	</div><!-- /.col -->


</div>
<!-- end .inner -->
</div>
<!-- end .outer -->
</div>
<!-- end #content -->



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



    <script src="assets/lib/datatables/jquery.dataTables.js"></script>
 