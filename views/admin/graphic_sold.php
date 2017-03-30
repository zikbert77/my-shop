<?php
header("Content-type: image/png");

$img = imageCreate(250, 125);

$green = imageColorAllocate($img, 89, 177, 93);
$white = imageColorAllocate($img, 255, 255, 255);

imageFilledRectangle($img, 0, 0, 250, 125, $green);

imagedashedLine($img, 10, 0, 10, 115, $white);
imageLine($img, 10, 115, 250, 115, $white);
    
imagefilledRectangle($img, 30, 115, 50, 50, $white);
imagefilledRectangle($img, 60, 115, 80, 20, $white);
imagefilledRectangle($img, 90, 115, 110, 70, $white);
imagefilledRectangle($img, 120, 115, 140, 60, $white);
imagefilledRectangle($img, 150, 115, 170, 30, $white);
imagefilledRectangle($img, 180, 115, 200, 90, $white);
imagefilledRectangle($img, 210, 115, 230, 15, $white);

imageString($img, 2, 35, 35, '50', $white);
imageString($img, 2, 65, 5, '60', $white);
imageString($img, 2, 95, 55, '30', $white);
imageString($img, 2, 125, 45, '40', $white);
imageString($img, 2, 155, 15, '90', $white);
imageString($img, 2, 185, 75, '20', $white);
imageString($img, 2, 215, 0, '70', $white);
imagePng($img);

imageDestroy($img);

?>