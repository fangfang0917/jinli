<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/16
 * Time: 9:36
 */

namespace app\admin\controller;


use app\admin\Controller;
use think\Config;

class CourseInfoComment extends Controller
{
    use \app\admin\traits\controller\Controller;
    public function index(){
        $map = [];
        if($this->request->param('course_id')){
            $map['c.id'] = $this->request->param('course_id');
        }
        if($this->request->param('nick_name')){
            $map['u.nick_name'] = ['like','%'.$this->request->param('nick_name').'%'];
        }
        $list = Db('course_comment')->alias('cic')->join('user u','u.id = cic.user_id','left')
            ->join('course c','cic.course_id = c.id','left')
            ->where($map)->field(array('cic.id','u.nick_name','cic.course_comment_content','cic.add_time','cic.status',
                'c.course_title','cic.type','cic.reply_content','cic.reply_time'))
            ->order('cic.id desc')
            ->paginate(10,false,['query'=>request()->param()]);
        $courseClassify = db('course_classify')->select();
        $this->view->assign('list',$list);
        $this->view->assign('count',$list->count());
        $this->view->assign('page',$list->render());
        $this->view->assign('courseClassifyForm',$courseClassify);

        return $this->view->fetch();
    }

    public function type(){
        $id = $this->request->param('id');
        $type = $this->request->param('type');
        db('course_comment')->where(array('id'=>$id))->update(array('type'=>$type,'up_time'=>time()));
        return json(array('state'=>1,'msg'=>'审核成功!'));
    }

    public function addreply(){
        $id = $this -> request ->param('id');
        $reply_content = $this->request->param('reply_content');
        $data = array(
            'reply_content'=>$reply_content,
            'reply_time'=>time()
        );
        db('course_comment')->where(array('id'=>$id))->data($data)->update();
        return json(array('state'=>1,'msg'=>'回复成功'));
    }

    public function getcourse(){
        $id = $this ->request->param('id');
        $course = db('course')->where(array('course_classify_id'=>$id))->select();
        $this ->view->assign('courseList',$course);
        return $this ->view->fetch();
    }
}