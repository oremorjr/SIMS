<?php
require('../../../../include/db_config.php');
$connect=new DB();
$id=$_GET['ID'];
$q1=mysql_query("SELECT * from osd_users where UID=$id");
$slug=$_GET['slug'];
while($r=mysql_fetch_array($q1)){
$f1=$r['fname'];
$f2=$r['mname'];
$f3=$r['lname'];
$f4=$r['uname'];
$f10=$r['u_position'];
}
$status=pabs_query('u_status','osd_users','UID',$id);
 
?>
<span id="slug" data-value="<?php echo $slug;?>"></span>
<span id="ID_" data-value="<?php echo $id;?>"></span>

<script type="text/javascript">
$(document).ready(function(){



$(".pass").keyup(function(){

var p1=$("#f5").val();
var p2=$("#f6").val();




if(p1.length>0 && p1.length<6 || p2.length>0 && p2.length<6){

$("#update").attr("disabled", "disabled");	

	
}else{
	$("#update").removeAttr("disabled");
}


if(p1!='' && p2!=""){
if(p1!=p2){
$(".user-area").html('<div class="alert alert-danger" role="alert">Password mismatch</div>');
}else{
$(".user-area").html(' ');	
}
}




})

});
</script>

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
                        <label class="control-label col-lg-4 required">Username</label>
                        <div class="col-lg-7">
                   <label class=" col-lg-4  " style="padding-top: 5px;"> <?php echo $f4;?></label>    
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-lg-4 required">First Name</label>
                        <div class="col-lg-7">
                          <input type="text" id="f1"  name="f1" class="focus form-control n1_edited" value="<?php echo $f1;?>">
                        </div>
                      </div>					  
                         <div class="form-group">
                        <label class="control-label col-lg-4 required">Middle Name</label>
                        <div class="col-lg-7">
                          <input type="text" id="f2"  name="f2" class="focus form-control n2_edited" value="<?php echo $f2;?>">
                        </div>
                      </div>					  
                           <div class="form-group">
                        <label class="control-label col-lg-4 required">Last Name</label>
                        <div class="col-lg-7">
                          <input type="text" id="f3"  name="f3" class="focus form-control n3_edited" value="<?php echo $f3;?>">
                        </div>
                      </div>


                           <div class="form-group">
                        <label class="control-label col-lg-4 required">Transfer to Group</label>
                        <div class="col-lg-7">
                         <select class="form-control" name="f10">
                          <?php
                          $posname=pabs_query_general("p_posname","osd_position", "p_posid=$f10" );
                          ?>
                          <option value='<?php echo $f10;?>'><?php echo $posname;?></option>
                          <?php
                          $rows=osd_query("osd_position", "p_posid!=$f10 AND p_posid!=1", $group="");
                          foreach($rows as $row){
                          $posid=$row['p_posid'];
                          $posname=$row['p_posname'];
                          echo '<option value="'.$posid.'">'.$posname.'</option>';
                          }
                          ?>
                        </select>
                        </div>
                      </div>


 	<hr>
 	<div class="col-lg-12">
 	<div class="user-area"></div>
 	</div>

                           <div class="form-group">
                        <label class="control-label col-lg-4 required">Password</label>
                        <div class="col-lg-7">
                          <input type="password" id="f5"  name="f5" class="pass focus form-control"  >
                        </div>
                      </div>
                           <div class="form-group">
                        <label class="control-label col-lg-4 required">Confirm Password</label>
                        <div class="col-lg-7">
                          <input type="password" id="f6"  name="f6" class="pass focus form-control"  >
                        </div>
                      </div>
                           <div class="form-group">
                       <div class="col-lg-4"></div>
                        <div class="col-lg-7">
                      <div class="sub">* Password requires atleast 6 characters</div>
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
 


  