<?php
require('../../../../include/db_config.php');
$connect=new DB();
$id=$_GET['ID'];
$q1=mysql_query("SELECT * from osd_category where CID=$id");
$slug=$_GET['slug'];
while($r=mysql_fetch_array($q1)){
$f1=$r['cat_name'];
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
                        <label class="control-label col-lg-4 required">Category Name</label>
                        <div class="col-lg-7">
                          <input type="text" id="f1"  name="f1" class="focus form-control n1_edited" value="<?php echo $f1;?>">
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
 


  