<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:83:"/www/wwwroot/jinli.sxzywl.net/public/../application/index/view/user/equityshow.html";i:1576222645;s:81:"/www/wwwroot/jinli.sxzywl.net/public/../application/index/view/template/base.html";i:1576205312;}*/ ?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--标题-->
    <title><?php echo $title; ?></title>
    <!--简介-->
    <meta name="description" content="description"/>
    <!--关键词-->
    <meta name="keywords" content="keywords"/>
    <!--顶部页面小图标-->
    <!-- <link rel="stylesheet" href="./ydui/css/ydui.css" /> -->
    <link rel="shortcut icon" href="__STATIC__/index/static/favicon.ico">
    <link rel="stylesheet" type="text/css" href="__STATIC__/index/css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="__STATIC__/index/css/mian.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="__STATIC__/index/zy-media/zy.media.css">
    <link rel="stylesheet" type="text/css" href="__STATIC__/index/swiper/css/swiper.css">
    <link rel="stylesheet" type="text/css" href="__STATIC__/index/css/dropload.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="__STATIC__/index/css/mobileSelect.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="__STATIC__/index/icon/iconfont.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="__STATIC__/index/css/rig.css?v=<?php echo time(); ?>">
    
<link rel="stylesheet" type="text/css" href="__STATIC__/index/css/sc.css?v=<?php echo time(); ?>">

    <script type="text/javascript" src="__STATIC__/index/js/url.js?v=<?php echo time(); ?>"></script>
    <script src="https://res.wx.qq.com/open/js/jweixin-1.4.0.js"></script>
    <script type="text/javascript" src="__STATIC__/index/js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="__STATIC__/index/js/layer/2.4/layer.js"></script>
    <script type="text/javascript" src="__STATIC__/index/swiper/js/swiper.min.js"></script>
    <script type="text/javascript" src="__STATIC__/index/zy-media/zy.media.js"></script>
    <script>
        var wxCofnigData = {
            debug: false, //是否 开启调试模式,建议调试的时候debug 改为true
            appId: "<?php echo $jsonConfig['appid']; ?>",
            timestamp: <?php echo $jsonConfig['timestamp']; ?>,
            nonceStr: "<?php echo $jsonConfig['nonceStr']; ?>",
            signature: "<?php echo $jsonConfig['signature']; ?>",
        };
        var shareTitle = "<?php echo $shareConfig['shareTitle']; ?>";
        var shareDesc = "<?php echo $shareConfig['shareDesc']; ?>";
        var shareUrl = "<?php echo $shareConfig['shareUrl']; ?>";
        var shareIcon = "<?php echo $shareConfig['shareIcon']; ?>";
        function setCache(key, val) {
            return localStorage.setItem(key, val);
        }
        function getCache(key) {
            return localStorage.getItem(key);
        }
    </script>
    <style>
        .vertical {
            font-size: .3rem;
            position: fixed;
            top: 30%;
            width: 100%;
            text-align: center;
        }
    </style>
</head>
<body class="<?php echo isset($body_class) ? $body_class : 'nullBodyClass'; ?> <?php echo $controller.'_'.$action; ?>"
      <?php if(isset($body_background)): if($body_background): ?>
          style="background: url(<?php echo $body_background; ?>);background-size: 100% 100%;"
          <?php else: ?>
             style="background: #fff;box-sizing: border-box;width: 100%"
      <?php endif; else: if(isset($body_background_color)): ?>
style="background:<?php echo $body_background_color; ?>;box-sizing: border-box;width: 100%"

<?php else: ?>
style="background: #fff;box-sizing: border-box;width: 100%"

<?php endif; endif; ?>data-phone="<?php echo $rigU['phone']; ?>" data-level="<?php echo $rigU['level']; ?>" data-ua="<?php echo $equipmentType; ?>" data-card = <?php echo $rigU['card']; ?>>
<div class="vertical" style="display: none;">为了保证您的体验效果,请保持竖屏幕访问</div>
<div class="app-main">
    
    
    
