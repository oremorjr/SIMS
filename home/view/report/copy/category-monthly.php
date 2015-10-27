<?php
$d_temp=strtotime(Date("F d, Y")); 
$date=date("Y-m-d", $d_temp);
$q_s="AND YEAR(td_trans_date) = YEAR(CURDATE()) AND MONTH(td_trans_date) = MONTH(CURDATE())";	
?>
<div class="col-lg-12" style="min-height:470px;">
  <div class="row">
    <div class="box">
      <header>
        <div class="icons"> <i class="fa fa-table"></i> </div>
        <div>
          <h5>Yesterday</h5>
        </div>
      </header>
      <div id="div-4" class="accordion-body collapse in body">
		<table id="" class="dataTable table table-bordered table-condensed table-hover table-striped">
		  <thead>
			<tr>
			  <th>Transaction Date</th>
			  <th>Total</th>
			  <th>Profit</th>
			</tr>
		  </thead>
		  <tbody>
		  <?php
		 $gtotal=0;
		 $gprofit=0;
		 $show_gtotal=0;
		 $show_gprofit=0;
		 
		  $q0=mysql_query("SELECT * from osd_transaction_details
		  INNER JOIN osd_product ON (td_pcode=PID) 
		  INNER JOIN osd_category ON (CID=p_category_id) 
		  where td_ispaid=1 and td_mode=1 $q_s group by CID ");
		  while($r0=mysql_fetch_array($q0)){
			$r0_date=$r0['td_date_added'];
			$p_cid=$r0['CID'];
			$cat_name=$r0['cat_name'];
		  
		  $q1=mysql_query("SELECT * from osd_transaction_details 
		  INNER JOIN osd_product ON (td_pcode=PID) 
		  INNER JOIN osd_category ON (CID=p_category_id) 		  
		  where p_category_id='$p_cid' and td_ispaid=1 and td_mode=1 $q_s");
		  $profit=0;
		  $sale=0;
		  $show_sale=0;
		  $show_profit=0;
		 
		 
		  
		  while($row=mysql_fetch_array($q1)){
			$td=$row['td_date_added'];
			$date=date('M d, Y', strtotime($r0_date));
			$t_profit=$row['td_profit'];
			$amount=$row['td_price'];
			
			$profit=$profit+$t_profit;
			$show_profit=number_format($profit, 2, '.', ',');
			
			$sale=$sale+$amount;
			$show_sale=number_format($sale, 2, '.', ',');
			
			}
			
 		
			?>
			<tr>
				<td><?php echo $cat_name;?></td>
				<td>₱<?php echo $show_sale;?></td>
				<td>₱<?php echo $show_profit;?></td>
			</tr>
			<?php	
			$gtotal+=$sale;
			$gprofit+=$profit;
			$show_gtotal=number_format($gtotal, 2, '.', ',');
			$show_gprofit=number_format($gprofit, 2, '.', ',');
			}
			?>
			 
		  </tbody>
		</table>

	  </div>

      <!-- end Results--> 
      
    </div>
    <!-- /.box --> 
 		<div class="col-lg-5 total-sales">
		<table id="" class="table table-bordered table-condensed table-hover table-striped">
		<tr>
			<th>Grand Total</th>
			<th>Total Profit</th>
		</tr>
		<tbody>
		<tr>
				<td>₱<?php echo $show_gtotal;?></td>
				<td>₱<?php echo $show_gprofit;?></td>
		</tr>
		</tbody>
		</table>
		</div>     	
  </div>
  
  <!-- /.row --> 
</div>
<!-- /.col --> 


  