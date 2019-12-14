<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:77:"/www/wwwroot/jinli.sxzywl.net/public/../application/admin/view/code/edit.html";i:1574833798;s:81:"/www/wwwroot/jinli.sxzywl.net/public/../application/admin/view/template/base.html";i:1568942460;s:92:"/www/wwwroot/jinli.sxzywl.net/public/../application/admin/view/template/javascript_vars.html";i:1488957233;}*/ ?>
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
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>所属用户：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="hidden" class="input-text" name="userId" value="<?php echo isset($vo['userId']) ? $vo['userId'] :  ''; ?>">
                <input type="text" class="input-text userId" value="<?php echo !empty($vo['userId'])?getUser($vo['userId']) : ''; ?>"
                       onclick="getuser()">
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>code类型：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <select name="codeType" id="" class="select-box">
                    <option value="0">请选择code类型</option>
                    <option value="1">vip</option>
                    <option value="2">课程</option>
                </select>
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl level" style="display: none;">
            <label class="form-label col-xs-3 col-sm-3">指定等级：</label>
            <div class="formControls col-xs-6 col-sm-6 skin-minimal">
                <div class="radio-box">
                    <input type="radio" name="level" id="radio-1" value="1">
                    <label for="radio-1">VIP</label>
                </div>
                <div class="radio-box">
                    <input type="radio" name="level" id="radio-2" value="2">
                    <label for="radio-2">白银<?php echo $levelname['level1']; ?></label>
                </div>
                <div class="radio-box">
                    <input type="radio" name="level" id="radio-3" value="3">
                    <label for="radio-3">黄金<?php echo $levelname['level1']; ?></label>
                </div>
                <div class="radio-box">
                    <input type="radio" name="level" id="radio-4" value="4">
                    <label for="radio-4">铂金<?php echo $levelname['level1']; ?></label>
                </div>
                <div class="radio-box">
                    <input type="radio" name="level" id="radio-5" value="5">
                    <label for="radio-5">钻石<?php echo $levelname['level1']; ?></label>
                </div>
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl course" style="display: none">
            <label class="form-label col-xs-3 col-sm-3">指定等级：</label>
            <div class="formControls col-xs-6 col-sm-6 skin-minimal">
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>生成数量：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="text" class="input-text" name="num" value="<?php echo isset($vo['num']) ? $vo['num'] :  ''; ?>">
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>code前缀：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="text" class="input-text" name="codebef" value="<?php echo isset($vo['codebef']) ? $vo['codebef'] :  'JL'; ?>" datatype="*"
                       nullmsg="默认排序不能为空">
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>过期时间：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="text" class="input-text" name="day" style="width: 95%" datatype="*" nullmsg="过期时间不能为空"
                       value="<?php echo isset($vo['day']) ? $vo['day'] :  '15'; ?>">天
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


    function getuser() {
        layer_open('选择用户', "<?php echo url('code/getuser'); ?>");
    }

    function setChoose(id, name) {
        $('[name=userId]').val(id);
        $('.userId').val(name)
    }

    $('[name=codeType]').change(function () {
        var type = $(this).val();
        if (type == 1) {
            $('.level').show();
            $('.course').hide();
        } else {

            var data = <?php echo getcourse(); ?>;
            console.log(data.length)
            var str = '';
            for (var i = 0; i < data.length; i++) {
                str += '<div class="radio-box">' +
                    '<input type="radio" name="course_id" id="radio-' + data[i].id + '" value="' + data[i].id + '">' +
                    '<label for="radio-' + data[i].id + '">' + data[i].course_title + '</label>' +
                    '</div>';
            }
            $('.course .skin-minimal').html(str);
            $('.level').hide();
            $('.course').show();
        }
    })
</script>

</body>
</html>