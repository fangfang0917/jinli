<?php

namespace app\index;

use http\Url;
use think\Cache;
use think\Model;
use think\View;
use think\Request;
use think\Session;
use think\Db;
use think\Config;
use think\Loader;
use think\Exception;
use think\exception\HttpException;

class Controller
{
    use \traits\controller\Jump;
    /**
     * weixin配置
     */
    public $WxConifg;
    public $WX;
    public $jsToken;
    public $jsonConfig;
    public $accToken;
    public $view;
    /**
     * @var Request Request实例
     */
    public $request;
    public $userinfo;
    public $about;
    public $userOP;
    public $user_id;
    public $level;
    public $string;
    public $ShareUrl;
    public $PayParam;
    public $sys;

    public function __construct()
    {
        Session::delete('sharelevel');
        Session::set('time', time());
        $this->sessionId = session_id();
//        include_once ROOT_PATH . 'public' . DS . 'wx' . DS . 'WeiXinFun.class.php';
//        $this->WxConifg = array(
//            'appId' => Config::get('appid'),//公众号开发者ID
//            'secret' => Config::get('appsecret'),//公众号开发者密码
//            'mchId' => Config::get('mchId'),//商户号
//            'key' => Config::get('key'),//商户支付密钥
//            'encodingAesKey' => Config::get('encodingAesKey'),//消息加解密密钥
//            'serviceToken' => Config::get('serviceToken'),//服务器配置令牌-9*-0
//        );
//        $this->WX = new \WeiXinFun($this->WxConifg); //配置微信
//        //请求令牌
//        $this->accToken = $this->WX->getAccessToken();
//        //jsApI令牌curPageURL
//        $this->jsToken = $this->WX->getJsToken();
//        //JS SDK 配置设置
//        $this->ShareUrl = $this->WX->curPageURL();
//        $this->jsonConfig = $this->WX->WxInitJsConfig($this->jsToken, $this->ShareUrl);
        $sys = db('userop')->where(array('id' => 0))->find();
        $this->sys = json_decode($sys['userop'], true);
        if (null === $this->view) {
            $this->view = View::instance(Config::get('template'), Config::get('view_replace_str'));
        }
        if (null === $this->request) {
            $this->request = Request::instance();
        }

        if ($this->request->param('pid')) {

            $pid = db('user')->where(array('id' => $this->request->param('pid')))->find();
            if ($pid['level'] > 0) {
                Session::set('pid', $this->request->param('pid'));
            } else {
                Session::set('pid', 0);
            }
        } else {
            Session::set('pid', 0);
        }
        if ($this->request->param('sharelevel')) {
            Session::set('sharelevel', $this->request->param('sharelevel'));
        }
        $this->view->assign('jsonConfig', $this->jsonConfig);
        $this->about = Db('intertext')->where(array('id' => 1))->find();
        $userOP = DB('userop')->where(array('id' => 0))->find();
        $this->userop = json_decode($userOP['userop'], true);
        $this->view->assign('Customer', Cache::get('Customer'));
        $controller = request()->controller();
        $this->view->assign('controller', $controller);
        $gifcourse = DB('gifcourse')->where(array('id' => 1))->find();
        $arr = explode(',', $gifcourse['course_id']);
        $libaocourse = db('course')->where(array('id' => array('in', $arr)))->select();
        $this->view->assign('libaocourse', $libaocourse);
        //获取当前方法名
        $action = request()->action();
        $this->view->assign('action', $action);
        $this->view->assign('levelname', Config::get('levelname'));
//        if (!$this->WX->isWeiXin()) {
//            echo "请在微信浏览器操作";
//            die;
//        }
//        if (Session::has('wxAuth') == false) {
//            $nowUrl = $this->WX->curPageURL();
//            $code = $this->request->param('code') ? $this->request->param('code') : 0;
//            if ($code == 0) {
//                $this->WX->wxGetCode($nowUrl);
//                die;
//            }
//            $auth = $this->WX->wxCodeExchangeForAccessToken($code);
//            $authInfo = $this->WX->wxGetUserInfo($auth['access_token'], $auth['openid']);
//            Session::set('wxAuth', $authInfo);
//        }
        Session::set('buyAction', 'Vip');
        $this->login();
        $this->userinfo = $this->userInfo;
        if (strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone') || strpos($_SERVER['HTTP_USER_AGENT'], 'iPad')) {
            $equipmentType = 'IOS';
        } else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Android')) {
            $equipmentType = 'Android';
        } else {
            $equipmentType = 'Other';
        }
        $this->view->assign('equipmentType', $equipmentType);
    }

    public function deleteUser()
    {
        Db('user')->where(array('id' => array('not in', '-1')))->update([
            'amount' => 0,
            'level' => 0,
            'pid' => 0,
            'p_pid' => 0,
            'path' => '0',
            'share_level' => 0,
            'share_num' => 0,
            'sharetype' => 0
        ]);
        Db('user')->where(array('id' => array('not in', '57')))->delete();
        Db('order')->where(array('user_id' => array('not in', '1')))->delete();
        Db('user_record')->where(array('user_id' => array('not in', '1')))->delete();
        Db('course_comment')->where(array('user_id' => array('not in', '1')))->delete();
        Db('user_course')->where(array('user_id' => array('not in', '1')))->delete();
        echo "<a href='" . url("Index/index/index") . "' style='font-size: 3rem;padding: 2.3rem;'>返回首页</a>";
    }

    protected function sendMessageForPhone($tel = '15295488523', $content = '')
    {
        $aipLink = "https://sdk2.028lk.com/sdk2/BatchSend2.aspx?";
        $ContentS = rawurlencode(mb_convert_encoding($content . '【锦鲤妈妈】', "gb2312", "utf-8"));//短信内容做GB2312转码处理
        $curpost = "CorpID=XAJS007263&Pwd=gm@7263&Mobile=$tel&Content=" . $ContentS;
        $send = $this->WX->PostCurl($aipLink, $curpost);
        return $send;
    }


    protected function initShareConfig($action = array())
    {
        $url = url("Index/index/index", ['pid' => $this->userInfo['id']]);
        $shareConfig = [];
        $shareConfig['shareTitle'] = isset($action['title']) ? $action['title'] : '锦鲤妈妈';
        $shareConfig['shareDesc'] = isset($action['desc']) ? $action['desc'] : '为3亿中国妈妈，提供陪伴式终身成长解决方案';
        $shareConfig['shareUrl'] = APP_HOSTS . (isset($action['url']) ? $action['url'] : $url);
        $shareConfig['shareIcon'] = $this->about['about_pic'];
        $this->view->assign('shareConfig', $shareConfig);
    }


    protected function login()
    {
//        $authInfo = Session::get('wxAuth');
//        $userInfo = db('user')->where(array('openid' => $authInfo['openid']))->field(array('id', 'level', 'head', 'share_level', 'pid', 'p_pid', 'path'))->find();
//        $pid = Session::get('pid');
//
//        if (!is_array($userInfo)) {
//            $data['add_time'] = time();
//            $data['head_type'] = 1;
//            $data['openid'] = $authInfo['openid'];
//            $data['nick_name'] = $authInfo['nickname'];
//            $data['head'] = $authInfo['headimgurl'];
//            $data['sex'] = $authInfo['sex'];
//
//            if ($pid != 0) {
//                $data['lintime'] = time();
//                $pinfo = db('user')->where(array('id' => $pid))->field(array('id', 'level', 'head', 'share_level', 'pid', 'p_pid', 'path'))->find();
//                if ($pinfo['level'] < 1) {
//                    $pid = 0;
//                    $data['p_pid'] = 0;
//                    $data['path'] = 0;
//                } else {
//                    $data['p_pid'] = $pinfo['pid'];
//                    $data['path'] = $pinfo['path'] . '|' . $pinfo['id'];
//                }
//
//            } else {
//                $data['p_pid'] = 0;
//                $data['path'] = 0;
//            }
//            $data['pid'] = $pid;
//            $data['sharetype'] = 0;
//            if (Session::has('sharelevel') == true) {
//                $data['share_level'] = Session::get('sharelevel');
//                $data['sharetype'] = 1;
//            }
//            db('user')->insertGetId($data, false, true);
//            Session::delete('pid');
//
//        }
//
//        if ($pid != 0) {
//            if ($userInfo['pid'] == 0 && $userInfo['level'] == 0) {
//                $pinfo = db('user')->where(array('id' => $pid))->field(array('id', 'level', 'head', 'share_level', 'pid', 'p_pid', 'path'))->find();
//                $save = [
//                    'pid' => $pid,
//                    'p_pid' => $pinfo['pid'],
//                    'path' => $pinfo['path'] . '|' . $pinfo['id'],
//                ];
//                db('user')->where(array('openid' => $authInfo['openid']))->update($save);
//            }
//        }
        $authInfo['openid'] = 'oxoLU1LvOL-n_DF4BlKO-OGcii-4';
        db('user')->where(array('openid' => $authInfo['openid']))->update(array('lastlogintime'=>time()));

        $this->userInfo = db('user')->where(array('openid' => $authInfo['openid']))->find();
        $this->view->assign('rigU', $this->userInfo);
        Session::set('user_id', $this->userInfo['id']);
        Session::set('level', $this->userInfo['level']);
//        $this->getVipCourse();
        $this->initShareConfig();
    }

    public function uppSharePic()
    {
        $authInfo = Session::get('wxAuth');
        $userInfo = db('user')->where(array('openid' => $authInfo['openid']))->field(array('id', 'level', 'head'))->find();
        $srcFang = ROOT_PATH . 'public/static/uploads/avatar/' . $authInfo['openid'] . "_" . $userInfo['id'] . '.jpg';
        if (is_file($srcFang) == false || $userInfo['head'] != $authInfo['headimgurl']) {
            downloadavatar($authInfo['headimgurl'], $srcFang);
        }
        $srcYuan = ROOT_PATH . 'public/static/uploads/avatar/' . $authInfo['openid'] . "_" . $userInfo['id'] . 'YUAN.jpg';
        if (is_file($srcYuan) == false || $userInfo['head'] != $authInfo['headimgurl']) {
            yuanimg($authInfo['headimgurl'], $srcYuan);
        }
        vendor('phpqrcode.phpqrcode');
        $saveEr = [
            [
                'path' => ROOT_PATH . 'public/static/uploads/avatar/' . $authInfo['openid'] . "_" . $userInfo['id'] . '_SHARE_User.jpg',
                'href' => APP_HOSTS . '/index/user/shareAuth/pid/' . $userInfo['id'] . '/sharelevel/1.html',
            ],
            [
                'path' => ROOT_PATH . 'public/static/uploads/avatar/' . $authInfo['openid'] . "_" . $userInfo['id'] . '_SHARE_DaiLi.jpg',
                'href' => APP_HOSTS . '/index/user/shareAuth/pid/' . $userInfo['id'] . '/sharelevel/2.html',
            ],
            [
                'path' => ROOT_PATH . 'public/static/uploads/avatar/' . $authInfo['openid'] . "_" . $userInfo['id'] . '_SHARE_SiDong.jpg',
                'href' => APP_HOSTS . '/index/user/shareAuth/pid/' . $userInfo['id'] . '/sharelevel/3.html',
            ],
        ];
        foreach ($saveEr as $k => $v) {
            if (is_file($v['path']) == false) {
                \Qrcode::png($v['href'], $v['path'], "L", 5, 2);
            }
        }
        $shareData = DB('share')->select();
        foreach ($shareData as $k => $v) {
            $this->sharePic($this->userinfo, $v);
        }
        echo 1;
    }

