<?php
require_once 'config.php';
$data_string = [
    'item' => 'alias',
    'swid' => $_POST['swid'],
    'port' => $_POST['port'],
    'alias' => $_POST['alias']
];
$ch = curl_init($api_host.'/api/device/sw_port');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data_string));
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
$result = curl_exec($ch);
curl_close($ch);

return $result;
?>
