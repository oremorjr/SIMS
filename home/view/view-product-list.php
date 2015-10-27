<?php
$slug='product';
$class1=new product();
$query="SELECT * from osd_product  INNER JOIN osd_category ON (p_category_id=CID) where PID='$pid' ";
$class1->select_list($query);
  
$class2=new product_list();
$query="SELECT * from osd_product_unit INNER JOIN osd_unit ON (pu_unit_id=UID) where pu_product_code='$pid'";

?>
      <div id="content">
 	  
        <div class="outer">
          <div class="inner">
	  
		   <div class="col-lg-12">
            <div class="row"> 


            	<?php if(current_user('stock-control')):?>
	<a href="?page=add-product-list&PID=<?php echo $pid;?>" class="btn btn-success btn-lg btn-grad btn-rect">Stock Control</a>  
	<?php endif;?>

<!--             	<?php if(current_user('inventory-loss')):?>
	<a href="?page=add-product-list&PID=<?php echo $pid;?>" class="btn btn-success btn-lg btn-grad btn-rect">Inventory Loss</a>  
	<?php endif;?> -->
                <div class="box">
                  <header>
                    <div class="icons">
                      <i class="fa fa-table"></i>
                    </div>
                    <h5>View Product Details</h5>'
                    
                  </header>


 <ol class="breadcrumb mb-0">
  <li><a href="?page=index">Home</a></li> 
  <li><a href="?page=item">Items</a></li> 
  <li class="active">View Product Details</li>
</ol>




                  <div id="collapse4" class="body">	
	<div class="col-lg-12" style="overflow:hidden;height:auto;">
		<div class="col-lg-3" style="overflow:hidden;height:auto;">
		<!-- <div class="col-lg-9" >
		<img src="../images/uploads/thumb_<?php echo $class1->image?>">
		</div> -->
		</div>
		<div >
		<table class="table table-bordered table-condensed table-hover table-striped">
			<thead>
				<tr>
					<th>Product Name</th>
					 
					<th>Category</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?php echo $class1->brand.' '.$class1->name;?></td> 
					<td><?php echo $class1->cat_name;?></td>		 
				  </tr>
			</tbody>					  
		</table>			
		</div>
	</div>                 		  

		<hr style="clear:none"></hr>
		<div id="loading">
		</div>   </div>
 
				 
					
                  
                </div>
				</div>
              </div>
            </div><!-- /.row -->
          </div>

          <!-- end .inner -->
        </div>

        <!-- end .outer -->
      </div>
<input type="hidden" id="pid" value="<?php echo $pid;?>">
<script type="text/javascript">
$(document).ready(function(){
$(".btn-del").click(function(){
	var ID=$(this).data('value');
	var dataString = 'id='+ ID;
	console.log(ID);
	$.ajax({
	type: "POST",
	url: "../include/function/pos/del-list.php",
	data: dataString,
	cache: false,
	success: function(data)
	{ 
	//show_product();
	}
	});
});

 
show_product();
function show_product(){
$("#loading").load("view/product-list/product-list.php?pid=<?php echo $pid;?>");
}


 
 
});
</script>  
    <script src="assets/lib/datatables/jquery.dataTables.js"></script>
 
 