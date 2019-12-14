<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/16
 * Time: 10:35
 */

//namespace app\index\controller;
namespace app\index\controller;

use think\Config;
use think\response\Redirect;
use think\Loader;
use think\Session;
use think\Db;
use think\Exception;
use think\View;
use think\Request;

class Login
{
    use \traits\controller\Jump;
    /**
     * weixin配置
     */
    protected $WxConifg;
    protected $WX;
    protected $jsToken;
    protected $accToken;
    protected $view;
    /**
     * @var Request Request实例
     */
    protected $request;

    public function __construct()
    {
        include_once ROOT_PATH . 'public' . DS . 'wx' . DS . 'WeiXinFun.class.php';
        $this->WxConifg = array(
            'appId' => Config::get('appid'),//公众号开发者ID
            'secret' => Config::get('appsecret'),//公众号开发者密码
            'mchId' => Config::get('mchId'),//商户号
            'key' => Config::get('key'),//商户支付密钥
            'encodingAesKey' => Config::get('encodingAesKey'),//消息加解密密钥
            'serviceToken' => Config::get('serviceToken'),//服务器配置令牌-9*-0
        );
        $this->WX = new \WeiXinFun($this->WxConifg); //配置微信
        //请求令牌`
        $this->accToken = $this->WX->getAccessToken();
        //jsApI令牌curPageURL
        $this->jsToken = $this->WX->getJsToken();

        if (null === $this->view) {
            $this->view = View::instance(Config::get('template'), Config::get('view_replace_str'));
        }
        if (null === $this->request) {
            $this->request = Request::instance();
        }
        if (Session::has('user_id')) {
            return $this->redirect('index/index');
        }
    }


    public function checkLogin()
    {

        if ($this->WX->isWeiXin()) {
            $nowUrl = $this->WX->curPageURL();
            $code = $this->request->param('code') ? $this->request->param('code') : 0;
            if ($code === 0) {
                $this->WX->wxGetCode($nowUrl);
            } else {
                $auth = $this->WX->wxCodeExchangeForAccessToken($code);
                $authInfo = $this->WX->wxGetUserInfo($auth['access_token'], $auth['openid']);
                $userInfo = db('user')->where(array('openid' => $authInfo['openid']))->field(array('id', 'level', 'head'))->find();
                if ($userInfo) {
                    if ($authInfo['headimgurl'] != $userInfo['head']) {
                        downloadavatar($authInfo['headimgurl'], ROOT_PATH . 'public/static/uploads/avatar/' . $authInfo['openid'] . '.jpg');
                        yuanimg($authInfo['headimgurl'], ROOT_PATH . 'public/static/uploads/avatar/' . $authInfo['openid'] . 'YUAN.jpg');
                    }
                    Session::set('user_id', $userInfo['id']);
                    return $this->redirect('index/index');
                } else {
                    $this->regist($authInfo);
                }
            }
        }
    }

    public function regist($userinfo)
    {
        $data['add_time'] = time();
        $data['head_type'] = 1;
        $data['openid'] = $userinfo['openid'];
        $data['nick_name'] = $userinfo['nickname'];
        $data['head'] = $userinfo['headimgurl'];
        $data['sex'] = $userinfo['sex'];
        $data['pid'] = Session::get('pid');
        if (Session::get('pid') != 0) {
            $data['lintime'] = time();
        }
        $id = db('user')->insertGetId($data, false, true);
        Session::set('user_id', $id);
        Session::delete('pid');
        downloadavatar($userinfo['headimgurl'], ROOT_PATH . 'public/static/uploads/avatar/' . $userinfo['openid'] . '.jpg');
        yuanimg($userinfo['headimgurl'], ROOT_PATH . 'public/static/uploads/avatar/' . $userinfo['openid'] . 'YUAN.jpg');
        return $this->redirect('index/index');
    }

    public function setlevelup($data, $id)
    {
        if (isset($data['pid'])) {
            db('user')->where(array('id' => $data['pid']))->setInc('share_num', 1);
            $p_user = db('user')->where(array('id' => $data['pid']))->field(array('pid', 'level', 'share_num', 'id', 'path'))->find();
            if ($data['pid'] == 0) {
                $newpath = 0;
            } else {
                $newpath = $p_user['path'] . ',' . $p_user['id'];
            }

            db('user')->where(array('id' => $id))->data(array('p_pid' => $p_user['pid'], 'path' => $newpath))->update();
            if ($p_user['level'] > 0) {
                if ($p_user['level'] == 1) {
                    if ($p_user['share_num'] >= 10) {
                        $levelup = array('level' => 2, 'level_up_time' => time(), 'share_num' => 0);
                        db('user')->where(array('id' => $p_user['id']))->update($levelup);
                    }
                } elseif ($p_user['level'] == 2) {
                    if ($p_user['share_num'] >= 50) {
                        $levelup = array('level' => 3, 'level_up_time' => time(), 'share_num' => 0);
                        db('user')->where(array('id' => $p_user['id']))->update($levelup);
                    }
                } elseif ($p_user['level'] == 3) {
                    if ($p_user['share_num'] >= 150) {
                        $levelup = array('level' => 4, 'level_up_time' => time(), 'share_num' => 0);
                        db('user')->where(array('id' => $p_user['id']))->update($levelup);
                    }
                }
            }
            $pp_user = db('user')->where(array('id' => $p_user['pid']))->find();
//            dump($pp_user);
            if ($pp_user['pid'] != 0) {
                db('user')->where(array('id' => $pp_user['pid']))->setInc('share_num', 1);
                if ($pp_user['level'] > 0) {
                    if ($pp_user['level'] == 1) {
                        if ($pp_user['share_num'] >= 10) {
                            $levelup = array('level' => 2, 'level_up_time' => time(), 'share_num' => 0);
                            db('user')->where(array('id' => $pp_user['id']))->update($levelup);
                        }
                    } elseif ($pp_user['level'] == 2) {
                        if ($pp_user['share_num'] >= 50) {
                            $levelup = array('level' => 3, 'level_up_time' => time(), 'share_num' => 0);
                            db('user')->where(array('id' => $pp_user['id']))->update($levelup);
                        }
                    } elseif ($pp_user['level'] == 3) {
                        if ($pp_user['share_num'] >= 150) {
                            $levelup = array('level' => 4, 'level_up_time' => time(), 'share_num' => 0);
                            db('user')->where(array('id' => $pp_user['id']))->update($levelup);
                        }
                    }
                }
            }

        }
    }
}