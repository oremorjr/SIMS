<?php
require('../db_config.php');
$connect=new DB();
	//$return['res']=1;	
	//form variables
	$uname=trim($_REQUEST['uname']);
	$pwd1=trim(($_REQUEST['pwd']));
	$pwd=md5($pwd1);
	
	//start SQL query
	$query1=mysql_query("SELECT * FROM osd_users WHERE uname='".$uname."' AND pwd='".$pwd."'  or empID='".$uname."' AND pwd='".$pwd."' ");
	$num_query=mysql_num_rows($query1);
	
	if($num_query==1){
		if($row=mysql_fetch_array($query1)){
			$uid=$row['UID'];
			$fullname=$row['fname'].' '.$row['lname'];
			$_SESSION['SESS_UTYPE']=$row['utype'];
			$_SESSION['SESS_POSITION']=$row['u_position'];
			$_SESSION['SESS_USERNAME']=$row['uname'];
			$_SESSION['SESS_MEMBER_UID']=$uid;
			$date_now=date("Y-m-d");
			$status=$row['u_status'];
			$update=mysql_query("UPDATE osd_users SET last_access='".$date_now."', u_login=1 WHERE UID='".$uid."' ");
			update_cheque();
			$UID=$uid;
			$message=$fullname." successfully logged in.";
			$category="Login";

			save_log($UID, $message, $category);



		}
		//there is a user
		$return['fname']=$fullname;
		if($status==1){
		$return['res']=1;	
		}else{
		$return['res']=6;	
		}
	}else{
		$return['res']=2;	
		//start failed login count
		if(isset($_SESSION['error']))
			$_SESSION['error']=$_SESSION['error']+1;
		else
			$_SESSION['error']=1;
		
		//end failed login count
		
				$count_error=$_SESSION['error'];
				if($count_error>=3){
					$return['res']=3;
				}
				$return['err']=$_SESSION['error'];


		$UID=1;
		$message=$uname." Login attempt.";
		$category="Login";

		save_log($UID, $message, $category);

		
	}
	
	echo json_encode($return);

 

?>