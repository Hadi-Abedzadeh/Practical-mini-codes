<?php
function formatBytes($size, $precision = 2){
    $base     = log($size, 1024);
    $suffixes = array('', 'K', 'M', 'G', 'T');
    return round(pow(1024, $base - floor($base)), $precision) . ' ' . $suffixes[floor($base)];
}

$url = "https://github.com/Hadi-Abedzadeh/E-Shop";

if (substr($img, 0, 5) == "https") {
    eval("
		stream_context_set_default( [
		'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false,
		],
]);
");
}

$img = get_headers($url, 1);
print(formatBytes($img['Content-Length']));
?>
