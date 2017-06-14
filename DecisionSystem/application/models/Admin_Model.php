<?php

/**
 * Created by PhpStorm.
 * User: 许国辉
 * Date: 2017/5/24
 * Time: 10:25
 */
class Admin_Model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }

    public function connection(){
        $redis = new Redis();
        $redis->connect("127.0.0.1","6379");
        return $redis;
    }

    //列出获取所有商家信息\
    /*post:null
      return:if true  return $result
                if flase  return bool false
    */
    public function getAllres(){
        $redis = $this->connection();
        $res = $redis->keys('1*');
        $num = count($res);
        for($i=0; $i<$num; $i++){
            $res0 = $redis->Hget($res[$i],'resName');
            $res1 = $redis->hget($res[$i],'realName');
            $res2 =  $redis->hget($res[$i],'status');
            $result[$res[$i]]['resName'] = $res0;
            $result[$res[$i]]['realName'] = $res1;
            $result[$res[$i]]['status'] = $res2;
            $result[$res[$i]]['shopID'] = $res[$i];
        }
         if ($result){
             return $result;
        }else{
             return false;
         }
    }

    //审核
    public function check($data){
        $redis = $this->connection();
        if ($redis -> HSET($data['phoneNum'],'status','2')){
            return true;
        }else{
            return false;
        }
    }
    //封停
    /*post:$data['phoneNum']
      return : bool true  / false
    */
    public function forbid($data){
        $redis = $this->connection();
        if($redis -> HSET($data['phoneNum'],'status','4')){
            return true;
        }else{
            return false;
        }
    }

    public function setState($data){
        $redis = $this->connection();
        if($redis -> HSET($data['phoneNum'],'status',$data['state'])){
            return true;
        }else{
            return false;
        }
    }

    /*存储评论*/
    /*return  bool false or true*/
    public function addComment($data){
        $redis = $this->connection();

        $res1 = $redis->HSET($data['phoneNum'].'_Comment','score',$data['score']);
        $res2 = $redis->HSET($data['phoneNum'].'_Comment','comment',$data['comment']);
        $res3 = $redis->HSET($data['phoneNum'].'_Comment','time',$data['time']);
        if($res1&&$res2&&$res3){
            return true;
        }else{
            return false;
        }
    }

    /*获取评论*/
    /*return $result array{"time"=>$result[time],"score"=>$result['scroe'],"commnet"=>$result['comment']}*/
    public function getComment($data){
        $redis = $this->connection();
        $result['score'] = $redis->HGET($data['phoneNum'].'_Comment','score');
        $result['comment'] = $redis->HGET($data['phoneNum'].'_Comment','comment');
        $result['time'] = $redis->HGET($data['phoneNum'].'_Comment','time');

        if($result){
            return $result;
        }else{
            return false;
        }
    }

    /*存储日志*/
    public function writeLog($data){
        $redis = $this->connection();
        $res = $redis->HSET('Log_'.$data['phoneNum'].'_'.$data['time'],'operation',$data['operation']);
        if($res){
            return true;
        }else{
            return false;
        }
    }

    /*获取所有日志*/
    /*所有日志*/

    public function getLog(){
        $redis = $this->connection();
        $keys = $redis->keys('Log_*');
        $result = array();
        for($i = 0 ;$i<count($keys);$i++){
            $str = explode("_",$keys[$i]);
            $time = $str[2];
            $res = $redis->HGET($keys[$i],'operation');

            $item = array();
            $item['time'] =  $time;
            $item['operation'] = $res;
            $array[] = $item;
            array_push($result,$item);

        }
        if($result){
            return $result;
        }else{
            return false;
        }
    }

    /*获取对应商家的日志*/
    public function getShopLog($data){
        $redis = $this->connection();
        $keys = $redis->keys('Log_'.$data['phoneNum'].'*');
        $result = array();
        for($i = 0 ;$i<count($keys);$i++){
            $str = explode("_",$keys[$i]);
            $time = $str[2];
            $res = $redis->HGET($keys[$i],'operation');

            $item = array();
            $item['time'] =  $time;
            $item['operation'] = $res;
            array_push($result,$item);
        }
//        if($result){
//                return $str;
//            }else{
//                return false;
//        }
        return $result;
    }


}