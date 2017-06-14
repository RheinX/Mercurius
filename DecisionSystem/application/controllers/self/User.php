<?php
include_once "Interfaces.php";
/**
 * Created by PhpStorm.
 * User: 徐炜杰
 * Date: 2017/5/14
 * Time: 17:16
 */
class User implements Interfaces_Common,Interfaces_User {
    private $data;

    function __construct(){
        //$this->data=$data;
    }

    public function login($object){
        // TODO: Implement login() method.
        if($object instanceof Login){
            return $object->isLogin();
        }

        return false;
    }

    public function Register($object){
        // TODO: Implement Register() method.
        if ($object instanceof Register){
            return $object->isRegister();
        }
        return false;
    }

    public function getProfile($object){
        if($object instanceof Info)
            return $object->getProfile();
        else
            return false;
    }


}