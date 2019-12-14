<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

/**
 * 模拟tab产生空格
 * @param int $step
 * @param string $string
 * @param int $size
 * @return string
 */
function tab($step = 1, $string = ' ', $size = 4)
{
    return str_repeat($string, $size * $step);
}

function sendDataByCurl($url, $jsonStr, $https = false, $method = 'post')
{
    // 初始化curl
    $ch = curl_init($url);
    // 字符串不直接输出，进行一个变量的存储
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    // https请求
    if ($https === true) {
        // 确保https请求能够请求成功
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    }
    // post请求
    if ($method == 'post') {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonStr);
        // 只需要用个 http 头就能传递 json 啦！
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json; charset=utf-8',
                'Content-Length: ' . strlen($jsonStr)
            )
        );
    }
    // 发送请求
    $str = curl_exec($ch);
    $aStatus = curl_getinfo($ch);
    // 关闭连接
    curl_close($ch);
    if (intval($aStatus["http_code"]) == 200) {
        return json_decode($str);
    } else {
//        return json_encode($aStatus);
        return false;
    }
}


function getJson($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    return json_decode($output, true);
}


function getbgqrcode($imageDefault, $textDefault, $background, $filename = "", $config = array())
{
    //如果要看报什么错，可以先注释调这个header
    if (empty($filename)) header("content-type: image/png");
    //背景方法
    $backgroundInfo = getimagesize($background);
    $ext = image_type_to_extension($backgroundInfo[2], false);
    $backgroundFun = 'imagecreatefrom' . $ext;
    $background = $backgroundFun($background);
    $backgroundWidth = imagesx($background);  //背景宽度
    $backgroundHeight = imagesy($background);  //背景高度
    $imageRes = imageCreatetruecolor($backgroundWidth, $backgroundHeight);
    $color = imagecolorallocate($imageRes, 0, 0, 0);
    imagefill($imageRes, 0, 0, $color);
    imagecopyresampled($imageRes, $background, 0, 0, 0, 0, imagesx($background), imagesy($background), imagesx($background), imagesy($background));
    //处理了图片
    if (!empty($config['image'])) {
        foreach ($config['image'] as $key => $val) {
            $val = array_merge($imageDefault, $val);
            $info = getimagesize($val['url']);
            dump($val);
            $function = 'imagecreatefrom' . image_type_to_extension($info[2], false);
            if (isset($val['stream'])) {
                //如果传的是字符串图像流
                $info = getimagesizefromstring($val['url']);
                $function = 'imagecreatefromstring';
            }
            $res = $function($val['url']);
            $resWidth = $info[0];
            $resHeight = $info[1];
            //建立画板 ，缩放图片至指定尺寸
            $canvas = imagecreatetruecolor($val['width'], $val['height']);
            imagefill($canvas, 0, 0, $color);
            //关键函数，参数（目标资源，源，目标资源的开始坐标x,y, 源资源的开始坐标x,y,目标资源的宽高w,h,源资源的宽高w,h）
            imagecopyresampled($canvas, $res, 0, 0, 0, 0, $val['width'], $val['height'], $resWidth, $resHeight);
            $val['left'] = $val['left'] < 0 ? $backgroundWidth - abs($val['left']) - $val['width'] : $val['left'];
            $val['top'] = $val['top'] < 0 ? $backgroundHeight - abs($val['top']) - $val['height'] : $val['top'];
            //放置图像
            imagecopymerge($imageRes, $canvas, $val['left'], $val['top'], $val['right'], $val['bottom'], $val['width'], $val['height'], $val['opacity']);//左，上，右，下，宽度，高度，透明度
        }
    }
    //处理文字
    if (!empty($config['text'])) {
        foreach ($config['text'] as $key => $val) {
            $val = array_merge($textDefault, $val);
            list($R, $G, $B) = explode(',', $val['fontColor']);
            $fontColor = imagecolorallocate($imageRes, $R, $G, $B);
            $val['left'] = $val['left'] < 0 ? $backgroundWidth - abs($val['left']) : $val['left'];
            $val['top'] = $val['top'] < 0 ? $backgroundHeight - abs($val['top']) : $val['top'];
            imagettftext($imageRes, $val['fontSize'], $val['angle'], $val['left'], $val['top'], $fontColor, $val['fontPath'], $val['text']);
        }
    }
    //生成图片
    if (!empty($filename)) {
        $res = imagejpeg($imageRes, $filename, 90);
        //保存到本地
        imagedestroy($imageRes);
    } else {
        imagejpeg($imageRes);
        //在浏览器上显示
        imagedestroy($imageRes);
    }
}