<div class="zxjcontent">
    <div class="topimg"><a href="<?php echo url('user/equityinfo',array('type'=>6)); ?>"><img src="__STATIC__/index/img/home/vip-zxj-detail.png" alt=""></a></div>
    <div class="innersolution">
        <div class="zxjdone">
            <div class="zxj-tag">VIP会员·解决方案</div>
            <div class="bot-zxj">
                <div class="left-zxj"><img src="__STATIC__/index/img/home/vip-zxj-1.png" alt=""></div>
                <div class="right-zxj">
                    <p class="ptitle">会员礼包+基础创富权益</p>
                    <div class="zxj-buy">
                        <p><?php echo isset($sys['vip_money']) ? $sys['vip_money'] :  0; ?>元</p>
                        <!--<a href="javascript:buyVip();">立即购买></a>-->
                        <?php if($userInfo['level'] < 1): ?>
                        <a href="javascript:;"  data-level="1">立即购买></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="zxjdone">
            <div class="zxj-tag">白银会员·解决方案</div>
            <div class="bot-zxj">
                <div class="left-zxj"><img src="__STATIC__/index/img/home/vip-zxj-2.png" alt=""></div>
                <div class="right-zxj">
                    <p class="ptitle">初级唤醒师执行课礼包+会员礼包+初级创富权益</p>
                    <div class="zxj-buy">
                        <p><?php echo isset($sys['vip_team_money_up']) ? $sys['vip_team_money_up'] :  0; ?>元</p>
                        <!--<a href="javascript:levelUp(2);">立即购买></a>-->
                        <?php if($userInfo['level'] < 2): ?>
                        <a href="javascript:;" data-level="2">立即购买></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="zxjdone">
            <div class="zxj-tag">黄金会员·解决方案</div>
            <div class="bot-zxj">
                <div class="left-zxj"><img src="__STATIC__/index/img/home/vip-zxj-3.png" alt=""></div>
                <div class="right-zxj">
                    <p class="ptitle">中级唤醒师执行课礼包+会员礼包+中级创富权益</p>
                    <div class="zxj-buy">
                        <p><?php echo isset($sys['vip_team1_money_up']) ? $sys['vip_team1_money_up'] :  0; ?>元</p>
                        <!--<a href="javascript:levelUp(3);">立即购买></a>-->
                        <?php if($userInfo['level']<3): ?>
                        <a href="javascript:;" data-level="3">立即购买></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="zxjdone">
            <div class="zxj-tag">铂金会员·解决方案</div>
            <div class="bot-zxj">
                <div class="left-zxj"><img src="__STATIC__/index/img/home/vip-zxj-4.png" alt=""></div>
                <div class="right-zxj">
                    <p class="ptitle">高级唤醒师执行课礼包+会员礼包+高级创富权益</p>
                    <div class="zxj-buy">
                        <p><?php echo isset($sys['vip_team2_money_up']) ? $sys['vip_team2_money_up'] :  0; ?>元</p>
                        <!--<a href="javascript:levelUp(4);">立即购买></a>-->
                        <?php if($userInfo['level']<4): ?>
                        <a href="javascript:;" data-level="4">立即购买></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="zxjdone">
            <div class="zxj-tag">钻石会员·解决方案</div>
            <div class="bot-zxj">
                <div class="left-zxj"><img src="__STATIC__/index/img/home/vip-zxj-5.png" alt=""></div>
                <div class="right-zxj">
                    <p class="ptitle">唤醒导师课程礼包+超级创富权益</p>
                    <div class="zxj-buy">
                        <p><?php echo isset($sys['vip_team3_money_up']) ? $sys['vip_team3_money_up'] :  0; ?>元</p>
                        <!--<a href="javascript:setAgent();">立即申请></a>-->
                        <?php if($userInfo['level'] < 5): ?>
                        <a href="javascript:;" data-level="5">立即购买></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="zxj-know">
        <p class="ptitle">购买须知：</p>
        <p class="pone">1.以上为会员产品，点击进入可以查看会员相应权益介绍；</p>
        <p class="pone"> 2.购买后，相应的课程，会在我的课程中展示，请在我的课程中查看；</p>
        <p class="pone"> 3.线下课程部分，需要预约时间上课，购买后请联系客服确认上课时间；</p>
        <p class="pone"> 4.客服微信：geniusmini 备注： 锦鲤妈妈。</p>
    </div>
