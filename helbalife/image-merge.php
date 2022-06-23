<?php
/*
bool imagecopymerge ( $dst_image, $src_image, $dst_x, $dst_y, 
$src_x, $src_y, $src_w, $src_h, $pct )

Parameters: This function accepts nine parameters as mentioned above and described below:

    $dst_image: This parameter is used to set destination image link resource.
    $src_image: This parameter is used to set source image link resource.
    $dst_x: This parameter is used to set x-coordinate of destination point.
    $dst_y: This parameter is used to set y-coordinate of destination point.
    $src_x: This parameter is used to set x-coordinate of source point.
    $src_y: This parameter is used to set x-coordinate of source point.
    $src_w: This parameter is used to set source width.
    $src_h: This parameter is used to set source height.
    $pct: The two images will be merged with the help of $pct variables. The range of pct is 0 to 100. If $pct = 0, then no action is taken and when $pct = 100 then this function behaves similar to imagecopy() function for pallete images, except ignoring the alpha components. It implements alpha transparency for true color images.

*/
$recipiimagePath = 'image-not-found.png';
$logoImagePath = 'logo.jpeg';
$dest = imagecreatefrompng($recipiimagePath);
$src = imagecreatefromjpeg($logoImagePath);
$src2 = imagecreatefromjpeg('logo2.jpg');
$logoSize = getimagesize($logoImagePath);
$logoHeight = $logoSize[1];
$logoWidth =  $logoSize[0];
$logo2Size = getimagesize("logo2.jpg");
$logo2width = $logo2Size[0];
$logo2heigth = $logo2Size[1];
$recipiSize = getimagesize($recipiimagePath);
$recipiWidth = $recipiSize[0];
$recipiHeight = $recipiSize[1];

$destinationLogoPositionX = 10;
$destinationLogoPositionY = 20;

$destinationLogo2PositionX = ($recipiWidth - $logo2width)-10;
$destinationLogo2PositionY = ($recipiHeight -  $logo2heigth)-10;

imagealphablending($dest, false);
imagesavealpha($dest, true);

imagecopymerge($dest, $src, $destinationLogoPositionX,$destinationLogoPositionY-10, 0, 0,$logoWidth,$logoHeight,50); //have to play with these numbers for it to work for you, etc.
//imagecopymerge($dest, $src2, $destinationLogo2PositionX,$destinationLogo2PositionY, 0, 0,$logo2width,$logo2heigth, 100); //have to play with these numbers for it to work for you, etc.

// Save the image as 'simpletext.jpg'
$imageName = "brand-recipies/herbalile_healthy_recipies_".time().".jpg";
imagejpeg($dest,$imageName);

header('Content-Type: image/png');
imagepng($dest);

imagedestroy($dest);
imagedestroy($src);
imagedestroy($src2);
?>
