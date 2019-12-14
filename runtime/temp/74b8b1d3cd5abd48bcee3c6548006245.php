<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:106:"D:\phpstudy_pro\WWW\jinli.sxzywl.net\jinli.sxzywl.net\public/../application/admin\view\customer\index.html";i:1572939742;s:105:"D:\phpstudy_pro\WWW\jinli.sxzywl.net\jinli.sxzywl.net\public/../application/admin\view\template\base.html";i:1568942460;s:116:"D:\phpstudy_pro\WWW\jinli.sxzywl.net\jinli.sxzywl.net\public/../application/admin\view\template\javascript_vars.html";i:1488957233;}*/ ?>
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
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>客服电话：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="text" class="input-text" name="customer_phone"
                       value="<?php echo isset($vo['customer_phone']) ? $vo['customer_phone'] :  ''; ?>" datatype="*" nullmsg="客服电话">
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>客服微信号：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="text" class="input-text" name="customer_wxzh"
                       value="<?php echo isset($vo['customer_wxzh']) ? $vo['customer_wxzh'] :  ''; ?>" datatype="*" nullmsg="客服微信号">
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>客服二维码：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="hidden" name="wx" class="input-text" value="<?php echo isset($vo['wx']) ? $vo['wx'] :  ''; ?>">
                <input type="file" id="cover" class="cover" name="cover" style="display: none">
                <label for="cover" >
                    <?php if(isset($vo)): if($vo['wx']): ?>
                    <img src="<?php echo $vo['wx']; ?>" style="width: 100px;height:100px">
                    <?php else: ?>
                    <span class="Hui-iconfont" style="font-size: 60px">&#xe642;</span>
                    <?php endif; else: ?>
                    <span class="Hui-iconfont" style="font-size: 60px">&#xe642;</span>
                    <?php endif; ?>
                    <span >(上传图片大小为 <i style="color: red"> 120px X 120px</i>)</span>

                </label>
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>公众号二维码：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="hidden" name="wxgz" class="input-text" value="<?php echo isset($vo['wxgz']) ? $vo['wxgz'] :  ''; ?>">
                <input type="file" id="cover1" class="cover" name="cover" style="display: none">
                <label for="cover1" >
                    <?php if(isset($vo)): if($vo['wxgz']): ?>
                    <img src="<?php echo $vo['wxgz']; ?>" style="width: 100px;height:100px">
                    <?php else: ?>
                    <span class="Hui-iconfont" style="font-size: 60px">&#xe642;</span>
                    <?php endif; else: ?>
                    <span class="Hui-iconfont" style="font-size: 60px">&#xe642;</span>
                    <?php endif; ?>
                    <span >(上传图片大小为 <i style="color: red"> 120px X 120px</i>)</span>
                </label>
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>400电话：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="text" class="input-text" name="customer_FAQ"
                       value="<?php echo isset($vo['customer_FAQ']) ? $vo['customer_FAQ'] :  ''; ?>" datatype="*" nullmsg="400电话不能为空">
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

<script>
    $(function () {

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

    $('.cover').change(function(){
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
                    this_obj.next().html("<img src='"+ data.path +"'  style='width:100px;height:100px'>");
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
</script>

</body>
</html>