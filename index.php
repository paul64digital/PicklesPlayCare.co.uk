<?php $title="Pickles Playcare"; include('./includes/header.php')?>

<?php
//Extract the various parts of the path
$picurl = "photos/set001/meds/0001.jpg"; //Relative path
list($dir,$sub,$gall,$img) = explode("/", $picurl);
$dir = $dir . "/" . $sub . "/" . $gall . "/";

//Initialise variables
$i=0;
$imgs = "\""; //Open the csv

//If $dir is a directory open it
if (is_dir($dir)) {
   if ($dh = opendir($dir)) {
       //While there are files, assign it to $file
	   while (($file = readdir($dh)) !== false){
			//if the path given is to an image
			if(filetype($dir . $file) == 'file' && ((strstr($file,'.jpg') != FALSE) || (strstr($file,'.png') != FALSE) || (strstr($file,'.JPG') != FALSE))){
				//echo $file . "<br>"; //debug
				
				if ($file == "0004.jpg" && $dir=="photos/set001/meds/") {
					//ignore large vertical image
				}
				else {
					$path = $dir . $file;
					if ($i != 0) {
						$imgs = $imgs . "\",\"";
					}
					
					//Add to the csv
					$imgs = $imgs . $path;
					$i++;
				}
			}
       }
	   //close directory when finished.
       closedir($dh);
   }
}

//Close the csv
$imgs = $imgs . "\"";
$imgs = "\"images/me.jpg\"," . $imgs
?>

<script src="js/photogallery.js" type="text/javascript"></script>

<script type="text/javascript">
	//array of photos
	var photos = new Array(<?php echo $imgs; ?>);
	//starting point, taken from url
	var start = "images/me.jpg";


	var mid = arraysearch(photos,start);
	var prev = prev(mid);
	var next = next(mid);


	var imgprev = "pic1";
	var imgactv = "pic2";
	var imgnext = "pic3";
	
	setInterval("nextimg()",5000);
</script>

<h1>Claire Herrington</h1>
<p class="textcenter">
	<span class="important_green">Recently awarded "Outstanding" by Ofsted</span><br/><br/>
	<img src="" id="pic1" style="display:block; margin-left:auto; margin-right:auto" onclick="nextimg()" alt="Pickles Playcare Snapshots" height="193" />
	<img src="" id="pic2" style="display:block; margin-left:auto; margin-right:auto" onclick="nextimg()" alt="Pickles Playcare Snapshots" height="193" />
	<img src="" id="pic3" style="display:block; margin-left:auto; margin-right:auto" onclick="nextimg()" alt="Pickles Playcare Snapshots" height="193" />
</p>

<script type="text/javascript">init();</script>


<p class="textcenter">
	Welcome to Pickles Playcare!<br/>
	I am an Ofsted registered childminder based in Bean in Kent.  I provide high quality home based care for babies and children aged 0 to 8 years.<br/>
	Feel free to look at my website, if you would like to contact me with any questions and queries, or to arrange a visit please do so.  I look forward to hearing from you!
</p>

<p class="hitcountertitle">Hit Counter</p>
<p class="hitcounter"><?php include('./includes/hitcounter.php')?></p>

<?php include('./includes/footer.php')?>