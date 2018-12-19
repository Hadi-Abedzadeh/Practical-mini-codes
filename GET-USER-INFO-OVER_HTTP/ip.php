<!-- YOU CAN EDIT URL PICTURE -->
<img src="http://img.persiangfx.com/main/gallery/creative-street-art/streetart13.jpg" />
<?php
date_default_timezone_set("Asia/Tehran");
$date_time = date("Y/m/d H:i:s") ; 
file_put_contents('log.txt', "$date_time IP: $_SERVER['REMOTE_ADDR'] __ $_SERVER['HTTP_USER_AGENT'] __ $_SERVER['WINDIR'] __ $_SERVER['REQUEST_URI'] __ $_SERVER['HTTP_REFERER'] \n",FILE_APPEND);
?> 