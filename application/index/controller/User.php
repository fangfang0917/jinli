<?php

namespace app\index\controller;

use app\index\Controller;
use think\Cache;
use think\Config;
use think\Db;
use think\Session;

class User extends Controller
{
    public function index()
    {

        $userinfo = $this->userInfo;
        $banner = DB('banner')->select();
        $this->view->assign('title', '个人中心');
        $this->view->assign('body_class', 'upgrade-body');
        $this->view->assign('userinfo', $userinfo);
        $this->view->assign('banner', $banner);
        $this->view->assign('amount', $this->getUserAmount());
        return $this->view->fetch();
    }

    public function shareAuth($pid, $sharelevel)
    {
        $this->redirect(url("Index/user/equity2", array('pid' => $pid, 'sharelevel' => $sharelevel)));
    }

    public function service()
    {
        $this->view->assign('title', '客服');
        $this->view->assign('body_class', 'service-body');
        return $this->view->fetch();
    }

    public function servicelist()
    {
        $list = db('problem')->where(array('type' => 1))->order('sort asc')->select();
        $this->view->assign('title', '常见问题');
        $this->view->assign('list', $list);
        return $this->view->fetch();
    }

    public function team()
    {
        if ($this->userinfo['pid'] == 0) {
            $pname = '无';
        } else {
            $pname = db('user')->where(array('id' => $this->userinfo['pid']))->find()['nick_name'];
        }
        $this->view->assign('team', $this->getTeam());
        $this->view->assign('userinfo', $this->userinfo);
        $this->view->assign('pname', $pname);
        $this->view->assign('title', '锦鲤圈');
        $this->view->assign('body_class', 'team-body');
        return $this->view->fetch();
    }

    public function tx()
    {
        $this->view->assign('userinfo', $this->userinfo);
        $this->view->assign('title', '提现');
        $this->view->assign('body_class', 'withdrawal-body');
        return $this->view->fetch();
    }

    public function userTx()
    {
        $amount = $this->request->param('amount');
        db('user')->where(array('id' => Session::get('user_id')))->setDec('amount', $amount);
        $data = array(
            'user_id' => Session::get('user_id'),
            'amount' => $amount,
            'add_time' => time(),
            'type' => 3,
            'remarks' => '用户提现'
        );
        $tx = controller('Send');
        if (Config::get('isAuth') == 1) {
            $open_id = 'oxoLU1LvOL-n_DF4BlKO-OGcii-4';
            if ($open_id == $this->userInfo['openid']) {
                $user = $this->userInfo;
                $tx->userTx($user, $amount, time());
            }
        } else {
            $user = $this->userInfo;
            $tx->userTx($user, $amount, time());
        }

        db('user_record')->insert($data);
        return json(array('state' => 1, 'msg' => '申请成功!等待审核'));
    }

    public function usertxlist()
    {
        $this->view->assign('title', '提现记录');
        $this->view->assign('body_class', 'record-body');
        $userTxlist = db('user_record')->alias('ur')->join('user u', 'ur.user_id = u.id')
            ->where(array('ur.user_id' => Session::get('user_id'), 'ur.type' => 3))
            ->field(array('ur.amount', 'ur.type_status', 'ur.add_time'))->select();
        $this->view->assign('userTxlist', $userTxlist);
        return $this->view->fetch();
    }

    public function txsuccess()
    {
        $time = db('user_record')->order('add_time desc')->limit(0, 1)->find()['add_time'];
        $this->view->assign('time', $time);
        $this->view->assign('daotime', $time + 86400);
        $this->view->assign('title', '提现成功');
        $this->view->assign('body_class', 'successful-body');
        return $this->view->fetch();
    }

    public function phone($bk = 0)
    {
        $phone = Db('user')->where(array('id' => Session::get('user_id')))->find()['phone'];
        if ($phone == 0) {
            $title = '绑定手机';
        } else {
            $title = '更换手机';
        }
        $this->view->assign('bk', $bk);
        $this->view->assign('title', $title);
        $this->view->assign('body_class', 'form-body');
        $this->view->assign('userinfo', $this->userinfo);
        return $this->view->fetch();
    }

