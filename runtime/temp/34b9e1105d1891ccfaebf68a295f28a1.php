<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:82:"/www/wwwroot/jinli.sxzywl.net/public/../application/admin/view/outlevel/index.html";i:1576223952;s:81:"/www/wwwroot/jinli.sxzywl.net/public/../application/admin/view/template/base.html";i:1568942460;s:92:"/www/wwwroot/jinli.sxzywl.net/public/../application/admin/view/template/javascript_vars.html";i:1488957233;}*/ ?>
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
        <input type="text" class="input-text" style="width:250px" placeholder="用户昵称" name="nick_name"
               value="<?php echo \think\Request::instance()->param('course_title'); ?>">
        <button type="submit" class="btn btn-success" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜索</button>
    </form>
    <div class="cl pd-5 bg-1 bk-gray">
        <span class="l">
             <!--<?php if (\Rbac::AccessCheck('add')) : ?><a class="btn btn-primary radius mr-5" href="javascript:;" onclick="layer_open('添加','<?php echo \think\Url::build('add', []); ?>')"><i class="Hui-iconfont">&#xe600;</i> 添加</a><?php endif; if (\Rbac::AccessCheck('forbid')) : ?><a href="javascript:;" onclick="forbid_all('<?php echo \think\Url::build('forbid', []); ?>')" class="btn btn-warning radius mr-5"><i class="Hui-iconfont">&#xe631;</i> 禁用</a><?php endif; if (\Rbac::AccessCheck('resume')) : ?><a href="javascript:;" onclick="resume_all('<?php echo \think\Url::build('resume', []); ?>')" class="btn btn-success radius mr-5"><i class="Hui-iconfont">&#xe615;</i> 恢复</a><?php endif; if (\Rbac::AccessCheck('aveorder')) : ?><a href="javascript:;" onclick="saveOrder()" class="btn btn-primary radius mr-5"><i class="Hui-iconfont">&#xe632;</i> 保存排序</a><?php endif; ?>-->
        </span>
        <span class="r pt-5 pr-5">
            共有数据 ：<strong><?php echo $count; ?></strong> 条
        </span>
    </div>
    <table class="table table-border table-bordered table-hover table-bg mt-20">
        <thead>
        <tr class="text-c">
            <th>ID</th>
            <th>申请人</th>
            <th>真实姓名</th>
            <th>手机号</th>
            <th>联系地址</th>
            <th>等级</th>
            <th>金额</th>
            <th>申请时间</th>
            <th>审核状态</th>
            <th>审核时间</th>
            <th width="150">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <tr class="text-c">
            <td><?php echo $vo['id']; ?></td>
            <td><?php echo $vo['nick_name']; ?></td>
            <td><?php echo $vo['realname']; ?></td>
            <td><?php echo $vo['phone']; ?></td>
            <td><?php echo $vo['addr']; ?></td>
            <td><?php echo $vo['level']; ?></td>
            <td><?php echo $vo['amount']; ?>元</td>
            <td><?php echo date('Y-m-d H:i:s',$vo['createtime']); ?></td>
            <td><?php if($vo['type'] == 0): ?>待签约<?php elseif($vo['type'] == 1): ?>签约成功<?php else: ?>签约未成功<?php endif; ?></td>
            <td><?php if($vo['type'] == 0): ?>待签约<?php elseif($vo['type'] == 1): ?><?php echo date('Y-m-d H:i:s',$vo['uptime']); else: ?>签约未成功<?php endif; ?>
            </td>

            <td class="f-14">
                <?php if($vo['type'] ==1): ?>
                <a href="javascript:;" class="label radius label-success">已审核,签约成功</a>
                <?php elseif($vo['type'] == 2): ?>
                <a href="javascript:;" class="label label-warning radius">已审核,签约未成功</a>
                <?php else: ?>
                <a href="javascript:istype('<?php echo $vo['id']; ?>',1);" class="label radius label-success" data-id="<?php echo $vo['id']; ?>"
                   data-type="1">签约成功</a>
                <a href="javascript:istype('<?php echo $vo['id']; ?>',2);" class="label label-warning radius " data-id="<?php echo $vo['id']; ?>"
                   data-type="2">签约未成功</a>
                <?php endif; ?>
            </td>
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
    function istype(id, type) {
        layer.confirm('请核实是否签约？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.ajax({
                url: "<?php echo url('Outlevel/isType'); ?>",
                type: "post",
                data: {
                    id: id,
                    type: type
                },
                dataType: "json",
                success: function (e) {
                    console.log(e);
                    if(e.state == 1){
                        layer.msg(e.msg,{icon:6,time:1000});
                        setInterval(function () {
                            location.reload();
                        },2000)
                    }else{
                        layer.msg('网络错误!请重试',{icon:5,time:1000});

                    }
                },
                error: function (e) {
                    console.log(e);
                    layer.msg('网络错误!请重试',{icon:5,time:1000});

                }
            })
        }, function(){
            layer_close();
        });
    }
</script>

</body>
</html>