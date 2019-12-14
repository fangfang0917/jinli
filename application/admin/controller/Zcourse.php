<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/17
 * Time: 10:17
 */

namespace app\admin\controller;


use app\admin\Controller;

class Zcourse extends Controller
{

    public function index()
    {
        $map = [];
        $map['type'] = 1;
        if ($this->request->param('course_title')) {
            $map['c.course_title'] = ['like', '%' . $this->request->param('course_title') . '%'];
        }
        $list = Db('course_index')->alias('ci')->join('course c', 'ci.course_id = c.id', 'left')
            ->where($map)->field(array('c.course_title', 'ci.sort', 'ci.create_time', 'c.id'))->paginate(10, false, ['query' => request()->param()]);
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
            db('course_index')->insert($data);
            return json(array('state' => 1, 'msg' => '操作成功'));
        } else {
            $map = [];
            $map['course_type'] = 1;
            $arr = Db('course_index')->select();
            $ids = [];
            foreach ($arr as $k => $v) {
                array_push($ids, $v['course_id']);
            }
            $map['id'] = ['NOT IN', $ids];
            $list = db('course')->where($map)->paginate(10, false, ['query' => request()->param()]);
            $this->view->assign('list', $list);
            $this->view->assign('count', $list->count());
            $this->view->assign('page', $list->render());
            return $this->view->fetch();
        }
    }

    public function deleteforever()
    {
        $id = $this->request->param('id');
        db('course_index')->where(array('id' => $id))->delete();
        return ajax_return_adv('删除成功');
    }
}