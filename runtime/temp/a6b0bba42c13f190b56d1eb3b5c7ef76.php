<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:85:"/www/wwwroot/jinli.sxzywl.net/public/../application/index/view/amount/amountlist.html";i:1570763013;}*/ ?>
<?php if(isset($list)): if(count($list)>0): if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
<li>
    <div class="wallet-detail-bot-left">
        <div class="wallet-detail-bot-imgbox">
            <?php if($vo['head_type'] == 1): ?>
            <img src="<?php echo $vo['head']; ?>"/>
            <?php else: ?>
            <img src="__IMG__/<?php echo $vo['head']; ?>"/>
            <?php endif; ?>

        </div>
        <div class="wallet-detail-bot-txt">
            <h1><?php echo $vo['remarks']; ?></h1>
            <h2><?php echo $vo['sname']; ?></h2>
            <div class="wallet-detail-bot-data">
                <span><?php echo date('m-d   H:i:s',$vo['add_time']); ?></span>
            </div>
        </div>
    </div>
    <div class="wallet-detail-bot-right">
        <span>+<?php echo number_format($vo['amount'],2,'.',''); ?></span>
    </div>
</li>
<?php endforeach; endif; else: echo "" ;endif; endif; endif; ?>