function createPoster($config)
{
    if (is_file($config['filePath'])) {
        unlink($config['filePath']);
    }
    $imageDefault = array(
        'left' => 0,
        'top' => 0,
        'right' => 0,
        'bottom' => 0,
        'width' => 100,
        'height' => 100,
        'opacity' => 100,
    );
    $textDefault = array(
        'text' => '',
        'left' => 0,
        'top' => 0,
        'fontSize' => 32, //字号
        'fontColor' => '255,255,255', //字体颜色
        'angle' => 0,
        'forCount' => 1,
    );
    $background = $config['backgroundMap']; //海报最底层得背景
    //开始设置背景
    $backgroundInfo = getimagesize($background);
    $backgroundFun = 'imagecreatefrom' . image_type_to_extension($backgroundInfo[2], false); //image_type_to_extension - 获取图片后缀
    $background = $backgroundFun($background); //创建新图像

    $backgroundWidth = imagesx($background); //背景宽度
    $backgroundHeight = imagesy($background); //背景高度
    $imageRes = imageCreatetruecolor($backgroundWidth, $backgroundHeight);
    $color = imagecolorallocate($imageRes, 255, 255, 255);
    imagefill($imageRes, 0, 0, $color);
    imageColorTransparent($imageRes, $color); //颜色透明
    imagecopyresampled($imageRes, $background, 0, 0, 0, 0, imagesx($background), imagesy($background), imagesx($background), imagesy($background));
    if (!empty($config['image'])) {
        foreach ($config['image'] as $key => $val) {
            $val = array_merge($imageDefault, $val);
            $info = getimagesize($val['url']);
            $function = 'imagecreatefrom' . image_type_to_extension($info[2], false);
            $res = $function($val['url']);
            $resWidth = $info[0];
            $resHeight = $info[1];
            //建立画板 ，缩放图片至指定尺寸
            $canvas = imagecreatetruecolor($val['width'], $val['height']);
            imagefill($canvas, 0, 0, $color);
            //关键函数，参数（目标资源，源，目标资源的开始坐标x,y, 源资源的开始坐标x,y,目标资源的宽高w,h,源资源的宽高w,h）
            imagecopyresampled($canvas, $res, 0, 0, 0, 0, $val['width'], $val['height'], $resWidth, $resHeight);
            $val['left'] = $val['left'] < 0 ? $backgroundWidth - abs($val['left']) - $val['width'] : $val['left'];
            $val['top'] = $val['top'] < 0 ? $backgroundHeight - abs($val['top']) - $val['height'] : $val['top'];
            //放置图像
            imagecopymerge($imageRes, $canvas, $val['left'], $val['top'], $val['right'], $val['bottom'], $val['width'], $val['height'], $val['opacity']);
            // bool imagecopymerge( resource dst_im, resource src_im, int dst_x, int dst_y, int src_x, int src_y,int src_w, int src_h, int pct )
            //dst_im        目标图像,
            //src_im        被拷贝的源图像,
            //dst_x         目标图像开始 x 坐标,
            //dst_y         目标图像开始 y 坐标,
            //src_x         拷贝图像开始 x 坐标,
            //src_y         拷贝图像开始 y 坐标,
            //src_w         (从 src_x 开始)拷贝的宽度,
            //src_h         (从 src_y 开始)拷贝的高度,
            //pct           图像合并程度，取值 0-100 ，当 pct=0 时，实际上什么也没做，反之完全合并
        }
    }
    //处理文字
    if (!empty($config['text'])) {
        if (isset($config['text']['fontFile'])) {
            $fontFile = $config['text']['fontFile'];
        }
        foreach ($config['text']['data'] as $key => $val) {
            $fontFile = isset($val['fontFile']) ? $val['fontFile'] : $fontFile;
            $val = array_merge($textDefault, $val);
            list($R, $G, $B) = explode(',', $val['fontColor']);
            $fontColor = imagecolorallocate($imageRes, $R, $G, $B);
            $val['left'] = $val['left'] < 0 ? $backgroundWidth - abs($val['left']) : $val['left'];
            $val['top'] = $val['top'] < 0 ? $backgroundHeight - abs($val['top']) : $val['top'];
            for ($i = 0; $i <= $val['forCount']; $i++) {
                imagettftext($imageRes, $val['fontSize'], $val['angle'], ($val['left'] + $i), ($val['top'] + $i), $fontColor, $fontFile, $val['text']);
            }
            // 资源,字体大小,旋转角度,基线点(单位是像素X),基线点(单位是像素Y),字体的颜色,字体文件,要渲染的字符串
        }
    }
    if ($config['createFile']) {
        $res = imagejpeg($imageRes, $config['filePath']); //保存到本地
        if ($res) {
            return array(
                'type' => 1,
                'val' => $config['fileLink'],
                'path' => $config['filePath'],
            );
        } else {
            return array(
                'type' => 0,
                'val' => null,
                'path' => null,
            );
        }
    } else {
        $res = imagejpeg($imageRes); //保存到本地
        return $res;
    }
}


