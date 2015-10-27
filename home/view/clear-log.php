 
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
					<div><h5> Dashboard</h5></div>
				</header>
 
 <table class="table table-bordered table-condensed table-hover table-striped">
<tr>
<td colspan="20"><strong>Filter DR No.</strong></td>
</tr>
<tr>
<td>
<select class="form-control" id="mode">
<option value="1">Sales</option>
<option value="2">P.O</option>
</select>
</td>
<td>
<input type="text" class="form-control" id="dr1">
</td>
<td>
<input type="text" class="form-control" id="dr2">
</td>


</tr>
</table>	
 		

				
 
						<div id="div-4" class="accordion-body collapse in body">

							<div id="loading-result" >


<?php

$select_void=mysql_query("SELECT l_logid, l_date_time from osd_log ");
while($r1=mysql_fetch_array($select_void)){
$logID=$r1['l_logid'];
$start=$r1['l_date_time'];
$end=date('Y-m-d h:i:s');
$status="Active";
$days = round((strtotime($end) - strtotime($start)) / (60 * 60 * 24), 0);
if($days>=11){
$status="Deleted";
// mysql_query("DELETE from osd_log where l_logid=$logID ");
}

echo $logID.' = '.$start.' = '.$days.' Status: '.$status.'<br>';

}
?>





		 
				<div class="compare_receipt">
				</div>						 
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
  
 
<script>

var mode=$("#mode option:selected").val();
var dr1=$("#dr1").val();
var dr2=$("#dr2").val();

$("#mode").change(function(){
var mode=$(this).val();
var dr1=$("#dr1").val();
var dr2=$("#dr2").val();

compare_receipt(mode, dr1, dr2);
});

$("#dr1").keyup(function(){
var mode=$("#mode option:selected").val();
var dr1=$(this).val();
var dr2=$("#dr2").val();

compare_receipt(mode, dr1, dr2);
});


$("#dr2").keyup(function(){
var mode=$("#mode option:selected").val();
var dr1=$("#dr1").val();
var dr2=$(this).val();


compare_receipt(mode, dr1, dr2);
});

</script>