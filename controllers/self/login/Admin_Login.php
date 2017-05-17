<?php
include_once "Login.php";
/**
 * Created by PhpStorm.
 * User: 徐炜杰
 * Date: 2017/5/15
 * Time: 22:37
 */
class Admin_Login extends Login {
    function __construct($data){
        parent::__construct($data);
        $this->load->model('Index_Model');
    }

    public function isLogin(){
        parent::isLogin(); // TODO: Change the autogenerated stub
        $this->data['type']=1;
        if(!$this->Index_Model->login($this->data)){
            $result['state']=false;
            $result['errorMessage']="帐号或密码不正确!";
            return $result;
        }

        $result['state']=true;
        return $result;
    }
}