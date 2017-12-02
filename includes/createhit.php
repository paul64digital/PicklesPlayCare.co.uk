<?php 	
	//Connect to host
	include('dbconnect.php');
	
	//Identify if the browser is a spider
	if (substr($_SERVER['HTTP_USER_AGENT'],0,3)=="W3C") {
			/*Do Nothing*/
		}
	elseif (!strstr($_SERVER['HTTP_USER_AGENT'],'Ask Jeeves')==false) {
		$ls_spider="Ask Jeeves";
	}
	elseif (!strstr($_SERVER['HTTP_USER_AGENT'],'Googlebot')==false) {
		$ls_spider="Google";
	}
	elseif (!strstr($_SERVER['HTTP_USER_AGENT'],'Yahoo!')==false) {
		$ls_spider="Yahoo";
	}
	elseif (!strstr($_SERVER['HTTP_USER_AGENT'],'msnbot')==false) {
		$ls_spider="MSN";
	}
	elseif (!strstr($_SERVER['HTTP_USER_AGENT'],'Twiceler')==false) {
		$ls_spider="Twiceler";
	}
	elseif (!strstr($_SERVER['HTTP_USER_AGENT'],'Firefox')==false) {
		/*Do Nothing*/
	}
	elseif (!strstr($_SERVER['HTTP_USER_AGENT'],'MSIE')==false) {
		/*Do Nothing*/
	}
	elseif (!strstr($_SERVER['HTTP_USER_AGENT'],'Chrome')==false) {
		/*Do Nothing*/
	}
	elseif (!strstr($_SERVER['HTTP_USER_AGENT'],'iPhone')==false) {
		/*Do Nothing*/
	}
	elseif (!strstr($_SERVER['HTTP_USER_AGENT'],'Safari')==false) {
		/*Do Nothing*/
	}
	
	//Did the user come straight here?
	if($_SERVER['HTTP_REFERER']=="") {
		$li_referred=0;
	}
	else {
		$li_referred=1;
	}
	
	//Check if this IP has accessed the site already today
	$result = mysql_query($sql = "SELECT count(*) as hitcount FROM tblHits where ipaddress='" . $_SERVER['REMOTE_ADDR'] . "' AND date(accessed)=CURDATE();");	
	if ($result !== false) {
		$row = mysql_fetch_array($result);
		$result = $row['hitcount'];
	}
	else {
		$result = 0;
	}
	
	//print 'visits today ' . $result;

	if ($result==0) {
		//Insert the hit
		$result = mysql_query("INSERT INTO tblHits (ipAddress,spider,referred) VALUES ('" . $_SERVER['REMOTE_ADDR'] . "', '" . $ls_spider . "','" . $li_referred . "')");
	
		//Check the insert
		/*if ($result==1) {
			echo "Insert successful";
		}
		else {
			echo "Insert failed";
		}*/
	}
	else {
		//print "User has already visited today";
	}
	
	//Close the server connection
	mysql_close($con);
?>