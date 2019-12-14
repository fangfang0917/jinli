<?php
// +----------------------------------------------------------------------
// | Info: 微信WebApI类库
// +----------------------------------------------------------------------
// | Author: RigorousMe <1025396319@qq.com>
// +----------------------------------------------------------------------

/**
 * wiki From https://mp.weixin.qq.com/wiki?t=resource/res_main&id=mp1421140183&token=&lang=zh_CN
 * import("@.ORG.WeiXinFun"); //加载文件
 * Class WeiXinFun
 */
class WeiXinFun
{
// +----------------------------------------------------------------------
// | 基本信息设置
// +----------------------------------------------------------------------
    private $config = array(
        'appId' => 0,//公众号开发者ID
        'secret' => 0,//公众号开发者密码
        'mchId' => 0,//商户号
        'key' => 0,//商户支付密钥
        'encodingAesKey' => 0,//消息加解密密钥
        'serviceToken' => 0,//服务器配置令牌
    );
    private $param = array();//请求参数
    private $PayUrl = 'https://api.mch.weixin.qq.com/pay/unifiedorder'; //支付接口链接
// +----------------------------------------------------------------------
// | 类库初始化
// +----------------------------------------------------------------------
    /**
     * WeiXinFun constructor.
     * @param array $param
     */
    public function __construct($param = array(
        'appId' => 0,//公众号开发者ID
        'secret' => 0,//公众号开发者密码
        'mchId' => 0,//商户号
        'key' => 0,//商户支付密钥
        'encodingAesKey' => 0,//消息加解密密钥
        'serviceToken' => 0,//服务器配置令牌
    ))
    {
        if ($param['appId'] != "开发者ID" && strlen($this->removeSpace($param['appId'])) != 0) {
            $this->config['appId'] = $param['appId'];
        }
        if ($param['secret'] != "开发者密码" && strlen($this->removeSpace($param['secret'])) != 0) {
            $this->config['secret'] = $param['secret'];
        }
        if ($param['mchId'] != "商户号" && strlen($this->removeSpace($param['mchId'])) != 0) {
            $this->config['mchId'] = $param['mchId'];
        }
        if ($param['key'] != "商户密钥" && strlen($this->removeSpace($param['key'])) != 0) {
            $this->config['key'] = $param['key'];
        }
        if ($param['encodingAesKey'] != "商户密钥" && strlen($this->removeSpace($param['encodingAesKey'])) != 0) {
            $this->config['encodingAesKey'] = $param['encodingAesKey'];
        }
        if ($param['serviceToken'] != "商户密钥" && strlen($this->removeSpace($param['serviceToken'])) != 0) {
            $this->config['serviceToken'] = $param['serviceToken'];
        }
    }
// +----------------------------------------------------------------------
// | 基础功能
// +----------------------------------------------------------------------
    /**
     * 执行初始化
     * @return mixed
     */
    public function init()
    {
        foreach ($this->config as $k => $v) {
            if ($v === 0) {
                return $this->error($k . '不能为空!');
                break;
            }
        }
        return $this->success($this);
    }

    /**
     * AccessToken 获取
     * @return mixed
     */
    public function WxGetAccessToken()
    {
        // 获取access_token填写client_credential (必须)
        $grant_type = "client_credential";
        $link = "https://api.weixin.qq.com/cgi-bin/token?grant_type=" . $grant_type . "&appid=" . $this->config['appId'] . "&secret=" . $this->config['secret'];
        return $this->JsonDenCode($this->GetCurl($link));
    }


    /**
     * 设置AccessToken缓存
     * @param $path
     * @return mixed
     */
    public function getAccessToken($path = false)
    {
        $path = $path ? $path : __DIR__ . '/wxToken.json';
        if (!is_file($path)) {
            $Tok = $this->WxGetAccessToken();
            $Tok['endTime'] = time() - 30 + $Tok['expires_in'];
            $this->createJsonCache($path, $Tok);
        } else {
            $Tok = $this->readJsonCache($path);
            if (!isset($Tok['endTime']) || $Tok['endTime'] < time()) {
                $Tok = $this->WxGetAccessToken();
                $Tok['endTime'] = time() - 30 + $Tok['expires_in'];
                $this->createJsonCache($path, $Tok);
            }
        }
        return $Tok['access_token'];
    }

    /**
     * JsApiTicket 获取
     * @param $access_token [AccessToken]
     * @return mixed
     */
    public function WxJsApiTicket($access_token)
    {
        // 获取access_token填写client_credential (必须)
        $link = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=" . $access_token . "&type=jsapi";
        return $this->JsonDenCode($this->GetCurl($link));
    }


