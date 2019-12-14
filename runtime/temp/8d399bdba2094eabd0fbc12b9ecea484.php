<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:97:"/www/wwwroot/jinli.sxzywl.net/public/../application/admin/view/course_info_comment/getcourse.html";i:1573031583;}*/ ?>

    <?php if(is_array($courseList) || $courseList instanceof \think\Collection || $courseList instanceof \think\Paginator): $i = 0; $__LIST__ = $courseList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
    <option value="<?php echo $vo['id']; ?>" <?php if(\think\Request::instance()->param('course_id') == $vo['id']): ?>selected<?php endif; ?>><?php echo $vo['course_title']; ?></option>
    <?php endforeach; endif; else: echo "" ;endif; ?>
