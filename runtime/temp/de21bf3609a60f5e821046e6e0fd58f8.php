<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:85:"/www/wwwroot/jinli.sxzywl.net/public/../application/admin/view/user_record/index.html";i:1575014012;s:81:"/www/wwwroot/jinli.sxzywl.net/public/../application/admin/view/template/base.html";i:1568942460;s:92:"/www/wwwroot/jinli.sxzywl.net/public/../application/admin/view/template/javascript_vars.html";i:1488957233;}*/ ?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <title><?php echo \think\Config::get('site.title'); ?></title>
    <link rel="Bookmark" href="__ROOT__/favicon.ico" >
    <link rel="Shortcut Icon" href="__ROOT__/favicon.ico" />
    <!--[if lt IE 9]>
    <script type="text/javascript" src="__LIB__/html5.js"></script>
    <script type="text/javascript" src="__LIB__/respond.min.js"></script>
    <script type="text/javascript" src="__LIB__/PIE_IE678.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="__STATIC__/h-ui/css/H-ui.min.css"/>
    <link rel="stylesheet" type="text/css" href="__STATIC__/h-ui.admin/css/H-ui.admin.css"/>
    <link rel="stylesheet" type="text/css" href="__LIB__/Hui-iconfont/1.0.7/iconfont.css"/>
    <link rel="stylesheet" type="text/css" href="__LIB__/icheck/icheck.css"/>
    <link rel="stylesheet" type="text/css" href="__STATIC__/h-ui.admin/skin/default/skin.css" id="skin"/>
    <link rel="stylesheet" type="text/css" href="__STATIC__/h-ui.admin/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="__STATIC__/css/app.css"/>
    <link rel="stylesheet" type="text/css" href="__LIB__/icheck/icheck.css"/>
    
    <!--[if IE 6]>
    <script type="text/javascript" src="__LIB__/DD_belatedPNG_0.0.8a-min.js"></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <!--定义JavaScript常量-->
<script>
    window.THINK_ROOT = '<?php echo \think\Request::instance()->root(); ?>';
    window.THINK_MODULE = '<?php echo \think\Url::build("/" . \think\Request::instance()->module(), "", false); ?>';
    window.THINK_CONTROLLER = '<?php echo \think\Url::build("___", "", false); ?>'.replace('/___', '');
</script>
</head>
<body>

<nav class="breadcrumb">
    <div id="nav-title"></div>
    <a class="btn btn-success radius r btn-refresh" style="line-height:1.6em;margin-top:3px" href="javascript:;" title="刷新"><i class="Hui-iconfont"></i></a>
</nav>


