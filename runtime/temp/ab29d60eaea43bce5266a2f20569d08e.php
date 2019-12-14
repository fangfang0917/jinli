<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:85:"/www/wwwroot/jinli.sxzywl.net/public/../application/index/view/user/getequitypic.html";i:1572835866;}*/ ?>
<?php if(is_array($picArr) || $picArr instanceof \think\Collection || $picArr instanceof \think\Paginator): $i = 0; $__LIST__ = $picArr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
<img src="<?php echo $vo; ?>" alt="">
<?php endforeach; endif; else: echo "" ;endif; ?>