<?php
	//search.php
	
	if( !isset($_POST['key']) ) die("Invalid Request..");
	
	require_once( __DIR__ . "/dbconfig.php");
	require_once( __DIR__ . "/rate.php");
	
	$key = mysql_real_escape_string( trim($_POST['key']) );
	
	if( strlen($key) < 3 ) die("Please enter atleast 3 letters..");
	
	$sql = mysql_query("SELECT * FROM `reviews` WHERE `product_name` LIKE '%{$key}%' OR `company` LIKE '%{$key}%'");
	
	mysql_query("UPDATE `reviews` SET `times_searched` = `times_searched` + 1 WHERE `product_name` LIKE '%{$key}%' OR `company` LIKE '%{$key}%'");
	
	if( mysql_num_rows($sql) < 1) die("<center><h3>No Results Found</h3></center>");
	
	echo "<table style='width:100%;' ><tr><th>Product<th>Company<th>Review<th>Rating</tr>";
	
	$reviews = array();
	
	while($data = mysql_fetch_object($sql)) {
		$data->company = htmlentities( $data->company );
		$data->review  = htmlentities( $data->review );
		$data->product_name = htmlentities( $data->product_name );
		
		$reviews[ $data->product_name ] = $reviews[ $data->product_name ] == (array) $reviews[ $data->product_name ] ? $reviews[ $data->product_name ] : array();
		
		$reviews[ $data->product_name ][] = $data;
	}
	
	//var_dump( $reviews , mysql_num_rows($sql) , mysql_error() );
	
	foreach($reviews as $data) {
		$total = 0;
		
		foreach($data as $i=>$rev) {
			echo "<tr>";
			if($i == 0) echo "<th>{$rev->product_name}<th>{$rev->company}<th >";
			else echo "<th><th >{$rev->company}<th >";
			
			$pts = rateString( $rev->review );
			echo "<p class='minimize' >" . str_replace("\n","<br>",htmlentities( $rev->review ))  . "</p><th>{$pts}</tr>";
			$total += $pts;
			
		}
		
		echo "<tr><th colspan=3 align=right >Average Rating : <th style='border-top:1px solid #fff;border-bottom:1px solid #fff;' >" . ($total / ($i+1)) . "</tr>";
	}
?>