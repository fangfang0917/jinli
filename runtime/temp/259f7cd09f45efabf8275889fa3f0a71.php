<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:84:"/www/wwwroot/jinli.sxzywl.net/public/../application/admin/view/course_info/edit.html";i:1576220651;s:81:"/www/wwwroot/jinli.sxzywl.net/public/../application/admin/view/template/base.html";i:1568942460;s:92:"/www/wwwroot/jinli.sxzywl.net/public/../application/admin/view/template/javascript_vars.html";i:1488957233;}*/ ?>
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


<div class="page-container">
    <form class="form form-horizontal" id="form" method="post" action="<?php echo \think\Request::instance()->baseUrl(); ?>">
        <input type="hidden" name="id" value="<?php echo isset($vo['id']) ? $vo['id'] :  ''; ?>">
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>所属课程：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="hidden" name="course_id" value="<?php echo isset($vvo['id']) ? $vvo['id'] :  ''; ?>">
                <input type="text" class="input-text" name="" readonly value="<?php echo isset($vvo['course_title']) ? $vvo['course_title'] :  ''; ?>">
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>章节标题：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="text" class="input-text" name="course_info_title" value="<?php echo isset($vo['course_info_title']) ? $vo['course_info_title'] :  ''; ?>"
                       datatype="*" nullmsg="章节标题不能为空">
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>章节描述：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="text" class="input-text" name="course_info_remarks" value="<?php echo isset($vo['course_info_remarks']) ? $vo['course_info_remarks'] :  ''; ?>"
                       datatype="*" nullmsg="章节描述不能为空">
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl course_info_content" <?php if(isset($vo)): if($vo['course_info_type'] == 1): ?>style="display: block" <?php else: ?>style="display: none" <?php endif; else: ?>style="display: none"<?php endif; ?>>
        <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>章节内容：</label>
        <div class="formControls col-xs-6 col-sm-6">
            <textarea type="text" id="course_info_content"
                      name="course_info_content"><?php echo isset($vo['course_info_content']) ? $vo['course_info_content'] :  ''; ?></textarea>
        </div>
        <div class="col-xs-3 col-sm-3"></div>
</div>

<div class="row cl course_info_path">


    <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>上传视频/音频：</label>
    <div class="formControls col-xs-6 col-sm-6">
        <input type="text" class="input-text" placeholder="视频时间  格式   x分x秒" name="course_info_path_time" value="<?php echo isset($vo['course_info_path_time']) ? $vo['course_info_path_time'] :  ''; ?>">
        <input type="text" class="input-text" placeholder="视频地址" name="course_info_path" value="<?php echo isset($vo['course_info_path']) ? $vo['course_info_path'] :  ''; ?>">
        <!--<input type="file" id="video" name="video" style="display: none">-->
        <!--<input type="hidden" name="course_info_type" >-->
        <!--<label for="video">-->
            <!--<?php if(isset($vo)): ?>-->
            <!--<?php if($vo['course_info_path']): ?>-->
            <!--<video src="<?php echo $vo['course_info_path']; ?>" style="width: 100%;"></video>-->
            <!--<i class="Hui-iconfont"-->
               <!--style="font-size:50px;position:absolute;margin-top: -35%;margin-left: 40%;color:red;z-index: 999"-->
               <!--onclick="layer_open('播放视频','<?php echo url('CourseInfo/play','',false,true); ?>')">&#xe6e6;</i>-->
            <!--<?php else: ?>-->
            <!--<span class="Hui-iconfont" style="font-size: 60px">&#xe642;</span>-->
            <!--<?php endif; ?>-->
            <!--<?php else: ?>-->
            <!--<span class="Hui-iconfont" style="font-size: 60px">&#xe642;</span>-->
            <!--<?php endif; ?>-->
            <!--<span>(上传视频/音频大小为 <i style="color: red"> 10M~50M</i>)</span>-->

        <!--</label>-->
    </div>
    <div class="col-xs-3 col-sm-3"></div>
</div>
<video style="display:none;" controls="controls" id="aa" oncanplaythrough="myFunction(this)">

</video>
<div class="row cl">
    <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>是否试听：</label>
    <div class="formControls col-xs-6 col-sm-6">
        <select name="course_info_auth" class="select-box">
            <option value="0">请选择章节是否试听</option>
            <option value="1" <?php if(isset($vo)): if($vo['course_info_auth'] == 1): ?>selected<?php endif; endif; ?>>是</option>
            <option value="2" <?php if(isset($vo)): if($vo['course_info_auth'] == 2): ?>selected<?php endif; endif; ?>>否</option>
        </select>
    </div>
    <div class="col-xs-3 col-sm-3"></div>
</div>
<div class="row cl">
    <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
        <button type="submit" class="btn btn-primary radius">&nbsp;&nbsp;提交&nbsp;&nbsp;</button>
        <button type="button" class="btn btn-default radius ml-20" onClick="layer_close();">&nbsp;&nbsp;取消&nbsp;&nbsp;
        </button>
    </div>
</div>
</form>
</div>

