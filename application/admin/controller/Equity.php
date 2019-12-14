<?php
namespace app\admin\controller;
use app\admin\Controller;
class Equity extends Controller
{
    use \app\admin\traits\controller\Controller;
    public function index(){
        $map = [];
        if($this ->request->param('type')){
            if($this ->request->param('type') != 0){
                $map['type'] = $this->request->param('type');
            }
        }
        $list = Db('equity')->where($map)->paginate(10, false, ['query' => request()->param()]);
        $this->view->assign('list', $list);
        $this->view->assign('count', $list->count());
        $this->view->assign('page', $list->render());
        return $this->view->fetch();
    }

    public function add()
    {
        if ($this->request->isAjax()) {
            $data = $this->request->param();
            $data['create_time'] = time();
            if ($data['type'] == 0) {
                return ajax_return_adv_error('请选择代理等级');
            }
            $res= Db('equity')->where(array('type'=>$data['type']))->find();
            if($res){
                return ajax_return_adv_error('当前代理等级已添加请前往修改');
            }
            db('equity')->insert($data);
            return ajax_return_adv('添加成功');
        } else {
            return $this->view->fetch('edit');
        }

    }

    public function edit()
    {
        if ($this->request->isAjax()) {
            $id = $this->request->param('id');
            $data = $this->request->except(['id']);
            $data['create_time'] = time();
            if ($data['type'] == 0) {
                return ajax_return_adv_error('请选择代理等级');
            }
            $res= Db('equity')->where(array('type'=>$data['type']))->find();
//            if($res){
//                return ajax_return_adv_error('当前代理等级已添加请前往修改');
//            }
            db('equity')->where(array('id' => $id))->data($data)->update();
            return ajax_return_adv('添加成功');
        } else {
            $id = $this->request->param('id');
            $vo = db('equity')->where(array('id' => $id))->find();
            $this ->view->assign('vo',$vo);
            return $this->view->fetch();
        }

    }
}