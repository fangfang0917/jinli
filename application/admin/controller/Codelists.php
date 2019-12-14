<?php

namespace app\admin\controller;


use app\admin\Controller;
use think\Db;

class Codelists extends Controller
{
    use \app\admin\traits\controller\Controller;

    public function index(){
        $map = [];
        if($this->request->param('id')){
            $map['uid']  = $this ->request->param('id');
        }
        $list = Db('codelists')->where($map)->paginate(10,false,['query'=>request()->param()]);
        $this->view->assign('list',$list);
        $this->view->assign('page',$list->render());
        $this->view->assign('count',$list->count());
        return $this->view->fetch();
    }
}