    /**
     * 设置JsToken缓存
     * @param $path
     * @return mixed
     */
    public function getJsToken($path = false)
    {
        $path = $path ? $path : __DIR__ . '/wxJsToken.json';
        $AccessToken = $this->getAccessToken();
        if (!is_file($path)) {
            $Tok = $this->WxJsapiTicket($AccessToken);
            $Tok['endTime'] = time() - 30 + $Tok['expires_in'];
            $this->createJsonCache($path, $Tok);
        } else {
            $Tok = $this->readJsonCache($path);
            if (!isset($Tok['endTime']) || $Tok['endTime'] < time()) {
                $Tok = $this->WxJsapiTicket($AccessToken);
                $Tok['endTime'] = time() - 30 + $Tok['expires_in'];
                $this->createJsonCache($path, $Tok);
            }
        }
        return $Tok['ticket'];
    }


    /**
     * 创建JS SDK　配置
     * @param $jsApi_ticket
     * @return array
     */
    public function WxInitJsConfig($jsApi_ticket, $url)
    {
        $time = time();
        $noNceStr = $this->roundString(9);
        $data = array(
            'noncestr' => $noNceStr,
            'jsapi_ticket' => $jsApi_ticket,
            'timestamp' => (string)$time,
            'url' => $url,
        );
        $data = $this->formatBizQueryParaMap($data);
        $signature = strtoupper(sha1($data));
        $return = array(
            'appid' => $this->config['appId'],
            'timestamp' => $time,
            'nonceStr' => $noNceStr,
            'signature' => $signature,
            'url' => $url
        );
        return $return;
    }

// +----------------------------------------------------------------------
// | 自动回复-未补全
// +----------------------------------------------------------------------
    /**
     * 设置服务器Token
     * @init
     *  define("TOKEN", $this->weiXinConfig['serviceToken']);
     *  import("@.ORG.WeiXinFun");
     *  $this->WX = new WeiXinFun($this->weiXinConfig); //配置微信
     *  if (isset($_GET["echostr"])){
     *      $this->WX->SetWebServiceForWxToken();
     *  }else {
     *      $this->WX->responseMsg();
     *  }
     */
    public function SetWebServiceForWxToken()
    {
        $echoStr = $_GET["echostr"];
        if ($this->checkSignature()) {
            echo $echoStr;
        }
    }

    /**
     * 验证服务器配置的Token
     * @return bool
     */
    protected function checkSignature()
    {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        $tmpArr = array($this->config['serviceToken'], $timestamp, $nonce);
        // use SORT_STRING rule
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);
        if ($tmpStr == $signature) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 获取用户提交的消息
     * @return mixed
     */
    public function getHttpMsg()
    {
        if (version_compare('5.5', PHP_VERSION, '>')) {
            $postStr = file_get_contents("php://input");
        } else {
            //获取post过来的数据，它一个XML格式的数据
            $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        }

        if (!empty($postStr)) {
            //将XML数据解析为一个数组
            $postArr = $this->xmlToArray($postStr);
            $this->createMsgLog($postArr);
            return $postArr;
        } else {
            $this->createMsgLog(array(
                'MsgType' => 'Error',
            ));
            return array(
                'MsgType' => 'Error',
            );
        }
    }

    /**
     * 接收事件推送
     * @param $arr
     * @param array $msgArr
     * @return string
     */
    public function receiveEvent($arr, $msgArr = array())
    {
        if (count($msgArr) === 0) {
            $msgArr = array(
                'subscribe' => '欢迎关注!',//关注公众号事件
            );
        }
        $content = (isset($msgArr[$arr['Event']])) ? $msgArr[$arr['Event']] : "欢迎关注 ^.^ ";
        $result = $this->returnTextMsg($arr, $content);
        return $result;
    }

    /**
     * 回复文字信息
     * @param $arr
     * @param $content
     * @return string
     */
    public function returnTextMsg($arr, $content)
    {
        $arr = array(
            'ToUserName' => $arr['FromUserName'],
            'FromUserName' => $arr['ToUserName'],
            'CreateTime' => time(),
            'MsgType' => 'text',
            'Content' => $content,
        );
        $this->createMsgLog($arr, '公众号回复');
        return $this->arrayToXml($arr);
    }

    /**
     * 客服文本消息
     * @param $access_token
     * @param $openid
     * @param $content
     * @return mixed
     */
    public function sendKfTextMsg($access_token, $openid, $content)
    {
        $link = 'https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=' . $access_token;
        $postData = array(
            'touser' => $openid,
            'msgtype' => "text",
            'text' => array(
                'content' => $content,
            ),
        );
        return $this->JsonDenCode($this->PostCurl($link, $this->JsonEnCode($postData, 'zh')));
    }

