<?php

namespace app\index\controller;

use app\index\Controller;
use think\Config;
use think\Session;

Class Form extends Controller
{
    public function index()
    {
        $this ->view->assign('title','搜索');
        return $this->view->fetch();

    }

    public function form(){
        $map = '';
        if($this->request->param('where')){
            $map['course_title'] = ['like','%'.$this->request->param('where').'%'];
        }
        $list = db('course')->where($map)->select();
        $ids = [];
        $buycourse = Db('order')->where(array('user_id'=>Session::get('user_id'),'pay_type'=>1))->select();
        foreach ($buycourse as $k => $v) {
            array_push($ids, $v['course_id']);
        }
        foreach ($list as $k => $v) {
            if (in_array($v['id'], $ids)) {
                $list[$k]['buy_type'] = 1;
            } else {
                $list[$k]['buy_type'] = 0;
            }
        }
        $this->view->assign('formlist',$list);
        $this->view->assign('count',count($list));
        return $this ->view->fetch();
    }
}