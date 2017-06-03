<?php

/**
 * Created by PhpStorm.
 * User: 许国辉
 * Date: 2017/5/9
 * Time: 23:06
 */
class Index_Model extends CI_Model{
   public function __construct(){
        parent::__construct();
        $this->load->database();
    }

   public function connection(){
       $redis = new Redis();
       $redis->connect("127.0.0.1","6379");
       return $redis;
   }

    public function IsTeleUnique($data){
        $redis = $this->connection();
        $res = json_encode($redis->keys('*'));
        if(strpos($res,$data['phoneNum'])==true){
            return true;
        }else{
            return false;
        }
    }

    public function register($data){
        $name = $data['userName'];
        $psw = $data['passWord'];
        $phone = $data['phoneNum'];

        $redis  = $this->connection();
        $res = $redis ->hSet($phone,'userName',$name);
        $res1 = $redis ->hSet($phone,'passWord',$psw);
        $res2 = $redis ->hSet($phone,'type','0');
        $res3 = $redis ->hSet($phone,'state','0');

        if($res && $res1 && $res2){
            return true;
        }else{
            return false;
        }
    }

    public function login($data){
        $phone = $data['phoneNum'];
        $psw =  $data['passWord'];

        $redis  = $this->connection();
        $res = $redis ->hGet($phone,'passWord');

        $type = $redis ->hGet($phone,'type');

        if($psw == $res){
            $result = array('status' => 'true','type' =>  $res);
            return $result;
        }else{
            $result = array('status' => 'false');
            return $result;
        }
    }

    public function setUserInfo($data){
        $redis = $this->connection();
        $res1 = $redis ->hSet($data['phoneNum'],'resName',$data['resName']);
        $res2 = $redis ->hSet($data['phoneNum'],'userName',$data['userName']);
        $res3 = $redis ->hSet($data['phoneNum'],'address',$data['address']);
        $res4 = $redis ->hSet($data['phoneNum'],'realName',$data['realName']);
        $res5 = $redis ->hSet($data['phoneNum'],'email',$data['email']);
        $res6 = $redis ->hSet($data['phoneNum'],'city',$data['city']);
        $res7 = $redis ->hSet($data['phoneNum'],'country',$data['country']);
        $res8 = $redis ->hSet($data['phoneNum'],'postCode',$data['postCode']);
        $res9 = $redis ->hSet($data['phoneNum'],'aboutMessage',$data['aboutMessage']);

        if($res1 && $res2 && $res3 && $res4 && $res5 && $res6 && $res7 && $res8 && $res9){
            return true;
        }else{
            return false;
        }
    }

    public function getUserInfo($data){

        $redis = $this->connection();
        $answer['phone'] = $data['phoneNum'];
        $answer['resName'] = $redis ->hGet($data['phoneNum'],'resName');
        $answer['userName'] = $redis ->hGet($data['phoneNum'],'userName');
        $answer['address'] = $redis ->hGet($data['phoneNum'],'address');
        $answer['realName'] = $redis ->hGet($data['phoneNum'],'realName');
        $answer['email'] = $redis ->hGet($data['phoneNum'],'email');
        $answer['city'] = $redis ->hGet($data['phoneNum'],'city');
        $answer['country'] = $redis ->hGet($data['phoneNum'],'country');
        $answer['postCode'] = $redis ->hGet($data['phoneNum'],'postCode');
        $answer['aboutMessage'] = $redis ->hGet($data['phoneNum'],'aboutMessage');
        $answer['state'] = $redis ->hGet($data['phoneNum'],'state');
//        $phone = $data['phoneNum'];
//        $psw =  $data['passWord'];
//
//        $redis1  = $this->connection();
//        $answer['userName']  = $redis1 ->hGet($phone,'userName');




        return $answer;
    }

    public function setUserStatus($data){
        $redis = $this->connection();
        $res = $redis ->hSet($data['phoneNum'],'status',$data['status']);

        if($res){
            return true;
        }else{
            return false;
        }
    }
}