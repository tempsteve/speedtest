<?php
$title = 'Gentrice Speed Test';

$servers = '
var SPEEDTEST_SERVERS=[
    {
		name:"Speedtest Server 1 (192.168.135.38)",
		server:"http://192.168.135.38/",
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
		name:"Hinet",
		server:"http://168.95.1.1/",
		dlURL:"garbage.php",
		ulURL:"empty.php",
		pingURL:"empty.php",
		getIpURL:"getIP.php"
	},
    {
		name:"Google",
		server:"http://8.8.8.8/",
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
    }
];
';

?>
