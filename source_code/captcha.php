<?php
session_start();
$rand=md5(microtime());
$rand_num=substr($rand,0,6);
$_SESSION['CODE']=$rand_num;
$layer=imagecreatetruecolor(60,30);

$captcha_bg=imagecolorallocate($layer,51,112,183);

imagefill($layer,0,0,$captcha_bg);

$captcha_text_color=imagecolorallocate($layer,0,0,0);

imagestring($layer,5,5,5,$rand_num,$captcha_text_color);
header('Content-Type:image/jpeg');
imagejpeg($layer);
?>