<script type="text/javascript" src="__LIB__/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="__LIB__/layer/2.4/layer.js"></script>
<script type="text/javascript" src="__STATIC__/h-ui/js/H-ui.js"></script>
<script type="text/javascript" src="__STATIC__/h-ui.admin/js/H-ui.admin.js"></script>
<script type="text/javascript" src="__STATIC__/js/app.js"></script>
<script type="text/javascript" src="__LIB__/icheck/jquery.icheck.min.js"></script>
<script type="text/javascript" src="__LIB__/My97DatePicker/WdatePicker.js"></script>

<script type="text/javascript" src="__LIB__/Validform/5.3.2/Validform.min.js"></script>
<script type="text/javascript" src="__LIB__/jquery.ajaxSubmit.js"></script>
<script type="text/javascript" charset="utf-8" src="__LIB__/ueditor/1.4.3/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="__LIB__/ueditor/1.4.3/ueditor.all.min.js"></script>
<script type="text/javascript" charset="utf-8" src="__LIB__/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>
<script>
    $(function () {
        var ue = UE.getEditor('course_info_content', {
            toolbars: [["fullscreen", "source", "undo", "redo", "bold", "italic", "underline", "fontborder", "strikethrough", "superscript", "subscript", "insertunorderedlist", "insertorderedlist", "justifyleft", "justifycenter", "justifyright", "justifyjustify", "removeformat", "simpleupload", "snapscreen", "emotion", "attachment"]]
        });

        $('.skin-minimal input').iCheck({
            checkboxClass: 'icheckbox-blue',
            radioClass: 'iradio-blue',
            increaseArea: '20%'
        });

        $("#form").Validform({
            tiptype: 2,
            ajaxPost: true,
            showAllError: true,
            callback: function (ret) {
                ajax_progress(ret);
            }
        });
    })
    $('.course_info_type').change(function () {
        var type = $(this).find("option:selected").val();
        if (type == 1) {
            $('.course_info_content').show();
            $('.course_info_path').hide();
        } else {
            $('.course_info_content').hide();
            $('.course_info_path').show();
        }
    })
    $('#cover').change(function () {
        var this_obj = $(this);
        this_obj.wrap("<form action='<?php echo url('course/savePic','',false,true); ?>' method='post' id='file_upload' enctype='multipart/form-data'></form>");
        //防止上传图片时，出现卡顿现象
        var loading = layer.load(3, {shade: [0.8, '#393D49']});

        $('#file_upload').ajaxSubmit({
            dataType: 'json',
            success: function (data) {
                console.log(data);
                this_obj.unwrap();
                layer.close(loading);
                if (data.state == 1) {
                    this_obj.next().html("<img src='" + data.path + "'  style='width:100px;height:100px'>");
                    $('input[name=imgurl]').val(data.path);
                    this_obj.prev().attr('value', data.path);
                } else {
                    layer.msg(data.msg, {icon: 5, time: 1000});
                }
            },
            error: function (err) {
                console.log(err);
                this_obj.unwrap();
                layer.close(loading);
                layer.msg('网络错误，请重试！', {icon: 5, time: 1000});
            }
        });
    });


    $('#video').change(function () {
        var this_obj = $(this);
        this_obj.wrap("<form action='<?php echo url('course/jie','',false,true); ?>' method='post' id='file_upload' enctype='multipart/form-data'></form>");
        //防止上传图片时，出现卡顿现象
        var loading = layer.load(3, {shade: [0.8, '#393D49']});

        $('#file_upload').ajaxSubmit({
            dataType: 'json',
            success: function (data) {
                console.log(data)
                this_obj.unwrap();
                layer.close(loading);
                if (data.state == 1) {
                    this_obj.next().html("<video src='" + data.path + "'  style='width:100%;' ></video>");
                    this_obj.prev().attr('value', data.path);
                    var str = '<i class="Hui-iconfont" style="font-size:50px;position:absolute;margin-top: -35%;margin-left: 40%;color:red;z-index: 999"  onclick="layer_open(\'播放视频\',\'<?php echo url('CourseInfo/play','',false,true); ?>\')">&#xe6e6;</i>'
                    $('#aa').attr('src', '' + data.path);
                    this_obj.before(str)
                    $('[name=course_info_type]').val(data.type);
                } else {
                    layer.msg(data.reason, {icon: 5, time: 1000});
                }
            },
            error: function (err) {
                console.log(err);
                this_obj.unwrap();
                layer.close(loading);
                layer.msg('网络错误，请重试！', {icon: 5, time: 1000});
            }
        });
    });

    function myFunction(ele) {
        var hour = parseInt((ele.duration) / 3600);
        var minute = parseInt((ele.duration % 3600) / 60);
        var second = Math.ceil(ele.duration % 60);
        console.log(Math.floor(ele.duration));
        console.log("这段视频的时长为：" + hour + "小时，" + minute + "分，" + second + "秒");
//        $('input[name=course_info_path_time]').val(hour+"小时"+minute+"分"+second+"秒");
        $('input[name=course_info_path_time]').val(minute + "分" + second + "秒");
    }
</script>

</body>
</html>