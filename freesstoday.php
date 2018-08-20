<?php
include_once('./QrReader/lib/QrReader.php');

$url = "https://io.freess.today/";
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL,$url );
curl_setopt($curl, CURLOPT_HEADER, 1);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,false);

$contents = curl_exec($curl);
curl_close($curl);

$tag = "a";
$attr = "class";
$value = "overlay lightbox";
$regex = "/<$tag.*?$attr=\".*?$value\" href=\"(.*?)\">.*?<\/$tag>/is";
preg_match_all($regex,$contents,$matches,PREG_PATTERN_ORDER);
for ($i=0;$i<=5;$i++)
{
    $img = "https://io.freess.today/".$matches[1][$i];
    $qrcode = new QrReader($img);
    $text = $qrcode->text(); //返回识别后的文本
    if($i <=2)
    {
        $raw = explode("ss://",$text);
        $raw1 = base64_decode($raw[1]);
        $arr = explode(":",$raw1);
        $method = $arr[0];
        $pub = explode("@",$arr[1]);
        $secret = $pub[0];
        $ip = $pub[1];
        $port = $arr[2];
        echo "<tr><td>".$ip."</td>"."<td>".$port."</td>"."<td>".$method."</td>"."<td>".$secret."</td>";
        echo "<td></td><td><a href='http://qr.liantu.com/api.php?text=".$text."'><i class='fa fa-qrcode' aria-hidden='true'></i> </a></td></tr>";
    }else{
        $raw = explode("ssr://",$text);
        $raw1 = base64_decode($raw[1]);
        $arr = explode(":",$raw1);
        
        $ip = $arr[0];
        $port = $arr[1];
        $method2 = $arr[2];
        $method1 = $arr[3];
        $confuse = $arr[4];
        $s = explode("/",$arr[5]);
        $secret = base64_decode($s[0]);
        
        echo "<tr><td>".$ip."</td>"."<td>".$port."</td>"."<td>".$method1."</td>"."<td>".$secret."</td>";
        echo "<td>协议：".$method2."   混淆：".$confuse."</td><td><a href='http://qr.liantu.com/api.php?text=".$text."'><i class='fa fa-qrcode' aria-hidden='true'></i> </a></td></tr>";
    }
}
?>
