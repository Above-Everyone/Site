<?php

$url = $_GET['URL'] ?? "";

if(!isset($url) || empty($url))
    die("DIE!");

$im = imagecreatefrompng($url);
$size = getimagesize($url);

$im2 = imagecrop($im, ['x' => 0, 'y' => 0, 'width' => $size[0], 'height' => $size[1]/2+$size[0]/3]);
if ($im2 !== FALSE) {
    header("Content-type: image/png");
       imagepng($im2);
    imagedestroy($im2);
}
imagedestroy($im);

?>
    