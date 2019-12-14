<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:81:"/www/wwwroot/jinli.sxzywl.net/public/../application/index/view/user/getshare.html";i:1571820932;}*/ ?>
<div class="share-tabimg b">
    <?php if(is_array($picData) || $picData instanceof \think\Collection || $picData instanceof \think\Paginator): $i = 0; $__LIST__ = $picData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($key == 0): ?>
    <img src="__STATIC__/uploads/share/<?php echo $vo['pic']; ?>?v=<?php echo time(); ?>" alt="" data-i="1" data-index="<?php echo $key; ?>" style="width: 100%;">
    <?php else: ?>
    <img src="__STATIC__/uploads/share/<?php echo $vo['pic']; ?>?v=<?php echo time(); ?>" alt="" data-i="0" data-index="<?php echo $key; ?>" style="width: 100%;">
    <?php endif; endforeach; endif; else: echo "" ;endif; ?>
</div>