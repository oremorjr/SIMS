<?php
if(!current_user('pages'))
  return false;
?>
<?php $slug='page';?>
<span id="slug" data-value="<?php echo $slug;?>" style="text-transform:uppercase;"></span>
<link rel="stylesheet" href="assets/lib/validationengine/css/validationEngine.jquery.css">
<script type="text/javascript">
	 
		$(document).ready(function(){	


		/* @FUNCTIONS */
		focus();

		// function show_result(){
		// var slug=$("#slug").data('value'); 
		// $('#loading-result').load('view/view-result/'+ slug +'-list.php?slug=' + slug);
 	
		// }

		    function show_result(){
		    var slug=jQuery("#slug").data('value'); 
		      jQuery.ajax({
		        data: {slug: slug},
		        url: 'view/view-result/'+ slug +'-list.php',
		        success: function(data){
		           jQuery('#loading-result').html(data);
		        },
		        beforeSend:function(){
		           jQuery('#loading-result').html('loading');
		        }

		      });

		    }

		
		
		function loading(){
			$('#save').attr("disabled", "disabled");
			$("#form-area").addClass("while-saving");
			$(".new-loading").fadeIn();
		}	
		function duplicate(){
			show_status();
			$("#retry").fadeIn();
			$(".form-status").removeClass("alert alert-success");
			$(".form-status").addClass("alert alert-danger");
			$(".form-status").text("Record Duplicated");
			$(".new-loading").hide();		
			$('#save').val('Failed');
			$('#clear').attr('disabled', 'disabled');
			lock_form();
		}		
		function success(){
			show_status();
			$(".form-status").removeClass("alert alert-danger");
			$(".form-status").addClass("alert alert-success");
			$(".form-status").text("Success");					
			$('#form-add')[0].reset();
			$(".new-loading").hide();	
			$('#save').val('Saved');
			$('#save').attr("disabled", "disabled");
			$("#new").fadeIn();
			lock_form();
			show_result();
			
		}
		function show_status(){
			$("#status-area").slideDown();
		}
		function reset(){
			$("#status-area").slideUp();
			$('#form-add')[0].reset();
			$('#save').val('Save');
			$('#save').removeAttr("disabled", "disabled");
			$("#form-area").removeClass("while-saving");
			$(".new-loading").hide();	
			$('.chosen-single span').text('Choose an item...');
			$('.active-result').removeClass('result-selected');		

			unlock_form();
		}
		function retry(){
			unlock_form();
			$("#form-area").slideDown();
			$("#status-area").slideUp();
			$('#save').val('Save');
			$('#save').removeAttr("disabled", "disabled");
			$("#form-area").removeClass("while-saving");
			$(".new-loading").hide();	
		}		

			function lock_form(){
				$("input").prop('disabled', true);
			}
			function unlock_form(){
				$("input").prop('disabled', false);
				focus();
			}	
			function focus(){
			$(".first-input").focus();
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
		











			$("#page_name").keyup(function(){
			        var Text = $(this).val();
			        Text = Text.toLowerCase();
			        Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
			        $("#page_slug").val(Text);        
			});


			show_result();

			$.validator.setDefaults({
			submitHandler: function() {
			 add();
			}
			});



			$("#form-add").validate({
	 
				rules:{
					f1:{required:true},
					f2:{required:true}
					// f3:{required:true},
					// f4:{required:true,email:true},
					// f5:{required:false},
					// f6:{required:false},
					// f7:{required:false},
					// f8:{required:false},
					// f9:{required:false},
					// f10:{required:false},
					// f11:{required:false},
					// f12:{required:false},
					// f13:{required:false},
		 
				} 
			
			});
        function add(){
        	loading();
                $.ajax({
                    type: "POST",
                    url: "../include/function/add_class.php?page=<?php echo $slug;?>",
                    data: $("#form-add").serialize(),
                    success: function(data){
                    	$('.result-area').html(data);
                    	var result=$('.result').data('value');
                    	if(result==1){
                    		success();
                    		// window.location='?page=pages';
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
<!-- 			<div id="breadcrumb2">
				<ul class="crumbs">
					<li class="first"><a href="?page=dashboard" style="z-index:9;"><span></span>Dashboard</a></li>
					<li><a href="?page=supplier" style="z-index:8;"><?php echo $slug;?></a></li>
				</ul>
			</div>		 -->
<div class="inner">
	<div class="col-lg-12" style="min-height:470px;">
		<div class="row">
			<div class="box">
				<header>
					<div class="icons">
						<i class="fa fa-table"></i>
					</div>
					<div><h5>Page's Dashboard</h5></div>
				</header>
				<!-- start customer-->
				<div class="col-lg-5">
				<div class="box dark">
						<header>
						<div class="icons">
						<i class="fa fa-edit"></i>
						</div>
						<h5>Add Page</h5>
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
					<div id="form-area"> 
					<div class="new-loading" style="display:none;">
					<img src="../images/loading_animation.gif" width="180">
					</div>

<table class="table table-bordered table-striped">
<tr>
	<td><label>Category</labe></td>
	<td>
	<select name="f4" class="form-control">
	<option value=" ">None</option>
	<option value="Tools">Tools</option>
	<option value="Reports">Reports</option>
	<option value="Maintenance">Maintenance</option>
	<option value="Transaction">Transaction</option>
	<option value="User">User</option>
	<option value="Variation">Variation</option>
	<option value="Item">Item</option>
	<option value="Category">Category</option>
	<option value="Bank">Bank</option>
	<option value="Checker">Checker</option>
	<option value="Truck">Truck</option>
	<option value="Driver">Driver</option>
	<option value="Agent">Agent</option>
	<option value="Reports">Reports</option> 
	<option value="Supplier">Supplier</option> 
	<option value="Customer">Customer</option> 
	<option value="Category">Category</option> 
	<option value="Unit">Unit</option> 
	<option value="User Group">User Group</option>  
	<option value="Transaction Type">Transaction Type</option>  
	</select>
	</td>
</tr>
 <tr>
	<td><label>Type</labe></td>
	<td>
	<select name="f5" class="form-control">
	<option value="0 ">Main Navigation</option>
	<option value="1">Sidebar</option>
	<option value="2">Capability</option>
	</select>

	</td>
</tr>
 <tr>
	<td><label>Group</labe></td>
	<td><input type="text"  name="f6" class="first-input form-control" id="capability_group"></td>
</tr>


<tr>
	<td><label>Name</labe></td>
	<td><input type="text"  name="f1" class=" form-control" id="page_name"></td>
</tr>
<tr>
	<td><label>Slug</labe></td>
	<td><input type="text"  name="f2" class="form-control" id="page_slug"></td>
</tr>

 
</table>

 
  
 

					  </fieldset>
                    </form>
						</div>
					</div>
				</div>
				<!-- end customer-->
				
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
	
 
  