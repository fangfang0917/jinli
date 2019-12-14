<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:80:"/www/wwwroot/jinli.sxzywl.net/public/../application/index/view/user/equity2.html";i:1576222770;s:81:"/www/wwwroot/jinli.sxzywl.net/public/../application/index/view/template/base.html";i:1576223686;}*/ ?>
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
<style>
    .open a {
        pointer-events: auto;
    }

    .agreement {
        padding-left: 0.34rem;
        padding-top: .3rem
    }

    label {
        display: flex;
        position: relative
    }

    label span {
        line-height: 0.34rem;
        font-size: 12px
    }

    label .follow {
        color: #999999;
        margin-left: 0.2rem
    }

    label .platform {
        color: #1490E9
    }

    label .icon {
        position: absolute;
        top: 0;
        left: -0.01rem;
        opacity: 0
    }

    .agreement .select {
        width: 0.34rem;
        height: 0.34rem;
        border: 1px solid #979797;
        border-radius: 2px
    }

    .agreement input {
        width: 0.34rem;
        height: 0.34rem;
        opacity: 0;
        appearance: checkbox;
        -moz-appearance: checkbox;
        -webkit-appearance: checkbox
    }

    html, body {
        background-color: #F9F9F9 !important
    }

    .tip-box-inner {
        position: absolute;
        top: -0.7rem;
        left: 3.5rem;

    }

    .tip-box-inner .innernum {
        font-size: 10px;
        position: absolute;
        top: 9px;
        /*left: 9px;*/
        width: 100%;
        text-align: center;
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
      <?php endif; else: if(isset($body_background_color)): ?>
style="background:<?php echo $body_background_color; ?>;box-sizing: border-box;width: 100%"

<?php else: ?>
style="background: #fff;box-sizing: border-box;width: 100%"

<?php endif; endif; ?>data-phone="<?php echo $rigU['phone']; ?>" data-level="<?php echo $rigU['level']; ?>" data-ua="<?php echo $equipmentType; ?>" data-card = <?php echo $rigU['card']; ?>>
<div class="vertical" style="display: none;">为了保证您的体验效果,请保持竖屏幕访问</div>
<div class="app-main">
    
    
    
<div>
    <input type="hidden" name="che-level" value="">
    <div class="topSwiper" data-show="<?php echo $level; ?>">
        <div class="left hidden"></div>
        <?php if(is_array($sharelevel) || $sharelevel instanceof \think\Collection || $sharelevel instanceof \think\Paginator): $i = 0; $__LIST__ = $sharelevel;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <div data-item="<?php echo $key; ?>" class="top-box hidden card" data-level='<?php echo $vo['level']; ?>' data-getLevel="<?php echo $sharelevelGet; ?>"
             data-nowLevel="<?php echo $userInfo['level']; ?>">
            <img class="backgroundImg" src="<?php echo $vo['bimg']; ?>" alt="">
            <!--<img class="vipImg" src="<?php echo $vo['img']; ?>" alt="">-->
            <div class="exclusiveVIP">
                <p class="VIP-yz<?php echo $vo['level']; ?>"><?php echo $vo['content']; ?></p>
                <p class="VIP-price<?php echo $vo['level']; ?>">
                    <span class="isPrice">￥<?php echo $vo['vip_money']; ?></span>
                    <!--<span class="isOpenlc"><?php if($vo['level'] <= $userInfo['level']): ?>已开通<?php else: ?>未开通<?php endif; ?></span>-->
                </p>
            </div>
            <?php if(!in_array($vo['level'],[1])): if($vo['level']<=$userInfo['level']): ?>
            <div class="tsix">永久有效</div>
            <?php else: ?>
            <div class="open topUp">
                <div class="leftword"><?php echo $vo['left_bottom_content']; ?></div>
                <?php if($vo['level'] == 5): ?>
                <div class="rightword "><img src="__STATIC__/index/img/home/vip_an_<?php echo $vo['level']; ?>.png" alt=""
                                             onclick="setAgent()" style="pointer-events: none"></div>
                <?php else: ?>
                <div class="rightword"><img src="__STATIC__/index/img/home/vip_an_<?php echo $vo['level']; ?>.png" alt=""
                                            onclick="levelUp('<?php echo $vo['level']; ?>')" style="pointer-events: none"></div>
                <?php endif; ?>
            </div>
            <?php endif; endif; if(in_array($vo['level'],[1])): ?>
            <div class="open topUp">
                <?php if($userInfo['level'] == 0): ?>
                <div class="leftword "><?php echo $vo['left_bottom_content']; ?></div>
                <div class="rightword "><img src="__STATIC__/index/img/home/vip_an_<?php echo $vo['level']; ?>.png" alt=""
                                             onclick="buyVip()" style="pointer-events: none"></div>
                <?php else: if($userInfo['level']>1): ?>
                <p class="tsix">永久有效</p>
                <?php else: ?>
                <p class="tsix">
                    <?php echo date('Y-m-d',$userInfo['buy_vip_time']); ?>~<?php echo date('Y-m-d',$userInfo['buy_vip_time']+365*24*60*60); ?>
                </p>
                <?php endif; endif; ?>
            </div>
            <?php endif; ?>


        </div>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        <div class="next"></div>
    </div>

    <!--<div class="agreement" style="display: none;">-->
    <!--<label>-->
    <!--<span class="follow">开通默认同意遵循</span>-->
    <!--<span class="platform"><a href="<?php echo url('About/plat'); ?>">《锦鲤MoM平台收费协议》</a></span>-->
    <!--</label>-->
    <!--</div>-->
    <div class="agreement" style="display: none;">
        <label>
            <div class="select">
                <svg class="icon"
                     style="width: .4em; height: .4em;vertical-align: middle;fill: currentColor;overflow: hidden;"
                     viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="6655">
                    <path d="M876.987738 223.178989c-34.218336-26.873044-83.720773-20.923542-110.598934 13.284561L466.977597 617.637945 246.479671 403.361721c-31.19242-30.30112-81.06427-29.578666-111.381763 1.613754-30.30112 31.197536-29.589922 81.075527 1.608637 111.38688l282.442744 274.417977c31.197536 30.312376 81.069387 29.578666 111.376647-1.608637 3.526313-3.623527 5.183046-8.15575 7.872295-12.224416 3.764744-3.260254 8.116865-5.574972 11.301394-9.633405l340.567559-433.56358C917.14432 299.543214 911.189701 250.045893 876.987738 223.178989z"
                          p-id="6656"></path>
                </svg>
                <input name="userlevel" type="checkbox" value="1">
            </div>
            <span class="follow">开通默认同意遵循</span>
            <span class="platform"><a href="<?php echo url('About/plat'); ?>">《锦鲤MoM平台收费协议》</a></span>
        </label>
    </div>
    <div class="topSuspension">
        <img src="__STATIC__/index/img/horn.png" alt="">
        <p>同意平台协议后才可开通</p>
        <img id="deleteTop" src="__STATIC__/index/img/cross.png" alt="">
    </div>
    <!--会员专属权益介绍-->
    <div class="z-exclusive">
        <div class="topexc">
            <p class="pone">会员专属权益介绍</p>
            <a href="javascript:;" class="ptwo uu"><span>查看详情</span><img
                    src="__STATIC__/index/img/home/jiantou.png" alt=""></a>
        </div>
        <div class="botexc">
            <a href="javascript:;" class="done uu">
                <img src="__STATIC__/index/img/home/kclb.png" alt="">
                <p>课程礼包</p>
            </a>
            <a href="javascript:;" class="done uu">
                <img src="__STATIC__/index/img/home/xszk.png" alt="">
                <p>专享折扣</p>
            </a>
            <a href="javascript:;" class="done uu">
                <img src="__STATIC__/index/img/home/xxsq.png" alt="">
                <p>学习社群</p>
            </a>
            <a href="javascript:;" class="done uu">
                <img src="__STATIC__/index/img/home/lszq.png" alt="">
                <p>零售赚钱</p>
            </a>
        </div>
    </div>
    <!--灰条-->
    <div class="ht"></div>

    <!--高端唤醒营-->
    <div class="z-camp" style="display: none">
        <div class="topcamp">
            <p class="pone">高端唤醒营</p>
        </div>
        <div class="botcamp">
            <a href="javascript:;" class="done uu">
                <img src="__STATIC__/index/img/home/zxjhx.png" class="q" alt="">
                <p>初级唤醒执行师课程包</p>
            </a>
            <a href="javascript:;" class="done uu">
                <img src="__STATIC__/index/img/home/zxjcf.png" class="s" alt="">
                <p>初级创富权益</p>
            </a>
        </div>
    </div>
    <!--灰条-->
    <div class="ht"></div>

    <!--升级任务-->
    <div class="z-task" hidden>
        <div class="toptask">
            <p class="pone">升级任务</p>
        </div>
        <p class="z-tj">已推荐 <span><?php echo $userInfo['share_num']; ?></span> 人</p>


        <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <div class="z-hy">
            <div class="done"><img src="<?php echo $vo['img']; ?>" alt=""></div>
            <div class="dtwo">
                <p class="pone"><?php echo $vo['content']; ?></p>
                <p class="ptwo"><?php echo $vo['left_bottom_title']; ?></p>
            </div>
            <?php if($userInfo['level']>=$vo['level']): ?>
            <div class="dth">已完成</div>
            <?php else: if($vo['my_share_num'] >= $vo['share_num']): ?>
            <a class="atwo" href="javascript:;" onclick="levelUpNotBuy('<?php echo $vo['level']; ?>')">升级</a>
            <?php else: ?>
            <a class="aone" href="javascript:;">升级</a>
            <?php endif; endif; ?>

        </div>
        <?php endforeach; endif; else: echo "" ;endif; ?>

    </div>
    <!--使用须知-->
    <div class="z-info">
        <p class="ptitle">使用须知</p>
        <?php if(is_array($pro) || $pro instanceof \think\Collection || $pro instanceof \think\Paginator): $i = 0; $__LIST__ = $pro;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$r): $mod = ($i % 2 );++$i;?>
        <p class="pone">Q:<?php echo $r['problem']; ?>？</p>
        <p class="ptwo">A:<?php echo $r['da']; ?></p>
        <?php endforeach; endif; else: echo "" ;endif; ?>
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
                    <img src="__STATIC__/index/img/user1.png">
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

    <script type="text/javascript" src="__STATIC__/index/js/sc.js?v=<?php echo time(); ?>"></script>
    
</body>
</html>