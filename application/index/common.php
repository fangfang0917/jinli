<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/22
 * Time: 0:39
 */

use think\Session;
use think\Response;
use think\Request;
use think\Url;
use think\Config;


function outVideoHtml($src)
{
    $arr = explode("." ,$src);
    switch (end($arr)) {
        case 'mp4':
            return '<source id="videos" src="'.$src.'" type="video/mp4">';
        case 'mp3':
            return '<source id="videos" src="'.$src.'" type="audio/mpeg">';
    }
}

function getUserAuthBanner($user)
{

    $banner_typeMap = [];
    if ($user['level'] == 0) {
        $banner_typeMap[] = 5;//非VIP
    } else {
        if ($user['is_vip_libao'] == 0) {
            $banner_typeMap[] = 4;//未礼包
        }
        if (in_array($user['level'] ,[1 ,2 ,3])) {
            $sys = db('userop')->where(array('id' => 0))->find();
            $sys = json_decode($sys['userop'] ,true);
            $checkNum = 0;
            switch ($user['level']) {
                case 1:
                    $checkNum = array('num' => $sys['agent_num'] ,'level' => 1);
                    break;
                case 2:
                    $checkNum = array('num' => $sys['cagent_num'] ,'level' => 2);
                    break;
                case 3:
                    $checkNum = array('num' => $sys['zagent_num'] ,'level' => 3);
                    break;
            }
            if ($user['share_num'] >= $checkNum['num']) {
                $level = $checkNum['level'];
                $banner_typeMap[] = 6;//获得升级
            } else {
                $banner_typeMap[] = 3;//未获得升级
            }
        }
    }
    $banner_typeMap[] = 7;
    $list = db('banner')->where(['banner_type' => ['in' ,$banner_typeMap]])->order('banner_type')->select();
    foreach ($list as $k => $v) {
        if ($v['banner_type'] == 6) {
            $list[$k]['level'] = $level;
        } else {
            $list[$k]['level'] = 0;
        }
    }
    return $list;
}