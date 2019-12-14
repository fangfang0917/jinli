<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:79:"/www/wwwroot/jinli.sxzywl.net/public/../application/index/view/user/equity.html";i:1571969463;s:81:"/www/wwwroot/jinli.sxzywl.net/public/../application/index/view/template/base.html";i:1573136692;}*/ ?>
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
    
<link rel="stylesheet" type="text/css" href="__STATIC__/index/css/agent.css?v=<?php echo time(); ?>">
<style>
    .privilege-bannerbox {
        width: 100%;
        height: 100%;
        background-image: url("__STATIC__/index/img/vip_card_def.png?v=<?php echo time(); ?>");
        background-size: 100% 100%;
        border-radius: 9px;
        position: relative;
        margin-bottom: .2rem;
        min-height: 3.8rem;
    }
    .privilege-bannerbox.privilege-bannerbox-sidong{
        background-image: url("__STATIC__/index/img/vip_card_sd.png?v=<?php echo time(); ?>");
    }

</style>

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
      <?php endif; else: ?>
style="background: #fff;box-sizing: border-box;width: 100%"
<?php endif; ?>data-phone="<?php echo $rigU['phone']; ?>" data-level="<?php echo $rigU['level']; ?>" data-ua="<?php echo $equipmentType; ?>">
<div class="vertical" style="display: none;">为了保证您的体验效果,请保持竖屏幕访问</div>
<div class="app-main">
    
    
    
