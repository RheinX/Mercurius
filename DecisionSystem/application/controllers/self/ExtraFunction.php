<?php
/**
 * Created by PhpStorm.
 * User: 徐炜杰
 * Date: 2017/2/25
 * Time: 15:44
 */
function recursion($data, $id) {
    $list = array();
    foreach($data as $v) {
        if($v['fatherid'] == $id) {
            $v['son'] = recursion($data, $v['fid']);
            if(empty($v['son'])) {
                unset($v['son']);
            }
            array_push($list, $v);
        }
    }
    return $list;
}

//查找当前id所有文件子id
function Seek_All_Son_File_Id($data,$id){
    $list=array();
    array_push($list,$id);

    do{
        $number_id=0;
        foreach ($data as $k=>$v){
            //判断v的fatherId在不在list数组之中,若在则将其压入list并从data中删去
            if(in_array($v['fatherid'],$list)){
                array_push($list,$v['fid']);
                unset($data[$k]);
                $number_id++;
            }
        }
    }while($number_id>0);
    
    return $list;
}

/**
 * 下载文件
 * @param string $file
 *               被下载文件的路径
 * @param string $name
 *               用户看到的文件名
 */
function download($file,$name=''){
    $fileName = $name ? $name : pathinfo($file,PATHINFO_FILENAME);
    $filePath = realpath($file);

    $fp = fopen($filePath,'rb');

    if(!$filePath || !$fp){
        header('HTTP/1.1 404 Not Found');
        echo "Error: 404 Not Found.(server file path error)<!-- Padding --><!-- Padding --><!-- Padding --><!-- Padding --><!-- Padding --><!-- Padding --><!-- Padding --><!-- Padding --><!-- Padding --><!-- Padding --><!-- Padding --><!-- Padding --><!-- Padding --><!-- Padding -->";
        exit;
    }

    $fileName = $fileName .'.'. pathinfo($filePath,PATHINFO_EXTENSION);
    $encoded_filename = urlencode($fileName);
    $encoded_filename = str_replace("+", "%20", $encoded_filename);

    header('HTTP/1.1 200 OK');
    header( "Pragma: public" );
    header( "Expires: 0" );
    header("Content-type: application/octet-stream");
    header("Content-Length: ".filesize($filePath));
    header("Accept-Ranges: bytes");
    header("Accept-Length: ".filesize($filePath));

    $ua = $_SERVER["HTTP_USER_AGENT"];
    if (preg_match("/MSIE/i", $ua)) {
        header('Content-Disposition: attachment; filename="' . $encoded_filename . '"');
    } else if (preg_match("/Firefox/", $ua)) {
        header('Content-Disposition: attachment; filename*="utf8\'\'' . $fileName . '"');
    } else {
        header('Content-Disposition: attachment; filename="' . $encoded_filename . '"');
    }

    // ob_end_clean(); <--有些情况可能需要调用此函数
    // 输出文件内容
    fpassthru($fp);
    exit;
}