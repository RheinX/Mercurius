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


}