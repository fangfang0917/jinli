<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:80:"/www/wwwroot/jinli.sxzywl.net/public/../application/index/view/user/equity1.html";i:1572059080;s:81:"/www/wwwroot/jinli.sxzywl.net/public/../application/index/view/template/base.html";i:1572341503;}*/ ?>
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
    
<link rel="stylesheet" type="text/css" href="__STATIC__/index/ydui/css/ydui.css?v=<?php echo time(); ?>">
<link rel="stylesheet" type="text/css" href="__STATIC__/index/css/agent.css?v=<?php echo time(); ?>">

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
</head>
<body class="<?php echo isset($body_class) ? $body_class : 'nullBodyClass'; ?> <?php echo $controller.'_'.$action; ?>"
      style="background: #fff;box-sizing: border-box;width: 100%" data-phone="<?php echo $rigU['phone']; ?>" data-level="<?php echo $rigU['level']; ?>">



<div class="app">
    <div class="g-view">
        <div class="topSuspension">
            <img src="__STATIC__/index/img/horn.png" alt="">
            <p>同意平台协议后才可开通</p>
            <img id="deleteTop" src="__STATIC__/index/img/cross.png" alt="">
        </div>
        <!-- 轮播 -->
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?php if(is_array($sharelevel) || $sharelevel instanceof \think\Collection || $sharelevel instanceof \think\Paginator): $i = 0; $__LIST__ = $sharelevel;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <div class="swiper-slide">
                    <img src="<?php echo $vo['bimg']; ?>" class="main-img">
                    <img class="vipImg" src="<?php echo $vo['img']; ?>" alt="">
                    <div class="exclusiveVIP">
                        <p style="color:#894E12;font-size:16px;width:85%;margin:0 auto;"><?php echo $vo['content']; ?></p>
                        <p style="color:#894E12;font-size:10px;width:85%;margin:0 auto;margin-top:8px;">
                            <span style="color:#894E12;font-size:15px;">￥<?php echo $vo['vip_money']; ?></span>
                            <span style="color:#A58146;font-size:12px;"><?php if($vo['level'] == $userInfo['level']): ?>已开通<?php else: ?>未开通<?php endif; ?></span>
                        </p>
                    </div>
                    <!-- 进度条 -->
                    <?php if(!in_array($vo['level'],[1,5])): ?>
                    <div class="level">
                        <div class="levelVIP"><?php echo $vo['before_title']; ?></div>
                        <div class="progress-bar">
                            <div class="progress" style="width:<?php echo $vo['my_share_num']/$vo['share_num']*100; ?>%"></div>
                        </div>
                        <div class="levelOne"><?php echo $vo['next_title']; ?></div>
                        <div style="color:#894E12;margin-left:0.1rem;">人数<?php echo $vo['my_share_num']; ?>/<?php echo $vo['share_num']; ?></div>
                    </div>
                    <div class="open">
                        <span style=" width: 0.5rem; height: .3rem;background:#fff;color:#E1B876;border-radius:10%;text-align: center">升级</span>
                        <p style="color:#A58146;margin-right: .4rem;"><?php echo $vo['left_bottom_title']; ?></p>
                       <p class="topUp">
                        <?php if($vo['level']==$userInfo['level']): ?>
                        <a style="width:1.5rem;height:0.4rem;background:rgba(193,144,85,1);border-radius:12px;font-size:12px;font-weight:400;color: rgba(255,255,255,0.7);line-height: 0.4rem;text-align: center;"
                           href="javascript:;">已开通</a>
                        <?php else: if(($vo['share_num'] - $vo['my_share_num']) <= 0): ?>
                        <a style="width:1.5rem;height:0.4rem;background:rgba(193,144,85,1);border-radius:12px;font-size:12px;font-weight:400;color: rgba(255,255,255,0.7);line-height: 0.4rem;text-align: center;"
                           href="javascript:levelUpNotBuy('<?php echo $vo['level']; ?>');">免费升级</a>
                        <?php else: ?>
                        <a style="width:1.5rem;height:0.4rem;background:rgba(193,144,85,1);border-radius:12px;font-size:12px;font-weight:400;color: rgba(255,255,255,0.7);line-height: 0.4rem;text-align: center;"
                           href="javascript:levelUp('<?php echo $vo['level']; ?>');">立即充值</a>
                        <?php endif; endif; ?>
                       </p>
                    </div>
                    <?php else: ?>
                    <div class="open">
                        <p style="color:#A58146;margin-right: .4rem;"><?php echo $vo['left_bottom_title']; ?></p>
                        <p  class="topUp">
                        <?php if($vo['level'] == 1): if($vo['level']==$userInfo['level']): ?>
                        <a style="width:1.5rem;height:0.4rem;background:rgba(193,144,85,1);border-radius:12px;font-size:12px;font-weight:400;color: rgba(255,255,255,0.7);line-height: 0.4rem;text-align: center;"
                           href="javascript:;">已开通</a>
                        <?php else: ?>
                        <a style="width:1.5rem;height:0.4rem;background:rgba(193,144,85,1);border-radius:12px;font-size:12px;font-weight:400;color: rgba(255,255,255,0.7);line-height: 0.4rem;text-align: center;"
                           href="javascript:buyVip();">立即充值</a>
                        <?php endif; else: if($vo['level']==$userInfo['level']): ?>
                        <a style="width:1.5rem;height:0.4rem;background:rgba(193,144,85,1);border-radius:12px;font-size:12px;font-weight:400;color: rgba(255,255,255,0.7);line-height: 0.4rem;text-align: center;"
                           href="javascript:;">已开通</a>
                        <?php else: ?>
                        <a style="width:1.5rem;height:0.4rem;background:rgba(193,144,85,1);border-radius:12px;font-size:12px;font-weight:400;color: rgba(255,255,255,0.7);line-height: 0.4rem;text-align: center;"
                           href="javascript:levelUp('<?php echo $vo['level']; ?>');">立即充值</a>
                        <?php endif; endif; ?>
                        </p>
                    </div>
                    <?php endif; ?>
                    <!-- 升级 -->
                </div>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>
        <!-- 协议 -->
        <div class="agreement">
            <label>
                <input name="chk" type="checkbox" style="appearance:checkbox;-moz-appearance:checkbox;-webkit-appearance:checkbox;">
                <span style="color:#999999;font-size:14px;margin-left:0.2rem;">同意遵循</span>
                <span style="color:#1490E9;font-size:14px;">《锦鲤MoM平台收费协议》</span>
            </label>
        </div>
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
        <a href="javascript:;">
            <img src="<?php echo Cache('index_pic')['index_pic']?>"/>
        </a>
    </div>
    <div class="Shut" __close data-for="alert_a|bg">
        <img src="__STATIC__/index/img/guanbi.png" alt="">
    </div>
