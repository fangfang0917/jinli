<?php

namespace app\index\controller;

use app\index\Controller;
use think\Cache;
use think\Config;
use think\Session;

class Index extends Controller
{

    public function index()
    {
        $class = Db('course_classify')->where(array('course_type' =>1))->select();
        $orderlist = Db('order')->where(array('user_id'=>Session::get('user_id'),'pay_type'=>1))->select();
        $ids = [];
        foreach ($orderlist as $k => $v) {
            array_push($ids, $v['course_id']);
        }
        foreach($class as $k=>$v){
            $courseDate = Db('course')->where(array('course_classify_id'=>$v['id'],'course_index'=>1))->select();
            foreach($courseDate as $key=>$value){
                if(in_array($value['id'],$ids)){
                    $courseDate[$key]['is_buy'] = 1;
                }else{
                    $courseDate[$key]['is_buy'] = 0;
                }
            }
            $class[$k]['courseData'] = $courseDate;
        }
        //轮播图
        $banner = db('banner')->where(array('status' => 1, 'banner_type' => 1))->order('sort asc')->select();
        //课程宣传
        $courseBanner = Db('banner')->where(array('status' => 1, 'banner_type' => 8))->find();
        $this->view->assign('banner', $banner);
       //特别推荐课程
        $tuijian  = DB('course')->where(array('course_classify_id'=>12))->find();
        $this ->view->assign('tuijian',$tuijian);
       //弹窗展示判断
        if (Session::has('tan')) {
            $this->view->assign('tan', 1);
        } else {
            $this->view->assign('tan', 2);
            Session::set('tan', 1);
        }
        if (Session::get('level') > 0) {
            $order = 'sort desc';
        } else {
            $order = 'sort asc';
        }
        $showAuth = $this->getTan();
        $level = Session::get('level');
        $index_url = '';
        $index_pic_url = '';
        if ($showAuth != 0) {
            if ($level == 0) {
                $index_url = Cache::get('index_pic')['index_pic'];
                $index_pic_url = Cache::get('index_pic')['index_pic_url'];
            } elseif ($level == 1) {
                $index_url = Cache::get('index_pic')['index_pic1'];
                $index_pic_url = Cache::get('index_pic')['index_pic_url1'];

            } elseif ($level == 2) {
                $index_url = Cache::get('index_pic')['index_pic2'];
                $index_pic_url = Cache::get('index_pic')['index_pic_url2'];

            } elseif ($level == 3) {
                $index_url = Cache::get('index_pic')['index_pic3'];
                $index_pic_url = Cache::get('index_pic')['index_pic_url3'];

            } elseif ($level == 4) {
                $index_url = Cache::get('index_pic')['index_pic4'];
                $index_pic_url = Cache::get('index_pic')['index_pic_url4'];

            } elseif ($level == 5) {
                $index_url = Cache::get('index_pic')['index_pic5'];
                $index_pic_url = Cache::get('index_pic')['index_pic_url5'];

            }
        }
        $this->view->assign('title', '锦鲤妈妈');
        $this->view->assign('level', $level);
        $this->view->assign('index_url', $index_url);
        $this->view->assign('index_pic_url', $index_pic_url);
        $this->view->assign('showAuth', $showAuth);
        $this->view->assign('courseBanner', $courseBanner);
//        dump($courseBanner);
        $this ->view->assign('classDate',$class);
        return $this->view->fetch();

    }

