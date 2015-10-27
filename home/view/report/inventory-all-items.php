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
      <div id="div-4" class="accordion-body collapse in body inventory">
      <?php
      $categories=osd_query("osd_category",$where="", $group="");
      foreach($categories as $category){
$catid=$category['CID'];
$catname=$category['cat_name'];
      ?>
<div class="cat_name"><?php echo $catname;?></div>
		<table id="" class="  table table-bordered table-condensed table-hover table-striped">
		  <thead>
			<tr>
			  <th style="width:40%;">Description</th>
			  <th >Unit</th>
			  <th >Base Price/Price</th>
			  <th >Discount Rate</th>
			 
			</tr>
		  </thead>
		  <tbody>
		  <?php

		  
		  $q1=mysql_query("SELECT * from osd_product WHERE p_category_id=$catid order by p_name");

		  $i=0;
		  while($row=mysql_fetch_array($q1)){
				$pname=$row['p_name'];
				$pcode=$row['p_pcode'];
				$p_brand=$row['p_brand'];
				$PID=$row['PID'];
				$i++;
				$ui_disc_rate=get_disc_rate($PID);
				$disc_status=get_disc_status($PID);

				$UIID=pabs_query_general('UIID', 'osd_unit_item',"ui_pid=$PID and ui_status=1 ");
				$disc_rate=pabs_query_general('ui_disc_rate', 'osd_unit_item',"UIID='$UIID' ");
				$disc_status=pabs_query_general('disc_status', 'osd_unit_item',"UIID='$UIID' ");
				$base=pabs_query_general('ui_base_price', 'osd_unit_item',"UIID='$UIID' ");  
				$selling=pabs_query_general('ui_selling_price', 'osd_unit_item',"UIID='$UIID' ");
				if($base!=""){
				$p=$base;
				}else{
				$p=$selling;
				}
			 
 		
			?>
			<tr  >
				<td><?php echo $i.'. '.$p_brand.' '.$pname;?></td>
				<td><?php echo get_unit_name($PID);?></td>
				<td><?php echo $p ;?></td>
				<td>
		<span  class="discount"> 
	<?php
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
	?>
	</span>



				</td>
				 

			</tr>
			<?php
			}
			?>

		  </tbody>
		</table>


      <?php


      }
      ?>

	  </div>

      <!-- end Results--> 
      
    </div>
    <!-- /.box --> 
 
  </div>
  
  <!-- /.row --> 
</div>
<!-- /.col --> 


  