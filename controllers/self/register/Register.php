<?php

/**
 * Created by PhpStorm.
 * User: 徐炜杰
 * Date: 2017/5/14
 * Time: 18:03
 */
class Register extends CI_Controller {
    protected $data;

    function __construct($data){
        parent::__construct();
        $this->data=$data;
        $this->load->model('Index_Model');
    }

    function isRegister(){
        //check if data is null
        if(empty($this->data['userName'])||empty($this->data['passWord'])){
            $result['state']=false;
            $result['errorMessage']="帐号密码不能为空!";
            return $result;
        }

        //check the length
        if(strlen($this->data['userName'])<1||strlen($this->data['userName'])>14){
            $result['state']=false;
            $result['errorMessage']="帐号长度不得超过14!";
            return $result;
        }
        if(strlen($this->data['passWord'])<1||strlen($this->data['passWord'])>20){
            $result['state']=false;
            $result['errorMessage']="密码长度不得超过20!";
            return $result;
        }

        //check the format
        if(!preg_match("/^(([a-z]+[0-9]+)|([0-9]+[a-z]+))[a-z0-9]*$/i",$this->data['userName'])
            ||!preg_match("/^(([a-z]+[0-9]+)|([0-9]+[a-z]+))[a-z0-9]*$/i",$this->data['passWord'])){
            $result['state']=false;
            $result['errorMessage']="帐号密码只能由数字和字母的组合而成!";
            return $result;
        }

        $result['state']=true;

        return $result;
    }
}

