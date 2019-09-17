<?php
error_reporting(0);
require_once 'config.php';
require_once 'api.php';
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no" />
<script type="text/javascript" src="js/server_selector.min.js"></script>
<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
<script type="text/javascript">
function I(i){return document.getElementById(i);}

//LIST OF TEST SERVERS. See documentation for details if needed
<?=$servers?>
$(document).ready(function(){
	$('#btn_change_alias').on('click', function() {
		var alias = $('#port_alias').val();
		$.ajax({
			url: "alias.php",
			type: "POST",
			data:{
				item: "alias",
				swid: "<?=isset($device)?$device->{'data'}->{'location'}->{'sw_id'}:""?>",
				port: "<?=isset($device)?$device->{'data'}->{'location'}->{'sw_port'}:""?>",
				alias: alias
			},
			success: function(result) {
				window.location.reload();
			}
		});
	});
});
</script>
<script type="text/javascript" src="js/main.js"></script>
<link rel="stylesheet" href="css/main.css" />
<title><?=$title?></title>
</head>
<body onload="initServers()">
<h1><?=$title?></h1>
<div id="loading" class="visible">
	<p id="message"><span class="loadCircle"></span>Selecting a server...</p>
</div>
<div id="testWrapper" class="hidden">
	<div id="startStopBtn" onclick="startStop()"></div>
	<div id="serverArea">
		Server: <select id="server" onchange="changeServer(SPEEDTEST_SERVERS[this.value])"></select>
	</div>
	<div id="test">
		<div class="testGroup">
			<div class="testArea">
				<div class="testName">Download</div>
				<canvas id="dlMeter" class="meter"></canvas>
				<div id="dlText" class="meterText"></div>
				<div class="unit">Mbps</div>
			</div>
			<div class="testArea">
				<div class="testName">Upload</div>
				<canvas id="ulMeter" class="meter"></canvas>
				<div id="ulText" class="meterText"></div>
				<div class="unit">Mbps</div>
			</div>
		</div>
		<div class="testGroup">
			<div class="testArea">
				<div class="testName">Ping</div>
				<canvas id="pingMeter" class="meter"></canvas>
				<div id="pingText" class="meterText"></div>
				<div class="unit">ms</div>
			</div>
			<div class="testArea">
				<div class="testName">Jitter</div>
				<canvas id="jitMeter" class="meter"></canvas>
				<div id="jitText" class="meterText"></div>
				<div class="unit">ms</div>
			</div>
		</div>
		<div id="ipArea">
			IP Address: <span><?=$ip?></span>
		</div>
	</div>
</div>
<div class="deviceInfo">
	<h3>Device Info</h3>
	<p>Host Name: <?=$device->{'data'}->{'hostname'}?></p>
	<p>MAC Address: <?=$device->{'data'}->{'mac'}?></p>
	<p>OS: <?=$device->{'data'}->{'os'}?></p>
	<p>Location: <?=$device->{'data'}->{'location'}->{'sw_ip'}?> @ <?=$device->{'data'}->{'location'}->{'sw_port'}?></p>
	<!-- <p>Port Alias: <input type="text" value="<?=$device->{'data'}->{'location'}->{'sw_port_alias'}?>" id="port_alias"></p>
	<? if(isset($device)): ?>
	<p><button type="button" id="btn_change_alias">Modify Alias</button></p>
	<? endif ?> -->
</div>
</body>
</html>
