<?php
/**
 * tpAdmin [a web admin based ThinkPHP5]
 *
 * @author    yuan1994 <tianpian0805@gmail.com>
 * @link      http://tpadmin.yuan1994.com/
 * @copyright 2016 yuan1994 all rights reserved.
 * @license   http://www.apache.org/licenses/LICENSE-2.0
 */

namespace app\admin\traits\controller;

use think\Db;
use think\Loader;
use think\exception\HttpException;
use think\Config;
use think\Session;
use Qiniu\Auth as Auth;
use Qiniu\Storage\BucketManager;
use Qiniu\Storage\UploadManager;

trait Controller
{
    /**
     * 首页
     * @return mixed
     */
    public function index()
    {
        $model = $this->getModel();

        // 列表过滤器，生成查询Map对象
        $map = $this->search($model, [$this->fieldIsDelete => $this::$isdelete]);

        // 特殊过滤器，后缀是方法名的
        $actionFilter = 'filter' . $this->request->action();
        if (method_exists($this, $actionFilter)) {
            $this->$actionFilter($map);
        }

        // 自定义过滤器
        if (method_exists($this, 'filter')) {
            $this->filter($map);
        }

        $this->datalist($model, $map);

        return $this->view->fetch();
    }

    /**
     * 回收站
     * @return mixed
     */
    public function recycleBin()
    {
        $this::$isdelete = 1;

        return $this->index();
    }

    /**
     * 添加
     * @return mixed
     */
    public function add()
    {
        $controller = $this->request->controller();

        if ($this->request->isAjax()) {
            // 插入
            $data = $this->request->except(['id']);

            // 验证
            if (class_exists($validateClass = Loader::parseClass(Config::get('app.validate_path'), 'validate', $controller))) {
                $validate = new $validateClass();
                if (!$validate->check($data)) {
                    return ajax_return_adv_error($validate->getError());
                }
            }

            // 写入数据
            if (
                class_exists($modelClass = Loader::parseClass(Config::get('app.model_path'), 'model', $this->parseCamelCase($controller)))
                || class_exists($modelClass = Loader::parseClass(Config::get('app.model_path'), 'model', $controller))
            ) {
                //使用模型写入，可以在模型中定义更高级的操作
                $model = new $modelClass();
                $ret = $model->isUpdate(false)->save($data);
            } else {
                // 简单的直接使用db写入
                Db::startTrans();
                try {
                    $model = Db::name($this->parseTable($controller));
                    $ret = $model->insert($data);
                    // 提交事务
                    Db::commit();
                } catch (\Exception $e) {
                    // 回滚事务
                    Db::rollback();

                    return ajax_return_adv_error($e->getMessage());
                }
            }

            return ajax_return_adv('添加成功');
        } else {
            // 添加
            return $this->view->fetch(isset($this->template) ? $this->template : 'edit');
        }
    }

    /**
     * 编辑
     * @return mixed
     */
    public function edit()
    {
        $controller = $this->request->controller();

        if ($this->request->isAjax()) {
            // 更新
            $data = $this->request->post();
            if (!$data['id']) {
                return ajax_return_adv_error("缺少参数ID");
            }

            // 验证
            if (class_exists($validateClass = Loader::parseClass(Config::get('app.validate_path'), 'validate', $controller))) {
                $validate = new $validateClass();
                if (!$validate->check($data)) {
                    return ajax_return_adv_error($validate->getError());
                }
            }

            // 更新数据
            if (
                class_exists($modelClass = Loader::parseClass(Config::get('app.model_path'), 'model', $this->parseCamelCase($controller)))
                || class_exists($modelClass = Loader::parseClass(Config::get('app.model_path'), 'model', $controller))
            ) {
                // 使用模型更新，可以在模型中定义更高级的操作
                $model = new $modelClass();
                $ret = $model->isUpdate(true)->save($data, ['id' => $data['id']]);
            } else {
                // 简单的直接使用db更新
                Db::startTrans();
                try {
                    $model = Db::name($this->parseTable($controller));
                    $ret = $model->where('id', $data['id'])->update($data);
                    // 提交事务
                    Db::commit();
                } catch (\Exception $e) {
                    // 回滚事务
                    Db::rollback();

                    return ajax_return_adv_error($e->getMessage());
                }
            }

            return ajax_return_adv("编辑成功");
        } else {
            // 编辑
            $id = $this->request->param('id');
            if (!$id) {
                throw new HttpException(404, "缺少参数ID");
            }
            $vo = $this->getModel($controller)->find($id);
            if (!$vo) {
                throw new HttpException(404, '该记录不存在');
            }

            $this->view->assign("vo", $vo);

            return $this->view->fetch();
        }
    }

    /**
     * 默认删除操作
     */
    public function delete()
    {
        return $this->updateField($this->fieldIsDelete, 1, "移动到回收站成功");
    }

    /**
     * 从回收站恢复
     */
    public function recycle()
    {
        return $this->updateField($this->fieldIsDelete, 0, "恢复成功");
    }

    /**
     * 默认禁用操作
     */
    public function forbid()
    {
        return $this->updateField($this->fieldStatus, 0, "禁用成功");
    }


