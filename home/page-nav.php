        <nav class="navbar navbar-inverse ">

          <!-- Brand and toggle get grouped for better mobile display -->
          <header class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a href="welcome" class="navbar-brand">
              <img src="../images/company-logo/<?php echo $company->logo;  ?>" width="100" alt="">
            </a>


          </header>


          <div class="topnav">
            <div class="btn-toolbar">
      
          
              <div class="btn-group">
                <a href="?q=logout" data-toggle="tooltip" data-original-title="Logout" data-placement="bottom" class="btn btn-metis-1 btn-sm">
                  <i class="fa fa-power-off"></i>
                </a>
              </div>
            </div>
          </div><!-- /.topnav -->
          <div class="collapse navbar-collapse navbar-ex1-collapse">

            <!-- .nav -->

            <ul class="nav navbar-nav">
              <?php
          if(current_user('index')): 
                  ?><li> <a href="?page=index">Dashboard</a> </li><?php
                endif;
              
              ?>

<!--          
               <li class='dropdown '>
             
                <?php
   foreach($slugs as $slug){
                if($slug=='tools'):
                ?>

                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                 Tools
                  <b class="caret"></b>
                </a>

              <?php
              endif;
}
              ?>

                <ul class="dropdown-menu">
                  <?php

                     foreach($slugs as $slug){
                  ?>


              <?php if($slug=='category'): ?>    <li> <a href="?page=category">Category</a> </li> <?php endif;?>
              <?php if($slug=='units'): ?>    <li> <a href="?page=units">Variation</a> </li><?php endif;?>
              <?php if($slug=='settings'): ?>   <li> <a href="?page=settings">Settings</a> </li> <?php endif;?>
              <?php if($slug=='users'): ?>   <li> <a href="?page=users">Users</a> </li>  <?php endif;?>
              <?php if($slug=='position'): ?>   <li> <a href="?page=position">User Role</a> </li> <?php endif;?>
              <?php if($slug=='pages'): ?>   <li> <a href="?page=pages">Pages</a> </li> <?php endif;?>
              <?php if($slug=='role-editor'): ?>   <li> <a href="?page=role-editor">User Role Editor (Developer)</a> </li> <?php endif;?>
              <?php if($slug=='admin-editor'): ?>   <li> <a href="?page=admin-editor">User Role Editor (Admin)</a> </li> <?php endif;?>

  <?php
}
?>
                </ul>
              </li>            -->



<?php
$rows=osd_query('osd_page',$where="p_pagecategory!='' AND p_type=0 ", $group='p_pagecategory');
foreach($rows as $row){
$main_nav=$row['p_pagecategory'];
?>
<li class='dropdown '>

 

<a href="#" class="dropdown-toggle" data-toggle="dropdown" id="<?php echo $main_nav;?>">
<?php echo $main_nav;?>
<b class="caret"></b>
</a>

 
<ul class="dropdown-menu">
<?php
$rows2=osd_query('osd_page',$where="p_pagecategory='$main_nav'  ",$group='');
$i=0;


foreach($rows2 as $row2){
$childnav=$row2['p_pagename'];
$childlink=$row2['p_pageslug'];
?>

<?php
foreach($slugs as $slug){
?>


<?php if($slug==$childlink): $i=$i+1;?>    <li> <a href="?page=<?php echo $childlink;?>"><?php echo $childnav;?></a> </li> <?php endif;?>

<?php
}

if($i==0){
?>
<script>
var c="<?php echo $main_nav;?>";
$('#'+c).hide();
</script>
<?php
}
?>


 
 <?php 
}
?>

</ul>



</li>      

<?php

}
?>
         
 
 
<li> <a href="?page=about">About</a> </li>
 
            </ul><!-- /.nav -->


 

          </div>
		  
			<div class="time">
                   <div><span class="Timer"></span></div>
			 
			</div>		  
        </nav><!-- /.navbar -->



        