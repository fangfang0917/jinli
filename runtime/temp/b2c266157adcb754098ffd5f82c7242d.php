<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:105:"D:\phpstudy_pro\WWW\jinli.sxzywl.net\jinli.sxzywl.net\public/../application/admin\view\user_op\index.html";i:1575705639;s:105:"D:\phpstudy_pro\WWW\jinli.sxzywl.net\jinli.sxzywl.net\public/../application/admin\view\template\base.html";i:1568942460;s:116:"D:\phpstudy_pro\WWW\jinli.sxzywl.net\jinli.sxzywl.net\public/../application/admin\view\template\javascript_vars.html";i:1488957233;}*/ ?>
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
    .w {
        width: 30%
    }

    .s {
        width: 100px;
        text-align: right;
        display: inline-block;
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


<div class="page-container">
    <form class="form form-horizontal" id="form" method="post" action="<?php echo \think\Request::instance()->baseUrl(); ?>">
        <input type="hidden" name="id" value="<?php echo isset($vo['id']) ? $vo['id'] :  ''; ?>">
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span><?php echo $levelname['level1']; ?>费：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="number" class="input-text" name="vip_money" placeholder="<?php echo $levelname['level1']; ?>费"
                       value="<?php echo isset($data['vip_money']) ? $data['vip_money'] :  ''; ?>" style="width:80%;"
                       datatype="*" nullmsg="请填写<?php echo $levelname['level1']; ?>费">元
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>升级费用：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <div>
                    <span class="s"><?php echo $levelname['level2']; ?>:</span>
                    <input type="number" class="input-text w" name="vip_team_money_up" placeholder="<?php echo $levelname['level2']; ?>卡位直升费用"
                           value="<?php echo isset($data['vip_team_money_up']) ? $data['vip_team_money_up'] :  ''; ?>" datatype="*" nullmsg="请填写<?php echo $levelname['level2']; ?>卡位直升费用">元
                    <span class="s"><?php echo $levelname['level3']; ?>:</span>
                    <input type="number" class="input-text w" name="vip_team1_money_up" placeholder="<?php echo $levelname['level3']; ?>卡位直升费用"
                           value="<?php echo isset($data['vip_team1_money_up']) ? $data['vip_team1_money_up'] :  ''; ?>" datatype="*" nullmsg="请填写<?php echo $levelname['level3']; ?>卡位直升费用">元
                </div>
                <div>
                    <span class="s"><?php echo $levelname['level4']; ?>:</span>
                    <input type="number" class="input-text w"
                           name="vip_team2_money_up"
                           placeholder="<?php echo $levelname['level4']; ?>卡位直升费用"
                           value="<?php echo isset($data['vip_team2_money_up']) ? $data['vip_team2_money_up'] :  ''; ?>"
                           datatype="*" nullmsg="请填写<?php echo $levelname['level4']; ?>卡位直升费用">元
                    <span class="s"><?php echo $levelname['level5']; ?>:</span>
                    <input type="number" class="input-text w"
                           name="vip_team3_money_up"
                           placeholder="<?php echo $levelname['level5']; ?>卡位直升费用"
                           value="<?php echo isset($data['vip_team3_money_up']) ? $data['vip_team3_money_up'] :  ''; ?>"
                           datatype="*"
                           nullmsg="请填写<?php echo $levelname['level5']; ?>卡位直升费用">元
                </div>

            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>零售<?php echo $levelname['level1']; ?>收益：</label>
            <div class="formControls col-xs-6 col-sm-6" style="text-align:justify;">
                <div>
                    <span class="s"><?php echo $levelname['level1']; ?>(直):</span>
                    <input type="number" class="input-text w" name="vip_money_op1"
                           placeholder="<?php echo $levelname['level1']; ?>推荐收益(直接)" value="<?php echo isset($data['vip_money_op1']) ? $data['vip_money_op1'] :  ''; ?>" datatype="*"
                           nullmsg="请填写<?php echo $levelname['level1']; ?>推荐收益(直接)">元
                    <span class="s"><?php echo $levelname['level1']; ?>(间):</span>
                    <input type="number" class="input-text w" name="vip_money_op2"
                           placeholder="<?php echo $levelname['level1']; ?>推荐收益(间接)" value="<?php echo isset($data['vip_money_op2']) ? $data['vip_money_op2'] :  ''; ?>" datatype="*"
                           nullmsg="请填写<?php echo $levelname['level1']; ?>推荐收益(间接)">元
                </div>
                <div>
                    <span class="s"><?php echo $levelname['level2']; ?>(直):</span>
                    <input type="number" class="input-text w" name="vip_team_money_op1"
                           placeholder="<?php echo $levelname['level2']; ?>推荐收益(直接)" value="<?php echo isset($data['vip_team_money_op1']) ? $data['vip_team_money_op1'] :  ''; ?>" datatype="*"
                           nullmsg="请填写<?php echo $levelname['level2']; ?>推荐收益(直接)">元
                    <span class="s"><?php echo $levelname['level2']; ?>(间):</span>
                    <input type="number" class="input-text w" name="vip_team_money_op2"
                           placeholder="<?php echo $levelname['level2']; ?>推荐收益(间接)" value="<?php echo isset($data['vip_team_money_op2']) ? $data['vip_team_money_op2'] :  ''; ?>" datatype="*"
                           nullmsg="请填写<?php echo $levelname['level2']; ?>推荐收益(间接)">元
                </div>
                <div>
                    <span class="s"><?php echo $levelname['level3']; ?>(直):</span>
                    <input type="number" class="input-text w" name="vip_team1_money_op1"
                           placeholder="创联推荐收益(直接)" value="<?php echo isset($data['vip_team1_money_op1']) ? $data['vip_team1_money_op1'] :  ''; ?>" datatype="*"
                           nullmsg="请填写创联推荐收益(直接)">元
                    <span class="s"><?php echo $levelname['level3']; ?>(间):</span>
                    <input type="number" class="input-text w" name="vip_team1_money_op2"
                           placeholder="创联推荐收益(间接)" value="<?php echo isset($data['vip_team1_money_op2']) ? $data['vip_team1_money_op2'] :  ''; ?>" datatype="*"
                           nullmsg="请填写创联推荐收益(间接)">元
                </div>
                <div>
                    <span class="s"><?php echo $levelname['level4']; ?>(直):</span>
                    <input type="number" class="input-text w" name="vip_team2_money_op1"
                           placeholder="<?php echo $levelname['level4']; ?>推荐收益(直接)" value="<?php echo isset($data['vip_team2_money_op1']) ? $data['vip_team2_money_op1'] :  ''; ?>" datatype="*"
                           nullmsg="请填写<?php echo $levelname['level4']; ?>推荐收益(直接)">元
                    <span class="s"><?php echo $levelname['level4']; ?>(间):</span>
                    <input type="number" class="input-text w" name="vip_team2_money_op2"
                           placeholder="<?php echo $levelname['level4']; ?>推荐收益(间接)" value="<?php echo isset($data['vip_team2_money_op2']) ? $data['vip_team2_money_op2'] :  ''; ?>" datatype="*"
                           nullmsg="请填写<?php echo $levelname['level4']; ?>推荐收益(间接)">元
                </div>
                <div>
                    <span class="s"><?php echo $levelname['level5']; ?>(直):</span>
                    <input type="number" class="input-text w" name="vip_team3_money_op1"
                           placeholder="<?php echo $levelname['level5']; ?>推荐收益(直接)" value="<?php echo isset($data['vip_team3_money_op1']) ? $data['vip_team3_money_op1'] :  ''; ?>" datatype="*"
                           nullmsg="请填写<?php echo $levelname['level5']; ?>推荐收益(直接)">元
                    <span class="s"><?php echo $levelname['level5']; ?>(间):</span>
                    <input type="number" class="input-text w" name="vip_team3_money_op2"
                           placeholder="<?php echo $levelname['level5']; ?>推荐收益(间接)" value="<?php echo isset($data['vip_team3_money_op2']) ? $data['vip_team3_money_op2'] :  ''; ?>" datatype="*"
                           nullmsg="请填写<?php echo $levelname['level5']; ?>推荐收益(间接)">元
                </div>
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>代理推荐收益：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <div>
                    <span class="s"><?php echo $levelname['level2']; ?>:</span>
                    <input type="number" class="input-text w" name="vip_tui_c" placeholder="推荐<?php echo $levelname['level2']; ?>收益"
                           value="<?php echo isset($data['vip_tui_c']) ? $data['vip_tui_c'] :  ''; ?>"
                           datatype="*" nullmsg="请填写推荐<?php echo $levelname['level2']; ?>收益">元


                </div>
                <div>
                    <span class="s"><?php echo $levelname['level3']; ?>:</span>
                    <input type="number" class="input-text w" name="vip_tui_z" placeholder="推荐<?php echo $levelname['level3']; ?>收益"
                           value="<?php echo isset($data['vip_tui_z']) ? $data['vip_tui_z'] :  ''; ?>"
                           datatype="*" nullmsg="请填写推荐<?php echo $levelname['level3']; ?>收益">元


                </div>

                <div>
                    <span class="s"><?php echo $levelname['level4']; ?>:</span>
                    <input type="number" class="input-text w" name="vip_tui_g" placeholder="推荐<?php echo $levelname['level4']; ?>收益"
                           value="<?php echo isset($data['vip_tui_g']) ? $data['vip_tui_g'] :  ''; ?>"
                           datatype="*" nullmsg="请填写推荐<?php echo $levelname['level4']; ?>收益">元

                </div>
                <div>
                    <span class="s"><?php echo $levelname['level5']; ?>:</span>
                    <input type="number" class="input-text w" name="vip_tui_zj" placeholder="推荐<?php echo $levelname['level5']; ?>收益"
                           value="<?php echo isset($data['vip_tui_zj']) ? $data['vip_tui_zj'] :  ''; ?>"
                           datatype="*" nullmsg="请填写推荐<?php echo $levelname['level5']; ?>收益">元

                </div>
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>服务奖收益：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <div>
                    <span class="s"><?php echo $levelname['level2']; ?>:</span>
                    <input type="number" class="input-text w" name="vip_team_fuwu" placeholder="<?php echo $levelname['level2']; ?>服务奖比例"
                           value="<?php echo isset($data['vip_team_fuwu']) ? $data['vip_team_fuwu'] :  ''; ?>" datatype="*" nullmsg="请填写<?php echo $levelname['level2']; ?>服务奖比例">%
                </div>
                <div>
                    <span class="s"><?php echo $levelname['level3']; ?>:</span>
                    <input type="number" class="input-text w" name="vip_team1_fuwu" placeholder="<?php echo $levelname['level3']; ?>服务奖比例"
                           value="<?php echo isset($data['vip_team1_fuwu']) ? $data['vip_team1_fuwu'] :  ''; ?>" datatype="*" nullmsg="请填写<?php echo $levelname['level3']; ?>服务奖比例">%
                </div>
                <div>
                    <span class="s"><?php echo $levelname['level4']; ?>:</span>
                    <input type="number" class="input-text w" name="vip_team2_fuwu"
                           placeholder="<?php echo $levelname['level4']; ?>服务奖比例"
                           value="<?php echo isset($data['vip_team2_fuwu']) ? $data['vip_team2_fuwu'] :  ''; ?>" datatype="*" nullmsg="请填写<?php echo $levelname['level4']; ?>服务奖比例">%
                </div>
                <div>
                    <span class="s"><?php echo $levelname['level5']; ?>:</span>
                    <input type="number" class="input-text w" name="vip_team3_fuwu" placeholder="<?php echo $levelname['level5']; ?>服务奖比例"
                           value="<?php echo isset($data['vip_team3_fuwu']) ? $data['vip_team3_fuwu'] :  ''; ?>" datatype="*" nullmsg="请填写<?php echo $levelname['level5']; ?>服务奖比例">%
                </div>

            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>单课分成收益：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <div><span class="s">单笔直推:</span>
                    <input type="number" class="input-text w" name="op_danke_z" placeholder="单课直接收益"
                           value="<?php echo isset($data['op_danke_z']) ? $data['op_danke_z'] :  ''; ?>"
                           datatype="*" nullmsg="请填写单课直接收益">%
                </div>
                <div>
                    <span class="s">单笔间推:</span>
                    <input type="number" class="input-text w" name="op_danke_j" placeholder="单课间接收益"
                           value="<?php echo isset($data['op_danke_j']) ? $data['op_danke_j'] :  ''; ?>"
                           datatype="*" nullmsg="请填写单课间接收益">%
                </div>
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>推荐升级要求人数：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <div><span class="s"><?php echo $levelname['level2']; ?>:</span>
                    <input type="number" class="input-text w" name="agent_num" placeholder="<?php echo $levelname['level2']; ?>升级推荐人数"
                           value="<?php echo isset($data['agent_num']) ? $data['agent_num'] :  ''; ?>"
                           datatype="*" nullmsg="请填写<?php echo $levelname['level2']; ?>推荐升级要求">人
                </div>
                <div><span class="s"><?php echo $levelname['level3']; ?>:</span>
                    <input type="number" class="input-text w" name="cagent_num" placeholder="<?php echo $levelname['level3']; ?>升级推荐人数"
                           value="<?php echo isset($data['cagent_num']) ? $data['cagent_num'] :  ''; ?>"
                           datatype="*" nullmsg="请填写<?php echo $levelname['level3']; ?>推荐升级要求">人
                </div>
                <div><span class="s"><?php echo $levelname['level4']; ?>:</span>
                    <input type="number" class="input-text w" name="zagent_num" placeholder="<?php echo $levelname['level4']; ?>升级推荐人数"
                           value="<?php echo isset($data['zagent_num']) ? $data['zagent_num'] :  ''; ?>"
                           datatype="*" nullmsg="请填写<?php echo $levelname['level4']; ?>推荐升级要求">人
                </div>
                <div><span class="s"><?php echo $levelname['level5']; ?>:</span>
                    <input type="number" class="input-text w" name="zjagent_num" placeholder="<?php echo $levelname['level5']; ?>升级推荐人数"
                           value="<?php echo isset($data['zjagent_num']) ? $data['zjagent_num'] :  ''; ?>"
                           datatype="*" nullmsg="请填写<?php echo $levelname['level5']; ?>推荐升级要求">人
                </div>
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>分享人员临时绑定的事时间：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <div><span class="s">时间:</span>
                    <input type="number" class="input-text w" name="linshitime" placeholder="请填写临时绑定时间"
                           value="<?php echo isset($data['linshitime']) ? $data['linshitime'] :  '7'; ?>"
                           datatype="*" nullmsg="请填写临时绑定时间">天
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
</script>

</body>
</html>