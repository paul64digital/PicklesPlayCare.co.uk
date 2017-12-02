<?php 
	//Start the session
	session_start();
	
	//Check is a session exists
	if(!isset($_SESSION['insession'])) {
		//Log the user's visit
		include('./includes/createhit.php');
		
		//Record the fact that we are in session
		$_SESSION['insession']='True';
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1" />
<meta name="title" content="Pickles Playcare" />
<meta name="description" content="Pickles Playcare" />
<meta name="keywords" content="Pickles Playcare, day care, child care, minding, child mind, child minder, child minding, children, childminder, childminding, childcare, daycare, Dartford, Bean, Kent, M25, Thames" />
<meta name="author" content="Paul Davis - pdavis86@hotmail.co.uk" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />
<link rel="stylesheet" media="screen" title="Default"  type="text/css" href="css/default.css" />
<title><?php echo $title ?></title>
</head>

<body>
<div class="textcenter">
	<a href="."><img src="./images/logo.gif" alt="Pickles Playcare Logo" /></a>
	<img src="./images/OutstandingLogo09-10_POS_50.gif" alt="Ofstead Outstanding" style="width:200px; margin: 30px; position:absolute"/>
	<br/>
</div>

<!--Menu-->
<div class="menu">
<ul>
	<li><a href="./">Home</a></li>
	<li><a href="">About PPC</a>
		<ul>
			<li><a href="history.php">History of Pickles Playcare</a></li>
			<li><a href="expect.php">What to expect from Pickles Playcare</a></li>
			<li><a href="aday.php">A day at Pickles Playcare</a></li>
			<li><a href="menu.php">An example menu</a></li>
			<li><a href="policies.php">Policies</a></li>
			<li><a href="forms.php">Consent Forms</a></li>
		</ul>
	</li>
	<li><a href="gallery.php">Photo Gallery</a></li>
	<li><a href="vacancies.php">Vacancies &amp; Fees</a></li>
	<li><a href="references.php">References</a></li>
	<li><a href="visitors.php">Visitors book</a></li>
	<li><a href="links.php">Links</a></li>
	<li><a href="contact.php">Contact Me</a></li>
</ul>
</div>

<!--Main Body-->
<div class="mainbody">
