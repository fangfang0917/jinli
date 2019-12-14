<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:77:"/www/wwwroot/jinli.sxzywl.net/public/../application/index/view/form/form.html";i:1571811737;}*/ ?>
<!-- 搜索列表 -->
<?php if(isset($formlist)): if($count > 0): ?>
<ul>
    <!-- 课程开始 -->
    <?php if(is_array($formlist) || $formlist instanceof \think\Collection || $formlist instanceof \think\Paginator): $i = 0; $__LIST__ = $formlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
    <li>
        <a href="<?php echo url('Course/detail','',false,true); ?>/id/<?php echo $vo['id']; ?>">
            <div class="detailsimg">
                <img src="<?php echo $vo['course_pic']; ?>">
                <div class="preferential">
                    限时优惠
                </div>
                <div class="detailsimgbox">
                    <i class="iconfont icon-chakan"></i>
                    <span>
                        <?php echo $vo['course_look']; ?>人已观看
                    </span>
                </div>
            </div>
            <div class="detailstap">
                <h1><?php echo $vo['course_title']; ?></h1>
                <span>
                             <?php echo $vo['course_remark']; ?>
		   					</span>
                <div class="detailstap_bot">
                    <!--<?php echo $vo['buy_type']; ?>-->
                    <!--<?php echo $vo['on_line']; ?>-->
                    <?php if($vo['buy_type'] == 1): if($vo['on_line'] == 2): ?>
                        <div class="detailstap_left"
                             style="color: #999999;font-size: .28rem;font-weight: 400;font-family:PingFangSC-Regular,PingFangSC;">
                            已报名
                        </div>
                        <?php else: ?>
                        <div class="detailstap_left"
                             style="color: #999999;font-size: .28rem;font-weight: 400;font-family:PingFangSC-Regular,PingFangSC;">
                            已购买
                        </div>
                        <?php endif; else: ?>
                    <div class="detailstap_left">VIP ¥<?php echo $vo['course_vip_money']; ?></div>
                    <div class="detailstap_right">原价<?php echo $vo['course_money']; ?>元</div>
                    <?php endif; ?>
                </div>
            </div>
        </a>
    </li>
    <?php endforeach; endif; else: echo "" ;endif; ?>
    <!-- 课程结束 -->


</ul>
<?php else: ?>
<!-- 没有结果 -->
<div class="search-none">
    <img src="__STATIC__/index/img/sousuo.png?v=<?php echo time(); ?>" style="width: 46%;">
    <div style="font-size: .3rem;text-align: center;width: 100%;margin-top: .3rem;color: #999999;">未搜索到相关课程</div>
</div>
<?php endif; endif; ?>