    /**
     * 默认恢复操作
     */
    public function resume()
    {
        return $this->updateField($this->fieldStatus, 1, "恢复成功");
    }


    /**
     * 永久删除
     */
    public function deleteForever()
    {
        $model = $this->getModel();
        $pk = $model->getPk();
        $ids = $this->request->param($pk);
        $where[$pk] = ["in", $ids];
        if (false === $model->where($where)->delete()) {
            return ajax_return_adv_error($model->getError());
        }

        return ajax_return_adv("删除成功");
    }

    /**
     * 清空回收站
     */
    public function clear()
    {
        $model = $this->getModel();
        $where[$this->fieldIsDelete] = 1;
        if (false === $model->where($where)->delete()) {
            return ajax_return_adv_error($model->getError());
        }

        return ajax_return_adv("清空回收站成功");
    }

    /**
     * 保存排序
     */
    public function saveOrder()
    {
        $param = $this->request->param();
        if (!isset($param['sort'])) {
            return ajax_return_adv_error('缺少参数');
        }

        $model = $this->getModel();
        foreach ($param['sort'] as $id => $sort) {
            $model->where('id', $id)->update(['sort' => $sort]);
        }

        return ajax_return_adv('保存排序成功', '');
    }

    public function savePic()
    {

        $file = request()->file('cover');
        // 要上传图片的本地路径
        $filePath = $file->getRealPath();
        $ext = pathinfo($file->getInfo('name'), PATHINFO_EXTENSION);  //后缀
        //获取当前控制器名称
        // $controllerName=$this->getContro();
        // 上传到七牛后保存的文件名
        $key = substr(md5($file->getRealPath()), 0, 5) . date('YmdHis') . rand(0, 9999) . '.' . $ext;
        include_once ROOT_PATH . 'vendor/qiniu/php-sdk/autoload.php';
        // 需要填写你的 Access Key 和 Secret Key
        $accessKey = Config::get('ACCESSKEY');
        $secretKey = Config::get('SECRETKEY');
        // 构建鉴权对象
        $auth = new Auth($accessKey, $secretKey);
        // 要上传的空间
        $bucket = Config::get('BUCKET');
        $domain = Config::get('DOMAIN');
        $token = $auth->uploadToken($bucket);
        // 初始化 UploadManager 对象并进行文件的上传
        $uploadMgr = new UploadManager();
        // 调用 UploadManager 的 putFile 方法进行文件的上传
        list($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);
        if ($err !== null) {
            return ["state" => 0, "msg" => $err, "data" => ""];
        } else {
            //返回图片的完整URL
            return json(["state" => 1, "msg" => "上传完成", "path" => (Config::get('SHTTP') . $domain . '/' . $ret['key'])]);
        }
    }

    public function jie()
    {
        $file = request()->file('video');
        $size = $file->getInfo('size');
        $typeStr= $file->getInfo('type');
        if(strstr($typeStr, 'video')){
            $type = 2;
        }elseif(strstr($typeStr, 'audio')){
            $type = 3;
        }
        if ($size > Config::get('videoSize')) {
            return ["state" => 0, "msg" => '上传文件超出限制'];
        }
//        dump($file);
//        dump($file->getInfo('size'));
//        die;
        // 要上传图片的本地路径
        $filePath = $file->getRealPath();

        $ext = pathinfo($file->getInfo('name'), PATHINFO_EXTENSION);  //后缀
        //获取当前控制器名称
        // $controllerName=$this->getContro();
        // 上传到七牛后保存的文件名
        $key = substr(md5($file->getRealPath()), 0, 5) . date('YmdHis') . rand(0, 9999) . '.' . $ext;
        include_once ROOT_PATH . 'vendor/qiniu/php-sdk/autoload.php';
        // 需要填写你的 Access Key 和 Secret Key
        $accessKey = Config::get('ACCESSKEY');
        $secretKey = Config::get('SECRETKEY');
        // 构建鉴权对象
        $auth = new Auth($accessKey, $secretKey);
        // 要上传的空间
        $bucket = Config::get('BUCKET');
        $domain = Config::get('DOMAIN');
        $token = $auth->uploadToken($bucket);
        // 初始化 UploadManager 对象并进行文件的上传
        $uploadMgr = new UploadManager();
        // 调用 UploadManager 的 putFile 方法进行文件的上传
        list($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);
        if ($err !== null) {
            return ["state" => 0, "msg" => $err, "data" => ""];
        } else {
            //返回图片的完整URL
            return json(["state" => 1, "msg" => "上传完成", "path" => (Config::get('SHTTP') . $domain . '/' . $ret['key']),'type'=>$type]);
        }

    }

