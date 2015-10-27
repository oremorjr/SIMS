<?php
require('../../../../include/db_config.php');
$connect=new DB();
$id=$_GET['ID'];
$q1=mysql_query("SELECT * from osd_supplier where SID=$id");
$slug=$_GET['slug'];
while($r=mysql_fetch_array($q1)){
$f1=$r['sup_last_name'];
$f2=$r['sup_first_name'];	
$f3=$r['sup_email'];	
$f4=$r['sup_contact_no'];	
$f5=$r['sup_address1'];	
$f6=$r['sup_address2'];	
$f7=$r['sup_city'];	
$f8=$r['sup_state'];	
$f9=$r['sup_zip'];	
$f10=$r['sup_country'];	
$f11=$r['sup_account_no'];  
$f13=$r['sup_name'];	
}
?>
<span id="slug" data-value="<?php echo $slug;?>"></span>
<span id="ID_" data-value="<?php echo $id;?>"></span>
<script type="text/javascript" src="../js/update/update_sims.js" ></script>
 				<!-- start customer-->
				<div class="col-lg-12">
					<div class="box dark">
						<header>
						<div class="icons">
						<i class="fa fa-edit"></i>
						</div>
						<h5>Edit <?php echo $f2;?>'s Information</h5>
							<div class="toolbar">
								<div class="btn-group">
 								
									<a id="update" href="#" data-toggle="collapse" class="btn btn-sm btn-default minimize-box btn-save">
										<i class="glyphicon glyphicon-plus-sign"></i> Update
									</a>	
								 
								</div>
							</div>
						</header>
						<div id="div-1" class="search-form accordion-body collapse in body">
					<div id="status-area"  >
					<div>
						<h5 class="form-status"></h5>
					</div>					
					</div>	
                                <div class="edit-area"></div>    					
						
						</div><!-- /.box -->
                    <form action="#" method="post" class="form-horizontal" id="form-update">
					<fieldset>
				 
					<div id="form-area"> 
					<div class="new-loading" style="display:none;">
					<img src="../images/loading_animation.gif" width="180">
					</div>

                      <div class="form-group">
                        <label class="control-label col-lg-4 required">Company Name</label>
                        <div class="col-lg-7">
                          <input type="text" id="f13"  name="f13" class="first-input form-control n1_edited" value="<?php echo $f13;?>">
                        </div>
                      </div>



                      <div class="form-group hidden">
                        <label class="control-label col-lg-4 required">Company Name</label>
                        <div class="col-lg-7">
                          <input type="text" id="f2"  name="f2" class="first-input form-control" value="<?php echo $f1;?>">
                        </div>
                      </div>					  
                      <div class="form-group hidden">
                        <label class="control-label col-lg-4 required hidden">First Name</label>
                          <div class="col-lg-7">
                          <input type="text"  name="f3" class="form-control" value="<?php echo $f2;?>">
                        </div>
                      </div>	
                      <div class="form-group hidden">
                        <label class="control-label col-lg-4">Email</label>
                          <div class="col-lg-7">
                          <input type="text"  name="f4" class="form-control" value="<?php echo $f3;?>">
                        </div>
                      </div>	
						<div class="form-group">
                        <label class="control-label col-lg-4">Contact Number</label>
                          <div class="col-lg-7">
                          <input type="text"  name="f5" class="form-control" value="<?php echo $f4;?>">
                        </div>
						</div> 						  
					  
 						<div class="form-group">
                        <label class="control-label col-lg-4">Address</label>
                          <div class="col-lg-7">
                          <input type="text"  name="f6" class="form-control n2_edited" value="<?php echo $f5;?>">
                        </div>
						</div> 
 						<div class="form-group hidden">
                        <label class="control-label col-lg-4">Address 2</label>
                          <div class="col-lg-7">
                          <input type="text"  name="f7" class="form-control" value="<?php echo $f6;?>">
                        </div>
						</div> 						
						
 						<div class="form-group hidden">
                        <label class="control-label col-lg-4">City</label>
                          <div class="col-lg-7">
                          <input type="text"  name="f8" class="form-control" value="<?php echo $f7;?>">
                        </div>
						</div> 						
 						<div class="form-group hidden">
                        <label class="control-label col-lg-4">State</label>
                          <div class="col-lg-7">
                          <input type="text"  name="f9" class="form-control" value="<?php echo $f8;?>">
                        </div>
						</div> 	

 						<div class="form-group hidden">
                        <label class="control-label col-lg-4">Zip</label>
                         <div class="col-lg-7">
                          <input type="text"  name="f10" class="form-control" value="<?php echo $f9;?>">
                        </div>
						</div> 
 						<div class="form-group hidden">
                        <label class="control-label col-lg-4">Country</label>
                          <div class="col-lg-7">
                          <input type="text"  name="f11" class="form-control" value="<?php echo $f10;?>">
                        </div>
						</div> 
 	
 						<div class="form-group hidden">
                        <label class="control-label col-lg-4">Account #</label>
                          <div class="col-lg-7">
                          <input type="text"  name="f12" class="form-control" value="<?php echo $f11;?>">
                        </div>
						</div> 								
						
					<br>
					
					</div>
					  </fieldset>
                    </form>
						</div>
					</div>
				</div>
				<!-- end customer-->
 


  