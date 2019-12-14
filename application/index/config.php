<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/16
 * Time: 10:44
 */
use \think\Request;

$basename = Request::instance()->root();
if (pathinfo($basename, PATHINFO_EXTENSION) == 'php') {
    $basename = dirname($basename);
}

return [
    'page_num_team' => 10,
    'CareCourse_num_page' => 10,
    'comment_page_num' => 10,
    'order_page_num' => 10,
    'appid' =>'wxeb0d31cfb151b00f',//公众号开发者ID
    'appsecret'=>'199fb4dbbdb3b21ae5d4e3f16002a4c7',//公众号开发者密码
//    'mchId'=>'1513148201',//商户号
    'mchId'=>'1519662171',//商户号
//    'key' => 'f06a49d238979fd55ca4bef77cd5cFFF',//商户支付密钥
    'key' => 'JLjl9648a6c26f5efaa98a0723ea35d0',//商户支付密钥
    'encodingAesKey' => 'NULL',//消息加解密密钥
    'serviceToken' => 'NULL',//服务器配置令牌
    'notify_url'=> "http://" . $_SERVER['HTTP_HOST'] . '/index/' . 'Wxcallback/index',
    'view_replace_str' => [
        '__ROOT__'   => $basename,
        '__STATIC__' => $basename.'/static',

    ],
];