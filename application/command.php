<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: yunwuxin <448901948@qq.com>
// +----------------------------------------------------------------------
use think\Cache;
use think\Config;

function sendDataByCurl($url,$jsonStr,$https=false,$method='post'){
    // 初始化curl
    $ch = curl_init($url);
    // 字符串不直接输出，进行一个变量的存储
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    // https请求
    if ($https === true) {
        // 确保https请求能够请求成功
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
    }
    // post请求
    if ($method == 'post') {
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonStr);
        // 只需要用个 http 头就能传递 json 啦！
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json; charset=utf-8',
                'Content-Length: ' . strlen($jsonStr)
            )
        );
    }
    // 发送请求
    $str = curl_exec($ch);
    $aStatus = curl_getinfo($ch);
    // 关闭连接
    curl_close($ch);
    if(intval($aStatus["http_code"])==200){
        return json_decode($str);
    }else{
        //return json_decode($str);
        return false;
    }
}
