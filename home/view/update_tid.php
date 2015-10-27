 

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
				<?php
				$gettid=mysql_query("SELECT * from osd_transaction_details   ");
				$i=0;
				while($row=mysql_fetch_array($gettid)){
				
				$rno=$row['td_transaction_id'];
				$i++;
				$mode=$row['td_mode'];
				$tid=get_tid_by_receipt_no($rno, $mode);
				$td_tid=$row['td_TID'];
				$tdid=$row['TDID'];

				 
				mysql_query("UPDATE osd_transaction_details SET td_TID=$tid WHERE TDID=$tdid ");
				 

				echo $i.'. '.$rno.' TID = '.$td_tid.'<br>';
				}
				?>
 
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
  
 
 
  