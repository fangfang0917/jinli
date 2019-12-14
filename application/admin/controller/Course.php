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

\think\Loader::import('controller/Controller', \think\Config::get('traits_path') , EXT);

use app\admin\Controller;
use think\Exception;
use think\Db;
use think\Loader;

class Course extends Controller
{
    use \app\admin\traits\controller\Controller;
    public function index(){
        $map = [];
        if($this->request->param('course_title')){
            $map['c.course_title'] = ['like','%'.$this->request->param('course_title')."%"];
        }
        if($this->request->param('course_type')){
            $map['cc.course_type'] = $this->request->param('course_type');
        }
        if($this->request->param('course_classify_id')){
            $map['cc.id'] = $this->request->param('course_classify_id');
        }
//        dump($map);
        $list = Db('course')->alias('c')
            ->join('course_classify cc','cc.id = c.course_classify_id','left')
            ->where($map)
            ->field(array('cc.course_classify_title','c.course_pic','c.course_title',
                'c.course_money','c.course_vip_money','c.course_isvip','c.course_index','c.course_add_time','c.id','c.sort','c.course_remark','c.status','cc.course_type','c.course_money_op'))
            ->order('c.id desc')
            ->paginate(10,false,['query'=>request()->param()]);
        $this->view->assign('list',$list);
        $this->view->assign('count',$list->count());
        $this->view->assign('page',$list->render());
        return $this->view->fetch();

    }


    public function add(){
        if($this->request->isAjax()){
            $data = $this->request->except(['course_classify_title','level']);

            if($data['course_index'] == 0){
                return ajax_return_adv_error('请选择是否首页推荐');
            }
            $level = $this ->request->param('level');

            if($level){
                $data['level'] = json_encode($level);
            }else{
                $data['level'] =0;
            }

            $data['course_add_time'] = time();
            db('course')->insert($data);
            return ajax_return_adv('添加成功');
        }else{
            return $this->view->fetch('edit');
        }
    }

    public function edit(){
        if($this->request->isAjax()){
            $data = $this->request->except(['id','course_classify_title']);
            $id = $this->request->param('id');
            $data['course_update_time'] = time();
            if($data['course_index'] == 0){
                return ajax_return_adv_error('请选择是否首页推荐');
            }
            if(isset($data['level'])){
                $data['level'] = json_encode($data['level']);
            }else{
                $data['level'] = 0;
            }
            db('course')->where(array('id'=>$id))->data($data)->update();
            return ajax_return_adv('修改成功');
        }else{
            $id = $this->request->param('id');
            $vo = db('course')->where(array('id'=>$id))->find();
            $course_classify_title = db('course_classify')->where(array('id'=>$vo['course_classify_id']))->value('course_classify_title');
            $vo['course_classify_title'] = $course_classify_title;
            $this->view->assign('vo',$vo);
            $course_url = 'http://'.$_SERVER['HTTP_HOST'].'/index/course/detail/id/'.$vo['id'];
            $this->view->assign('course_url',$course_url);
            return $this->view->fetch();
        }
    }

    public function getCourseClassify(){
        $map = [];
        if ($this->request->param('course_classify_title')) {
            $map['course_classify_title'] = ['like', '%' . $this->request->param('course_classify_title')];
        }
        $list = Db('course_classify')->where($map)->paginate(10, false, ['query' => request()->param()]);
        $this->view->assign('list', $list);
        $this->view->assign('count', $list->count());
        $this->view->assign('page', $list->render());
        return $this->view->fetch();
    }


    public function deljiaobiao(){
        $id = $this ->request->param('id');
        DB('course')->where(array('id'=>$id))->update(array('course_pic_jiao'=>0));
        return json(array('msg'=>'重置成功'));
    }


   
}
