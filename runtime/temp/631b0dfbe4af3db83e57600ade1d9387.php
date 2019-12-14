<?php if (!defined('THINK_PATH')) exit(); /*a:6:{s:85:"/www/wwwroot/jinli.sxzywl.net/public/../application/admin/view/course_info/index.html";i:1573288807;s:81:"/www/wwwroot/jinli.sxzywl.net/public/../application/admin/view/template/base.html";i:1568942460;s:92:"/www/wwwroot/jinli.sxzywl.net/public/../application/admin/view/template/javascript_vars.html";i:1488957233;s:84:"/www/wwwroot/jinli.sxzywl.net/public/../application/admin/view/course_info/form.html";i:1573005656;s:82:"/www/wwwroot/jinli.sxzywl.net/public/../application/admin/view/course_info/th.html";i:1573096015;s:82:"/www/wwwroot/jinli.sxzywl.net/public/../application/admin/view/course_info/td.html";i:1576217372;}*/ ?>
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
    <input type="text" class="input-text" style="width:250px" placeholder="章节标题" name="course_info_title" value="<?php echo \think\Request::instance()->param('course_info_title'); ?>">
    <input type="hidden" class="input-text" style="width:250px" placeholder="章节标题" name="course_id" value="<?php echo $course_id; ?>">
    <button type="submit" class="btn btn-success" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜索</button>
</form>
    <div class="cl pd-5 bg-1 bk-gray">
        <span class="l">
            <a class="btn btn-primary radius mr-5" href="javascript:;" onclick="layer_open('添加','<?php echo url('CourseInfo/add',array('course_id' => $course_id)); ?>')"><i class="Hui-iconfont"></i> 添加</a>
            <a href="javascript:;" onclick="saveOrderNot('<?php echo url('course_info/saveOrder'); ?>')" class="btn btn-primary radius mr-5"><i class="Hui-iconfont"></i> 保存排序</a>
        </span>
        <span class="r pt-5 pr-5">
            共有数据 ：<strong><?php echo $count; ?></strong> 条
        </span>
    </div>
    <table class="table table-border table-bordered table-hover table-bg mt-20">
        <thead>
        <tr class="text-c">
            <th width="25"><input type="checkbox" value="" name=""></th>
<th width="25">ID</th>
<th width="">所属课程</th>
<th width="">章节标题</th>
<th width="25">章节类型</th>
<!--<th width="">章节价格</th>-->
<!--<th width="">VIP价格</th>-->
<th width="25">是否试听</th>
<th width="25">观看数量</th>
<th width="">添加时间</th>
<th width="">修改时间</th>
<th width="25"><?php echo sort_by('排序','sort'); ?></th>
            <th width="150">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <tr class="text-c">
            <td><input type="checkbox" name="id[]" value="<?php echo $vo['id']; ?>"></td>
<td><?php echo $vo['id']; ?></td>
<td><?php echo $vo['course_title']; ?></td>
<td><?php echo $vo['course_info_title']; ?></td>
<td><?php if($vo['course_info_type'] == 2): ?>视频<?php else: ?>音频<?php endif; ?></td>
<!--<td><?php echo $vo['course_info_money']; ?></td>-->
<!--<td><?php echo $vo['course_info_vip_money']; ?></td>-->
<td><?php if($vo['course_info_auth'] == 1): ?> <span style="color: #00B83F">是</span><?php else: ?> <span style="color: red">否</span> <?php endif; ?></td>
<td><?php echo $vo['course_info_look_num']; ?></td>
<td><?php echo date("Y-m-d H:i:s",$vo['course_info_add_time']); ?></td>
<td><?php if($vo['course_info_update_time'] !=0): ?><?php echo date('Y-m-d H:i:s',$vo['course_info_update_time']); else: ?>--<?php endif; ?></td>
<td style="padding: 0">
    <input type="number" name="sort[<?php echo $vo['id']; ?>]" value="<?php echo $vo['sort']; ?>" style="width: 60px;"
           class="input-text text-c order-input" data-id="<?php echo $vo['id']; ?>"></td>


            <td class="f-14">
                <!--<?php echo show_status($vo['status'],$vo['id']); ?>-->
                <?php if (\Rbac::AccessCheck('edit')) : ?> <a title="编辑" href="javascript:;" onclick="layer_open('编辑','<?php echo \think\Url::build('edit', ['id' => $vo["id"], ]); ?>')" style="text-decoration:none" class="ml-5"><i class="Hui-iconfont">&#xe6df;</i></a><?php endif; if (\Rbac::AccessCheck('deleteforever')) : ?> <a href="javascript:;" onclick="del_forever(this,'<?php echo $vo['id']; ?>','<?php echo \think\Url::build('deleteforever', []); ?>')" class="label label-danger radius ml-5">彻底删除</a><?php endif; ?>
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
    function saveOrderNot(url, select) {
        var data = {};
        $(select || ".order-input").each(function (index, item) {
            data[$(item).attr('data-id')] = $(item).val();
        });
        if (data.length == 0) {
            layer.msg('没有可排序的对象');
            return;
        }
        $.ajax({
            url:url,
            type:'post',
            data:{
                sort:data
            },
            dataType:"json",
            success:function (e) {
                if(e.status == 1){
                    layer.msg(e.msg,{time:1000})
                }
                setInterval(function () {
                    location.reload()
                },1500)
            }

        })

    }
</script>

</body>
</html>