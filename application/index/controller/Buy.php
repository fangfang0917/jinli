<?php

namespace app\index\controller;

use app\index\Controller;
use think\Cache;
use think\Config;
use think\Session;

class Buy extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function buyVip()
    {
        if ($this->userinfo['level'] > 0) {
            return json(array('data' => array('status' => 2, 'msg' => '您是VIP或代理,请勿重复购买')));
        }
        $amount = $this->sys['vip_money'];
        $url = $this->request->param('url');
        $data = array(
            'user_id' => Session::get('user_id'),
            'money' => $amount,
            'order_type' => 4,
            'add_time' => time(),
            'order_no' => time() . rand(1111111, 9999999),
            'order_no_remarkes' => '4' . 'vip' . rand(1111111, 9999999) . time(),
            'pay_type' => 0,
            'buy_level'=>1
        );
        $order_id = db('order')->insertGetId($data);
//        return $this->index('buyvip', 1, $amount, $order_id);
        return $this->pay('buyvip', 1, $amount, $order_id, $url);

    }

    public function levelUp()
    {
        $level = $this->request->param('level');
        $url = $this->request->param('url');
        if ($this->userinfo['level'] >= $level) {
            return json(array('data' => array('status' => 2, 'msg' => '您是VIP或代理,请勿重复购买')));
        }
        $level_money = DB('order')->where(array('user_id' => Session::get('user_id'), 'order_type' => array('in', '3,4')))->sum('money');
//        $level = Session::get('level');
        $sys = Cache::get('data');
        $amount = 0;
        if ($level == 1) {
            $amount = $this->sys['vip_team_money_up'] - $level_money;
        } elseif ($level == 2) {
            $amount = $this->sys['vip_team1_money_up'] - $level_money;
        } elseif ($level == 3) {
            $amount = $this->sys['vip_team2_money_up'] - $level_money;
        } elseif ($level == 4) {
            $amount = $this->sys['vip_team3_money_up'] - $level_money;
        } elseif ($level == 5) {
            $amount = 180000 - $level_money;
        }
        $data = array(
            'user_id' => Session::get('user_id'),
            'money' => $amount,
            'order_type' => 3,
            'add_time' => time(),
            'order_no' => time() . rand(1111111, 9999999),
            'order_no_remarkes' => '3' . 'levelup' . rand(1111111, 9999999) . time(),
            'pay_type' => 0,
            'buy_level' => $level
        );
        $order_id = db('order')->insertGetId($data);
//        return $this->index('levelup', $level, $amount, $order_id,$url);
        return $this->pay('levelup', $level, $amount, $order_id, $url);
    }

    public function buyCourse()
    {
        $course_id = $this->request->param('id');
        $url = $this->request->param('url');
        $order = db('order')->where(array('user_id' => Session::get('user_id'), 'course_id' => $course_id))->find();
        if ($order) {
            return $this->pay('buyCourse', 1, $order['money'], $order['id'], $url);

        }
        $courseinfo = DB('course')->where(array('id' => $course_id))->find();
        $level = Session::get('level');
        if ($level > 0) {
            $amount = $courseinfo['course_vip_money'];
        } else {
            $amount = $courseinfo['course_money'];
        }
        $data = array(
            'user_id' => Session::get('user_id'),
            'money' => $amount,
//            'money' => 1,
            'course_id' => $course_id,
            'order_type' => 1,
            'add_time' => time(),
            'order_no' => time() . rand(1111111, 9999999),
            'order_no_remarkes' => '1' . 'buyCourse' . rand(1111111, 9999999) . time(),
            'pay_type' => 0,
            'course_type'=>1
        );
        $order_id = db('order')->insertGetId($data);
//        return $this->index('buyCourse', 1, $amount, $order_id,$url);
        return $this->pay('buyCourse', 1, $amount, $order_id, $url);
    }

    public function pay($type, $level, $money, $order_id, $url)
    {
        $notify_url = Config::get('notify_url');
        if($this->userInfo['openid'] == 'oxoLU1LvOL-n_DF4BlKO-OGcii-4'){
            $this->WX->setParamArr([
                'total_fee' => 1,
                'notify_url' => $notify_url,
                'trade_type' => 'JSAPI',
                'openid' => $this->userinfo['openid'],
                'body' => 'test',
                'out_trade_no' => $type . '_' . $order_id . '_' . $level . '_' . $money . "_" . time(),
            ]);
        }else{
            $this->WX->setParamArr([
                'total_fee' => Config::get('AuthMoney') == 1 ?Config::get('AuthMoney'):$money * 100,
                'notify_url' => $notify_url,
                'trade_type' => 'JSAPI',
                'openid' => $this->userinfo['openid'],
                'body' => 'test',
                'out_trade_no' => $type . '_' . $order_id . '_' . $level . '_' . $money . "_" . time(),
            ]);
        }

        $this->WX->getPayPrepayId();
        $this->jsonConfig = $this->WX->WxInitJsConfig($this->jsToken, $url);
        $this->PayParam = $this->WX->getPayParam('array');
//        $callback =$menus=controller('Wxcallback');
//        $str = "<xml><appid><![CDATA[wxeb0d31cfb151b00f]]></appid>
//<bank_type><![CDATA[CFT]]></bank_type>
//<cash_fee><![CDATA[1]]></cash_fee>
//<fee_type><![CDATA[CNY]]></fee_type>
//<is_subscribe><![CDATA[Y]]></is_subscribe>
//<mch_id><![CDATA[1513148201]]></mch_id>
//<nonce_str><![CDATA[u4iblvajxnm46cia1epsiff0v20ok14q]]></nonce_str>
//<openid><![CDATA[oxoLU1LvOL-n_DF4BlKO-OGcii-4]]></openid>
//<out_trade_no><![CDATA[".$type."_".$order_id."_".$level."_".$money."_1571223878]]></out_trade_no>
//<result_code><![CDATA[SUCCESS]]></result_code>
//<return_code><![CDATA[SUCCESS]]></return_code>
//<sign><![CDATA[FA013B8D690C2C8B218D316C028E514F]]></sign>
//<time_end><![CDATA[20191016190528]]></time_end>
//<total_fee>1</total_fee>
//<trade_type><![CDATA[JSAPI]]></trade_type>
//<transaction_id><![CDATA[4200000417201910160124197929]]></transaction_id>
//</xml>";
//        $callback->index($str);
        $levelStr = [
            1 => 'VIP',
            2 => '院长',
            3 => '联创',
            4 => '合伙人',
            5 => '私董',
        ];
        return json(array('WxConifg' => $this->PayParam, 'data' => array('level' => $level, 'levelText' => $levelStr[$level], 'is_vip_libao' => $this->userinfo['is_vip_libao'], 'phone' => $this->userInfo['phone'], 'status' => 1)));
    }


    public function succbuyVip()
    {
        $data = $this->request->param('str');
        $arr = explode(',', $data);
        $is_vip_libao = Db('user')->where(array('id' => Session::get('user_id')))->find()['is_vip_libao'];
        if ($is_vip_libao > 0) {
            return json(array('state' => 2, 'msg' => '您已兑换!请勿重复兑换'));
        }
        db('user')->where(array('id' => Session::get('user_id')))->update(array('is_vip_libao' => 1));

        foreach ($arr as $k => $v) {
            $courseinfo = db('course_info')->where(array('course_id' => $v))->select();
            foreach ($courseinfo as $kk => $vv) {
                db('user_course')->insert(array('course_id' => $v, 'course_info_id' => $vv['id'], 'user_id' => Session::get('user_id')));
            }
            $order = array(
                'user_id' => Session::get('user_id'),
                'money' => 0,
                'course_id' => $v,
                'order_type' => 1,
                'add_time' => time(),
                'order_no' => time() . rand(1111111, 9999999),
                'order_no_remarkes' => '1' . 'course' . rand(1111111, 9999999) . time(),
                'pay_type' => 1,
                'course_type'=>2

            );
            db('order')->insert($order);
        }
        if (Session::get('LiBao') != null) {
            Session::delete('url');
            Session::delete('LiBao');
        }
        return json(array('state' => 1, 'msg' => '领取成功!'));
    }


}