    /**
     * 发送图片客服消息
     * @param $access_token
     * @param $openid
     * @param $file
     * @return mixed
     */
    public function sendKfImageMsg($access_token, $openid, $file)
    {
        if (file_exists($file)) {
            $upp = $this->addMaterial($access_token, "image", $file);
            if (isset($upp['media_id'])) {
                $link = 'https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=' . $access_token;
                $postData = array(
                    'touser' => $openid,
                    'msgtype' => "image",
                    'image' => array(
                        'media_id' => $upp['media_id'],
                    ),
                );
                return $this->JsonDenCode($this->PostCurl($link, $this->JsonEnCode($postData, 'zh')));
            } else {
                return $this->error($upp['errmsg'], $upp['errcode']);
            }
        } else {
            return $this->error("文件资源不存在!");
        }
    }

    /**
     * 上传临时素材
     * @param $access_token
     * @param string $type
     * @param $file
     * @return mixed
     */
    protected function addMaterial($access_token, $type = 'image', $file)
    {
        $link = "https://api.weixin.qq.com/cgi-bin/media/upload?access_token=" . $access_token;
        if (class_exists('\CURLFile')) {
            $filename = new \CURLFile(realpath($file));
        } else {
            $filename = '@' . realpath($file);
        }
        $postData = array(
            'type' => $type,
            'media' => $filename,
        );
        return $this->JsonDenCode($this->PostCurl($link, $postData));
    }

    /**
     * 获取请求信息
     * @param bool $path
     */
    public function getHttpRequest($path = false)
    {
        $path = $path ? $path : __DIR__ . '/httpRequest.xml';
        readfile($path);
    }

    /**
     * 获取聊天内容
     * @param bool $path
     */
    public function getMsgLog($path = false)
    {
        $path = $path ? $path : __DIR__ . '/msgLog.xml';
        readfile($path);
    }

    /**
     * 创建HTTP请求缓存
     * @param $path
     */
    public function createHttpRequest($path = false)
    {
        $path = $path ? $path : __DIR__ . '/httpRequest.xml';
        $arr = array(
            'Time' => date('Y-m-d H:i:s'),
            'RemoteIp' => $_SERVER['REMOTE_ADDR'],
            'Link' => $_SERVER["QUERY_STRING"],
        );
        $this->createXmlCache($path, $arr, 'a');

    }

    /**
     * 创建消息请求缓存
     * @param $arr
     * @param string $type
     * @param bool $path
     */
    public function createMsgLog($arr, $type = '用户', $path = false)
    {
        $path = $path ? $path : __DIR__ . '/msgLog.xml';
        $arr['Time'] = date('Y-m-d H:i:s');
        $arr['Type'] = $type;
        $this->createXmlCache($path, $arr, 'a');

    }


// +----------------------------------------------------------------------
// | 模板消息推送
// +----------------------------------------------------------------------
    /**
     * wxMsg 微信推送消息
     * @param $access_token [调用接口凭证]
     * @param $data [发送数据]
     * @param $template_id [模板ID]
     * @param $openid [已关注公众号用户的openid]
     * @param string $url [返回发送结果]
     * @param string $topColor
     * @return mixed
     */
    public function wxMsg($access_token, $data, $template_id, $openid, $url = '', $topColor = '#FF0000')
    {
        $link = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=' . $access_token;
        $postData = array(
            'touser' => $openid,
            'template_id' => $template_id,
            'topcolor' => $topColor,
            'data' => $data,
            'url' => $url
        );
        return $this->JsonDenCode($this->PostCurl($link, $this->JsonEnCode($postData)));
    }


// +----------------------------------------------------------------------
// | 个性化菜单管理
// +----------------------------------------------------------------------
    /**
     * 获取所有菜单数据
     * @param $access_token
     * @return mixed
     */
    public function wxGetMenuList($access_token)
    {
        $link = 'https://api.weixin.qq.com/cgi-bin/menu/get?access_token=' . $access_token;
        return $this->JsonDenCode($this->GetCurl($link));
    }

    /**
     * 创建公共菜单
     * @param $access_token
     * @param array $menu
     * @return mixed
     */
    public function wxCreatePublicMenu($access_token, $menu = array())
    {
        $link = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token=' . $access_token;
        $postData = array(
            'button' => $menu,
        );
        return $this->JsonDenCode($this->PostCurl($link, $this->JsonEnCode($postData, 'zh')));
    }

    /**
     * 创建自定义菜单
     * @param $access_token
     * @param array $menu
     * @param array $rule
     * @return mixed
     */
    public function wxCreatePersonalityMenu($access_token, $menu = array(), $rule = array("language" => "zh_CN",))
    {
        $link = 'https://api.weixin.qq.com/cgi-bin/menu/addconditional?access_token=' . $access_token;
        $postData = array(
            'button' => $menu,
            'matchrule' => $rule,
        );
        return $this->JsonDenCode($this->PostCurl($link, $this->JsonEnCode($postData, 'zh')));
    }

