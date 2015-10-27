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
		<table id="" class="dataTable table table-bordered table-condensed table-hover table-striped">
		  <thead>
			<tr>
			  <th>Item Name</th>
			   <th>Unit</th> 
			  <th>item Number</th> 
			 
			  <th>Count</th>
			  <th>Reorder Level</th>
			</tr>
		  </thead>
		  <tbody>
		  <?php

		  
		  $q1=mysql_query("SELECT * from osd_unit_item INNER JOIN osd_product ON (ui_pid=PID) where   ui_status=1");

		  
		  while($row=mysql_fetch_array($q1)){
				$pname=$row['p_name'];
				$pcode=$row['p_pcode'];
				$stocks=$row['ui_stocks'];
				$reorder=$row['ui_reorder_level'];
				if($stocks<=$reorder){$tr='style=" color:#8a8a8a;"';}else{$tr="";}
 		
			?>
			<tr <?php echo $tr;?>>
				<td><?php echo $pname;?></td>
				<td><?php echo $pcode;?></td>
				<td><?php echo $pcode;?></td>
				<td><?php echo $stocks;?></td> 
				<td><?php echo $reorder;?></td>
				

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


  