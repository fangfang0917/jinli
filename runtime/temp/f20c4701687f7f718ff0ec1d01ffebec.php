<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:92:"/www/wwwroot/jinli.sxzywl.net/public/../application/index/view/index/getzcourseinfolist.html";i:1571394758;}*/ ?>
<div class="swiper-container">
    <div class="swiper-wrapper">
        <?php if(isset($list)): if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vvo): $mod = ($i % 2 );++$i;if($level == 0): if($vvo['course_info_auth'] ==1): ?>
        <div class="swiper-slide">
            <a href="<?php echo url('Course/detail','',false,true); ?>/id/<?php echo $vvo['course_id']; ?>" style="color:#000;">
            <div class="advertising-play-box">
                <div class="advertising-box-top">
                    <h3><?php echo $vvo['course_info_title']; ?></h3>
                    <div class="advertising-bofangbtn">
                        <img src="__STATIC__/index/img/bofangbtn.png?v=<?php echo time(); ?>">
                    </div>
                </div>
                <div class="advertising-box-bot">
                    <?php echo $vvo['course_info_remarks']; ?>
                </div>
            </div>
            </a>
        </div>

        <?php else: ?>
        <div class="swiper-slide">
            <div class="advertising-play-box">
                <div class="advertising-box-top">
                    <h3><?php echo $vvo['course_info_title']; ?></h3>
                    <div class="advertising-bofangbtn">
                        <img src="__STATIC__/index/img/suo.png?v=<?php echo time(); ?>">
                    </div>
                </div>
                <div class="advertising-box-bot">
                    <?php echo $vvo['course_info_remarks']; ?>
                </div>
            </div>
        </div>
        <?php endif; else: ?>
        <div class="swiper-slide">
            <a href="<?php echo url('Course/detail','',false,true); ?>/id/<?php echo $vvo['course_id']; ?>" style="color:#000;">
                <div class="advertising-play-box">
                    <div class="advertising-box-top">
                        <h3><?php echo $vvo['course_info_title']; ?></h3>
                        <div class="advertising-bofangbtn">
                            <img src="__STATIC__/index/img/bofangbtn.png?v=<?php echo time(); ?>">
                        </div>
                    </div>
                    <div class="advertising-box-bot">
                        <?php echo $vvo['course_info_remarks']; ?>
                    </div>
                </div>
            </a>
        </div>
        <?php endif; endforeach; endif; else: echo "" ;endif; else: ?>
        暂无数据
        <?php endif; ?>
    </div>
</div>