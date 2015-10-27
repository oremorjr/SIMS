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
          <h5>Users Log</h5>
        </div>
      </header>
      <div id="div-4" class="accordion-body collapse in body">
    <table id="" class="dataTable table table-bordered table-condensed table-hover table-striped log">
      <thead>
      <tr>
        <th>ID</th>
        <th>User</th>
        <th>Content</th>
          <th>Category</th>
        <th>Date</th>
      
 
      </tr>
      </thead>
      <tbody>
     <?php

     $year=$_REQUEST['year'];
     $month=$_REQUEST['month'];

     if(!isset($year) && !isset($month)):
      ?>
    <script>
    window.location='?page=log-filter';
    </script>
    <?php
      endif;


     $rows=osd_query('osd_log',$where="YEAR(l_date_time)='$year' AND MONTH(l_date_time)='$month' ", $group='');
     foreach($rows as $row){
      $id=$row['l_logid'];
      $UID=$row['l_UID'];

      $fname=pabs_query('fname','osd_users','UID',$UID);
      $lname=pabs_query('lname','osd_users','UID',$UID);
      $fullname=$fname.' '.$lname;
      $l_message=$row['l_message'];
      $l_date_time=$row['l_date_time'];
      $d=date('F d, Y h:i A', strtotime($l_date_time));
    
      $l_category=$row['l_category'];
      ?>
      <tr>
      <td width="6%"><?php echo $id;?></td>
      <td><?php echo $fullname;?></td>
      <td width="40%"><?php echo $l_message;?></td>
           <td><?php echo $l_category;?></td>
      <td><?php echo $d;?></td>
      </tr>
      <?php
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
<script src="assets/lib/datatables/DT_bootstrap.js"></script>
     
  