</div>


<!--礼包弹窗-->
<div class="upgrade-tk">
    <div class="upgrade-tktap">
        <h2><span>365</span>大礼包</h2>
    </div>
    <div class="upgrade-tkhide">
        <img src="__STATIC__/index/img/chacha.png">
    </div>
    <div class="upgrade-tktop">
        <div class="upgrade-t">
            <div class="upgrade-colo">福利一</div>
            <h2>VIP年卡</h2>
        </div>
        <div class="upgrade-b">
            <img src="__STATIC__/index/img/card_vip.png">
        </div>
    </div>
    <div class="upgrade-tkcon">
        <div class="upgrade-t">
            <div class="upgrade-colo">福利二</div>
            <h2>精品课豪华礼包（10选5）</h2>
        </div>
        <div class="upgrade-tab mian">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <?php if(isset($libaocourse)): if(count($libaocourse)>0): if(is_array($libaocourse) || $libaocourse instanceof \think\Collection || $libaocourse instanceof \think\Paginator): $i = 0; $__LIST__ = $libaocourse;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <div class="swiper-slide">
                        <div class="upgrade-imgbox"><img src="<?php echo $vo['course_pic']; ?>"></div>
                        <div class="upgrade-txt"><?php echo $vo['course_title']; ?></div>
                        <div class="upgrade-state" data-id="<?php echo $vo['id']; ?>">已选</div>
                    </div>
                    <?php endforeach; endif; else: echo "" ;endif; endif; endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="upgrade-tkbot">
        赠送课程可在个人中心→我的课程中找到
    </div>
    <div class="upgrade-butbox">
        <a href="javascript:;" class="upgrade-but">
            确认完成
        </a>
    </div>
