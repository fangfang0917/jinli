<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:90:"/www/wwwroot/jinli.sxzywl.net/public/../application/index/view/goodslist/jlcourselist.html";i:1575689807;}*/ ?>
<?php if(is_array($course) || $course instanceof \think\Collection || $course instanceof \think\Paginator): $i = 0; $__LIST__ = $course;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$r): $mod = ($i % 2 );++$i;?>
<a href="<?php echo url('course/detail',array('id'=>$r['id'])); ?>">
    <div class="done">
        <div class="zxjleftimg">
            <img class="zxjbigimg" src="<?php echo $r['course_pic']; ?>" alt="">
            <img class="zxjxsqg" src="<?php echo isset($r['course_pic_jiao']) ? $r['course_pic_jiao'] :  ''; ?>" alt="">
            <div class="zxjsee">
                <img src="" alt="">
                <span><?php echo $r['course_look']; ?></span>人已观看
            </div>
        </div>
        <div class="zrightword">
            <p class="pone"><?php echo $r['course_title']; ?></p>
            <div class="zbotword">
                <p class="zpvip">VIP ￥<span><?php echo $r['course_vip_money']; ?></span></p>
                <p class="zyj">原价 <span><?php echo $r['course_money']; ?>元</span></p>
            </div>
        </div>
    </div>
</a>

<?php endforeach; endif; else: echo "" ;endif; ?>