<?php
require('../../../../include/db_config.php');
$connect=new DB();
$id=$_GET['ID'];
$q1=mysql_query("SELECT * from osd_product  
 
where PID=$id ");
$slug=$_GET['slug'];
while($r=mysql_fetch_array($q1)){
$f1=$r['p_supplier_id']; 
$f2=$r['p_category_id']; 
$f2_name=pabs_query('cat_name','osd_category','CID',$f2);
$f3=$r['p_pcode']; 
$f4=$r['p_name'];
$f5=$r['p_desc'];
$f6=$r['p_brand'];


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
                        <label class="control-label col-lg-4 required">Category</label>
                        <div class="col-lg-7">
							<div>
							<?php
							$query=mysql_query("SELECT CID, cat_name FROM osd_category where CID<>'$f2' order by cat_name")or die(mysql_error()); 
							?>
							<select name="f2" class="form-control" autocorrect="off" autocomplete="off">
							<option value="<?php echo $f2;?>" selected="selected"><?php echo $f2_name;?></option>
							<option value="<?php echo $f2;?>"  >-------------------</option>
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
                      </div>      							
                     <div class="form-group">
                        <label class="control-label col-lg-4 required">UPC/EAN/ISBN:</label>
                          <div class="col-lg-7">
                          <input type="text" value="<?php echo $f3;?>" name="f3" class="form-control" style="text-transform:uppercase;">
                        </div>
                      </div>	
                       <div class="form-group">
                        <label class="control-label col-lg-4 required">Brand</label>
                          <div class="col-lg-7">
                          <input type="text" value="<?php echo $f6;?>" name="f6" class="n2_edited form-control">
                        </div>
						</div>						  
                      <div class="form-group hidden">
                        <label class="control-label col-lg-4 required">Item Name</label>
                          <div class="col-lg-7">
                          <input type="text" value='' name="f5" class="form-control">
                        </div>
                      </div>	
                       <div class="form-group">
                        <label class="control-label col-lg-4 required">Item Description</label>
                          <div class="col-lg-7">
                          <textarea  name="f4" class="form-control n1_edited"><?php echo $f4;?></textarea>
                        </div>
						</div>	
					  
					<br>
					
					</div>
					  </fieldset>
                    </form>
						</div>
					</div>
				</div>
 
<script type="text/javascript" charset="utf-8">
// (function($){
// 	$(function(){
// 	$('select').selectToAutocomplete();
// 	$('form').submit(function(){
// 	//alert( $(this).serialize() );
// 	return false;
// 	});
// 	});
// })(jQuery);
</script>


  