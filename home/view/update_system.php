
 
 

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
					<div><h5>Update System</h5></div>
				</header>
 
						<div id="div-4" class="accordion-body collapse in body">

							<div id="loading-result" >

<?php
 

if(isset($_POST['resetcode'])){

$val=$_POST['code'];


if($val=='1107'){
 
 update_DB();

}

}
 ?>

		 
<form name="reset" method="POST">
<div class="col-lg-6">	
<input type="password" name="code" class="form-control">
</div>
<div class="col-lg-6">
<input type="submit" name="resetcode" value="Update" class=" ">
</div>
</form>						 
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
 
 
    <script src="assets/lib/tablesorter/js/jquery.tablesorter.min.js"></script>
    <script src="assets/lib/touch-punch/jquery.ui.touch-punch.min.js"></script>
 
 
