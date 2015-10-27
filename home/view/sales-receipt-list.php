 

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
				<div>Receipt TOTAL : <span class="rtotal"></span></div>
				 <table class="table table-bordered table-condensed table-hover table-striped">
				 <tr>
				 
				 <td> Receipt No. </td>
				 <td>Total</td>
				 <td>Details</td>
				 </tr>
				<?php
				 $transaction_receipt=mysql_query("SELECT * from osd_transaction WHERE t_active=0 and t_void=0 and t_mode=1");
				 $a=0;
				 while($trans_row=mysql_fetch_array($transaction_receipt)){
				 $TID=$trans_row['TID'];
				 $transaction_no=$trans_row['t_receiptno'];
				 $trans_total=$trans_row['t_amount_t'];
				 $a+=$trans_total;
				 ?>
				 <tr>
				 
				 <td><?php echo $transaction_no;?></td> 
				 <td><?php echo $trans_total;?></td> 
				 <td><button class="details" id="<?php echo $TID;?>">DETAILS</button></td> 
				 </tr>
				 <tr style="display: ;" id="details-<?php echo $TID;?>">
				 <td colspan="20">
				 <table class="table table-bordered table-condensed table-hover table-striped">
				 
				 <?php
				 $trans_details=mysql_query("SELECT * from osd_transaction_details where td_TID=$TID and td_mode=1 ");
				$b=0;
				 while($trans_details_row=mysql_fetch_array($trans_details)){
				 $TDID=$trans_details_row['TDID'];
				 $r_TID=$trans_details_row['td_TID'];
				 $PID=$trans_details_row['td_pcode'];
				 $td_total=$trans_details_row['td_total'];
				 $product_name=product('p_name',$PID);
				
				$c=transaction('t_amount_t', $r_TID);
				$return=$trans_details_row['td_return'];
				if($return==1){
				$td_total=$td_total*-1;
				}
				 $b+=$td_total;

				$show_b=number_format($b, 2, '.', ',');	
				$show_c=number_format($c, 2, '.', ',');	
				 ?>
				 <tr>
				 <td><?php echo $product_name;?></td>
				 <td><?php echo $td_total;?></td>
				 <td><?php echo $return;?></td>
				 </tr>
				 <?php
				 }
				 ?>
				 <tr>
				 <td  class="right">TOTAL: <?php echo 'RECEIPT : '.$show_c.' = DETAILS : '.$show_b;?></td>
				 <td  class="right"> 
				 <?php 
				 $b_c=floatval($b);
				 $c_c=floatval($c);
				 if($b_c==$c_c){
				 echo 'OK NO PROBLEM';
				 }else{
				 echo 'THIS IS A BIG PROBLEM';
				 }
				 ?>
				 </td>
				 </tr>
				 </table>
				 </td>
				 </tr>
				 <?php
				 }
				?>
				</table>
				<div>
				<?php echo $a;?>
				<script>
				var a="<?php echo $a;?>";
				$(".rtotal").html(a);
				</script>
				</div>
 
						<div id="div-4" class="accordion-body collapse in body">

							<div id="loading-result" >
		 
						 
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
  $(".details").click(function(){
var id=$(this).attr('id');
  $("#details-"+id).slideToggle();
  });
  </script>