    /**
     * 自定义菜单测试
     * @param $access_token
     * @param $openid
     * @return mixed
     */
    public function wxTestPersonalityMenu($access_token, $openid)
    {
        $link = 'https://api.weixin.qq.com/cgi-bin/menu/trymatch?access_token=' . $access_token;
        $postData = array(
            'user_id' => $openid,
        );
        return $this->JsonDenCode($this->PostCurl($link, $this->JsonEnCode($postData)));
    }

    /**
     * 删除个性化菜单
     * @param $access_token
     * @param $menuId
     * @return mixed
     */
    public function wxDelPersonalityMenu($access_token, $menuId)
    {
        $link = 'https://api.weixin.qq.com/cgi-bin/menu/delconditional?access_token=' . $access_token;
        $postData = array(
            'menuid' => $menuId,
        );
        return $this->JsonDenCode($this->PostCurl($link, $this->JsonEnCode($postData)));
    }

// +----------------------------------------------------------------------
// | 标签管理
// +----------------------------------------------------------------------
    /**
     * 获取标签列表
     * @param $access_token
     * @return mixed
     */
    public function wxGetTags($access_token)
    {
        $link = 'https://api.weixin.qq.com/cgi-bin/tags/get?access_token=' . $access_token;
        return $this->JsonDenCode($this->GetCurl($link));
    }


    /**
     * 创建用户标签
     * @param $access_token
     * @param $tagName
     * @return mixed
     */
    public function wxCreateTag($access_token, $tagName)
    {
        $link = 'https://api.weixin.qq.com/cgi-bin/tags/create?access_token=' . $access_token;
        $postData = array(
            'tag' => array(
                'name' => $tagName,
            ),
        );
        return $this->JsonDenCode($this->PostCurl($link, $this->JsonEnCode($postData, 'zh')));
    }

    /**
     * 编辑标签
     * @param $access_token
     * @param $tagId
     * @param $tagName
     * @return mixed
     */
    public function wxExidTag($access_token, $tagId, $tagName)
    {

        $link = 'https://api.weixin.qq.com/cgi-bin/tags/update?access_token=' . $access_token;
        $postData = array(
            'tag' => array(
                'id' => $tagId,
                'name' => $tagName,
            ),
        );
        return $this->JsonDenCode($this->PostCurl($link, $this->JsonEnCode($postData, 'zh')));
    }

    /**
     * 删除标签
     * @param $access_token
     * @param $tagId
     * @return mixed
     */
    public function wxDelTag($access_token, $tagId)
    {
        $link = 'https://api.weixin.qq.com/cgi-bin/tags/delete?access_token=' . $access_token;
        $postData = array(
            'tag' => array(
                'id' => $tagId,
            ),
        );
        return $this->JsonDenCode($this->PostCurl($link, $this->JsonEnCode($postData)));

    }

    /**
     * 获取标签下粉丝列表
     * @param $access_token
     * @param $tagId
     * @param $next_openid
     * @return mixed
     */
    public function wxGetTagUserList($access_token, $tagId, $next_openid = false)
    {
        $link = 'https://api.weixin.qq.com/cgi-bin/user/tag/get?access_token=' . $access_token;
        if ($next_openid) {
            $postData = array(
                'tagid' => $tagId,
                'next_openid' => $next_openid,
            );

        } else {
            $postData = array(
                'tagid' => $tagId,
            );
        }
        return $this->JsonDenCode($this->PostCurl($link, $this->JsonEnCode($postData)));
    }

    /**
     * 批量为用户打标签
     * 标签功能目前支持公众号为用户打上最多20个标签。
     * @param string $access_token
     * @param array $openid_list
     * @param int $tagId
     * @return mixed
     */
    public function wxTagToUserCreate($access_token, $openid_list = array(), $tagId)
    {
        $link = 'https://api.weixin.qq.com/cgi-bin/tags/members/batchtagging?access_token=' . $access_token;
        $openid_list[] = 'oIgtT5k7FZgTDBzFMFxSbxZfRulo';
        $postData = array(
            'openid_list' => $openid_list,
            'tagid' => $tagId,
        );
        return $this->JsonDenCode($this->PostCurl($link, $this->JsonEnCode($postData)));
    }

    /**
     * 批量为用户取消标签
     * @param string $access_token
     * @param array $openid_list
     * @param int $tagId
     * @return mixed
     */
    public function wxTagToUserDel($access_token, $openid_list = array(), $tagId)
    {
        $link = 'https://api.weixin.qq.com/cgi-bin/tags/members/batchuntagging?access_token=' . $access_token;
        $postData = array(
            'openid_list' => $openid_list,
            'tagid' => $tagId,
        );
        return $this->JsonDenCode($this->PostCurl($link, $this->JsonEnCode($postData)));
    }

