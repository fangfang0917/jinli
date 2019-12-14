<?php
namespace app\admin\controller;

use app\admin\Controller;

class Gifcourse extends Controller
{
    use \app\admin\traits\controller\Controller;
    public function index(){
        if($this->request->isAjax()){
            $data = $this ->request->param();

             $data['course_id'] = join(',',$data['checkbox']);
            unset($data['checkbox']);
             db('gifcourse')->where(array('id'=>1))->data($data)->update();
             return ajax_return_adv('',"url('gifcourse/index')",'操作成功');
        }else{
            $list = db('gifcourse')->where(array('id'=>1))->find();
            $this->view->assign('vo',$list);
            $map['c.course_classify_id'] = array('not in','6,7');
            $course = DB('course')->alias('c')->join('course_classify cc','cc.id = c.course_classify_id')
                ->where($map)->field(array('c.id','c.course_title'))->select();
            $course_id = explode(',',$list['course_id']);
            foreach ($course as $k=>$v)
            {
                if(in_array($v['id'],$course_id)){
                    $course[$k]['check'] = 1;
                }else{
                    $course[$k]['check'] = 2;

                }
            }
            $this ->view->assign('course',$course);
            return $this ->view->fetch();
        }
    }

}