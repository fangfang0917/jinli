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

class OrderList extends Controller
{
    use \app\admin\traits\controller\Controller;

    public function index()
    {
        $map = [];
        if ($this->request->param('nick_name')) {
            $map['u.nick_name'] = ['like', '%' . $this->request->param('nick_name') . '%'];
        }
        if ($this->request->param('level')) {
            $level = $this->request->param('level');
            if ($level > 0) {
                if ($level == 1) {
                    $map['u.level'] = 0;
                } elseif ($level == 2) {
                    $map['u.level'] = 1;
                } elseif ($level == 3) {
                    $map['u.level'] = 2;
                } elseif ($level == 4) {
                    $map['u.level'] = 3;
                } elseif ($level == 5) {
                    $map['u.level'] = 4;
                } elseif ($level == 6) {
                    $map['u.level'] = 5;
                }
            }
        }
        if ($this->request->param('phone')) {
            $map['u.phone'] = $this->request->param('phone');
        }
        if ($this->request->param('order_no')) {
            $map['o.order_no'] = ['like', '%' . $this->request->param('order_no') . '%'];
        }
        if ($this->request->param('pay_type')) {
            $pay_type = $this->request->param('pay_type');
            if ($pay_type > 0) {
                if ($pay_type == 1) {
                    $map['o.pay_type'] = 1;
                } else {
                    $map['o.pay_type'] = 0;
                }
            }

        }
        if ($this->request->param('start_time')) {
            $map['o.add_time'] = ['BETWEEN', [strtotime($this->request->param('start_time')), strtotime($this->request->param('end_time'))]];
        }
        $map['money'] = ['gt',0];
        $list = Db('order')->alias('o')
            ->join('user u', 'u.id = o.user_id', 'left')
            ->join('course c', 'c.id = o.course_id', 'left')
            ->where($map)->field(array('u.nick_name', 'u.phone', 'u.level', 'o.id', 'o.order_no',
                'o.money', 'c.course_title', 'from_unixtime(o.add_time,"%Y-%m-%d %H:%i:%s") as add_time', 'o.pay_type', 'o.is_status','o.order_type'))
            ->order('id desc')
            ->paginate(10, false, ['query' => request()->param()]);
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

    public function excel()
    {
        $where = $this->request->param();
        $map['o.add_time'] = ['between', strtotime($where['start_time']) . ',' . strtotime($where['end_time'])];
        $map['o.order_type'] = 1;
        $map['o.money'] = ['gt',0];
        $list = db('order')->alias('o')->join('user u', 'o.user_id = u.id')
            ->join('course c', 'o.course_id = c.id')
            ->field(array('o.order_no', 'u.id','u.nick_name', 'u.level', 'u.phone', 'c.course_title', 'c.course_vip_money', 'c.course_money', 'from_unixtime(o.add_time,\'%Y-%m-%d %H:%i:%s\') as add_time', 'o.money'))
            ->where($map)->select();
        foreach ($list as $k => $v) {
            if ($v['level'] == 0) {
                $list[$k]['level'] = '非会员';
            } elseif ($v['level'] == 1) {
                $list[$k]['level'] = '会员';
            } elseif ($v['level'] == 2) {
                $list[$k]['level'] = '初级代理';
            } elseif ($v['level'] == 3) {
                $list[$k]['level'] = '中级代理';
            } elseif ($v['level'] == 4) {
                $list[$k]['level'] = '高级代理';
            } elseif ($v['level'] == 5) {
                $list[$k]['level'] = '私董';
            }
        }
        $header = ['订单号', '用户ID','用户昵称', '用户等级', '手机号码', '课程名称','vip价格', '价格', '支付时间', '支付金额'];
        if ($error = \Excel::export($header, $list, "订单表", '2007')) {
            throw new Exception($error);
        }
    }
}
