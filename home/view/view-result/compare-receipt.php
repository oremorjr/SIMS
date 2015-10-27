<?php 
include('../../../include/class_lib.php');
$mode=$_REQUEST['mode'];
$dr1=$_REQUEST['dr1'];
$dr2=$_REQUEST['dr2'];
?>
<?php
if($mode==1):
if(current_user('view-sales-total')):
 
?>
<div><h3>Total : <span class="rtotal"></span></h3></div>
<?php 
endif;
endif;
?>
<?php
if($mode==2):
if(current_user('view-po-total')):
 
?>
<div><h3>Total : <span class="rtotal"></span></h3></div>
<?php 
endif;
endif;
?>
         <table class="table table-bordered table-condensed table-hover table-striped">
         <tr>
         
         <td> Receipt No. </td>
         <td>Total</td>
         <td> Receipt Items</td>
         <td>Difference</td>
         <td>Details</td>
         </tr>
        <?php
         $transaction_receipt=mysql_query("SELECT TID, t_receiptno, t_amount_t from osd_transaction WHERE t_receiptno>='$dr1' and t_receiptno<='$dr2' and  t_active=0 and t_return=0 and t_void=0 and t_mode=$mode");
         $a=0;
         while($trans_row=mysql_fetch_array($transaction_receipt)){
         $TID=$trans_row['TID'];
         $transaction_no=$trans_row['t_receiptno'];
         $trans_total=$trans_row['t_amount_t'];
         $a+=$trans_total;
          $show_total=number_format($trans_total, 2, '.', ','); 
         ?>
         <tr> 
         
  
         <td><a href="#" class="show_receipt"  data-toggle="modal" data-target="#myModal"   id="<?php echo $TID;?>"><?php echo $transaction_no;?></a> </td> 
         <td><?php echo $show_total;?></td> 
         <td id="receipt-details-<?php echo $TID;?>"> </td> 
         <td id="receipt-diff-<?php echo $TID;?>"> </td> 
         <td><button class="details btn btn-success" id="<?php echo $TID;?>">DETAILS</button></td> 
         </tr>
         <tr style="display:none ;" id="details-<?php echo $TID;?>">
         <td colspan="20">
         <table class="table table-bordered table-condensed table-hover table-striped">
         
         <?php
         $trans_details=mysql_query("SELECT * from osd_transaction_details where td_TID=$TID and td_mode=$mode ");
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
      
         </tr>
         <?php
         }
         ?>
         <script>
         var t="<?php echo $show_b; ?>";
         var t1="<?php echo $b; ?>";
         var t2="<?php echo $c; ?>";
         var tid="<?php echo $r_TID?>";
         var t_total=parseFloat(t1-t2);
         if(t_total!='0.00'){
          var status='Please Check';
         }else{
          var status=' ';
         }
         $("#receipt-details-"+tid).html(t);
         $("#receipt-diff-"+tid).html(t_total.toFixed(2) + ' '+status);
         </script>
         <tr>
         <td  class="right" colspan="30">TOTAL: <?php echo $show_b;?></td>
         
         </tr>
         </table>
         </td>
         </tr>
         <?php
         }
        ?>
        </table>
        <div>
          <h3>
            Total : 
<?php
  $show_gt=number_format($a, 2, '.', ','); 
if($mode==1):
if(current_user('view-sales-total')):
 
?>
<?php echo $show_gt;?>
<?php 
endif;
endif;
?>
<?php
if($mode==2):
if(current_user('view-po-total')):
 
?>
<?php echo $show_gt;?>
<?php 
endif;
endif;
?>
</h3>



        
        <script>
        var a="<?php echo $a;?>";
        $(".rtotal").html(commaSeparateNumber(a));
        </script>
        </div>



  <script>
  $(".details").click(function(){
var id=$(this).attr('id');
  $("#details-"+id).slideToggle();
  });
  </script>