/**
 * 生成圆形图片
 * @param $imgpath  图片地址/支持微信、QQ头像等没有后缀的网络图
 * @param $saveName string 保存文件名，默认空。
 * @return resource 返回图片资源或保存文件
 */
function yuanimg($imgpath, $saveName = '')
{
    $src_img = imagecreatefromstring(file_get_contents($imgpath));
    $w = imagesx($src_img);
    $h = imagesy($src_img);
    $w = $h = min($w, $h);
    $img = imagecreatetruecolor($w, $h);
    //这一句一定要有
    //拾取一个完全透明的颜色,最后一个参数127为全透明
    $bg = imagecolorallocatealpha($img, 0, 0, 0, 127);
    imagealphablending($img, false);//关闭混合模式，以便透明颜色能覆盖原画布
    imagefill($img, 0, 0, $bg);
    imagesavealpha($img, true);

    $r = $w / 2; //圆半径
    for ($x = 0; $x < $w; $x++) {
        for ($y = 0; $y < $h; $y++) {
            $rgbColor = imagecolorat($src_img, $x, $y);
            if (((($x - $r) * ($x - $r) + ($y - $r) * ($y - $r)) < ($r * $r))) {
                imagesetpixel($img, $x, $y, $rgbColor);
            }
        }
    }
    //输出图片到文件
    imagepng($img, $saveName);
    //释放空间
    imagedestroy($src_img);
    imagedestroy($img);

    return $saveName;
}


//下载头像
function downloadavatar($url, $absolute_path = '')
{
    if (is_file($absolute_path)) {
        unlink($absolute_path);
    }
    $ch = curl_init();
    $timeout = 5;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $img = curl_exec($ch);
    curl_close($ch);
    $resource = fopen($absolute_path, 'w');
    fwrite($resource, $img);
    fclose($resource);
    if (is_file($absolute_path)) {
        return array('save_path' => $absolute_path, 'status' => 1);
    } else {
        return array('save_path' => $absolute_path, 'status' => 0);
    }

}


function getCourseClassifyType($type){
    $c = \think\Config::get('course_classify_type');
    $kj = '';
    foreach ($c as $k=>$v){
        if($type == $v['type']){
            $kj = $v['name'];
        }
    }
    return $kj;
}