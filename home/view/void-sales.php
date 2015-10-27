<?php
if(!current_user('void-sales'))
  return false;
?>
      <div id="content">
        <div class="outer">
    <div class="inner">
    <div class="row">
    
 
                  <div id="div-1" class="accordion-body body in" style="min-height:470px;height:auto;overflow:hidden;">
 

<div class="col-lg-12">
 <div id="loading-result" >
<?php
$d_temp=strtotime(Date("F d, Y")); 
$date=date("Y-m-d", $d_temp);
$tdate="";
$add="";

 $y=date('Y');

if(isset($_GET['date'])){
  $tdate=$_GET['date'];
  $add="AND t_transaction_date='$tdate'";
}else{
   
    $add="AND YEAR(t_transaction_date)='$y'";
}
 
?>
<div class="col-lg-12" style="min-height:470px;height:auto;overflow:hidden;">
  <div class="row">
    <div class="box">
      <header>
        <div class="icons"> <i class="fa fa-table"></i> </div>
        <div>
          <h5>Sales Log</h5>
        </div>
      </header>
      <div id="div-4" class="accordion-body collapse in body">
    <table id="" class="dataTable table table-bordered table-condensed table-hover table-striped">
      <thead>
      <tr>
        <th>Transaction Number</th>
        <th>Name</th>
        <th>Total</th>
        <th>Status</th>
        <th>Processed by</th>
 
      </tr>
      </thead>
      <tbody>
      <?php
     $gtotal=0;
     $gprofit=0;
 
      
      $q1=mysql_query("SELECT * from osd_transaction INNER JOIN osd_customer ON (t_customer_id=CID) where  t_active=0 and t_mode=1 AND YEAR(t_transaction_date)='$y' ");
      $profit=0;
      $sale=0;
      $show_sale=0;
      $show_profit=0;
     
     
      
      while($row=mysql_fetch_array($q1)){
      $td=$row['t_transaction_date']; 
      $t_profit=$row['t_profit'];
      $amount=$row['t_amount_t'];
      $date=$row['t_transaction_date'];
    $sale=$row['t_amount_t'];
    $profit=$row['t_profit'];
    $t_customer_id=$row['c_firstname'].' '.$row['c_lastname'];
      $tno=$row['t_receiptno'];
      $tid=$row['TID'];
      $status=$row['t_void'];
      $t_empid=$row['t_empid'];
      $status==0 ? $s="Valid" : $s="Void";
    $show_sale=number_format($sale, 2, '.', ',');
      ?>
      <tr>
        <td><a href="?page=view-receipt&mode=1&TID=<?php echo $tid; ?>"><?php echo $tno;?></a></td>
        <td><?php echo $t_customer_id;?></td>
        <td>₱<?php echo $show_sale;?></td>
        <td><?php echo $s;?></td>
        <td><?php employee_name($t_empid);?></td>
 
 
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
 
    </div>      
  </div>
  
  <!-- /.row --> 
</div>
<!-- /.col --> 


  
</div><!-- end loading result -->
</div><!-- end col-lg-6 -->



 
                </div>
              </div>

              <!--END TEXT INPUT FIELD-->
 
            </div> 
          <!-- end .inner -->
      
      
      
      
      
      
      
      
      
    
  

        <!-- end .outer -->
      </div>

      <!-- end #content -->
    </div>
 
<script src="assets/lib/datatables/jquery.dataTables.js"></script>
<script src="assets/lib/datatables/dataTables.columnFilter.js"></script>  
<script src="assets/lib/datatables/DT_bootstrap.js"></script>
    
    <script src="assets/lib/tablesorter/js/jquery.tablesorter.min.js"></script>
    <script src="assets/lib/touch-punch/jquery.ui.touch-punch.min.js"></script>
 
  