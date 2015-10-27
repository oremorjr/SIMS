<?php $slug='user';?>
<span id="slug" data-value="<?php echo $slug;?>" style="text-transform:uppercase;"></span>
<link rel="stylesheet" href="assets/lib/validationengine/css/validationEngine.jquery.css">
<script type="text/javascript">
		$.getScript('../js/add/add.js', function() {
		$(document).ready(function(){		
			show_result();
			$("#form-add").validate({
				onkeyup:true,
				submitHandler: add,
				rules:{
					f1:{required:true},
					f2:{required:true},
					f3:{required:true},
					f4:{required:true,email:true},
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
                $.ajax({
                    type: "POST",
                    url: "../include/function/add.php?page=<?php echo $slug;?>",
                    data: $("#form-add").serialize(),
                    success: function(data){
						if(data.res==1){
							 success();
						}else if(data.res==2){
							duplicate();
						}
					},
					beforeSend: function() {
						loading();
					},
			
					dataType: 'json'
                });
				 return false;
        }//End funtion for login trigger
 





 
		});
		});		
		
</script>

<div id="content">

<div class="outer">
			<div id="breadcrumb2">
				<ul class="crumbs">
					<li class="first"><a href="?page=dashboard" style="z-index:9;"><span></span>Dashboard</a></li>
					<li><a href="?page=supplier" style="z-index:8;"><?php echo $slug;?></a></li>
				</ul>
			</div>		
<div class="inner">
	<div class="col-lg-12" style="min-height:470px;">
		<div class="row">
			<div class="box">
				<header>
					<div class="icons">
						<i class="fa fa-table"></i>
					</div>
					<div><h5><?php echo $slug;?>'s Dashboard</h5></div>
				</header>
				<!-- start customer-->
				<div class="col-lg-5">
				<div class="box dark">
						<header>
						<div class="icons">
						<i class="fa fa-edit"></i>
						</div>
						<h5>Add User</h5>
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
					<div id="form-area"> 
					<div class="new-loading" style="display:none;">
					<img src="../images/loading_animation.gif" width="180">
					</div>

<table class="table table-bordered table-striped">
<tr>
	<td><label>First Name</labe></td>
	<td><input type="text"  name="f1" class="first-input form-control"></td>
</tr>
<tr>
	<td><label>Last Name</labe></td>
	<td><input type="text"  name="f2" class=" form-control"></td>
</tr>
<tr>
	<td><label>Position</labe></td>
	<td><input type="text"  name="f3" class=" form-control"></td>
</tr>
<tr>
	<td colspan="2"><legend>Account</legend></td>
 
</tr>
<tr>
	<td><label>Username</labe></td>
	<td><input type="text"  name="f4" class=" form-control"></td>
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
	
 
  