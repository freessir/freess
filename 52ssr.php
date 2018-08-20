<?php
$url = "http://52ssr.net";
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HEADER, 1);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,false);

$contents = curl_exec($curl);
curl_close($curl);

$tag = "a";
$attr = "class";
$value = "btn btn-info btn-block";
$regex = "/<$tag.*?$attr=\".*?$value\" href=(.*?)>.*?<\/$tag>/is";
preg_match_all($regex,$contents,$matches,PREG_PATTERN_ORDER);
echo "<tr>";
for ($i=0;$i<=10;$i++){
        $array2 = explode('ssr://',$matches[0][$i]);
        $array1 = explode('"',$array2[1]);
        $raw = base64_decode($array1[0]);
        $array = explode(':',$raw);
        $ip = $array[0];
        $port = $array[1];
        $method2 = $array[2];
        $method = $array[3];
        $confuse = $array[4];
        $secret = "52ssr.cn";
        echo "<td>".$ip."</td>"."<td>".$port."</td>"."<td>".$method."</td>"."<td>".$secret."</td>";
        echo "<td>协议：".$method2."   混淆：".$confuse."</td><td><a href='http://qr.liantu.com/api.php?text=ssr://".$array1[0]."'><i class='fa fa-qrcode' aria-hidden='true'></i> </a></td></tr>";
}
