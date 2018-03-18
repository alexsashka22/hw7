<?php
 // header("Content-Type: image/png");
 session_start();

 $lines = $_SESSION["lines"];

 $image = imagecreatetruecolor(400, 300);

 $backColor = imagecolorallocate($image, 245, 245, 220);
 $textColor = imagecolorallocate($image, 0, 15, 90);

 $boxFile = __DIR__ . '/1.png';
  if (!file_exists($boxFile)) {
  echo 'Файл с картинкой не найден!';
  exit;
 }
 $imBox = imagecreatefrompng($boxFile);

 imagefill($image, 0, 0, $backColor);
 imagecopy($image, $imBox, 39.5, 31, 0, 0, 321, 238);

 $fontFile = __DIR__ . '/font.ttf';
 if (!file_exists($fontFile)) {
  echo 'Файл со шрифтом не найден!';
  exit;
 }

 imagettftext($image, 40, 0, 70, 138, $textColor, $fontFile, $lines[0]);
 imagettftext($image, 20, 0, 45, 228, $textColor, $fontFile, $lines[1]);
 imagettftext($image, 20, 0, 45, 268, $textColor, $fontFile, $lines[2]);
 header('Content-Type: image/png');

 imagepng($image);
 imagedestroy($image);

 ?>
