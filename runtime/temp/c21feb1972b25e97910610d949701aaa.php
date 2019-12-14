<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:77:"/www/wwwroot/jinli.sxzywl.net/public/../application/admin/view/user/edit.html";i:1574833798;s:81:"/www/wwwroot/jinli.sxzywl.net/public/../application/admin/view/template/base.html";i:1568942460;s:92:"/www/wwwroot/jinli.sxzywl.net/public/../application/admin/view/template/javascript_vars.html";i:1488957233;}*/ ?>
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
        <!--<div class="row cl">-->
            <!--<label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>头像：</label>-->
            <!--<div class="formControls col-xs-6 col-sm-6">-->
                <!--<input type="hidden" name="head" class="input-text" value="<?php echo isset($vo['head']) ? $vo['head'] :  ''; ?>">-->
                <!--<input type="file" id="cover" name="cover" style="display: none">-->
                <!--<label for="cover" >-->
                    <!--<?php if(isset($vo)): ?>-->
                    <!--<?php if($vo['head']): ?>-->
                    <!--<?php if($vo['head_type'] ==2): ?>-->
                    <!--<img src="__IMG__/uploads/img/<?php echo $vo['head']; ?>" style="width: 100px;height:100px">-->
                    <!--<?php else: ?>-->
                    <!--<img src="<?php echo $vo['head']; ?>" style="width: 100px;height:100px">-->
                    <!--<?php endif; ?>-->
                    <!--<?php else: ?>-->
                    <!--<span class="Hui-iconfont" style="font-size: 60px">&#xe642;</span>-->
                    <!--<?php endif; ?>-->
                    <!--<?php else: ?>-->
                    <!--<span class="Hui-iconfont" style="font-size: 60px">&#xe642;</span>-->
                    <!--<?php endif; ?>-->
                <!--</label>-->
            <!--</div>-->
            <!--<div class="col-xs-3 col-sm-3"></div>-->
        <!--</div>-->
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>头像：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="hidden" name="head" class="input-text" value="<?php echo isset($vo['head']) ? $vo['head'] :  ''; ?>">
                <input type="file" id="cover" name="cover" style="display: none">
                <label for="cover1" >
                    <img src="<?php echo $vo['head']; ?>" style="width: 100px;height:100px">
                </label>
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>昵称：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="text" class="input-text" name="nick_name" value="<?php echo isset($vo['nick_name']) ? $vo['nick_name'] :  ''; ?>" readonly>
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>手机号：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="text" class="input-text" name="phone" value="<?php echo isset($vo['phone']) ? $vo['phone'] :  ''; ?>" readonly>
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>上级Id：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="text" class="input-text" name="pid" readonly value="<?php echo isset($vo['pid']) ? $vo['pid'] :  ''; ?>">
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>等级：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <select name="level" id="" class="select-box level">
                    <option value="0" <?php if(isset($vo)): if($vo['level'] == 0): ?>selected<?php endif; endif; ?>><?php echo $levelname['level0']; ?></option>
                    <option value="1" <?php if(isset($vo)): if($vo['level'] == 1): ?>selected<?php endif; endif; ?>><?php echo $levelname['level1']; ?></option>
                    <option value="2" <?php if(isset($vo)): if($vo['level'] == 2): ?>selected<?php endif; endif; ?>><?php echo $levelname['level2']; ?></option>
                    <option value="3" <?php if(isset($vo)): if($vo['level'] == 3): ?>selected<?php endif; endif; ?>><?php echo $levelname['level3']; ?></option>
                    <option value="4" <?php if(isset($vo)): if($vo['level'] == 4): ?>selected<?php endif; endif; ?>><?php echo $levelname['level4']; ?></option>
                    <option value="5" <?php if(isset($vo)): if($vo['level'] == 5): ?>selected<?php endif; endif; ?>><?php echo $levelname['level5']; ?></option>
                </select>
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>

        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
                <button type="submit" class="btn btn-primary radius">&nbsp;&nbsp;提交&nbsp;&nbsp;</button>
                <button type="button" class="btn btn-default radius ml-20" onClick="layer_close();">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
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
<script type="text/javascript" charset="utf-8" src="__LIB__/ueditor/1.4.3/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="__LIB__/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>
<script>
    $(function () {
        var ue = UE.getEditor('course_t_ex',{
            toolbars: [["fullscreen","source","undo","redo","bold","italic","underline","fontborder","strikethrough","superscript","subscript","insertunorderedlist","insertorderedlist","justifyleft","justifycenter","justifyright","justifyjustify","removeformat","simpleupload","snapscreen","emotion","attachment"]]
        });

        $('.skin-minimal input').iCheck({
            checkboxClass: 'icheckbox-blue',
            radioClass: 'iradio-blue',
            increaseArea: '20%'
        });

        $("#form").Validform({
            tiptype:2,
            ajaxPost:true,
            showAllError:true,
            callback:function(ret){
                ajax_progress(ret);
            }
        });
    })

    $('#cover').change(function(){
        var this_obj  = $(this);
        this_obj.wrap("<form action='<?php echo url('course/savePic','',false,true); ?>' method='post' id='file_upload' enctype='multipart/form-data'></form>");
        //防止上传图片时，出现卡顿现象
        var loading = layer.load(3, {shade: [0.8, '#393D49']});

        $('#file_upload').ajaxSubmit({
            dataType:'json',
            success:function (data) {
                this_obj.unwrap();
                layer.close(loading);
                if(data.state == 1){
                    this_obj.next().html("<img src='__IMG__/uploads/img/"+ data.path +"'  style='width:100px;height:100px'>");
                    $('input[name=imgurl]').val(data.path);
                    this_obj.prev().attr('value',data.path);
                }else{
                    layer.msg(data.reason,{icon:5,time:1000});
                }
            },
            error:function (err) {
                console.log(err);
                this_obj.unwrap();
                layer.close(loading);
                layer.msg('网络错误，请重试！',{icon:5,time:1000});
            }
        });
    });

    $('.level').change(function () {
        layer.msg('监测到等级发生了变动!请谨慎操作',{icon:5,time:2000})
    })
</script>

</body>
</html>