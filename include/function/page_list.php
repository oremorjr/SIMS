<?php
require('../db_config.php');
$connect=new DB();

$positionid=$_REQUEST['positionid'];
?>
<div class="access_area"></div>
 
<?php

// echo $positionid;

$categories=osd_query('osd_page', $where="p_type=0 OR p_type=1", $group='p_pagecategory' );

foreach($categories as $category){
$catname=$category['p_pagecategory'];
$p_pageid=$category['p_pageid'];

?>
<div class="col-lg-12 cat_name" id="<?php echo $p_pageid?>"><?php echo $catname; ?></div>
<?php
$rows=osd_query('osd_page',$where="p_pagecategory='$catname' && (p_type=0 OR p_type=1)", $group='p_pageid ORDER BY p_pagename');


?>
<div class="user-access" style="display: ;" id="access-<?php echo $p_pageid;?>">
<?php
$pid=""; 
$checked=array();
foreach($rows as $row){

$pageid=$row['p_pageid'];
 
 $q1=mysql_query("SELECT * from osd_access where a_pageid='$pageid'   ");
 while($row1=mysql_fetch_array($q1)){
$pid=$row1['a_pageid'];
$postid=$row1['a_posid'];


 if($pid==$pageid && $postid==$positionid){
  // echo $pid.' == '.$pageid.'<br>';
 $checked[]=$pid;
 } 

 }







?>
<div class="check-list col-lg-4" >
    <label class="switch">
 

<input id="<?php echo $pageid;?>" type="checkbox" class="check_role switch-input" name="role[]" 

<?php foreach($checked as $checkeditem){

if($checkeditem==$pageid){
echo 'checked';
}


}?>

 value="<?php echo $row['p_pageid'];?>">


      <span class="switch-label" data-on="On" data-off="Off"></span>
      <span class="switch-handle"></span>
    </label>
<label class="label-list" for="<?php echo $pageid;?>">

<?php echo $row['p_pagename'];?>
</label>




</div>

<?php
}
?>

</div>
<?php



}
?>	

<script>
$(document).ready(function(){


$(".cat_name").click(function(){

var id=$(this).attr('id');
$("#access-"+id).slideToggle();

});


	$('.check_role').click(function(){

		var pos="<?php echo $positionid;?>";
		var page=$(this).val();

		$.ajax({
		data: {positionid: pos, page:page},
		url: "../include/function/access.php",
		success:function(data){
		 $('.access_area').html(data);
		}


		});


	});

});
</script>