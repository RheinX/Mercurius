<?php

/**
 * Created by PhpStorm.
 * User: 徐炜杰
 * Date: 2017/5/15
 * Time: 23:01
 */
class Token{
    //encrypted the data
    public static function encrypted($data){
        return $data['phoneNum'];
    }

    public static function decrypted($data){
        return $data;
    }
}