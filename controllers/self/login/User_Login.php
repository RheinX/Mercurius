<?php
include_once "Login.php";
//include_once '../Token.php';
//header("Content-type: text/html; charset=utf-8");
/**
 * Created by PhpStorm.
 * User: 徐炜杰
 * Date: 2017/5/15
 * Time: 22:36
 */
class User_Login extends Login {
    public  function __construct($data){
        parent::__construct($data);
        $this->load->model('Index_Model');
    }

    public function isLogin(){
        $result=parent::isLogin(); // TODO: Change the autogenerated stub
        if(!$result['state'])
            return $result;

        $this->data['type']=2;
        $this->data['phoneNum']=$this->data['userName'];

        //is the right format
        if(!preg_match("/^1[34578]\d{9}$/", $this->data['phoneNum'])){
            $result['state']=false;
            $result['errorMessage']="电话号码格式错误!";
            return $result;
        }

        $answer=$this->Index_Model->login($this->data);
        if($answer['status']=="false"){
            $result['state']=false;
            $result['errorMessage']="帐号或密码不正确!";
            return $result;
        }

        //$result['token']=Token::encrypted($this->data);
        $result['state']=true;
        return $result;
    }
}