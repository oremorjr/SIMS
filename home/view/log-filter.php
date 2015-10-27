      <div id="content">
        <div class="outer">
    <div class="inner">
    <div class="row">
    
 
                  <div id="div-1" class="accordion-body body in" style="min-height:470px;height:auto;overflow:hidden;">
 

<div class="col-lg-12">
 
<div class="col-lg-12 grid">
<label>Year</label>
</div>
<div class="col-lg-12 grid">
<select class="form-control" id="year">
<?php
$rows=osd_query('osd_log',$where='',$group='YEAR(l_date)');
foreach($rows as $row){
$y=$row['l_date'];
$year=date('Y', strtotime($y));
echo '<option value='.$year.'>'.$year.'</option>';
}
?>
</select>
</div>

<div class="col-lg-12 grid">
<label>Month</label>
</div>
<div class="col-lg-12 grid">
<select class="form-control" id="month">
<?php
$rows2=osd_query('osd_log',$where='',$group='MONTH(l_date)');
foreach($rows2 as $row2){
$m=$row2['l_date_time'];
$month=date('F', strtotime($y));
$m2=date('m', strtotime($y));
echo '<option value='.$m2.'>'.$month.'</option>';
}
?>
</select>
</div>
<div class="col-lg-12 grid">
<input type="button" class="filter btn btn-success" value="Filter" >
</div>


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
 
 <script>
 $(document).ready(function(){
$('.filter').click(function(){

  var year=$('#year').val();
  var month=$('#month').val();
  window.location="?page=log&year="+year+"&month="+month;

});
 });
 </script>