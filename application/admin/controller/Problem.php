<?php

namespace app\admin\controller;

use app\admin\Controller;

class Problem extends Controller
{
    use \app\admin\traits\controller\Controller;

    public function index()
    {
        $map = [];
        if ($this->request->param('type')) {
            if ($this->request->param('type') != 0) {
                $map['type'] = $this->request->param('type');
            }
        }
        $list = Db('problem')->where($map)->paginate(10, false, ['query' => request()->param()]);
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
            $data['type'] = 1;
            db('problem')->insert($data);
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
            db('problem')->where(array('id' => $id))->data($data)->update();
            return ajax_return_adv('添加成功');
        } else {
            $id = $this->request->param('id');
            $vo = db('problem')->where(array('id' => $id))->find();
            $this->view->assign('vo', $vo);
            return $this->view->fetch();
        }

    }
}