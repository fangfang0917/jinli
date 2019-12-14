<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/10
 * Time: 17:57
 */

namespace app\admin\controller;
use app\admin\Controller;

class LevelOrderList extends Controller
{
    public function index(){
        $map = [];
        if($this->request->param('nick_name')){
            $map['u.nick_name'] = ['like','%'.$this->request->param('nick_name').'%'];
        }
        $list = db('level_order_list')->alias('lol')
            ->join('user u','lol.user_id = u.id')
            ->where($map)
            ->field(array('u.nick_name','lol.money','lol.id','lol.add_time','lol.old_level','lol.old_num','lol.order_man_no'))
            ->paginate(10,false,['query'=>request()->param()]);
        $this->view->assign('list',$list);
        $this->view->assign('count',$list->count());
        $this->view->assign('page',$list->render());
        return $this->view->fetch();
    }

}