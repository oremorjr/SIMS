<?php require_once("header.php");?>
	<?php require_once("sidebar.php"); ?>
 
 
	<div id="main-area">
		
	<?php
	if(file_exists("view/$page")){
	require_once("view/$page");
	}else{
	echo 'NONE';	
	}
	 ?>
	</div>

<?php require_once("footer.php");?>
 