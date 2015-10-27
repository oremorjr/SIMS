<?php
if(!isset($_GET['TID']))
return false;
$tid=$_GET['TID'];
$TID=$_GET['TID'];
$lock=transaction_lock_status($tid);
 
$mode=get_mode($TID);

 
?>
<link rel="stylesheet" href="assets/css/print.css">
<script type="text/javascript">
// Popup window code
function newPopup(url) {
	popupWindow = window.open(
		url,'popUpWindow','height=500,width=1200,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
}
</script>

<?php
$tid=$_GET['TID'];
$sql=mysql_query("SELECT * from osd_transaction where TID=$tid  and t_mode=$mode");
if($row=mysql_fetch_array($sql)){
$rno=$row['t_receiptno'];
$v_status=$row['void_reason']; 
$void=$row['t_void'];
$customer=$row['t_customer_id'];
    $v_status==0 ? $s2="Valid" : $s2="Void";
 
}

?>

 
      <div id="content">
        <div class="outer">
          <div class="inner">
		   <div class="col-lg-12">
				<div class="row">
				<div class="box">
				<header>
					<div class="icons">
						<i class="fa fa-table"></i>
					</div>
					<div><h5>View Receipt <?php receipt_no($tid);?></h5></div>
					
                    <div class="toolbar">
                      <div class="btn-group">
                      	<?php
                           if($lock==1):
                          ?>
                          <a   href="#"  class="btn btn-sm btn-default">
                        <i class="glyphicon glyphicon-lock"></i> Locked
                        </a>
                        <?php
                  
                          endif;
                        if($lock==0):
                          ?>
                        <a   href="?page=edit-pos&ID=<?php echo $customer;?>&TID=<?php echo $tid;?>"  class="btn btn-sm btn-default">
                         <i class="glyphicon glyphicon-edit"></i> Edit Receipt
                        </a>
                        <?php
if($void==0){
  if(current_user('void-sales')):
?>
                        <a   href="?page=void&ID=<?php echo $tid;?>"  class="btn btn-sm btn-default">
                         <i class="glyphicon glyphicon-remove"></i> Void Transaction
                        </a>
                        <?php
                        endif;
                    }
                    endif;
                        ?>	                       
                         <a   href="JavaScript:newPopup('view/print-preview.php?mode=<?php echo $mode;?>&TID=<?php echo $tid;?>');"  class="btn btn-sm btn-default">
                         <i class="glyphicon glyphicon-plus-sign"></i> Print
                        </a>					
 
                      </div>
                    </div>		
                    </header>

<div class="receipt_area col-lg-12">                
</div>
<!-- end receipt_area -->

                    			
                    </div>					
					
					
					
				 
 				
				
				
			 
				</div>
            </div><!-- /.row -->
          </div>
          </div>

          <!-- end .inner -->
        </div>

        <!-- end .outer -->
      </div>

      <!-- end #content -->
 

 <script type="text/javascript">
$(document).ready(function(){

var TID="<?php echo $TID;?>";
show_pos_receipt(TID);



});
 </script>