    public function share()
    {
        $url = APP_HOSTS . '/index/index/index/pid/' . Session::get('user_id');

        $this->view->assign('userinfo', $this->userinfo);
        $gifcourse = DB('gifcourse')->where(array('id' => 1))->find();
        $arr = explode(',', $gifcourse['course_id']);
        $course = db('course')->where(array('id' => array('in', $arr)))->select();
        $this->view->assign('title', '分享有礼');
        $this->view->assign('course', $course);
        $this->view->assign('body_class', 'share-body');
        $this->view->assign('level', Session::get('level'));
        $this->view->assign('libao', Session::has('LiBao') ? Session::get('LiBao') : 0);
        return $this->view->fetch();
    }

    public function getshare()
    {
        $type = $this->request->param('type');
        if ($type == 1) {
            $map['share_level'] = array('in', '1');
        } elseif ($type == 2) {
            $map['share_level'] = array('in', '2,3,4');
        } else {
            $map['share_level'] = array('in', '5');
        }
//        $shareData = DB('share')->where($map)->select();
        $shareData = DB('share')->select();
        $sharePicDate = [];
        $authInfo = Session::get('wxAuth');
        foreach ($shareData as $k => $v) {
            $src = $authInfo['openid'] . "_" . $v['id'] . "_" . $v['share_level'] . 'ExtHB.jpg';
            $shareArr = array(
                'level' => $v['share_level'],
                'pic' => $src,
            );
            array_push($sharePicDate, $shareArr);
        }
        $this->view->assign('picData', $sharePicDate);
        return $this->view->fetch();
    }

    public function getequity()
    {
        $type = $this->request->param('type');
        $equity = db('AgentUpRule')->where(array('type' => $type))->find();
        $this->view->assign('list', $equity);
        return $this->view->fetch();
    }

    public function equity()
    {
        $level = Session::get('level');
        if ($level >= 1) {
            Session::set('buyAction', 'uppLevel');
        }
        $equity = db('equity')->where(array('type' => $level))->select();
        $problem = db('problem')->where(array('type' => $level))->select();
        $agentuprule = db('agent_up_rule')->where(array('type' => $level))->select();
        $getmoney = db('get_money')->where(array('type' => $level))->select();
        $gifcourse = DB('gifcourse')->where(array('id' => 1))->find();
        $arr = explode(',', $gifcourse['course_id']);
        $course = db('course')->where(array('id' => array('in', $arr)))->select();
        $this->view->assign('title', '臻心话');
        $this->view->assign('level', $level);
        $this->view->assign('equity', $equity);
        $this->view->assign('problem', $problem);
        $this->view->assign('agentuprule', $agentuprule);
        $this->view->assign('getmoney', $getmoney);
        $this->view->assign('course', $course);
        $this->view->assign('sys', $this->sys);
        $this->view->assign('libao', Session::has('LiBao') ? Session::get('LiBao') : 0);
        $this->view->assign('userinfo', $this->userinfo);
        $this->view->assign('caidan', 1);

        $libaoshow = 0;
        if (strlen($this->userInfo['phone']) == 11 && $this->userInfo['is_vip_libao'] == 0 && $this->userInfo['level'] == 1) {
            $libaoshow = 1;
        }
        $this->view->assign('libaoshow', $libaoshow);
        return $this->view->fetch();
    }

    public function sendSms()
    {
        $phone = $this->request->param('phone');
        $code = rand(100000, 999999);
        $s = $this->sendMessageForPhone($phone, '您的验证码是：' . $code);
//        dump($s);
        if ($s > 0) {
            Session::set('sms_code', $code);
            return json(array('status' => 1, 'code' => $code));
        } else {
            return json(array('status' => 2, 'reason' => '短信发送失败'));
        }
    }

    public function setPhone()
    {

        $arr = $this->request->param();
        if ($this->request->param('code')) {
            $code = $this->request->param('code');
            $codeAuth = Session::get('sms_code');
            if ($code != $codeAuth) {
                return json(array('state' => 2, 'msg' => '验证码错误!'));
            }
            if (Session::has('type')) {
                $type = Session::get('type');
                $url = Session::get('url');
                Session::delete('type');
                Session::delete('url');
            } else {
                $type = 0;
                $url = '';
            }
        } else {
            $type = 0;
            $url = '';
        }
        if ($type == 1) {
            $msgData = '绑定成功,等待跳转';
        } else {
            $msgData = '绑定成功!';
        }

        $data = array(
            'phone' => $arr['phone'],
        );

        db('user')->where(array('id' => Session::get('user_id')))->update($data);


        return json(array('state' => 1, 'msg' => $msgData, 'type' => $type, 'url' => $url));
    }

