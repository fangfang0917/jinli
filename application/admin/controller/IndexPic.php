<?php

namespace app\admin\controller;

use app\admin\Controller;
use think\Cache;

class IndexPic extends Controller
{
    use \app\admin\traits\controller\Controller;

    public function index()
    {
        if ($this->request->isAjax()) {
            $data = $this->request->param();

            Cache::set('index_pic', '');
            Cache::set('index_pic', $data);
            return ajax_return_adv('操作成功!', "url('IndexPic/index')", '操作成功');
        } else {
            $vo = Cache::get('index_pic');
            $checkbox = json_encode($vo['checkbox']);
            $this->view->assign('vo', $vo);
            $this->view->assign('checkbox', $checkbox);
            return $this->view->fetch();
        }
    }
}