    public function index1()
    {

        if (Session::has('courseClassify') == true) {
            $couresClassify = Session::get('courseClassify');
        } else {
            $couresClassify = -1;
        }
        //轮播图
        $banner = db('banner')->where(array('status' => 1, 'banner_type' => 1))->order('sort asc')->select();
        //课程宣传
        $courseBanner = Db('banner')->where(array('status' => 1, 'banner_type' => 8))->find();
        $this->view->assign('banner', $banner);
        if (Session::has('tan')) {
            $this->view->assign('tan', 1);
        } else {
            $this->view->assign('tan', 2);
            Session::set('tan', 1);
        }
        //真心课
        $Zcourse = Db('course')->alias('c')
            ->join('course_classify cc', 'cc.id = c.course_classify_id', 'left')
            ->where(array('cc.course_type' => 1, 'c.course_index' => 1))->order('c.sort asc')
            ->field(array('c.course_title', 'c.course_remark', 'c.course_vip_money', 'c.course_money',
                'c.course_look', 'c.id', 'c.course_pic'))->select();
        //真心课章节列表
        if (Session::get('level') > 0) {
            $order = 'sort desc';
        } else {
            $order = 'sort asc';
        }
        foreach ($Zcourse as $k => $v) {
            $info = db('course_info')->where(array('course_id' => $v['id']))->order($order)->limit(0, 6)->select();
            foreach ($info as $kk => $vv) {
                $info[$kk]['course_info_title'] = explode(' ', $vv['course_info_title'])[0];
                $info[$kk]['course_info_remarks'] = explode(' ', $vv['course_info_title'])[1];
            }
            $Zcourse[$k]['course_info_data'] = $info;
        }
        $this->view->assign('Zcourse', $Zcourse);
        $showAuth = $this->getTan();
        $level = Session::get('level');
        $index_url = '';
        $index_pic_url = '';
//        $level = 0;
        if ($showAuth != 0) {
            if ($level == 0) {
                $index_url = Cache::get('index_pic')['index_pic'];
                $index_pic_url = Cache::get('index_pic')['index_pic_url'];
            } elseif ($level == 1) {
                $index_url = Cache::get('index_pic')['index_pic1'];
                $index_pic_url = Cache::get('index_pic')['index_pic_url1'];

            } elseif ($level == 2) {
                $index_url = Cache::get('index_pic')['index_pic2'];
                $index_pic_url = Cache::get('index_pic')['index_pic_url2'];

            } elseif ($level == 3) {
                $index_url = Cache::get('index_pic')['index_pic3'];
                $index_pic_url = Cache::get('index_pic')['index_pic_url3'];

            } elseif ($level == 4) {
                $index_url = Cache::get('index_pic')['index_pic4'];
                $index_pic_url = Cache::get('index_pic')['index_pic_url4'];

            } elseif ($level == 5) {
                $index_url = Cache::get('index_pic')['index_pic5'];
                $index_pic_url = Cache::get('index_pic')['index_pic_url5'];

            }
        }

        //care学院课程分类
        $CareCourseClassify = DB('course_classify')->where(array('course_type' => 2))->order('sort asc')->select();
        $this->view->assign('CareCourseClassify', $CareCourseClassify);
        $this->view->assign('title', '锦鲤妈妈');
        $this->view->assign('level', $level);
        $this->view->assign('index_url', $index_url);
        $this->view->assign('index_pic_url', $index_pic_url);
        $this->view->assign('showAuth', $showAuth);
        $this->view->assign('courseBanner', $courseBanner);
        $this->view->assign('couresClassify', $couresClassify);
        return $this->view->fetch();

    }


    public function su(){
        $this->view->assign('title','支付成功');
        return $this ->view->fetch();
    }


    public function carecourselist()
    {
        $classify_id = $this->request->param('classify_id');
        $CareCourse_num = Config::get('CareCourse_num_page');
        $page = $this->request->param('page', 0);
        $CareCourse = DB('course')->alias('c')
            ->join('course_classify cc', 'cc.id = c.course_classify_id', 'left')
            ->where(array('c.course_index' => 1, 'c.course_classify_id' => $classify_id, 'status' => 1))->order('c.sort asc')
            ->field(array('c.course_title', 'c.course_remark', 'c.course_vip_money', 'c.course_money',
                'c.course_look', 'c.id', 'c.course_pic', 'c.course_pic_jiao', 'c.level'))->limit($CareCourse_num * $page, $CareCourse_num)->select();

        $buycourse = Db('order')->where(array('user_id' => Session::get('user_id'), 'pay_type' => 1, 'order_type' => 1))->field('course_id')->select();
        $ids = [];
        foreach ($buycourse as $k => $v) {
            array_push($ids, $v['course_id']);
        }
        foreach ($CareCourse as $k => $v) {
            if ($v['level'] != 0) {
                if (in_array($this->userInfo['level'], json_decode($v['level'], true))) {
                    $CareCourse[$k]['buy_type'] = 2;
                } else {
                    if (in_array($v['id'], $ids)) {
                        $CareCourse[$k]['buy_type'] = 1;
                    } else {
                        $CareCourse[$k]['buy_type'] = 0;
                    }
                }
            } else {
                if (in_array($v['id'], $ids)) {
                    $CareCourse[$k]['buy_type'] = 1;
                } else {
                    $CareCourse[$k]['buy_type'] = 0;
                }
            }
        }
        $this->view->assign('course', $CareCourse);
        return $this->view->fetch();
    }

