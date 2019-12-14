<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:83:"/www/wwwroot/jinli.sxzywl.net/public/../application/admin/view/index_pic/index.html";i:1574834565;s:81:"/www/wwwroot/jinli.sxzywl.net/public/../application/admin/view/template/base.html";i:1568942460;s:92:"/www/wwwroot/jinli.sxzywl.net/public/../application/admin/view/template/javascript_vars.html";i:1488957233;}*/ ?>
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
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span><?php echo $levelname['level0']; ?>弹窗：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="hidden" name="index_pic" class="input-text" value="<?php echo isset($vo['index_pic']) ? $vo['index_pic'] :  ''; ?>">
                <input type="file" id="cover" class="cover" name="cover" style="display: none">
                <label for="cover" >
                    <?php if(isset($vo)): if(isset($vo['index_pic'])): ?>
                    <img src="<?php echo $vo['index_pic']; ?>" style="width: 100px;height:100px">
                    <?php else: ?>
                    <span class="Hui-iconfont" style="font-size: 60px">&#xe642;</span>
                    <?php endif; else: ?>
                    <span class="Hui-iconfont" style="font-size: 60px">&#xe642;</span>
                    <?php endif; ?>
                    <span >(上传图片大小为 <i style="color: red"> 240px X 240px</i>)</span>
                    <input type="text" class="input-text" placeholder="跳转地址" name="index_pic_url">
                </label>
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span><?php echo $levelname['level1']; ?>弹窗：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="hidden" name="index_pic1" class="input-text" value="<?php echo isset($vo['index_pic1']) ? $vo['index_pic1'] :  ''; ?>">
                <input type="file" id="cover1" class="cover" name="cover" style="display: none">
                <label for="cover1" >
                    <?php if(isset($vo)): if(isset($vo['index_pic1'])): ?>
                    <img src="<?php echo $vo['index_pic1']; ?>" style="width: 100px;height:100px">
                    <?php else: ?>
                    <span class="Hui-iconfont" style="font-size: 60px">&#xe642;</span>
                    <?php endif; else: ?>
                    <span class="Hui-iconfont" style="font-size: 60px">&#xe642;</span>
                    <?php endif; ?>
                    <span >(上传图片大小为 <i style="color: red"> 240px X 240px</i>)</span>
                    <input type="text" class="input-text" placeholder="跳转地址"  name="index_pic_url1">

                </label>
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span><?php echo $levelname['level2']; ?>弹窗：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="hidden" name="index_pic2" class="input-text" value="<?php echo isset($vo['index_pic2']) ? $vo['index_pic2'] :  ''; ?>">
                <input type="file" id="cover2" class="cover" name="cover" style="display: none">
                <label for="cover2" >
                    <?php if(isset($vo)): if(isset($vo['index_pic2'])): ?>
                    <img src="<?php echo $vo['index_pic2']; ?>" style="width: 100px;height:100px">
                    <?php else: ?>
                    <span class="Hui-iconfont" style="font-size: 60px">&#xe642;</span>
                    <?php endif; else: ?>
                    <span class="Hui-iconfont" style="font-size: 60px">&#xe642;</span>
                    <?php endif; ?>
                    <span >(上传图片大小为 <i style="color: red"> 240px X 240px</i>)</span>
                    <input type="text" class="input-text" placeholder="跳转地址"  name="index_pic_url2">

                </label>
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div> <div class="row cl">
        <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span><?php echo $levelname['level3']; ?>弹窗：</label>
        <div class="formControls col-xs-6 col-sm-6">
            <input type="hidden" name="index_pic3" class="input-text" value="<?php echo isset($vo['index_pic3']) ? $vo['index_pic3'] :  ''; ?>">
            <input type="file" id="cover3" class="cover" name="cover" style="display: none">
            <label for="cover3" >
                <?php if(isset($vo)): if(isset($vo['index_pic3'])): ?>
                <img src="<?php echo $vo['index_pic3']; ?>" style="width: 100px;height:100px">
                <?php else: ?>
                <span class="Hui-iconfont" style="font-size: 60px">&#xe642;</span>
                <?php endif; else: ?>
                <span class="Hui-iconfont" style="font-size: 60px">&#xe642;</span>
                <?php endif; ?>
                <span >(上传图片大小为 <i style="color: red"> 240px X 240px</i>)</span>
                <input type="text" class="input-text" placeholder="跳转地址"  name="index_pic_url3">

            </label>
        </div>
        <div class="col-xs-3 col-sm-3"></div>
    </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span><?php echo $levelname['level4']; ?>弹窗：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="hidden" name="index_pic4" class="input-text" value="<?php echo isset($vo['index_pic']) ? $vo['index_pic'] :  ''; ?>">
                <input type="file" id="cover4" class="cover" name="cover" style="display: none">
                <label for="cover4" >
                    <?php if(isset($vo)): if(isset($vo['index_pic4'])): ?>
                    <img src="<?php echo $vo['index_pic4']; ?>" style="width: 100px;height:100px">
                    <?php else: ?>
                    <span class="Hui-iconfont" style="font-size: 60px">&#xe642;</span>
                    <?php endif; else: ?>
                    <span class="Hui-iconfont" style="font-size: 60px">&#xe642;</span>
                    <?php endif; ?>
                    <span >(上传图片大小为 <i style="color: red"> 240px X 240px</i>)</span>
                    <input type="text" class="input-text" placeholder="跳转地址"  name="index_pic_url4">

                </label>
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span><?php echo $levelname['level5']; ?>弹窗：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="hidden" name="index_pic5" class="input-text" value="<?php echo isset($vo['index_pic5']) ? $vo['index_pic5'] :  ''; ?>">
                <input type="file" id="cover5" class="cover" name="cover" style="display: none">
                <label for="cover5" >
                    <?php if(isset($vo)): if(isset($vo['index_pic5'])): ?>
                    <img src="<?php echo $vo['index_pic5']; ?>" style="width: 100px;height:100px">
                    <?php else: ?>
                    <span class="Hui-iconfont" style="font-size: 60px">&#xe642;</span>
                    <?php endif; else: ?>
                    <span class="Hui-iconfont" style="font-size: 60px">&#xe642;</span>
                    <?php endif; ?>
                    <span >(上传图片大小为 <i style="color: red"> 240px X 240px</i>)</span>
                    <input type="text" class="input-text" placeholder="跳转地址"  name="index_pic_url5">

                </label>
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>选择人员等级：</label>
            <div class="formControls col-xs-6 col-sm-6">

                        <div class="radio-box">
                            <input type="checkbox" name="checkbox[]" id="checkbox-1" value="1">
                            <label for="checkbox-1"><?php echo $levelname['level0']; ?></label>
                        </div>
                        <div class="radio-box">
                            <input type="checkbox" name="checkbox[]" id="checkbox-2" value="2">
                            <label for="checkbox-2"><?php echo $levelname['level1']; ?></label>
                        </div>
                        <div class="radio-box">
                            <input type="checkbox" name="checkbox[]" id="checkbox-3" value="3">
                            <label for="checkbox-3"><?php echo $levelname['level2']; ?></label>
                        </div>
                        <div class="radio-box">
                            <input type="checkbox" name="checkbox[]" id="checkbox-4" value="4">
                            <label for="checkbox-4"><?php echo $levelname['level3']; ?></label>
                        </div>
                        <div class="radio-box">
                            <input type="checkbox" name="checkbox[]" id="checkbox-5" value="5">
                            <label for="checkbox-5"><?php echo $levelname['level4']; ?></label>
                        </div>
                        <div class="radio-box">
                            <input type="checkbox" name="checkbox[]" id="checkbox-6" value="6">
                            <label for="checkbox-6"><?php echo $levelname['level5']; ?></label>
                        </div>
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
        var checks = ''.split(",");
        if (checks.length > 0){
            for (var i in checks){
                $("[name='checkbox[]'][value='"+checks[i]+"']").attr("checked", true);
            }
        }

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
        var checkarr = <?php echo $checkbox; ?>;
        for(var i=0;i<checkarr.length;i++){
            $('#checkbox-'+checkarr[i]).attr('checked',true);
        }
    })

    $('.cover').change(function(){
        var this_obj  = $(this);
        this_obj.wrap("<form action='<?php echo url('course/savePic','',false,true); ?>' method='post' id='file_upload' enctype='multipart/form-data'></form>");
        //防止上传图片时，出现卡顿现象
        var loading = layer.load(3, {shade: [0.8, '#393D49']});

        $('#file_upload').ajaxSubmit({
            dataType:'json',
            success:function (data) {
                console.log(data)
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