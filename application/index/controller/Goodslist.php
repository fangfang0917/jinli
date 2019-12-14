<?php

namespace app\index\controller;

use app\index\Controller;
use think\Config;
use think\Session;

class Goodslist extends Controller
{
    public function index()
    {//锦鲤KID
        $id = $this ->request->param('id');
        $jlcourseclassify = DB('course_classify')->where(array('id'=>$id))->find();
        $this->view->assign('title', getCourseClassifyType($jlcourseclassify['course_type']));
        $this->view->assign('C', $jlcourseclassify);
        $this->view->assign('background', '#e7e7e7');
        return $this->view->fetch();
    }

    public function jlcourselist()
    {
        $classify_id = $this->request->param('classify_id');
        $CareCourse_num = Config::get('CareCourse_num_page');
        $page = $this->request->param('page');
        $CareCourse = DB('course')->where(array('status' => 1, 'course_classify_id' => $classify_id))
            ->limit($CareCourse_num * $page, $CareCourse_num)->order('sort asc')->select();
        $orderlist = Db('order')->where(array('user_id' => Session::get('user_id'), 'order_type' => 1, 'pay_type' => 1))->select();
        $ids = [];
        foreach ($orderlist as $k => $v) {
            array_push($ids, $v['course_id']);
        }
        foreach ($CareCourse as $k => $v) {
            $CareCourse[$k]['url'] = url("course/detail",array('id'=>$v['id']));
            $CareCourse[$k]['yanurl'] = '/static/index/img/home/yan.png';

            if (in_array($v['id'], $ids)) {
                $CareCourse[$k]['buy_type'] =1;
            } else {
                $CareCourse[$k]['buy_type'] =0;

            }
        }
        $this->view->assign('course', $CareCourse);
        $this->view->assign('page', $page);
        $this->view->assign('num', $CareCourse_num);
        return json(array('data'=>$CareCourse,'page'=>$page,'num'=>$CareCourse_num));
//        return $this->view->fetch();
    }
}