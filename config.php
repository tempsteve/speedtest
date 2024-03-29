<?php
$title = 'Siraya SPEEDTEST';

// 提供測速的server清單，被測速的server必須要有speedtest程式，並且有下面列出的四個PHP檔案才可以用
$servers = '
var SPEEDTEST_SERVERS=[
    {
        name:"Speedtest Server 1 (203.72.154.50)",
        server:"https://nms.ntpc.edu.tw/speedtest/",
        dlURL:"garbage.php",
        ulURL:"empty.php",
        pingURL:"empty.php",
        getIpURL:"getIP.php"
    },
    {
        name:"Speedtest Server 2 (163.20.66.236)",
        server:"http://163.20.66.236:60080/speedtest/",
        dlURL:"garbage.php",
        ulURL:"empty.php",
        pingURL:"empty.php",
        getIpURL:"getIP.php"
    }
];
';

$api_host = 'http://127.0.0.1:60080'; //  設定取得alias資訊的API Host

// 設定本機IP，用來向api_host取得alias資訊
if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
    $ip = $_SERVER["HTTP_CLIENT_IP"];
} elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
    $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
} else {
    $ip = $_SERVER["REMOTE_ADDR"];
}
