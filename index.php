<?php

$ch = array();
$res = array();
$conn = array();

$urls = array(
    'baidu' => "http://www.baidu.com/",
    'cheyun' => "http://auto.jrj.com.cn/",
    'w3c' => "http://www.w3cschool.cc/",
);

// 创建批处理cURL句柄
$mh = curl_multi_init();

foreach ($urls as $i => $url) {
    // 创建一对cURL资源
    $conn[$i] = curl_init(); //初始化各个子连接  
    // 设置URL和相应的选项
    curl_setopt($conn[$i], CURLOPT_URL, $url);
    curl_setopt($conn[$i], CURLOPT_HEADER, 0);
    curl_setopt($conn[$i], CURLOPT_RETURNTRANSFER, 1);//不直接输出到浏览器 
    curl_setopt($conn[$i], CURLOPT_TIMEOUT, 10);
    //302跳转
    curl_setopt($conn[$i], CURLOPT_FOLLOWLOCATION, 1);

    // 增加句柄
    curl_multi_add_handle($mh, $conn[$i]);//加入多处理句柄  
}


$active = null;//连接数  

//防卡死写法：执行批处理句柄
do {
    //这里$active会被改写成当前未处理数  
    //全部处理成功$active会变成0  
    $mrc = curl_multi_exec($mh, $active);
     //这个循环的目的是尽可能的读写，直到无法继续读写为止(返回CURLM_OK)  
     //返回(CURLM_CALL_MULTI_PERFORM)就表示还能继续向网络读写  
} while ($mrc == CURLM_CALL_MULTI_PERFORM);

//如果一切正常，那么我们要做一个轮询，每隔一定时间(默认是1秒)重新请求一次  
//这就是curl_multi_select的作用,它在等待过程中，如果有就返回目前可以读写的句柄数量,以便  
//继续读写操作,0则没有可以读写的句柄(完成了)  
while ($active && $mrc == CURLM_OK) {  //直到出错或者全部读写完毕  
    if (curl_multi_select($mh) != -1) {
        do {
            $mrc = curl_multi_exec($mh, $active);

        } while ($mrc == CURLM_CALL_MULTI_PERFORM);
    }
}

foreach ($urls as $i => $url) {
    //获取当前解析的cURL的相关传输信息
    $info = curl_multi_info_read($mh);

    //获取请求头信息
    $heards = curl_getinfo($conn[$i]);

    var_dump($heards);

    //获取输出的文本流
    $res[$i] = curl_multi_getcontent($conn[$i]);

    // 移除curl批处理句柄资源中的某个句柄资源
    curl_multi_remove_handle($mh, $conn[$i]);

    //关闭cURL会话
    curl_close($conn[$i]);
}

//关闭全部句柄
curl_multi_close($mh);
var_dump($res);
