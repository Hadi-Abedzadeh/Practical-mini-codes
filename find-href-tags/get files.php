<?php
$link              = "http://research.irantvto.ir/index.aspx?siteid=83&fkeyid=&siteid=83&pageid=8439";
$filter            = 'pdf';
$base_name         = true;
$random_name       = false;
$between_a_name    = false;
$underline_in_name = false;
function get_links($link)
{
    $ret = array();
    $dom = new domDocument;
    @$dom->loadHTML(file_get_contents($link));
    $dom->preserveWhiteSpace = false;
    $links                   = $dom->getElementsByTagName('a');
    foreach ($links as $tag) {
        $ret[$tag->getAttribute('href')] = $tag->childNodes->item(0)->nodeValue;
    }
    return $ret;
}
$urls = get_links($link);
if (sizeof($urls) > 0) {
    foreach ($urls as $key => $value) {
        $filter = str_replace('.', '', $filter);
        if ($underline_in_name == true) {
            $value = str_replace(' ', '_', $value);
        }
        if (strpos($key, '.' . $filter) !== false) {
            $download++;
            $file_name = md5(time() . uniqid()) . '.' . $filter;
            $ch        = curl_init();
            curl_setopt($ch, CURLOPT_URL, $key);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5000);
            $result = curl_exec($ch);
            curl_close($ch);
            $handle = fopen($file_name, 'w+');
            fwrite($handle, $result);
            fclose($handle);
            if ($random_name == false && $base_name == true) {
                rename($file_name, iconv('utf-8', 'windows-1256//IGNORE', str_replace('ی', 'ي', urldecode(basename($key)))));
            } elseif ($random_name == false && $base_name == false && $between_a_name == true) {
                rename($file_name, iconv('utf-8', 'windows-1256//IGNORE', str_replace('ی', 'ي', $value) . '.' . $filter));
            }
        }
    }
    if ($download > 0) {
        echo $download . " File's Downloaded";
    } else {
        echo "File Not Found";
    }
} else {
    echo "No links found at $link";
}