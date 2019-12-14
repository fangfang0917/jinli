<?php if (!defined('THINK_PATH')) exit(); /*a:6:{s:84:"/www/wwwroot/jinli.sxzywl.net/public/../application/admin/view/order_list/index.html";i:1573183128;s:81:"/www/wwwroot/jinli.sxzywl.net/public/../application/admin/view/template/base.html";i:1568942460;s:92:"/www/wwwroot/jinli.sxzywl.net/public/../application/admin/view/template/javascript_vars.html";i:1488957233;s:83:"/www/wwwroot/jinli.sxzywl.net/public/../application/admin/view/order_list/form.html";i:1574833798;s:81:"/www/wwwroot/jinli.sxzywl.net/public/../application/admin/view/order_list/th.html";i:1570609242;s:81:"/www/wwwroot/jinli.sxzywl.net/public/../application/admin/view/order_list/td.html";i:1574833798;}*/ ?>
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
    <form class="mb-20" method="get" id="form" action="<?php echo \think\Url::build(\think\Request::instance()->action()); ?>">
    <input type="text" class="input-text" style="width:150px" placeholder="订单号" name="order_no" value="<?php echo \think\Request::instance()->param('order_no'); ?>">
    <input type="text" class="input-text" style="width:150px" placeholder="手机号" name="phone" value="<?php echo \think\Request::instance()->param('phone'); ?>">
    <input type="text" class="input-text" style="width:150px" placeholder="昵称" name="nick_name" value="<?php echo \think\Request::instance()->param('nick_name'); ?>">
    <input type="text" class="input-text" style="width:150px" placeholder="用户ID" name="id" value="<?php echo \think\Request::instance()->param('id'); ?>">
    <select name="level" class="select-box" style="height: 31px;width: 150px">
        <option value="0" <?php if(\think\Request::instance()->param('level') == 0): ?> selected<?php endif; ?>>请选择用户等级</option>
        <option value="1" <?php if(\think\Request::instance()->param('level') == 1): ?> selected<?php endif; ?>><?php echo $levelname['level0']; ?></option>
        <option value="2" <?php if(\think\Request::instance()->param('level') == 2): ?> selected<?php endif; ?>><?php echo $levelname['level1']; ?></option>
        <option value="3" <?php if(\think\Request::instance()->param('level') == 3): ?> selected<?php endif; ?>><?php echo $levelname['level2']; ?></option>
        <option value="4" <?php if(\think\Request::instance()->param('level') == 4): ?> selected<?php endif; ?>><?php echo $levelname['level3']; ?></option>
        <option value="5" <?php if(\think\Request::instance()->param('level') == 5): ?> selected<?php endif; ?>><?php echo $levelname['level4']; ?></option>
        <option value="6" <?php if(\think\Request::instance()->param('level') == 6): ?> selected<?php endif; ?>><?php echo $levelname['level5']; ?></option>
    </select>
    <select name="pay_type" class="select-box" style="height: 31px;width: 150px">
        <option value="0" <?php if(\think\Request::instance()->param('pay_type') == 0): ?> selected<?php endif; ?>>请选择订单状态</option>
        <option value="1" <?php if(\think\Request::instance()->param('pay_type') == 1): ?> selected<?php endif; ?>>已支付</option>
        <option value="2" <?php if(\think\Request::instance()->param('pay_type') == 2): ?> selected<?php endif; ?>>未支付</option>
    </select>
    <input type="text" class="input-text" style="width: 150px" placeholder="开始时间" readonly  onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" name="start_time">
    <input type="text" class="input-text" style="width: 150px" placeholder="结束时间" readonly  onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" name="end_time">

    <div class="btn btn-success" id="" name="" onclick="ext()"><i class="Hui-iconfont">&#xe665;</i> 搜索</div>
    <div class="btn btn-success"  onclick="ex()">导出Excel</div>

</form>
    <div class="cl pd-5 bg-1 bk-gray">
        <span class="l">
        </span>
        <span class="r pt-5 pr-5">
            共有数据 ：<strong><?php echo $count; ?></strong> 条
        </span>
    </div>
    <table class="table table-border table-bordered table-hover table-bg mt-20">
        <thead>
        <tr class="text-c">
            <th>订单号</th>
<th>购买者</th>
<th>手机号</th>
<th>等级</th>
<th>订单类型</th>
<th>购买时间</th>
<th>金额</th>
<th>支付状态</th>
<th>购买的课程</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <tr class="text-c">
            <td><?php echo $vo['order_no']; ?></td>
<td><?php echo $vo['nick_name']; ?></td>
<td><?php if($vo['phone'] == ''): ?>暂未绑定<?php else: ?><?php echo $vo['phone']; endif; ?></td>
<td><?php if($vo['level'] == 0): ?><?php echo $levelname['level0']; elseif($vo['level'] == 1): ?><?php echo $levelname['level1']; elseif($vo['level'] == 2): ?><?php echo $levelname['level2']; elseif($vo['level'] == 3): ?><?php echo $levelname['level3']; elseif($vo['level'] == 4): ?><?php echo $levelname['level4']; elseif($vo['level'] == 5): ?><?php echo $levelname['level5']; endif; ?></td>
<td>
    <?php if($vo['order_type'] == 1): ?>购买课程订单
    <?php elseif($vo['order_type'] == 3): ?>购买代理订单
    <?php elseif($vo['order_type'] == 4): ?>购买VIP订单
    <?php endif; ?></td>
<td><?php echo $vo['add_time']; ?></td>
<td><?php if($vo['money'] == -1): ?>vip赠送<?php elseif($vo['money'] == 0): ?>礼包赠送<?php else: ?><?php echo $vo['money']; endif; ?></td>
<td><?php if($vo['pay_type'] == 0): ?> <span style="color: red">未付款</span> <?php else: ?> <span style="color: #00B83F">已付款</span> <?php endif; ?></td>
<td><?php echo isset($vo['course_title']) ? $vo['course_title'] :  '非课程订单'; ?></td>
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

<script>
    function ex() {
        $('#form').attr('action',"<?php echo url('OrderList/excel'); ?>");
        $('#form').submit();
    }
    function ext() {
        $('#form').attr('action',"<?php echo url('OrderList/index'); ?>");
        $('#form').submit();
    }
</script>

</body>
</html>