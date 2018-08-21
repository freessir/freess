<?php
$url = "https://us.ishadowx.net";
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL,$url );
curl_setopt($curl, CURLOPT_HEADER, 1);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,false);

$contents = curl_exec($curl);
curl_close($curl);

$tag = "span";
$attr = "id";
$a = array("ip","port","pw");
$b = array("us","jp","sg");
$c = array("a","b","c");
$value = "";
for ($i=0;$i<=2;$i++)
{

        for ($j=0;$j<=2;$j++)
        {
                echo "<tr>";
                for ($k=0;$k<=2;$k++)
                {
                        $value = $a[$k].$b[$i].$c[$j];
                        $regex = "/<$tag.*?$attr=\".*?$value.*?\".*?>(.*?)<\/$tag>/is";
                        preg_match_all($regex,$contents,$matches,PREG_PATTERN_ORDER);
                        if($matches[1][0] === ""){
                                $matches[1][0] = "N/A";
                        }
                        echo "<td><span>".$matches[1][0]."</span></td>";
                        if ($k == 1)
                        {
                                echo "<td>aes-256-cfb</td>";
                        }

                }
                echo "<td></td><td><i class='fa fa-qrcode' aria-hidden='true'></i></td></tr>";
        }

}
?>