    /**
     * 获取用户身上的标签列表
     * @param $access_token
     * @param $openid
     * @return mixed
     */
    public function wxGetUserTags($access_token, $openid)
    {
        $link = 'https://api.weixin.qq.com/cgi-bin/tags/getidlist?access_token=' . $access_token;
        $postData = array(
            'openid' => $openid,
        );
        return $this->JsonDenCode($this->PostCurl($link, $this->JsonEnCode($postData)));
    }

// +----------------------------------------------------------------------
// | 用户管理
// +----------------------------------------------------------------------
    /**
     * 获取关注用户列表
     * @param $access_token
     * @param bool $next_openid
     * @return mixed
     */
    public function wxGetUserList($access_token, $next_openid = false)
    {

        $link = "https://api.weixin.qq.com/cgi-bin/user/get?access_token=" . $access_token;
        if ($next_openid) {
            $link .= '&next_openid=' . $next_openid;
        }
        return $this->JsonDenCode($this->GetCurl($link));
    }

    /**
     * 获取用户基本信息
     * @param $access_token [access_token]
     * @param $openid [用户Openid]
     * @return mixed
     */
    public function wxGetUserShow($access_token, $openid)
    {
        $lang = "zh_CN";
        $link = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=" . $access_token . "&openid=" . $openid . "&lang=" . $lang;
        return $this->JsonDenCode($this->GetCurl($link));
    }

    /**
     * 批量获取用户基本信息
     * @param string $access_token [access_token]
     * @param array $user_list [用户Openid]
     * @return mixed
     */
    public function wxGetListUsersShow($access_token, $user_list = array())
    {
        $link = "https://api.weixin.qq.com/cgi-bin/user/info/batchget?access_token==" . $access_token;
        $postData['user_list'] = array();
        foreach ($user_list as $k => $v) {
            $postData['user_list'][] = array(
                'openid' => $v,
                'lang' => 'zh_CN',
            );
        }
        return $this->JsonDenCode($this->PostCurl($link, $this->JsonEnCode($postData)));
    }

// +----------------------------------------------------------------------
// | 微信支付
// +----------------------------------------------------------------------
    /**
     * 微信支付相关函数
     * @todo
     * ----------------------------------------------JsApi-------------------------------------------------------------------
     *          $this->WX->setParam("openid", "openId"); //OpenId 唯一标识
     *          $this->WX->setParam("body", "Body"); // 介绍信息
     *          $wxSn = date("YmdHis") . rand_string(8, 1) . time();
     *          $this->WX->setParam("out_trade_no", $wxSn); // 订单号
     *          $payFree = $add['price'] * 100;
     *          $payFree = 1;
     *          $this->WX->setParam("total_fee", $payFree); // 支付金额
     *          $this->WX->setParam("notify_url", SERVER_HOST . "/notify_url.php"); // 回调地址
     *          $this->WX->setParam("trade_type", "JSAPI"); // 支付类型
     *          $this->WX->setParamArr(array(
     *              ......
     *          ));
     *          $payId = $this->WX->getPayPrepayId();
     *          if ($payId['status'] == 0) {
     *              $this->ajaxReturn(array(
     *                  'status' => 0,
     *                  'info' => $payId['info'],
     *              ));
     *          }
     *          $payId = $payId['data']['prepay_id'];
     *          $this->WX->setParam('prepay_id', $payId); //支付接口得到的预支付id
     *          $payInfo = $this->WX->getPayParam('array');
     */

    /**
     * 生成支付接口参数xml
     */
    public function createPayXml()
    {
        if ($this->isWeiXin() == false) {
            return $this->error('请在微信浏览器使用!');
        }
        if (!isset($this->param['trade_type'])) {
            return $this->error("缺少统一支付接口必填参数trade_type");
        }
        if (!isset($this->param['out_trade_no'])) {
            return $this->error("缺少统一支付接口必填参数out_trade_no");
        }
        if (!isset($this->param['body'])) {
            return $this->error("缺少统一支付接口必填参数body");
        }
        if (!isset($this->param['total_fee'])) {
            return $this->error("缺少统一支付接口必填参数total_fee");
        }
        if (!isset($this->param['notify_url'])) {
            return $this->error("缺少统一支付接口必填参数notify_url");
        }
        if ($this->param['trade_type'] == 'JSAPI' && !isset($this->param['openid'])) {
            return $this->error("统一支付接口中,trade_type为JSAPI时,openid为必填参数");
        }
//        if ($this->param['NATIVE'] == 'JSAPI' && !isset($this->param['product_id'])) {
//            return $this->error("统一支付接口中,trade_type为JSAPI时,product_id为必填参数");
//        }
        $this->param["appid"] = $this->config['appId']; //公众账号ID
        $this->param["mch_id"] = $this->config['mchId']; //商户号
        $this->param["spbill_create_ip"] = $_SERVER['REMOTE_ADDR']; //终端ip
        $this->param["nonce_str"] = $this->roundString(); //随机字符串
        $this->param["sign"] = $this->getSign($this->param); //签名
        return $this->success($this->arrayToXml($this->param));
    }

