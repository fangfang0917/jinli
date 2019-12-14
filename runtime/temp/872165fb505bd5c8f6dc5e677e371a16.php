<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:92:"/www/wwwroot/jinli.sxzywl.net/public/../application/index/view/course/getcourseinfolist.html";i:1574840660;}*/ ?>
<?php if(isset($courseinfolist)): if(count($courseinfolist)): if(is_array($courseinfolist) || $courseinfolist instanceof \think\Collection || $courseinfolist instanceof \think\Paginator): $i = 0; $__LIST__ = $courseinfolist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
    <li class="directory-li" id="play<?php echo $vo['id']; ?>" onclick="bf('<?php echo $vo['id']; ?>')" data-id="<?php echo $vo['id']; ?>"
        data-level="<?php echo $level; ?>" data-url="<?php echo $vo['course_info_path']; ?>" data-auth="<?php echo $vo['course_info_auth']; ?>"
        data-buy="<?php echo $vo['buy_type']; ?>" data-pic="<?php echo $vo['course_info_pic']; ?>" data-vip="<?php echo $course['course_isvip']; ?>"  data-course-id="<?php echo $vo['course_id']; ?>" data-time="<?php echo $vo['look_time']; ?>">
        <div class="directory-li-left">
            <?php if($vo['buy_type'] == 1): ?>
                    <div class="bofang audition" style="display: none">
                        <img src="__STATIC__/index/img/bofang.png">
                    </div>
                    <div class="play audition">
                        <img src="__STATIC__/index/img/zanting.png">
                    </div>
            <?php elseif($vo['buy_type'] == 2): ?>
                    <div class="audition st">
                        试听
                    </div>
                    <div class="bofang audition" style="display: none">
                        <img src="__STATIC__/index/img/bofang.png">
                    </div>
            <?php else: ?>
                    <div class="suo audition">
                        <img src="__STATIC__/index/img/suo.png">
                    </div>
            <?php endif; ?>
        </div>
        <div class="directory-li-right">
            <div class="directory-title">
                <h2>
                    <?php echo $vo['course_info_title']; ?>
                </h2>
            </div>
            <div class="directory-tim">
                <span><?php echo $vo['course_info_path_time']; ?></span>
                <span>已播放<?php echo $vo['course_info_look_num']; ?>次</span>
            </div>
        </div>
    </li>
<?php endforeach; endif; else: echo "" ;endif; else: ?>
<div class="emptyGood">暂无数据</div>
<?php endif; endif; ?>