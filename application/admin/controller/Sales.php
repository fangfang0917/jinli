<?php

namespace app\admin\controller;
\think\Loader::import('controller/Controller', \think\Config::get('traits_path'), EXT);


use app\admin\Controller;

use think\Db;

class Sales extends Controller
{
    use \app\admin\traits\controller\Controller;

    public function index()
    {
        $map = [];
        if ($this->request->param('course_title')) {
            $map['c.course_title'] = ['like', '%' . $this->request->param('course_title') . '%'];
        }
//        if ($this->request->param('start_time')) {
//            $map['o.add_time'] = ['BETWEEN', [strtotime($this->request->param('start_time')), strtotime($this->request->param('end_time'))]];
//        }
//        $map['o.money']= ['gt',0];
        $list = Db('course')
            ->alias('c')
            ->where($map)
            ->field(array('c.course_title', 'c.course_money',
                '(select count(*) from tp_order where course_id = c.id and money > 0) as buy_num',
                '(select sum(money) from tp_order where course_id = c.id and money > 0) as total_money','(select from_unixtime(add_time,"%Y-%m") from tp_order where course_id = c.id and money > 0 order by id limit 0,1) as add_time'))
            ->paginate(10, false, ['query' => request()->param()]);
        $this->view->assign('list', $list);
        $this->view->assign('count', $list->count());
        $this->view->assign('page', $list->render());
        return $this->view->fetch();
    }

    public function excel()
    {
        $header = ['序号', '课程名称', '所属板块', '价格', 'VIP价格', '上架时间','销售时间','销售总数','销售总额'];
        $map = [];
        if ($this->request->param('course_title')) {
            $map['c.course_title'] = ['like', '%' . $this->request->param('course_title') . '%'];
        }
//        if ($this->request->param('start_time')) {
//            $map['o.add_time'] = ['BETWEEN', [strtotime($this->request->param('start_time')), strtotime($this->request->param('end_time'))]];
//        }
        $list = Db('course')
            ->alias('c')
            ->join('course_classify cc', 'cc.id = c.course_classify_id', 'left')
            ->where($map)
            ->field(array('c.id','c.course_title','cc.course_classify_title', 'c.course_money', 'c.course_vip_money',
                'from_unixtime(c.course_add_time,"%Y-%m") as up_time','(select from_unixtime(add_time,"%Y-%m") from tp_order where course_id = c.id and money > 0 order by id limit 0,1) as add_time',
                '(select count(*) from tp_order where course_id = c.id and money > 0) as buy_num',
                '(select sum(money) from tp_order where course_id = c.id and money > 0) as total_money'))
            ->select();
        if ($error = \Excel::export($header, $list, "销售明细表", '2007')) {
            throw new Exception($error);
        }
    }

}