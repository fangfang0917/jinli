<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/11
 * Time: 15:46
 */

namespace app\index\controller;


use think\Controller;

class Yun extends Controller
{
    public function index()
    {
        $userDate = Db('user')->where(array('level' => ['GT', '4']))->field(array('id', 'pid', 'amount', 'level'))->select();
        $begin_time = date('Y-m-01 00:00:00', strtotime('-1 month'));
        $end_time = date("Y-m-d 23:59:59", strtotime(-date('d') . 'day'));
        $arr = [];
        dump($userDate);
        foreach ($userDate as $k=>$v) {
            $this->Calculate_profit_sharing($v['id']);
        }
    }


    public function Calculate_profit_sharing($userid)
    {
        $children = Db('user')->where(array('pid'=>$userid,'level'=>['GT','1']))->field(array('id','level'))->select();
        $ids = [];
        $amount = 0;
        foreach($children  as $k=>$v){
             array_push($ids,$v['id']);
            $amount =  $this->totalamount($v['id']);
        }
        $childrennum = count($ids);
        $totalvipmoney = $childrennum*365;
        $totalordermoney = db('order')->where(array('user_id'=>['in',$ids]))->sum('money');

    }

    public function totalamount($id){
        $children = Db('user')->where(array('pid'=>$id,'level'=>['GT','0']))->field(array('id'))->select();
        $childrens = Db('user')->where(array('p_pid'=>$id,'level'=>['GT','0']))->field(array('id'))->select();
        array_merge($children,$childrens);
        dump($children);
        $stime = date('Y-m-01 00:00:00', strtotime('-1 month'));;
        $etime = date("Y-m-d 23:59:59", strtotime(-date('d') . 'day'));
        $map['user_id'] = $id;
        $map['add_time'] = ['BETWEEN',[strtotime($stime),strtotime($etime)]];
        $orderamount = db('order')->where($map)->sum('money');
        return $orderamount;
    }
}