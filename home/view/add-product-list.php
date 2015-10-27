<?php $slug='product-list';?> 
<?php
$c2="";
$class1=new product();
$query="SELECT * from osd_product
INNER JOIN osd_category ON (p_category_id=CID)
INNER JOIN osd_unit_item ON (PID=ui_pid)
 where PID='$pid' ";
$class1->select_list2($query);


 
$class2=new unit();
$query="SELECT * from osd_unit_item INNER JOIN osd_unit ON (ui_uid=UID) where ui_status=1 and ui_pid=$pid";
 
?> 

<script type="text/javascript">
		$.getScript('../js/add/add.js', function() {
		$(document).ready(function(){	


			$.validator.setDefaults({
			submitHandler: function() {
			 add();
			}
			});


			//show_result();
			$("#form-add").validate({
				 
				rules:{
					field1:{required:true},
					f2:{required:true},
					field3:{required:true}, 
					field5:{required:false},
					f6:{required:false},
					field7:{required:false},
					field8:{required:false},
					field9:{required:false},
					f10:{required:false},
					f11:{required:false},
					f12:{required:false},
					f13:{required:false},
		 
				} 
			
			});
        function add(){
        	loading();
        	var c=$("#form-add").serialize();
        	console.log(c);
                $.ajax({
                    type: "POST",
                    url: "../include/function/add_class.php?page=<?php echo $slug;?>",
                    data: $("#form-add").serialize(),
                    success: function(data){
                    	$('.result-area').html(data);
                    	var result=$('.result').data('value');
                    	if(result==1){
                    		success();
                    		// window.location='?page=units';
                    		// show_result();
                    		
                    	}else if(result==2){
			duplicate();
                    	}
                    }
                });
				 // return false;
        }//End funtion for login trigger


 
		});
		});		
		
</script>
		
      <div id="content">
 	  
        <div class="outer">		
          <div class="inner">
            <div class="col-lg-12">
            <div class="row">
 				<div class="box dark">
						<header>
						<div class="icons">
						<i class="fa fa-edit"></i>
						</div>
						<h5>Add Unit</h5>
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
 <ol class="breadcrumb">
  <li><a href="?page=index">Home</a></li>
  <li><a href="?page=view-product-list&PID=<?php echo $pid;?>">Transaction History</a></li>  
  <li class="active">Inventory loss</li>
</ol>



						<div id="div-1" class="search-form accordion-body collapse in body">
			
                    <form action="#" method="post" class="form-horizontal" id="form-add">
					
					
					<table class="table table-bordered table-condensed table-hover table-striped">
                      <thead>
                        <tr>
                          <th>Product Name</th> 		
                          <th>Category</th>	 	
                          <th>Running Stock/s</th>	 	
			  
                        </tr>
                      </thead>
                      <tbody>
                      <tr>
					  	<td><?php echo $class1->name;?></td> 
						<td><?php echo $class1->cat_name;?></td> 
				<?php
				$query2=mysql_query("SELECT ui_stocks from osd_unit_item INNER JOIN osd_unit ON (ui_uid=UID) where ui_status=1 and ui_pid=$pid");
				if($r2=mysql_fetch_array($query2)){
				$c2=$r2['ui_stocks'];
				}
				?>
						<td><?php echo $c2;?></td> 
					  </tr>
 
                      </tbody>					  
					</table>	
					
					<div id="status-area" style="display:none;">
					<div>
						<h5 class="form-status"></h5>
					</div>					
					</div>	
					<div class="result-area">
					</div>				
					<hr style="clear:none"></hr>						
					<input type="hidden" name="field2" value="<?php echo $pid;?>">
					<input type="hidden" name="field6" value="1"> 
					<br>

                      <div class="form-group hidden">
                        <label class="control-label col-lg-4" for="reservation">Supplier</label>
                        <div class="col-lg-4">
                         <select  name="field9" class="form-control chzn-select" tabindex="2">
                         	<?php
                         	$q_sup=mysql_query("SELECT * from osd_supplier ");
                         	while($s_row=mysql_fetch_array($q_sup)){
                         	$sid=$s_row['SID'];
                         	$sup_name=$s_row['sup_name'];
                         		?>
                         		<option value="<?php echo $sid;?>"><?php echo $sup_name;?></option>
                         		<?php
                         	}
                         	?>
		
		</select>
                        </div>
                      </div>
                   


                       <div class="form-group hidden">
                        <label class="control-label col-lg-4">Date</label>
                        <div class="col-lg-4">
                          <input type="date" name="field5" class="form-control">
                        </div>
                      </div>	

                       <div class="form-group">
                        <label class="control-label col-lg-4">Type</label>
                        <div class="col-lg-4">
                        <select name="f14" class="form-control">
                        <option value="1">Add</option>
                        <option value="7">Remove</option>
                        </select>
                        </div>
                      </div>	

                      <div class="form-group">
                        <label class="control-label col-lg-4"><?php echo $slug;?> Unit</label>
                        <div class="col-lg-4">
                         <select  name="field1" class="form-control chzn-select" tabindex="2">
		 <?php $class2->select_combo2($query);?>
		 </select>
                        </div>
                      </div>
					  
					  

                       <div class="form-group">
                        <label class="control-label col-lg-4">Quantity</label>
                        <div class="col-lg-4">
                          <input type="text" name="field3" class="positive form-control">
                        </div>
                      </div>	
                      <div class="form-group hidden">
                        <label class="control-label col-lg-4" for="reservation">Supplier Price/Unit</label>
                        <div class="col-lg-4">
                          <div class="input-group">
                            <span class="input-group-addon"><img src="../images/peso.png" width="10"></span>
                            <input type="text" name="field7" value="" id="org" class="positive form-control" >
                          </div>
                        </div>
                      </div>		

                      <div class="form-group hidden">
                        <label class="control-label col-lg-4" for="reservation">Selling Price/Unit</label>
                        <div class="col-lg-4">
                          <div class="input-group">
                            <span class="input-group-addon"><img src="../images/peso.png" width="10"></span>
                            <input type="text" name="field8" value="" id="selling_price" class=" positive form-control" >
                          </div>
                        </div>
                      </div>	



 
                    </form>
						</div>
					</div>
				</div>             
      
            </div><!-- /.row -->
            </div>
          </div>

          <!-- end .inner -->
        </div>

        <!-- end .outer -->
      </div>

      <!-- end #content -->

  
 