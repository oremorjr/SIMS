<?php $type=$_GET['page'].'-'.$_GET['type'].'.php';?>
<span id="slug" data-value="<?php echo $slug;?>"></span> 
 

<div id="content">

<div class="outer">
 	
<div class="inner">
<div id="loading-result" >
								<?php
								require_once("report/$type"); ?>
							</div>



 	
</div>
<!-- end .inner -->
</div>
<!-- end .outer -->
</div>
<!-- end #content -->	  
 
		 
 