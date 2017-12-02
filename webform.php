<?php $title="Pickles Playcare Contact Details"; include('./includes/header.php')?>

<?php //Create functions for checking webform content
	function checkEmail($field) {
		//filter_var() sanitizes the e-mail address using FILTER_SANITIZE_EMAIL
		$field=filter_var($field, FILTER_SANITIZE_EMAIL);

		//filter_var() validates the e-mail address using FILTER_VALIDATE_EMAIL
		if(filter_var($field, FILTER_VALIDATE_EMAIL)) {
			return TRUE;
		}
		else {
			return FALSE;
		}
	}
?>

<?php //Check that this ip is not spamming the site
	
	//Get ipaddress
	$IPAddr = $_SERVER['REMOTE_ADDR'];
	
	//Connect to host
	include('./includes/dbconnect.php');

	//Run SQL query
	$result = mysql_query("SELECT count(*) as actcount FROM tblFormActivity WHERE ipaddress='$IPAddr' and date(lastuse)=curdate()");
	
	//Check if the ip can post
	$allowPosting = 1;
	while ($row = mysql_fetch_array($result)) {
		//echo $row['actcount'];
		if ($row['actcount'] > 5) {
			$allowPosting = 0;
		};
	}
		
	//Close the server connection
	mysql_close($con);
?>

<p>
    <span class="subtitle">Send Me an Email</span>
	<br/>We aim to reply within 24 hours. Your personal details will be kept confidential.
</p>

<?php
	//Check values are set
	$formCompleted = TRUE;
	if (!isset($_REQUEST['email'])) {
		$formCompleted = FALSE;
	}
	elseif (!isset($_REQUEST['email2'])) {
		$formCompleted = FALSE;
	}
	elseif (!isset($_REQUEST['body'])) {
		$formCompleted = FALSE;
	};	
	
	//Check for validation issues
	$validated = TRUE;
	if (checkEmail($_REQUEST['email'])==FALSE) {
		$validated = FALSE;
	}
	elseif (checkEmail($_REQUEST['email2'])==FALSE) {
		$validated = FALSE;
	}
	elseif ($_REQUEST["body"]=="") {
		$validated = FALSE;
	};
	
	//Check for spammers
	if ($allowPosting==0) {
		echo "<p class='textred'>Stop trying to SPAM my site</p>";
	}
	elseif ($validated==TRUE && $formCompleted==TRUE) {
		//Store the fact that this ip used the form
		include('./includes/dbconnect.php');
		$result = mysql_query("INSERT INTO tblFormActivity(ipaddress,lastuse) VALUES('" . $IPAddr . "',now())");
		mysql_close($con);
		
		//Send the email
		$name = $_REQUEST["name"];
		$phoneno = $_REQUEST["phoneno"];
		$email = $_REQUEST["email"];
		$subject = $_REQUEST["subject"];
		$body = $_REQUEST["body"];
		$headers = "From: info@picklesplaycare.co.uk";
		mail("info@picklesplaycare.co.uk", $subject, "Name: " . $name . "\nPhone number: " . $phoneno . "\nEmail: " . $email . "\n" . "\n" . $body, $headers);
	}
	elseif ($formCompleted==TRUE && $validated==FALSE) {		
		echo "<p class='textred'>There were validation issues with the webform. Please review the boxes with red asterixis.</p>";
	};
?>

<?php	
	if ($formCompleted==TRUE && $validated==TRUE) {
		echo "Thanks for your message!";
	}
	elseif ($allowPosting==1) {
		//Main form
		echo 	"<form id='emailme' method='post' action='./webform.php'><p>
				&nbsp;Name: <input type='text' name='name' value='" . $_REQUEST['name'] . "' /><br/>
				&nbsp;Phone Number: <input type='text' name='phoneno' value='" . $_REQUEST['phoneno'] . "' /><br/>\n";
		
		//Email address
		if (isset($_REQUEST['email']) && checkEmail($_REQUEST['email'])==FALSE) {
			echo "<span class='textred'>*</span>";
		}
		else {
			echo "&nbsp;";
		};
		echo	"Email Address: <input type='text' name='email' value='" . $_REQUEST['email'] . "' /><br/>\n";
		
		//Email confirmation
		if (isset($_REQUEST['email2']) && checkEmail($_REQUEST['email2'])==FALSE) {
			echo "<span class='textred'>*</span>";
		}
		else {
			echo "&nbsp;"; 
		};
		echo 	"Confirm Email Address: <input type='text' name='email2' value='" . $_REQUEST['email2'] . "' /><br/>
				<br/>
				&nbsp;Subject: <input type='text' name='subject' value='" . $_REQUEST['subject'] . "' /><br/>\n";
		
		//Body
		if (isset($_REQUEST['body']) && $_REQUEST["body"]=="") {
			echo "<span class='textred'>*</span>";
		}
		else {
			echo "&nbsp;";
		};
		echo 	"Your message:<br/>
				<textarea name='body' rows='5' cols='40'>" . $_REQUEST['body'] . "</textarea><br/>
				<input type='submit' name='submit' value='Email Me'/> <input type='reset' name='reset' value='Reset Form'/>
				</p></form>";
	}
?>

<p><br/></p>

<?php include('./includes/footer.php')?>