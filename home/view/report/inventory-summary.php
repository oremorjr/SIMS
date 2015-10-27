<?php
$d_temp=strtotime(Date("F d, Y")); 
$date=date("Y-m-d", $d_temp);
$q_s="AND t_transaction_date <= NOW() AND t_transaction_date >= DATE_SUB(t_transaction_date, INTERVAL 7 DAY)";	
?>
<div class="col-lg-12" style="min-height:470px;">
  <div class="row">
    <div class="box">
      <header>
        <div class="icons"> <i class="fa fa-table"></i> </div>
        <div>
          <h5>Summary - Inventory Report</h5>
        </div>
      </header>
      <div id="div-4" class="accordion-body collapse in body">


<div class="col-lg-12">
      <div class="print print-report none"><i class="glyphicon glyphicon-print"></i> Print</div>

</div>


		<table id="" class="dataTable table table-bordered table-condensed table-hover table-striped">
		  <thead>
			<tr>
			  <th style="width:40%;">Item Description</th>
			   <th>Unit</th>  
			 
			  <th class="right">BP/Price</th>
			  <th class="right">Discount</th>
			  <th class="right">Stocks</th>
			 
			</tr>
		  </thead>
		  <tbody>
		  <?php

		  
		  $q1=mysql_query("SELECT * from osd_unit_item
		   INNER JOIN osd_product ON (ui_pid=PID)
		   INNER JOIN osd_unit ON (ui_uid=UID)
		    where   ui_status=1");

		  
		  while($row=mysql_fetch_array($q1)){
				$brand=$row['p_brand'];
				$pname=$row['p_name'];
				$pcode=$row['p_pcode'];
				$stocks=$row['ui_stocks'];
				$reorder=$row['ui_reorder_level'];
				$unit=$row['u_name'];
				if($stocks<=$reorder){$tr='style=" color:#F00;"';}else{$tr="";}
				$base=$row['ui_base_price'];
				$selling=$row['ui_selling_price'];

				$price='0.00';

				if($base!="0.00"){
				$price=$base;
				}elseif($selling!="0.00"){
				$price=$selling;
				}

				$b=number_format($price, 2, '.', ',');

				$ui_disc_rate=$row['ui_disc_rate'];
				$disc_status=$row['disc_status'];				 
 		
			?>
			<tr <?php echo $tr;?>>
				<td><div><?php echo $brand.' '.$pname;?></div>
				<div class="sub_title"><?php echo $pcode;?></div>
				</td>
				<td width="20%"><?php echo $unit;?></td> 
				<td class="right"><?php echo $b;?></td> 
				<td class="right">
		<span  class="discount"> 
	<?php

	if($ui_disc_rate!=0):
	if($disc_status==0){ 
	if($ui_disc_rate!=''):  echo 'L '; endif;
	$discounts = explode(',', $ui_disc_rate);	
	$last = end($discounts);
	foreach($discounts as $discount){
		
		if($last!=$discount){
			if($ui_disc_rate!=''): echo $discount.'%, '; endif;
		}else{
			if($ui_disc_rate!=''): echo $last.'%'; endif;
		}
	}	
	?>		
		 
	<?php
	}
	?>	
	
	<?php
	if($disc_status==1){
	echo '+';
	$discounts = explode(',', $ui_disc_rate);	
	$last = end($discounts);
	 
	foreach($discounts as $discount){
		
		if($last!=$discount){
			echo $discount.'%, ';
		}else{
			echo $last.'%';
		}
	}	
	?>		
		 
	<?php
	}
	endif;
	?>
	</span>


				</td> 
				<td class="right"><?php echo $stocks;?></td> 
				 
				

			</tr>
			<?php
			}
			?>

		  </tbody>
		</table>

	  </div>

      <!-- end Results--> 
      
    </div>
    <!-- /.box --> 
 
  </div>
  
  <!-- /.row --> 
</div>
<!-- /.col --> 


  <script>
$(document).ready(function(){

$('.dataTable').dataTable({

        "bDeferRender": true   ,
 
});
 
});
</script> 
 