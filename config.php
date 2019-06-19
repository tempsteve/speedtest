<?php
$title = 'Gentrice Speed Test';

$servers = '
var SPEEDTEST_SERVERS=[
    {
		name:"Speedtest Server 1 (192.168.135.38)",
		server:"http://192.168.135.38:60080/speedtest/",
		dlURL:"garbage.php",
		ulURL:"empty.php",
		pingURL:"empty.php",
		getIpURL:"getIP.php"
	},
    {
		name:"Speedtest Server 2 (192.168.135.39)",
		server:"http://192.168.135.39:60080/speedtest/",
		dlURL:"garbage.php",
		ulURL:"empty.php",
		pingURL:"empty.php",
		getIpURL:"getIP.php"
	},
    {
		name:"Speedtest Demo Server 1 (HTTP)",
		server:"http://mpotdemo.fdossena.com/",
		dlURL:"garbage.php",
		ulURL:"empty.php",
		pingURL:"empty.php",
		getIpURL:"getIP.php"
    },
    {
		name:"Speedtest Demo Server 2 (HTTP)",
		server:"http://mpotdemo.fdossena.com/",
		dlURL:"garbage.php",
		ulURL:"empty.php",
		pingURL:"empty.php",
		getIpURL:"getIP.php"
    }
];
';

$api_host = 'http://192.168.10.66:60080'; //  setting for api host
$ip = '192.168.141.30'; // setting the ip to get info

?>
