<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/11
 * Time: 11:27
 */

namespace app\index\controller;


use app\index\Controller;
use think\Session;

class Comment extends Controller
{
      public function addcomment(){
          $data = $this->request->param();
          $data['add_time'] = time();
          $data['user_id'] = Session::get('user_id');
          db('course_comment')->insert($data);
          return json(array('status'=>1,'msg'=>'评论成功'));
      }
}