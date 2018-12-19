<?php
/*
*   ______        _   _____  _               _                   _      _     _   _             
*  |  ____|      | | |  __ \(_)             | |                 | |    (_)   | | (_)            
*  | |__ __ _ ___| |_| |  | |_ _ __ ___  ___| |_ ___  _ __ _   _| |     _ ___| |_ _ _ __   __ _ 
*  |  __/ _` / __| __| |  | | | '__/ _ \/ __| __/ _ \| '__| | | | |    | / __| __| | '_ \ / _` |
*  | | | (_| \__ \ |_| |__| | | | |  __/ (__| || (_) | |  | |_| | |____| \__ \ |_| | | | | (_| |
*  |_|  \__,_|___/\__|_____/|_|_|  \___|\___|\__\___/|_|   \__, |______|_|___/\__|_|_| |_|\__, |
*                                                           __/ |Written by Hadi Abedzadeh __/ |
*                                                          |___/                          |___/ 
*  
*/
// print_r($_SERVER);
if($_SERVER['QUERY_STRING'] == null){
	Header("Location: ?dir=*");
}
$uri = $_SERVER['SCRIPT_NAME'];
function strposa($haystack, $needles = array(), $offset = 0){
    $chr = array();
    foreach ($needles as $needle) {
        $res = strpos($haystack, $needle, $offset);
        if ($res !== false)
            $chr[$needle] = $res;
    }
    if (empty($chr))
        return false;
    return min($chr);
}
echo '
<form action="" method="get">
  <input type="text" name="dir">
  <input type="submit" value="go">
<form>
';
$pre = "<span style='border-bottom:1px solid blue;'>";
$ext = array(
    "html",
    "sql",
    "txt",
    "php",
    "zip",
    "rar",
    "ttf",
	"iml"
);
if (@$_REQUEST['dir']) {
    @chdir(@$_REQUEST['dir']);
    echo "<br>".@getcwd() . "<br>";
    echo "<br><pre>";
    $globs = glob('{,.}*', GLOB_BRACE);
    echo '<table style="margin:1px;font-size:12pt;"><tr><td>';
    for ($i = 0; $i < count($globs); $i++) {
        echo $pre . $i . "</span><br>";
    }
    echo '</td><td>';
    foreach ($globs as $glob) {
        if (strposa($glob, $ext, 1)) {
			echo "<span style='color:#999'>" . $pre . $glob . "</span><br>";
		}else {
			echo "<a href='$uri?dir=$glob'>" . $pre . $glob . "</a><br>";}
    }
}
echo '</td></tr></table>';
?>