<div class="privilege-body">
    <!-- 轮播 -->
    <div class="privilege-banner privilege-bannerb">
        <div class="swiper-wrapper">
            <?php if(in_array($level,[0,1])): ?>
            <div class="swiper-slide">
                <div class="privilege-bannerbox">
                    <div class="privilege-con">
                        <div class="privilege-con-left">
                            <img class="privilege-con-left-icon w-100" src="__STATIC__/index/img/vip_v1_icon.png?v=<?php echo time(); ?>">
                        </div>
                        <div class="privilege-con-txt">
                            <div class="privilege-con-top">
                                365专属VIP
                            </div>
                            <div class="privilege-con-bot">
                                <div class="privilege-com-left">￥<?php if(isset($sys)): ?><?php echo $sys['vip_money']; else: ?>0.00<?php endif; ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="privilege-bon privilege-bon-btw">
                        <span>VIP享受超值权益</span>
                        <?php if($level == 0): ?>
                        <a href="javascript:buyVip();">立即开通</a>
                        <?php endif; if($level == 1): ?>
                        <a href="javascript:;">已开通</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endif; if(in_array($level,[1,2,3])): ?>
                <div class="swiper-slide">
                    <div class="privilege-bannerbox">
                        <div class="privilege-con">
                            <div class="privilege-con-left">
                                <img class="privilege-con-left-icon w-100" src="__STATIC__/index/img/vip_v2_icon.png?v=<?php echo time(); ?>">
                            </div>
                            <div class="privilege-con-txt">
                                <div class="privilege-con-top">
                                    院长
                                </div>
                                <div class="privilege-con-bot">
                                    <div class="privilege-com-left">￥<?php echo isset($sys['vip_team_money_up']) ? $sys['vip_team_money_up'] :  0.00; ?><span>未开通</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="privilege-tiao">
                            <div class="privilege-tiao-left">VIP</div>
                            <div class="privilege-tiaobox">
                                <div class="privilege-tiaobox-top" style="width: <?php echo $userinfo['share_num']/$sys['agent_num']*100; ?>%"></div>
                            </div>
                            <div class="privilege-tiao-right">院长</div>
                            <span>人数 <?php echo $userinfo['share_num']; ?>/<?php echo $sys['agent_num']; ?></span>
                        </div>
                        <div class="privilege-bon">
                            <div class="privilege-bon-top">
                                <div class="privilege-bon-left">升级</div>
                                <span>再推荐<?php echo $sys['agent_num']-$userinfo['share_num']; ?>人可免费升级</span>
                            </div>
                            <?php if(in_array($level,[1,2,3])): if($userinfo['share_num'] >= $sys['agent_num']): ?>
                            <a href="javascript:levelUpNotBuy('2');">立即开通</a>
                            <?php else: ?>
                            <a  href="javascript:levelUp('2');">立即开通</a>
                            <?php endif; elseif($level == 2): ?>
                            <a href="javascript:;">已开通</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="privilege-bannerbox">
                        <div class="privilege-con">
                            <div class="privilege-con-left">
                                <img class="privilege-con-left-icon w-100" src="__STATIC__/index/img/vip_v3_icon.png?v=<?php echo time(); ?>" alt="">
                            </div>
                            <div class="privilege-con-txt">
                                <div class="privilege-con-top">
                                    联创
                                </div>
                                <div class="privilege-con-bot">
                                    <div class="privilege-com-left">￥<?php echo isset($sys['vip_team1_money_up']) ? $sys['vip_team1_money_up'] :  0.00; ?><span>未开通</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="privilege-tiao">
                            <div class="privilege-tiao-left">VIP</div>
                            <div class="privilege-tiaobox">
                                <div class="privilege-tiaobox-top" style="width: <?php echo $userinfo['share_num']/$sys['cagent_num']*100; ?>%"></div>
                            </div>
                            <div class="privilege-tiao-right">中级</div>
                            <span>人数 <?php echo $userinfo['share_num']; ?>/<?php echo $sys['cagent_num']; ?></span>
                        </div>
                        <div class="privilege-bon">
                            <div class="privilege-bon-top">
                                <div class="privilege-bon-left">升级</div>
                                <span>再推荐<?php echo $sys['cagent_num']-$userinfo['share_num']; ?>人可免费升级</span>
                            </div>
                            <?php if(in_array($level,[1,2,3])): if($userinfo['share_num'] >= $sys['cagent_num']): ?>
                            <a href="javascript:levelUpNotBuy('3');">立即开通</a>
                            <?php else: ?>
                            <a  href="javascript:levelUp('3');">立即开通</a>
                            <?php endif; elseif($level == 3): ?>
                            <a href="javascript:;">已开通</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="privilege-bannerbox">
                        <div class="privilege-con">
                            <div class="privilege-con-left">
                                <img class="privilege-con-left-icon w-100" src="__STATIC__/index/img/vip_v4_icon.png?v=<?php echo time(); ?>" alt="">
                            </div>
                            <div class="privilege-con-txt">
                                <div class="privilege-con-top">
                                    合伙人尊享卡
                                </div>
                                <div class="privilege-con-bot">
                                    <div class="privilege-com-left">￥<?php echo isset($sys['vip_team2_money_up']) ? $sys['vip_team2_money_up'] :  0.00; ?><span>未开通</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="privilege-tiao">
                            <div class="privilege-tiao-left">VIP</div>
                            <div class="privilege-tiaobox">
                                <div class="privilege-tiaobox-top" style="width: <?php echo $userinfo['share_num']/$sys['zagent_num']*100; ?>%"></div>
                            </div>
                            <div class="privilege-tiao-right">高级</div>
                            <span>人数 <?php echo $userinfo['share_num']; ?>/<?php echo $sys['zagent_num']; ?></span>
                        </div>
                        <div class="privilege-bon">
                            <div class="privilege-bon-top">
                                <div class="privilege-bon-left">升级</div>
                                <span>再推荐<?php echo $sys['zagent_num']-$userinfo['share_num']; ?>人可免费升级</span>
                            </div>

                            <?php if(in_array($level,[1,2,3])): if($userinfo['share_num'] >= $sys['zagent_num']): ?>
                            <a href="javascript:levelUpNotBuy('4');">立即开通</a>
                            <?php else: ?>
                            <a  href="javascript:levelUp('4');">立即开通</a>
                            <?php endif; elseif($level == 4): ?>
                            <a href="javascript:;">已开通</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; if($level == 4): ?>
            <div class="swiper-slide">
                <div class="privilege-bannerbox">
                    <div class="privilege-con">
                        <div class="privilege-con-left">
                            <img class="privilege-con-left-icon w-100" src="__STATIC__/index/img/vip_v4_icon.png?v=<?php echo time(); ?>" alt="">
                        </div>
                        <div class="privilege-con-txt">
                            <div class="privilege-con-top">
                                合伙人尊享卡
                            </div>
                            <div class="privilege-con-bot">
                                <div class="privilege-com-left">￥<?php echo isset($sys['vip_team2_money_up']) ? $sys['vip_team2_money_up'] :  0.00; ?><span>未开通</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="privilege-tiao">
                        <div class="privilege-tiao-left">VIP</div>
                        <div class="privilege-tiaobox">
                            <div class="privilege-tiaobox-top" style="width: <?php echo $userinfo['share_num']/$sys['zagent_num']*100; ?>%"></div>
                        </div>
                        <div class="privilege-tiao-right">高级</div>
                        <span>人数 <?php echo $userinfo['share_num']; ?>/<?php echo $sys['zagent_num']; ?></span>
                    </div>
                    <div class="privilege-bon">
                        <div class="privilege-bon-top">
                            <div class="privilege-bon-left">升级</div>
                            <span>再推荐<?php echo $sys['zagent_num']-$userinfo['share_num']; ?>人可免费升级</span>
                        </div>

                        <?php if($level == 3): if($userinfo['share_num'] >= $sys['zagent_num']): ?>
                        <a href="javascript:levelUpNotBuy('4');">立即开通</a>
                        <?php else: ?>
                        <a  href="javascript:levelUp('4');">立即开通</a>
                        <?php endif; elseif($level == 4): ?>
                        <a href="javascript:;">已开通</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endif; if($level == 5): ?>
            <div class="swiper-slide">
                <div class="privilege-bannerbox privilege-bannerbox-sidong">
                    <div class="privilege-con">
                        <div class="privilege-con-left">
                            <img class="privilege-con-left-icon w-100" src="__STATIC__/index/img/vip_v5_icon.png?v=<?php echo time(); ?>" alt="">
                        </div>
                        <div class="privilege-con-txt ">
                            <div class="privilege-con-top title-color">
                                私董卡
                            </div>
                            <div class="privilege-con-bot"></div>
                        </div>
                    </div>
                    <div class="privilege-bot">
                        <!--                            有效期：永久有效-->
                        <a  href="javascript:levelUp('5');" style="color: #fff">立即开通</a>
                    </div>
                </div>
            </div>
            <?php endif; if($level == 5): ?>
                <div class="swiper-slide">
                    <div class="privilege-bannerbox privilege-bannerbox-sidong">
                        <div class="privilege-con">
                            <div class="privilege-con-left">
                                <img class="privilege-con-left-icon w-100" src="__STATIC__/index/img/vip_v5_icon.png?v=<?php echo time(); ?>" alt="">
                            </div>
                            <div class="privilege-con-txt ">
                                <!-- 新增 粉色  title-color 颜色    -->
                                <div class="privilege-con-top title-color">
                                    私董卡
                                </div>
                                <div class="privilege-con-bot"></div>
                            </div>
                        </div>
                        <div class="privilege-bot">
                            <!--                            有效期：永久有效-->
                            已开通
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>




    <div style="z-index: 5;">
        <div class="" style="font-size: 12px; padding:10px;background:#09f;display: inline-block;border-radius: 44px;color:#f5f5f5;">
            <a href="javascript:noVip();">非会员</a>
        </div>
        <div class="" style="font-size: 12px; padding:10px;background:#09f;display: inline-block;border-radius: 44px;color:#f5f5f5;">
            <a href="javascript:levelUp('5');">直接升级私董</a>
        </div>
        <!--<div class="" style="font-size: 12px; padding:10px;background:#09f;display: inline-block;border-radius: 44px;color:#f5f5f5;">-->
            <!--<a href="<?php echo url('user/equity1'); ?>">升级私董</a>-->
        <!--</div>-->
    </div>
    <!--    &lt;!&ndash; 专属特权 &ndash;&gt;-->
    <!--    <div class="privilege-cent">-->
    <!--        <div class="privilege-cent-top">-->
    <!--            <?php if($level ==2||$level ==3||$level ==4): ?>代理<?php elseif($level==2): ?>私董<?php endif; ?>专属特权-->
    <!--        </div>-->
    <!--        <?php if(isset($equity)): ?>-->
    <!--        <?php if(count($equity) >0): ?>-->
    <!--        <div class="privilege-cent-bot">-->
    <!--            <div class="privilege-cent-bottop"><?php echo $equity[0]['equity_title']; ?></div>-->
    <!--            <div class="privilege-cent-botcon">-->
    <!--                <div class="privilege-cent-li">-->
    <!--                    <div class="privilege-cent-liimg"></div>-->
    <!--                    <span><?php echo $equity[0]['equity_content']; ?></span>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--        <?php endif; ?>-->
    <!--        <?php else: ?>-->
    <!--        暂无数据-->
    <!--        <?php endif; ?>-->
    <!--    </div>-->
    <!--    &lt;!&ndash; 代理专享权益 &ndash;&gt;-->
    <!--    <div class="privilege-equity">-->
    <!--        <div class="privilege-equity-top">-->
    <!--            代理专享权益-->
    <!--        </div>-->
    <!--        <div class="privilege-equity-bot">-->
    <!--            <div class="privilege-equity-con">-->
    <!--                <div class="privilege-equity-txt">-->
    <!--                    <div class="privilege-equity-txtming"></div>-->
    <!--                    <span>附赠永久锦鲤VIP</span>-->
    <!--                </div>-->
    <!--                <?php if(isset($equity)): ?>-->
    <!--                <?php if(is_array($equity) || $equity instanceof \think\Collection || $equity instanceof \think\Paginator): $i = 0; $__LIST__ = $equity;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>-->
    <!--                <div class="privilege-equity-txt">-->
    <!--                    <div class="privilege-equity-txtming"><img src="__IMG__/<?php echo $vo['equity_pic']; ?>" alt=""-->
    <!--                                                               style="width: 100%;height: 100%"></div>-->
    <!--                    <span><?php echo $vo['equity_title']; ?></span>-->
    <!--                </div>-->
    <!--                <?php endforeach; endif; else: echo "" ;endif; ?>-->
    <!--                <?php endif; ?>-->
    <!--            </div>-->
    <!--        </div>-->

    <!--    </div>-->
    <!--    &lt;!&ndash; 权益详解 &ndash;&gt;-->
    <!--    <div class="privilege-Break">-->
    <!--        <div class="privilege-Break-top">-->
    <!--            代理权益详解-->
    <!--        </div>-->
    <!--        <div class="privilege-Break-bot">-->
    <!--            <div class="privilege-Break-bottap">-->
    <!--                附赠永久锦鲤VIP-->
    <!--            </div>-->
    <!--            <div class="privilege-Break-con">-->
    <!--                <div class="privilege-Break-con-top">-->
    <!--                    <div class="privilege-Break-con-h1">MOM CARE唤醒课</div>-->
    <!--                    <div class="privilege-Break-con-cet">-->
    <!--                        <div class="privilege-Break-con-img">-->
    <!--                            <img src="__IMG__/<?php echo $course[0]['course_pic']; ?>">-->
    <!--                            <div class="con-img-bg">-->
    <!--                                <div class="con-img-icon"></div>-->
    <!--                                <span>-->
    <!--									<?php echo $course[0]['course_look']; ?>人已观看-->
    <!--								</span>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                        <div class="privilege-Break-con-txt">-->
    <!--                            <div class="privilege-Break-txt-left">-->
    <!--                                <div class="privilege-Break-txt"><span></span>-->
    <!--                                    <h2>一次购买，终身回放</h2></div>-->
    <!--                                <div class="privilege-Break-txt"><span></span>-->
    <!--                                    <h2>海量全站优质精品课专享会员优惠价</h2></div>-->
    <!--                            </div>-->
    <!--                            <div class="privilege-Break-txt-right">-->
    <!--                                <h2><span>1</span>年</h2>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--        <div class="privilege-Break-coc">-->
    <!--            <div class="privilege-Break-tato">MOM CARE学院甄选精品（10选5)</div>-->
    <!--            <div class="privilege-Break-banner">-->
    <!--                <div class="swiper-container">-->
    <!--                    <div class="swiper-wrapper">-->
    <!--                        <?php if(isset($course)): ?>-->
    <!--                        <?php if(is_array($course) || $course instanceof \think\Collection || $course instanceof \think\Paginator): $i = 0; $__LIST__ = $course;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>-->
    <!--                        <div class="swiper-slide">-->
    <!--                            <div class="privilege-bannero">-->
    <!--                                <img src="__IMG__/<?php echo $vo['course_pic']; ?>" style="width:100%;height:100%;">-->
    <!--                                <div class="privilege-banner-bg">-->
    <!--                                    <div class="banner-img"></div>-->
    <!--                                    <span><?php echo $vo['course_look']; ?>人已观看</span>-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                        <?php endforeach; endif; else: echo "" ;endif; ?>-->
    <!--                        <?php else: ?>-->
    <!--                        暂无数据-->
    <!--                        <?php endif; ?>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="privilege-Break-cont">-->
    <!--                <div class="privilege-Break-txt-left">-->
    <!--                    <div class="privilege-Break-txt"><span></span>-->
    <!--                        <h2>一次购买，终身回放</h2></div>-->
    <!--                    <div class="privilege-Break-txt"><span></span>-->
    <!--                        <h2>海量全站优质精品课专享会员优惠价</h2></div>-->
    <!--                </div>-->
    <!--                <div class="privilege-Break-txt-right">-->
    <!--                    <h3>永久有效</h3>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--        <div class="privilege-Break-tt">-->
    <!--            可在个人中心→我的课程中查看已选择礼包课程-->
    <!--        </div>-->

    <!--    </div>-->
    <!--    <div class="privilege-rules">-->
    <!--        <?php if(isset($vo)): ?>-->
    <!--        <?php if(is_array($equity) || $equity instanceof \think\Collection || $equity instanceof \think\Paginator): $i = 0; $__LIST__ = $equity;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>-->
    <!--        <div class="privilege-cent-bot">-->
    <!--            <div class="privilege-cent-bottop"><?php echo $vo['equity_title']; ?></div>-->
    <!--            <div class="privilege-cent-botcon">-->
    <!--                <div class="privilege-cent-li">-->
    <!--                    <div class="privilege-cent-liimg"></div>-->
    <!--                    <span><?php echo $vo['equity_content']; ?></span>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--        <?php endforeach; endif; else: echo "" ;endif; ?>-->
    <!--        <?php else: ?>-->
    <!--        暂无数据-->
    <!--        <?php endif; ?>-->
    <!--    </div>-->
    <!--    &lt;!&ndash; 升级规则 &ndash;&gt;-->
    <!--    <div class="upgrade-box">-->
    <!--        <div class="upgrade-box-top">-->
    <!--            升级规则-->
    <!--        </div>-->
    <!--        <div class="upgrade-box-bot">-->
    <!--            <?php if(isset($agentuprule)): ?>-->
    <!--            <?php if(is_array($agentuprule) || $agentuprule instanceof \think\Collection || $agentuprule instanceof \think\Paginator): $i = 0; $__LIST__ = $agentuprule;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>-->
    <!--            <div class="upgrade-box-li">-->
    <!--                <h2><?php echo $key+1; ?>. <?php echo $vo['rule_title']; ?></h2>-->
    <!--                <span><?php echo $vo['rule_content']; ?></span>-->
    <!--            </div>-->
    <!--            <?php endforeach; endif; else: echo "" ;endif; ?>-->
    <!--            <?php else: ?>-->
    <!--            暂无数据-->
    <!--            <?php endif; ?>-->

    <!--        </div>-->
    <!--    </div>-->
    <!--    &lt;!&ndash;<a href="<?php echo url('buy/succbuyVip'); ?>">点击兑换课程</a>&ndash;&gt;-->
    <!--    &lt;!&ndash; 收益规则 &ndash;&gt;-->
    <!--    <div class="privilege-earnings">-->
    <!--        <div class="upgrade-box-top">-->
    <!--            收益规则-->
    <!--        </div>-->
    <!--        <div class="upgrade-box-bot">-->
    <!--            <?php if(isset($getmoney)): ?>-->
    <!--            <?php if(is_array($getmoney) || $getmoney instanceof \think\Collection || $getmoney instanceof \think\Paginator): $i = 0; $__LIST__ = $getmoney;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>-->
    <!--            <div class="upgrade-box-li">-->
    <!--                <h2><?php echo $key+1; ?>.<?php echo $vo['getmoney_title']; ?></h2>-->
    <!--                <span><?php echo $vo['getmoney_content']; ?></span>-->
    <!--            </div>-->
    <!--            <?php endforeach; endif; else: echo "" ;endif; ?>-->
    <!--            <?php else: ?>-->
    <!--            暂无数据-->
    <!--            <?php endif; ?>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--    &lt;!&ndash; 常见问题 &ndash;&gt;-->
    <!--    <div class="problem">-->
    <!--        <div class="problem-top">常见问题</div>-->
    <!--        <div class="problem-txt">-->
    <!--            <?php if(isset($problem)): ?>-->
    <!--            <?php if(is_array($problem) || $problem instanceof \think\Collection || $problem instanceof \think\Paginator): $i = 0; $__LIST__ = $problem;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>-->
    <!--            <div class="problem-con">-->
    <!--                <div class="problem-con-top">-->
    <!--                    <span>a</span>-->
    <!--                    <h2><?php echo $vo['problem']; ?></h2>-->
    <!--                </div>-->
    <!--                <div class="problem-con-bot">-->
    <!--                    <span>b</span>-->
    <!--                    <p><?php echo $vo['da']; ?></p>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <?php endforeach; endif; else: echo "" ;endif; ?>-->
    <!--            <?php else: ?>-->
    <!--            暂无数据-->
    <!--            <?php endif; ?>-->
    <!--        </div>-->
    <!--    </div>-->


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
        .layui-layer-hui {
            background: rgba(245, 245, 245, 1);
            color: #000000;
        }
    </style>
</div>
<script type="text/javascript" src="__STATIC__/index/js/dropload.js?v=<?php echo time(); ?>"></script>
<script type="text/javascript" src="__STATIC__/index/js/wx.js?v=<?php echo time(); ?>"></script>
<script type="text/javascript" src="__STATIC__/index/js/mian.js?v=<?php echo time(); ?>"></script>

<script>
    <?php if($libaoshow == 1): ?>
        $('[data-auth="qy"]').show();
        $('.bg').show();
    <?php endif; ?>
</script>

</body>
</html>