//当前月
    public function get_thismonth()
    {
        $beginThismonth = mktime(0, 0, 0, date('m'), 1, date('Y'));
        $endThismonth = mktime(23, 59, 59, date('m'), date('t'), date('Y'));
        $ret = array('between', $beginThismonth . "," . $endThismonth);
        return $ret;
    }

//上一月
    public function get_lastmonth()
    {
        $begin = mktime(0, 0, 0, date('m') - 1, 1, date('Y'));
        $end = mktime(23, 59, 59, date('m') - 1, date('t', $begin), date('Y'));
        $ret = array('between', $begin . "," . $end);
        return $ret;
    }

//当前日
    public function get_today()
    {
        $beginToday = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        $endToday = mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')) - 1;
        $ret = array('between', $beginToday . "," . $endToday);
        return $ret;
    }

//昨天
    public function get_yestoday()
    {
        $beginYesterday = mktime(0, 0, 0, date('m'), date('d') - 1, date('Y'));
        $endYesterday = mktime(0, 0, 0, date('m'), date('d'), date('Y')) - 1;
        $ret = array('between', $beginYesterday . "," . $endYesterday);
        return $ret;
    }

//上周
    public function get_lastweek()
    {
        $beginLastweek = mktime(0, 0, 0, date('m'), date('d') - date('w') + 1 - 7, date('Y'));
        $endLastweek = mktime(23, 59, 59, date('m'), date('d') - date('w') + 7 - 7, date('Y'));
        $ret = array('between', $beginLastweek . "," . $endLastweek);

        return $ret;
    }

