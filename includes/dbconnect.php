<?php
	//Define the connection params
	DEFINE ('DB_HOST', '');
	DEFINE ('DB_USER', '');
	DEFINE ('DB_PASSWORD', '');
	DEFINE ('DB_NAME', '');
	
	//Connect to the host
	$con = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);	
	if (!$con) {
		die("Could not connect to host: " . mysql_error() . "<br/>");
	}
	
	//Connect to the database
	$db_selected = mysql_select_db(DB_NAME, $con);
	if (!$db_selected) {
		die ("Could not connect to database '" . DB_NAME . "': " . mysql_error()). "<br/>";
	}
?>