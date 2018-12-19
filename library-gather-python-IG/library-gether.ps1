if(!(Test-Path -Path $env:SystemDrive\Python27\Scripts)){
Write-Output "Python path does not match: $env:SystemDrive\Python27\Scripts"
Write-Output "or not python does not installed"
break
}

$env:Path = $env:SystemDrive+"\Python27\Scripts"
$librarys = @(
	"dns.reversename",
	"googlesearch",
	"dns.resolver",
	"OptionParser",
	"http.client",
	"downloader",
	"htmlExport",
	"extractors",
	"dns.query",
	"discovery",
	"processor",
	"functools",
	"ipaddress",
	"itertools",
	"datetime",
	"optparse",
	"dns.zone",
	"warnings",
	"dns.name",
	"argparse",
	"urllib2",
	"netaddr",
	"biplist",
	"sqlite3",
	"random",
	"signal",
	"struct",
	"pprint",
	"ctypes",
	"dnslib",
	"urllib",
	"getopt",
	"string",
	"getopt",
	"socket",
	"wait",
	"time",
	"json",
	"uuid",
	"sys",
	"wx",
	"os",
	"re"

)

 foreach ($library in $librarys) {
 if(!(Test-Path -Path $env:SystemDrive\Python27\Lib\$library)){pip install $library}
    
 }
