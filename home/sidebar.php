      <div id="top">

        <!-- .navbar -->
		<?php require_once("page-nav.php"); ?>

        <!-- header.head -->
        <header class="head">
 

          <!-- ."main-bar -->
          <div class="main-bar">
           
          </div><!-- /.main-bar -->
        </header>

        <!-- end header.head -->
      </div><!-- /#top -->
      <div id="left">


        <!-- #menu -->
        <ul id="menu" class="collapse">
          <li class="nav-header">  <div class="welcome">Welcome! <?php echo $user_name1; ?> <div class="sub"  > <?php echo $userposition1;?></div></div></li>
          <li class="nav-divider"></li>
<?php
if(current_user('transaction')):
?>
          <li class="">
            <a href="?page=transaction">
              <i class="glyphicon glyphicon-briefcase "></i>
              <span class="link-title">TRANSACTION</span>
            
            </a>
          </li> 
<?php
 endif;
 
 
?>

<?php
if(current_user('suppliers')):
?>
<li class="">
<a href="?page=suppliers">
<i class="glyphicon glyphicon-thumbs-up"></i>
<span class="link-title">SUPPLIERS</span>
</a>
</li> 
<?php
endif;  
?>		  
		 




<?php
if(current_user('item')):
?>
<li class="">
<a href="?page=item">
<i class="glyphicon glyphicon-barcode"></i>
<span class="link-title">ITEMS</span>
</a>
</li> 
<?php  
endif;  
?>

<?php
if(current_user('customer')):
?>
<li class="">
<a href="?page=customer">
<i class="glyphicon glyphicon-user"></i>
<span class="link-title">CUSTOMERS</span>
</a>
</li> 
<?php
endif;
?>				  
 		  
 
          
<?php
if(current_user('general')):
?>
              <li class="">
              <a href="?page=general">
              <i class="glyphicon glyphicon-file"></i>
              <span class="link-title">REPORTS</span>
              </a>
              </li> 
            <?php endif;?>
    
   
    
        </ul>		
	
		<!-- /#menu -->
      </div><!-- /#left -->