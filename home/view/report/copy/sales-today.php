 <?php
$d_temp=strtotime(Date("F d, Y")); 
$date=date("Y-m-d", $d_temp);
$q_s="AND t_transaction_date='$date'";
?>
<div class="col-lg-12" style="min-height:470px;">
  <div class="row">
    <div class="box">
      <header>
        <div class="icons"> <i class="fa fa-table"></i> </div>
        <div>
          <h5>Today - <?php print(Date("l F d, Y"));  ?></h5>
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
		  $q0=mysql_query("SELECT * from osd_transaction where t_paid=1 and t_mode=1 $q_s");
		  $profit=0;
		  $sale=0;
		  $show_sale=0;
		  $show_profit=0;	  
		  while($row=mysql_fetch_array($q0)){
			$td=$row['t_transaction_date'];
			$date=date('F d, Y', strtotime($td));
			$t_profit=$row['t_profit'];
			$amount=$row['t_amount_t'];
			
			$profit=$profit+$t_profit;
			$show_profit=number_format($profit, 2, '.', ',');
			
			$sale=$sale+$amount;
			$show_sale=number_format($sale, 2, '.', ',');
			
		  }
		  ?>
			<tr>
				<td><a href="?page=sales-report&date=<?php echo $td;?>"><?php echo $date;?></a></td>
				<td>₱<?php echo $show_sale;?></td>
				<td>₱<?php echo $show_profit;?></td>
			</tr>
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
				<td>₱<?php echo $show_sale;?></td>
				<td>₱<?php echo $show_profit;?></td>
		</tr>
		</tbody>
		</table>
		</div>     	
  </div>
  
  <!-- /.row --> 
</div>
<!-- /.col --> 


  