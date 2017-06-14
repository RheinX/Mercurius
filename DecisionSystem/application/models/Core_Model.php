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



    /*获取菜品列表*/

    public function getDish($data){
        $redis = $this->connection();
        $resName = $redis->hget($data['phoneNum'],'resName');
        $result = $redis ->hget($resName,'dish');

        if($result){
            return $result;
        }else{
            return false;
        }
    }

    /*预测菜品*/

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


    /*导出数据库  str*/

    public function exportRedis(){
        $redis = $this->connection();
        $keys = $redis->keys('*');
        $str = '';
        for($i = 0 ;$i<count($keys);$i++){
            $res = $redis->hgetall($keys[$i]);
            $str = $str.serialize($res);
        }
        if($str){
            return $str;
        }else{
            return false;
        }

    }

    public function writeRedis(){
        $redis = $this->connection();
//        $redis->HSET('dish_Predict','过桥缘_番茄米线 ','[35,35,35,35,35,34,34,34]');
//        $redis->HSET('dish_Predict','过桥缘_老醋木耳 ','[21,21,21,20,19,21,22,22]');
//        $redis->HSET('dish_Predict','过桥缘_老坛酸菜米线','[95,94,96,94,94,95,94,95]');
//        $redis->HSET('dish_Predict','过桥缘_牛肉米线','[110,110,109,109,109,109,109,109,110]');
//        $redis->HSET('dish_Predict','过桥缘_藤椒鸡','[41,41,41,41,41,41,41,41]');
//
//        $redis->HSET('dish_Predict','吉野家_吉野家小火锅','[71,71,71,71,71,71,71,71]');
//        $redis->HSET('dish_Predict','吉野家_密制肥牛饭','[92,96,95,90,92,93,90,93]');
//        $redis->HSET('dish_Predict','吉野家_双拼饭','[95,95,95,95,94,94,94,95]');
//        $redis->HSET('dish_Predict','吉野家_小碗红烧丸子饭','[80,78,79,79,80,80,78,79]');
//        $redis->HSET('dish_Predict','吉野家_照烧鸡排饭','[75,74,74,74,74,75,74,74]');
//
//        $redis->HSET('dish_Predict','眉州东坡酒楼_东坡老坛子','[86,83,86,85,85,83,86,87]');
//        $redis->HSET('dish_Predict','眉州东坡酒楼_锅烧春笋','[54,54,55,55,54,55,54,54]');
//        $redis->HSET('dish_Predict','眉州东坡酒楼_酱猪蹄','[29,28,28,29,29,28,27,28]');
//        $redis->HSET('dish_Predict','眉州东坡酒楼_眉州棒棒鸡','[64,64,64,64,64,63,64,64]');
//        $redis->HSET('dish_Predict','眉州东坡酒楼_眉州东坡香肠','[24,24,24,24,24,24,24,24]');
//
//        $redis->hset('过桥缘_Line','good','[21,33,32,40,12,38,41]');
//        $redis->hset('过桥缘_Line','medium','[9,8,10,12,9,5,11]');
//        $redis->hset('过桥缘_Line','bad','[2,4,2,2,4,5,3]');
//
//        $redis->hset('吉野家_Line','good','[31,36,44,43,32,38,49]');
//        $redis->hset('吉野家_Line','medium','[19,8,14,12,20,15,11]');
//        $redis->hset('吉野家_Line','bad','[7,6,5,3,6,5,5]');
//
//        $redis->hset('眉州东坡酒楼_Line','good','[31,55,32,40,22,48,41]');
//        $redis->hset('眉州东坡酒楼_Line','medium','[19,28,10,18,19,15,11]');
//        $redis->hset('眉州东坡酒楼_Line','bad','[8,14,2,2,14,5,13]');
//
//
//        $redis->HSET('过桥缘_Pie','data', '[285,89,70]');
//        $redis->HSET('吉野家_Pie','data', '[235,49,50]');
//        $redis->HSET('眉州东坡酒楼_Pie','data', '[426,52,54]');



        $redis->hset('过桥缘_Bar','keywords','味道好,好吃,速度快,份量少,价格实惠,速度慢,辣,太贵,油腻');
        $redis->hset('过桥缘_Bar','amount ','63,55,49,48,48,35,32,30,19');

        $redis->hset('吉野家_Bar','keywords ','味道好,价格实惠,良心商家,太辣,贵,油腻,甜,速度快,份量不足');
        $redis->hset('吉野家_Bar','amount','85,66,33,58,11,55,48,15,42,28');

        $redis->hset('眉州东坡酒楼_Bar','keywords','味道好,好吃,速度快,太贵,油腻,份量少,价格实惠,速度慢,辣');
        $redis->hset('眉州东坡酒楼_Bar','amount','64,33,15,18,22,45,65,22,11,25');

    }
}