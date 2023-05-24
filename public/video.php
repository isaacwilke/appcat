<?php
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'http://104.180.246.245/LAPI/V1.0/Channels/C1/Media/Video/Streams/C1/LiveStreamURL');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"TransType\":\"0\"}");
curl_setopt($ch, CURLOPT_USERPWD, 'username' . ':' . 'password');

$headers = array();
$headers[] = 'Content-Type: application/json';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);
?>