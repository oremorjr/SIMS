<script type="text/javascript">
$(document).ready(function(){
	var slug='item-unit';
	 $('.add_unit').change(function(){
	 var s_unit=$(this).val();
	 var PID=$('#ID_').data('value');
	 var bprice="1";

	 var selling_price="1";
	 // alert(s_unit);
	$.ajax({
		data:{UID: s_unit, PID: PID, live:0}, 
		url:"../include/function/update/update_class.php?page="+slug,
		success:function(data){
		$('.result-area-unit').html(data);

		var brprice=$("#base_price").data('value');
		var srprice=$("#selling_price").data('value');
		$("#base-price").val(brprice);
		$("#selling-price").val(srprice);

		}

	});
	return false;
	 });

	 $('.live').keyup(function(){
	 var s_unit=$(".add_unit").val();
	 var PID=$('#ID_').data('value');
	 var bprice=$("#base-price").val();
	 var selling_price=$("#selling-price").val();
	 // alert(s_unit);
	$.ajax({
		data:{UID: s_unit, PID: PID, BASE:bprice, SPRICE:selling_price, live:1}, 
		url:"../include/function/update/update_class.php?page="+slug,
		success:function(data){
		$('.result-area-unit').html(data);
		}

	});
	return false;
	 });

});
</script>
<?php
require('../../../../include/class_lib.php');
$connect=new DB();
$id=$_REQUEST['ID'];
$slug=$_REQUEST['slug'].'-unit';
$class2=new unit();
$query="SELECT * from osd_unit_item
INNER JOIN osd_unit ON (UID=ui_uid) 
INNER JOIN osd_product ON (ui_pid=PID)
where ui_pid=$id"; 

$pname=pabs_query('p_name','osd_product','PID',$id);
$q1=mysql_query($query);
while ($qrow=mysql_fetch_array($q1)) {
	// $pname=$qrow['p_name'];
	$status=$qrow['ui_status'];
	if($status==1){
	$check_id=$qrow['UID'];
	$bprice=$qrow['ui_base_price'];
	$sprice=$qrow['ui_selling_price'];	
	$check_pname=$qrow['u_name'];
	}

}

?>
<span id="slug" data-value="<?php echo $slug;?>"></span>
<span id="ID_" data-value="<?php echo $id;?>"></span>

<!-- start customer-->
<div class="col-lg-12">
<span class="modal-name" id="<?php echo $pname;?>"></span>
	

		<div id="div-1" class="search-form accordion-body collapse in body">
			<div class="result-area-unit"  >
			 				
			</div>		 
<script>
$(document).ready(function(){
var pname="<?php echo $pname;?>";
$("#form-name").html(pname);
});
</script>			
			<form id="form-update">	
			 <table class="table table-bordered table-condensed table-hover table-striped">
			 <tr>
			 	<td><strong>Unit</strong></td>
			</tr>				 	
			 <tr>
			 	<td>
				<select class="form-control add_unit col-lg-12">
				<?php
				echo '<option value="'.$check_id.'">'.$check_pname.'</option>';
				echo '<option value="'.$check_id.'">-------------------</option>';
				$res=mysql_query("SELECT *  FROM osd_unit  ");

				while($row=mysql_fetch_array($res)){
				$a=$row['u_name'];
				$b=$row['UID'];
				echo '<option value="'.$b.'">'.$a.'</option>';
				}
				?>
				</select>
			 	</td>
			 </tr>
			 <tr>
			 	<td><strong>Base Price</strong></td>
			</tr>	

			 <tr class=" ">
			 	<td>
			 	<input type="text" placeholder="Base Price"class="form-control live" id="base-price" value="<?php echo $bprice;?>">
			 	</td>
			 </tr>	
			 <tr>
			 	<td><strong>Selling Price</strong></td>
			</tr>			 
			 <tr class=" ">
			 	<td>
			 	<input type="text" placeholder="Selling Price"class="form-control live" id="selling-price" value="<?php echo $sprice;?>">
			 	</td>
			 </tr>
		 
			 </table>		

			</form>
		</div><!-- /.box -->
		 
	 
</div>
</div>




 