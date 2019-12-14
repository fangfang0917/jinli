<?php

namespace app\index\controller;

use app\index\Controller;
class About extends Controller
{
    public function index()
    {
        $this->view->assign('about', $this->about);
        $this->view->assign('title', '关于我们');
        $this->view->assign('body_class', 'about-body');
        return $this->view->fetch();
    }

    public function userxy()
    {
        $this->view->assign('about', $this->about);
        $this->view->assign('title', '用户协议');
        return $this->view->fetch();
    }
    public function plat()
    {
        $this->view->assign('about', $this->about);
        $this->view->assign('title', '平台协议');
        return $this->view->fetch();
    }
    public function userhz()
    {
        $this->view->assign('about', $this->about);
        $this->view->assign('title', '商务合作');
        return $this->view->fetch();
    }
}