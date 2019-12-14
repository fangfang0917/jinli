<?php



phpinfo();
die;
//接收回调数据;
$xmlData = file_get_contents("php://input");
//处理回调数据,拿到回调条件,根据条件处理数据
file_put_contents(__DIR__.'/test.json', "\n" .$xmlData. "\n", FILE_APPEND);
die;









// 加载框架引导文件
require __DIR__ . '/WeiXinFun.class.php';










$config = [
    'appId' => 'wxeb0d31cfb151b00f',//公众号开发者ID
    'secret' => '199fb4dbbdb3b21ae5d4e3f16002a4c7',//公众号开发者密码
    'mchId' => '1513148201',//商户号
    'key' => 'f06a49d238979fd55ca4bef77cd5cFFF',//商户支付密钥
    'encodingAesKey' => 'NULL',//消息加解密密钥
    'serviceToken' => 'NULL',//服务器配置令牌
];
$WX = new WeiXinFun($config);
$mid = 532660010001;
$ticket = time();
$service = 'pay.wxpay.native';
$timestamp = date("YmdHis");
$body = [
    'orderNo' => time(),
    'device' => time(),
    'order_info' => 'order_info',
    'total_amount' => 1,
    'mch_create_ip' => $_SERVER['REMOTE_ADDR'],
    'notify_url' => 'http://jinli.sxzywl.net/wx/test.php',
    'time_start' => date('YmdHis'),
    'time_expire' => date('YmdHis', (time() + 24 * 60 * 60)),
];
ksort($body);
$jsonBody = json_encode($body, true);
//        $a = $this->asc_sort($body);
$ress = str_replace("\\/", "/", $jsonBody);


$param = [
    'ticket' => $ticket,
    'service' => $service,
    'version' => '2.0',
    'sign_type' => 'MD5',
    'mch_code' => $mid,
    'timestamp' => $timestamp,
    'body'=>$ress
];
ksort($param);
$str = '';
foreach ($param as $k => $val) {
    $str .= $k . '=' . $val . '&';
}
$strs = rtrim($str, '&');

$signStr = $strs . '&key=uuFwDedqvJdOq7wxnN3+9Q==';
$signStr = strtoupper(md5($signStr));
$param['sign'] = $signStr;
$param['body'] = $body;

$headers[] = "Content-Type:application/json";
$resss =  str_replace("\\", "", json_encode($param));
$ret = $WX->PostCurl('http://openapi.xiangqianpos.com/gateway', $resss, $headers);
$WX->dump($resss);
$WX->dump($ret);
die;

$WX->dump('jsonToken=>' . $WX->getJsToken());
$WX->dump('AccessToken=>' . $WX->getAccessToken());


if ($WX->isWeiXin()) {
    $nowUrl = $WX->curPageURL();
    $code = $_GET['code'] ? $_GET['code'] : 0;
    if ($code === 0) {
        $WX->wxGetCode($nowUrl);
    } else {
        $auth = $WX->wxCodeExchangeForAccessToken($code);
        $authInfo = $WX->wxGetUserInfo($auth['access_token'], $auth['openid']);
        $WX->dump($authInfo);
    }
}


$openId = 'oxoLU1MoEJD-S1xt8fFay1n1O7jI';

$WX->setParamArr([
    'total_fee' => 1,
    'notify_url' => 'http://jinli.sxzywl.net/' . 'wx/notify_url.php',
    'trade_type' => 'JSAPI',
    'openid' => $openId,
    'body' => 'test',
    'out_trade_no' => time(),
]);

$payId = $WX->getPayPrepayId();


$WX->dump($payId);
$code = <<<PPP
    /**
     * 设置Js=SDK的参数
     * 设置accToken参数
     * 设置jsToken参数
     * @return mixed
     */
    private function initJsConfig()
    {
        import("@.ORG.WeiXinFun");
        $this->WX = new WeiXinFun($this->weiXinConfig); //配置微信
        //请求令牌
        $this->accToken = $this->WX->getAccessToken();
        //jsApI令牌
        $this->jsToken = $this->WX->getJsToken();
        //JS SDK 配置设置
        $jsonConfig = $this->WX->WxInitJsConfig($this->jsToken);
        $this->assign("jsonConfig", $jsonConfig);
        return $this->WX;
    }
PPP;
