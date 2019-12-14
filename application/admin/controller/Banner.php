<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/11
 * Time: 9:50
 */

namespace app\admin\controller;


use app\admin\Controller;
use think\Db;

class Banner extends Controller
{
    use \app\admin\traits\controller\Controller;
    public function add(){
        if($this->request->isAjax()){
             $data = $this->request->except(['banner']);
             $data['add_time'] = time();
             db('banner')->insert($data);
             return ajax_return_adv('操作成功');
        }else{
            return $this->view->fetch('edit');
        }
    }

    public function edit()
    {
        if($this->request->isAjax()){
            $data = $this->request->except(['banner','id']);
            $id = $this->request->param('id');
            $data['add_time'] = time();
            db('banner')->where(array('id'=>$id))->data($data)->update();
            return ajax_return_adv('操作成功');
        }else{
            $id = $this->request->param('id');
            $vo = db('banner')->where(array('id'=>$id))->find();
            $this->view->assign('vo',$vo);
            return $this->view->fetch('edit');
        }
    }

}