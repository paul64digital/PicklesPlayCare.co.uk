<?php $title="Pickles Playcare Photo Gallery"; include('./includes/header.php')?>

<p class="subtitle">Photo Gallery</p>

<?php
	function displayThumbs( $folderName )
	{
		$pathToThumbs = "photos/$folderName/thumbs/";
		$pathToPics = "photos/$folderName/pics/";

		// open the directory
		$dir = opendir( $pathToThumbs );
		
		echo "<p class='subtitle nomargin'>$folderName</p>\n";

		// loop through it, looking for any/all JPG files:
		while (false !== ($fname = readdir( $dir ))) {
			// parse path for the extension
			$info = pathinfo($pathToThumbs . $fname);
			// continue only if this is a JPEG image
			if ( strtolower($info['extension']) == 'jpg' )
			{
			  echo "<a href='showphoto.php?picurl=$pathToPics$fname' onclick=\"target='_blank'\" onkeypress=\"target='_blank'\"><img src='$pathToThumbs$fname' alt='$fname'/></a>" . "\n";
			}
		}
		
		echo "\n<br/><br/>\n\n";
		
		// close the directory
		closedir( $dir );
	}
?>

<?php displayThumbs( 'set001' ); ?>

<?php include('./includes/footer.php')?>