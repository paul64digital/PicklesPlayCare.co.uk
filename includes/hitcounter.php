<?php 	
	//Connect to host
	include('dbconnect.php');

	//Create the SQL for retrieving the hits
	$sql = "SELECT count(ipaddress) as hitcount FROM tblHits;";

	//Run SQL query
	$result = mysql_query($sql);
	if( $result !== false ) {
		$row = mysql_fetch_array($result);
		
		//Output hits
		echo $row['hitcount'];
		
		//Close the server connection
		mysql_close($con);
	}
	else {
		print '0';
	}
?>