<?php $title="Pickles Playcare Contact Details"; include('./includes/header.php')?>

<p>
    <span class="subtitle">Contact Me</span><br/>
	Home Telephone: <img src="./images/homephone.php" alt="" /><br/>
    Mobile Number: <img src="./images/mobilephone.php" alt="" /><br/>
    Email: <a href="./webform.php"><img src="./images/emailaddress.php" alt="" /></a>
</p>

<p>
	23 Drudgeon Way<br/>
	Bean<br/>
	Dartford<br/>
	Kent<br/>
	DA2 8BJ
</p>

<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=true&amp;key=ABQIAAAAo4zbQV8ixU3deZsbCDWGMBQcMSkqFc0rh8Hr1NavlHTZ8b1uzBQ3Jp_IWUuNm3wQRoCuVLXK8prtXQ" type="text/javascript"></script>

<div style="margin:auto; width:500px;">
<div id="map" style="width: 500px; height: 500px"><!--Google will fill this div --></div>
    <script type="text/javascript">
    //<![CDATA[
    var map = new GMap(document.getElementById("map"));
    map.addControl(new GSmallMapControl());	
	map.addControl(new GMapTypeControl());
	var point = new GLatLng(51.427283,0.285923);
	map.setCenter(point, 15);
	map.addOverlay(new GMarker(point));
    //]]>   
    </script>
</div>

<p><br/></p>

<?php include('./includes/footer.php')?>