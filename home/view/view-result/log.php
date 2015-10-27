<?php 
include('../../../include/class_lib.php');
$mode=$_REQUEST['MODE'];
$YEAR=$_REQUEST['sy'];
$MONTH=$_REQUEST['m'];
 
if($mode==1){
  $join="INNER JOIN osd_customer ON (t_customer_id=CID)";
  $page='?page=view-receipt&mode=1';
  $title="Sales Log";

 
}elseif($mode==2){
  $join="INNER JOIN osd_supplier ON (t_supplier_id=SID)";
  $page='?page=view-receipt-supplier&mode=2';
  $title="Receivings Log";
 

}



?>

<div class="log-title"><?php echo $title;?></div>

    <table id="" class="dataTable table table-bordered table-condensed table-hover table-striped log">
      <thead>
      <tr>
        <th>DNO</th>
        <th>Name</th>
        <th class="right">Total</th>
        <th>Date</th>
        <th>Status</th>
        <th>By</th>
        <th>Last Update</th>
        <th class="">Options</th>
 
      </tr>
      </thead>
      <tbody>
      <?php
     $gtotal=0;
     $gprofit=0;
 
      
      $q1=mysql_query("SELECT * from osd_transaction $join where YEAR(t_transaction_date)='$YEAR' and MONTH(t_transaction_date)='$MONTH' and  t_active=0 and t_mode=$mode  ");
      $profit=0;
      $sale=0;
      $show_sale=0;
      $show_profit=0;
     
     $s_total=0;
     $v_total=0;
     
      
      while($row=mysql_fetch_array($q1)){
      $td=$row['t_transaction_date']; 
      $t_profit=$row['t_profit'];
      $amount=$row['t_amount_t'];
      $date=$row['t_transaction_date'];
    $sale=$row['t_amount_t'];
    $profit=$row['t_profit'];
 
    $CID=$row['t_customer_id'];
    $SID=$row['t_supplier_id'];

if($mode==1){
  $name=customer('c_firstname', $CID);

}

if($mode==2){
 $name=supplier('sup_name', $SID);  
}

$transdate=$row['t_trans_date'];
$td=date('F d, Y h:i A', strtotime($transdate));


      $tno=$row['t_receiptno'];
      $tid=$row['TID'];
      $status=$row['t_void'];
      $t_empid=$row['t_empid'];
      $status==0 ? $s="Valid" : $s="Void";
    $show_sale=number_format($sale, 2, '.', ',');

$edit=$row['t_edit_mode'];
$editor=$row['t_edited_by'];
$update=date('F d, Y h:i A', strtotime($row['t_last_update']));
$emp=get_employee_name($editor);


if($status==0){
$s_total+=$sale;
}

if($status==1){
$v_total+=$sale;
}



      ?>
      <tr>
        <td width="15%">
         <?php
         if($mode==1){
        edit_sales_receipt($tid, $CID);
         }elseif($mode==2){
        edit_po_receipt($tid, $SID);
         }
         ?>


          <a href="<?php echo $page;?>&TID=<?php echo $tid; ?>"><?php echo $tno;?></a></td>
        <td><?php echo $name;?></td>
        <td class="right"><?php echo $show_sale;?></td>
        <td width="20%"><?php echo $td;?></td>
        <td><?php echo $s;?></td>
        <td><?php employee_name($t_empid);?></td>

<td>
<?php 
if($edit!=0):
?>
<div>ongoing...</div>
<div class="sub"><?php if($editor!=0): echo ' ('.$emp.')'; endif;?></div>
<?php
else:
echo $update;
?>
<?php ?>
<?php
endif;?>
</td>
 


        <td>
         
         <?php
         if($mode==1){
      customer_options($tid, $CID);
         }elseif($mode==2){
       supplier_options($tid, $SID);
         }
         ?>
        </td>
 
 
      </tr>
  
      <?php 
      $gtotal=$s_total-$v_total;
      $gprofit+=$profit;
      $show_gtotal=number_format($gtotal, 2, '.', ',');
      $show_gprofit=number_format($gprofit, 2, '.', ',');

      $show_s_total=number_format($s_total, 2, '.', ',');
      $show_v_total=number_format($v_total, 2, '.', ',');
      }
      ?>
       
      </tbody>
    </table>

<?php if(current_user('view-sales-total')):?>
        <div class=" total-sales">
    <table id="" class="gtotal" width="100%">


    <tr>
      <td class=" ">Total  Sales: <strong>P <?php echo $show_s_total;?></strong></td>  
    </tr>
      <tr>
      <td class=" ">Total Void: <strong>P <?php echo $show_v_total;?></strong></td>  
    </tr>
   
    </table>
    </div>     

 <?php endif;?>
<script src="assets/lib/datatables/DT_bootstrap.js"></script>