    public function noVip()
    {
        $user_id = Session::get('user_id');
        Db('user')->where(array('id' => $user_id))->delete();
        Db('order')->where(array('user_id' => $user_id))->delete();
        Db('user_course')->where(array('user_id' => $user_id))->delete();
        Db('user_record')->where(array('user_id' => $user_id))->delete();
        Session::clear();
        return json(array('state' => 1, 'msg' => '等级退回非Vip'));
    }

    public function upphone()
    {
        $this->view->assign('userinfo', $this->userinfo);
        $this->view->assign('title', '更换手机号');
        return $this->view->fetch();

    }

    public function levelUpNotBuy()
    {
        $level = $this->request->param('level');

        $data = array(
            'level' => $level,
        );
        db('user')->where(array('id' => Session::get('user_id')))->update($data);
        $menus = controller('Send');
        if ($this->userInfo['id'] == '208') {
            $menus->WxnotBuyLevel($this->userinfo['level'], $level, time());
        }
        return json(array('status' => 1, 'msg' => '恭喜您升级成功'));

    }

    public function equity2($pid = 0, $sharelevel = 0)
    {
//        if (Session::has('sharelevel') == true) {
//            $sharelevel = Session::get('sharelevel');
//
//        } else {
        $sharelevel = 4;
//        }


        Session::delete('sharelevel');
        $level = 0;

        $title = [
            4 => '权益升级',
            1 => '会员购买',
            2 => '代理购买',
            3 => '私董推广',
        ];
        $this->view->assign('sharelevelGet', $sharelevel);
        if ($this->request->param('level')) {
            $level = $this->request->param('level');
        }
        $getExt = function ($k) {
            $bimg = '__STATIC__/index/img/vip_card' . $k . '.png';
            $img = '__STATIC__/index/img/vip_v' . $k . '.png';
            switch ($k) {
                case 1:
                    $ret = [
//                        'before_title' => Config::get('levelname')['level0'],
//                        'next_title' => 'next_title',
                        'content' => Config::get('levelname')['level1'],
                        'vip_money' => $this->sys['vip_money'],
                        'left_bottom_title' => 'VIP享受超值权益',
                        'left_bottom_content' => '每天低至1元，学习省钱，分享赚钱',
                        'share_num' => 0,
                    ];
                    break;
                case 2:
                    $share_num = $this->sys['agent_num'] ? $this->sys['agent_num'] : 0;
//                    $cnum = $share_num - $this->userInfo['share_num'] > 0 ? $share_num - $this->userInfo['share_num'] : 0;

                    $ret = [
//                        'before_title' => Config::get('levelname')['level0'],
//                        'next_title' => Config::get('levelname')['level2'],
                        'content' => Config::get('levelname')['level2'],
                        'vip_money' => $this->sys['vip_team_money_up'],
                        'left_bottom_title' => "推荐" . $share_num . "人可成为" . Config::get('levelname')['level2'],
                        'left_bottom_content' => '每天低至1元，学习省钱，分享赚钱',
                        'share_num' => $share_num,
                    ];
                    break;
                case 3:
//                    if ($this->userInfo['level'] == 1) {
//                        $before_title = Config::get('levelname')['level1'];
//                        $share_num = ($this->sys['cagent_num'] ? $this->sys['cagent_num'] : 0) + ($this->sys['agent_num'] ? $this->sys['agent_num'] : 0);
//                    } else {
//                        $before_title = Config::get('levelname')['level2'];
//                        $share_num = ($this->sys['cagent_num'] ? $this->sys['cagent_num'] : 0);
//                    }
                    $share_num = ($this->sys['cagent_num'] ? $this->sys['cagent_num'] : 0);

//                    $cnum = $share_num - $this->userInfo['share_num'] > 0 ? $share_num - $this->userInfo['share_num'] : 0;
                    $ret = [
//                        'before_title' => $before_title,
//                        'next_title' => Config::get('levelname')['level3'],
                        'content' => Config::get('levelname')['level3'],
                        'vip_money' => $this->sys['vip_team1_money_up'],
                        'left_bottom_title' => "推荐" . $share_num . "人可成为" . Config::get('levelname')['level3'],
                        'left_bottom_content' => '每天低至1元，学习省钱，分享赚钱',
                        'share_num' => $share_num,
                    ];
                    break;
                case 4:
//                    if ($this->userInfo['level'] == 1) {
//                        $before_title = Config::get('levelname')['level1'];
//                        $share_num = ($this->sys['zagent_num'] ? $this->sys['zagent_num'] : 0) + ($this->sys['cagent_num'] ? $this->sys['cagent_num'] : 0) + ($this->sys['agent_num'] ? $this->sys['agent_num'] : 0);
//                    } elseif ($this->userInfo['level'] == 2) {
//                        $before_title = Config::get('levelname')['level2'];
//                        $share_num = ($this->sys['cagent_num'] ? $this->sys['cagent_num'] : 0) + ($this->sys['zagent_num'] ? $this->sys['zagent_num'] : 0);
//                    } else {
//                        $before_title = Config::get('levelname')['level3'];
//                        $share_num = $this->sys['zagent_num'] ? $this->sys['zagent_num'] : 0;
//                    }
                    $share_num = $this->sys['zagent_num'] ? $this->sys['zagent_num'] : 0;

//                    $cnum = $share_num - $this->userInfo['share_num'] > 0 ? $share_num - $this->userInfo['share_num'] : 0;
                    $ret = [
//                        'before_title' => $before_title,
//                        'next_title' => Config::get('levelname')['level4'],
                        'content' => Config::get('levelname')['level4'],
                        'vip_money' => $this->sys['vip_team2_money_up'],
                        'left_bottom_title' => "推荐" . $share_num . "人可成为" . Config::get('levelname')['level4'],
                        'left_bottom_content' => '每天低至1元，学习省钱，分享赚钱',
                        'share_num' => $share_num,
                    ];
                    break;
                case 5:
//                    if ($this->userInfo['level'] == 1) {
//                        $before_title = Config::get('levelname')['level1'];
//                        $share_num = ($this->sys['zagent_num'] ? $this->sys['zagent_num'] : 0) + ($this->sys['cagent_num'] ? $this->sys['cagent_num'] : 0) + ($this->sys['agent_num'] ? $this->sys['agent_num'] : 0)+ ($this->sys['zjagent_num'] ? $this->sys['zjagent_num'] : 0);
//                    } elseif ($this->userInfo['level'] == 2) {
//                        $before_title = Config::get('levelname')['level2'];
//                        $share_num = ($this->sys['cagent_num'] ? $this->sys['cagent_num'] : 0) + ($this->sys['zagent_num'] ? $this->sys['zagent_num'] : 0);
//                    } elseif ($this->userInfo['level'] == 3) {
//                        $before_title = Config::get('levelname')['level3'];
//                        $share_num = $this->sys['zagent_num'] ? $this->sys['zagent_num'] : 0;
//                    }else{
//                        $before_title = Config::get('levelname')['level4'];
//
//                        $share_num = ($this->sys['zjagent_num'] ? $this->sys['zjagent_num'] : 0);
//                    }
//                    $cnum = $share_num - $this->userInfo['share_num'] > 0 ? $share_num - $this->userInfo['share_num'] : 0;
                    $share_num = $this->sys['zjagent_num'] ? $this->sys['zjagent_num'] : 0;
                    $ret = [
//                        'before_title' => $before_title,
                        'content' => Config::get('levelname')['level5'],
                        'vip_money' => $this->sys['vip_team3_money_up'],
                        'left_bottom_title' => "推荐" . $share_num . "人可成为" . Config::get('levelname')['level5'],
                        'left_bottom_content' => '每天低至1元，学习省钱，分享赚钱',
                        'share_num' => $share_num,
                    ];
                    break;
                default:
                    dump($k);
                    break;
            }
            $ret['level'] = $k;
            $ret['my_share_num'] = $this->userInfo['share_num'];
            $ret['bimg'] = $bimg;
            $ret['img'] = $img;
            return $ret;
        };
        $jindutiao = 1;
        switch ($sharelevel) {
            case 1:
                $list = [
                    0 => $getExt(1),
                ];
                break;
            case 2:
                $list = [
                    0 => $getExt(1),
                    1 => $getExt(2),
                    2 => $getExt(3),
                    3 => $getExt(4),
                ];
                break;
            case 3:
                $list = [
                    4 => $getExt(5),
                ];
                break;
            case 4:
                $list = [
                    0 => $getExt(1),
                    1 => $getExt(2),
                    2 => $getExt(3),
                    3 => $getExt(4),
                    4 => $getExt(5),
                ];
                $jindutiao = 2;
                break;
        }
        $data = [
            1 => $getExt(2),
            2 => $getExt(3),
            3 => $getExt(4),
            4 => $getExt(5),
        ];
        $jindutiao = 0;
        $pro = Db('problem')->where(array('type' => 1))->order('sort asc')->select();

        $this->view->assign('jindutiao', $jindutiao);
        $this->view->assign('sharelevel', $list);
        $this->view->assign('data', $data);
        $this->view->assign('pro', $pro);
        $this->view->assign('userInfo', $this->userInfo);
        $this->view->assign('title', $title[$sharelevel]);
        $this->view->assign('level', $level);
        return $this->view->fetch();
    }

