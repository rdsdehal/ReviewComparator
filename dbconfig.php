<?php
	
	@session_start();
	
	$host = "localhost"; //Host of Database
	$uname = "db_username"; //Username for accessing database
	$pass = "db_password"; //Password belonging to the username
	$database = "db_name"; //Name of Database
	$connection= mysql_connect($host,$uname,$pass) or die("<h1 align='center' >We're having problems connecting with database..<br>Please try again later..");
	
	mysql_query("SET NAMES UTF8"); //to  allow utf-8/special characters...
	
	$selectdb=mysql_select_db($database) or die("<h1 align='center' >We're having problems connecting with database..<br>Please try again later");	
	
	
	/* settings */
	$dom = "try.ziddle.net"; //Domain name 
	$protocol = "http://";   //Standard protocol for domain..
	$domain = $protocol . $dom; //full domain address
	
	
	function sendRegistrationMail( $email , $username , $pw , $subject = "Thank you for registering" ) {
		
		$message = "Thank you for registering on our website..<br>Email : <b>{$email}</b><br>Username : <b>{$username}</b><br>Pass : <b>{$pw}</b>";
		
		$headers = "From: <no-reply@{$_GLOBALS['dom']}>\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
		
		return mail($email , $subject , $message , $headers );
	}
	
	
	function toPass($str) {
		return md5( $str );
	}
	//toPass converts str to password format (hash)
?>