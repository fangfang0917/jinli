<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:83:"/www/wwwroot/jinli.sxzywl.net/public/../application/index/view/order/orderlist.html";i:1576032390;}*/ ?>
<?php if(isset($orderlist)): if(count($orderlist)>0): if(is_array($orderlist) || $orderlist instanceof \think\Collection || $orderlist instanceof \think\Paginator): $i = 0; $__LIST__ = $orderlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
<li>
    <a href="<?php echo url('course/detail'); ?>?id=<?php echo $vo['id']; ?>">
        <div class="order-top">
            订单编号：<?php echo $vo['order_no']; ?>
        </div>
        <div class="order-bot">
            <div class="order-left r2">
                <div class="order-img">
                    <img src="<?php echo $vo['course_pic']; ?>"/>
                    <div class="order-bg"></div>
                    <div class="order-text">
                        <i class="iconfont icon-chakan"></i>
                        <span><?php echo $vo['course_look']; ?>人已观看</span>
                    </div>
                </div>
            </div>
            <div class="order-right">
                <div class="order-right-top">
                    <h2>
                        <?php echo $vo['course_title']; ?>
                    </h2>
                    <span>
                                            <?php echo $vo['course_remark']; ?>
                                        </span>
                </div>
                <div class="order-right-bot">
                    <div class="price-box">
                        <?php if($vo['money']>0): ?>
                        ￥<?php echo $vo['money']; endif; ?>
                    </div>
                    <div class="state-box">
                        <?php if($vo['pay_type'] == 1): if($vo['course_type']==1): ?>已支付
                            <?php elseif($vo['course_type']==2): ?>礼包领取
                            <?php elseif($vo['course_type']==3): ?>兑换课程
                            <?php else: ?>vip赠送
                            <?php endif; else: ?>未支付
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </a>
</li>
<?php endforeach; endif; else: echo "" ;endif; else: ?>
<div class="order-none">
    <img src="__STATIC__/index/img/kecheng.png?v=<?php echo time(); ?>">
    <div class="order-null">您的课程还是空的~</div>
</div>
<?php endif; endif; ?>