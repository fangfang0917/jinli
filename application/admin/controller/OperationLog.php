<?php

namespace app\admin\controller;

use app\admin\Controller;

Class OperationLog extends Controller
{
    use \app\admin\traits\controller\Controller;

    public function index()
    {
        $map = [];
        $list = Db('operation_log')->alias('ol')
            ->join('admin_user au', 'au.id = ol.admin_id')
            ->field(array('ol.id', 'au.realname', 'ol.operation_classify', 'ol.operation_remarks',
                'from_unixtime(ol.create_time) as create_time'))
            ->paginate(10, false, ['query' => request()->param()]);
        $this->view->assign('list', $list);
        $this->view->assign('count', $list->count());
        $this->view->assign('page', $list->render());
        return $this->view->fetch();
    }
}
