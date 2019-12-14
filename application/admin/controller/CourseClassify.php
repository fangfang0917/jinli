<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/11
 * Time: 9:50
 */

namespace app\admin\controller;


use app\admin\Controller;
use think\Db;

class CourseClassify extends Controller
{
    use \app\admin\traits\controller\Controller;
    public function index(){
        $map = [];
        if($this->request->param('course_classify_title')){
            $map['course_classify_title']=['like',"%".$this ->request->param('course_classify_title')."%"];
        }
        $list = Db('course_classify')->where($map)->paginate(10,false,['query'=>request()->param()]);
        $this ->view->assign('list',$list);
        $this ->view->assign('count',$list->count());
        $this ->view->assign('page',$list->render());
        return $this ->view->fetch();
    }
    public function add(){
        if($this->request->isAjax()){
             $data = $this->request->param();
             if($data['course_type'] == 0){
                   return  ajax_return_adv_error('请选择分类类型');
             }
             $data['add_time'] = time();
             db('course_classify')->insert($data);
             return ajax_return_adv('操作成功');
        }else{
            return $this->view->fetch('edit');
        }
    }
    public function edit(){
        if($this->request->isAjax()){
            $data = $this->request->except(['id']);
            $id = $this ->request->param('id');
            if($data['course_type'] == 0){
                return  ajax_return_adv_error('请选择分类类型');
            }
            db('course_classify')->where(array('id'=>$id))->data($data)->update();
            return ajax_return_adv('操作成功');
        }else{
            $id = $this ->request->param('id');
            $vo = db('course_classify')->where(array('id'=>$id))->find();
            $this ->view->assign('vo',$vo);
            return $this->view->fetch();
        }
    }
}