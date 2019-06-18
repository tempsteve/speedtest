<?php
$title = 'Gentrice Speed Test';

$servers = '
var SPEEDTEST_SERVERS=[
    {
		name:"Speedtest Server 1 (192.168.135.38)",
		server:"http://192.168.135.38:60080/speedtest",
		dlURL:"garbage.php",
		ulURL:"empty.php",
		pingURL:"empty.php",
		getIpURL:"getIP.php",
        ip:"192.168.135.38"
	},
    {
		name:"Speedtest Server 2 (192.168.135.39)",
		server:"http://192.168.135.39:60080/speedtest/",
		dlURL:"garbage.php",
		ulURL:"empty.php",
		pingURL:"empty.php",
		getIpURL:"getIP.php",
        ip:"192.168.135.39"
	},
    {
		name:"Speedtest Demo Server 1 (HTTP)",
		server:"http://mpotdemo.fdossena.com/",
		dlURL:"garbage.php",
		ulURL:"empty.php",
		pingURL:"empty.php",
		getIpURL:"getIP.php",
        ip:"8.8.8.8"
    },
    {
		name:"Speedtest Demo Server 2 (HTTP)",
		server:"http://mpotdemo.fdossena.com/",
		dlURL:"garbage.php",
		ulURL:"empty.php",
		pingURL:"empty.php",
		getIpURL:"getIP.php",
        ip:"8.8.4.4"
    }
];
';

$api_host = '192.168.10.66';

?>
