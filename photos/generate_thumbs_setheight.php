<?php
function createThumbs( $pathToImages, $pathToThumbs, $thumbHeight )
{
  // open the directory
  $dir = opendir( $pathToImages );

  // loop through it, looking for any/all JPG files:
  while (false !== ($fname = readdir( $dir ))) {
    // parse path for the extension
    $info = pathinfo($pathToImages . $fname);
    // continue only if this is a JPEG image
    if ( $fname!="0001.jpg" && strtolower($info['extension']) == 'jpg' )
    {
      echo "Creating thumbnail for {$fname} - ";

      // load image and get image size
      $img = imagecreatefromjpeg( "{$pathToImages}{$fname}" );
      $width = imagesx( $img );
      $height = imagesy( $img );

      // calculate thumbnail size
      $new_height = $thumbHeight;
      $new_width = floor( $width * ( $thumbHeight / $height ) );

      // create a new temporary image
      $tmp_img = imagecreatetruecolor( $new_width, $new_height );

      // copy and resize old image into new image
      print "Resized: " . imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

      // save thumbnail into a file
      print " - Created: " . imagejpeg( $tmp_img, "{$pathToThumbs}{$fname}" );
	  
	  print "<br />";
    }
  }
  // close the directory
  closedir( $dir );
}

// call createThumb function and pass to it as parameters the path
// to the directory that contains images, the path to the directory
// in which thumbnails will be placed and the thumbnail's width.
// We are assuming that the path will be a relative path working
// both in the filesystem, and through the web for links
createThumbs("set001/pics/","set001/meds/",193);

?>