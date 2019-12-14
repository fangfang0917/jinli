<?php

namespace app\admin\controller;


\think\Loader::import('controller/Controller', \think\Config::get('traits_path'), EXT);

use app\admin\Controller;
use think\Exception;
use think\Db;
use think\Loader;


class Outlevel extends Controller
{
    use \app\admin\traits\controller\Controller;

    public function index()
    {
        $map = [];
        $list = Db('outlevel')->alias('ol')->join('user u','ol.user_id = u.id','left')
            ->field(array('u.nick_name','ol.createtime','ol.realname','ol.addr','ol.type','ol.level','u.phone','ol.uptime','ol.id','ol.amount'))
            ->where($map)->paginate(10, false, ['query' => request()->param()]);
        $this->view->assign('list', $list);
        $this->view->assign('count', $list->count());
        $this->view->assign('page', $list->render());
        return $this->view->fetch();
    }

    public function isType(){
        $id = $this->request->param('id');
        $type = $this -> request ->param('type');
        db('outlevel')->where(array('id'=>$id))->update(array('type'=>$type,'uptime'=>time()));
        if($type == 1){
            $userid = DB('outlevel')->where(array('id'=>$id))->value('user_id');
            Db('user')->where(array('id'=>$userid))->update(array('level'=>5));
            $pid = Db('user')->where(array('id'=>$userid))->value('pid');
            $sys = db('userop')->where(array('id' => 0))->find();
            $this->sys = json_decode($sys['userop'], true);
            if($pid != 0){
                Db('user')->where(array('id'=>$pid))->setInc('amount',$this->sys['vip_tui_zj']);
                $ppdata = array(
                    'user_id' => $pid,
                    'son_id' => $userid,
                    'amount' => $this->sys['vip_tui_zj'],
                    'type' => 4,
                    'add_time' => time(),
                    'remarks' => '推荐钻石会员奖励'
                );
                DB('user_record')->insert($ppdata);
            }
        }

        return json(array('state'=>1,'msg'=>'审核成功!!!'));
    }
}