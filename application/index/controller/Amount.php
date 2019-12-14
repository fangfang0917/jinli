<?php

namespace app\index\controller;

use app\index\Controller;
use think\Session;

class Amount extends Controller
{
    public function index()
    {
        //用户信息
        $userinfo = Db('user')->where(array('id' => Session::get('user_id')))->find();
        $userinfo['amount'] = number_format($userinfo['amount'] ,2 ,"." ,"");
        $Amount = $this->getUserAmount();
        $moth = $this->getMoth();
        $this->view->assign('Moth' ,$moth);
        $this->view->assign('thisMoth' ,date('Y-m' ,time()));
        $this->view->assign('Amount' ,$Amount);
        $this->view->assign('userinfo' ,$userinfo);
        $this->view->assign('title' ,'我的钱包');
        return $this->view->fetch();
    }

    public function amountlist()
    {
        $time = $this->request->param()['whe'];
        if ($time['wheretype'] == 1) {
            $where = array('time' => $time['monthtime'] ,'time_type' => 3);
            $map['ur.add_time'] = $this->searchDate($where);
        } else {
            $where = array('time' => $time['daystime'] ,'time1' => $time['dayetime'] ,'time_type' => 5);
            $map['ur.add_time'] = $this->searchDate($where);
        }
        $map['ur.user_id'] = Session::get('user_id');
        $map['ur.type'] = array('not in' ,'3');
        $list = Db('user_record')->alias('ur')
            ->join('user u' ,'u.id=ur.user_id' ,'left')
            ->join('user us' ,'us.id=ur.son_id' ,'left')
            ->where($map)->field(array('us.nick_name as sname' ,'u.nick_name' ,'ur.remarks' ,'ur.amount' ,'ur.add_time,
            us.head' ,'us.head_type'))->order('ur.add_time desc')->select();
        $this->view->assign('list' ,$list);
        return $this->view->fetch();
    }

    public function jcamount()
    {
        $time = $this->request->param()['whe'];
        if ($time['wheretype'] == 1) {
            $where = array('time' => $time['monthtime'] ,'time_type' => 3);
            $map['ur.add_time'] = $this->searchDate($where);
            $mapp['ur.add_time'] = $this->searchDate($where);
        } else {
            $where = array('time' => $time['daystime'] ,'time1' => $time['dayetime'] ,'time_type' => 5);
            $map['ur.add_time'] = $this->searchDate($where);
            $mapp['ur.add_time'] = $this->searchDate($where);
        }
        $map['ur.user_id'] = Session::get('user_id');
        $map['ur.type'] = array('not in' ,'3');
        $mapp['ur.user_id'] = Session::get('user_id');
        $mapp['ur.type'] = '3';
        $totalamount = Db('user_record')->alias('ur')
            ->join('user u' ,'u.id=ur.user_id' ,'left')
            ->join('user us' ,'us.id=ur.son_id' ,'left')
            ->where($map)->sum('ur.amount');
        $totalamount_tx = Db('user_record')->alias('ur')
            ->join('user u' ,'u.id=ur.user_id' ,'left')
            ->join('user us' ,'us.id=ur.son_id' ,'left')
            ->where($mapp)->sum('ur.amount');
        $jcamount = $totalamount - $totalamount_tx;
        return json(array(
            'totalamount' => number_format($totalamount ,2 ,"." ,"") ,
            'jcamount' => number_format($jcamount ,2 ,"." ,"")));
    }

    public function amountlists()
    {
        $moth = $this->getMoth();
        $this->view->assign('Moth' ,$moth);
        $this->view->assign('thisMoth' ,date('Y-m' ,time()));
        $this->view->assign('title' ,'收益明细');
        return $this->view->fetch();
    }
}