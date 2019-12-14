<?php
namespace app\index\controller;

use app\index\Controller;
use think\Config;
use think\Session;

class Order extends Controller
{
    public function index(){
        $this ->view->assign('title','我的课程');
        $this ->view->assign('body_background_color','#f7f7f7');
        return $this -> view->fetch();
    }


    public function orderlist(){
        $page = $this->request->param('page');
        $type = $this->request->param('type');
        if($type == 1){
            $map['cc.course_type'] = ['not in','3'];
        }else{
            $map['cc.course_type'] = ['in','3'];

        }
        $map['o.user_id'] = Session::get('user_id');
        $map['o.order_type'] = 1;
        $page_num = Config::get('order_page_num');
        $orderlist = DB('order')->alias('o')->join('course c','o.course_id = c.id','left')
            ->join('course_classify cc','c.course_classify_id = cc.id','left')
            ->field(array('o.order_no','o.course_type','o.pay_type','c.course_title','o.money','c.course_pic','c.course_remark','c.course_look','c.id','o.id as oid'))
            ->where($map)
            ->limit($page_num*$page,$page_num)->select();
        $this ->view->assign('orderlist',$orderlist);
        $this ->view->assign('type',$type);
//        dump($orderlist);
        return $this ->view->fetch();
    }
}