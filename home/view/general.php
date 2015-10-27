 <?php
$y=date('Y');
$m=date('m'); 



 ?>

     <div id="content">
        <div class="outer">
		<div class="inner">


 


      <?php $s=0;?>

    <div class="row sales">
              <div class="col-lg-12">
                <div class="box dark">
                  <header>
                 
                    <h5 class="f20">Sales Invoice</h5>

 
                  </header>
                  <div id="div-1" class="accordion-body body in" style="height: auto;">
                    <form class="form-horizontal">

<?php

$select_void=mysql_query("SELECT * from osd_transaction WHERE t_void=1 and t_mode=1");
while($r1=mysql_fetch_array($select_void)){
$TID=$r1['TID'];
$start=$r1['t_trans_date'];
$end=date('Y-m-d h:i:s');

$days = (strtotime($end) - strtotime($start)) / (60 * 60 * 24);


//echo $TID.' = '.$start.' = '.$days.'<br>';
// mysql_query("UPDATE osd_transaction_details SET td_void=1 where td_TID=$TID ");
}
?>

 
          <table class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Report Name</th>
                          <th>Report Type</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                           Sales Invoice
                          </td>
                          <td>
                          <?php if(current_user('daily-sales')): $s+=1;?> <a href="?page=summary-report&type=sales&cat=sales&year=<?php echo $y;?>" class="btn btn-sm btn-default "> Daily</a><?php endif;?>
                             <?php if(current_user('monthly-sales')): $s+=1;?><a href="?page=summary-report&type=sales-monthly&cat=sales&year=<?php echo $y;?>" class="btn btn-sm btn-default "> Monthly</a><?php endif;?>
                        <!--                            <a href="?page=summary-report&type=sales&cat=sales" class="btn btn-sm btn-default "> Quarterly</a> -->
                          <?php if(current_user('annual-sales')): $s+=1;?> <a href="?page=summary-report&type=sales-annually&cat=sales&year=<?php echo $y;?>" class="btn btn-sm btn-default "> Annually</a><?php endif;?>
                                  <?php if(current_user('sales-chart')): $s+=1;?> <a href="?page=graphical-report&type=sales-line&cat=sales" class="btn btn-sm btn-default  "><i class="glyphicon glyphicon-tasks"></i> Graphical</a><?php endif;?>
                          </td>
                        </tr>
    
                           <?php if(current_user('sales-log')): $s+=1;?>
                        <tr>
                          <td>
                            <span>Sales Log</span>
                          </td>
                          <td>
                           <a href="?page=transaction-log&m=1" class="btn btn-sm btn-default  "> Details</a>
                          </td>
                        </tr>
                      <?php endif;?>


                           <?php if(current_user('sales-per-item')): $s+=1;?>
                        <tr>
                          <td>
                            <span>Sales per item</span>
                          </td>
                          <td>
                      <a href="?page=summary-report&type=sales-item&cat=sales&year=<?php echo $y;?>" class="btn btn-sm btn-default  "> Details</a>
                          </td>
                        </tr>
                      <?php endif;?>

                           <?php if(current_user('sales-receipt')): $s+=1;?>
                        <tr>
                          <td>
                            <span>Sales Receipt (Search)</span>
                          </td>
                          <td>
                      <a href="?page=sales-receipt" class="btn btn-sm btn-default  "> Details</a>
                          </td>
                        </tr>
                      <?php endif;?>



 

                      </tbody>
                    </table>
                    </form>
                  </div>
                </div>
              </div>

              <!--END TEXT INPUT FIELD-->
 
            </div> 
          <!-- end .inner -->
      
      
          <script>
      var s="<?php echo $s;?>";
      if(s==0){
        $(".sales").hide();
      }
      </script>

  







      <?php $re=0;?>
      
    <div class="row receiving">
              <div class="col-lg-12">
                <div class="box dark">
                  <header>
                  
                     <h5 class="f20">P.O Report</h5>

     
                  </header>
                  <div id="div-2" class="accordion-body body in" style="height: auto;">
                    <form class="form-horizontal">
 
          <table class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Report Name</th>
                          <th>Report Type</th>
                        </tr>
                      </thead>
                      <tbody>
 

 
 
                             <tr>
                          <td>
                          P.O
                          </td>
                          <td>
                          <?php if(current_user('daily-receivings')): $re+=1;?> <a href="?page=summary-report&type=receivings&cat=sales&year=<?php echo $y;?>" class="btn btn-sm btn-default "> Daily</a><?php endif;?>
                             <?php if(current_user('monthly-receivings')): $re+=1;?><a href="?page=summary-report&type=receivings-monthly&cat=sales&year=<?php echo $y;?>" class="btn btn-sm btn-default "> Monthly</a><?php endif;?>
                        <!--                            <a href="?page=summary-report&type=sales&cat=sales" class="btn btn-sm btn-default "> Quarterly</a> -->
                          <?php if(current_user('receivings-annual')): $re+=1;?>    <a href="?page=summary-report&type=receivings-annual&cat=sales&year=<?php echo $y;?>" class="btn btn-sm btn-default "> Annually</a><?php endif;?>
                               
                          </td>
                        </tr>   












                         
 

                               <?php if(current_user('receivings-log')): $re+=1;?>

                           <tr>
                          <td>
                            <span>P.O Log</span>
                          </td>
                          <td>
                           <a href="?page=transaction-log&m=2" class="btn btn-sm btn-default  "> Details</a>
                          </td>
                        </tr>    
                          <?php endif;?>

                              <?php if(current_user('po-receipt')): $s+=1;?>
                        <tr>
                          <td>
                            <span>P.O Receipt (Search)</span>
                          </td>
                          <td>
                      <a href="?page=po-receipt" class="btn btn-sm btn-default  "> Details</a>
                          </td>
                        </tr>
                      <?php endif;?>
                 


                           <?php if(current_user('receivings-per-item')): $s+=1;?>
                        <tr>
                          <td>
                            <span>P.O per item</span>
                          </td>
                          <td>
                      <a href="?page=summary-report&type=receivings-item&cat=sales&year=<?php echo $y;?>" class="btn btn-sm btn-default  "> Details</a>
                          </td>
                        </tr>
                      <?php endif;?>



          
                      </tbody>
                    </table>
                    </form>
                  </div>
                </div>
              </div>

              <!--END TEXT INPUT FIELD-->
 
            </div>      
 
      <script>
      var col_count="<?php echo $re;?>";
      if(col_count==0){
        $(".receiving").hide();
      }
      </script>







      <?php $re1=0;?>
      
    <div class="row maintenance">
              <div class="col-lg-12">
                <div class="box dark">
                  <header>
                  
                     <h5 class="f20">Maintenance</h5>

     
                  </header>
                  <div id="div-2" class="accordion-body body in" style="height: auto;">
                    <form class="form-horizontal">
 
          <table class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Report Name</th>
                          <th>Report Type</th>
                        </tr>
                      </thead>
                      <tbody>
 










                         
 

                               <?php if(current_user('view-receipt-range')): $re1+=1;?>

                           <tr>
                          <td>
                            <span>View Receipt (Range)</span>
                          </td>
                          <td>
                           <a href="?page=receipt-list" class="btn btn-sm btn-default  "> View</a>
                          </td>
                        </tr>    
                          <?php endif;?>
 
                 

 

          
                      </tbody>
                    </table>
                    </form>
                  </div>
                </div>
              </div>

              <!--END TEXT INPUT FIELD-->
 
            </div>      
 
      <script>
      var col_count="<?php echo $re1;?>";
      if(col_count==0){
        $(".maintenance").hide();
      }
      </script>







      <?php $i=0;?>
      
    <div class="row collection">
              <div class="col-lg-12">
                <div class="box dark">
                  <header>
                  
                     <h5 class="f20">Collection Report</h5>

     
                  </header>
                  <div id="div-2" class="accordion-body body in" style="height: auto;">
                    <form class="form-horizontal">
 
          <table class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Report Name</th>
                          <th>Report Type</th>
                        </tr>
                      </thead>
                      <tbody>
 
                        <tr>
                          <td colspan="2"><strong>Sales Collection</strong></td>
                       
                        </tr>

                            <tr>
                          <td>
                         Sales Collection
                          </td>
                          <td>
                          <?php if(current_user('daily-sales-collection')): $i+=1;?> <a href="?page=summary-report&type=sales-collection&cat=sales&year=<?php echo $y;?>" class="btn btn-sm btn-default "> Daily</a><?php endif;?>
                             <?php if(current_user('monthly-sales-collection')): $i+=1;?><a href="?page=summary-report&type=sales-monthly-collection&cat=sales&year=<?php echo $y;?>" class="btn btn-sm btn-default "> Monthly</a><?php endif;?>
                        <!--                            <a href="?page=summary-report&type=sales&cat=sales" class="btn btn-sm btn-default "> Quarterly</a> -->
                          <?php if(current_user('annual-sales-collection')): $i+=1;?>    <a href="?page=summary-report&type=sales-annuall-collection&cat=sales&year=<?php echo $y;?>" class="btn btn-sm btn-default "> Annually</a><?php endif;?>
                                  <?php if(current_user('sales-chart-collection')):$i+=1;?> <a href="?page=graphical-report&type=collection-line&cat=sales" class="btn btn-sm btn-default  "><i class="glyphicon glyphicon-tasks"></i> Graphical</a><?php endif;?>
                       

                          </td>
                        </tr>   








                         
                        <tr>
                          <td>
                            <span>Unpaid Customers</span>
                          </td>
                          <td>
                           <?php if(current_user('unpaid-customers')): $i+=1;?>
                         <a href="?page=unpaid-customers&cat=sales&year=<?php echo $y;?>" class="btn btn-sm btn-default "> List All</a>
                           <?php endif;?>
                           <?php if(current_user('search-unpaid-customers')): $i+=1;?>
                         <a href="?page=unpaid-customers-search&cat=sales&year=<?php echo $y;?>" class="btn btn-sm btn-default "> Search</a>
                            <?php endif;?>
                          </td>
                        </tr>
                      

                         
                
                     



                          <?php if(current_user('paid-customers')): $i+=1;?>
                        <tr>
                          <td>
                            <span>Paid Customers</span>
                          </td>
                          <td>
                         <a href="?page=paid-invoice" class="btn btn-sm btn-default "> Details</a>


                          </td>
                        </tr>
                        <?php endif;?>





                          <?php if(current_user('search-payment')): $i+=1;?>
                        <tr>
                          <td>
                            <span>Search Payment (General)</span>
                          </td>
                          <td>
                         <a href="?page=search-payment" class="btn btn-sm btn-default "> Search</a>


                          </td>
                        </tr>
                        <?php endif;?>


                       
                        <tr>
                          <td>
                            <span>Post-dated Cheques</span>
                          </td>
                          <td>
                               <?php if(current_user('post-dated-cheques-list')): $i+=1;?>
                         <a href="?page=post-dated-cheques-list&year=<?php echo $y;?>" class="btn btn-sm btn-default "> List all</a>
                            <?php endif;?>
                               <?php if(current_user('post-dated-cheques')): $i+=1;?>
                         <a href="?page=post-dated-cheques&year=<?php echo $y;?>" class="btn btn-sm btn-default "> Search</a>
                                   <?php endif;?>
                          </td>
                        </tr>
                     



                       
 



                          <?php if(current_user('dated-cheques')): $i+=1;?>
                        <tr>
                          <td>
                            <span>Dated Cheques</span>
                          </td>
                          <td>
                         <a href="?page=dated-cheques&year=<?php echo $y;?>" class="btn btn-sm btn-default "> View all</a>


                          </td>
                        </tr>
                        <?php endif;?>



                        <tr>
                          <td colspan="2"><strong>P.O Collection</strong></td>
                       
                        </tr>

                            <tr>
                          <td>
                          P.O Collection
                          </td>
                          <td>
                          <?php if(current_user('daily-po-collection')): $i+=1;?> <a href="?page=summary-report&type=po-collection&cat=sales&year=<?php echo $y;?>" class="btn btn-sm btn-default "> Daily</a><?php endif;?>
                             <?php if(current_user('monthly-po-collection')): $i+=1;?><a href="?page=summary-report&type=monthly-po-collection&cat=sales&year=<?php echo $y;?>" class="btn btn-sm btn-default "> Monthly</a><?php endif;?>
                        <!--                            <a href="?page=summary-report&type=sales&cat=sales" class="btn btn-sm btn-default "> Quarterly</a> -->
                          <?php if(current_user('annual-po-collection')): $i+=1;?>    <a href="?page=summary-report&type=po-annual-collection&cat=sales&year=<?php echo $y;?>" class="btn btn-sm btn-default "> Annually</a><?php endif;?>   
                          </td>
                        </tr>    


                          <?php if(current_user('unpaid-p-o')): $i+=1;?>
                        <tr>
                          <td>
                            <span>Unpaid P.O</span>
                          </td>
                          <td>
                         <a href="?page=unpaid-po" class="btn btn-sm btn-default "> Details</a>

                          </td>
                        </tr>
                        <?php endif;?>



                          <?php if(current_user('search-unpaid-p-o')): $i+=1;?>
                        <tr>
                          <td>
                            <span>Unpaid P.O (Search) </span>
                          </td>
                          <td>
                         <a href="?page=unpaid-po-search&cat=sales&year=<?php echo $y;?>" class="btn btn-sm btn-default "> Details</a>

                          </td>
                        </tr>
                        <?php endif;?>


                          <?php if(current_user('paid-p-o')): $i+=1;?>
                        <tr>
                          <td>
                            <span>Paid P.O</span>
                          </td>
                          <td>
                         <a href="?page=paid-po" class="btn btn-sm btn-default "> Details</a>

                          </td>
                        </tr>
                        <?php endif;?>






          
                      </tbody>
                    </table>
                    </form>
                  </div>
                </div>
              </div>

              <!--END TEXT INPUT FIELD-->
 
            </div>      
 
      <script>
      var col_count="<?php echo $i;?>";
      if(col_count==0){
        $(".collection").hide();
      }
      </script>







 








      <?php $r=0;?>
      
    <div class="row returns">
              <div class="col-lg-12">
                <div class="box dark">
                  <header>
                 
                    <h5 class="f20">Returns Report</h5>

     
                  </header>
                  <div id="div-2" class="accordion-body body in" style="height: auto;">
                    <form class="form-horizontal">
 
          <table class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Report Name</th>
                          <th>Report Type</th>
                        </tr>
                      </thead>
                      <tbody>
 

 
 

                           <?php if(current_user('returns-per-item')): $r+=1;?>
                        <tr>
                          <td>
                            <span>Returns per item</span>
                          </td>
                          <td>
                      <a href="?page=summary-report&type=returns-item&cat=sales&year=<?php echo $y;?>" class="btn btn-sm btn-default  "> Details</a>
                          </td>
                        </tr>
                      <?php endif;?>



 






          
                      </tbody>
                    </table>
                    </form>
                  </div>
                </div>
              </div>

              <!--END TEXT INPUT FIELD-->
 
            </div>      
 
      <script>
      var col_count="<?php echo $r;?>";
      if(col_count==0){
        $(".returns").hide();
      }
      </script>
































     <?php $t=0;?>
		<div class="row transaction">
              <div class="col-lg-12">
                <div class="box dark">
                  <header>
                     
                     <h5 class="f20">Transaction Report</h5>

 
                  </header>
                  <div id="div-1" class="accordion-body body in" style="height: auto;">
                    <form class="form-horizontal">
 
					<table class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Report Name</th>
                          <th>Report Type</th>
                        </tr>
                      </thead>
                      <tbody>


                          <?php if(current_user('customer-statistics')): $t+=1;?>
                        <tr>
                          <td>
                            <span>Customer Statistics</span>
                          </td>
                          <td>
                         <a href="?page=summary-report&type=customer-statistics&cat=sales&year=<?php echo $y;?>" class="btn btn-sm btn-default "> Details</a>


                          </td>
                        </tr>
                        <?php endif;?>

                          <?php if(current_user('supplier-statistics')): $t+=1;?>
                        <tr>
                          <td>
                            <span>Supplier Statistics</span>
                          </td>
                          <td>
                         <a href="?page=summary-report&type=supplier-statistics&cat=sales&year=<?php echo $y;?>" class="btn btn-sm btn-default "> Details</a>


                          </td>
                        </tr>
                        <?php endif;?>

 



                          <?php if(current_user('agent-stats')): $t+=1;?>
                        <tr>
                          <td>
                            <span>Agent Statistics</span>
                          </td>
                          <td>
                         <a href="?page=summary-report&type=agent-statistics&cat=sales&year=<?php echo $y;?>" class="btn btn-sm btn-default "> Details</a>


                          </td>
                        </tr>
                        <?php endif;?>


 
 


                      </tbody>
                    </table>
                    </form>
                  </div>
                </div>
              </div>

              <!--END TEXT INPUT FIELD-->
 
            </div> 
          <!-- end .inner -->
		  
		  
      <script>
      var trans="<?php echo $t;?>";
      if(trans==0){
        $(".transaction").hide();
      }
      </script>
		  
		  
		  
		  
		  
		  
		  
		  <?php $in=0;?>
		<div class="row inventory">
              <div class="col-lg-12">
                <div class="box dark">
                  <header>
                  
                   <h5 class="f20">Inventory Report</h5>

     
                  </header>
                  <div id="div-2" class="accordion-body body in" style="height: auto;">
                    <form class="form-horizontal">
 
					<table class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Report Name</th>
                          <th>Report Type</th>
                        </tr>
                      </thead>
                      <tbody>
 

                      <?php if(current_user('inventory-summary')): $in+=1;?>
                        <tr>
                          <td>
                            <span>Inventory Summary</span>
                          </td>
                          <td>
                           <a href="?page=inventory&type=summary" class="btn btn-sm btn-default  "> Details</a>
                          </td>
                        </tr>
                      <?php endif;?>

        


                                <?php if(current_user('all-items')): $in+=1;?>
                        <tr>
                          <td>
                            <span>All Items</span>
                          </td>
                          <td>
                           <a href="?page=inventory&type=all-items" class="btn btn-sm btn-default  "> Details</a>
                          </td>
                        </tr>
  <?php endif;?>







 					
                      </tbody>
                    </table>
                    </form>
                  </div>
                </div>
              </div>

              <!--END TEXT INPUT FIELD-->
 
            </div> 		  
		      <script>
      var trans="<?php echo $in;?>";
      if(trans==0){
        $(".inventory").hide();
      }
      </script>
      
        
		  
		  
		  
		  
		  
	 




<?php
$total=$s+$i+$r+$re+$in+$t;

if($total==0){
?>

 

<div class="panel panel-default grid">
  <div class="panel-heading">
    <h3 class="panel-title"><strong>Reports</strong></h3>
  </div>
  <div class="panel-body">


 <div class="alert alert-info" role="alert"> <i class="glyphicon glyphicon-warning-sign"></i> Please contact your Administrator to view various reports for SIMS.</div> 

  </div>
</div>


<?php
}
?>








		  
		  
		  
        </div>

        <!-- end .outer -->
      </div>

      <!-- end #content -->
	  </div>
 
    <script type="text/javascript" src="assets/js/style-switcher.js"></script>
 

 