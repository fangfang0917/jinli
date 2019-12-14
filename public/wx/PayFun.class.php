<?php

class PayFun
{
    // +----------------------------------------------------------------------
// | 基本信息设置
// +----------------------------------------------------------------------
    private $param = array(
        'Sn' => 0,//请求订单号
        'AppKey' => 0,//所属商家key
        'Price' => 0,//金额
        'CallBackUrl' => 0,//回调地址
        'EquipmentType' => 0,//请求设备类型

    );
    private $mid = '532660010001';//对接支付的商户ID
    private $key = 'uuFwDedqvJdOq7wxnN3+9Q==';//对接支付的商户key
    private $url = ''; ////异步通知地址
    private $payurl = 'http://openapi.xiangqianpos.com/gateway'; //支付请求链接

    /**
     * PayFun constructor.
     * @param array $param
     */
    public function __construct($param)
    {
        if ($param('Sn') != 0) {
            $this ->param['Sn'] = $param['Sn'];
        }
        if ($param('AppKey') != 0) {
            $this ->param['AppKey'] = $param['AppKey'];

        }
        if ($param('Price') != 0) {
            $this ->param['Price'] = $param['Price'];

        }
        if ($param('CallBackUrl') != 0) {
            $this ->param['CallBackUrl'] = $param['CallBackUrl'];

        }
        if ($param('EquipmentType') != 0) {
            $this ->param['EquipmentType'] = $param['EquipmentType'];
        }

    }


    /**
     * 执行初始化
     * @return mixed
     */
    public function init()
    {
        if ($this ->param('Sn') ===0) {
            return $this ->error( 101,  '缺少订单号');
        }
        if ($this ->param('AppKey') ===0) {
            return $this->error(102, '缺少商户标识');
        }
        if ($this ->param('Price') ===0) {
            return $this->error( 103, '我缺少金额');
        }
        if ($this ->param('CallBackUrl') ===0) {
            return $this->error(104, '缺少回调地址');
        }
        if ($this ->param('EquipmentType') ===0) {
            return $this->error( 108, '缺少设备类型');
        }
        if (($this ->param('Price') % 100) != 0) {
            return $this ->error( 107, '支付金额需是100的整数倍');
        }
        return $this->success($this);
    }

    /**发送请求
     * @param $link
     * @param $data
     * @param $headers
     * @return mixed|string
     */

    private function PostCurl($link, $data, $headers)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_TIMEOUT, 300);
        curl_setopt($ch, CURLOPT_URL, $link);
        curl_setopt($ch, CURLOPT_SAFE_UPLOAD, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);//严格校验
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);//设置请求头
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $return = curl_exec($ch);
        if ($return) {
            curl_close($ch);
            return $return;
        } else {
            $error = curl_errno($ch);
            curl_close($ch);
            return 'Error-' . $error;
        }
    }
    //提交请求  生成二维码

    /**
     * @param $type
     * @param $order
     * @return \think\response\Json
     */
    private function Wx($type,$order)
    {
        if ($order['pay_type'] == 1) {
            return json(array('err_code' => 1, 'msg' => '订单已支付,请勿重复发起支付!'));
        }
        if ($type == 1) {
            $service = 'pay.wxpay.native';
        } else {
            $service = 'pay.alipay.native';
        }
        $timestamp = date("YmdHis");
        $ticket = time();
        $body = [
            'orderNo' => $order['sn_b'],
            'device' => time(),
            'order_info' => 'ORDER' . time(),
            'total_amount' => $order['price'] * 100,
            'mch_create_ip' => $_SERVER['REMOTE_ADDR'],
            'notify_url' => $this->url,
            'time_start' => date('YmdHis'),
            'time_expire' => date('YmdHis', (time() + (60 * 5))),
        ];
        ksort($body);
        $jsonBody = json_encode($body, true);
        $ress = str_replace("\\/", "/", $jsonBody);
        $param = [
            'ticket' => $ticket,
            'service' => $service,
            'version' => '2.0',
            'sign_type' => 'MD5',
            'mch_code' => $this->mid,
            'timestamp' => $timestamp,
            'body' => $ress
        ];
        ksort($param);
        $b = $this->asc_sort($param);
        $str = $b;
        $signStr = $str . '&key=' . $this -> key;
        $signStr = strtoupper(md5($signStr));
        $param['sign'] = $signStr;
        $param['body'] = $body;
        $headers[] = "Content-Type:application/json";
        $resss = str_replace("\\", "", json_encode($param));
        $ret = $this->PostCurl($this->payurl, $resss, $headers);
        $ret = json_decode($ret, true);
        $ret['body']['time'] = 299;
        return json($ret);
    }

    //签名排序
    private function asc_sort($p)
    {
        if ($p) {
            $str = '';
            foreach ($p as $k => $val) {
                $str .= $k . '=' . $val . '&';
            }
            $strs = rtrim($str, '&');
            return $strs;
        }

    }
    // +----------------------------------------------------------------------
    // | 返回设置
    // +----------------------------------------------------------------------
    /**
     * 失败返回
     * @param string $info
     * @param string $code
     * @return mixed
     */
    protected function error( $code = '00000001',$info = '处理失败,信息未定义!')
    {
        $ret['info'] = $info;
        $ret['status'] = 0;
        $ret['code'] = $code;
        return $ret;
    }

    /**
     * 成功返回
     * @param array $data
     * @param string $info
     * @param string $code
     * @return mixed
     */
    protected function success( $code = '10000000',$info = '处理成功,信息未定义!', $data = array())
    {
        $ret['info'] = $info;
        $ret['status'] = 1;
        $ret['code'] = $code;
        $ret['data'] = $data;
        return $ret;
    }


}