<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:91:"/www/wwwroot/jinli.sxzywl.net/public/../application/index/view/course/getcoursecomment.html";i:1574906645;}*/ ?>
<?php if(isset($commentlist)): if(count($commentlist)>0): if(is_array($commentlist) || $commentlist instanceof \think\Collection || $commentlist instanceof \think\Paginator): $i = 0; $__LIST__ = $commentlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <li class="comments-box-li">
            <div class="comments-imgbox">
                <?php if($vo['head_type'] == 1): ?>
                <img src="<?php echo $vo['head']; ?>" style="width:100%;">

                <?php else: ?>
                <img src="<?php echo $vo['head']; ?>" style="width:100%;">
                <?php endif; ?>
            </div>
            <div class="comments-text">
                <div class="comments-text-tab">
                    <h2><?php echo $vo['nick_name']; ?></h2>
                    <div class="comments-tim">
                        <span><?php echo date('Y',$vo['add_time']); ?>-</span><span><?php echo date('m',$vo['add_time']); ?>-</span><span><?php echo date('d',$vo['add_time']); ?></span>
                    </div>
                </div>
                <div class="comments-con">
                    <?php echo $vo['course_comment_content']; ?>
                </div>
            </div>
        </li>
        <?php endforeach; endif; else: echo "" ;endif; else: ?>
            <div style="position: absolute;left: 50%;top:50%;margin-top: -50px;margin-left: -50px;width: 100px;height: 100px;text-align: center;">
                暂无评论
            </div>
    <?php endif; endif; ?>