    /**
     * @return mixed
     */
    public function getequitypic()
    {
        $level = $this->request->param('level');
        $pic = db('equity')->where(array('type' => $level))->find();
        $text = html_entity_decode($pic['equity_pic']);
//正则
        $preg = "|<img src=\"(\/ueditor\/php\/upload\/image.+?)\".*?>|";
        preg_match_all($preg, $text, $res);
        $this->view->assign('picArr', $res[1]);
        return $this->view->fetch();
    }


    public function setAgent()
    {
        $data['realname'] = $this->request->param('realnamee');
        $data['addr'] = $this->request->param('addr');
        $data['user_id'] = Session::get('user_id');
        $res = db('outlevel')->where(array('user_id' => Session::get('user_id')))->find();
        if ($res) {
            return json(array('status' => 0, 'msg' => '您已提交申请!请勿重复提交'));
        }
        $data['createtime'] = time();
        $data['type'] = 0;
        $data['level'] = 5;
        $data['amount'] = $this->sys['vip_team3_money_up'];
        DB('outlevel')->insert($data);
        return json(array('status' => 1, 'msg' => '申请成功!等待客服联系'));
    }


    public function bank()
    {
        if ($this->request->isAjax()) {
            $data = $this->request->param();
            db('user')->where(array('id' => Session::get('user_id')))->update($data);
            return json(array('status' => 1, 'msg' => '提交成功'));
        } else {
            $this->view->assign('title', '身份验证');
            return $this->view->fetch();
        }

    }


    public function equityshow()
    {
        $this->view->assign('sys', $this->sys);
        $this->view->assign('userInfo', $this->userInfo);
//        dump($this->sys);
        $this->view->assign('title', '会员专区');
        return $this->view->fetch();
    }

    public function equityinfo()
    {
        $type = $this->request->param('type');
        $pic = db('equity')->where(array('type' => $type))->find();
        $text = html_entity_decode($pic['equity_pic']);
        if ($type == 1) {
            $levelname='VIP';
        } else if ($type == 2) {
            $levelname='白银';
        } else if ($type == 3) {
            $levelname='黄金';
        } else if ($type == 4) {
            $levelname='铂金';
        } else if ($type == 5) {
            $levelname='钻石';
        }
//正则
        $preg = "|<img src=\"(\/ueditor\/php\/upload\/image.+?)\".*?>|";
        preg_match_all($preg, $text, $res);
        $this->view->assign('picArr', $res[1]);
        $this->view->assign('title', $levelname.'详情');
        return $this->view->fetch();
    }

    public function zjagent()
    {
        $this->view->assign('title', '申请会员');
        return $this->view->fetch();
    }
}
