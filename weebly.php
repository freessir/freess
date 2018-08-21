<?php
$url = "https://gdmi.weebly.com/3118523398online.html";
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL,$url );
curl_setopt($curl, CURLOPT_HEADER, 1);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,false);

$contents = curl_exec($curl);
curl_close($curl);

$tag = "div";
$attr = "class";
$value = "paragraph";
$regex = "/<$tag.*?$attr=\"$value\".*?><a.*?href=\"(.*?)\" target=\"_blank\">/is";
preg_match_all($regex,$contents,$matches,PREG_PATTERN_ORDER);
for ($i=0;$i<=3;$i++)
{
    $raw = explode("ssr://",$matches[1][$i]);
    $raw1 = base64_decode($raw[1]);
    $arr = explode(":",$raw1);
    $ip = $arr[0];
    $port = $arr[1];
    $method2 = $arr[2];
    $method1 = $arr[3];
    $confuse = $arr[4];
    $pub = explode("/",$arr[5]);
    $pub = base64_decode($pub[0]);
    $secret = $pub;
    echo "<tr><td>".$ip."</td>"."<td>".$port."</td>"."<td>".$method1."</td>"."<td>".$secret."</td>";
    echo "<td>协议：".$method2."   混淆：".$confuse."</td><td><a href='http://qr.liantu.com/api.php?text=ssr://".$raw."'><i class='fa fa-qrcode' aria-hidden='true'></i> </a></td></tr>";
}
?>
