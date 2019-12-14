<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:88:"/www/wwwroot/jinli.sxzywl.net/public/../application/index/view/index/carecourselist.html";i:1574907655;}*/ ?>
<?php if(is_array($course) || $course instanceof \think\Collection || $course instanceof \think\Paginator): $i = 0; $__LIST__ = $course;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
<li>
    <a href="<?php echo url('Course/detail','',false,true); ?>/id/<?php echo $vo['id']; ?>" _load>
        <div class="detailsimg r2">
            <img src="<?php echo $vo['course_pic']; ?>">
            <div class="preferential">
                <?php if($vo['course_pic_jiao'] != '0'): ?>
                <img src="<?php echo $vo['course_pic_jiao']; ?>" alt="" style="width: 100%;height: 100%">
                <?php endif; ?>
            </div>
            <div class="detailsimgbox">
                <div style="width: .3rem;height: .3rem;float: left;margin-left: .05rem;">
                    <img src="__STATIC__/index/img/icon_view.png?v=<?php echo time(); ?>" alt="" style="width: 100%;height: 100%;">
                </div>
                <div style="margin-left: .05rem"><?php echo $vo['course_look']; ?>人已观看</div>
            </div>
        </div>
        <div class="detailstap">
            <h1><?php echo $vo['course_title']; ?></h1>
            <span>
            <?php echo $vo['course_remark']; ?>
            </span>
            <div class="detailstap_bot">
                <?php if($vo['buy_type'] == 1): ?>
                <div class="detailstap_left" style="color: #999999;font-size: .25rem;font-weight: 400;font-family:PingFangSC-Regular,PingFangSC;">已购买</div>
                <?php elseif($vo['buy_type'] == 2): ?>
                <div class="detailstap_left" style="color: #999999;font-size: .25rem;font-weight: 400;font-family:PingFangSC-Regular,PingFangSC;">限时免费</div>
                <?php else: ?>
                <div class="detailstap_left">VIP ¥<?php echo $vo['course_vip_money']; ?></div>
                <div class="detailstap_right">原价<?php echo $vo['course_money']; ?>元</div>
                <?php endif; ?>
            </div>
        </div>
    </a>
</li>
<?php endforeach; endif; else: echo "" ;endif; ?>
