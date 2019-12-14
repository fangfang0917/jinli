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

class Set extends Controller
{
    use \app\admin\traits\controller\Controller;
    public function index(){
        $map = [];
        if($this->request->param('course_title')){
            $map['course_title'] = ['like','%'.$this->request->param('course_title')];
        }
        $list = Db('course')->where($map)->paginate(10,false,['query'=>request()->param()]);
        $this->view->assign('list',$list);
        $this->view->assign('count',$list->count());
        $this->view->assign('page',$list->render());
        return $this->view->fetch();

    }

    public function add(){
        if($this->request->isAjax()){
            $data = $this->request->param();
            $data['course_add_time'] = time();
            db('course')->insert($data);
            return ajax_return_adv('添加成功');
        }else{
            return $this->view->fetch('edit');
        }
    }

    public function edit(){
        if($this->request->isAjax()){
            $data = $this->request->except(['id']);
            $id = $this->request->param('id');
            $data['course_update_time'] = time();
            db('course')->where(array('id'=>$id))->data($data)->update();
            return ajax_return_adv('修改成功');
        }else{
            $id = $this->request->param('id');
            $vo = db('course')->where(array('id'=>$id))->find();
            $this->view->assign('vo',$vo);
            return $this->view->fetch();
        }
    }
}
