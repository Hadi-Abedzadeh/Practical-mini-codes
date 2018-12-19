<?php
$link = "http://systemcode.ir/Hadi-Abedzadeh/";

function get_links($link){
    $ret = array();
    $dom = new domDocument;
    @$dom->loadHTML(mb_convert_encoding(file_get_contents($link), 'HTML-ENTITIES', 'UTF-8'));
    $dom->preserveWhiteSpace = false;
    $links = $dom->getElementsByTagName('a');
    foreach ($links as $tag) $ret[urldecode($tag->getAttribute('href'))] = $tag->childNodes->item(0)->nodeValue;
    return $ret;
}
$urls = get_links($link);

print_r($urls);