//本周
    public function get_thisweek()
    {
        $timestamp = time();
        $beginWeek = strtotime(date('Y-m-d', strtotime("this week Monday", $timestamp)));
        $endWeek = strtotime(date('Y-m-d', strtotime("this week Sunday", $timestamp))) + 24 * 3600 - 1;
        $ret = array('between', $beginWeek . "," . $endWeek);
        return $ret;
    }

    //个人收益
    public function getAmount($user_id, $type, $record_type = '')
    {
        $getAmount = 0;
        $map['user_id'] = $user_id;
        $map['type'] = array('not in', '3');
        if ($type == 1) {
            $map['add_time'] = $this->get_today();
        } else if ($type == 2) {
            $map['add_time'] = $this->get_thismonth();
        }
        if ($record_type) {
            $map['type'] = $record_type;
        }
        $getAmount = Db('user_record')->where($map)->sum('amount');
        return $getAmount;
    }

    public function getUserAmount()
    {
        //今日收益
        $dayamount = $this->getAmount(Session::get('user_id'), 1);
        //本月收益
        $mothamount = $this->getAmount(Session::get('user_id'), 2);
        //累计收益
        $totalamount = $this->getAmount(Session::get('user_id'), 3);
        //推荐奖励
        $tamount = $this->getAmount(Session::get('user_id'), 3, 4);
        //直邀奖励
        $zamount = $this->getAmount(Session::get('user_id'), 3, 1);
        //间邀奖励
        $jamount = $this->getAmount(Session::get('user_id'), 3, 2);
        //服务奖励
        $famount = $this->getAmount(Session::get('user_id'), 3, 5);
        $data = array(
            'dayamount' => number_format($dayamount, 2, ".", ""),
            'mothamount' => number_format($mothamount, 2, '.', ''),
            'totalamount' => number_format($totalamount, 2, '.', ''),
            'tamount' => number_format($tamount, 2, '.', ''),
            'zamount' => number_format($zamount, 2, '.', ''),
            'jamount' => number_format($jamount, 2, '.', ''),
            'famount' => number_format($famount, 2, '.', ''),
        );
        return $data;
    }


    public function getMoth()
    {
        $list = Db('user_record')->where(array('user_id' => Session::get('user_id')))->select();
        $arr = [];
        foreach ($list as $k => $v) {
            array_push($arr, date('Y-m', $v['add_time']));
        }
        $a = array_unique($arr);
        return $a;
    }

    public function searchDate($data)
    {
        if (empty($data['time'])) {
            $data['time'] = date('Y-m-d H:i:s');
        }

        switch ($data['time_type']) {
            case 2:
                // 当前周
                $time = $data['time'];
                $end = date("Y-m-d 23:59:59", strtotime("$time Sunday"));
                $start = date("Y-m-d 00:00:00", strtotime("$end - 6 days"));
                break;
            case 3:
                // 当前月
                $data['time'] = strtotime($data['time']);
                $start = date("Y-m-d H:i:s", mktime(0, 0, 0, date("m", $data['time']), 1, date("Y", $data['time'])));
                $end = date("Y-m-d H:i:s", mktime(23, 59, 59, date("m", $data['time']), date("t", $data['time']), date("Y", $data['time'])));
                break;
            case 4:
                // 当前年
                $year = date('Y');
                $start = $year . "-01-01 00:00:00";
                $end = $year . "-12-31 23:59:59";
                break;
            case 5:
                // 当前天
                $start = $data['time'] . " 00:00:00";
                $end = $data['time1'] . " 23:59:59";
                break;
            default:
                // 当前天
                $start = $data['time'] . " 00:00:00";
                $end = $data['time'] . " 23:59:59";
                break;
        }

        $ret = array('between', strtotime($start) . "," . strtotime($end));
        return $ret;
    }

    public function getTeam()
    {

//        //用户ID
//        $teampage = Config::get('page_num_team');
//        $page = $this->request->param('page');
//        $id = $this->userInfo['id'];
//        //邀请人数
//        $a = db('user')->where(array('pid' => $id, 'level' => ['gt', '0']))->count();
//        $b = db('user')->where(array('p_pid' => $id, 'level' => ['gt', '0']))->count();
//        $teamids = $a + $b;
//        //直邀人
//        $teamz = db('user')->where(array('pid' => $id, 'level' => 1))->select();
//        $teamzcount = count($teamz);
//        //间邀人
//        $teamj = db('user')->where(array('p_pid' => $id, 'level' => 1))->select();
//        $teamjcount = count($teamj);
//        //初级代理
//        $teamcj = db('user')->where(array('p_pid' => $id, 'level' => 2))->select();
//        $teamcj1 = db('user')->where(array('pid' => $id, 'level' => 2))->select();
//        $teamtotalnumcj = count($teamcj) + count($teamcj1);
//        //中级代理
//        $teamzj = db('user')->where(array('p_pid' => $id, 'level' => 3))->select();
//        $teamzj1 = db('user')->where(array('pid' => $id, 'level' => 3))->select();
//        $teamtotalnumzj = count($teamzj) + count($teamzj1);
//        //高级代理
//        $teamgj = db('user')->where(array('p_pid' => $id, 'level' => 4))->select();
//        $teamgj1 = db('user')->where(array('pid' => $id, 'level' => 4))->select();
//        $teamtotalnumgj = count($teamgj) + count($teamgj1);
//        $cj = array_merge($teamcj, $teamcj1);
//        $zj = array_merge($teamzj, $teamzj1);
//        $gj = array_merge($teamgj, $teamgj1);
//        return array(
//            'teamcount' => $teamids,
//            'teamz' => $teamz,
//            'teamzcount' => $teamzcount,
//            'teamj' => $teamj,
//            'teamjcount' => $teamjcount,
//            'teamtotalnumcj' => $teamtotalnumcj,
//            'teamcj' => $cj,
//            'teamtotalnumzj' => $teamtotalnumzj,
//            'teamzj' => $zj,
//            'teamtotalnumgj' => $teamtotalnumgj,
//            'teamgj' => $gj,
//        );


        $id = $this->userInfo['id'];
        //邀请人数
        $a = db('user')->where(array('pid' => $id))->count();
        $b = db('user')->where(array('p_pid' => $id))->count();
        $teamids = $a + $b;
        //直邀人
        $teamz = db('user')->where(array('pid' => $id,'level' => ['gt', '0']))->select();
        $teamzcount = count($teamz);
        //间邀人
        $teamj = db('user')->where(array('p_pid' => $id,'level' => ['gt', '0']))->select();
        $teamjcount = count($teamj);
        //代发展会员
        $f1 = Db('user')->where(array('pid'=>$id,'level' =>0 ))->select();
        $f2 = Db('user')->where(array('p_pid'=>$id,'level' =>0 ))->select();
        $fcount = count($f1) + count($f2);
        $f = array_merge($f1,$f2);
        return array(
            'teamcount' =>$teamids,
            'teamz' =>$teamz,
            'teamzcount' =>$teamzcount,
            'teamj' =>$teamj,
            'teamjcount' =>$teamjcount,
            'fteam' =>$f,
            'fteamcount' =>$fcount,

        );
    }

    public function sharePic($authInfo, $data)
    {
        $shareConfig = [
            'fang' => ROOT_PATH . 'public/static/uploads/avatar/' . $authInfo['openid'] . "_" . $authInfo['id'] . '.jpg',
            'yuan' => ROOT_PATH . 'public/static/uploads/avatar/' . $authInfo['openid'] . "_" . $authInfo['id'] . 'YUAN.jpg',
            'v1' => ROOT_PATH . 'public/static/uploads/avatar/' . $authInfo['openid'] . "_" . $authInfo['id'] . '_SHARE_User.jpg',
            'v2' => ROOT_PATH . 'public/static/uploads/avatar/' . $authInfo['openid'] . "_" . $authInfo['id'] . '_SHARE_DaiLi.jpg',
            'v3' => ROOT_PATH . 'public/static/uploads/avatar/' . $authInfo['openid'] . "_" . $authInfo['id'] . '_SHARE_SiDong.jpg',
        ];
        if ($data['share_level'] == 1) {
            $shareFile = $shareConfig['v1'];
        }
        if ($data['share_level'] == 4) {
            $shareFile = $shareConfig['v1'];
        }
        if ($data['share_level'] == 5) {
            $shareFile = $shareConfig['v1'];
        }
        $config = array(
            'image' => array(
                'logo' => array(
                    'url' => $shareConfig['fang'],
                    'left' => 80, //左位移
                    'top' => 80, //上位移
                    'right' => 0, //右位移
                    'bottom' => 0, //下位移
                    'width' => 25,
                    'height' => 25,
                    'opacity' => 100,
                ),
            ),
            'backgroundMap' => $shareFile,
            'createFile' => true,
            'filePath' => ROOT_PATH . 'public/static/uploads/share/' . $authInfo['openid'] . 'Ext.jpg',
            'fileLink' => './public/static/uploads/share/' . $authInfo['openid'] . 'Ext.jpg',
        );
        $share = createPoster($config);
        $config = array(
            'image' => array(
                'logo' => array(
                    'url' => $share['path'],
                    'left' => 230, //左位移
                    'top' => 840, //上位移
                    'right' => 0, //右位移
                    'bottom' => 0, //下位移
                    'width' => 300,
                    'height' => 300,
                    'opacity' => 100,
                ),
//                'avatar' => array(
//                    'url' => $shareConfig['yuan'],
//                    'left' => 24, //左位移
//                    'top' => 24, //上位移
//                    'right' => 0, //右位移
//                    'bottom' => 0, //下位移
//                    'width' =>50,
//                    'height' =>50,
//                    'opacity' => 100,
//                    'border-radius' => 50
//                ),
            ),
            'text' => array(
                'fontFile' => ROOT_PATH . 'public/static/index/iconn/SourceHanSansCN-Regular.otf',
                'data' => array(
//                    'nickname' => array(
//                        'text' => $authInfo['nick_name'],
//                        'left' => 75, //左位移
//                        'top' => 50, //上位移
//                        'fontSize' => 20, //字号
//                        'fontColor' => '255,255,255', //字体颜色
//                        'angle' => 0,
//                        'forCount' => 1,
//                    ),
                ),
            ),
            'backgroundMap' => $data['share_pic'],
            'createFile' => true,
            'filePath' => ROOT_PATH . 'public/static/uploads/share/' . $authInfo['openid'] . "_" . $data['id'] . "_" . $data['share_level'] . 'ExtHB.jpg',
            'fileLink' => $authInfo['openid'] . "_" . $data['id'] . "_" . $data['share_level'] . 'ExtHB.jpg',
        );
        $dc = createPoster($config);
//        $imgSrc = "http://jinli.sxzywl.net/static/uploads/share/".$dc['val'];
        return $dc;
    }

    /**
     * @param $authInfo
     * @param $link
     * @param $course_id
     * @return mixed
     */
    public function coursesharePic($authInfo, $link, $course_id)
    {
        vendor('phpqrcode.phpqrcode');
        $headimgurl = ROOT_PATH . 'public/static/uploads/avatar/' . $authInfo['openid'] . '.jpg';


        //切园
        $src = ROOT_PATH . 'public/static/uploads/avatar/' . $authInfo['openid'] . 'YUAN.jpg'; //生成二维码图片
        $shareFile = ROOT_PATH . 'public/static/uploads/share/' . $authInfo['openid'] . 'kc.jpg';
        if (!is_file($shareFile)) {
            @unlink($shareFile);
        };
        $Qrcode = \Qrcode::png($link, $shareFile, "L", 5, 2);
        $config = array(
            'image' => array(
                'logo' => array(
                    'url' => $headimgurl,
                    'left' => 70, //左位移
                    'top' => 80, //上位移
                    'right' => 0, //右位移
                    'bottom' => 0, //下位移
                    'width' => 25,
                    'height' => 25,
                    'opacity' => 100,
                ),
            ),
            'backgroundMap' => $shareFile,
            'createFile' => true,
            'filePath' => ROOT_PATH . 'public/static/uploads/share/' . $authInfo['openid'] . 'Extkc.jpg',
            'fileLink' => './public/static/uploads/share/' . $authInfo['openid'] . 'Extkc.jpg',
        );
        $share = createPoster($config);
        $courseinfo = Db('course')->where(array('id' => $course_id))->find();
        $config = array(
            'image' => array(
                'qrcode' => array(
                    'url' => $share['path'],
                    'left' => 38, //左位移
                    'top' => 930, //上位移
                    'right' => 0, //右位移
                    'bottom' => 0, //下位移
                    'width' => 200,
                    'height' => 200,
                    'opacity' => 100,
                ),
                'avatar' => array(
                    'url' => $src,
                    'left' => 38, //左位移
                    'top' => 38, //上位移
                    'right' => 0, //右位移
                    'bottom' => 0, //下位移
                    'width' => 110,
                    'height' => 110,
                    'opacity' => 100,
                    'border-radius' => 50
                ),
                'course_pic' => array(
                    'url' => $courseinfo['course_pic'],
                    'left' => 38, //左位移
                    'top' => 200, //上位移
                    'right' => 0, //右位移
                    'bottom' => 0, //下位移
                    'width' => 880,
                    'height' => 500,
                    'opacity' => 100,
                ),
            ),
            'text' => array(
                'fontFile' => ROOT_PATH . 'public/static/index/iconn/SourceHanSansCN-Regular.otf',
                'data' => array(
                    'nickname' => array(
                        'text' => $authInfo['nick_name'],
                        'left' => 165, //左位移
                        'top' => 80, //上位移
                        'fontSize' => 20, //字号
                        'fontColor' => '0,0,0', //字体颜色
                        'angle' => 0,
                        'forCount' => 1,
                    ),
                    'nicknamebottom' => array(
                        'text' => '邀您一起学习',
                        'left' => 165, //左位移
                        'top' => 130, //上位移
                        'fontSize' => 20, //字号
                        'fontColor' => '0,0,0', //字体颜色
                        'angle' => 0,
                        'forCount' => 1,
                    ),
                    'course_title' => array(
                        'text' => $courseinfo['course_title'],
                        'left' => 38, //左位移
                        'top' => 790, //上位移
                        'fontSize' => 45, //字号
                        'fontColor' => '0,0,0', //字体颜色
                        'angle' => 0,
                        'forCount' => 1,
                    ),
                    'course_num' => array(
                        'text' => $courseinfo['course_look'] . '人已加入学习',
                        'left' => 38, //左位移
                        'top' => 840, //上位移
                        'fontSize' => 30, //字号
                        'fontColor' => '0,0,0', //字体颜色
                        'angle' => 0,
                        'forCount' => 1,
                    )
                ),
            ),
            'backgroundMap' => ROOT_PATH . 'public/static/index/img/bg2.jpg',
            'createFile' => true,
            'filePath' => ROOT_PATH . 'public/static/uploads/share/' . $authInfo['openid'] . '_' . $course_id . '_ExtHBkc.jpg',
            'fileLink' => $authInfo['openid'] . '_' . $course_id . '_ExtHBkc.jpg',
        );
        $dc = createPoster($config);
        return $dc;
    }


    public function getTan()
    {
//        return 1;
        $arr = Cache::get('index_pic')['checkbox'];
        if (in_array($this->userInfo['level'] + 1, $arr)) {
            $map['create_time'] = $this->get_today();
            $map['user_id'] = Session::get('user_id');
            $res = Db('index')->where(array('user_id' => $map['user_id']))->find();
            if ($res) {
                $show = Db('index')->where($map)->find();
                if ($show) {
                    $showAuth = 0;
                } else {
                    Db('index')->where(array('user_id' => $map['user_id']))->update(array('create_time' => time()));
                    $showAuth = 1;
                }
            } else {
                Db('index')->insert(array('user_id' => Session::get('user_id'), 'create_time' => time()));
                $showAuth = 1;
            }
            return $showAuth;
        } else {
            return $showAuth = 0;
        }
    }

    public function CreateShareEquityPic()
    {
        $this->uppSharePic();
    }

//    public function getVipCourse()
//    {
//        $vipCourse = db('course')->where(array('course_isvip' => 1))->find();
//        $IS = DB('order')->where(array('user_id' => Session::get('user_id'), 'course_id' => $vipCourse['id']))->find();
//        if (!$IS) {
//            $courseinfo = db('course_info')->where(array('course_id' => $vipCourse['id']))->select();
//            foreach ($courseinfo as $kk => $vv) {
//                db('user_course')->insert(array('course_id' => $vipCourse['id'], 'course_info_id' => $vv['id'], 'user_id' => Session::get('user_id')));
//            }
//            $order = array(
//                'user_id' => Session::get('user_id'),
//                'money' => 0,
//                'course_id' => $vipCourse['id'],
//                'order_type' => 1,
//                'add_time' => time(),
//                'order_no' => time() . rand(1111111, 9999999),
//                'order_no_remarkes' => '1' . 'course' . rand(1111111, 9999999) . time(),
//                'pay_type' => 1,
//                'course_type'=>4
//
//            );
//            db('order')->insert($order);
//        }
//
//    }


}