</div>

<div class="bag-box alert_a" style="display: none" data-auth="hz">
    <div class="vip-biaoti">恭喜您成为锦鲤VIP</div>
    <div class="vip-img">
        <img id="VIPZ1" src="__STATIC__/index/img/vip_v1_icon.png" style="display: none">
        <img id="VIPZ2" src="__STATIC__/index/img/vip_v2_icon.png" style="display: none">
        <img id="VIPZ3" src="__STATIC__/index/img/vip_v3_icon.png" style="display: none">
        <img id="VIPZ4" src="__STATIC__/index/img/vip_v4_icon.png" style="display: none">
        <img id="VIPZ5" src="__STATIC__/index/img/vip_v5_icon.png" style="display: none">
    </div>
    <div class="bag-box-top bgnone dalibao" style="display: none">
        <div class="bag-box-bot bag-pannd">
            <a href="javascript:succbuyvip();">
                领取大礼包
            </a>
        </div>
    </div>
    <div class="bag-box-top bgnone close" style="display: none">
        <div class="bag-box-bot bag-pannd">
            <a href="/index/user/index.html">
                确定
            </a>
        </div>
    </div>
    <div class="bag-box-none" __close data-for="alert_a|bg">
        <img src="__STATIC__/index/img/chacha.png">
    </div>
</div>

<div class="bag-box alert_a" style="display:none;" data-auth="qy">
    <div class="bag-box-top">
        <div class="bag-box-tab">
            锦鲤尊贵VIP
        </div>
        <div class="bag-box-con">
            <div class="bag-box-con-top">
                <div class="bag-box-con-equity">
                    权益一
                </div>
                <div class="bag-box-con-equity">
                    权益一
                </div>
            </div>
            <div class="bag-box-con-bot">
                <div class="bag-box-con-equity">
                    权益一
                </div>
                <div class="bag-box-con-equity">
                    权益一
                </div>
            </div>
        </div>
        <div class="bag-box-bot">
            <a href="javascript:succbuyvip();">
                查看我的礼包
            </a>
        </div>
    </div>
    <div class="bag-box-none" __close data-for="alert_a|bg">
        <img src="__STATIC__/index/img/guanbi.png">
    </div>
</div>


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
    .layui-layer-hui{
        background:rgba(245,245,245,1);
        color:#000000;
    }
</style>
<script type="text/javascript" src="__STATIC__/index/js/dropload.js?v=<?php echo time(); ?>"></script>

<script type="text/javascript" src="__STATIC__/index/ydui/js/ydui.flexible.js?v=<?php echo time(); ?>"></script>
<script type="text/javascript" src="__STATIC__/index/ydui/js/ydui.js?v=<?php echo time(); ?>"></script>
<script type="text/javascript" src="__STATIC__/index/js/user.js?v=<?php echo time(); ?>"></script>

<script type="text/javascript" src="__STATIC__/index/js/wx.js?v=<?php echo time(); ?>"></script>
<script type="text/javascript" src="__STATIC__/index/js/mian.js?v=<?php echo time(); ?>"></script>
</body>
</html>