    /**
     * 获取prepay_id
     * @return mixed
     */
    public function getPayPrepayId()
    {
        $postData = $this->createPayXml();
        if ($postData['status'] == 0) {
            return $postData;
        }
        $req = $this->PostCurl($this->PayUrl, $postData['data']);
        $req = $this->xmlToArray($req);
        if (!isset($req['prepay_id'])) {
            return $this->error("获取失败");
        } else {
            $this->param['prepay_id'] = $req["prepay_id"];
            return $this->success(array(
                'prepay_id' => $req["prepay_id"],
            ), '获取成功');
        }
    }

    /**
     * 设置jsApi的参数
     * @param string $type
     * @return false|string
     */
    public function getPayParam($type = "json")
    {
        $jsApiObj["appId"] = $this->param['appid'];
        $jsApiObj["timeStamp"] = "'" . time() . "'";
        $jsApiObj["nonceStr"] = $this->roundString();
        $jsApiObj["package"] = "prepay_id=" . $this->param['prepay_id'];
        $jsApiObj["signType"] = "MD5";
        $jsApiObj["paySign"] = $this->getSign($jsApiObj);
        switch ($type) {
            case "json":
                $ret = $this->JsonEnCode($jsApiObj);
                break;
            case "array":
                $ret = $jsApiObj;
                break;
            default:
                $ret = $this->JsonEnCode($jsApiObj);
                break;
        }
        return $ret;
    }

// +----------------------------------------------------------------------
// | 微信授权登录
// +----------------------------------------------------------------------
    /**
     * 第一步：用户同意授权，获取code
     * 在确保微信公众账号拥有授权作用域（scope参数）的权限的前提下（服务号获得高级接口后，默认拥有scope参数中的snsapi_base和snsapi_userinfo）
     * @param $redirect_uri [授权后重定向的回调链接地址，请使用urlEncode对链接进行处理]
     * @param string $snsapi_base [
     *      snsapi_base 应用授权作用域， (必须) snsapi_base （不弹出授权页面，直接跳转，只能获取用户openid），
     *      snsapi_userinfo （弹出授权页面，可通过openid拿到昵称、性别、所在地。并且，即使在未关注的情况下，只要用户授权，也能获取其信息）
     * ]
     * @info 如果用户同意授权，页面将跳转至 $redirect_uri/?code=CODE&state=$state
     */
    public function wxGetCode($redirect_uri, $snsapi_base = 'snsapi_userinfo')
    {
        // 重定向后会带上state参数，开发者可以填写a-zA-Z0-9的参数值，最多128字节 (非必需)
        $state = time();
        // 无论直接打开还是做页面302重定向时候，必须带此参数 (必须)
        $wechat_redirect = "#wechat_redirect";
        // 拼接跳转链接
        $link = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=" . $this->config['appId'] . "&redirect_uri=" . urlencode($redirect_uri) . "&response_type=code&scope=" . $snsapi_base . "&state=" . $state . $wechat_redirect;
        // 跳转授权链接
        header("Location: $link");
    }

    /**
     * 第二步：通过code换取网页授权access_token
     * 这里通过code换取的是一个特殊的网页授权access_token,与基础支持中的access_token（该access_token用于调用其他接口）不同。
     * 公众号可通过下述接口来获取网页授权access_token。
     * 如果网页授权的作用域为snsapi_base，则本步骤中获取到网页授权access_token的同时，也获取到了openid，snsapi_base式的网页授权流程即到此为止。
     * @param $code [填写第一步获取的code参数]
     * @return mixed
     */
    public function wxCodeExchangeForAccessToken($code)
    {
        //填写为 authorization_code (必须)
        $grant_type = "authorization_code";
        $link = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=" . $this->config['appId'] . "&secret=" . $this->config['secret'] . "&code=" . $code . "&grant_type=" . $grant_type;
        return $this->JsonDenCode($this->GetCurl($link));
    }


    /**
     * 第三步：刷新access_token（如果需要）
     * 由于access_token拥有较短的有效期，当access_token超时后，
     * 可以使用refresh_token进行刷新，refresh_token有效期为30天，
     * 当refresh_token失效之后，需要用户重新授权。
     * @param $refresh_token [填写通过access_token获取到的refresh_token参数]
     * @return mixed
     */
    public function wxAccessTokenRefresh($refresh_token)
    {
        //填写为 refresh_token (必须)
        $grant_type = "refresh_token";
        $link = "https://api.weixin.qq.com/sns/oauth2/refresh_token?appid=" . $this->config['appId'] . "&grant_type=" . $grant_type . "&refresh_token=" . $refresh_token;
        return $this->JsonDenCode($this->GetCurl($link));
    }

