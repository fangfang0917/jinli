<?php
namespace app\admin\controller;

use app\admin\Controller;

class Intertext extends Controller
{
    public function index(){
        if($this ->request->isAjax()){
            $id = $this ->request->param('id');
            if($id){
                $data = $this ->request->except(['id']);
                db('intertext')->where(array('id'=>$id))->data($data)->update();
                return ajax_return_adv('','Intertext','操作成功!');
            }else{
                $data = $this ->request->except(['id']);
                db('intertext')->insert($data);
                return ajax_return_adv('','Intertext','操作成功!');
            }
        }else{
            $map['id'] = 1;
            $vo = db('intertext')->where($map)->find();
            $this ->view->assign('vo',$vo);
            return $this->view->fetch();
        }

    }




}