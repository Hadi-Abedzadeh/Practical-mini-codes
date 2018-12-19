<?php
$array = array(
	"getopt",
	"os",
	"string",
	"sqlite3",
	"datetime",
	"netaddr",
	"argparse",
	"functools",
	"http.client",
	"ipaddress",
	"pprint",
	"random",
	"socket",
	"time",
	"dns.name",
	"dns.query",
	"dns.resolver",
	"dns.reversename",
	"dns.zone",
	"discovery",
	"googlesearch",
	"extractors",
	"downloader",
	"processor",
	"getopt",
	"warnings",
	"htmlExport",
	"OptionParser",
	"urllib2",
	"urllib",
	"dnslib",
	"optparse",
	"signal",
	"sys",
	"uuid",
	"ctypes",
	"json",
	"itertools",
	"struct",
	"re",
	"wait",
	"biplist",
	"wx",
);

function strlen_compare($a,$b){
    if(function_exists('mb_strlen')){
         return mb_strlen($b) - mb_strlen($a);
    }
    else{
         return strlen($b) - strlen($a);
    }
}

function strlen_array_sort($array,$order='dsc'){
    usort($array,'strlen_compare');
    if($order=='asc'){
        $array=array_reverse($array);
    }
    return $array;
}

	
	
	foreach (strlen_array_sort($array) as $sort){ 
	echo "'".$sort."',\n"; 

	
	};
