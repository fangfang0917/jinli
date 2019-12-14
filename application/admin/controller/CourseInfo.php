<?php
/**
 * tpAdmin [a web admin based ThinkPHP5]
 *
 * @author yuan1994 <tianpian0805@gmail.com>
 * @link http://tpadmin.yuan1994.com/
 * @copyright 2016 yuan1994 all rights reserved.
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */

//------------------------
// 角色控制器
//-------------------------

namespace app\admin\controller;

\think\Loader::import('controller/Controller', \think\Config::get('traits_path'), EXT);

use app\admin\Controller;
use think\Exception;
use think\Db;
use think\Loader;
use think\Session;

class CourseInfo extends Controller
{
    use \app\admin\traits\controller\Controller;

    public function index()
    {
        $map = [];


        if ($this->request->param('course_info_title')) {
            $map['ci.course_info_title'] = ['like', '%' . $this->request->param('course_info_title') . '%'];
        }
        $map['ci.course_id'] = $this->request->param('course_id');
        $list = Db('course_info')->alias('ci')
            ->join('course c', 'ci.course_id = c.id')
            ->where($map)
            ->field(array('c.course_title', 'ci.course_info_title', 'ci.course_info_path',
                'ci.course_info_type', 'ci.course_info_content', 'ci.course_info_add_time', 'ci.course_info_auth',
                'ci.course_info_share_money', 'ci.course_info_look_num', 'ci.course_info_pic',
                'ci.course_info_money', 'ci.course_info_vip_money', 'ci.course_info_remarks', 'ci.course_info_add_time',
                'ci.course_info_update_time', 'ci.id', 'ci.status', 'ci.sort'))
            ->order('ci.id desc')
            ->paginate(10, false, ['query' => request()->param()]);
        $this->view->assign('list', $list);
        $this->view->assign('count', $list->count());
        $this->view->assign('page', $list->render());
        $this->view->assign('course_id', $this->request->param('course_id'));
        return $this->view->fetch();
    }


    public function add()
    {
        if ($this->request->isAjax()) {
            $data = $this->request->except(['course_title']);
            $data['course_info_add_time'] = time();
            if ($data['course_info_auth'] == 0) {
                return ajax_return_adv_error('请选择是否试听');
            }
            db('course_info')->insert($data);
            Session::delete('video_path');
            return ajax_return_adv('添加成功');
        } else {
            $course_id = $this ->request->param('course_id');
            $course = db('course')->where(array('id'=>$course_id))->find();
            $this ->view->assign('vvo',$course);
            return $this->view->fetch('edit');
        }
    }

    public function getcourse()
    {
        $map = [];
        if ($this->request->param('course_title')) {
            $map['course_title'] = ['like', '%' . $this->request->param('course_title')];
        }
        $list = Db('course')->where($map)->paginate(10, false, ['query' => request()->param()]);
        $this->view->assign('list', $list);
        $this->view->assign('count', $list->count());
        $this->view->assign('page', $list->render());
        return $this->view->fetch();
    }

    public function edit()
    {
        if ($this->request->isAjax()) {
            $data = $this->request->except(['id', 'course_title']);
            $id = $this->request->param('id');
            $data['course_info_update_time'] = time();
           
            if ($data['course_info_auth'] == 0) {
                return ajax_return_adv_error('请选择是否试听');
            }
            Session::delete('video_path');
            db('course_info')->where(array('id' => $id))->data($data)->update();
            return ajax_return_adv('修改成功');
        } else {
            $id = $this->request->param('id');
            $vo = Db('course_info')->alias('ci')
                ->join('course c', 'ci.course_id = c.id')
                ->where(array('ci.id' => $id))
                ->field(array('c.course_title', 'ci.course_info_title', 'ci.course_info_path',
                    'ci.course_info_type', 'ci.course_info_content', 'ci.course_info_add_time', 'ci.course_info_auth',
                    'ci.course_info_share_money', 'ci.course_info_look_num', 'ci.course_info_pic',
                    'ci.course_info_money', 'ci.course_info_vip_money', 'ci.course_info_remarks', 'ci.course_info_add_time',
                    'ci.course_info_update_time', 'ci.id', 'ci.status', 'ci.course_id', 'ci.course_info_path_time'))
                ->find();
            $course = DB('course')->where(array('id'=>$vo['course_id']))->find();
            Session::set('video_path', $vo['course_info_path']);
            $this->view->assign('vo', $vo);
            $this->view->assign('vvo', $course);
            return $this->view->fetch();
        }
    }

    public function play()
    {
        $path = Session::get('video_path');
        $this->view->assign('path', $path);
        return $this->view->fetch();
    }
    public function saveOrder()
    {
        $param = $this->request->param();
        if (!isset($param['sort'])) {
            return ajax_return_adv_error('缺少参数');
        }

        $model = $this->getModel();
        foreach ($param['sort'] as $id => $sort) {
            $model->where('id', $id)->update(['sort' => $sort]);
        }

        return json(array('status'=>1,'msg'=>'保存成功'));
    }
}
