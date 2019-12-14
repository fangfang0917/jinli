<?php

namespace app\index\controller;

use app\index\Controller;
use think\Cache;
use think\Config;
use think\Session;

class Send extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**购买代理和vip 的推送
     * @param int $order_id
     */
    public function WxBuyVipSend($order_id=0)
    {
        $order_id = '275';
//        $order_id = '276';
        $order = DB('order')->where(array('id'=>$order_id))->find();
        $level =$order['buy_level'];
        $user = $this->userInfo;
        if ($level == 1) {
            $msg = '锦鲤妈妈 vip';
            $title = '您好，您已成功开通锦鲤妈妈会员';
            $eq = '每天低至1元，学习省钱，分享赚钱';
        } elseif ($level == 2) {
            $msg = '锦鲤大使 院长';
            $title = '您好，您已成功开通锦鲤大使';
            $eq = '享受永久锦鲤妈妈 VIP以及大使等级特权';
        } elseif ($level == 3) {
            $msg = '锦鲤大使 联创';
            $title = '您好，您已成功开通锦鲤大使';
            $eq = '享受永久锦鲤妈妈 VIP以及大使等级特权';
        } elseif ($level == 4) {
            $msg = '锦鲤大使 合伙人';
            $title = '您好，您已成功开通锦鲤大使';
            $eq = '享受永久锦鲤妈妈 VIP以及大使等级特权';
        } else {
            $msg = '锦鲤大使 私董';
            $title = '您好，您已成功开通锦鲤大使';
            $eq = '享受永久锦鲤妈妈 VIP以及大使等级特权';
        }
        $openid = $user['openid'];
        $template_id = Config::get('template_id')['buyVip'];
        if ($user['pid'] != 0) {
            $pname = DB('user')->where(array('id' => $user['pid']))->find()['nick_name'];
            $this -> WxSetAmountSend($order,$user['pid']);
        } else {
            $pname = '无';
        }
        $data = [
            'first' => [
                'value' => $title,
            ],
            'keyword1' => [
                'value' => $msg
            ],
            'keyword2' => [
                'value' =>$eq
            ],
            'keyword3' => [
                'value' => $pname
            ],
            'remark' => [
                'value' => '感谢您对锦鲤妈妈的支持。'
            ],
        ];
        $this->WX->wxMsg($this->accToken, $data, $template_id, $openid);

    }

    /**
     * vip到期提醒
     * @param $type  到期时间
     **/
    public function WxDaoVip($type,$user)
    {
        $user = $this->userInfo;
        $type = $this->request->param('type');

        $outtime = $user['buy_vip_time'] + 365 + 24 + 60 + 60;
        $template_id = Config::get('template_id')['Daoqi'];
        $data = [
            'first' => [
                'value' => '尊敬的会员，您的锦鲤妈妈 VIP学习时间还有' . $type . '天就到期了，您将不能享受锦鲤妈妈 VIP专属特权！',
            ],
            'keyword1' => [
                'value' => '普通会员'
            ],
            'keyword2' => [
                'value' => '锦鲤妈妈 VIP'
            ],
            'keyword3' => [
                'value' => date('Y-m-d H:i:s', $outtime)
            ],
            'remark' => [
                'value' => '感谢您对锦鲤妈妈的支持。'
            ],
        ];
        $this->WX->wxMsg($this->accToken, $data, $template_id, $user['openid']);

    }


    /**自主升级代理等级
     * @param $oldlevel  旧等级
     * @param $newlevel  新等级
     * @param $time    更新时间
     */
    public function WxnotBuyLevel($oldlevel, $newlevel, $time)
    {
        if ($oldlevel == 1) {
            $otitle = '锦鲤妈妈 Vip';
        } elseif ($oldlevel == 2) {
            $otitle = '锦鲤大使 院长';
        } elseif ($oldlevel == 3) {
            $otitle = '锦鲤大使 联创';
        } elseif ($oldlevel == 4) {
            $otitle = '锦鲤大使 合伙人';
        } elseif ($oldlevel == 5) {
            $otitle = '锦鲤大使 私董';
        }

        if ($newlevel == 2) {
            $ntitle = '锦鲤大使 院长';
        } elseif ($newlevel == 3) {
            $ntitle = '锦鲤大使 联创';
        } elseif ($newlevel == 4) {
            $ntitle = '锦鲤大使 合伙人';
        } elseif ($newlevel == 5) {
            $ntitle = '锦鲤大使 私董';
        }
        $openid = $this->userInfo['openid'];
        $template_id = Config::get('template_id')['levelUp'];
        $data = [
            'first' => [
                'value' => '恭喜您成功升级会员等级',
            ],
            'keyword1' => [
                'value' => $this->userInfo['nick_name']
            ],
            'keyword2' => [
                'value' => $otitle
            ],
            'keyword3' => [
                'value' => $ntitle
            ],
            'keyword4' => [
                'value' => date('Y', $time) . '年' . date('m', $time) . '月' . date('d', $time) . '日  ' . date('H:i', $time)
            ],
            'remark' => [
                'value' => '如有问题，请添加微信geniusmini，联系客服。'
            ],
        ];
        $this->WX->wxMsg($this->accToken, $data, $template_id, $openid);
    }


    /**购买课程推送
     * @param string $orderID
     */
    public function BuyCourse($orderID = '')
    {
        $orderID = '272';
        $order = Db('order')->where(array('id' => $orderID))->find();
        $user = Db('user')->where(array('id'=>$order['user_id']))->find();
        $courseName = DB('course')->where(array('id' => $order['course_id']))->find()['course_title'];
        $openid = $user['openid'];
        $template_id = Config::get('template_id')['buyCourse'];
        $data = [
            'first' => [
                'value' => '恭喜您成功购买了课程！',
            ],
            'keyword1' => [
                'value' => $order['order_no']
            ],
            'keyword2' => [
                'value' => $courseName
            ],
            'keyword3' => [
                'value' => $order['money'] . '元'
            ],
            'keyword4' => [
                'value' => $user
            ],
            'keyword5' => [
                'value' => date('Y', $order['add_time']) . '年' . date('m', $order['add_time']) . '月' . date('d', $order['add_time']) . '日  ' . date('H:i', $order['add_time'])
            ],
            'remark' => [
                'value' => '快点加入锦鲤妈妈开始学习吧~'
            ],
        ];
        $this->WX->wxMsg($this->accToken, $data, $template_id, $openid);
        if ($user['pid'] != 0) {
            $this->WxSetAmountSend($order, $user['pid']);
        }

    }

    /**推荐人购买返点推送
     * @param $order_id
     */

    public function WxSetAmountSend($order = array(), $pid = '')
    {
        if ($order['order_type'] == 1) {
            $GoodsName = DB('course')->where(array('id' => $order['course_id']))->find()['course_title'];

        } elseif ($order['order_type'] == 2) {
            if ($order['buy_level'] == 2) {
                $GoodsName = "锦鲤大使 院长";
            } elseif ($order['buylevel'] == 3) {
                $GoodsName = "锦鲤大使 联创";
            } elseif ($order['buylevel'] == 4) {
                $GoodsName = "锦鲤大使 合伙人";
            }
        } else {
            $GoodsName = "锦鲤妈妈 VIP";
        }
        $openid = db('user')->where(array('id' => $pid))->find()['openid'];
        $template_id = Config::get('template_id')['fanli'];
        $data = [
            'first' => [
                'value' => '恭喜您，您的好友点击您分享的链接并成功购买' . $GoodsName . '！',
            ],
            'keyword1' => [
                'value' => $order['order_no']
            ],
            'keyword2' => [
                'value' => $GoodsName
            ],
            'keyword3' => [
                'value' => $order['money'] . '元'
            ],
            'keyword4' => [
                'value' => '支付成功'
            ],
            'keyword5' => [
                'value' => date('Y', $order['add_time']) . '年' . date('m', $order['add_time']) . '月' . date('d', $order['add_time']) . '日  ' . date('H:i', $order['add_time'])
            ],
            'remark' => [
                'value' => '您的奖励金已到账户，请在锦鲤妈妈个人中心-我的钱包进行查询！'
            ],
        ];
        $this->WX->wxMsg($this->accToken, $data, $template_id, $openid);
    }


    /**
     * 推荐人购买代理返点
     * @param $money  金额
     * @param $level  等级
     * @param $time  时间
     * @param $pid 上级id
     */
    public function setAmount($money,$level,$time,$pid){
        if($level == 2){
            $GoodsName = "推荐院长";

        }elseif($level == 3){
            $GoodsName = "推荐联创";

        }else{
            $GoodsName = "推荐合伙人";

        }
        $openid = db('user')->where(array('id' => $pid))->find()['openid'];
        $template_id = Config::get('template_id')['fanli'];
        $data = [
            'first' => [
                'value' => '收益到账通知！',
            ],
            'keyword1' => [
                'value' => $money
            ],
            'keyword2' => [
                'value' => $GoodsName
            ],
            'keyword3' => [
                'value' => date('Y', $time) . '年' . date('m', $time) . '月' . date('d', $time) . '日  ' . date('H:i', $time)
            ],
            'remark' => [
                'value' => '您的收益已到账。'
            ],
        ];
        $this->WX->wxMsg($this->accToken, $data, $template_id, $openid);
    }

    /**
     * "您好,您的提现申请已经收到！
    昵称：{触发人}
    时间：{触发时间}
    金额：{提现金额}
    提现方式：微信
    我们正在加紧审核中，提现申请审核通过后我们会直接给您转账，请注意查收微信消息及短信通知。

    如有疑问，请添加微信geniusmini，联系客服。"

     */
    public function userTx($user,$money,$time){
        $openid =$user['openid'] ;
        $template_id = Config::get('template_id')['userTx'];
        $data = [
            'first' => [
                'value' =>'您好,您的提现申请已经收到！',
            ],
            'keyword1' => [
                'value' => $user['nick_name']
            ],
            'keyword2' => [
                'value' => date('Y', $time) . '年' . date('m', $time) . '月' . date('d', $time) . '日  ' . date('H:i', $time)

            ],
            'keyword3' => [
                'value' =>$money
            ],
            'keyword4' => [
                'value' =>'微信'
            ],
            'remark' => [
                'value' => '我们正在加紧审核中,提现申请审核通过后我们会直接给您转账,请注意查收微信信息及短信通知.如有疑问，请添加微信geniusmini，联系客服。'
            ],
        ];
        $this->WX->wxMsg($this->accToken, $data, $template_id, $openid);
    }


    /**
     * 恭喜您，提现成功！请注意查收！
    金额：{提现金额}
    时间：{状态修改时间}
    感谢您对锦鲤MOM的大力支持，资金已经成功转入您指定的账户！

    如有疑问，请添加微信geniusmini，联系客服。
     */
    public function userTxSucc($user,$money,$time){
        $openid =$user['openid'] ;
        $template_id = Config::get('template_id')['userTxSucc'];
        $data = [
            'first' => [
                'value' =>'恭喜您提现成功！',
            ],
            'keyword1' => [
                'value' => $money
            ],
            'keyword2' => [
                'value' => date('Y', $time) . '年' . date('m', $time) . '月' . date('d', $time) . '日  ' . date('H:i', $time)

            ],
            'remark' => [
                'value' => '感谢您对锦鲤MOM的大力支持，资金已经成功转入您指定的账户！如有疑问，请添加微信geniusmini，联系客服。'
            ],
        ];
        $this->WX->wxMsg($this->accToken, $data, $template_id, $openid);
    }

    public function ce(){
        $user = $this->userInfo;
        $money = 100;
        $time = time();
        $remarks = '您的账户错误';
        $this->userTxErr($user,$money,$time,$remarks);
//        $this->userTxSucc($user,$money,$time);
    }

    public function userTxErr($user,$money,$time,$remarks){
        $openid =$user['openid'] ;
        $template_id = Config::get('template_id')['userTxerr'];
        $data = [
            'first' => [
                'value' =>'恭喜您提现成功！',
            ],
            'keyword1' => [
                'value' => $money
            ],
            'keyword2' => [
                'value' => date('Y', $time) . '年' . date('m', $time) . '月' . date('d', $time) . '日  ' . date('H:i', $time)

            ],
            'keyword3' => [
                'value' =>$remarks
            ],
            'remark' => [
                'value' => '感谢您对锦鲤MOM的大力支持，资金已经成功转入您指定的账户！如有疑问，请添加微信geniusmini，联系客服。'
            ],
        ];
        $this->WX->wxMsg($this->accToken, $data, $template_id, $openid);
    }




    public function phone7($phone='15295488523',$data =''){
          $data='【锦鲤妈妈】好久不见~我们的MOM CARE唤醒课又更新了很多与妈妈们有关的精彩内容哦！
快来成为锦鲤妈妈 VIP';
          $c = $this->sendMessageForPhone($phone,$data);
          dump($c);
    }
}