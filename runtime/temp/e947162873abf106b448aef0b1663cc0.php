<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:79:"/www/wwwroot/jinli.sxzywl.net/public/../application/admin/view/sales/index.html";i:1576218057;s:81:"/www/wwwroot/jinli.sxzywl.net/public/../application/admin/view/template/base.html";i:1568942460;s:92:"/www/wwwroot/jinli.sxzywl.net/public/../application/admin/view/template/javascript_vars.html";i:1488957233;}*/ ?>
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
    <!--<p class="c-red">以下为静态展示内容</p>-->
    <div style="margin-top: 20px">
        <table class="table table-border table-bordered table-bg">
            <thead>
            <tr>
                <th colspan="7" scope="col">销售信息统计
                    <form class="mb-20" method="get" action="<?php echo \think\Url::build(\think\Request::instance()->action()); ?>">
                        <input type="text" class="input-text" style="width: 150px;" placeholder="课程名称"
                               name="course_title" value="<?php echo \think\Request::instance()->param('course_title'); ?>">
                        <input type="text" class="input-text" style="width: 150px" placeholder="开始时间" readonly
                               onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" name="start_time">
                        <input type="text" class="input-text" style="width: 150px" placeholder="结束时间" readonly
                               onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" name="end_time">
                        <button type="submit" class="btn btn-success" id="" name=""><i class="Hui-iconfont">&#xe665;</i>
                            搜索
                        </button>
                    </form>
                    <form action="<?php echo url('Sales/excel'); ?>" method="post">
                        <input type="text" class="input-text" style="width: 150px;" placeholder="课程名称"
                               name="course_title"  value="<?php echo \think\Request::instance()->param('course_title'); ?>">
                        <input type="text" class="input-text" style="width: 150px" placeholder="开始时间" readonly
                               onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" name="start_time">
                        <input type="text" class="input-text" style="width: 150px" placeholder="结束时间" readonly
                               onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" name="end_time">
                        <button class="btn btn-success" type="submit">导出Excel</button>
                    </form>
                </th>
            </tr>
            <tr class="text-c">
                <th>课程标题</th>
                <th>课程价格</th>
                <th>销售量</th>
                <th>销售总金额</th>
                <!--<th>销售时间</th>-->
            </tr>
            </thead>
            <tbody>
            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <tr class="text-c">
                <td><?php echo $vo['course_title']; ?></td>
                <td><?php echo isset($vo['course_money']) ? $vo['course_money'] : 0; ?></td>
                <td><?php echo isset($vo['buy_num']) ? $vo['buy_num'] :  0; ?></td>
                <td><?php echo isset($vo['total_money']) ? $vo['total_money'] :  0; ?></td>
                <!--<td><?php echo isset($vo['add_time']) ? $vo['add_time'] :  '暂无购买'; ?></td>-->
            </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>


            </tbody>
        </table>
        <div class="page-bootstrap"><?php echo $page; ?></div>
    </div>
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