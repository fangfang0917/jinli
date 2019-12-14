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

class Share extends Controller
{
    use \app\admin\traits\controller\Controller;

    public function add()
    {
        if($this ->request->isAjax()){
             $data = $this ->request->param();
             $data['create_time'] = time();
             DB('share')->insert($data);
             return ajax_return_adv('添加成功');
        }else{
            return $this ->view->fetch('edit');
        }
    }
    public function edit()
    {
        if($this ->request->isAjax()){
            $data = $this ->request->except(['id']);
            $id = $this ->request->param('id');
            $data['create_time'] = time();
            DB('share')->where(array('id'=>$id))->update($data);
            return ajax_return_adv('修改成功');

        }else{
            $id = $this->request ->param('id');
            $vo =Db('share')->where(array('id'=>$id))->find();
            $this ->view->assign('vo',$vo);
            return $this ->view->fetch();
        }
    }
}
