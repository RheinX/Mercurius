<?php

/**
 * Created by PhpStorm.
 * User: 许国辉
 * Date: 2017/5/15
 * Time: 22:51
 */
class Core_Model extends CI_Model{

    public function __construct(){
        parent::__construct();
    }

    public function connection(){
        $redis = new Redis();
        $redis->connect("127.0.0.1","6379");
        return $redis;
    }
/*
 * *获取折线图
 * return:
 $result = array('good'=>data,'medium'=>data,'bad'=>data)
or bool false
 *
 *
 */

    public function getLinedata($data){
        $redis = $this->connection();
        $resName = $redis->HGET($data['phoneNum'],'resName');
        $ResID = $resName.'_Line';
        $result['good'] = $redis ->HGET($ResID,'good');
        $result['medium'] = $redis ->HGET($ResID,'medium');
        $result['bad'] = $redis ->HGET($ResID,'bad');

       // return $ResID;
        if ($result){
            return $result;
        }else {
            return false;
        }
    }

    /*
 * *获取饼状图
 * return:
 $result = array[11,12,13]  good medium bad
or bool false
 *
 *
 */
    public function getPiedata($data){
        $redis = $this->connection();
        $resName = $redis->HGET($data['phoneNum'],'resName');
        $ResID = $resName.'_Pie';
        $result = $redis ->HGET($ResID,'data');
        if ($result){
            return $result;
        }else{
            return false;
        }

        //return $ResID;

    }


    /*
* *获取条形图
* return:
$result = array("keysords"=>"[xxx,xxx]","data"=>"[10,20]")
or bool false
*
*
*/
    public function getBardata($data){
        $redis = $this->connection();
        $resName = $redis->HGET($data['phoneNum'],'resName');
        $ResID = $resName.'_Bar';
        $result['keywords'] = $redis ->HGET($ResID,'keywords');
        $result['data'] = $redis ->HGET($ResID,'amount');

        if($result){
            return $result;
        }else{
            return false;
        }
    }


    public function getPredict($data){
        $redis = $this->connection();
        $resName = $redis->hget($data['phoneNum'],'resName');
        $key = $resName.'_'.$data['dishName'];
        $res = $redis->hget('predict',$key);
        $result = array_slice($res,0,$data['day']);
        if($result){
            return $result;
        }else{
            return false;
        }

    }

}