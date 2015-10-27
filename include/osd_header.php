<?php
$user=new User();
$user->not_login_();
$UID = $_SESSION['SESS_MEMBER_UID'];
$empid=$_SESSION['SESS_MEMBER_UID'];
if (isset($_GET['q'])=="logout") {
	mysql_query("UPDATE osd_users SET u_login=0 where UID='$empid' ");
	$user->user_logout();
	header("location:../login");
}
date_default_timezone_set('Asia/Manila');

$user_info = new all_users();
$query = "SELECT * FROM osd_users INNER JOIN osd_usertype ON (utype=UTID) WHERE UID='".$UID."'";
$user_info->select($query);

$company=new company();
$query="SELECT * from osd_setting";
$company->select($query);
$utid=$user_info->UTID;
$u_login=$user_info->status;
$utid==1 ? $menu=true : $menu=false;
$utid==2 ? $encoder=true : $encoder=false;
$utid==1 ? $admin=true : $admin=false;
$utid==0 ? $dev=true : $dev=false;
$page=$user->curPageName();	

if(isset($_GET['CID'])){
$cid=$_GET['CID'];
}
if(isset($_GET['SID'])){
$sid=$_GET['SID'];
}
if(isset($_GET['PID'])){
$pid=$_GET['PID'];
}

$show_gtotal=0; 
$show_profit=0;
$show_gprofit =0;

     $_SESSION['session_time'] = time(); //got the login time for user in second 
     $session_logout = 10; //it means 15 minutes. 
     //and then cek the time session 
    if($session_logout >= $_SESSION['session_time']){ 
		mysql_query("UPDATE osd_users SET u_login=0 where UID='$empid' ");
		$user->user_logout();
		header("location:../login");
    } 

if(isset($_GET['page'])){
$curpage=$_GET['page'];

 
 

 

}
// end page


$user_name1=$_SESSION['SESS_USERNAME'];
$position1=$_SESSION['SESS_POSITION'];
$userposition1=pabs_query('p_posname','osd_position','p_posid', $position1);
page_privelege($position1);

$rows=osd_query("osd_access INNER JOIN osd_page ON (a_pageid=p_pageid) ",$where="a_posid='$position1' and p_type=0 ORDER BY p_pagename ", $group='');
foreach($rows as $row){

$pageid=$row['a_pageid'];
$pageslug=pabs_query('p_pageslug','osd_page','p_pageid', $pageid);
$slugs[]=$pageslug;
}







?>
