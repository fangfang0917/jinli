<?php
namespace app\admin\controller;


\think\Loader::import('controller/Controller', \think\Config::get('traits_path'), EXT);

use app\admin\Controller;
use think\Exception;
use think\Db;
use think\Loader;


class OutMoney extends Controller
{
    use \app\admin\traits\controller\Controller;
    public function index(){
        $map = [];
        if($this->request->param('nick_name')){
            $map['u.nick_name'] = ['like','%'.$this->request->param('nick_name').'%'];
        }
        $list = db('out_money')
            ->alias('om')
            ->join('user u','u.id = om.user_id','left')
            ->where($map)->field(array('om.id','u.nick_name','om.level','om.user_id','om.type','om.remarks','om.create_time','om.up_time','om.type_money'))
            ->paginate(10,false,['query'=>request()->param()]);
        $this->view->assign('list',$list);
        $this->view->assign('count',$list->count());
        $this->view->assign('page',$list->render());
        return $this->view->fetch();
    }

    public function isType(){
        $id = $this->request->param('id');
        $type = $this -> request ->param('type');
        db('out_money')->where(array('id'=>$id))->update(array('type'=>$type,'up_time'=>time()));
        return json(array('state'=>1,'msg'=>'审核成功!!!'));
    }
    public function outtype(){
        $id = $this -> request ->param('id');
        $user_id = $this -> request ->param('user_id');
        db('out_money')->where(array('id'=>$id))->update(array('type_money'=>1));
        db('user')->where(array('id'=>$user_id))->update(array('out_money'=>1));
        return json(array('state'=>1,'msg'=>'打款成功!!'));
    }
}