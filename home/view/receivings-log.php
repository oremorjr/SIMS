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
if(isset($_GET['date'])){
  $tdate=$_GET['date'];
  $add="AND t_transaction_date='$tdate'";
}
 
?>
<div class="col-lg-12" style="min-height:470px;height:auto;overflow:hidden;">
  <div class="row">
    <div class="box">
      <header>
        <div class="icons"> <i class="fa fa-table"></i> </div>
        <div>
          <h5>Receivings Log</h5>
        </div>
      </header>
      <div id="div-4" class="accordion-body collapse in body">
    <table id="" class="dataTable table table-bordered table-condensed table-hover table-striped">
      <thead>
      <tr>
        <th>TNO</th>
        <th>Receipt No.</th>
        <th>Name</th>
        <th>Date</th>
        <th>Total</th>
        <th>Status</th>
        <th>Option</th>
        
      </tr>
      </thead>
      <tbody>
      <?php
     $gtotal=0;
     $gprofit=0;
 
      
      $q1=mysql_query("SELECT * from osd_transaction INNER JOIN osd_supplier ON (t_supplier_id=SID) where  t_active=0 and t_mode=2");
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
    $t_customer_id=$row['sup_name'];
      $tno=$row['t_receiptno'];
      $SID=$row['t_supplier_id'];
      $tid=$row['TID'];
      $t_rno=$row['t_rno'];
      $t_rno_date=$row['t_rno_date'];
      $status=$row['t_void'];
      $status==0 ? $s="Valid" : $s="Void";
    $show_sale=number_format($sale, 2, '.', ',');
      ?>
      <tr>
        <td>
          <?php edit_po_receipt($tid,$SID );?>
          <a href="?page=view-receipt-supplier&mode=2&TID=<?php echo $tid; ?>"><?php echo $tno;?></a></td>
        <td><?php echo $t_rno;?></td>
        <td><?php echo $t_customer_id;?></td>
        <td><?php echo $t_rno_date;?></td>
        <td><?php echo $show_sale;?></td>
        <td><?php echo $s;?></td>
        <td>   <?php supplier_options($tid,$SID );?></td>
      
 
 
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
 
  