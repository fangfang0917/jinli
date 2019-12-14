<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:81:"/www/wwwroot/jinli.sxzywl.net/public/../application/index/view/course/detail.html";i:1576036080;s:81:"/www/wwwroot/jinli.sxzywl.net/public/../application/index/view/template/base.html";i:1576205312;}*/ ?>
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
    
    
    
<style>
body,html{width:100% !important;height:100% !important;-webkit-overflow-scrolling:touch;}/*必须*/

.details-tap img{width:100%}
#w-h-rig{position:fixed;top:0;width:100%;height:2.3rem;background:#FFFFFF;z-index:19950320;color:#000000;font-size:.3rem;display:none}
.layui-layer-content{color:#000000 !important}
.layui-layer-tips .layui-layer-content{font-size:.2rem !important}
.emptyGood{text-align:center;color:#ccc;font-size:.3rem}
.touming{opacity:1;}


</style>
<div id="w-h-rig"></div>
<div class="video-box">

    <div id="video-r">
        <div class="playvideo">
            <div class="zy_media">
                <video poster="<?php echo $courseDetails['course_pic']; ?>" id="video" data-id="<?php echo $course_info_id; ?>" webkit-playsinline="true"
                       playsinline="true" x5-playsinline="true" x-webkit-airplay="allow"
                       data-config='{"mediaTitle": ""}'  x5-video-player-type="h5"
                       x5-video-player-fullscreen="false" >
                    <?php echo outVideoHtml($course_info_detail['course_info_path']); ?>
                    您的浏览器不支持HTML5视频
                </video>
            </div>
            <div id="modelView" class="modelView">
            </div>
        </div>
    </div>


    <div id="courseShare">
        <a class="courseShare" href="/index/course/courseshare/id/<?php echo $courseDetails['id']; ?>.html" style="color: #fff"><img src="__STATIC__/index/img/share.png" alt="" style="width:100%;"></a>
    </div>
    <div id="course_info_id" data-id="<?php echo $course_info_id; ?>"></div>
    <div id="level" data-level="<?php echo $level; ?>"></div>
    <div id="course_id" data-course-id="<?php echo $courseDetails['id']; ?>"></div>
    <div id="on_line" data-on-line="<?php echo $courseDetails['on_line']; ?>"></div>
    <div class="video-details">
        <div class="video-left">
            <span>已更新<?php echo $courseDetails['course_info_count']; ?>期</span>/<span>共<?php echo $courseDetails['course_info_count']; ?>期</span>
        </div>
        <div class="video-right">
            <span><?php echo $courseDetails['buy_num']; ?>人已购买</span>
        </div>
    </div>
    <div style="height: .1rem;background: #F5F5F5;"></div>
</div>
<div id="details-box" class="details-box" data-action="tabBox" data-item='content'>
    <a href="javascript:;" class="on introduce" data-tab data-index="0">介绍</a>
    <a href="javascript:;" class="directory" data-tab data-index="1">目录</a>
    <a href="javascript:;" class="comments" data-tab data-index="2" onclick="getCourseComment()">评论</a>
</div>
<div class="details-tap">
    <div class="content" data-itel-box='content'>
        <div class="introduce-box cur content-cont" data-tab-iteam <?php if($buy_type_auth == 1): ?>style="padding-bottom:.2rem"<?php endif; ?>>
            <?php echo htmlspecialchars_decode($courseDetails['course_t_ex'] ); if($buy_type_auth !=1): if($level>0): ?>
                    <div class="buy">
                        <a href="javascript:buyCourse('<?php echo $courseDetails['id']; ?>');" style="width:100%; ">
                            VIP购买（<?php echo $courseDetails['course_vip_money']; ?>元）
                        </a>
                    </div>

                <?php else: ?>
                    <div class="buyer" style="z-index: 999;left: 50%;">
                        <a href="/index/user/equity2.html" class="vipjia">
                            VIP购买（<?php echo $courseDetails['course_vip_money']; ?>元）
                        </a>
                    </div>
                    <div class="buyer">
                        <a href="javascript:buyCourse('<?php echo $courseDetails['id']; ?>');" class="yuanjia">
                            原价购买（<?php echo $courseDetails['course_money']; ?>元）
                        </a>
                    </div>

                <?php endif; endif; ?>
        </div>
        <div class="directory-box content-cont" data-tab-iteam  <?php if($buy_type_auth == 1): ?>style="padding-bottom:.2rem"<?php endif; ?>>
            <div style="height: .2rem;"></div>
            <div class="number-box">
                <div class="number-text" onclick="getCourseInfo('<?php echo $courseDetails['id']; ?>')" data-sort="1">正序</div>
                <div class="number-tab">
                    <div class="isbox"></div>
                    <div class="negativebox"></div>
                </div>
            </div>
            <ul class="courseinfolist">


            </ul>

            <?php if($buy_type_auth !=1): if($level>0): ?>
                    <div class="buy">
                        <a href="javascript:buyCourse('<?php echo $courseDetails['id']; ?>');" style="width:100%;">
                            VIP购买（<?php echo $courseDetails['course_vip_money']; ?>元）
                        </a>
                    </div>
                <?php else: ?>
                    <div class="buyer" style="z-index: 999;left: 50%;">
                        <a href="/index/user/equity2.html" class="vipjia">
                            VIP购买（<?php echo $courseDetails['course_vip_money']; ?>元）
                        </a>
                    </div>
                    <div class="buyer">
                        <a href="javascript:buyCourse('<?php echo $courseDetails['id']; ?>');" class="yuanjia">
                            原价购买（<?php echo $courseDetails['course_money']; ?>元）
                        </a>
                    </div>
                <?php endif; endif; ?>
        </div>
        <div class="comments-box content-cont content-cont1" data-tab-iteam>
            <ul class="commentslist">
            </ul>
            <div class="rig-comments-com">
                <div style="width: 100%;background-color: #fff;position: fixed;bottom: 0;z-index:19950320;border-top: 1px solid #cccccc;">
                    <div class="comments-com-tem">
                        <div class="comments-Ten">
                            <i class="iconfont icon-shuru2"></i>
                            说点什么吧，也许TA也在看
                        </div>
                        <div class="message">
                            <img src="__STATIC__/index/img/icon_ comment.png?v=<?php echo time(); ?>" alt="" style="width: .45rem;">
                            <span id="course_comment_num"><?php echo isset($course_comment_num) ? $course_comment_num :  0; ?></span>
                        </div>
                        <div class="give" onclick="setinccourseinfolikenum()">
                            <img src="__STATIC__/index/img/zan_<?php echo $addFabulous; ?>.png?v=<?php echo time(); ?>" alt="" style="width: .45rem;">
                            <span id="dianzan"><?php echo isset($course_info_detail['course_info_like_num']) ? $course_info_detail['course_info_like_num'] :  0; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="prd-show-footer">
</div>
<div class="share-box" style="display: none;position: fixed;top: 0;z-index:50;">

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

<script type="text/javascript" src="__STATIC__/index/js/course.js?v=<?php echo time(); ?>"></script>
<?php if($equipmentType == 'IOS'): ?>
<script type="text/javascript" src="__STATIC__/index/js/course_ios.js?v=<?php echo time(); ?>"></script>
<?php else: ?>
<script type="text/javascript" src="__STATIC__/index/js/course_other.js?v=<?php echo time(); ?>"></script>
<?php endif; ?>
<script>
    <?php if($libaoshow == 1): ?>
    // if(getCache('backAction') == 'buyVip'){
    //     $('[data-auth="qy"]').show();
    //     $('.bg').show();
    // }
    <?php endif; ?>

    $(function () {
        var type = <?php echo $datatype; ?>;
        if (type == 1) {
            $('.details-box .directory').addClass('on').siblings().removeClass('on');
            $('.directory-box').show().siblings().hide();
            getCourseInfo('<?php echo $courseDetails['id']; ?>', 1);
        }

    })
</script>

</body>
</html>