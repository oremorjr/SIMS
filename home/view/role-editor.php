<?php
if(!current_user('role-editor'))
  return false;
?>
<?php $slug='position';?>
<span id="slug" data-value="<?php echo $slug;?>" style="text-transform:uppercase;"></span>
<link rel="stylesheet" href="assets/lib/validationengine/css/validationEngine.jquery.css">
<script type="text/javascript">
$(document).ready(function(){
	var posid2=$('.role').val();
	show_page(posid2);

	$('.role').change(function(){

	var posid=$(this).val();
	show_page(posid);


	});

	function show_page(posid){
	$.ajax({
	data: {positionid: posid},
	url: "../include/function/page_list.php",
	success:function(data){
		$('.page-area').html(data);
	}


	});		
	}


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
					<div><h5>User Group Page Access Dashboard</h5></div>
				</header>

 <ol class="breadcrumb mb-0">
  <li><a href="?page=index">Home</a></li> 
  <li> Tools</li> 
  <li class="active">User Group Page Access  </li>
</ol>




				<?php

				?>
			<div class="col-lg-12 grid">

			 <table class="table table-bordered table-condensed table-hover table-striped">
			<tr>
			 
			<td>
			<select  class="form-control chosen-select role"   tabindex="4" autocorrect="off" autocomplete="off" name="f4">
			<?php
			$rows=osd_query('osd_position',$where='', $group='p_posname ORDER BY p_posid');
			foreach($rows as $row){

			$position_id=$row['p_posid'];
			$posname=$row['p_posname'];
			?>
			<option value="<?php echo $position_id;?>"><?php echo $posname;?></option>
			<?php


			}
			?>
			</select>
			</td>
			</tr>
			</table>


			</div>
			<div class="clear"></div>

			<div class="col-lg-12">
			<div class="page-area"></div>		
			</div>
			 
 
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
	
 
  