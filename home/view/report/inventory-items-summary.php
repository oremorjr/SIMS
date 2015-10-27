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
          <h5>Items List</h5>
        </div>
      </header>
      <div id="div-4" class="accordion-body collapse in body">

<div class="col-lg-12">
      <div class="print print-report none"><i class="glyphicon glyphicon-print"></i> Print</div>

</div>



		<table id="" class="dataTable table table-bordered table-condensed table-hover table-striped">
		  <thead>
			<tr>
			  <th >Item Name</th>
			   <th>Unit</th>  
			 
			  <th class="right" >Stocks</th>
			  <th class="right">Base Price</th>
			  <th class="right" >Discount Rate</th>
			</tr>
		  </thead>
		  <tbody>
		  <?php

		  
		  $q1=mysql_query("SELECT * from osd_unit_item
		   INNER JOIN osd_product ON (ui_pid=PID)
		   INNER JOIN osd_unit ON (ui_uid=UID)
		    where   ui_status=1");

		  
		  while($row=mysql_fetch_array($q1)){
				$pname=$row['p_name'];
				$pcode=$row['p_pcode'];
				$p_brand=$row['p_brand'];
				$stocks=$row['ui_stocks'];
				$reorder=$row['ui_reorder_level'];
				$unit=$row['u_name'];
				$s_price=$row['ui_selling_price'];
				$r_price=$row['ui_base_price'];
				$ui_disc_rate=$row['ui_disc_rate'];
				$disc_status=$row['disc_status'];
				$sell_price=number_format($s_price, 2, '.', ',');
				$raw_price=number_format($r_price, 2, '.', ',');
				if($stocks<=$reorder){$tr='style="opacity:0.5; color:#F00;"';}else{$tr="";}
 		
			?>
			<tr <?php echo $tr;?>>
				<td width="30%"><?php echo $p_brand.' '.$pname;?></td>
				<td width="15%"><?php echo $unit;?></td> 
				<td width="20%" class="right" ><?php echo $stocks;?></td> 
				<td class="right" width="20%"><?php echo $raw_price;?></td>
				<td>
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
$(document).ready(function() {  
	$('.year').hide();
	$('.print-report').click(function(){
		window.print();
	});
 
}); 
</script> 