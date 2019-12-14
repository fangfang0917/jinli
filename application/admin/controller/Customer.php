<?php

namespace app\admin\controller;

use app\admin\Controller;
use think\Cache;

class Customer extends Controller
{
    use \app\admin\traits\controller\Controller;

    public function index(){
        if($this->request->isAjax()){
            $data = $this ->request->param();
            Cache::set('Customer','');
            Cache::set('Customer',$data);
            return ajax_return_adv('操作成功!!!','url(Customer/index)','操作成功!!');
        }else{
            $vo = Cache::get('Customer');
            $this->view->assign('vo',$vo);
            return $this->view->fetch();
        }
    }
}