    public function teamjs($id)
    {
        $map['pid'] = $id;
        $mao['p_pid'] = $id;
        $p = 0;
        $vip = 0;
        $t = 0;
        $c = 0;
        $h = 0;
        $s = 0;
        $list = db('user')->where($map)->whereOr($mao)->paginate(10, false, ['query' => request()->param()]);
        $pcount = db('user')->where($map)->count();
        $ppcount = db('user')->where($mao)->count();
        $data = db('user')->where($map)->whereOr($mao)->select();
        foreach ($data as $k => $v) {
            if ($v['level'] == 0) {
                $p = $p + 1;
            } elseif ($v['level'] == 1) {
                $vip = $vip + 1;
            } elseif ($v['level'] == 2) {
                $t = $t + 1;
            } elseif ($v['level'] == 3) {
                $c = $c + 1;
            } elseif ($v['level'] == 4) {
                $h = $h + 1;
            } else {
                $s = $s + 1;
            }
        }
        $counts = array(
            'p' => $p,
            'vip' => $vip,
            't' => $t,
            'c' => $c,
            'h' => $h,
            's' => $s,
            'pcount' => $pcount,
            'ppcount' => $ppcount,
            'list' => $list
        );
        return $counts;
    }

    public function excel()
    {
        $map = [];
        $where = $this->request->param();

        if ($where['start_time']) {
            $map['add_time'] = ['between', strtotime($where['start_time']) . ',' . strtotime($where['end_time'])];
        }
        if ($where['type'] == 1) {
            $map['level'] = ['in', '2,3,4,5'];
            $tabletitle = '代理信息表';
        } else {
            $map['level'] = ['in', '0,1'];
            $tabletitle = '用户信息表';

        }
        $list = db('user')->where($map)->field(array('id', 'nick_name', 'level', 'phone',
            'from_unixtime(add_time,\'%Y-%m-%d %H:%i:%s\') as add_time',
            'from_unixtime(buy_vip_time,\'%Y-%m-%d %H:%i:%s\') as buy_vip_time',
            'from_unixtime(buy_agent_time,\'%Y-%m-%d %H:%i:%s\') as buy_agent_time', 'pid'))->select();
        foreach ($list as $k => $v) {
            $count = $this->teamjs($v['id']);
            $list[$k]['pcount'] = $count['pcount'];
            $list[$k]['ppcount'] = $count['ppcount'];
            $list[$k]['t'] = $count['t'];
            $list[$k]['c'] = $count['c'];
            $list[$k]['h'] = $count['h'];
            $list[$k]['zy'] = db('user_record')->where(array('user_id' => $v['id'], 'type' => 1))->sum('amount') + 0;
            $list[$k]['jy'] = db('user_record')->where(array('user_id' => $v['id'], 'type' => 2))->sum('amount') + 0;
            $list[$k]['dali'] = db('user_record')->where(array('user_id' => $v['id'], 'type' => 4))->sum('amount') + 0;
            $list[$k]['fu'] = db('user_record')->where(array('user_id' => $v['id'], 'type' => 5))->sum('amount') + 0;
            $list[$k]['fen'] = db('user_record')->where(array('user_id' => $v['id'], 'type' => 6))->sum('amount') + 0;
            $list[$k]['buyamount'] = db('order')->where(array('user_id' => $v['id'], 'pay_type' => 1, 'money' => ['gt', 0]))->sum('money') + 0;
        }

        $header = ['用户ID', '用户昵称', '用户等级', '手机号码', '注册时间', '购买会员时间', '首次购买代理时间', '邀请人ID',
            '直邀人数', '间邀人数', '初级代理', '中级代理', '高级代理', '直邀收入', '间邀收入', '推荐收入', '服务收入', '分润收入', '消费'];
        if ($error = \Excel::export($header, $list, $tabletitle, '2007')) {
            throw new Exception($error);
        }
    }

    public function setcode($codebef='JL', $num = 1000,$id)
    {
        $codeArr = [];
        for ($i = 0;$i<=10000;$i++){
            array_push($codeArr,$this ->getCode(6));
        }
        $codeArr =  array_unique($codeArr);
        $codeNum = array_rand($codeArr,$num);
        $codeData = [];
        foreach ($codeNum as $v){
            $str = $codebef.$codeArr[$v];
            array_push($codeData,$str);
        }
        $intData = [];
        foreach($codeData as $v){
            $intOneData = array(
                'code' =>$v,
                'cid'=>$id
            );
            array_push($intData,$intOneData);
        }
        return $intData;
    }

    public function setcode1($codebef='JL', $num = 100,$id=1){
        $j = 0;
        for ($i = 0;$i<=10000;$i++){
            $code = $this ->getCode(6);
            $code = $codebef.$code;
            $auth = $this ->setMysql($code,$id);
            if($auth){
                $j++;
            }
            if($j == $num){
                break;
            }
        }
    }
    public function setMysql($code,$id){
        $auth = Db('codeinfo')->where(array('code'=>$code))->find();
        if(!$auth){
            DB('codeinfo')->insert(array('cid'=>$id,'code'=>$code));
            return true;
        }else{
            return false;
        }
    }
    public function getCode($len){
        $chars = array(
            "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K","L", "M", "N", "O", "P", "Q", "R", "S", "T", "U",
            "V","W", "X", "Y", "Z", "0", "1", "2","3", "4", "5", "6", "7", "8", "9"
        );
        $charsLen = count($chars) - 1;
        shuffle($chars);$output = "";
        for ($i=0; $i<$len; $i++){$output .= $chars[mt_rand(0, $charsLen)];}

        return $output;
    }

}