<div class="page-container">
    <form class="mb-20" method="get" action="<?php echo \think\Url::build(\think\Request::instance()->action()); ?>">
        <input type="text" class="input-text" style="width:250px" placeholder="用户昵称" name="nick_name" value="<?php echo \think\Request::instance()->param('nick_name'); ?>">
        <select name="type" id="" class="select-box" style="width:250px;height: 31px">
            <option value="0" <?php if(\think\Request::instance()->param('type') == 0): ?>selected<?php endif; ?>>请选择账变类型</option>
            <option value="1" <?php if(\think\Request::instance()->param('type') == 1): ?>selected<?php endif; ?>>直推购买返点</option>
            <option value="2" <?php if(\think\Request::instance()->param('type') == 2): ?>selected<?php endif; ?>>间推购买返点</option>
            <option value="3" <?php if(\think\Request::instance()->param('type') == 3): ?>selected<?php endif; ?>>提现</option>
            <option value="4" <?php if(\think\Request::instance()->param('type') == 4): ?>selected<?php endif; ?>>推荐代理奖励</option>
            <option value="5" <?php if(\think\Request::instance()->param('type') == 5): ?>selected<?php endif; ?>>服务奖</option>
        </select>
        <button type="submit" class="btn btn-success" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜索</button>
    </form>
    <div class="cl pd-5 bg-1 bk-gray">
    </div>
    <table class="table table-border table-bordered table-hover table-bg mt-20">
        <thead>
        <tr class="text-c">
            <th width="100">账变人</th>
            <th width="150">账变金额</th>
            <th width="150">账变时间</th>
            <th width="150">类型</th>
            <th width="150">是否需审核</th>
            <th width="150">审核状态</th>
            <th width="150">审核时间</th>
            <th width="150">是否是推荐返点</th>
            <th width="150">返点人</th>
            <th width="150">描述</th>
            <!--<th width="150">操作</th>-->
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <tr class="text-c">
            <td><?php echo $vo['nick_name']; ?></td>
            <td><?php if($vo['type'] == 1 ||  $vo['type'] == 2 ||  $vo['type'] == 5 ||  $vo['type'] == 4): ?><span style="color: #00B83F">+<?php echo $vo['amount']; ?></span><?php else: ?><span style="color: red">-<?php echo $vo['amount']; ?></span><?php endif; ?></td>
            <td><?php echo date('Y-m-d H:i:s',$vo['add_time']); ?></td>
            <td><?php if($vo['type'] == 1): ?>直推购买返点<?php elseif($vo['type'] == 2): ?>间推购买返点<?php elseif($vo['type']== 3): ?>提现<?php elseif($vo['type'] == 4): ?>推荐代理奖<?php elseif($vo['type'] == 5): ?>服务奖<?php endif; ?></td>
            <td><?php if($vo['type'] == 1 ||  $vo['type'] == 2 ||  $vo['type'] == 5 ||  $vo['type'] == 4): ?><span style="color:red ">否</span><?php else: ?><span style="color: #00B83F">是</span><?php endif; ?></td>
            <td><?php if($vo['type'] == 1 ||  $vo['type'] == 2 ||  $vo['type'] == 5 ||  $vo['type'] == 4): ?>
                    <span style="color: #00B83F">--</span>
                <?php else: if($vo['type_status'] == 1): ?>
                        <span style="color: #00B83F">已审核并发放</span>
                    <?php elseif($vo['type_status'] == 2): ?>
                        <span style="color: red">审核未通过退回</span>
                    <?php else: ?>
                        <span style="color: #0a67fb">待审核</span>
                    <?php endif; endif; ?></td>
            <td><?php if($vo['type'] == 1 ||  $vo['type'] == 2 ||  $vo['type'] == 5 ||  $vo['type'] == 4): ?><span style="color: #00B83F">--</span><?php else: ?><?php echo date('Y-m-d H:i:s',$vo['up_time']); endif; ?></td>
            <td><?php if($vo['type'] == 1 ||  $vo['type'] == 2 || $vo['type'] == 5 ||  $vo['type'] == 4): ?><span style="color: #00B83F">是</span><?php else: ?> <span style="color: red">否</span> <?php endif; ?></td>
            <td><?php if($vo['type'] == 1 ||  $vo['type'] == 2 || $vo['type'] == 5 ||  $vo['type'] == 4): ?><span style="color: #00B83F"><?php echo $vo['snick_name']; ?></span><?php else: ?>--<?php endif; ?></td>
            <td><?php echo $vo['remarks']; ?></td>
        </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
    <div class="page-bootstrap"><?php echo $page; ?></div>
</div>

<script type="text/javascript" src="__LIB__/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="__LIB__/layer/2.4/layer.js"></script>
<script type="text/javascript" src="__STATIC__/h-ui/js/H-ui.js"></script>
<script type="text/javascript" src="__STATIC__/h-ui.admin/js/H-ui.admin.js"></script>
<script type="text/javascript" src="__STATIC__/js/app.js"></script>
<script type="text/javascript" src="__LIB__/icheck/jquery.icheck.min.js"></script>
<script type="text/javascript" src="__LIB__/My97DatePicker/WdatePicker.js"></script>

</body>
</html>