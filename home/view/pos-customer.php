<?php
if(!current_user('sales'))
  return false;
 
?>
      <div id="content">
        <div class="outer">
    <div class="inner">
    <div class="row">
              <div class="col-lg-12">
                <div class="box dark">
                  <header>
                    <div class="icons">
                      <i class="fa fa-edit"></i>
                    </div>
                    <h5>SALES TRANSACTION</h5>

                    <!-- .toolbar -->
                    <div class="toolbar">
 
                    </div><!-- /.toolbar -->
                  </header>
                  <div id="div-1" class="accordion-body body in" style="min-height:470px;height:auto;overflow:hidden;">
        <div class="col-lg-7">
          <div class="box  "  style="min-height:400px;">
            <header>
              <div class="icons">
                <i class="glyphicon glyphicon-shopping-cart"></i>
              </div>
              <h5>Search Customer</h5>

            </header>
            <div id="div-4" class="accordion-body collapse in body">
 



              <div id="loading-result-2" >
               
              </div>
            </div> 
          </div>
        </div><!-- end col-lg-4 -->

<div class="col-lg-5">
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
          <h5>Recent</h5>
        </div>
      </header>
      <div id="div-4" class="accordion-body collapse in body">
    <table id="recent" class="  table table-bordered table-condensed table-hover table-striped">
      <thead>
      <tr>
        <th>DNO</th>
        <th>Total</th>
 
      </tr>
      </thead>
      <tbody>
      <?php
     $gtotal=0;
     $gprofit=0;
 
      
      $q1=mysql_query("SELECT * from osd_transaction where  t_paid=1 and t_mode=1 order by TID DESC LIMIT 10 ");
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
      $tno=$row['t_receiptno'];
      $tid=$row['TID'];
   $show_sale=number_format($sale, 2, '.', ',');
      ?>
      <tr>
        <td><a href="?page=view-receipt&mode=1&TID=<?php echo $tid; ?>"><?php echo $tno;?></a></td>
        <td><?php echo $show_sale;?></td>
 
 
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
              </div>

              <!--END TEXT INPUT FIELD-->
 
            </div> 
          <!-- end .inner -->
      
      
      
      
      
      
      
      
      
    
      
      
      
      
      
      
      
      
      
      
      
        </div>

        <!-- end .outer -->
      </div>

      <!-- end #content -->
    </div>
 <script type="text/javascript">
 $(document).ready(function(){

 

 

  show_result();
 
    function show_result(){
      jQuery.ajax({
        data: {slug: 'customer'},
        url: 'view/view-result/customer-list-home.php',
        success: function(data){
           jQuery('#loading-result-2').html(data);
        },
        beforeSend:function(){
           jQuery('#loading-result-2').html('loading');
        }

      });

    }


 });
 </script>
 
 