    /**
     * 第四步：拉取用户信息(需scope为 snsapi_userinfo)
     * 如果网页授权作用域为snsapi_userinfo，则此时开发者可以通过access_token和openid拉取用户信息了。
     * @param $access_token [网页授权接口调用凭证,注意：此access_token与基础支持的access_token不同]
     * @param $openid [用户的唯一标识]
     * @return mixed
     */
    public function wxGetUserInfo($access_token, $openid)
    {
        $lang = "zh_CN";
        $link = "https://api.weixin.qq.com/sns/userinfo?access_token=" . $access_token . "&openid=" . $openid . "&lang=" . $lang;
        return $this->JsonDenCode($this->GetCurl($link));
    }

    /**
     * 附：检验授权凭证（access_token）是否有效
     * @param $access_token [网页授权接口调用凭证,注意：此access_token与基础支持的access_token不同]
     * @param $openid [用户的唯一标识]
     * @return mixed
     */
    public function wxCheckAccessToken($access_token, $openid)
    {
        $link = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=" . $access_token . "&openid=" . $openid;
        return $this->JsonDenCode($this->GetCurl($link));
    }

// +----------------------------------------------------------------------
// | 内参设置
// +----------------------------------------------------------------------
    /**
     * 设置请求参数
     * @param $k
     * @param $v
     */
    public function setParam($k, $v)
    {
        $this->param[$this->trimString($k)] = $this->trimString($v);
    }

    /**
     * 批量设置请求参数
     * @param $arr
     */
    public function setParamArr($arr)
    {
        if (is_array($arr) && count($arr) > 0) {
            foreach ($arr as $k => $v) {
                $this->param[$this->trimString($k)] = $this->trimString($v);
            }
        }
    }

    /**
     * 获取设置的参数
     * @return array
     */
    public function getParam()
    {
        return $this->param;
    }


    /**
     * 作用：生成签名
     * @param $Obj
     * @return string
     */
    protected function getSign($Obj)
    {
        $Parameters = array();
        foreach ($Obj as $k => $v) {
            $Parameters[$k] = $v;
        }
        //签名步骤一：按字典序排序参数
        ksort($Parameters);
        $String = $this->formatBizQueryParaMap($Parameters, false);
        //签名步骤二：在string后加入KEY
        $String = $String . "&key=" . $this->config['key'];
        //签名步骤三：MD5加密
        $String = md5($String);
        //签名步骤四：所有字符转为大写
        $result_ = strtoupper($String);
        return $result_;
    }

    /**
     * 作用：格式化参数，签名过程需要使用
     * @param $paraMap
     * @param $urlEnCode
     * @return bool|string|null
     */
    protected function formatBizQueryParaMap($paraMap, $urlEnCode = false)
    {
        $buff = "";
        ksort($paraMap);
        foreach ($paraMap as $k => $v) {
            if ($urlEnCode) {
                $v = urlencode($v);
            }
            $buff .= $k . "=" . $v . "&";
        }
        $reqPar = null;
        if (strlen($buff) > 0) {
            $reqPar = substr($buff, 0, strlen($buff) - 1);
        }
        return $reqPar;
    }

// +----------------------------------------------------------------------
// | 公共函数
// +----------------------------------------------------------------------
    /**
     * 获取当前URL
     * @return null|string|string[]
     */
    public function curPageURL()
    {
        $pageURL = 'http';
//        var_dump($_SERVER);
        if (isset($_SERVER["HTTPS"])) {
            $pageURL .= "s";
        }
        $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
        }
        return $this->removeSpace($pageURL);
    }

    /**
     * 检测是否是微信浏览器
     * @return bool
     */
    public function isWeiXin()
    {
        if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
            return true;
        }
        return false;
    }

    /**
     * 创建Json缓存
     * @param $file
     * @param $arr
     * @param $type
     * @param $max_size
     * @return bool
     */
    public function createJsonCache($file, $arr, $type = 'w+', $max_size = false)
    {
        $max_size = $max_size ? $max_size : (1024 * 1024 * 5);
        if (file_exists($file) and (abs(filesize($file)) > $max_size)) {
            unlink($file);
        }
        $fp = fopen($file, $type);
        $string = json_encode($arr, true);
        if ($type != 'w+') {
            $string .= "\n";
        }
        fwrite($fp, $string);
        fclose($fp);
        return true;
    }

    /**
     * 读取Json缓存
     * @param $file
     * @return mixed
     */
    public function readJsonCache($file)
    {
        $fp = fopen($file, 'r');
        $arr = json_decode(fread($fp, filesize($file)), true);
        fclose($fp);
        return $arr;
    }

    /**
     * 创建Xml缓存
     * @param $file
     * @param $arr
     * @param $type
     * @param $max_size
     * @return bool
     */
    public function createXmlCache($file, $arr, $type = 'w+', $max_size = false)
    {
        $max_size = $max_size ? $max_size : (1024 * 1024 * 5);
        if (file_exists($file) and (abs(filesize($file)) > $max_size)) {
            unlink($file);
        }
        $fp = fopen($file, $type);
        $string = $this->arrayToXml($arr);
        if ($type != 'w+') {
            $string .= "\n";
        }
        fwrite($fp, $string);
        fclose($fp);
        return true;
    }

    /**
     * 获取文件缓存内容
     * @param $file
     */
    public function readCache($file)
    {
        if (is_file($file)) {
            readfile($file);
        } else {
            echo "Null";
        }
    }


    /**
     * GetCurl 模拟GET请求
     * @param $link
     * @return bool|string
     */
    public function GetCurl($link)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $link);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

    /**
     * PostCurl 模拟POST请求
     * @param $link
     * @param $data
     * @return bool|string
     */
    public function PostCurl($link, $data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_TIMEOUT, 300);
        curl_setopt($ch, CURLOPT_URL, $link);
        curl_setopt($ch, CURLOPT_SAFE_UPLOAD, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);//严格校验
