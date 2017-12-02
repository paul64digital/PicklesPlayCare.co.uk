<?php
	$ipAddr = $_SERVER['REMOTE_ADDR'];
	$name = $_POST['name'];
	$Referer = $_SERVER['HTTP_REFERER'];
	$myurl = "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
	
	//print $Referer . "\n";
	//print $myurl . "\n";
	
	if(isset($name)){
		$emailaddr = $_POST['emailaddr'];
		$note = $_POST['note'];
		
		//Connect to host
		include('./includes/dbconnect.php');
		
		//Escape characters to prevent sql injection
			if( get_magic_quotes_gpc() )
			{
				$name = stripslashes( $name );
				$emailaddr = stripslashes( $emailaddr );
				$note = stripslashes( $note );
			}
			//check if this function exists
			if( function_exists( "mysql_real_escape_string" ) )
			{
				$name = mysql_real_escape_string( $name );
				$emailaddr = mysql_real_escape_string( $emailaddr );
				$note = mysql_real_escape_string( $note );
			}
			//for PHP version < 4.3.0 use addslashes
			else
			{
				$name = addslashes( $name );
				$emailaddr = addslashes( $emailaddr );
				$note = addslashes( $note );
			}
		
		//Replace HTML tags
		$name = str_replace("<", "(", $name);
		$name = str_replace(">", ")", $name);
		
		$emailaddr = str_replace("<", "(", $emailaddr);
		$emailaddr = str_replace(">", ")", $emailaddr);
		
		$note = str_replace("<", "(", $note);
		$note = str_replace(">", ")", $note);
		
		//Check if it might be spam
		$visible=1;
		$headers = "From: info@picklesplaycare.co.uk";
		if (strstr($note,"http")>"") {
			$visible=0;
			//mail("info@picklesplaycare.co.uk", "Suspect visitor note added", "A visitor note has been added that looks to contain a hyperlink. It is not being displayed on the site. Please review the note below in case it is legitamate.\n\n$note", $headers);
		}
		else {
			mail("info@picklesplaycare.co.uk", "Visitor Note Added", "Name: " . $name . "\nEmail: " . $email . "\n" . "\n" . $note, $headers);
		};
		
		//Add note if not malicious
		if ($visible==1) {
			//Run SQL command
			$result = mysql_query("INSERT INTO tblGuestbook(ipaddress,name,emailaddr,note,created,visible) VALUES('$ipAddr','$name','$emailaddr','$note',now(),$visible)");
			
			//Close the server connection
			mysql_close($con);
		}
	}
?>

<?php $title="Pickles Playcare Visitors book"; include('./includes/header.php')?>

<p class="subtitle">Visitor's Book</p>

<?php
	if (isset($note) && $visible==0) {
		echo "<p class='reqmissing'>Your visitor book entry has been saved but marked as suspicious. It will be reviewed before posted.</p>";
	}
	else {
		echo "<p>Please sign my visitors book!</p>";
	};
?>

<form id="visitorsbook" method="post" action="visitors.php">
<table class="centered">
<tr>
	<td style="text-align:right">Name:</td>
	<td><input type="text" name="name" maxlength="25"/></td>
</tr>
<tr>
	<td style="text-align:right">Email:</td>
	<td><input type="text" name="emailaddr" maxlength="128"/></td>
</tr>
<tr>
	<td style="text-align:right">Note:</td>
	<td><textarea name="note" rows="10" cols="50"></textarea></td>
</tr>
<tr>
	<td colspan="2" style="text-align:center"><input type="submit" name="submit" value="Submit" /></td>
</tr>
</table>
</form>

<?php 	
	//Connect to host
	include('./includes/dbconnect.php');

	//Run SQL query
	$result = mysql_query("SELECT * FROM tblGuestbook WHERE visible=1 order by id desc LIMIT 10");
	
	
	//TODO: display the number of records returned
	
	
	//Create results table
	print "<table border=\"1\" class='centered'>\n";
	while ($row = mysql_fetch_array($result)) {
		print "<tr>\n";
		print "    <td>";
		
		//Work out the note age
		$datetoday = time();
		$notedate = strtotime($row['created']);
		$dateDiff = $datetoday - $notedate;
		
		if ($dateDiff<60) {
			print $row['name'] . '   <span class="watermark">' . "Just now!</span><br/>\n";
		}
		else {
			$fullDays = floor($dateDiff/(60*60*24));
			$fullHours = floor(($dateDiff-($fullDays*60*60*24))/(60*60));
			$fullMinutes = floor(($dateDiff-($fullDays*60*60*24)-($fullHours*60*60))/60);
			//date(d.'/'.m.'/'.Y,strtotime($row['created']))
			print $row['name'] . '   <span class="watermark">' . $fullDays . "days " . $fullHours . "hrs " . $fullMinutes . "mins</span><br/>\n"; //strftime($row['created'],"%d/%m/%Y %H:%M:%S")
		}
		print $row['note'];
		print "</td>\n";
		print "</tr>\n";
	}
	print "</table>\n";
	
	//Close the server connection
	mysql_close($con);
?>

<?php include('./includes/footer.php')?>