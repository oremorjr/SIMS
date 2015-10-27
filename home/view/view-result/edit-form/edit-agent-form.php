<?php
require('../../../../include/db_config.php');
$connect=new DB();
$id=$_GET['ID'];
$q1=mysql_query("SELECT * from osd_agent where a_agentID=$id");
$slug=$_GET['slug'];
while($r=mysql_fetch_array($q1)){
$f1=$r['a_firstname'];
$f2=$r['a_lastname'];
$f3=$r['a_contact_num'];
$f4=$r['a_address'];
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
						<h5>Edit <?php echo $f1;?>'s Information</h5>
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
                        <label class="control-label col-lg-4 required">First Name</label>
                        <div class="col-lg-7">
                          <input type="text" id="f1"  name="f1" class="focus form-control n1_edited" value="<?php echo $f1;?>">
                        </div>
                      </div>					  
                         <div class="form-group">
                        <label class="control-label col-lg-4 required">Last Name</label>
                        <div class="col-lg-7">
                          <input type="text" id="f2"  name="f2" class="focus form-control n2_edited" value="<?php echo $f2;?>">
                        </div>
                      </div>					  
                           <div class="form-group">
                        <label class="control-label col-lg-4 required">Contact No.</label>
                        <div class="col-lg-7">
                          <input type="text" id="f3"  name="f3" class="focus form-control n3_edited" value="<?php echo $f3;?>">
                        </div>
                      </div>
                         <div class="form-group">
                        <label class="control-label col-lg-4 required">Address</label>
                        <div class="col-lg-7">
                          <input type="text" id="f4"  name="f4" class="focus form-control n4_edited" value="<?php echo $f4;?>">
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
 


  