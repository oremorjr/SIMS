 <?php
if(!isset($_REQUEST['m']))
return false;
$mode=$_REQUEST['m'];
 ?>
      <div id="content">
        <div class="outer">
    <div class="inner">
    <div class="row">
    
 
                  <div id="div-1" class="accordion-body body in" style="min-height:470px;height:auto;overflow:hidden;">
 

<div class="col-lg-12">
 <div id="loading-result" >
 
<div class="col-lg-12" style="min-height:470px;height:auto;overflow:hidden;">
  <div class="row">
    <div class="box">
      <header>
        <div class="icons"> <i class="fa fa-table"></i> </div>
        <div>
          <h5>Transaction Log</h5>
        </div>
      </header>
      <div id="div-4" class="accordion-body collapse in body">


 <table class="table table-bordered table-condensed table-hover table-striped">
<tr>
<td colspan="2"><strong>Filter Date</strong></td>
</tr>

<tr>
  <td>
   <select class="form-control mb-0" id="month" >

  <?php
$rows=osd_query("osd_transaction", $where="t_mode=$mode and t_active=0", "MONTH(t_transaction_date)");
$ynow=date('F');
$mnow=date('m');
echo '<option value='.$mnow.'>--Select Month--</option>';
echo '<option value='.$mnow.'>'.$ynow.'</option>';

foreach($rows as $row){
$ty=$row['t_transaction_date'];
$y_ty=date('m', strtotime($ty));
$m_ty=date('m', strtotime($ty));
$m_ty2=date('F', strtotime($ty));
if($mnow!=$m_ty):
echo '<option value='.$m_ty.'>'.$m_ty2.'</option>';
endif;
} 
?>

   </select>
  </td>
  <td>

   <select class="form-control mb-0" id="sy" >

  <?php
$rows=osd_query("osd_transaction", $where="t_mode=$mode and t_active=0", "YEAR(t_transaction_date)");
$ynow=date('Y');
echo '<option value='.$ynow.'>--Select Year--</option>';
echo '<option value='.$ynow.'>'.$ynow.'</option>';
foreach($rows as $row){
$ty=$row['t_transaction_date'];
$y_ty=date('Y', strtotime($ty));
if($y_ty!=$ynow):
echo '<option value='.$y_ty.'>'.$y_ty.'</option>';
endif;
} 
?>

   </select>

  </td>

</tr>
</table>

 


        <div id="log">
        </div>
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
 
 <script type="text/javascript">
$(document).ready(function(){

var MODE="<?php echo $mode;?>";
var sy=$("#sy option:selected").val();
var m=$("#month option:selected").val();
show_log(MODE, sy, m);


$("#sy").change(function(){

var sy=$(this).val();
var m=$("#month option:selected").val();
show_log(MODE, sy, m);

});

$("#month").change(function(){

var sy=$("#sy option:selected").val();
var m=$(this).val();
show_log(MODE, sy, m);

});

});
 </script>