    public function getzcourseinfolist()
    {
        $course_id = $this->request->param('id');
        $courseinfo = Db('course_info')->where(array('course_id' => $course_id))->select();
        foreach ($courseinfo as $k => $v) {
            $courseinfo[$k]['course_info_title'] = explode('课 ', $v['course_info_title'])[0];
        }
        $this->view->assign('list', $courseinfo);
        $this->view->assign('level', Session::get('level'));
        return $this->view->fetch();
    }

    public function banner()
    {
        $banner = db('banner')->select();
        return json(array('banner' => $banner));
    }

    public function course_classify()
    {
//       获取课程分类  http://www.edu.com/public/index.php/index/index/course_classify
        $course_classify = db('course_classify')->select();
        return json(array('course_classify' => $course_classify));
    }

    public function course()
    {
//       /public/index.php/index/index/course/cid/1/page/0  根据课程分类获取课程列表
        $page = $this->request->param('page');
        $cid = $this->request->param('cid');
        $pagenum = 10;
        $course = Db('course')->where(array('course_classify_id' => $cid))->limit($page * $pagenum, $pagenum)->select();
        return json($course);
    }

    public function course_info_list()
    {
//       http://www.edu.com/public/index.php/index/index/course_info_list/course_id/1   获取该课程的目录
        $course_id = $this->request->param('course_id');
        $course_info_list = Db('course_info')->where(array('course_id' => $course_id))->select();
        return json($course_info_list);
    }

    public function course_details()
    {
//       http://www.edu.com/public/index.php/index/index/course_details/id/1   通过课程id获取课程的详情
        $id = $this->request->param('id');
        $course_details = DB('course')->where(array('id' => $id))->find();
        return json($course_details);
    }

    public function course_info_details()
    {
//       http://www.edu.com/public/index.php/index/index/course_info_details/id/1   通过章节id获取章节内容
        $id = $this->request->param('id');
        db('course_info')->where(array('id' => $id))->setInc('course_info_look_num', 1);
        $course_info_details = Db('course_info')->where(array('id' => $id))->find();
        return json($course_info_details);
    }

    public function course_comment_list()
    {
        //获取当前章节的评论
        $id = $this->request->param('id');
        $page = $this->request->param('page');
        $pagenum = 10;
        $comment = DB('course_comment')->where(array('course_info_id' => $id))
            ->limit($pagenum * $page, $pagenum)->order('id desc')->select();
        return json($comment);
    }

    public function addcourseinfocomment()
    {
        $content = $this->request->param('content');
        $course_info_id = $this->request->param('course_info_id');
        $user_id = Session::get('user_id');
        $data = array(
            'course_comment_content' => $content,
            'user_id' => $user_id,
            'add_time' => time(),
            'course_info_id' => $course_info_id
        );
        db('course_info_comment')->insert($data);
    }

    public function collection()
    {
        $id = $this->request->param('id');
        $user_id = Session::get('user_id');
        $type = $this->request->param('type');
        db('collection')->insert(array('course_id' => $id, 'user_id' => $user_id, 'type' => $type));
        return json(array('state' => 1, 'msg' => '收藏成功!'));
    }

    public function deccollection()
    {
        $id = $this->request->param('id');
        $user_id = Session::get('user_id');
        db('collection')->where(array('course_id' => $id, 'user_id' => $user_id))->delete();
        return json(array('state' => 1, 'msg' => '取消成功!'));
    }


}
