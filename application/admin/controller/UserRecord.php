<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/16
 * Time: 11:53
 */

namespace app\admin\controller;


use app\admin\Controller;

class UserRecord extends Controller
{
    public function index(){
        $map = [];
        if($this ->request->param('nick_name')){
            $map['u.nick_name'] = ['like','%'.$this->request->param('nick_name').'%'];
        }
        if($this ->request->param('type')){
            if($this ->request->param('type') > 0){
                $map['ur.type'] = $this->request->param('type');
            }
        }
        $list = db('user_record')->alias('ur')->join('user u','ur.user_id = u.id','left')
            ->join('user us','ur.son_id = us.id','left')
            ->where($map)->field(array('ur.id','ur.type','ur.amount','ur.add_time','ur.remarks','ur.son_id','ur.type_status','up_time','u.nick_name','us.nick_name as snick_name'))
            ->order('ur.id desc')
            ->paginate(10,false,['query'=>request()->param()]);
        $totalamount =db('user_record')->alias('ur')->join('user u','ur.user_id = u.id','left')
            ->join('user us','ur.son_id = us.id','left')
            ->where($map)->sum('ur.amount');
        $this->view->assign('list',$list);
        $this->view->assign('totalamount',$totalamount);
        $this->view->assign('count',$list->count());
        $this->view->assign('page',$list->render());
        return $this->view->fetch();
    }
}