//        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);//设置请求头
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


    /**
     * 作用：产生随机字符串，不长于32位
     * @param int $length
     * @return string
     */
    public function roundString($length = 32)
    {
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }

    /**
     * 设置字符串
     * @param $value
     * @return null
     */
    public function trimString($value)
    {
        $ret = null;
        if (null != $value) {
            $ret = $value;
            if (strlen($ret) == 0) {
                $ret = null;
            }
        }
        return $ret;
    }


    /**
     * 重复调用函数，利用php原生函数处理数据信息 Json转数组
     * @param $json
     * @return mixed
     */
    public function JsonDenCode($json)
    {
        return json_decode($json, true);
    }

    /**
     * 重复调用函数，利用php原生函数处理数据信息 数组转Json
     * @param $arr
     * @param $options
     * @return false|string
     */
    public function JsonEnCode($arr, $options = 'def')
    {
        switch ($options) {
            case "def":
                $json = json_encode($arr);
                break;
            case 'zh':
                $json = $this->decodeUnicode(json_encode($arr));
                break;
            default:
                $json = json_encode($arr);
                break;
        }
        return $json;
    }


    /**
     * json中避免中文转义
     * @param $str
     * @return string|string[]|null
     */
    public function decodeUnicode($str)
    {
        return preg_replace_callback('/\\\\u([0-9a-f]{4})/i',
            create_function(
                '$matches',
                'return mb_convert_encoding(pack("H*", $matches[1]), "UTF-8", "UCS-2BE");'
            ),
            $str);
    }

    /**
     * 作用：array转xml
     * @param $arr
     * @return string
     */
    public function arrayToXml($arr)
    {
        if (!is_array($arr) || count($arr) <= 0) {
            die("数组数据异常！");
        }
        $xml = "<xml>\n";
        foreach ($arr as $key => $val) {
            if (is_numeric($val)) {
                $xml .= "\t<" . $key . ">" . $val . "</" . $key . ">" . "\n";
            } else {
                $xml .= "\t<" . $key . "><![CDATA[" . $val . "]]></" . $key . ">" . "\n";
            }
        }
        $xml .= "</xml>\n";
        return $xml;
    }

    /**
     * 作用：将xml转为array
     * @param $xml
     * @return mixed
     */
    public function xmlToArray($xml)
    {
        //将XML转为array
        $array_data = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
        return $array_data;
    }

    /**
     * @param $var
     * @param bool $echo
     * @param null $label
     * @param bool $strict
     * @return false|mixed|string|string[]|null
     */
    public function dump($var, $echo = true, $label = null, $strict = true)
    {
        $label = ($label === null) ? '' : rtrim($label) . ' ';
        if (!$strict) {
            if (ini_get('html_errors')) {
                $output = print_r($var, true);
                $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
            } else {
                $output = $label . print_r($var, true);
            }
        } else {
            ob_start();
            var_dump($var);
            $output = ob_get_clean();
            if (!extension_loaded('xdebug')) {
                $output = preg_replace('/\]\=\>\n(\s+)/m', '] => ', $output);
                $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
            }
        }
        if ($echo) {
            echo($output);
            return null;
        } else {
            return $output;
        }
    }

    /**
     * 删除空格
     * @param $str
     * @return string|string[]|null
     */
    public function removeSpace($str)
    {
        $str = trim($str);
        $str = preg_replace('# #', '', $str);
        return $str;
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
    protected function error($info = '处理失败,信息未定义!', $code = '00000001')
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
    protected function success($data = array(), $info = '处理成功,信息未定义!', $code = '10000000')
    {
        $ret['info'] = $info;
        $ret['status'] = 1;
        $ret['code'] = $code;
        $ret['data'] = $data;
        return $ret;
    }

}