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
use think\Cache;
use think\Exception;
use think\Db;
use think\Loader;

class UserOp extends Controller
{
    use \app\admin\traits\controller\Controller;
    public function index(){
        if($this->request->isAjax()){
            $data = $this->request->param();
            Db('userop')->where(array('id'=>0))->delete();
            Db('userop')->insert(array('userop'=>json_encode($data)));
            return ajax_return_adv('操作成功','url(UserOp/index)','操作成功');
        }else{
            $res = DB('userop')->where(array('id'=>0))->find();
            $this->view->assign('data',json_decode($res['userop'],true));
            return $this->view->fetch();
        }
    }
 }
