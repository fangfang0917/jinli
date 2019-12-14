<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:117:"D:\phpstudy_pro\WWW\jinli.sxzywl.net\jinli.sxzywl.net\public/../application/admin\view\course_info_comment\index.html";i:1573031399;s:105:"D:\phpstudy_pro\WWW\jinli.sxzywl.net\jinli.sxzywl.net\public/../application/admin\view\template\base.html";i:1568942460;s:116:"D:\phpstudy_pro\WWW\jinli.sxzywl.net\jinli.sxzywl.net\public/../application/admin\view\template\javascript_vars.html";i:1488957233;}*/ ?>
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
    
<style>
    .reply-box {
        width: 300px;
        height: 200px;
        position: fixed;
        top: 50%;
        left: 50%;
        margin-top: -100px;
        margin-left: -150px;
        border: 1px solid #C4C4C4;
        padding: 10px 10px 30px;
        background-color: #fff;
    }

    .reply-box span {
        float: left;
    }

    .reply-box i {
        float: right;
    }

    .reply-box textarea {
        width: 100%;
        height: 150px;
        border: 1px solid #C4C4C4;
        margin-top: 10px;
    }

    .btnn {
        width: 50px;
        text-align: center;
        padding: 5px 15px;
        border-radius: 10px;
        color: #fff
    }

    .reply-box .reply-succ {
        float: left;
        background-color: #09B540;
    }

    .reply-box .reply-err {
        float: right;
        background-color: #FF6D66;
    }
</style>

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
        <select name="course_classify_id" id="courseClassify" class="select-box" style="width:250px;height: 31px">

            <option value="">请先选择课程分类</option>
            <?php if(is_array($courseClassifyForm) || $courseClassifyForm instanceof \think\Collection || $courseClassifyForm instanceof \think\Paginator): $i = 0; $__LIST__ = $courseClassifyForm;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <option value="<?php echo $vo['id']; ?>" <?php if(\think\Request::instance()->param('course_classify_id') == $vo['id']): ?>selected<?php endif; ?>><?php echo $vo['course_classify_title']; ?></option>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
        <select name="course_id" id="course" class="select-box" style="width:250px;height: 31px;display: none">
        </select>

        <input type="text" class="input-text" style="width:250px" placeholder="用户昵称" name="nick_name"
               value="<?php echo \think\Request::instance()->param('nick_name'); ?>">
        <button type="submit" class="btn btn-success" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜索</button>
    </form>
    <div class="cl pd-5 bg-1 bk-gray">
    </div>
    <table class="table table-border table-bordered table-hover table-bg mt-20">
        <thead>
        <tr class="text-c">
            <th width="100">课程标题</th>
            <th width="150">评论人</th>
            <th width="150">评论时间</th>
            <th width="150">评论内容</th>
            <th width="150">审核状态</th>
            <!--<th width="150">回复内容</th>-->
            <!--<th width="150">回复时间</th>-->
            <th width="150">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <tr class="text-c">
            <td><?php echo $vo['course_title']; ?></td>
            <td><?php echo $vo['nick_name']; ?></td>
            <td><?php echo date('Y-m-d H:i:s',$vo['add_time']); ?></td>
            <td><?php echo $vo['course_comment_content']; ?></td>
            <td><?php if($vo['type'] == 1): ?> <span style="color:#00B83F;">通过</span><?php elseif($vo['type'] == 2): ?><span style="color:#f37b1d;">未通过</span><?php else: ?> <span style="color:#148cf1;">待审核</span><?php endif; ?></td>
            <!--<td><?php if(isset($vo)): if($vo['reply_time'] == 0): ?><span style="color: #f37b1d">未回复</span><?php else: ?><?php echo $vo['reply_content']; endif; endif; ?></td>-->
            <!--<td><?php if(isset($vo)): if($vo['reply_time'] == 0): ?><span style="color: #f37b1d">未回复</span><?php else: ?><?php echo date('Y-m-d H:i:s',$vo['reply_time']); endif; endif; ?></td>-->
            <td class="f-14">
                <?php if($vo['type'] ==1): ?>
                <a href="javascript:;" class="label radius label-success">已审核,通过</a>
                <?php if(!$vo['reply_content']): ?>
                <!--<a href="javascript:Reply('<?php echo $vo['id']; ?>');" class="label radius label-success">回复</a>-->
                <?php endif; elseif($vo['type'] == 2): ?>
                <a href="javascript:;" class="label label-warning radius">已审核,未通过</a>
                <?php else: ?>
                <a href="javascript:istype('<?php echo $vo['id']; ?>',1);" class="label radius label-success" data-id="<?php echo $vo['id']; ?>"
                   data-type="1">审核通过</a>
                <a href="javascript:istype('<?php echo $vo['id']; ?>',2);" class="label label-warning radius " data-id="<?php echo $vo['id']; ?>"
                   data-type="2">审核不通过</a>
                <?php endif; ?>

            </td>
        </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
    <div class="reply reply-box" style="display: none">
        <p><span>回复评论</span><i class="Hui-iconfont" onclick="cl()">&#xe6a6;</i></p>
        <textarea name="reply_content" id="reply" data-id="" placeholder="请填写回复"></textarea>
        <div class="btnn reply-succ" onclick="replyajax()">提交</div>
        <div class="btnn reply-err" onclick="cl()">取消</div>
    </div>

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
        console.log(id + '==========' + type);
        $.ajax({
            url: "<?php echo url('CourseInfoComment/type'); ?>",
            type: 'post',
            data: {
                id: id,
                type: type
            },
            dataType: 'json',
            success: function (e) {
                console.log(e);
                if (e.state == 1) {
                    layer.msg(e.msg, {icon: 6, time: 1000});
                    setInterval(function () {
                        location.reload();
                    }, 2000)
                } else {
                    layer.msg('网络错误!请重试', {icon: 5, time: 1000});
                    setInterval(function () {
                        location.reload();
                    }, 2000)
                }
            },
            error: function (e) {
                layer.msg('网络错误!请重试', {icon: 5, time: 1000});
                setInterval(function () {
                    location.reload();
                }, 2000)
            }
        })
    }

    function Reply(id) {
        $('#reply').attr('data-id', id);
        $('.reply').show();
    }
    function cl() {
        $('.reply').hide();
    }
    function replyajax() {
        var id = $('#reply').attr('data-id');
        var reply_content = $('#reply').val();
        if (reply_content == '') {
            layer.msg('请填写回复内容', {icon: 5, time: 1000});
            return false;
        }

        $.ajax({
            url: "<?php echo url('CourseInfoComment/addreply'); ?>",
            type: "post",
            data: {
                id: id,
                reply_content: reply_content
            },
            dataType: "json",
            success: function (e) {
                console.log(e);
                if (e.state == 1) {
                    $('.reply').hide();
                    layer.msg(e.msg, {icon: 6, time: 1000})
                } else {
                    layer.msg(e.msg, {icon: 5, time: 1000})
                }
                setInterval(function () {
                    location.reload();
                }, 2000)
            },
            error: function (e) {
                layer.msg('网络错误!请重试', {icon: 5, time: 1000})
            }
        })
        console.log(id);
        console.log(reply_content);
    }
    
   $('#courseClassify').change(function () {
       var id = $(this).val();
       $.ajax({
           url:"<?php echo url('CourseInfoComment/getCourse'); ?>",
           type:"post",
           data:{
               id:id
           },
           dataType:"json",
           success:function (e) {

                $('#course').html(e);
               $('#course').show();
           }
       })
   })
</script>

</body>
</html>