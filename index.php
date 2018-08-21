<?php
$url = "http://weinanlovefengjuan.club/freess";
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL,$url );
curl_setopt($curl, CURLOPT_HEADER, 1);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,false);

$contents = curl_exec($curl);
curl_close($curl);
echo $contents;
?>
