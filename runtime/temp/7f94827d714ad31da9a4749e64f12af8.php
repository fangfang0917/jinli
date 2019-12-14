<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:79:"/www/wwwroot/jinli.sxzywl.net/public/../application/admin/view/course/edit.html";i:1576221558;s:81:"/www/wwwroot/jinli.sxzywl.net/public/../application/admin/view/template/base.html";i:1568942460;s:92:"/www/wwwroot/jinli.sxzywl.net/public/../application/admin/view/template/javascript_vars.html";i:1488957233;}*/ ?>
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
        <?php if(isset($vo)): ?>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>课程链接</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="text" class="input-text"  readonly   value="<?php echo isset($course_url) ? $course_url :  ''; ?>">
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <?php endif; ?>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>所属课程分类：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="hidden" name="course_classify_id" value="<?php echo isset($vo['course_classify_id']) ? $vo['course_classify_id'] :  ''; ?>" datatype="*" nullmsg="请选择所属课程">
                <input type="text" class="input-text" name="course_classify_title" readonly onclick="getCourseClasssify()" placeholder="点击选择所属课程" value="<?php echo isset($vo['course_classify_title']) ? $vo['course_classify_title'] :  ''; ?>">
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>课程单列封面：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="hidden" name="course_pic" class="input-text" value="<?php echo isset($vo['course_pic']) ? $vo['course_pic'] :  ''; ?>">
                <input type="file" id="cover" class="cover" name="cover" style="display: none">
                <label for="cover" >
                    <?php if(isset($vo)): if($vo['course_pic']): ?>
                    <img src="<?php echo $vo['course_pic']; ?>" style="max-width: 300px">
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
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>课程双列封面：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="hidden" name="course_pic1" class="input-text" value="<?php echo isset($vo['course_pic']) ? $vo['course_pic'] :  ''; ?>">
                <input type="file" id="cover1" class="cover" name="cover" style="display: none">
                <label for="cover1" >
                    <?php if(isset($vo)): if($vo['course_pic1']): ?>
                    <img src="<?php echo $vo['course_pic1']; ?>" style="max-width: 300px">
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
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>角标：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="hidden" name="course_pic_jiao" class="input-text" value="<?php echo isset($vo['course_pic_jiao']) ? $vo['course_pic_jiao'] :  ''; ?>">
                <input type="file" id="coverjiaobiao" class="cover" name="cover" style="display: none">
                <label for="coverjiaobiao" >
                    <?php if(isset($vo)): if($vo['course_pic_jiao']): ?>
                        <img src="<?php echo $vo['course_pic_jiao']; ?>" style="max-width: 300px">
                    <a href="javascript:;" onclick="deljiaobiao()">重置角标</a>
                        <?php else: ?>
                        <span class="Hui-iconfont" style="font-size: 60px">&#xe642;</span>
                        <?php endif; else: ?>
                    <span class="Hui-iconfont" style="font-size: 60px">&#xe642;</span>
                    <?php endif; ?>
                    
                    <span >(上传图片大小为 <i style="color: red"> 107px X 34px</i>)</span>
                </label>
            </div>
            <div class="col-xs-3 col-sm-3"></div>

        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>课程标题：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="text" class="input-text" name="course_title" value="<?php echo isset($vo['course_title']) ? $vo['course_title'] :  ''; ?>" datatype="*" nullmsg="课程标题不能为空">
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>课程描述：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="text" class="input-text" name="course_remark" value="<?php echo isset($vo['course_remark']) ? $vo['course_remark'] :  ''; ?>" datatype="*" nullmsg="课程描述不能为空">
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>课程原价：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="text" class="input-text" style="width: 90%" name="course_money" value="<?php echo isset($vo['course_money']) ? $vo['course_money'] :  ''; ?>"  datatype="*" nullmsg="原价不能为空">元
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>课程vip价格：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="text" class="input-text" style="width: 90%" name="course_vip_money" value="<?php echo isset($vo['course_vip_money']) ? $vo['course_vip_money'] :  ''; ?>"  datatype="*" nullmsg="vip价格不能为空">元
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>直接分润：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="text" class="input-text" style="width: 90%" name="course_money_op" value="<?php echo isset($vo['course_money_op']) ? $vo['course_money_op'] :  '0'; ?>"  datatype="*" nullmsg="直接分润不能为空">元
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>间接分润：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="text" class="input-text" style="width: 90%" name="course_money_op1" value="<?php echo isset($vo['course_money_op1']) ? $vo['course_money_op1'] :  '0'; ?>"  datatype="*" nullmsg="间接分润不能为空">元
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>观看人基数：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="text" class="input-text" name="course_look" value="<?php echo isset($vo['course_look']) ? $vo['course_look'] :  ''; ?>"  datatype="*" nullmsg="vip价格不能为空">
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>购买人基数：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="text" class="input-text" name="buy_num" value="<?php echo isset($vo['buy_num']) ? $vo['buy_num'] :  ''; ?>"  datatype="*" nullmsg="vip价格不能为空">
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>课程简介：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <textarea type="text" id="course_t_ex" name="course_t_ex" value=""><?php echo isset($vo['course_t_ex']) ? $vo['course_t_ex'] :  ''; ?></textarea>
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>请选择赠送会员等级：</label>
            <div class="formControls col-xs-6 col-sm-6">
                    <select name="course_isvip" class="select-box">
                        <option value="0" <?php if(isset($vo)): if($vo['course_isvip'] == 0): ?> selected  <?php endif; endif; ?>>请选择赠送会员等级</option>
                        <option value="1" <?php if(isset($vo)): if($vo['course_isvip'] == 1): ?> selected  <?php endif; endif; ?>><?php echo $levelname['level1']; ?></option>
                        <option value="2" <?php if(isset($vo)): if($vo['course_isvip'] == 2): ?> selected  <?php endif; endif; ?>><?php echo $levelname['level2']; ?></option>
                        <option value="3" <?php if(isset($vo)): if($vo['course_isvip'] == 3): ?> selected  <?php endif; endif; ?>><?php echo $levelname['level3']; ?></option>
                        <option value="4" <?php if(isset($vo)): if($vo['course_isvip'] == 4): ?> selected  <?php endif; endif; ?>><?php echo $levelname['level4']; ?></option>
                        <option value="5" <?php if(isset($vo)): if($vo['course_isvip'] == 5): ?> selected  <?php endif; endif; ?>><?php echo $levelname['level5']; ?></option>
                    </select>
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>是否首页推荐：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <select name="course_index" class="select-box">
                    <option value="0">请选择是否首页推荐</option>
                    <option value="1" <?php if(isset($vo)): if($vo['course_index']==1): ?>selected<?php endif; endif; ?>>是</option>
                    <option value="2" <?php if(isset($vo)): if($vo['course_index']==2): ?>selected<?php endif; endif; ?>>否</option>
                </select>
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>是否免费观看：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <div class="radio-box">
                    <input type="checkbox" name="level[]" id="checkbox-2" <?php if(isset($vo)): if($vo['level'] != "0"): if(in_array(1,json_decode($vo['level'],true))): ?>checked<?php endif; endif; endif; ?> value="1">
                    <label for="checkbox-2"><?php echo $levelname['level1']; ?></label>
                </div>
                <div class="radio-box">
                    <input type="checkbox" name="level[]" id="checkbox-3" <?php if(isset($vo)): if($vo['level'] != "0"): if(in_array(2,json_decode($vo['level'],true))): ?>checked<?php endif; endif; endif; ?> value="2">
                    <label for="checkbox-3"><?php echo $levelname['level2']; ?></label>
                </div>
                <div class="radio-box">
                    <input type="checkbox" name="level[]" id="checkbox-4" <?php if(isset($vo)): if($vo['level'] != "0"): if(in_array(3,json_decode($vo['level'],true))): ?>checked<?php endif; endif; endif; ?> value="3">
                    <label for="checkbox-4"><?php echo $levelname['level3']; ?></label>
                </div>
                <div class="radio-box">
                    <input type="checkbox" name="level[]" id="checkbox-5" <?php if(isset($vo)): if($vo['level'] != "0"): if(in_array(4,json_decode($vo['level'],true))): ?>checked<?php endif; endif; endif; ?> value="4">
                    <label for="checkbox-5"><?php echo $levelname['level4']; ?></label>
                </div>
                <div class="radio-box">
                    <input type="checkbox" name="level[]" id="checkbox-6" <?php if(isset($vo)): if($vo['level'] != "0"): if(in_array(5,json_decode($vo['level'],true))): ?>checked<?php endif; endif; endif; ?> value="5">
                    <label for="checkbox-6"><?php echo $levelname['level5']; ?></label>
                </div>
                <div class="radio-box">
                    <input type="checkbox" name="level[]" id="checkbox-7" <?php if(isset($vo)): if($vo['level'] != "0"): if(in_array(6,json_decode($vo['level'],true))): ?>checked<?php endif; endif; endif; ?> value="6">
                    <label for="checkbox-7"><?php echo $levelname['level0']; ?></label>
                </div>
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>


        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>是否是在线课程：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <select name="on_line" id="" class="select-box">
                    <option value="0">请选择是否是在线课程</option>
                    <option value="1"  <?php if(isset($vo)): if($vo['on_line']==1): ?>selected<?php endif; endif; ?>>是</option>
                    <option value="2"  <?php if(isset($vo)): if($vo['on_line']==2): ?>selected<?php endif; endif; ?>>否</option>
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
            toolbars: [["fullscreen", "source", "undo", "redo", "bold", "italic", "underline", "fontborder", "strikethrough", "superscript", "subscript", "insertunorderedlist", "insertorderedlist", "justifyleft", "justifycenter", "justifyright", "justifyjustify", "removeformat", "simpleupload", "snapscreen", "emotion", "attachment"]],
            initialFrameHeight:450,
            initialFrameWidth:"100%",
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

    function choose(id,name) {
        $('input[name=course_classify_title]').val(name);
        $('input[name=course_classify_id]').val(id);
    }

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
                    this_obj.next().html("<img src='"+ data.path +"'  style='max-width: 300px'>");
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
    
    function getCourseClasssify() {
        layer_open('选择所属课程',"<?php echo url('Course/getCourseClassify'); ?>")
    }
    
    
    
    function deljiaobiao() {
        var  id = $('input[name=id]').val();
        $.ajax({
            url:"<?php echo url('course/deljiaobiao'); ?>",
            type:"post",
            data:{
                id:id
            },
            dataType:"json",
            success:function (e) {
                layer.msg(e.msg,{icon:6,time:1000})
                setInterval(function () {
                       window.location.reload();
                },1500)
            },
            error:function (e) {
                console.log(e);
            }
        })
    }
</script>

</body>
</html>