</div>

<div class="FenXiang-duize-tanchuang" style="z-index:9999">
    <div class="FenXiang-duize-tanchuang-top">
        <h1>锦鲤MOM平台收费协议</h1>
        <p class="zxj-ptwo"><input id="checkbox" type="checkbox"><span>阅读并同意</span><a href="javascript:;">《锦鲤MoM平台收费协议》</a></p>
        <div class="innertc">
            <p class="pone">1.本产品为锦鲤妈妈付费会员产品，有效期为一年，高级会员身份及创富权益永久有效。</p>
            <p class="pone">2.本产品包含虚拟内容服务，一经购买成功，概不退款，请您理解。</p>
            <p class="pone">3.购买前，请阅读平台付费协议，了解权益详情。</p>
            <p class="pone">4.若有疑问，可联系客服咨询。微信号：geniusmini 备注：锦鲤妈妈</p>
         </div>

        <div class="FenXiang-duize-tanchuang-hide" onclick="closeq()"></div>
    </div>
    <div class="FenXiang-duize-tanchuang-con" style="text-align: left"><ul>
    </ul>

    </div>
</div>




    <!--遮罩层-->
    <div class="bg on" _cou></div>
    <!--四叶草小图标-->
    <div class="floating-box">
        <img src="__STATIC__/index/img/caidan.png">
    </div>
    <!--菜单组件-->
    <div class="floating-nav alert_a" _hide>
        <div class="floating-nav-top">
            <a href="<?php echo url('index/index'); ?>">
                <div class="floating-img">
                    <img src="__STATIC__/index/img/mm1.png">
                </div>
                <span>锦鲤MoM</span>
            </a>
            <a href="<?php echo url('user/index'); ?>">
                <div class="floating-img">
                    <img src="__STATIC__/index/img/ge.png">
                </div>
                <span>个人中心</span>
            </a>
            <a href="javascript:;" _rwm
               onclick="showtop('<?php echo $Customer['wxgz']; ?>','锦鲤MoM','长按识别二维码关注公众号')">
                <div class="floating-img">
                    <img src="__STATIC__/index/img/cai.png">
                </div>
                <span>进入公众号</span>
            </a>
        </div>
        <div class="floating-nav-bot" __close data-for="alert_a|bg">关闭</div>
    </div>
    <!--每日弹窗组件-->
    <div class="popup-img alert_a" data-showAuth="<?php echo isset($showAuth) ? $showAuth : '0'; ?>" style="display: none;">
        <div class="popup-imgbox">
            <a href="<?php if(isset($index_pic_url)): ?><?php echo $index_pic_url; else: ?>javascript:;<?php endif; ?>">
                <img src="<?php if(isset($index_url)): ?><?php echo $index_url; endif; ?>"/>
            </a>
        </div>
        <div class="Shut" __close data-for="alert_a|bg">
            <img src="__STATIC__/index/img/guanbi.png" alt="">
        </div>
    </div>
    <div class="content-textbox">
        <div class="content-box">
            <div class="content-text">
                <textarea maxlength="140" placeholder="优质评论将会被优先展示" id="liuyanText"></textarea>
                <div class="content-number">
                    <span class="showinfo-numder">0</span>/<span>140</span>
                </div>
            </div>
        </div>
        <div class="touming"></div>
        <button class="content-but" style="z-index: 1111">发送</button>
    </div>
    <!--礼包弹窗-->
    <!--<div class="upgrade-tk">-->
        <!--<div class="upgrade-tktap">-->
            <!--<h2><span>365</span>大礼包</h2>-->
        <!--</div>-->
        <!--<div class="upgrade-tkhide">-->
            <!--<img src="__STATIC__/index/img/chacha.png">-->
        <!--</div>-->
        <!--<div class="upgrade-tktop">-->
            <!--<div class="upgrade-t">-->
                <!--<div class="upgrade-colo">福利一</div>-->
                <!--<h2>VIP年卡</h2>-->
            <!--</div>-->
            <!--<div class="upgrade-b">-->
                <!--<img src="__STATIC__/index/img/card_vip.png">-->
            <!--</div>-->
        <!--</div>-->
        <!--<div class="upgrade-tkcon">-->
            <!--<div class="upgrade-t">-->
                <!--<div class="upgrade-colo">福利二</div>-->
                <!--<h2>精品课豪华礼包（10选5）</h2>-->
            <!--</div>-->
            <!--<div class="upgrade-tab mian">-->
                <!--<div class="swiper-container">-->
                    <!--<div class="swiper-wrapper">-->
                        <!--<?php if(isset($libaocourse)): ?>-->
                        <!--<?php if(count($libaocourse)>0): ?>-->
                        <!--<?php if(is_array($libaocourse) || $libaocourse instanceof \think\Collection || $libaocourse instanceof \think\Paginator): $i = 0; $__LIST__ = $libaocourse;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>-->
                        <!--<div class="swiper-slide">-->
                            <!--<div class="upgrade-imgbox"><img src="<?php echo $vo['course_pic']; ?>"></div>-->
                            <!--<div class="upgrade-txt"><?php echo $vo['course_title']; ?></div>-->
                            <!--<div class="upgrade-state" data-id="<?php echo $vo['id']; ?>">已选</div>-->
                        <!--</div>-->
                        <!--<?php endforeach; endif; else: echo "" ;endif; ?>-->
                        <!--<?php endif; ?>-->
                        <!--<?php endif; ?>-->
                    <!--</div>-->
                <!--</div>-->
            <!--</div>-->
        <!--</div>-->
        <!--<div class="upgrade-tkbot">-->
            <!--赠送课程可在个人中心→我的课程中找到-->
        <!--</div>-->
        <!--<div class="upgrade-butbox">-->
            <!--<a href="javascript:;" class="upgrade-but">-->
                <!--确认完成-->
            <!--</a>-->
        <!--</div>-->
    <!--</div>-->

    <div class="bag-box alert_a vip_succ" style="display: none" data-auth="hz">
        <!--<div class="vip-biaoti">恭喜您成为锦鲤VIP</div>-->
        <a href="<?php echo url('order/index'); ?>">
        <div class="vip-img" style="width: 0;margin: 0">
            <img id="VIPZ1" src="__STATIC__/index/img/home/vip_succ1.png" style="display: none;width: 5.53rem;height: 7.5rem">
            <img id="VIPZ2" src="__STATIC__/index/img/home/vip_succ2.png" style="display: none;width: 5.53rem;height: 7.5rem">
            <img id="VIPZ3" src="__STATIC__/index/img/home/vip_succ3.png" style="display: none;width: 5.53rem;height: 7.5rem">
            <img id="VIPZ4" src="__STATIC__/index/img/home/vip_succ4.png" style="display: none;width: 5.53rem;height: 7.5rem">
            <img id="VIPZ5" src="__STATIC__/index/img/home/vip_succ5.png" style="display: none;width: 5.53rem;height: 7.5rem">
        </div>
        </a>
        <!--<div class="bag-box-top bgnone dalibao" style="display: none">-->
            <!--<div class="bag-box-bot bag-pannd">-->
                <!--&lt;!&ndash;<a href="javascript:succbuyvip();">&ndash;&gt;-->
                    <!--&lt;!&ndash;领取大礼包&ndash;&gt;-->
                <!--&lt;!&ndash;</a>&ndash;&gt;-->
            <!--</div>-->
        <!--</div>-->
        <!--<div class="bag-box-top bgnone close" style="display: none">-->
            <!--<div class="bag-box-bot bag-pannd">-->
                <!--<a href="/index/user/index.html">-->
                    <!--确定-->
                <!--</a>-->
            <!--</div>-->
        <!--</div>-->
        <!--<div class="bag-box-none" __close data-for="alert_a|bg">-->
            <!--<img src="__STATIC__/index/img/chacha.png">-->
        <!--</div>-->
    </div>

    <!--<div class="bag-box alert_a" style="display:none;" data-auth="qy">-->
        <!--<div class="bag-box-top">-->
            <!--<div class="bag-box-tab">-->
                <!--锦鲤尊贵VIP-->
            <!--</div>-->
            <!--<div class="bag-box-con">-->
                <!--<div class="bag-box-con-top">-->
                    <!--<div class="bag-box-con-equity">-->
                        <!--权益一-->
                    <!--</div>-->
                    <!--<div class="bag-box-con-equity">-->
                        <!--权益一-->
                    <!--</div>-->
                <!--</div>-->
                <!--<div class="bag-box-con-bot">-->
                    <!--<div class="bag-box-con-equity">-->
                        <!--权益一-->
                    <!--</div>-->
                    <!--<div class="bag-box-con-equity">-->
                        <!--权益一-->
                    <!--</div>-->
                <!--</div>-->
            <!--</div>-->
            <!--<div class="bag-box-bot">-->
                <!--&lt;!&ndash;<a href="javascript:succbuyvip();">&ndash;&gt;-->
                    <!--&lt;!&ndash;查看我的礼包&ndash;&gt;-->
                <!--&lt;!&ndash;</a>&ndash;&gt;-->
            <!--</div>-->
        <!--</div>-->
        <!--<div class="bag-box-none" __close data-for="alert_a|bg">-->
            <!--<img src="__STATIC__/index/img/guanbi.png">-->
        <!--</div>-->
    <!--</div>-->


    <div class="rwm alert_a" _cou>
        <div class="rwm-bot" __close data-for="alert_a|bg">
            <img src="__STATIC__/index/img/chacha.png" alt="">
        </div>
        <div class="rwm-box">
            <div class="rwm-t">
                <h2></h2>
            </div>
            <div class="rwm-img">
                <img src=''/>
            </div>
            <div class="rwm-b">
                <span></span>
            </div>
        </div>
    </div>
    <style>
        .layui-layer-hui {
            background: rgba(245, 245, 245, 1);
            color: #000000;
        }
    </style>
    <!--购买成功开始-->
    <!--<div class="Gocourse" hidden>-->
        <!--<div class="zxj-buysuc">-->
            <!--<div class="done">-->
                <!--<img src="" alt="">-->
                <!--<p>购买成功</p>-->
            <!--</div>-->
            <!--<a href="javascript:;">进入课程</a>-->
            <!--<div class="joinwx">-->
                <!--<p class="pone">长按二维码添加小助手微信</p>-->
                <!--<img src="" alt="">-->
                <!--<p class="ptwo">请添加小鲤客服微信：geniusmini,加入社群</p>-->
            <!--</div>-->
        <!--</div>-->
    <!--</div>-->

    <!--购买成功结束-->




</div>
<script type="text/javascript" src="__STATIC__/index/js/dropload.js?v=<?php echo time(); ?>"></script>
<script type="text/javascript" src="__STATIC__/index/js/wx.js?v=<?php echo time(); ?>"></script>
<script type="text/javascript" src="__STATIC__/index/js/mian.js?v=<?php echo time(); ?>"></script>

</body>
</html>