<?php 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://production.demodemo.ga/index.php/api/User/initiate_Push");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, true);
$data = curl_exec($ch);
?>