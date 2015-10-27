
<!-- start customer-->
<?php session_start();?>


<div class="col-lg-12"> 
 
<div id="div-1" class="search-form accordion-body collapse in body">
<label class=" col-lg-12 text-center">Are you sure you want remove this record?</label>
<div id="status-area"  >

<div>
<h5 class="form-status"></h5>
</div>					
</div>	
<div class="edit-area"></div>					

</div><!-- /.box -->
<form action="#" method="post" class="form-horizontal" id="form-update">
 

<div id="form-area"> 
<div class="new-loading" style="display:none;">
<img src="../images/loading_animation.gif" width="180">
</div>
<div class="auth">
<div class="form-group">

</div>					
<div class="form-group" class="col-lg-12"   > 
<div class="col-lg-12"  >
<input type="hidden" name="empid" id="empid" value="<?php echo $_SESSION['SESS_MEMBER_UID'];?>">
<input type="password" id="pwd"  name="f1" placeholder="Password" class="focus form-control" value="">
<input type="hidden" id="del_ID"  placeholder="Password" class="focus form-control" value="<?php echo $_GET['ID'];?>">
</div>
</div>							
</div>


</div>      							

 
 
</form>
</div>
</div>
</div>
<!-- end customer-->
<script type="text/javascript" src="../js/update/update_sims.js" ></script>


