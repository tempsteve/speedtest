<?php
require_once 'config.php';
?>
<script type="text/javascript">
function showDevice(server) {
    // var data = '{"ip":"'+server+'"}';
    $.ajax({
        url: '/api/device/ip_info',
        method: 'POST',
        data: JSON.stringify({ip: server}),
        dataType: 'json',
        contentType : 'application/json',
        success: function( result ) {
            console.log(result);
        }
    });
}

</script>
