<?php
//Get parameters
$picurl = $_GET['picurl']; //Relative path
//$picurl = str_replace('._.', '&', $picurl);
//$width = $_GET['width'];
//$height = $_GET['height'];

//Extract the various parts of the path
list($dir,$sub,$gall,$img) = explode("/", $picurl);
$dir = $dir . "/" . $sub . "/" . $gall . "/";
//echo $dir . "<br>"; //debug

//Initialise variables
$i=0;
$imgs = "\""; //Open the csv

//If $dir is a directory open it
if (is_dir($dir)) {
   if ($dh = opendir($dir)) {
       //While there are files, assign it to $file
	   //todo: sort the files
	   while (($file = readdir($dh)) !== false){
			//if the path given is to an image
			if(filetype($dir . $file) == 'file' && ((strstr($file,'.jpg') != FALSE) || (strstr($file,'.png') != FALSE) || (strstr($file,'.JPG') != FALSE))){
				//echo $file . "<br>"; //debug
		   
		   		$path = $dir . $file;
				if ($i != 0) {
					$imgs = $imgs . "\",\"";
				}
				
				//Add to the csv
				$imgs = $imgs . $path;
				$i++;
			}
       }
	   //close directory when finished.
       closedir($dh);
   }
}

//Close the csv
$imgs = $imgs . "\"";
?>

<html>
<head>
	<script src="js/photogallery.js" type="text/javascript"></script>
	<script type="text/javascript">
	//array of photos
	var photos = new Array(<?php echo $imgs; ?>);
	//starting point, taken from url
	var start = "<?php echo $picurl; ?>";


	var mid = arraysearch(photos,start);
	var prev = prev(mid);
	var next = next(mid);


	var imgprev = "pic1";
	var imgactv = "pic2";
	var imgnext = "pic3";

	</script>
	<link rel="stylesheet" media="screen" title="Default"  type="text/css" href="css/default.css" />
</head>

<body>
	<p align="center">
	<span class="pseudolink" onclick="previmg()">Previous</span> | 
	<span class="pseudolink" onclick="nextimg()">Next</span>
	
	
	<img src="" id="pic1" onclick="nextimg()" alt="" />
	<img src="" id="pic2" onclick="nextimg()" alt="" />
	<img src="" id="pic3" onclick="nextimg()" alt="" />
	
	</p>

	<script type="text/javascript">init();</script>
</body>
</html>
