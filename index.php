<link rel="stylesheet" href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.css">
<style>
#d{margin:auto;padding:0;width:100%;}
td{text-align:center;}
.address{width:13%;}
.port{width:13%;}
.method{width:13%;}
.password{width:13%}
.note{width:35%;}
.qr{width:13%;}
tr{height:25px;}
tr:nth-child(2n){background:#F9F9F9;}
body{font-size:20px;}
</style>
<div id = "a">
<table id="d" style="border-collapse:collapse">
        <tr style="border-bottom:1px solid black;font-weight:600;font-family:Arial,Helvetica,sans-serif;font-size:25px;">
                <td class="address"><small><i class="fa fa-location-arrow" aria-hidden="true"></i></small> 地址</td>
                <td class="port"><small><i class="fa fa-cloud" aria-hidden="true"></i></small> 端口</td>
                <td class="method"><small><i class="fa fa-handshake-o" aria-hidden="true"></i></small> 协议</td>
                <td class="password"><small><i class="fa fa-key" aria-hidden="true"></i></small> 密码</td>
                <td class="note"><small><i class="fa fa-book" aria-hidden="true"></i></small> 备注</td>
                <td class="qr"><small><i class="fa fa-qrcode" aria-hidden="true"></i></small> QR Code</td>
        </tr>

<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
<script>
    jQuery(document).ready(function () {
        $.when($.ajax("52ssr.php"),$.ajax("ishadowx.php"),$.ajax("freesstoday.php")).then(function(result1,result2,result3)
        {
            
            $("#d").append(result1,result2,result3);
           // $("#d").append(result2);
           // $("#d").append(result3);
        });
    });
</script>

<?php
include_once("ishadowx.php");
echo "
</div><ul>
    <li>有备注的为SSR账号，没有备注的为SS账号</li>
    <li>苹果商店中国区最近下架了相关app，需切换到国外区下载</li>
    <li>界面什么没有美化，以后再设计</li>
</ul>";
?>
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?67984e7b4af1387d6fa1982a4837ebf9";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>

