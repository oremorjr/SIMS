<?php
require('../db_config.php');
$connect=new DB();

$positionid=$_REQUEST['positionid'];
?>
<div class="access_area"></div>
 
<?php

// echo $positionid;

$categories=osd_query('osd_page', $where="p_type=2 ", $group='p_pagecategory ORDER BY p_pagecategory'  );

foreach($categories as $category){
$catname=$category['p_pagecategory'];
$cat_id=$category['p_pageid'];

?>
<div class="col-lg-12 cat_name page-category" id="<?php echo $cat_id;?>"><?php echo $catname; ?></div>
<div id="capability-<?php echo $cat_id?>" style="display: none;" class="capabilities" >
<?php
$rows1=osd_query('osd_page',$where="p_pagecategory='$catname' && p_type=2    ", $group="p_cap_group ORDER BY p_pagecategory");

foreach($rows1 as $row1){

$cap_group=$row1['p_cap_group'];

echo '<div class="group_name">'.$cap_group.'</div>';

$rows=osd_query('osd_page',$where="p_pagecategory='$catname' && p_type=2 and p_cap_group='$cap_group' and p_pagename!='$cap_group'  ", $group="p_pagename ORDER BY p_pagename");

 

$pid=""; 
$checked=array();

?>

<?php

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
<div class="check-list col-lg-4"  >
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

}

?>
</div>
<?php

}
?>	

<script>
$(document).ready(function(){

	$('.page-category').click(function(){
	var id=$(this).attr('id');
	$('#capability-'+id).slideToggle();
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