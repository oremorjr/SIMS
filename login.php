<?php
include('include/class_lib.php');
$user=new User();
$user->login_();
$_SESSION['error']=0;
?>
<!DOCTYPE html>
<html lang="en" id="external">
  <head>
    <meta charset="UTF-8">
    <title>Login Page - <?php echo setting('company_name', 1);?></title>
    <meta name="msapplication-TileColor" content="#5bc0de" />
    <meta name="msapplication-TileImage" content="assets/img/metis-tile.png" />
    <link rel="stylesheet" href="home/assets/lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="home/assets/css/main.css">
    <script src="js/jquery.min.js"></script>
    <script src="home/assets/lib/bootstrap/js/bootstrap.js"></script>	
	<script src="js/login_validate.js"></script>
	<script src="js/jquery.validate.js"></script>
    <script>
		$(document).ready(function(){
			$("#uname").focus();
		});

    </script>
  </head>
  <body class="login">
    <div class="system-logo">
      <img src="images/1.png">
    </div>
	<div id="welcome-message">

  <div>Welcome to SIMS </div>

  <div>To continue, please login using your username and password below.    </div>
      
	</div>

    <div class="container">
      <div class="text-center"> 
		  <div id="add"></div>
      </div>

      <div class="tab-content">
        <div id="login" class="tab-pane active">
          <form class="form-signin" id="login_form">
			<div id="ctrl-inputs">
         <div class="text-muted text-center company-name"> <?php echo setting('company_name', 1);?> </div>
            <p class="text-muted text-center" style="color:#000;font-size: 13px;margin-bottom: 15px;" >
              Enter your username and password
            </p>
            <input id="uname" type="text" name="uname" placeholder="Username" class="form-control" autocomplete="off">
            <input type="password" name="pwd" placeholder="Password" class="form-control" autocomplete="off">
			<input type="submit" id="save" class="btn btn-lg btn-flat btn-block" value="Sign in">
			</div>
			<table width="100%" id="ctrl-bottom">
					<tbody><tr>
						<td class="text-left" style="padding-left:15px;" >
						 © Copyright <?php echo date('Y');?> 
						</td>
						<td class="text-right" style="padding-right:15px;">
							Build <?php system_version();?>			</td>
					</tr>
			</tbody></table>				
          </form>
	  
        </div>
 
 
 
    </div><!-- /container -->

 
  </body>
</html>
