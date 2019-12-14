<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/16
 * Time: 11:22
 */

namespace app\admin\controller;


use app\admin\Controller;

class UserTxRecord extends Controller
{
    public function index()
    {
        $map = [];
        $map['type'] = 3;
        if($this->request->param('nick_name')){
            $map['u.nick_name'] = ['like','%'.$this->request->param('nick_name').'%'];
        }
        if($this->request->param('type_status')){
            $type_status = $this->request->param('type_status');
            if($type_status == 1){
               $map['type_status'] = 0;
            }elseif ($type_status == 2){
                $map['type_status'] = 1;
            }else{
                $map['type_status'] = 2;
            }
        }
        $list = db('user_record')->alias('ur')->join('user u', 'ur.user_id = u.id','left')
            ->where($map)->field(array('ur.id', 'ur.amount', 'ur.type', 'ur.type_status', 'ur.add_time', 'u.nick_name', 'ur.remarks',
                'u.realname','u.card','u.bankname'))
            ->order('ur.id desc')
            ->paginate(10, false, ['query' => request()->param()]);
        $this->view->assign('list', $list);
        $this->view->assign('count', $list->count());
        $this->view->assign('page', $list->render());
        return $this->view->fetch();
    }

    public function type()
    {
        $id = $this->request->param('id');
        $type = $this->request->param('type');
        $data = array(
            'type_status' => $type,
            'up_time' => time()
        );
        db('user_record')->where(array('id' => $id))->data($data)->update();
        return   json(array('state'=>1,'msg'=>'审核成功!'));
    }
}