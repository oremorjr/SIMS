<?php
session_start();
 
// error_reporting(0);
DEFINE('DB_SERVER', 'localhost');
DEFINE('DB_USERNAME', 'root');
DEFINE('DB_PASSWORD', 'admin#123');
DEFINE('DB_DATABASE','osd_final');

class DB{
	function __construct(){
		$con=mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die("NO CONNECTION");
		mysql_select_db(DB_DATABASE, $con) or die("NO CONNECTION");	
		
	}
}

require('functions.php');


?>