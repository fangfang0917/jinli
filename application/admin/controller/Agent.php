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

class Agent extends Controller
{
    use \app\admin\traits\controller\Controller;

    public function index()
    {
        $map = [];
        $map['level'] = ['NOT IN', [0, 1]];
        if ($this->request->param('nick_name')) {
            $map['nick_name'] = ['like', '%' . $this->request->param('nick_name')];
        }
        if ($this->request->param('phone')) {
            $map['phone'] = ['like', '%' . $this->request->param('phone')];
        }
        if ($this->request->param('level')) {
            $level = $this->request->param('level');
            if ($level > 0) {
                if ($level == 3) {
                    $map['level'] = 2;
                } elseif ($level == 4) {
                    $map['level'] = 3;
                } elseif ($level == 5) {
                    $map['level'] = 4;
                } elseif ($level == 6) {
                    $map['level'] = 5;
                }

            }
        }
        if ($this->request->param('start_time')) {
            $map['add_time'] = ['BETWEEN', [strtotime($this->request->param('start_time')), strtotime($this->request->param('end_time'))]];
        }

        $list = Db('user')->where($map)->paginate(10, false, ['query' => request()->param()]);
        $this->view->assign('list', $list);
        $this->view->assign('count', $list->count());
        $this->view->assign('page', $list->render());
        return $this->view->fetch();

    }


    public function add()
    {
        if ($this->request->isAjax()) {
            $data = $this->request->param();
            $data['course_add_time'] = time();
            db('course')->insert($data);
            return ajax_return_adv('添加成功');
        } else {
            return $this->view->fetch('edit');
        }
    }

    public function edit()
    {
        if ($this->request->isAjax()) {
            $data = $this->request->except(['id']);
            $id = $this->request->param('id');
            $data['update_time'] = time();
            db('user')->where(array('id' => $id))->data($data)->update();
            return ajax_return_adv('修改成功');
        } else {
            $id = $this->request->param('id');
            $vo = db('user')->where(array('id' => $id))->find();
            $this->view->assign('vo', $vo);
            return $this->view->fetch();
        }
    }

    public function team()
    {
        $id = $this->request->param('id');
        $counts = $this->teamjs($id);
        $this->view->assign('pcount', $counts['pcount']);
        $this->view->assign('ppcount', $counts['ppcount']);
        $this->view->assign('counts', $counts);
        $this->view->assign('list', $counts['list']);
        $this->view->assign('count', $counts['list']->count());
        $this->view->assign('page', $counts['list']->render());
        return $this->view->fetch();
    }

    public function buy()
    {
        $id = $this->request->param('id');
        $list = db('order')->alias('o')->join('user u', 'u.id = user_id', 'left')
            ->where(array('user_id' => $id))->field(array('u.nick_name', 'o.order_no', 'o.money', 'o.course_id', 'o.add_time', 'o.pay_type', 'o.id'))->paginate(10, false, ['query' => request()->param()]);
        $this->view->assign('list', $list);
        $this->view->assign('count', $list->count());
        $this->view->assign('page', $list->render());
        return $this->view->fetch();
    }

    public function profit()
    {
        $id = $this->request->param('id');
        $map['user_id'] = $id;
        $list = db('user_record')->alias('ur')->join('user u', 'ur.user_id = u.id', 'left')
            ->join('user us', 'us.id = ur.son_id')
            ->where($map)->field(array('u.nick_name', 'ur.add_time', 'ur.type', 'ur.amount', 'us.nick_name as snick_name',
                'ur.remarks', 'ur.type_status', 'ur.up_time'))->paginate(10, false, ['query' => request()->param()]);
        $this->view->assign('list', $list);
        $this->view->assign('count', $list->count());
        $this->view->assign('page', $list->render());
        return $this->view->fetch();
    }
}
