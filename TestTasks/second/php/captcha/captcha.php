<?php
session_start();

unset($_SESSION['status']);

$w = 200;
$h = 80;

$lettersCount = 8;
$dic = 'abcdefghjkmnpq123456789';

if (isset($_SESSION['captcha'])) {
    $text = $_SESSION['captcha'];
} else {
    for ($i = 0; $i < $lettersCount; $i++) {
        $text .= substr($dic, rand(0, strlen($dic) - 1), 1);
    }
}
$_SESSION['captcha'] = $text;

$letters = str_split($text, 1);

$img = imagecreatetruecolor($w, $h);
header('Content-Type: image/png');

$red = imageColorAllocate($img, 255, 0, 0);
$brown = imagecolorallocate($img, 128, 64, 48);
$white = imagecolorallocate($img, 255, 255, 255);

ImageFill($img, 0, 0, $white);

foreach ($letters as $index => $letter) {
    ImageTTFText($img, rand(15, 30), rand(-30, 30), (int)(20 + $index * ($w - 40) / count($letters)) + rand(-10, 10), rand(30, 70), $red, 'OpenSans-Bold.ttf', $letter);
}

ImagePng($img);
