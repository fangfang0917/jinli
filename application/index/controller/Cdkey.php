<?php

namespace app\index\controller;

use app\index\Controller;
use think\Session;

class Cdkey extends Controller
{
    public function index()
    {
        $this->view->assign('title','兑换中心');
        return $this ->view->fetch();
    }

    public function canCode()
    {
        $code = $this->request->param('cdkey');
        $codetype = $this->request->param('codeType');
        $codeinfo = db('codeinfo')->where(array('code' => $code))->find();
        $code = Db('code')->where(array('id' => $codeinfo['cid']))->find();
        if($code['codeType'] != $codetype){
            return json(array('status' => 0, 'msg' => '兑换类型不正确!!!'));

        }
        if(!$codeinfo){
            return json(array('status' => 0, 'msg' => '兑换码错误!!!'));
        }
        if ($code['daoqitime'] < time()) {
            return json(array('status' => 0, 'msg' => '兑换码已过期!!!'));
        }
        if ($codeinfo['cantype'] == 1) {
            return json(array('status' => 0, 'msg' => '已被使用,无法再次使用!!!'));

        }
        if ($code['codeType'] == 1) {
            if ($this->userInfo['level'] >= $code['level']) {
                return json(array('status' => 0, 'msg' => '当前等级大于等于兑换等级!兑换失败'));
            }
            $res = db('user')->where(array('id' => Session::get('user_id')))->update(array('level' => $code['level']));
            if ($res) {
                if ($this->userInfo['pid'] == 0) {
                    $pr = DB('user')->where(array('id' => $code['userId']))->find();
                    $data = array(
                        'pid' => $pr['id'],
                        'p_pid' => $pr['pid'],
                        'path' => $pr['path'] . '|' . $pr['id']
                    );
                    db('user')->where(array('id' => Session::get('user_id')))->update($data);
                }
            }
            $codelists = array(
                'cid'=>$code['id'],
                'codeinfo'=>$code,
                'codetype'=>$codetype,
                'codetypename'=>'兑换会员',
                'createtime'=>time(),
                'uid'=>$code['userId'],
                'level'=>$code['level'],
                'course_id'=>0,
                'userid'=>$this->userInfo['id'],

            );
            db('codelists')->insert($codelists);
            db('codeinfo')->where(array('id' => $codeinfo['id']))->update(array('cantype' => 1));

            return json(array('status' => 1, 'msg' => '兑换会员成功!'));
        } else {
            $order = Db('order')->where(array('course_id' => $code['course_id'], 'user_id' => Session::get('user_id')))->find();
            if ($order) {
                return json(array('status' => 0, 'msg' => '已拥有该课程!兑换失败'));
            }
            $data = array(
                'user_id' => Session::get('user_id'),
                'money' => 0,
                'course_id' => $code['course_id'],
                'order_type' => 1,
                'add_time' => time(),
                'order_no' => time() . rand(1111111, 9999999),
                'order_no_remarkes' => '1' . 'buyCourse' . rand(1111111, 9999999) . time(),
                'pay_type' => 1,
                'course_type' => 3,
            );
            db('order')->insert($data);
            $codelists = array(
                'cid'=>$code['id'],
                'codeinfo'=>$code,
                'codetype'=>$codetype,
                'codetypename'=>'兑换课程',
                'createtime'=>time(),
                'uid'=>$code['userId'],
                'level'=>0,
                'course_id'=>$code['course_id'],
                'userid'=>$this->userInfo['id'],

            );
            db('codelists')->insert($codelists);
            db('codeinfo')->where(array('id' => $codeinfo['id']))->update(array('cantype' => 1));
            return json(array('status' => 1, 'msg' => '兑换课程成功!请前往我的课程查看'));
        }

    }


    public function succ(){
        $this->view->assign('title','兑换成功');
        return $this->view->fetch();
    }


}