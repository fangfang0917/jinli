<?php

namespace app\index\controller;


use app\index\Controller;

use function GuzzleHttp\Psr7\str;
use think\Db;
use think\Config;
use think\Session;

Class Course extends Controller
{
    //获取课程章节  并获取该课程下第一章节
    public function detail()
    {
        $id = $this->request->param('id');
        $buy_type_auth = 0;
        if ($this->request->param('course_info_id')) {
            $course_info_id = $this->request->param('course_info_id');
        } else {
            $course_info_id_data = db('course_info')->where(array('course_id' => $id))->limit(0, 1)->order('id asc')->select();
            if ($course_info_id_data) {
                $course_info_id = $course_info_id_data[0]['id'];
            } else {
                $course_info_id = 0;
            }
        }
        if ($this->request->param('datatype')) {
            $this->view->assign('datatype', 1);
        } else {
            $this->view->assign('datatype', 2);
        }
        $courseDetails = db('course')->where(array('id' => $id))->find();
        if ($courseDetails['course_classify_id'] != 7) {
            Session::set('courseClassify', $courseDetails['course_classify_id']);
        }
        db('course')->where(array('id' => $id))->setInc('course_look', 1);
        $course_info = db('course_info')->where(array('course_id' => $id))->count();
        $course_info_detail = db('course_info')->where(array('course_id' => $id, 'id' => $course_info_id))->find();
        db('course_info')->where(array('course_id' => $id, 'id' => $course_info_id))->setInc('course_info_look_num', 1);
        $course_comment_num = db('course_comment')->where(array('course_id' => $id, 'type' => 1))->count();
        $courseDetails['course_info_count'] = $course_info;
        $buy = Db('order')->where(array('course_id' => $id, 'user_id' => Session::get('user_id'), 'pay_type' => 1))->select();
        if (count($buy) > 0) {
            $buy_type_auth = 1;
        }
        if (isset($courseDetails['level'])) {
            if ($courseDetails['level'] != "0") {
                if($this ->userInfo['level'] == 0){
                    if (in_array(6, json_decode($courseDetails['level'], true))) {
                        $buy_type_auth = 1;
                    }
               }else{
                    if (in_array($this->userInfo['level'], json_decode($courseDetails['level'], true))) {
                        $buy_type_auth = 1;
                    }
               }
            }

        }
        $gifcourse = DB('gifcourse')->where(array('id' => 1))->find();
        $arr = explode(',', $gifcourse['course_id']);
        $course = db('course')->where(array('id' => array('in', $arr)))->select();
        $courseinfoauth = db('course_info')->where(array('course_id' => $id, 'course_info_auth' => 1))->limit(0, 1)->select();
        $this->view->assign('courseDetails', $courseDetails);
        $this->view->assign('course', $course);
        $this->view->assign('course_info_detail', $course_info_detail);
        $this->view->assign('course_info_id', $course_info_id);
        $this->view->assign('course_comment_num', $course_comment_num);
        $this->view->assign('level', Session::get('level'));
        $this->view->assign('buy_type_auth', $buy_type_auth);
        $this->view->assign('sys', $this->sys);
        $this->view->assign('courseinfoauth', $courseinfoauth);
        $this->view->assign('title', $courseDetails['course_title']);
        $this->view->assign('caidan', 1);
        $this->view->assign('libao', Session::get('LiBao') != null ? Session::get('LiBao') : 0);
        $libaoshow = 0;
        if (strlen($this->userInfo['phone']) == 11 && $this->userInfo['is_vip_libao'] == 0) {
            $libaoshow = 1;
        }
        $this->view->assign('libaoshow', $libaoshow);
        $this->initShareConfig([
            'title' => "我发现一门好课，快来一起学习吧",
            'desc' => $courseDetails['course_title'] . $courseDetails['course_remark'] . ',点击学习!',
            'url' => url('Index/course/detail', ['id' => $courseDetails['id'], 'pid' => $this->userInfo['id']]),
        ]);
        $addFabulous = db("riglog")->where([
            'type' => 'addFabulous',
            'pid' => $id,
            'userid' => $this->userInfo['id'],
        ])->find();
        $this->view->assign('addFabulous', $addFabulous ? 1 : 2);


        return $this->view->fetch();
    }

    //获取课程下所有章节
    public function getcourseinfolist()
    {
        $id = $this->request->param('course_id');
        $sort = $this->request->param('sort');
        $course_info_id = $this->request->param('course_info_id');
        $user = $this->userInfo;
        $islevel = 0;
        $isBuy = 0;
        if ($sort == 1) {
            $order = 'sort asc';
        } else {
            $order = 'sort desc';

        }
        $course = DB('course')->where(array('id' => $id))->find();
        $course_info = DB('course_info')->where(array('course_id' => $id))->order($order)->select();
        $buy = Db('order')->where(array('user_id' => $user['id'], 'course_id' => $id,'pay_type'=>1))->count();
        if (isset($course['level'])) {
            if ($course['level'] != 0) {
                   if($user['level'] == 0){
                       if (in_array(6, json_decode($course['level'], true))) {
                           $islevel = 1;
                       }
                   }else{
                       if (in_array($user['level'], json_decode($course['level'], true))) {
                           $islevel = 1;
                       }
                   }
            }
        }
        if ($islevel == 1 || $buy > 0) {
            $isBuy = 1;
        }
        foreach ($course_info as $k => $v) {
            if ($isBuy == 0) {
                $course_info[$k]['buy_type'] = $isBuy;
                if ($v['course_info_auth'] == 1) {
                    $course_info[$k]['buy_type'] = 2;
                }
            } else {
                $course_info[$k]['buy_type'] = $isBuy;
            }
            $course_info[$k]['look_time'] = 0;
        }
        $this->view->assign('courseinfolist', $course_info);
        $this->view->assign('course_info_id', $course_info_id);
        $this->view->assign('course', $course);
        $this->view->assign('level', Session::get('level'));

        return $this->view->fetch();
    }

    //获取该章节下所有评论
    public function getcoursecomment()
    {
        $id = $this->request->param('id');
        $page = $this->request->param('page');
        $map['cc.course_id'] = $id;
        $map['cc.type'] = 1;
        $commentpagenum = Config::get('comment_page_num');
        $comment = db('course_comment')->alias('cc')
            ->join('course c', 'cc.course_id = c.id', 'left')
            ->join('user u', 'cc.user_id = u.id', 'left')
            ->where($map)->field(array('u.nick_name', 'cc.add_time', 'cc.course_comment_content', 'u.head', 'u.head_type'))
            ->limit($commentpagenum, $commentpagenum * $page)->order('cc.id desc')->select();
        $this->view->assign('commentlist', $comment);

        return $this->view->fetch();
    }

    public function setinclikenum()
    {
        $id = $this->request->param('id');
        $map = [
            'type' => 'addFabulous',
            'pid' => $id,
            'userid' => $this->userInfo['id'],
        ];
        $find = db("riglog")->where($map)->find();
        $course_info_like_num = db('course_info')->where(array('id' => $id))->find()['course_info_like_num'];
        if ($find) {
            return json(array('state' => 10, 'msg' => '您已经点赞过了', 'course_info_like_num' => $course_info_like_num));
        } else {
            $map['createtime'] = time();
            db("riglog")->insertGetId($map);
            db('course_info')->where(array('id' => $id))->setInc('course_info_like_num', 1);
            return json(array('state' => 1, 'msg' => '点赞成功', 'course_info_like_num' => ($course_info_like_num + 1)));
        }
    }

    public function setcoursecomment()
    {
        $id = $this->request->param('id');
        $content = $this->request->param('text');
        $data = array(
            'user_id' => Session::get('user_id'),
            'add_time' => time(),
            'course_comment_content' => $content,
            'course_id' => $id
        );
        db('course_comment')->insert($data);
        return json(array('state' => 1, 'msg' => '评论成功！审核通过后可显示'));
    }

    public function courseshare()
    {
        $course_id = $this->request->param('id');
        $coursedetail = db('course')->where(array('id' => $course_id))->find();
        $url = APP_HOSTS . url("Index/course/detail", ['id' => $course_id, 'pid' => Session::get('user_id')]);
        $pic = $this->coursesharePic($this->userinfo, $url, $course_id);
        $course_classify_pic = Db('course_classify')->where(array('id' => $coursedetail['course_classify_id']))->find();
        $this->view->assign('url', $url);
        $this->view->assign('title', '课程分享');
        $this->view->assign('coursedetail', $coursedetail);
        $this->view->assign('userinfo', $this->userinfo);
        $this->view->assign('pic', $pic);
        $this->view->assign('body_background', $course_classify_pic['course_classify_pic']);
        return $this->view->fetch();
    }

    public function setlook()
    {
        $id = $this->request->param('id');
        Db('course_info')->where(array('id' => $id))->setInc('course_info_look_num', 1);
    }


    public function updatetime()
    {
        $time = $this->request->param('time');
        $course_id = $this->request->param('course_id');
        $course_info_id = $this->request->param('course_info_id');
        $user_id = Session::get('user_id');
        db('user_course')->where(array('user_id' => $user_id, 'course_id' => $course_id, 'course_info_id' => $course_info_id))->update(array('course_info_look_time' => $time));
        return json(array('state' => 1, 'msg' => '成功'));
    }

    public function viplibao()
    {
        $gifcourse = DB('gifcourse')->where(array('id' => 1))->find();
        $arr = explode(',', $gifcourse['course_id']);
        $course = db('course')->where(array('id' => array('in', $arr)))->select();
        $this->view->assign('course', $course);
        return $this->view->fetch();
    }

    public function authphone()
    {
        $authPhone = Db('user')->where(array('id' => Session::get('user_id')))->find();
        if ($authPhone['phone'] != 0) {
            return json(array('state' => 1, 'msg' => '手机号已添加'));
        } else {
            $type = $this->request->param('type');
            if ($type == 1) {
                Session::set('LiBao', 1);
            } else {
                Session::set('buycourse', 1);
            }
            Session::set('type', $type);
            Session::set('url', $this->request->param('url'));
            return json(array('state' => 2, 'msg' => '手机号未添加,前往添加手机号'));
        }
    }

    public function succ()
    {
        $id = $this->request->param('id');
        $this->view->assign('id', $id);
        $this->view->assign('title', '购买成功');
        return $this->view->fetch();
    }
}