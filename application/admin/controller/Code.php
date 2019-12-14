<?php

namespace app\admin\controller;


use app\admin\Controller;
use think\Db;

class Code extends Controller
{
    use \app\admin\traits\controller\Controller;

    public function index()
    {
        $map = [];
        $list = DB('code')->where($map)->paginate(10, false, ['query' => request()->param()]);
        $this->view->assign('list', $list);
        $this->view->assign('count', $list->count());
        $this->view->assign('page', $list->render());
        return $this->view->fetch();
    }


    public function add()
    {
        if ($this->request->isAjax()) {
            $data = $this->request->param();
            $data['createtime'] = time();
            $data['daoqitime'] = time() + 60*60*24*$data['day'];
            $id = DB('code')->insertGetId($data);
            if($id){
                $this->setCode1($data['codebef'],$data['num'],$id);
            }
            return ajax_return_adv('生成code成功');
        } else {
            return $this->view->fetch('edit');
        }
    }


    public function getuser(){
        $map = [];
        if($this->request->param('nick_name')){
            $map['nick_name'] = ['like','%'.$this ->request->param('nick_name').'%'];
        }
        if($this->request->param('id')){
            $map['id'] = $this ->request->param('id');
        }
        $list = DB('user')->where($map)->paginate(10,false,['query'=>request()->param()]);
        $this ->view->assign('list',$list);
        $this ->view->assign('page',$list->render());
        return $this ->view->fetch();
    }


    public function codelists(){
        $map = [];
        $map['cid'] = $this ->request->param('id');
        $list = db('codeinfo')->where($map)->paginate(10,false,['query'=>request()->param()]);
        $this ->view->assign('list',$list);
        $this ->view->assign('cid',$this ->request->param('id'));
        $this ->view->assign('page',$list->render());
        return $this ->view->fetch();
    }


    public function excel(){
        $id = $this ->request->param('id');
        $code = Db('code')->where(array('id'=>$id))->find();
       $data = Db('codeinfo')->where(array('cid'=>$id))->field(array('code'))->select();
       foreach ($data as $k=>$v){
           $data[$k]['createtime'] = date('Y-m-d',$code['createtime']);
           $data[$k]['daoqitime'] = date('Y-m-d',$code['daoqitime']);
       }

        $header = ['code', '生成时间', '到期时间'];
        if ($error = \Excel::export($header, $data, 'code列表', '2007')) {
            throw new Exception($error);
        }
    }
}