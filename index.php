<?php
$connomains = array(
"http://www.cnn.com/",
"http://www.canada.com/",
"http://www.yahoo.com/"
);
$mh = curl_multi_init();
foreach ($connomains as $i => $url) {
     $conn[$i]=curl_init($url);
      curl_setopt($conn[$i],CURLOPT_RETURNTRANSFER,1);
      curl_multi_add_handle ($mh,$conn[$i]);
}
do {
                        $mrc = curl_multi_exec($mh,$active);
                } while ($mrc == CURLM_CALL_MULTI_PERFORM);
                while ($active and $mrc == CURLM_OK) {
                        if (curl_multi_select($mh) != -1) {
                                do {
                                        $mrc = curl_multi_exec($mh, $active);
                                } while ($mrc == CURLM_CALL_MULTI_PERFORM);
                        }
                }

print_r($res);
?>
