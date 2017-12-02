function arraysearch(array,item){
	arraylength = array.length
	i = 0;
	while (i< arraylength && array[i] != item){
		i++;
	}
	if (i==arraylength && array[i-1] != item) i= -1;
	return i;
}
//sets the initial srcs of the image elements
function init(){
	document.getElementById(imgactv).src = photos[mid];
	document.getElementById(imgprev).src = photos[prev];
	document.getElementById(imgnext).src = photos[next];
	SetDisplays();
}
//Sets the elements to be displays
function SetDisplays(){
	document.getElementById(imgprev).style.display = 'none';
	document.getElementById(imgnext).style.display = 'none';
	document.getElementById(imgactv).style.display = 'block';
}
function nextimg(){
	//mid = next(mid);
	mid++;
	if (mid == photos.length) mid = 0;
	midn = mid + 1;
	if (midn == photos.length) midn = 0;
	temp = imgprev;
	imgprev = imgactv;
	imgactv = imgnext;
	imgnext = temp;
	SetDisplays();
	document.getElementById(imgnext).src = photos[midn];
}
function previmg(){
	mid--;
	if (mid<0) mid = (photos.length - 1);
	midp = mid - 1;
	if (midp<0) midp = (photos.length - 1);
	temp = imgnext;
	imgnext = imgactv;
	imgactv = imgprev;
	imgprev = temp;
	SetDisplays();
	document.getElementById(imgprev).src = photos[midp];
}
//return next item in the array & loops to zero
function next(val){
	val++;
	if (val == photos.length) val = 0;
	return val;
}
//returns the previous element of the array
function prev(val){
	val--;
	if (val<0) val = (photos.length - 1);
	return val;
}