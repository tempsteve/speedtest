<?php
$data_string = ["ip" => $ip];
$ch = curl_init($api_host.'/api/device/ip_info');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data_string));
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
$result = curl_exec($ch);
curl_close($ch);

$device = json_decode($result);
if($device->{'status'} != "200" || empty($device->{'data'}))
    unset($device);

?>
